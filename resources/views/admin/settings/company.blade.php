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
                        {{-- Header: eyebrow, title, lead --}}
                        <div class="md:col-span-2">
                            <x-label class="mt-2">Texto superior</x-label>
                            <x-input class="w-full" name="about_eyebrow" value="{{ old('about_eyebrow', $settings?->about_eyebrow) }}" />
                            <p class="mt-1 text-xs text-slate-500">Texto corto para identificar la sección.</p>
                        </div>
                        <div class="md:col-span-2">
                            <x-label class="mt-2">Título principal</x-label>
                            <x-input class="w-full" name="about_title" value="{{ old('about_title', $settings?->about_title) }}" />
                        </div>
                        <div class="md:col-span-2">
                            <x-label class="mt-2">Descripción corta</x-label>
                            <x-textarea class="w-full" name="about_lead" rows="3">{{ old('about_lead', $settings?->about_lead) }}</x-textarea>
                        </div>

                        {{-- Narrative: mission, story --}}
                        <div class="md:col-span-2">
                            <div class="flex items-center gap-2">
                                <x-checkbox name="about_show_narrative" :checked="old('about_show_narrative', $settings?->about_show_narrative ?? true)" />
                                <x-label>Mostrar bloque narrativo</x-label>
                            </div>
                        </div>
                        <div class="md:col-span-2">
                            <x-label class="mt-2">Misión</x-label>
                            <x-textarea class="w-full" name="about_mission" rows="3">{{ old('about_mission', $settings?->about_mission) }}</x-textarea>
                        </div>
                        <div class="md:col-span-2">
                            <x-label class="mt-2">Historia</x-label>
                            <x-textarea class="w-full" name="about_story" rows="3">{{ old('about_story', $settings?->about_story) }}</x-textarea>
                        </div>

                        {{-- CTA: label, url, supporting text --}}
                        <div class="md:col-span-2">
                            <div class="flex items-center gap-2">
                                <x-checkbox name="about_show_cta" :checked="old('about_show_cta', $settings?->about_show_cta ?? true)" />
                                <x-label>Mostrar botón principal</x-label>
                            </div>
                        </div>
                        <div>
                            <x-label class="mt-2">Texto del botón</x-label>
                            <x-input class="w-full" name="about_cta_label" value="{{ old('about_cta_label', $settings?->about_cta_label) }}" />
                        </div>
                        <div>
                            <x-label class="mt-2">Enlace del botón</x-label>
                            <x-input class="w-full" name="about_cta_url" value="{{ old('about_cta_url', $settings?->about_cta_url) }}" />
                        </div>
                        <div class="md:col-span-2">
                            <x-label class="mt-2">Texto complementario</x-label>
                            <x-input class="w-full" name="about_supporting" value="{{ old('about_supporting', $settings?->about_supporting) }}" />
                        </div>

                        {{-- Stats: list of value + description --}}
                        <div class="md:col-span-2">
                            <div class="flex items-center gap-2">
                                <x-checkbox name="about_show_stats" :checked="old('about_show_stats', $settings?->about_show_stats ?? true)" />
                                <x-label>Mostrar stats</x-label>
                            </div>
                            <x-label class="mt-2">Indicadores (una línea por ítem)</x-label>
                            <x-textarea class="w-full" name="about_stats" rows="4">{{ old('about_stats', $settings?->about_stats) }}</x-textarea>
                            <p class="mt-1 text-xs text-slate-500">Formato: Valor | Descripción (ejemplo: Atención cercana | Acompañamiento en cada etapa).</p>
                        </div>

                        {{-- Image: src, alt, caption --}}
                        <div class="md:col-span-2">
                            <div class="flex items-center gap-2">
                                <x-checkbox name="about_show_image" :checked="old('about_show_image', $settings?->about_show_image ?? true)" />
                                <x-label>Mostrar imagen</x-label>
                            </div>
                        </div>
                        <div class="md:col-span-2">
                            <x-label class="mt-2">URL de la imagen</x-label>
                            <x-input class="w-full" name="about_image_src" value="{{ old('about_image_src', $settings?->about_image_src) }}" />
                        </div>
                        <div>
                            <x-label class="mt-2">Alt de imagen</x-label>
                            <x-input class="w-full" name="about_image_alt" value="{{ old('about_image_alt', $settings?->about_image_alt) }}" />
                        </div>
                        <div>
                            <x-label class="mt-2">Caption de imagen</x-label>
                            <x-input class="w-full" name="about_image_caption" value="{{ old('about_image_caption', $settings?->about_image_caption) }}" />
                        </div>

                        {{-- Trust: title + list --}}
                        <div class="md:col-span-2">
                            <div class="flex items-center gap-2">
                                <x-checkbox name="about_show_trust" :checked="old('about_show_trust', $settings?->about_show_trust ?? true)" />
                                <x-label>Mostrar bloque de confianza</x-label>
                            </div>
                        </div>
                        <div class="md:col-span-2">
                            <x-label class="mt-2">Título de confianza</x-label>
                            <x-input class="w-full" name="about_trust_title" value="{{ old('about_trust_title', $settings?->about_trust_title) }}" />
                        </div>
                        <div class="md:col-span-2">
                            <x-label class="mt-2">Puntos de confianza (una línea por ítem)</x-label>
                            <x-textarea class="w-full" name="about_trust_items" rows="4">{{ old('about_trust_items', $settings?->about_trust_items) }}</x-textarea>
                        </div>

                        {{-- Values: list of title + description --}}
                        <div class="md:col-span-2">
                            <div class="flex items-center gap-2">
                                <x-checkbox name="about_show_values" :checked="old('about_show_values', $settings?->about_show_values ?? true)" />
                                <x-label>Mostrar valores</x-label>
                            </div>
                            <x-label class="mt-2">Valores (una línea por ítem)</x-label>
                            <x-textarea class="w-full" name="about_values" rows="4">{{ old('about_values', $settings?->about_values) }}</x-textarea>
                            <p class="mt-1 text-xs text-slate-500">Formato: Título | Descripción.</p>
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
