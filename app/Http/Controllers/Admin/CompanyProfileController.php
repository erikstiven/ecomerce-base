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
            'about_eyebrow' => ['nullable', 'string', 'max:120'],
            'about_title' => ['nullable', 'string', 'max:255'],
            'about_lead' => ['nullable', 'string', 'max:2000'],
            'about_mission' => ['nullable', 'string', 'max:3000'],
            'about_story' => ['nullable', 'string', 'max:3000'],
            'about_cta_label' => ['nullable', 'string', 'max:255'],
            'about_cta_url' => ['nullable', 'string', 'max:255'],
            'about_supporting' => ['nullable', 'string', 'max:255'],
            'about_stats' => ['nullable', 'string', 'max:4000'],
            'about_image_src' => ['nullable', 'string', 'max:2048'],
            'about_image_alt' => ['nullable', 'string', 'max:255'],
            'about_image_caption' => ['nullable', 'string', 'max:255'],
            'about_trust_title' => ['nullable', 'string', 'max:255'],
            'about_trust_items' => ['nullable', 'string', 'max:4000'],
            'about_values' => ['nullable', 'string', 'max:4000'],
            'about_show_narrative' => ['nullable', 'boolean'],
            'about_show_stats' => ['nullable', 'boolean'],
            'about_show_image' => ['nullable', 'boolean'],
            'about_show_trust' => ['nullable', 'boolean'],
            'about_show_values' => ['nullable', 'boolean'],
            'about_show_cta' => ['nullable', 'boolean'],
            'legal_terms_content' => ['nullable', 'string', 'max:5000'],
            'legal_privacy_content' => ['nullable', 'string', 'max:5000'],
            'legal_returns_content' => ['nullable', 'string', 'max:5000'],
        ]);

        $validated['about_show_narrative'] = $request->boolean('about_show_narrative');
        $validated['about_show_stats'] = $request->boolean('about_show_stats');
        $validated['about_show_image'] = $request->boolean('about_show_image');
        $validated['about_show_trust'] = $request->boolean('about_show_trust');
        $validated['about_show_values'] = $request->boolean('about_show_values');
        $validated['about_show_cta'] = $request->boolean('about_show_cta');

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
