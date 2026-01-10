@props([
    'services' => null,
])

@php
    $fallback = 'codecima codecima codecima codecima';

    $sectionTitle = setting('services_title', $fallback);
    $sectionIntro = setting('services_intro', $fallback);
    $ctaLabel = setting('services_cta_label', $fallback);
    $ctaUrl = setting('services_cta_url', '#');
    $showSection = (bool) setting('services_show_section', true);
    $showCta = (bool) setting('services_show_cta', true);

    $services = $services ?? \App\Models\CompanyService::query()
        ->where('is_active', true)
        ->orderBy('sort_order')
        ->orderBy('id')
        ->get();

    $serviceItems = $services->isEmpty()
        ? collect([
            ['title' => $fallback, 'description' => $fallback, 'image_path' => null],
            ['title' => $fallback, 'description' => $fallback, 'image_path' => null],
            ['title' => $fallback, 'description' => $fallback, 'image_path' => null],
        ])
        : $services;

    $imageFallback = asset('img/image_placeholder.jpg');
@endphp

@if ($showSection)
    <section class="bg-gray-50 dark:bg-gray-900 py-16 sm:py-20" id="servicios">
        <x-container class="px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col gap-6 lg:flex-row lg:items-end lg:justify-between">
                <div class="max-w-2xl">
                    <h2 class="text-3xl font-bold text-gray-900 dark:text-white sm:text-4xl">
                        {{ $sectionTitle ?: $fallback }}
                    </h2>
                    <p class="mt-4 text-lg text-gray-600 dark:text-gray-300">
                        {{ $sectionIntro ?: $fallback }}
                    </p>
                </div>

                @if ($showCta)
                    <a href="{{ $ctaUrl ?: '#' }}"
                        class="inline-flex items-center justify-center rounded-full bg-violet-600 px-6 py-3 text-sm font-semibold text-white shadow-lg shadow-violet-600/20 transition hover:bg-violet-700">
                        {{ $ctaLabel ?: $fallback }}
                    </a>
                @endif
            </div>

            <div class="mt-12 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($serviceItems as $service)
                    @php
                        $title = $service['title'] ?? $service->title ?? $fallback;
                        $description = $service['description'] ?? $service->description ?? $fallback;
                        $imagePath = $service['image_path'] ?? $service->image_path ?? null;
                        $imageUrl = $imagePath
                            ? (\Illuminate\Support\Facades\Storage::disk('public')->exists($imagePath)
                                ? \Illuminate\Support\Facades\Storage::url($imagePath)
                                : $imageFallback)
                            : $imageFallback;
                    @endphp

                    <article class="rounded-3xl border border-gray-100 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-lg dark:border-gray-800 dark:bg-gray-900">
                        <div class="flex items-center gap-4">
                            <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-violet-100 text-violet-600 dark:bg-violet-500/20 dark:text-violet-200">
                                <img src="{{ $imageUrl }}" alt="{{ $title }}" class="h-8 w-8 rounded-lg object-cover"
                                    onerror="this.onerror=null;this.src='{{ $imageFallback }}';" />
                            </div>
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">{{ $title ?: $fallback }}</h3>
                        </div>
                        <p class="mt-4 text-sm text-gray-600 dark:text-gray-300">{{ $description ?: $fallback }}</p>
                    </article>
                @endforeach
            </div>
        </x-container>
    </section>
@endif
