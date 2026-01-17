<x-admin-layout :breadcrumbs="[
    [
        'name' => __('Dashboard'),
        'route' => route('admin.dashboard'),
    ],
    [
        'name' => 'Configuración',
    ],
    [
        'name' => 'Pagos',
    ],
    [
        'name' => 'PayPhone',
    ],
]">

    <div class="card-form">
        @if (session('status'))
            <div class="mb-4 rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('admin.settings.payphone.update') }}">
            @csrf
            @method('PUT')

            <x-validation-errors class="mb-4" />

            <div class="space-y-6">
                <div>
                    <h2 class="text-sm font-semibold text-slate-700">PayPhone</h2>
                    <p class="mt-1 text-xs text-slate-500">Configura la pasarela para pagos con tarjeta.</p>
                </div>
                <div class="flex items-center gap-2">
                    <x-checkbox name="payphone_enabled" :checked="(bool) old('payphone_enabled', $settings?->payphone_enabled ?? false)" />
                    <x-label>Habilitar PayPhone</x-label>
                </div>

                <div class="grid gap-6 md:grid-cols-2">
                    <div class="md:col-span-2">
                        <x-label class="mt-2">Token <span class="text-red-500">*</span></x-label>
                        <x-input class="w-full" name="payphone_token" value="{{ old('payphone_token', $settings?->payphone_token) }}"
                            placeholder="Token generado en el panel de PayPhone" />
                        <p class="mt-1 text-xs text-slate-500">Guarda el token que PayPhone asigna a tu comercio.</p>
                    </div>

                    <div>
                        <x-label class="mt-2">Store ID <span class="text-red-500">*</span></x-label>
                        <x-input class="w-full" name="payphone_store_id" value="{{ old('payphone_store_id', $settings?->payphone_store_id) }}"
                            placeholder="Ej: 12345" />
                        <p class="mt-1 text-xs text-slate-500">Identificador de comercio asociado al token.</p>
                    </div>

                    <div>
                        <x-label class="mt-2">Entorno</x-label>
                        <select name="payphone_environment" class="mt-1 w-full rounded border-slate-300">
                            @php
                                $env = old('payphone_environment', $settings?->payphone_environment ?? 'sandbox');
                            @endphp
                            <option value="sandbox" @selected($env === 'sandbox')>Sandbox (pruebas)</option>
                            <option value="production" @selected($env === 'production')>Producción</option>
                        </select>
                        <p class="mt-1 text-xs text-slate-500">Usa sandbox para pruebas y producción cuando esté habilitado en PayPhone.</p>
                    </div>

                    <div class="md:col-span-2">
                        <x-label class="mt-2">Dominio autorizado (referencia)</x-label>
                        <x-input class="w-full" name="payphone_domain" value="{{ old('payphone_domain', $settings?->payphone_domain) }}"
                            placeholder="Ej: mitienda.com" />
                        <p class="mt-1 text-xs text-slate-500">Campo informativo para recordar el dominio registrado en PayPhone.</p>
                    </div>

                    <div class="md:col-span-2">
                        <x-label class="mt-2">API URL (opcional)</x-label>
                        <x-input class="w-full" name="payphone_api_url" value="{{ old('payphone_api_url', $settings?->payphone_api_url) }}"
                            placeholder="https://sandbox.payphonetodoesposible.com/api" />
                        <p class="mt-1 text-xs text-slate-500">Solo necesitas completar esto si PayPhone entrega un endpoint distinto.</p>
                    </div>
                </div>

                <div class="pt-4">
                    <h2 class="text-sm font-semibold text-slate-700">Depósito bancario</h2>
                    <p class="mt-1 text-xs text-slate-500">Define la información que verán tus clientes en el checkout.</p>
                </div>

                <div class="flex items-center gap-2">
                    <x-checkbox name="bank_deposit_enabled" :checked="(bool) old('bank_deposit_enabled', $settings?->bank_deposit_enabled ?? true)" />
                    <x-label>Habilitar depósito bancario</x-label>
                </div>

                <div class="grid gap-6 md:grid-cols-2">
                    <div>
                        <x-label class="mt-2">Banco <span class="text-red-500">*</span></x-label>
                        <x-input class="w-full" name="bank_name" value="{{ old('bank_name', $settings?->bank_name) }}"
                            placeholder="Ej: Banco Pichincha" />
                    </div>
                    <div>
                        <x-label class="mt-2">Tipo de cuenta <span class="text-red-500">*</span></x-label>
                        <x-input class="w-full" name="bank_account_type" value="{{ old('bank_account_type', $settings?->bank_account_type) }}"
                            placeholder="Ej: Cuenta de ahorro" />
                    </div>
                    <div>
                        <x-label class="mt-2">Número de cuenta <span class="text-red-500">*</span></x-label>
                        <x-input class="w-full" name="bank_account_number" value="{{ old('bank_account_number', $settings?->bank_account_number) }}"
                            placeholder="Ej: 2208765620" />
                    </div>
                    <div>
                        <x-label class="mt-2">WhatsApp de confirmación</x-label>
                        <x-input class="w-full" name="bank_whatsapp" value="{{ old('bank_whatsapp', $settings?->bank_whatsapp) }}"
                            placeholder="Ej: +593979018689" />
                        <p class="mt-1 text-xs text-slate-500">Número internacional sin espacios.</p>
                    </div>
                    <div class="md:col-span-2">
                        <x-label class="mt-2">Instrucciones adicionales</x-label>
                        <x-textarea class="w-full" name="bank_transfer_instructions" rows="3"
                            placeholder="Ej: Envía el comprobante y tu número de pedido.">{{ old('bank_transfer_instructions', $settings?->bank_transfer_instructions) }}</x-textarea>
                    </div>
                    <div class="md:col-span-2">
                        <x-label class="mt-2">Mensaje de WhatsApp (opcional)</x-label>
                        <x-input class="w-full" name="bank_whatsapp_message"
                            value="{{ old('bank_whatsapp_message', $settings?->bank_whatsapp_message) }}"
                            placeholder="Ej: Hola, adjunto comprobante de mi pedido." />
                    </div>
                </div>
            </div>

            <div class="mt-6 flex justify-end">
                <x-button>Guardar</x-button>
            </div>
        </form>
    </div>

</x-admin-layout>
