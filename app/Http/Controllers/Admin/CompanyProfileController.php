<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CompanySetting;
use Illuminate\Http\Request;

class CompanyProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:manage options');
    }

    public function edit()
    {
        return view('admin.settings.company', [
            'settings' => CompanySetting::query()->first(),
        ]);
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'about_title' => ['nullable', 'string', 'max:255'],
            'about_intro' => ['nullable', 'string', 'max:2000'],
            'about_who' => ['nullable', 'string', 'max:3000'],
            'about_differentials' => ['nullable', 'string', 'max:3000'],
            'about_process' => ['nullable', 'string', 'max:3000'],
            'legal_terms_content' => ['nullable', 'string', 'max:5000'],
            'legal_privacy_content' => ['nullable', 'string', 'max:5000'],
            'legal_returns_content' => ['nullable', 'string', 'max:5000'],
        ]);

        $settings = CompanySetting::query()->firstOrNew();
        $settings->fill($validated);
        $settings->save();

        return redirect()
            ->route('admin.settings.company.edit')
            ->with('status', 'Configuración de empresa actualizada.');
    }

    public function editLocation()
    {
        return view('admin.settings.company-location', [
            'settings' => CompanySetting::query()->first(),
        ]);
    }

    public function updateLocation(Request $request)
    {
        $validated = $request->validate([
            'location_title' => ['nullable', 'string', 'max:255'],
            'location_description' => ['nullable', 'string', 'max:2000'],
            'location_map_embed' => ['nullable', 'string', 'max:4000'],
            'location_address' => ['nullable', 'string', 'max:1000'],
            'location_hours' => ['nullable', 'string', 'max:1000'],
            'location_email' => ['nullable', 'email', 'max:255'],
            'location_phone_primary' => ['nullable', 'string', 'max:50'],
            'location_phone_secondary' => ['nullable', 'string', 'max:50'],
            'location_phone_sales' => ['nullable', 'string', 'max:50'],
            'location_contact_text' => ['nullable', 'string', 'max:3000'],
        ]);

        $settings = CompanySetting::query()->firstOrNew();
        $settings->fill($validated);
        $settings->save();

        return redirect()
            ->route('admin.settings.company.location.edit')
            ->with('status', 'Ubicación actualizada.');
    }
}
