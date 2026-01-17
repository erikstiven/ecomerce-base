<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CompanyService;
use Illuminate\Http\Request;

class CompanyServiceController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:manage options');
    }

    public function index()
    {
        return view('admin/settings/services/index', [
            'services' => CompanyService::query()->orderBy('sort_order')->orderBy('id')->get(),
            'settings' => \App\Models\CompanySetting::query()->first(),
        ]);
    }

    public function updateSettings(Request $request)
    {
        $validated = $request->validate([
            'services_title' => ['nullable', 'string', 'max:255'],
            'services_intro' => ['nullable', 'string', 'max:2000'],
            'services_cta_label' => ['nullable', 'string', 'max:255'],
            'services_cta_url' => ['nullable', 'string', 'max:255'],
            'services_show_section' => ['nullable'],
            'services_show_cta' => ['nullable'],
        ]);

        $validated['services_show_section'] = $request->boolean('services_show_section');
        $validated['services_show_cta'] = $request->boolean('services_show_cta');

        $settings = \App\Models\CompanySetting::query()->firstOrNew();
        if (empty($settings->name)) {
            $settings->name = 'Mi tienda';
        }
        $settings->fill($validated);
        $settings->save();

        return redirect()
            ->route('admin.settings.company.services.index')
            ->with('status', 'Configuración de servicios actualizada.');
    }

    public function create()
    {
        return view('admin/settings/services/form', [
            'service' => new CompanyService(),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:2000'],
            'image_path' => ['required', 'url', 'max:2000'],
            'is_active' => ['nullable', 'boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);

        $service = new CompanyService();

        $service->fill($validated);
        $service->is_active = (bool) ($validated['is_active'] ?? false);
        $service->sort_order = $validated['sort_order'] ?? 0;
        $service->save();

        return redirect()
            ->route('admin.settings.company.services.index')
            ->with('status', 'Servicio creado correctamente.');
    }

    public function edit(CompanyService $service)
    {
        return view('admin/settings/services/form', [
            'service' => $service,
        ]);
    }

    public function update(Request $request, CompanyService $service)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:2000'],
            'image_path' => ['required', 'url', 'max:2000'],
            'is_active' => ['nullable', 'boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);

        $service->fill($validated);
        $service->is_active = (bool) ($validated['is_active'] ?? false);
        $service->sort_order = $validated['sort_order'] ?? 0;
        $service->save();

        return redirect()
            ->route('admin.settings.company.services.index')
            ->with('status', 'Servicio actualizado correctamente.');
    }

    public function destroy(CompanyService $service)
    {
        $service->delete();

        return redirect()
            ->route('admin.settings.company.services.index')
            ->with('status', 'Servicio eliminado correctamente.');
    }
}
