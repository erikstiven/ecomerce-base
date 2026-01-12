@props([
    'data' => null,
])

@php
    $defaults = [
        // Editable (admin): eyebrow (texto corto para identificar la sección, max 3-4 palabras)
        'eyebrow' => 'Sobre la tienda',
        // Editable (admin): title (headline principal, 5-9 palabras)
        'title' => 'Construimos experiencias de compra confiables',
        // Editable (admin): lead (bajada breve, 1-2 frases)
        'lead' => 'Acompañamos a cada negocio con una experiencia clara, cercana y adaptable a su etapa.',
        // Editable (admin): mission (párrafo corto, 2-3 líneas)
        'mission' => 'Creamos recorridos simples y seguros para que comprar sea fácil desde el primer clic.',
        // Editable (admin): story (párrafo corto, 2-3 líneas)
        'story' => 'Combinamos estrategia, diseño y soporte humano para responder a las necesidades de cada marca.',
        // Editable (admin): image (URL y texto alternativo de la imagen principal)
        'image' => [
            'src' => 'https://images.unsplash.com/photo-1521737604893-d14cc237f11d?auto=format&fit=crop&w=1400&q=80',
            'alt' => 'Equipo de ecommerce trabajando en conjunto',
            // Editable (admin): caption (texto de apoyo opcional, 5-8 palabras)
            'caption' => 'Equipo enfocado en soluciones personalizadas',
        ],
        // Editable (admin): cta (texto y destino del botón principal)
        'cta' => [
            'label' => 'Descubre cómo trabajamos',
            'url' => '#contacto',
        ],
        // Editable (admin): supporting (texto complementario opcional, 4-8 palabras)
        'supporting' => 'Compromiso con cada cliente',
        // Editable (admin): stats (lista de métricas destacadas)
        'stats' => [
            [
                'value' => 'Atención cercana',
                'label' => 'Acompañamiento en cada etapa',
            ],
            [
                'value' => 'Procesos claros',
                'label' => 'Información simple y transparente',
            ],
            [
                'value' => 'Compra confiable',
                'label' => 'Seguridad y confianza para tus clientes',
            ],
        ],
        // Editable (admin): values (lista de pilares de marca)
        'values' => [
            [
                'title' => 'Transparencia',
                'description' => 'Comunicación clara y accesible para clientes y equipos.',
            ],
            [
                'title' => 'Experiencia cuidada',
                'description' => 'Detalles pensados para generar confianza y fidelidad.',
            ],
            [
                'title' => 'Flexibilidad',
                'description' => 'Procesos que se ajustan a negocios nuevos o en crecimiento.',
            ],
        ],
        // Editable (admin): trust (título y lista de sellos/garantías)
        'trust' => [
            'title' => 'Confianza en cada paso',
            'items' => [
                'Pagos seguros y opciones visibles',
                'Políticas claras y fáciles de entender',
                'Acompañamiento antes y después de la compra',
            ],
        ],
        // Editable (admin): visibility (activar/desactivar bloques)
        'visibility' => [
            'narrative' => true,
            'stats' => true,
            'image' => true,
            'trust' => true,
            'values' => true,
            'cta' => true,
        ],
    ];

    $parsePairs = function (?string $raw, array $fallback, string $titleKey, string $descriptionKey): array {
        $lines = array_filter(array_map('trim', preg_split('/\r\n|\r|\n/', $raw ?? '')));

        if (empty($lines)) {
            return $fallback;
        }

        $items = [];

        foreach ($lines as $line) {
            [$title, $description] = array_map('trim', array_pad(explode('|', $line, 2), 2, ''));

            if ($title === '' && $description === '') {
                continue;
            }

            $items[] = [
                $titleKey => $title !== '' ? $title : $description,
                $descriptionKey => $description !== '' ? $description : '',
            ];
        }

        return $items ?: $fallback;
    };

    $parseList = function (?string $raw, array $fallback): array {
        $lines = array_filter(array_map('trim', preg_split('/\r\n|\r|\n/', $raw ?? '')));

        return $lines ?: $fallback;
    };

    $settings = [
        'eyebrow' => setting('about_eyebrow', $defaults['eyebrow']),
        'title' => setting('about_title', $defaults['title']),
        'lead' => setting('about_lead', $defaults['lead']),
        'mission' => setting('about_mission', $defaults['mission']),
        'story' => setting('about_story', $defaults['story']),
        'image' => [
            'src' => setting('about_image_src', $defaults['image']['src']),
            'alt' => setting('about_image_alt', $defaults['image']['alt']),
            'caption' => setting('about_image_caption', $defaults['image']['caption']),
        ],
        'cta' => [
            'label' => setting('about_cta_label', $defaults['cta']['label']),
            'url' => setting('about_cta_url', $defaults['cta']['url']),
        ],
        'supporting' => setting('about_supporting', $defaults['supporting']),
        'stats' => $parsePairs(setting('about_stats', ''), $defaults['stats'], 'value', 'label'),
        'values' => $parsePairs(setting('about_values', ''), $defaults['values'], 'title', 'description'),
        'trust' => [
            'title' => setting('about_trust_title', $defaults['trust']['title']),
            'items' => $parseList(setting('about_trust_items', ''), $defaults['trust']['items']),
        ],
        'visibility' => [
            'narrative' => (bool) setting('about_show_narrative', $defaults['visibility']['narrative']),
            'stats' => (bool) setting('about_show_stats', $defaults['visibility']['stats']),
            'image' => (bool) setting('about_show_image', $defaults['visibility']['image']),
            'trust' => (bool) setting('about_show_trust', $defaults['visibility']['trust']),
            'values' => (bool) setting('about_show_values', $defaults['visibility']['values']),
            'cta' => (bool) setting('about_show_cta', $defaults['visibility']['cta']),
        ],
    ];

    $about = array_replace_recursive($defaults, $settings);

    if ($data) {
        $about = array_replace_recursive($about, $data);
    }
@endphp

<section class="bg-white dark:bg-gray-900 py-16 sm:py-20">
    <x-container class="px-4 sm:px-6 lg:px-8">
        <div class="grid gap-12 lg:grid-cols-[1.1fr_0.9fr] lg:items-center">
            <div class="space-y-8">
                <div class="space-y-4">
                    <p class="text-sm font-semibold uppercase tracking-[0.2em] text-violet-600 dark:text-violet-300">
                        {{ $about['eyebrow'] }}
                    </p>
                    <h2 class="text-3xl font-bold text-gray-900 dark:text-white sm:text-4xl">
                        {{ $about['title'] }}
                    </h2>
                    <p class="text-lg text-gray-600 dark:text-gray-300">
                        {{ $about['lead'] }}
                    </p>
                </div>

                @if ($about['visibility']['narrative'])
                    <div class="space-y-4">
                        <p class="text-base text-gray-600 dark:text-gray-300">
                            {{ $about['mission'] }}
                        </p>
                        <p class="text-base text-gray-600 dark:text-gray-300">
                            {{ $about['story'] }}
                        </p>
                    </div>
                @endif

                <div class="flex flex-wrap gap-4">
                    @if ($about['visibility']['cta'])
                        <a href="{{ $about['cta']['url'] }}"
                            class="inline-flex items-center justify-center rounded-full bg-violet-600 px-6 py-3 text-sm font-semibold text-white shadow-lg shadow-violet-600/20 transition hover:bg-violet-700">
                            {{ $about['cta']['label'] }}
                        </a>
                    @endif
                    <div class="flex items-center gap-2 text-sm font-medium text-gray-500 dark:text-gray-300">
                        <span class="inline-flex h-10 w-10 items-center justify-center rounded-full bg-violet-100 text-violet-600 dark:bg-violet-500/20 dark:text-violet-200">
                            ★
                        </span>
                        {{ $about['supporting'] }}
                    </div>
                </div>

                @if ($about['visibility']['stats'])
                    <dl class="grid gap-6 sm:grid-cols-3">
                        @foreach ($about['stats'] as $stat)
                            <div class="rounded-2xl border border-gray-100 bg-gray-50 p-5 text-center shadow-sm dark:border-gray-800 dark:bg-gray-800">
                                <dt class="text-2xl font-bold text-gray-900 dark:text-white">{{ $stat['value'] }}</dt>
                                <dd class="mt-1 text-sm text-gray-600 dark:text-gray-300">{{ $stat['label'] }}</dd>
                            </div>
                        @endforeach
                    </dl>
                @endif
            </div>

            <div class="space-y-6">
                @if ($about['visibility']['image'])
                    <div class="overflow-hidden rounded-3xl border border-gray-100 bg-gray-50 shadow-lg dark:border-gray-800 dark:bg-gray-800">
                        <img src="{{ $about['image']['src'] }}" alt="{{ $about['image']['alt'] }}"
                            class="h-80 w-full object-cover sm:h-[360px]" loading="lazy">
                        <div class="px-6 py-4 text-sm font-medium text-gray-600 dark:text-gray-300">
                            {{ $about['image']['caption'] }}
                        </div>
                    </div>
                @endif

                @if ($about['visibility']['trust'])
                    <div class="rounded-3xl border border-gray-100 bg-white p-6 shadow-sm dark:border-gray-800 dark:bg-gray-900">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">{{ $about['trust']['title'] }}</h3>
                        <ul class="mt-4 space-y-3 text-sm text-gray-600 dark:text-gray-300">
                            @foreach ($about['trust']['items'] as $item)
                                <li class="flex items-start gap-2">
                                    <span class="mt-1 inline-flex h-5 w-5 items-center justify-center rounded-full bg-emerald-100 text-emerald-600 dark:bg-emerald-500/20 dark:text-emerald-200">
                                        ✓
                                    </span>
                                    <span>{{ $item }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </div>

        @if ($about['visibility']['values'])
            <div class="mt-14 grid gap-6 md:grid-cols-3">
                @foreach ($about['values'] as $value)
                    <article class="rounded-3xl border border-gray-100 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-lg dark:border-gray-800 dark:bg-gray-900">
                        <h4 class="text-lg font-semibold text-gray-900 dark:text-white">{{ $value['title'] }}</h4>
                        <p class="mt-3 text-sm text-gray-600 dark:text-gray-300">{{ $value['description'] }}</p>
                    </article>
                @endforeach
            </div>
        @endif
    </x-container>
</section>
