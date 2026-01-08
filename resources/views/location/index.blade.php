<x-app-layout>
    <x-container class="px-4 my-8">

        {{-- ========================= HERO ========================= --}}
        @php
            $locationTitle = setting('location_title', '');
            $locationDescription = setting('location_description', '');
            $locationMapEmbed = setting('location_map_embed', '');
            $locationAddress = setting('location_address', '');
            $locationHours = setting('location_hours', '');
            $locationEmail = setting('location_email', '');
            $locationPhonePrimary = setting('location_phone_primary', '');
            $locationPhoneSecondary = setting('location_phone_secondary', '');
            $locationPhoneSales = setting('location_phone_sales', '');
            $locationContactText = setting('location_contact_text', '');
            $mapHasIframe = \Illuminate\Support\Str::contains($locationMapEmbed, '<iframe');
            $mapEmbedHtml = $mapHasIframe
                ? preg_replace('/<iframe/i', '<iframe class="w-full h-full"', $locationMapEmbed)
                : '';
        @endphp

        <header class="text-center mb-8">
            <h2 class="flex items-center justify-center gap-2 text-4xl md:text-5xl font-extrabold text-purple-700">
                {{ $locationTitle ?: 'Ubicación' }}
            </h2>
            @if ($locationDescription)
                <p class="mt-2 text-gray-600 max-w-2xl mx-auto">
                    {{ $locationDescription }}
                </p>
            @endif
        </header>

        {{-- ========================= MAPA (FULL WIDTH Y ALTURA REAL) ========================= --}}
        @if ($locationMapEmbed)
            <section class="w-full">
                <div class="relative overflow-hidden rounded-2xl shadow-lg ring-1 ring-black/5">
                    <div class="w-full" style="height:clamp(420px, 60vh, 720px);">
                        @if ($mapHasIframe)
                            {!! $mapEmbedHtml !!}
                        @else
                            <iframe
                                src="{{ $locationMapEmbed }}"
                                class="block w-full h-full border-0"
                                style="filter:grayscale(0.05) contrast(1.05) brightness(1.05);"
                                allowfullscreen loading="lazy" referrerpolicy="no-referrer-when-downgrade"
                                title="Mapa de ubicación">
                            </iframe>
                        @endif
                    </div>
                </div>
            </section>
        @endif


        {{-- ========================= INFO + CONTACTO (DOS TARJETAS) ========================= --}}
        <section class="mt-8 grid gap-6 md:grid-cols-2">
            {{-- CARD: INFORMACIÓN --}}
            <div
                class="p-6 bg-white rounded-2xl shadow-lg ring-1 ring-black/5 flex flex-col justify-between transition hover:-translate-y-0.5 hover:shadow-xl">
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-purple-700" viewBox="0 0 24 24"
                            fill="currentColor" aria-hidden="true">
                            <path
                                d="M12 2a7 7 0 0 0-7 7c0 5.25 7 13 7 13s7-7.75 7-13a7 7 0 0 0-7-7Zm0 9.5A2.5 2.5 0 1 1 12 6a2.5 2.5 0 0 1 0 5Z" />
                        </svg>
                        Dirección
                    </h3>
                    @if ($locationAddress)
                        <p class="mt-2 text-gray-700 leading-relaxed">
                            {!! nl2br(e($locationAddress)) !!}
                        </p>
                    @endif

                    @if ($locationHours)
                        <h4 class="mt-4 text-sm font-medium text-gray-900 flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-slate-500" viewBox="0 0 24 24"
                                fill="currentColor" aria-hidden="true">
                                <path d="M12 2a10 10 0 1 0 10 10A10 10 0 0 0 12 2Zm1 11h4v-2h-3V7h-2Z" />
                            </svg>
                            Horario de atención
                        </h4>
                        <p class="text-sm text-gray-700">
                            {!! nl2br(e($locationHours)) !!}
                        </p>
                    @endif
                </div>
            </div>

            {{-- CARD: CONTACTO --}}
            <div
                class="p-6 bg-white rounded-2xl shadow-lg ring-1 ring-black/5 transition hover:-translate-y-0.5 hover:shadow-xl">
                <h3 class="text-lg font-semibold text-gray-900 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-emerald-600" viewBox="0 0 24 24"
                        fill="currentColor" aria-hidden="true">
                        <path
                            d="M20 4H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2Zm0 4-8 5L4 8V6l8 5 8-5Z" />
                    </svg>
                    Contáctanos
                </h3>

                <div class="mt-4 space-y-4 text-sm">
                    @if ($locationContactText)
                        <div class="text-sm text-gray-700">
                            {!! nl2br(e($locationContactText)) !!}
                        </div>
                    @endif
                    @if ($locationEmail)
                        <div>
                            <h4 class="font-medium text-gray-700">Correo</h4>
                            <a href="mailto:{{ $locationEmail }}"
                                class="text-purple-600 hover:text-purple-700">{{ $locationEmail }}</a>
                        </div>
                    @endif

                    @if ($locationPhonePrimary || $locationPhoneSecondary || $locationPhoneSales)
                        <div>
                            <h4 class="font-medium text-gray-700">WhatsApp / Teléfonos</h4>
                            <ul class="mt-2 space-y-1 text-gray-700">
                                @if ($locationPhonePrimary)
                                    <li>📞 Cotizaciones: <a href="https://wa.me/593{{ $locationPhonePrimary }}"
                                            class="text-emerald-600 hover:underline">{{ $locationPhonePrimary }}</a></li>
                                @endif
                                @if ($locationPhoneSecondary)
                                    <li>📞 Cotizaciones: <a href="https://wa.me/593{{ $locationPhoneSecondary }}"
                                            class="text-emerald-600 hover:underline">{{ $locationPhoneSecondary }}</a></li>
                                @endif
                                @if ($locationPhoneSales)
                                    <li>📞 Ventas: <a href="https://wa.me/593{{ $locationPhoneSales }}"
                                            class="text-emerald-600 hover:underline">{{ $locationPhoneSales }}</a></li>
                                @endif
                            </ul>
                        </div>
                    @endif
                </div>
            </div>
        </section>

    </x-container>
</x-app-layout>
