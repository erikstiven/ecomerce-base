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
                        <x-label class="mt-2">Título</x-label>
                        <x-input class="w-full" name="location_title"
                            value="{{ old('location_title', $settings?->location_title) }}" />
                    </div>
                    <div class="md:col-span-2">
                        <x-label class="mt-2">Descripción</x-label>
                        <x-textarea class="w-full" name="location_description" rows="3">{{ old('location_description', $settings?->location_description) }}</x-textarea>
                    </div>
                    <div class="md:col-span-2">
                        <x-label class="mt-2">Mapa (iframe embed)</x-label>
                        <x-textarea class="w-full" name="location_map_embed" rows="4">{{ old('location_map_embed', $settings?->location_map_embed) }}</x-textarea>
                    </div>
                    <div class="md:col-span-2">
                        <x-label class="mt-2">Dirección</x-label>
                        <x-textarea class="w-full" name="location_address" rows="3">{{ old('location_address', $settings?->location_address) }}</x-textarea>
                    </div>
                    <div class="md:col-span-2">
                        <x-label class="mt-2">Horario</x-label>
                        <x-textarea class="w-full" name="location_hours" rows="3">{{ old('location_hours', $settings?->location_hours) }}</x-textarea>
                    </div>
                    <div class="md:col-span-2">
                        <x-label class="mt-2">Contacto (texto libre)</x-label>
                        <x-textarea class="w-full" name="location_contact_text" rows="4">{{ old('location_contact_text', $settings?->location_contact_text) }}</x-textarea>
                    </div>
                    <div>
                        <x-label class="mt-2">Email de contacto</x-label>
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
                </div>
            </section>

            <div class="mt-6 flex justify-end">
                <x-button>Guardar</x-button>
            </div>
        </form>
    </div>

</x-admin-layout>
