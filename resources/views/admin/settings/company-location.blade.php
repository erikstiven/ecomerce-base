<x-admin-layout :breadcrumbs="[
    [
        'name' => __('Dashboard'),
        'route' => route('admin.dashboard'),
    ],
    [
        'name' => 'Configuración',
    ],
    [
        'name' => 'Empresa',
    ],
    [
        'name' => 'Ubicación',
    ],
]">

    <div class="card-form">
        @if (session('status'))
            <div class="mb-4 rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('admin.settings.company.location.update') }}">
            @csrf
            @method('PUT')

            <x-validation-errors class="mb-4" />

            <section>
                <h2 class="text-sm font-semibold text-slate-700">Ubicación</h2>
                <div class="mt-4 grid gap-6 md:grid-cols-2">
                    <div class="md:col-span-2">
                        <x-label class="mt-2">Título de la sección</x-label>
                        <x-input class="w-full" name="location_title"
                            value="{{ old('location_title', $settings?->location_title) }}" />
                        <p class="mt-1 text-xs text-slate-500">Ejemplo: Nuestra ubicación.</p>
                    </div>
                    <div class="md:col-span-2">
                        <x-label class="mt-2">Descripción</x-label>
                        <x-textarea class="w-full" name="location_description" rows="3">{{ old('location_description', $settings?->location_description) }}</x-textarea>
                        <p class="mt-1 text-xs text-slate-500">Texto corto para invitar a visitar el negocio.</p>
                    </div>
                    <div class="md:col-span-2">
                        <x-label class="mt-2">URL embebida del mapa (obligatorio)</x-label>
                        <x-textarea class="w-full" name="location_map_embed" rows="4">{{ old('location_map_embed', $settings?->location_map_embed) }}</x-textarea>
                        <p class="mt-1 text-xs text-slate-500">Pega el enlace de Google Maps en formato embed o un iframe completo. También puedes usar coordenadas abajo.</p>
                    </div>
                    <div class="md:col-span-2">
                        <x-label class="mt-2">Dirección completa</x-label>
                        <x-textarea class="w-full" name="location_address" rows="3">{{ old('location_address', $settings?->location_address) }}</x-textarea>
                        <p class="mt-1 text-xs text-slate-500">Incluye calle, número y referencias.</p>
                    </div>
                    <div class="md:col-span-2">
                        <x-label class="mt-2">Información de contacto</x-label>
                        <x-textarea class="w-full" name="location_contact_text" rows="3">{{ old('location_contact_text', $settings?->location_contact_text) }}</x-textarea>
                        <p class="mt-1 text-xs text-slate-500">Agrega un texto corto con instrucciones o canales de contacto.</p>
                    </div>
                    <div>
                        <x-label class="mt-2">Correo de contacto</x-label>
                        <x-input class="w-full" name="location_email"
                            value="{{ old('location_email', $settings?->location_email) }}" />
                    </div>
                    <div>
                        <x-label class="mt-2">Teléfono principal</x-label>
                        <x-input class="w-full" name="location_phone_primary"
                            value="{{ old('location_phone_primary', $settings?->location_phone_primary) }}" />
                    </div>
                    <div>
                        <x-label class="mt-2">Teléfono secundario</x-label>
                        <x-input class="w-full" name="location_phone_secondary"
                            value="{{ old('location_phone_secondary', $settings?->location_phone_secondary) }}" />
                    </div>
                    <div>
                        <x-label class="mt-2">Teléfono ventas</x-label>
                        <x-input class="w-full" name="location_phone_sales"
                            value="{{ old('location_phone_sales', $settings?->location_phone_sales) }}" />
                    </div>
                    <div>
                        <x-label class="mt-2">Ciudad</x-label>
                        <x-input class="w-full" name="location_city"
                            value="{{ old('location_city', $settings?->location_city) }}" />
                    </div>
                    <div>
                        <x-label class="mt-2">País</x-label>
                        <x-input class="w-full" name="location_country"
                            value="{{ old('location_country', $settings?->location_country) }}" />
                    </div>
                    <div>
                        <x-label class="mt-2">Latitud (opcional)</x-label>
                        <x-input class="w-full" name="location_map_latitude"
                            value="{{ old('location_map_latitude', $settings?->location_map_latitude) }}" />
                        <p class="mt-1 text-xs text-slate-500">Si no usas URL embebida, ingresa latitud y longitud.</p>
                    </div>
                    <div>
                        <x-label class="mt-2">Longitud (opcional)</x-label>
                        <x-input class="w-full" name="location_map_longitude"
                            value="{{ old('location_map_longitude', $settings?->location_map_longitude) }}" />
                    </div>
                    <div>
                        <x-label class="mt-2">Costo de envío</x-label>
                        <x-input class="w-full" name="shipping_cost" type="number" step="0.01"
                            value="{{ old('shipping_cost', $settings?->shipping_cost ?? 5) }}" />
                        <p class="mt-1 text-xs text-slate-500">Se usa como costo fijo en el checkout (ejemplo: 5.00).</p>
                    </div>
                </div>
            </section>

            <div class="mt-6 flex justify-end">
                <x-button>Guardar</x-button>
            </div>
        </form>
    </div>

</x-admin-layout>
