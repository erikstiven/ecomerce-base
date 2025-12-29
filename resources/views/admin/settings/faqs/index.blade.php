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
        'name' => 'FAQ',
    ],
]">

    <div class="card-form">
        <div class="mb-4 flex items-center justify-between">
            <h1 class="text-lg font-semibold text-slate-700">Preguntas frecuentes</h1>
            <a href="{{ route('admin.settings.company.faqs.create') }}" class="btn btn-primary">Nueva pregunta</a>
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
                        <th class="px-4 py-3">Pregunta</th>
                        <th class="px-4 py-3">Activo</th>
                        <th class="px-4 py-3">Orden</th>
                        <th class="px-4 py-3 text-right">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse ($faqs as $faq)
                        <tr>
                            <td class="px-4 py-3 font-medium text-slate-700">{{ $faq->question }}</td>
                            <td class="px-4 py-3">{{ $faq->is_active ? 'Sí' : 'No' }}</td>
                            <td class="px-4 py-3">{{ $faq->sort_order }}</td>
                            <td class="px-4 py-3 text-right">
                                <a class="text-indigo-600 hover:underline"
                                    href="{{ route('admin.settings.company.faqs.edit', $faq) }}">Editar</a>
                                <form class="inline" method="POST"
                                    action="{{ route('admin.settings.company.faqs.destroy', $faq) }}"
                                    onsubmit="return confirm('¿Eliminar esta pregunta?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="ml-3 text-rose-600 hover:underline" type="submit">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="px-4 py-6 text-center text-slate-500" colspan="4">
                                No hay preguntas registradas.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</x-admin-layout>
