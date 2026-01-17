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
            'about_title' => ['required', 'string', 'max:255'],
            'about_lead' => ['nullable', 'string', 'max:5000'],
            'about_mission' => ['nullable', 'string', 'max:3000', 'required_if:about_show_narrative,1'],
            'about_story' => ['nullable', 'string', 'max:3000', 'required_if:about_show_narrative,1'],
            'about_cta_label' => ['nullable', 'string', 'max:255', 'required_if:about_show_cta,1'],
            'about_cta_url' => ['nullable', 'url', 'max:255', 'required_if:about_show_cta,1'],
            'about_supporting' => ['nullable', 'string', 'max:255'],
            'about_stats' => ['nullable', 'string', 'max:4000', 'required_if:about_show_stats,1'],
            'about_image_src' => ['nullable', 'url', 'max:2048', 'required_if:about_show_image,1'],
            'about_image_alt' => ['nullable', 'string', 'max:255'],
            'about_image_caption' => ['nullable', 'string', 'max:255'],
            'about_trust_title' => ['nullable', 'string', 'max:255', 'required_if:about_show_trust,1'],
            'about_trust_items' => ['nullable', 'string', 'max:4000', 'required_if:about_show_trust,1'],
            'about_values' => ['nullable', 'string', 'max:4000', 'required_if:about_show_values,1'],
            'about_show_narrative' => ['nullable'],
            'about_show_stats' => ['nullable'],
            'about_show_image' => ['nullable'],
            'about_show_trust' => ['nullable'],
            'about_show_values' => ['nullable'],
            'about_show_cta' => ['nullable'],
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
            'location_address' => ['nullable', 'string', 'max:1000'],
            'location_city' => ['nullable', 'string', 'max:255'],
            'location_country' => ['nullable', 'string', 'max:255'],
            'location_map_embed' => ['nullable', 'string', 'max:4000', 'required_without_all:location_map_latitude,location_map_longitude'],
            'location_map_latitude' => ['nullable', 'numeric', 'between:-90,90', 'required_without:location_map_embed', 'required_with:location_map_longitude'],
            'location_map_longitude' => ['nullable', 'numeric', 'between:-180,180', 'required_without:location_map_embed', 'required_with:location_map_latitude'],
            'location_contact_text' => ['nullable', 'string', 'max:3000'],
            'location_email' => ['nullable', 'email', 'max:255'],
            'location_phone_primary' => ['nullable', 'string', 'max:50'],
            'location_phone_secondary' => ['nullable', 'string', 'max:50'],
            'location_phone_sales' => ['nullable', 'string', 'max:50'],
            'shipping_cost' => ['nullable', 'numeric', 'min:0', 'max:99999.99'],
        ]);

        $settings = CompanySetting::query()->firstOrNew();
        $settings->fill($validated);
        $settings->save();

        return redirect()
            ->route('admin.settings.company.location.edit')
            ->with('status', 'Ubicación actualizada.');
    }
}
