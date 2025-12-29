<x-app-layout>
    <x-container class="px-4 my-8">

        {{-- ========================= HERO ========================= --}}
        <header class="text-center mb-8">
            <h2 class="text-4xl md:text-5xl font-extrabold text-purple-700">Nuestros Servicios</h2>
            <p class="mt-2 text-gray-600">Personalización textil con estándares profesionales.</p>
        </header>

        @php
            $fallback = asset('images/servicios/placeholder.jpg');
        @endphp

        <section class="mt-14">
            <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                @foreach ($services as $service)
                    <article class="card group overflow-hidden p-0">
                        <div class="relative aspect-[16/10] bg-gray-100">
                            @php
                                $imageUrl = $service['image_path']
                                    ? \Illuminate\Support\Facades\Storage::url($service['image_path'])
                                    : $fallback;
                            @endphp
                            <img src="{{ $imageUrl }}" alt="{{ $service['title'] }}" width="1600" height="1000"
                                loading="lazy" decoding="async" fetchpriority="low"
                                onerror="this.onerror=null;this.src='{{ $fallback }}';"
                                class="absolute inset-0 h-full w-full object-cover transition-transform duration-500 group-hover:scale-105" />
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/25 to-transparent">
                            </div>
                        </div>

                        <div class="p-5">
                            <h3 class="text-lg font-semibold text-gray-900">{{ $service['title'] }}</h3>
                            <p class="mt-1 text-sm text-gray-600">{{ $service['description'] }}</p>

                            <div class="mt-4">
                                <a href="https://wa.me/593989009428" target="_blank"
                                    class="inline-flex items-center justify-center gap-2 rounded-xl bg-emerald-500 px-4 py-2 text-sm font-medium text-white hover:bg-emerald-600 transition focus-visible:ring-2 focus-visible:ring-emerald-300"
                                    aria-label="Solicitar información por WhatsApp sobre {{ $service['title'] }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white"
                                        viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                        <path
                                            d="M20.52 3.48A11.94 11.94 0 0 0 12.06 0C5.6 0 .38 5.22.38 11.68c0 2.05.54 4.04 1.57 5.79L0 24l6.7-1.92a11.6 11.6 0 0 0 5.36 1.37h.01c6.46 0 11.68-5.22 11.68-11.68 0-3.12-1.22-6.06-3.21-8.08ZM12.07 21.2h-.01a9.56 9.56 0 0 1-4.87-1.33l-.35-.2-3.98 1.14 1.14-3.88-.23-.4a9.53 9.53 0 0 1-1.42-5.05c0-5.28 4.3-9.58 9.6-9.58 2.56 0 4.97 1 6.78 2.8a9.52 9.52 0 0 1 2.8 6.78c0 5.28-4.3 9.6-9.6 9.6Zm5.53-7.18c-.3-.15-1.78-.88-2.05-.98-.27-.1-.47-.15-.68.15-.2.3-.78.98-.95 1.18-.17.2-.35.22-.65.07-.3-.15-1.24-.46-2.36-1.48-.87-.77-1.46-1.72-1.63-2.01-.17-.3-.02-.46.13-.61.13-.13.3-.35.45-.52.15-.17.2-.3.3-.5.1-.2.05-.37-.02-.52-.07-.15-.68-1.63-.93-2.24-.24-.58-.49-.5-.68-.5h-.58c-.2 0-.52.07-.79.37-.27.3-1.04 1.02-1.04 2.49 0 1.46 1.06 2.87 1.2 3.07.15.2 2.1 3.2 5.09 4.49.71.31 1.27.5 1.71.64.72.23 1.38.2 1.9.12.58-.09 1.78-.73 2.03-1.43.25-.7.25-1.28.18-1.4-.07-.12-.27-.2-.56-.35Z" />
                                    </svg>
                                    WhatsApp
                                </a>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        </section>

    </x-container>
</x-app-layout>
