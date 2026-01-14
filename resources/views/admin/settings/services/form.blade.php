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
            action="{{ $service->exists ? route('admin.settings.company.services.update', $service) : route('admin.settings.company.services.store') }}">
            @csrf
            @if ($service->exists)
                @method('PUT')
            @endif

            <x-validation-errors class="mb-4" />

            <div class="grid gap-6 md:grid-cols-2">
                <div class="md:col-span-2">
                    <x-label class="mt-2">Nombre del servicio</x-label>
                    <x-input class="w-full" name="title" value="{{ old('title', $service->title) }}" required />
                    <p class="mt-1 text-xs text-slate-500">Usa un nombre corto y claro para identificar el servicio.</p>
                </div>

                <div class="md:col-span-2">
                    <x-label class="mt-2">Descripción del servicio</x-label>
                    <x-textarea class="w-full" name="description" rows="4" required>{{ old('description', $service->description) }}</x-textarea>
                    <p class="mt-1 text-xs text-slate-500">Describe en una o dos frases lo que incluye este servicio.</p>
                </div>

                <div class="md:col-span-2">
                    <x-label class="mt-2">URL de la imagen del servicio</x-label>
                    <x-input class="w-full" name="image_path" value="{{ old('image_path', $service->image_path) }}" required />
                    <p class="mt-1 text-xs text-slate-500">Pega un enlace directo (https://...) a la imagen que debe mostrarse.</p>
                    @if ($service->image_path)
                        <div class="mt-3 flex items-center gap-3 text-xs text-slate-600">
                            <img class="h-12 w-auto" src="{{ $service->image_path }}" alt="Imagen del servicio" />
                            <span>Imagen actual</span>
                        </div>
                    @endif
                </div>

                <div>
                    <x-label class="mt-2">Orden</x-label>
                    <x-input class="w-full" name="sort_order" type="number"
                        value="{{ old('sort_order', $service->sort_order ?? 0) }}" />
                    <p class="mt-1 text-xs text-slate-500">Define el orden de aparición en la landing.</p>
                </div>

                <div class="flex items-center gap-2 pt-8">
                    <input type="checkbox" name="is_active" value="1" class="rounded border-slate-300"
                        {{ old('is_active', $service->is_active) ? 'checked' : '' }}>
                    <span class="text-sm text-slate-700">Mostrar servicio en la landing</span>
                </div>
            </div>

            <div class="mt-6 flex justify-end gap-3">
                <a href="{{ route('admin.settings.company.services.index') }}" class="btn btn-secondary">Cancelar</a>
                <x-button>Guardar</x-button>
            </div>
        </form>
    </div>

</x-admin-layout>
