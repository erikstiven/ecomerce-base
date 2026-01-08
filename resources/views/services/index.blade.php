<x-app-layout>
    <x-container class="px-4 my-8">

        {{-- ========================= HERO ========================= --}}
        <header class="text-center mb-8">
            <h2 class="text-4xl md:text-5xl font-extrabold text-purple-700">Nuestros servicios</h2>
        </header>

        @php
            $fallback = asset('img/image_placeholder.jpg');
        @endphp

        <section class="mt-14">
            @if ($services->isEmpty())
                <div class="rounded-2xl border border-dashed border-slate-200 bg-white p-10 text-center text-sm text-slate-500">
                    Aún no hay servicios publicados.
                </div>
            @else
                <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                    @foreach ($services as $service)
                        @php
                            $imageUrl = $service->image_path
                                ? (\Illuminate\Support\Facades\Storage::disk('public')->exists($service->image_path)
                                    ? \Illuminate\Support\Facades\Storage::url($service->image_path)
                                    : $fallback)
                                : $fallback;
                        @endphp
                        <article class="card group overflow-hidden p-0">
                            <div class="relative aspect-[16/10] bg-gray-100">
                                <img src="{{ $imageUrl }}" alt="{{ $service->title }}" width="1600" height="1000"
                                    loading="lazy" decoding="async" fetchpriority="low"
                                    onerror="this.onerror=null;this.src='{{ $fallback }}';"
                                    class="absolute inset-0 h-full w-full object-cover transition-transform duration-500 group-hover:scale-105" />
                                <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/25 to-transparent">
                                </div>
                            </div>

                            <div class="p-5">
                                <div class="flex items-center gap-2">
                                    <span class="inline-flex h-9 w-9 items-center justify-center rounded-lg bg-purple-100 text-purple-700">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24"
                                            fill="currentColor" aria-hidden="true">
                                            <path
                                                d="M12 3a9 9 0 1 0 9 9 9 9 0 0 0-9-9Zm4.2 6.8-4.93 6.04a1 1 0 0 1-1.52.08l-2.93-3.2 1.48-1.36 2.18 2.38 4.17-5.11Z" />
                                        </svg>
                                    </span>
                                    <h3 class="text-lg font-semibold text-gray-900">{{ $service->title }}</h3>
                                </div>
                                @if ($service->description)
                                    <p class="mt-2 text-sm text-gray-600">{{ $service->description }}</p>
                                @endif
                            </div>
                        </article>
                    @endforeach
                </div>
            @endif
        </section>

    </x-container>
</x-app-layout>
