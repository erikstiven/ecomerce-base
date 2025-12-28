<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CompanyService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        ]);
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
            'description' => ['nullable', 'string', 'max:2000'],
            'image' => ['nullable', 'image', 'max:2048'],
            'is_active' => ['nullable', 'boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);

        $service = new CompanyService();

        if ($request->hasFile('image')) {
            Storage::disk('public')->makeDirectory('company-services');
            $path = $request->file('image')->store('company-services', 'public');
            $validated['image_path'] = $path;
        }

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
            'description' => ['nullable', 'string', 'max:2000'],
            'image' => ['nullable', 'image', 'max:2048'],
            'is_active' => ['nullable', 'boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);

        if ($request->hasFile('image')) {
            Storage::disk('public')->makeDirectory('company-services');
            $path = $request->file('image')->store('company-services', 'public');
            $validated['image_path'] = $path;
        }

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
