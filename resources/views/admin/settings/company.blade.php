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
]">

    <div class="card-form">
        @if (session('status'))
            <div class="mb-4 rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('admin.settings.company.update') }}">
            @csrf
            @method('PUT')

            <x-validation-errors class="mb-4" />

            <div class="space-y-8">
                <section>
                    <h2 class="text-sm font-semibold text-slate-700">Sobre nosotros</h2>
                    <div class="mt-4 grid gap-6 md:grid-cols-2">
                        <div class="md:col-span-2">
                            <x-label class="mt-2">Título</x-label>
                            <x-input class="w-full" name="about_title" value="{{ old('about_title', $settings?->about_title) }}" />
                        </div>
                        <div class="md:col-span-2">
                            <x-label class="mt-2">Descripción corta</x-label>
                            <x-textarea class="w-full" name="about_intro" rows="3">{{ old('about_intro', $settings?->about_intro) }}</x-textarea>
                        </div>
                        <div class="md:col-span-2">
                            <x-label class="mt-2">Quiénes somos</x-label>
                            <x-textarea class="w-full" name="about_who" rows="4">{{ old('about_who', $settings?->about_who) }}</x-textarea>
                        </div>
                        <div class="md:col-span-2">
                            <x-label class="mt-2">Diferenciales</x-label>
                            <x-textarea class="w-full" name="about_differentials" rows="4">{{ old('about_differentials', $settings?->about_differentials) }}</x-textarea>
                        </div>
                        <div class="md:col-span-2">
                            <x-label class="mt-2">Proceso</x-label>
                            <x-textarea class="w-full" name="about_process" rows="4">{{ old('about_process', $settings?->about_process) }}</x-textarea>
                        </div>
                    </div>
                </section>

                <section>
                    <h2 class="text-sm font-semibold text-slate-700">Legales</h2>
                    <div class="mt-4 grid gap-6 md:grid-cols-2">
                        <div class="md:col-span-2">
                            <x-label class="mt-2">Términos y condiciones</x-label>
                            <x-textarea class="w-full" name="legal_terms_content" rows="6">{{ old('legal_terms_content', $settings?->legal_terms_content) }}</x-textarea>
                        </div>
                        <div class="md:col-span-2">
                            <x-label class="mt-2">Política de privacidad</x-label>
                            <x-textarea class="w-full" name="legal_privacy_content" rows="6">{{ old('legal_privacy_content', $settings?->legal_privacy_content) }}</x-textarea>
                        </div>
                        <div class="md:col-span-2">
                            <x-label class="mt-2">Política de devoluciones</x-label>
                            <x-textarea class="w-full" name="legal_returns_content" rows="6">{{ old('legal_returns_content', $settings?->legal_returns_content) }}</x-textarea>
                        </div>
                    </div>
                </section>
            </div>

            <div class="mt-6 flex justify-end">
                <x-button>Guardar</x-button>
            </div>
        </form>
    </div>

</x-admin-layout>
