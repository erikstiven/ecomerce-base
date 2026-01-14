<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CompanySetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CompanySettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:manage options');
    }

    public function edit()
    {
        return view('admin.settings.footer', [
            'settings' => CompanySetting::query()->first(),
        ]);
    }

    public function update(Request $request)
    {
        $settings = CompanySetting::query()->firstOrNew();

        $validated = $request->validate([
            'name' => ['nullable', 'string', 'max:255'],
            'footer_description' => ['nullable', 'string', 'max:1000'],
            'footer_email' => ['nullable', 'email', 'max:255'],
            'footer_phone' => ['nullable', 'string', 'max:50'],
            'footer_logo' => ['nullable', 'url', 'max:2048'],
            'facebook' => ['nullable', 'url', 'max:255'],
            'instagram' => ['nullable', 'url', 'max:255'],
            'tiktok' => ['nullable', 'url', 'max:255'],
            'youtube' => ['nullable', 'url', 'max:255'],
            'legal_company_name' => ['nullable', 'string', 'max:255'],
        ]);

        if (blank($validated['name'] ?? null)) {
            $validated['name'] = $settings->name ?: 'Codecima';
        }

        if (blank($validated['footer_logo'] ?? null)) {
            unset($validated['footer_logo']);
        }

        $settings->fill($validated);
        $settings->save();

        return redirect()
            ->route('admin.settings.footer.edit')
            ->with('status', 'Configuración del footer actualizada.');
    }
}
