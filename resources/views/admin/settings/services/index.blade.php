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
    ],
]">

    <div class="card-form space-y-8">
        <div>
            <div class="mb-4 flex items-center justify-between">
                <h1 class="text-lg font-semibold text-slate-700">Servicios</h1>
                <a href="{{ route('admin.settings.company.services.create') }}" class="btn-gradient-blue">Nuevo servicio</a>
            </div>

            @if (session('status'))
                <div class="mb-4 rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700">
                    {{ session('status') }}
                </div>
            @endif
        </div>

        <section>
            <h2 class="text-sm font-semibold text-slate-700">Sección en la landing</h2>
            <p class="mt-2 text-xs text-slate-500">Los campos con <span class="font-semibold text-red-500">*</span> son obligatorios cuando el bloque está activo.</p>
            <form method="POST" action="{{ route('admin.settings.company.services.settings') }}" class="mt-4">
                @csrf
                @method('PUT')

                <x-validation-errors class="mb-4" />

                <div class="grid gap-6 md:grid-cols-2">
                    <div class="md:col-span-2 flex items-center gap-2">
                        <x-checkbox name="services_show_section" :checked="(bool) old('services_show_section', $settings?->services_show_section ?? true)" />
                        <x-label>Mostrar sección de servicios</x-label>
                    </div>

                    <div class="md:col-span-2">
                        <x-label class="mt-2">Título de sección <span class="text-red-500">*</span></x-label>
                        <x-input class="w-full" name="services_title" value="{{ old('services_title', $settings?->services_title) }}"
                            placeholder="Ej: Nuestros servicios" />
                    </div>

                    <div class="md:col-span-2">
                        <x-label class="mt-2">Descripción introductoria <span class="text-red-500">*</span></x-label>
                        <x-textarea class="w-full" name="services_intro" rows="3"
                            placeholder="Ej: Te acompañamos con soluciones a medida.">{{ old('services_intro', $settings?->services_intro) }}</x-textarea>
                    </div>

                    <div class="md:col-span-2 flex items-center gap-2">
                        <x-checkbox name="services_show_cta" :checked="(bool) old('services_show_cta', $settings?->services_show_cta ?? true)" />
                        <x-label>Mostrar llamado a la acción</x-label>
                    </div>

                    <div>
                        <x-label class="mt-2">Texto del botón <span class="text-red-500">*</span></x-label>
                        <x-input class="w-full" name="services_cta_label" value="{{ old('services_cta_label', $settings?->services_cta_label) }}"
                            placeholder="Ej: Solicitar asesoría" />
                    </div>

                    <div>
                        <x-label class="mt-2">Enlace del botón <span class="text-red-500">*</span></x-label>
                        <x-input class="w-full" name="services_cta_url" value="{{ old('services_cta_url', $settings?->services_cta_url) }}"
                            placeholder="https://tutienda.com/contacto" />
                    </div>
                </div>

                <div class="mt-6 flex justify-end">
                    <x-button>Guardar configuración</x-button>
                </div>
            </form>
        </section>

        <section>
            <h2 class="text-sm font-semibold text-slate-700">Listado de servicios</h2>
            <div class="mt-4 overflow-x-auto">
                <table class="min-w-full text-sm">
                    <thead class="bg-slate-50 text-left text-slate-600">
                        <tr>
                            <th class="px-4 py-3">Título</th>
                            <th class="px-4 py-3">Activo</th>
                            <th class="px-4 py-3">Orden</th>
                            <th class="px-4 py-3 text-right">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse ($services as $service)
                            <tr>
                                <td class="px-4 py-3 font-medium text-slate-700">{{ $service->title }}</td>
                                <td class="px-4 py-3">
                                    {{ $service->is_active ? 'Sí' : 'No' }}
                                </td>
                                <td class="px-4 py-3">{{ $service->sort_order }}</td>
                                <td class="px-4 py-3 text-right">
                                    <div class="flex items-center justify-end space-x-2">
                                        <a href="{{ route('admin.settings.company.services.edit', $service) }}">
                                            <img src="{{ asset('img/icons/boligrafo.png') }}" class="w-6 h-6" alt="Editar">
                                        </a>
                                        <form method="POST"
                                            action="{{ route('admin.settings.company.services.destroy', $service) }}"
                                            onsubmit="return confirm('¿Eliminar este servicio?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit">
                                                <img src="{{ asset('img/icons/eliminar.png') }}" class="w-6 h-6" alt="Eliminar">
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="px-4 py-6 text-center text-slate-500" colspan="4">
                                    No hay servicios creados.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>
    </div>

</x-admin-layout>
