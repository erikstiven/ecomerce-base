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
                    <p class="mt-2 text-xs text-slate-500">Los campos marcados con <span class="font-semibold text-red-500">*</span> son obligatorios cuando el bloque correspondiente está activo.</p>
                    <div class="mt-4 grid gap-6 md:grid-cols-2">
                        {{-- Header: eyebrow, title, lead --}}
                        <div class="md:col-span-2">
                            <x-label class="mt-2">Texto superior</x-label>
                            <x-input class="w-full" name="about_eyebrow" value="{{ old('about_eyebrow', $settings?->about_eyebrow) }}"
                                placeholder="Ej: Sobre la tienda" />
                            <p class="mt-1 text-xs text-slate-500">Etiqueta breve para presentar el bloque.</p>
                        </div>
                        <div class="md:col-span-2">
                            <x-label class="mt-2">Título principal <span class="text-red-500">*</span></x-label>
                            <x-input class="w-full" name="about_title" value="{{ old('about_title', $settings?->about_title) }}"
                                placeholder="Ej: Conoce nuestra historia" required />
                        </div>
                        <div class="md:col-span-2">
                            <x-label class="mt-2">Descripción corta</x-label>
                            <x-textarea class="w-full" name="about_lead" rows="3"
                                placeholder="Ej: Un resumen breve sobre lo que nos mueve.">{{ old('about_lead', $settings?->about_lead) }}</x-textarea>
                        </div>

                        {{-- Narrative: mission, story --}}
                        <div class="md:col-span-2">
                            <div class="flex items-center gap-2">
                                <x-checkbox name="about_show_narrative" :checked="(bool) old('about_show_narrative', $settings?->about_show_narrative ?? true)" />
                                <x-label>Mostrar bloque narrativo</x-label>
                            </div>
                            <p class="mt-1 text-xs text-slate-500">Actívalo para mostrar misión e historia.</p>
                        </div>
                        <div class="md:col-span-2">
                            <x-label class="mt-2">Misión <span class="text-red-500">*</span></x-label>
                            <x-textarea class="w-full" name="about_mission" rows="3"
                                placeholder="Ej: Brindar una experiencia cercana y confiable.">{{ old('about_mission', $settings?->about_mission) }}</x-textarea>
                        </div>
                        <div class="md:col-span-2">
                            <x-label class="mt-2">Historia <span class="text-red-500">*</span></x-label>
                            <x-textarea class="w-full" name="about_story" rows="3"
                                placeholder="Ej: Cómo iniciamos y qué nos inspira.">{{ old('about_story', $settings?->about_story) }}</x-textarea>
                        </div>

                        {{-- CTA: label, url, supporting text --}}
                        <div class="md:col-span-2">
                            <div class="flex items-center gap-2">
                                <x-checkbox name="about_show_cta" :checked="(bool) old('about_show_cta', $settings?->about_show_cta ?? true)" />
                                <x-label>Mostrar botón principal</x-label>
                            </div>
                            <p class="mt-1 text-xs text-slate-500">Recomendado para dirigir a la acción principal.</p>
                        </div>
                        <div>
                            <x-label class="mt-2">Texto del botón <span class="text-red-500">*</span></x-label>
                            <x-input class="w-full" name="about_cta_label" value="{{ old('about_cta_label', $settings?->about_cta_label) }}"
                                placeholder="Ej: Conoce nuestros productos" />
                        </div>
                        <div>
                            <x-label class="mt-2">Enlace del botón <span class="text-red-500">*</span></x-label>
                            <x-input class="w-full" name="about_cta_url" value="{{ old('about_cta_url', $settings?->about_cta_url) }}"
                                placeholder="https://tutienda.com/catalogo" />
                        </div>
                        <div class="md:col-span-2">
                            <x-label class="mt-2">Texto complementario</x-label>
                            <x-input class="w-full" name="about_supporting" value="{{ old('about_supporting', $settings?->about_supporting) }}"
                                placeholder="Ej: Respuesta en menos de 24 horas." />
                        </div>

                        {{-- Stats: list of value + description --}}
                        <div class="md:col-span-2">
                            <div class="flex items-center gap-2">
                                <x-checkbox name="about_show_stats" :checked="(bool) old('about_show_stats', $settings?->about_show_stats ?? true)" />
                                <x-label>Mostrar indicadores</x-label>
                            </div>
                            <x-label class="mt-2">Indicadores (una línea por ítem) <span class="text-red-500">*</span></x-label>
                            <x-textarea class="w-full" name="about_stats" rows="4"
                                placeholder="Ej: Atención cercana | Acompañamiento en cada etapa">{{ old('about_stats', $settings?->about_stats) }}</x-textarea>
                            <p class="mt-1 text-xs text-slate-500">Formato: Valor | Descripción.</p>
                        </div>

                        {{-- Image: src, alt, caption --}}
                        <div class="md:col-span-2">
                            <div class="flex items-center gap-2">
                                <x-checkbox name="about_show_image" :checked="(bool) old('about_show_image', $settings?->about_show_image ?? true)" />
                                <x-label>Mostrar imagen</x-label>
                            </div>
                            <p class="mt-1 text-xs text-slate-500">Agrega una imagen para reforzar el mensaje.</p>
                        </div>
                        <div class="md:col-span-2">
                            <x-label class="mt-2">URL de la imagen <span class="text-red-500">*</span></x-label>
                            <x-input class="w-full" name="about_image_src" value="{{ old('about_image_src', $settings?->about_image_src) }}"
                                placeholder="https://tutienda.com/imagenes/sobre-nosotros.jpg" />
                        </div>
                        <div>
                            <x-label class="mt-2">Alt de imagen</x-label>
                            <x-input class="w-full" name="about_image_alt" value="{{ old('about_image_alt', $settings?->about_image_alt) }}"
                                placeholder="Ej: Equipo trabajando en tienda" />
                            <p class="mt-1 text-xs text-slate-500">Texto alternativo para accesibilidad.</p>
                        </div>
                        <div>
                            <x-label class="mt-2">Caption de imagen</x-label>
                            <x-input class="w-full" name="about_image_caption" value="{{ old('about_image_caption', $settings?->about_image_caption) }}"
                                placeholder="Ej: Nuestro equipo en acción." />
                        </div>

                        {{-- Trust: title + list --}}
                        <div class="md:col-span-2">
                            <div class="flex items-center gap-2">
                                <x-checkbox name="about_show_trust" :checked="(bool) old('about_show_trust', $settings?->about_show_trust ?? true)" />
                                <x-label>Mostrar bloque de confianza</x-label>
                            </div>
                        </div>
                        <div class="md:col-span-2">
                            <x-label class="mt-2">Título de confianza <span class="text-red-500">*</span></x-label>
                            <x-input class="w-full" name="about_trust_title" value="{{ old('about_trust_title', $settings?->about_trust_title) }}"
                                placeholder="Ej: ¿Por qué confiar en nosotros?" />
                        </div>
                        <div class="md:col-span-2">
                            <x-label class="mt-2">Puntos de confianza (una línea por ítem) <span class="text-red-500">*</span></x-label>
                            <x-textarea class="w-full" name="about_trust_items" rows="4"
                                placeholder="Ej: Pagos seguros | Soporte personalizado">{{ old('about_trust_items', $settings?->about_trust_items) }}</x-textarea>
                            <p class="mt-1 text-xs text-slate-500">Formato: Título | Descripción.</p>
                        </div>

                        {{-- Values: list of title + description --}}
                        <div class="md:col-span-2">
                            <div class="flex items-center gap-2">
                                <x-checkbox name="about_show_values" :checked="(bool) old('about_show_values', $settings?->about_show_values ?? true)" />
                                <x-label>Mostrar valores</x-label>
                            </div>
                            <x-label class="mt-2">Valores (una línea por ítem) <span class="text-red-500">*</span></x-label>
                            <x-textarea class="w-full" name="about_values" rows="4"
                                placeholder="Ej: Cercanía | Nos importa cada cliente">{{ old('about_values', $settings?->about_values) }}</x-textarea>
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
