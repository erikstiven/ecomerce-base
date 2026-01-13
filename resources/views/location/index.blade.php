<x-app-layout>
    <x-container class="px-4 my-8">

        {{-- ========================= HERO ========================= --}}
        @php
            $fallback = 'codecima codecima codecima codecima';
            $defaultMapEmbed = 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3153.0861775384556!2d-122.40109278468156!3d37.793617979756695!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x80858064dba9e3db%3A0x3a33dcb162d6c4c7!2sGoogle%20Building%2041!5e0!3m2!1ses!2sus!4v1700000000000!5m2!1ses!2sus';

            $locationTitle = setting('location_title', '');
            $locationDescription = setting('location_description', '');
            $locationMapEmbed = setting('location_map_embed', '');
            $locationMapLatitude = setting('location_map_latitude', '');
            $locationMapLongitude = setting('location_map_longitude', '');
            $locationAddress = setting('location_address', '');
            $locationCity = setting('location_city', '');
            $locationCountry = setting('location_country', '');
            $locationContactText = setting('location_contact_text', '');
            $locationEmail = setting('location_email', '');
            $locationPhonePrimary = setting('location_phone_primary', '');
            $locationPhoneSecondary = setting('location_phone_secondary', '');
            $locationPhoneSales = setting('location_phone_sales', '');

            $mapHasIframe = \Illuminate\Support\Str::contains((string) $locationMapEmbed, '<iframe');
            $mapEmbedHtml = $mapHasIframe
                ? preg_replace('/<iframe/i', '<iframe class="w-full h-full"', $locationMapEmbed)
                : '';
            $coordsAvailable = trim((string) $locationMapLatitude) !== '' && trim((string) $locationMapLongitude) !== '';
            $mapEmbedUrl = trim((string) $locationMapEmbed) !== ''
                ? $locationMapEmbed
                : ($coordsAvailable ? 'https://www.google.com/maps?q=' . $locationMapLatitude . ',' . $locationMapLongitude . '&output=embed' : $defaultMapEmbed);

            $title = trim((string) $locationTitle) !== '' ? $locationTitle : $fallback;
            $description = trim((string) $locationDescription) !== '' ? $locationDescription : $fallback;
            $address = trim((string) $locationAddress) !== '' ? $locationAddress : $fallback;
            $city = trim((string) $locationCity) !== '' ? $locationCity : $fallback;
            $country = trim((string) $locationCountry) !== '' ? $locationCountry : $fallback;
            $contactText = trim((string) $locationContactText) !== '' ? $locationContactText : $fallback;
            $email = trim((string) $locationEmail) !== '' ? $locationEmail : $fallback;
            $phonePrimary = trim((string) $locationPhonePrimary) !== '' ? $locationPhonePrimary : $fallback;
            $phoneSecondary = trim((string) $locationPhoneSecondary) !== '' ? $locationPhoneSecondary : $fallback;
            $phoneSales = trim((string) $locationPhoneSales) !== '' ? $locationPhoneSales : $fallback;
        @endphp

        <header class="text-center mb-8">
            <h2 class="flex items-center justify-center gap-2 text-4xl md:text-5xl font-extrabold text-purple-700">
                {{ $title }}
            </h2>
            <p class="mt-2 text-gray-600 max-w-2xl mx-auto">
                {{ $description }}
            </p>
        </header>

        {{-- ========================= MAPA (FULL WIDTH Y ALTURA REAL) ========================= --}}
        <section class="w-full">
            <div class="relative overflow-hidden rounded-2xl shadow-lg ring-1 ring-black/5">
                <div class="w-full" style="height:clamp(420px, 60vh, 720px);">
                    @if ($mapHasIframe)
                        {!! $mapEmbedHtml !!}
                    @else
                        <iframe
                            src="{{ $mapEmbedUrl }}"
                            class="block w-full h-full border-0"
                            style="filter:grayscale(0.05) contrast(1.05) brightness(1.05);"
                            allowfullscreen loading="lazy" referrerpolicy="no-referrer-when-downgrade"
                            title="Mapa de ubicación">
                        </iframe>
                    @endif
                </div>
            </div>
        </section>


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
                    <p class="mt-2 text-gray-700 leading-relaxed">
                        {!! nl2br(e($address)) !!}
                    </p>
                    <p class="mt-2 text-sm text-gray-600">
                        {{ $city }} · {{ $country }}
                    </p>
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
                    Información de contacto
                </h3>

                <div class="mt-4 space-y-4 text-sm">
                    <div class="text-gray-700">
                        {!! nl2br(e($contactText)) !!}
                    </div>
                    <div>
                        <h4 class="font-medium text-gray-700">Correo</h4>
                        <a href="{{ $email !== $fallback ? 'mailto:' . $email : '#' }}"
                            class="text-purple-600 hover:text-purple-700">{{ $email }}</a>
                    </div>
                    <div>
                        <h4 class="font-medium text-gray-700">WhatsApp / Teléfonos</h4>
                        <ul class="mt-2 space-y-1 text-gray-700">
                            <li>📞 Principal: {{ $phonePrimary }}</li>
                            <li>📞 Secundario: {{ $phoneSecondary }}</li>
                            <li>📞 Ventas: {{ $phoneSales }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

    </x-container>
</x-app-layout>
