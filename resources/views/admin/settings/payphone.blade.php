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
            </div>

            <div class="mt-6 flex justify-end">
                <x-button>Guardar</x-button>
            </div>
        </form>
    </div>

</x-admin-layout>
