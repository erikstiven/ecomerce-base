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

    <div class="card-form">
        <div class="mb-4 flex items-center justify-between">
            <h1 class="text-lg font-semibold text-slate-700">Servicios</h1>
            <a href="{{ route('admin.settings.company.services.create') }}" class="btn-gradient-blue">Nuevo servicio</a>
        </div>

        @if (session('status'))
            <div class="mb-4 rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700">
                {{ session('status') }}
            </div>
        @endif

        <div class="overflow-x-auto">
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
    </div>

</x-admin-layout>
