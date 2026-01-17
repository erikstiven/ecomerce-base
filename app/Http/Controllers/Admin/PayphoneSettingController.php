<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CompanySetting;
use Illuminate\Http\Request;

class PayphoneSettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:manage options');
    }

    public function edit()
    {
        return view('admin.settings.payphone', [
            'settings' => CompanySetting::query()->first(),
        ]);
    }

    public function update(Request $request)
    {
        $settings = CompanySetting::query()->firstOrNew();

        $validated = $request->validate([
            'payphone_enabled' => ['nullable'],
            'payphone_token' => ['nullable', 'string', 'max:255', 'required_if:payphone_enabled,1'],
            'payphone_store_id' => ['nullable', 'string', 'max:100', 'required_if:payphone_enabled,1'],
            'payphone_environment' => ['nullable', 'string', 'in:sandbox,production'],
            'payphone_domain' => ['nullable', 'string', 'max:255'],
            'payphone_api_url' => ['nullable', 'url', 'max:255'],
        ]);

        $validated['payphone_enabled'] = $request->boolean('payphone_enabled');

        if (blank($validated['payphone_api_url'] ?? null)) {
            unset($validated['payphone_api_url']);
        }

        if (blank($validated['payphone_domain'] ?? null)) {
            unset($validated['payphone_domain']);
        }

        $settings->fill($validated);
        $settings->save();

        return redirect()
            ->route('admin.settings.payphone.edit')
            ->with('status', 'Configuración de PayPhone actualizada.');
    }
}
