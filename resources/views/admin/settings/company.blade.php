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
                    <h2 class="text-sm font-semibold text-slate-700">Ubicación</h2>
                    <div class="mt-4 grid gap-6 md:grid-cols-2">
                        <div class="md:col-span-2">
                            <x-label class="mt-2">Título</x-label>
                            <x-input class="w-full" name="location_title"
                                value="{{ old('location_title', $settings?->location_title) }}" />
                        </div>
                        <div class="md:col-span-2">
                            <x-label class="mt-2">Descripción</x-label>
                            <x-textarea class="w-full" name="location_description" rows="3">{{ old('location_description', $settings?->location_description) }}</x-textarea>
                        </div>
                        <div class="md:col-span-2">
                            <x-label class="mt-2">Mapa (iframe embed)</x-label>
                            <x-textarea class="w-full" name="location_map_embed" rows="4">{{ old('location_map_embed', $settings?->location_map_embed) }}</x-textarea>
                        </div>
                        <div class="md:col-span-2">
                            <x-label class="mt-2">Dirección</x-label>
                            <x-textarea class="w-full" name="location_address" rows="3">{{ old('location_address', $settings?->location_address) }}</x-textarea>
                        </div>
                        <div class="md:col-span-2">
                            <x-label class="mt-2">Horario</x-label>
                            <x-textarea class="w-full" name="location_hours" rows="3">{{ old('location_hours', $settings?->location_hours) }}</x-textarea>
                        </div>
                        <div>
                            <x-label class="mt-2">Email de contacto</x-label>
                            <x-input class="w-full" name="location_email"
                                value="{{ old('location_email', $settings?->location_email) }}" />
                        </div>
                        <div>
                            <x-label class="mt-2">Teléfono principal</x-label>
                            <x-input class="w-full" name="location_phone_primary"
                                value="{{ old('location_phone_primary', $settings?->location_phone_primary) }}" />
                        </div>
                        <div>
                            <x-label class="mt-2">Teléfono secundario</x-label>
                            <x-input class="w-full" name="location_phone_secondary"
                                value="{{ old('location_phone_secondary', $settings?->location_phone_secondary) }}" />
                        </div>
                        <div>
                            <x-label class="mt-2">Teléfono ventas</x-label>
                            <x-input class="w-full" name="location_phone_sales"
                                value="{{ old('location_phone_sales', $settings?->location_phone_sales) }}" />
                        </div>
                    </div>
                </section>

                <section>
                    <h2 class="text-sm font-semibold text-slate-700">Preguntas frecuentes</h2>
                    <div class="mt-4 grid gap-6 md:grid-cols-2">
                        <div class="md:col-span-2">
                            <x-label class="mt-2">Título</x-label>
                            <x-input class="w-full" name="faq_title" value="{{ old('faq_title', $settings?->faq_title) }}" />
                        </div>
                        <div class="md:col-span-2">
                            <x-label class="mt-2">Contenido</x-label>
                            <x-textarea class="w-full" name="faq_content" rows="6">{{ old('faq_content', $settings?->faq_content) }}</x-textarea>
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
