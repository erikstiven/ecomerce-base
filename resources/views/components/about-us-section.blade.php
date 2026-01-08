@props([
    'data' => null,
])

@php
    $about = $data ?? [
        // Editable (admin): eyebrow (texto corto para identificar la sección, max 3-4 palabras)
        'eyebrow' => 'Sobre nosotros',
        // Editable (admin): title (headline principal, 5-9 palabras)
        'title' => 'Impulsamos tiendas que venden más',
        // Editable (admin): lead (bajada breve, 1-2 frases)
        'lead' => 'Somos el socio digital de marcas que buscan crecer con confianza, experiencia y una operación impecable.',
        // Editable (admin): mission (párrafo corto, 2-3 líneas)
        'mission' => 'Diseñamos experiencias de compra claras, rápidas y seguras para que cada visita se convierta en una venta.',
        // Editable (admin): story (párrafo corto, 2-3 líneas)
        'story' => 'Unimos estrategia, tecnología y un equipo cercano que entiende lo que necesita tu negocio en cada etapa.',
        // Editable (admin): image (URL y texto alternativo de la imagen principal)
        'image' => [
            'src' => 'https://images.unsplash.com/photo-1521737604893-d14cc237f11d?auto=format&fit=crop&w=1400&q=80',
            'alt' => 'Equipo de ecommerce trabajando en conjunto',
            // Editable (admin): caption (texto de apoyo opcional, 5-8 palabras)
            'caption' => 'Equipo experto en crecimiento digital',
        ],
        // Editable (admin): cta (texto y destino del botón principal)
        'cta' => [
            'label' => 'Conoce nuestra historia',
            'url' => '#contacto',
        ],
        // Editable (admin): stats (lista de métricas destacadas)
        'stats' => [
            [
                'value' => '+2.500',
                'label' => 'Clientes activos en LATAM',
            ],
            [
                'value' => '24/7',
                'label' => 'Soporte cercano y humano',
            ],
            [
                'value' => '98%',
                'label' => 'Satisfacción en entregas',
            ],
        ],
        // Editable (admin): values (lista de pilares de marca)
        'values' => [
            [
                'title' => 'Transparencia total',
                'description' => 'Comunicación clara, métricas visibles y acompañamiento continuo.',
            ],
            [
                'title' => 'Experiencia premium',
                'description' => 'Cada detalle está pensado para que tus clientes confíen y vuelvan.',
            ],
            [
                'title' => 'Eficiencia operativa',
                'description' => 'Procesos ágiles que reducen fricción y aceleran tu crecimiento.',
            ],
        ],
        // Editable (admin): trust (título y lista de sellos/garantías)
        'trust' => [
            'title' => 'Compras seguras en cada paso',
            'items' => [
                'Pagos protegidos con cifrado SSL',
                'Políticas de cambio claras y visibles',
                'Logística confiable con tracking en tiempo real',
            ],
        ],
    ];
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

                <div class="space-y-4">
                    <p class="text-base text-gray-600 dark:text-gray-300">
                        {{ $about['mission'] }}
                    </p>
                    <p class="text-base text-gray-600 dark:text-gray-300">
                        {{ $about['story'] }}
                    </p>
                </div>

                <div class="flex flex-wrap gap-4">
                    <a href="{{ $about['cta']['url'] }}"
                        class="inline-flex items-center justify-center rounded-full bg-violet-600 px-6 py-3 text-sm font-semibold text-white shadow-lg shadow-violet-600/20 transition hover:bg-violet-700">
                        {{ $about['cta']['label'] }}
                    </a>
                    <div class="flex items-center gap-2 text-sm font-medium text-gray-500 dark:text-gray-300">
                        <span class="inline-flex h-10 w-10 items-center justify-center rounded-full bg-violet-100 text-violet-600 dark:bg-violet-500/20 dark:text-violet-200">
                            ★
                        </span>
                        Marcas que confían en nosotros
                    </div>
                </div>

                <dl class="grid gap-6 sm:grid-cols-3">
                    @foreach ($about['stats'] as $stat)
                        <div class="rounded-2xl border border-gray-100 bg-gray-50 p-5 text-center shadow-sm dark:border-gray-800 dark:bg-gray-800">
                            <dt class="text-2xl font-bold text-gray-900 dark:text-white">{{ $stat['value'] }}</dt>
                            <dd class="mt-1 text-sm text-gray-600 dark:text-gray-300">{{ $stat['label'] }}</dd>
                        </div>
                    @endforeach
                </dl>
            </div>

            <div class="space-y-6">
                <div class="overflow-hidden rounded-3xl border border-gray-100 bg-gray-50 shadow-lg dark:border-gray-800 dark:bg-gray-800">
                    <img src="{{ $about['image']['src'] }}" alt="{{ $about['image']['alt'] }}"
                        class="h-80 w-full object-cover sm:h-[360px]" loading="lazy">
                    <div class="px-6 py-4 text-sm font-medium text-gray-600 dark:text-gray-300">
                        {{ $about['image']['caption'] }}
                    </div>
                </div>

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
            </div>
        </div>

        <div class="mt-14 grid gap-6 md:grid-cols-3">
            @foreach ($about['values'] as $value)
                <article class="rounded-3xl border border-gray-100 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-lg dark:border-gray-800 dark:bg-gray-900">
                    <h4 class="text-lg font-semibold text-gray-900 dark:text-white">{{ $value['title'] }}</h4>
                    <p class="mt-3 text-sm text-gray-600 dark:text-gray-300">{{ $value['description'] }}</p>
                </article>
            @endforeach
        </div>
    </x-container>
</section>
