<x-admin-layout :breadcrumbs="[
    [
        'name' => __('Dashboard'),
        'route' => route('admin.dashboard'),
    ],
    [
        'name' => 'Configuración',
    ],
    [
        'name' => 'Envíos',
        'route' => route('admin.settings.shipping-zones.index'),
    ],
    [
        'name' => $zone->exists ? 'Editar' : 'Nueva tarifa',
    ],
]">

    <div class="card-form">
        <h1 class="mb-4 text-lg font-semibold text-slate-700">
            {{ $zone->exists ? 'Editar tarifa de envío' : 'Nueva tarifa de envío' }}
        </h1>

        <form method="POST"
            action="{{ $zone->exists ? route('admin.settings.shipping-zones.update', $zone) : route('admin.settings.shipping-zones.store') }}">
            @csrf
            @if ($zone->exists)
                @method('PUT')
            @endif

            <x-validation-errors class="mb-4" />

            <div class="grid gap-6 md:grid-cols-2">
                <div class="md:col-span-2">
                    <x-label class="mt-2">Nombre <span class="text-red-500">*</span></x-label>
                    <x-input class="w-full" name="name" value="{{ old('name', $zone->name) }}"
                        placeholder="Ej: Quito (urbano)" required />
                    <p class="mt-1 text-xs text-slate-500">Identifica la tarifa para ubicarla rápido.</p>
                </div>

                <div>
                    <x-label class="mt-2">Provincia</x-label>
                    <x-input class="w-full" name="province" value="{{ old('province', $zone->province) }}"
                        placeholder="Ej: Pichincha" />
                    <p class="mt-1 text-xs text-slate-500">Déjalo vacío si aplica a todas las provincias.</p>
                </div>

                <div>
                    <x-label class="mt-2">Ciudad</x-label>
                    <x-input class="w-full" name="city" value="{{ old('city', $zone->city) }}"
                        placeholder="Ej: Quito" />
                    <p class="mt-1 text-xs text-slate-500">Déjalo vacío si aplica a toda la provincia.</p>
                </div>

                <div>
                    <x-label class="mt-2">Costo <span class="text-red-500">*</span></x-label>
                    <x-input class="w-full" name="price" type="number" step="0.01"
                        value="{{ old('price', $zone->price ?? 0) }}" required />
                </div>

                <div class="flex items-center gap-2 pt-8">
                    <x-checkbox name="is_active" :checked="(bool) old('is_active', $zone->is_active ?? true)" />
                    <x-label>Tarifa activa</x-label>
                </div>

                <div class="flex items-center gap-2 pt-8">
                    <x-checkbox name="is_default" :checked="(bool) old('is_default', $zone->is_default ?? false)" />
                    <x-label>Tarifa predeterminada</x-label>
                </div>
            </div>

            <div class="mt-6 flex justify-end gap-3">
                <a href="{{ route('admin.settings.shipping-zones.index') }}" class="btn btn-secondary">Cancelar</a>
                <x-button>Guardar</x-button>
            </div>
        </form>
    </div>

</x-admin-layout>
