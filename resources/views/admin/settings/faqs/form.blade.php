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
        'route' => route('admin.settings.company.faqs.index'),
    ],
    [
        'name' => $faq->exists ? 'Editar' : 'Nuevo',
    ],
]">

    <div class="card-form">
        <h1 class="mb-4 text-lg font-semibold text-slate-700">
            {{ $faq->exists ? 'Editar pregunta' : 'Nueva pregunta' }}
        </h1>

        <form method="POST"
            action="{{ $faq->exists ? route('admin.settings.company.faqs.update', $faq) : route('admin.settings.company.faqs.store') }}">
            @csrf
            @if ($faq->exists)
                @method('PUT')
            @endif

            <x-validation-errors class="mb-4" />

            <div class="grid gap-6 md:grid-cols-2">
                <div class="md:col-span-2">
                    <x-label class="mt-2">Pregunta <span class="text-red-500">*</span></x-label>
                    <x-input class="w-full" name="question" value="{{ old('question', $faq->question) }}" required
                        placeholder="Ej: ¿Cuál es el tiempo de entrega?" />
                    <p class="mt-1 text-xs text-slate-500">Escribe la duda principal del cliente.</p>
                </div>

                <div class="md:col-span-2">
                    <x-label class="mt-2">Respuesta <span class="text-red-500">*</span></x-label>
                    <x-textarea class="w-full" name="answer" rows="5" required
                        placeholder="Ej: Entregamos en 24-48 horas hábiles.">{{ old('answer', $faq->answer) }}</x-textarea>
                    <p class="mt-1 text-xs text-slate-500">Usa un texto claro y directo para resolver la duda.</p>
                </div>

                <div>
                    <x-label class="mt-2">Orden</x-label>
                    <x-input class="w-full" name="sort_order" type="number"
                        value="{{ old('sort_order', $faq->sort_order ?? 0) }}" />
                    <p class="mt-1 text-xs text-slate-500">Controla el orden de aparición en la landing.</p>
                </div>

                <div class="flex items-center gap-2 pt-8">
                    <input type="checkbox" name="is_active" value="1" class="rounded border-slate-300"
                        {{ old('is_active', $faq->is_active) ? 'checked' : '' }}>
                    <span class="text-sm text-slate-700">Mostrar pregunta en la landing</span>
                </div>
            </div>

            <div class="mt-6 flex justify-end gap-3">
                <a href="{{ route('admin.settings.company.faqs.index') }}" class="btn btn-secondary">Cancelar</a>
                <x-button>Guardar</x-button>
            </div>
        </form>
    </div>

</x-admin-layout>
