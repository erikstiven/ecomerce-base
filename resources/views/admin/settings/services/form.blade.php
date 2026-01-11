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
        'name' => 'Servicios',
        'route' => route('admin.settings.company.services.index'),
    ],
    [
        'name' => $service->exists ? 'Editar' : 'Nuevo',
    ],
]">

    <div class="card-form">
        <h1 class="mb-4 text-lg font-semibold text-slate-700">
            {{ $service->exists ? 'Editar servicio' : 'Nuevo servicio' }}
        </h1>

        <form method="POST"
            action="{{ $service->exists ? route('admin.settings.company.services.update', $service) : route('admin.settings.company.services.store') }}"
            enctype="multipart/form-data">
            @csrf
            @if ($service->exists)
                @method('PUT')
            @endif

            <x-validation-errors class="mb-4" />

            <div class="grid gap-6 md:grid-cols-2">
                <div class="md:col-span-2">
                    <x-label class="mt-2">Título</x-label>
                    <x-input class="w-full" name="title" value="{{ old('title', $service->title) }}" />
                </div>

                <div class="md:col-span-2">
                    <x-label class="mt-2">Descripción</x-label>
                    <x-textarea class="w-full" name="description" rows="4">{{ old('description', $service->description) }}</x-textarea>
                </div>

                <div class="md:col-span-2">
                    <x-label class="mt-2">Icono o imagen (opcional)</x-label>
                    <x-input class="w-full" name="image" type="file" accept="image/*" />
                    <p class="mt-1 text-xs text-slate-500">Si no subes imagen, se mostrará un ícono por defecto.</p>
                    @if ($service->image_path)
                        @php
                            $serviceImageUrl = \Illuminate\Support\Facades\Storage::disk('public')->exists($service->image_path)
                                ? \Illuminate\Support\Facades\Storage::url($service->image_path)
                                : asset('img/image_placeholder.jpg');
                        @endphp
                        <div class="mt-3 flex items-center gap-3 text-xs text-slate-600">
                            <img class="h-12 w-auto" src="{{ $serviceImageUrl }}" alt="Imagen del servicio" />
                            <span>Imagen actual</span>
                        </div>
                    @endif
                </div>

                <div>
                    <x-label class="mt-2">Orden</x-label>
                    <x-input class="w-full" name="sort_order" type="number"
                        value="{{ old('sort_order', $service->sort_order ?? 0) }}" />
                </div>

                <div class="flex items-center gap-2 pt-8">
                    <input type="checkbox" name="is_active" value="1" class="rounded border-slate-300"
                        {{ old('is_active', $service->is_active) ? 'checked' : '' }}>
                    <span class="text-sm text-slate-700">Activo</span>
                </div>
            </div>

            <div class="mt-6 flex justify-end gap-3">
                <a href="{{ route('admin.settings.company.services.index') }}" class="btn btn-secondary">Cancelar</a>
                <x-button>Guardar</x-button>
            </div>
        </form>
    </div>

</x-admin-layout>
