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
                    <x-label class="mt-2">Pregunta</x-label>
                    <x-input class="w-full" name="question" value="{{ old('question', $faq->question) }}" />
                </div>

                <div class="md:col-span-2">
                    <x-label class="mt-2">Respuesta</x-label>
                    <x-textarea class="w-full" name="answer" rows="5">{{ old('answer', $faq->answer) }}</x-textarea>
                </div>

                <div>
                    <x-label class="mt-2">Orden</x-label>
                    <x-input class="w-full" name="sort_order" type="number"
                        value="{{ old('sort_order', $faq->sort_order ?? 0) }}" />
                </div>

                <div class="flex items-center gap-2 pt-8">
                    <input type="checkbox" name="is_active" value="1" class="rounded border-slate-300"
                        {{ old('is_active', $faq->is_active) ? 'checked' : '' }}>
                    <span class="text-sm text-slate-700">Activo</span>
                </div>
            </div>

            <div class="mt-6 flex justify-end gap-3">
                <a href="{{ route('admin.settings.company.faqs.index') }}" class="btn btn-secondary">Cancelar</a>
                <x-button>Guardar</x-button>
            </div>
        </form>
    </div>

</x-admin-layout>
