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

        $apiUrl = trim((string) $request->input('payphone_api_url', ''));
        if ($apiUrl !== '' && !preg_match('/^https?:\/\//i', $apiUrl)) {
            $apiUrl = 'https://' . $apiUrl;
        }
        $request->merge([
            'payphone_api_url' => $apiUrl !== '' ? $apiUrl : null,
        ]);

        $messages = [
            'payphone_token.required_if' => 'Ingresa el token de PayPhone para habilitar la pasarela.',
            'payphone_store_id.required_if' => 'Ingresa el Store ID de PayPhone para habilitar la pasarela.',
            'payphone_api_url.url' => 'La URL de la API de PayPhone debe ser válida.',
            'payphone_token.max' => 'El token de PayPhone es demasiado largo.',
            'payphone_store_id.max' => 'El Store ID de PayPhone es demasiado largo.',
            'payphone_domain.max' => 'El dominio autorizado no debe superar los 255 caracteres.',
            'payphone_api_url.max' => 'La URL de la API de PayPhone no debe superar los 255 caracteres.',
            'bank_name.required_if' => 'Indica el banco para habilitar el depósito bancario.',
            'bank_account_type.required_if' => 'Indica el tipo de cuenta para habilitar el depósito bancario.',
            'bank_account_number.required_if' => 'Indica el número de cuenta para habilitar el depósito bancario.',
            'bank_name.max' => 'El banco no debe superar los 255 caracteres.',
            'bank_account_type.max' => 'El tipo de cuenta no debe superar los 255 caracteres.',
            'bank_account_number.max' => 'El número de cuenta no debe superar los 255 caracteres.',
            'bank_transfer_instructions.max' => 'Las instrucciones adicionales no deben superar los 2000 caracteres.',
            'bank_whatsapp.max' => 'El WhatsApp de confirmación no debe superar los 50 caracteres.',
            'bank_whatsapp_message.max' => 'El mensaje de WhatsApp no debe superar los 255 caracteres.',
        ];

        $attributes = [
            'payphone_token' => 'token de PayPhone',
            'payphone_store_id' => 'Store ID de PayPhone',
            'payphone_environment' => 'entorno de PayPhone',
            'payphone_domain' => 'dominio autorizado',
            'payphone_api_url' => 'URL de la API de PayPhone',
            'bank_name' => 'banco',
            'bank_account_type' => 'tipo de cuenta',
            'bank_account_number' => 'número de cuenta',
            'bank_transfer_instructions' => 'instrucciones adicionales',
            'bank_whatsapp' => 'WhatsApp de confirmación',
            'bank_whatsapp_message' => 'mensaje de WhatsApp',
        ];

        $validated = $request->validate([
            'payphone_enabled' => ['nullable'],
            'payphone_token' => ['nullable', 'string', 'max:2048', 'required_if:payphone_enabled,1'],
            'payphone_store_id' => ['nullable', 'string', 'max:255', 'required_if:payphone_enabled,1'],
            'payphone_environment' => ['nullable', 'string', 'in:sandbox,production'],
            'payphone_domain' => ['nullable', 'string', 'max:255'],
            'payphone_api_url' => ['nullable', 'url', 'max:255'],
            'bank_deposit_enabled' => ['nullable'],
            'bank_name' => ['nullable', 'string', 'max:255', 'required_if:bank_deposit_enabled,1'],
            'bank_account_type' => ['nullable', 'string', 'max:255', 'required_if:bank_deposit_enabled,1'],
            'bank_account_number' => ['nullable', 'string', 'max:255', 'required_if:bank_deposit_enabled,1'],
            'bank_transfer_instructions' => ['nullable', 'string', 'max:2000'],
            'bank_whatsapp' => ['nullable', 'string', 'max:50'],
            'bank_whatsapp_message' => ['nullable', 'string', 'max:255'],
        ], $messages, $attributes);

        $validated['payphone_enabled'] = $request->boolean('payphone_enabled');
        $validated['bank_deposit_enabled'] = $request->boolean('bank_deposit_enabled');

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
