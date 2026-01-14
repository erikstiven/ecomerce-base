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

    <div class="card-form space-y-8">
        <div>
            <div class="mb-4 flex items-center justify-between">
                <h1 class="text-lg font-semibold text-slate-700">Preguntas frecuentes</h1>
                <a href="{{ route('admin.settings.company.faqs.create') }}" class="btn-gradient-blue">Nueva pregunta</a>
            </div>

            @if (session('status'))
                <div class="mb-4 rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700">
                    {{ session('status') }}
                </div>
            @endif
        </div>

        <section>
            <h2 class="text-sm font-semibold text-slate-700">Sección en la landing</h2>
            <form method="POST" action="{{ route('admin.settings.company.faqs.settings') }}" class="mt-4">
                @csrf
                @method('PUT')

                <x-validation-errors class="mb-4" />

                <div class="grid gap-6 md:grid-cols-2">
                    <div class="md:col-span-2 flex items-center gap-2">
                        <x-checkbox name="faq_show_section" :checked="old('faq_show_section', $settings?->faq_show_section ?? true)" />
                        <x-label>Mostrar bloque de FAQ</x-label>
                    </div>

                    <div class="md:col-span-2">
                        <x-label class="mt-2">Título de sección</x-label>
                        <x-input class="w-full" name="faq_title" value="{{ old('faq_title', $settings?->faq_title) }}" />
                        <p class="mt-1 text-xs text-slate-500">Ejemplo: Preguntas frecuentes.</p>
                    </div>

                    <div class="md:col-span-2">
                        <x-label class="mt-2">Texto introductorio</x-label>
                        <x-textarea class="w-full" name="faq_content" rows="3">{{ old('faq_content', $settings?->faq_content) }}</x-textarea>
                        <p class="mt-1 text-xs text-slate-500">Resumen corto para contextualizar las preguntas.</p>
                    </div>
                </div>

                <div class="mt-6 flex justify-end">
                    <x-button>Guardar configuración</x-button>
                </div>
            </form>
        </section>

        <section>
            <h2 class="text-sm font-semibold text-slate-700">Listado de preguntas</h2>
            <div class="mt-4 overflow-x-auto">
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
                                    <div class="flex items-center justify-end space-x-2">
                                        <a href="{{ route('admin.settings.company.faqs.edit', $faq) }}">
                                            <img src="{{ asset('img/icons/boligrafo.png') }}" class="w-6 h-6" alt="Editar">
                                        </a>
                                        <form method="POST"
                                            action="{{ route('admin.settings.company.faqs.destroy', $faq) }}"
                                            onsubmit="return confirm('¿Eliminar esta pregunta?');">
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
                                    No hay preguntas registradas.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>
    </div>

</x-admin-layout>
