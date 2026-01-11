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
                        $hasImage = $imagePath && \Illuminate\Support\Facades\Storage::disk('public')->exists($imagePath);
                        $imageUrl = $hasImage
                            ? \Illuminate\Support\Facades\Storage::url($imagePath)
                            : null;
                    @endphp

                    <article class="rounded-3xl border border-gray-100 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-lg dark:border-gray-800 dark:bg-gray-900">
                        <div class="flex items-center gap-4">
                            <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-violet-100 text-violet-600 dark:bg-violet-500/20 dark:text-violet-200">
                                @if ($imageUrl)
                                    <img src="{{ $imageUrl }}" alt="{{ $title }}" class="h-8 w-8 rounded-lg object-cover" />
                                @else
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24"
                                        fill="currentColor" aria-hidden="true">
                                        <path
                                            d="M12 2a10 10 0 1 0 10 10A10 10 0 0 0 12 2Zm4.2 6.8-4.93 6.04a1 1 0 0 1-1.52.08l-2.93-3.2 1.48-1.36 2.18 2.38 4.17-5.11Z" />
                                    </svg>
                                @endif
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
