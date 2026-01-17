<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ShippingZone;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ShippingZoneController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:manage options');
    }

    public function index()
    {
        return view('admin.settings.shipping-zones.index', [
            'zones' => ShippingZone::query()->orderByDesc('is_default')->orderBy('name')->get(),
        ]);
    }

    public function create()
    {
        return view('admin.settings.shipping-zones.form', [
            'zone' => new ShippingZone(),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $this->validatePayload($request);

        $zone = new ShippingZone();
        $zone->fill($validated);
        $zone->save();

        $this->syncDefault($zone);

        return redirect()
            ->route('admin.settings.shipping-zones.index')
            ->with('status', 'Tarifa de envío creada.');
    }

    public function edit(ShippingZone $shipping_zone)
    {
        return view('admin.settings.shipping-zones.form', [
            'zone' => $shipping_zone,
        ]);
    }

    public function update(Request $request, ShippingZone $shipping_zone)
    {
        $validated = $this->validatePayload($request);

        $shipping_zone->fill($validated);
        $shipping_zone->save();

        $this->syncDefault($shipping_zone);

        return redirect()
            ->route('admin.settings.shipping-zones.index')
            ->with('status', 'Tarifa de envío actualizada.');
    }

    public function destroy(ShippingZone $shipping_zone)
    {
        $shipping_zone->delete();

        return redirect()
            ->route('admin.settings.shipping-zones.index')
            ->with('status', 'Tarifa de envío eliminada.');
    }

    private function validatePayload(Request $request): array
    {
        $provinces = array_keys(config('ecuador.provinces', []));
        $province = $request->input('province');
        $cities = [];
        if ($province && isset(config('ecuador.provinces', [])[$province])) {
            $cities = config('ecuador.provinces', [])[$province]['cities'] ?? [];
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'province' => ['nullable', 'string', 'max:255', Rule::in($provinces)],
            'city' => ['nullable', 'string', 'max:255', Rule::in($cities)],
            'price' => ['required', 'numeric', 'min:0', 'max:99999.99'],
            'is_active' => ['nullable'],
            'is_default' => ['nullable'],
        ], [
            'name.required' => 'Ingresa un nombre para la tarifa.',
            'price.required' => 'Ingresa el costo de envío.',
            'price.numeric' => 'El costo debe ser numérico.',
            'province.in' => 'Selecciona una provincia válida de Ecuador.',
            'city.in' => 'Selecciona una ciudad válida para la provincia elegida.',
        ], [
            'name' => 'nombre',
            'province' => 'provincia',
            'city' => 'ciudad',
            'price' => 'costo de envío',
        ]);

        $validated['is_active'] = $request->boolean('is_active');
        $validated['is_default'] = $request->boolean('is_default');
        $validated['province'] = $this->normalizeText($validated['province'] ?? null);
        $validated['city'] = $this->normalizeText($validated['city'] ?? null);

        return $validated;
    }

    private function normalizeText(?string $value): ?string
    {
        if ($value === null || trim($value) === '') {
            return null;
        }

        return mb_strtolower(trim($value));
    }

    private function syncDefault(ShippingZone $zone): void
    {
        if (!$zone->is_default) {
            return;
        }

        ShippingZone::query()
            ->where('id', '!=', $zone->id)
            ->update(['is_default' => false]);
    }
}
