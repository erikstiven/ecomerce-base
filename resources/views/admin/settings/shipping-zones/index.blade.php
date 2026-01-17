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
    ],
]">

    <div class="card-form space-y-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-lg font-semibold text-slate-700">Tarifas de envío</h1>
                <p class="text-xs text-slate-500">Define costos por provincia/ciudad y marca una tarifa por defecto.</p>
            </div>
            <a href="{{ route('admin.settings.shipping-zones.create') }}" class="btn-gradient-blue">Nueva tarifa</a>
        </div>

        @if (session('status'))
            <div class="rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700">
                {{ session('status') }}
            </div>
        @endif

        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead class="bg-slate-50 text-left text-slate-600">
                    <tr>
                        <th class="px-4 py-3">Nombre</th>
                        <th class="px-4 py-3">Provincia</th>
                        <th class="px-4 py-3">Ciudad</th>
                        <th class="px-4 py-3">Costo</th>
                        <th class="px-4 py-3">Estado</th>
                        <th class="px-4 py-3">Predeterminado</th>
                        <th class="px-4 py-3 text-right">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse ($zones as $zone)
                        <tr>
                            <td class="px-4 py-3 font-medium text-slate-700">{{ $zone->name }}</td>
                            <td class="px-4 py-3">{{ $zone->province ? ucwords($zone->province) : 'Todas' }}</td>
                            <td class="px-4 py-3">{{ $zone->city ? ucwords($zone->city) : 'Todas' }}</td>
                            <td class="px-4 py-3">${{ number_format((float) $zone->price, 2) }}</td>
                            <td class="px-4 py-3">{{ $zone->is_active ? 'Activa' : 'Inactiva' }}</td>
                            <td class="px-4 py-3">{{ $zone->is_default ? 'Sí' : 'No' }}</td>
                            <td class="px-4 py-3 text-right">
                                <div class="flex items-center justify-end space-x-2">
                                    <a href="{{ route('admin.settings.shipping-zones.edit', $zone) }}">
                                        <img src="{{ asset('img/icons/boligrafo.png') }}" class="h-6 w-6" alt="Editar">
                                    </a>
                                    <form method="POST"
                                        action="{{ route('admin.settings.shipping-zones.destroy', $zone) }}"
                                        onsubmit="return confirm('¿Eliminar esta tarifa?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit">
                                            <img src="{{ asset('img/icons/eliminar.png') }}" class="h-6 w-6" alt="Eliminar">
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="px-4 py-6 text-center text-slate-500" colspan="7">
                                No hay tarifas configuradas.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</x-admin-layout>
