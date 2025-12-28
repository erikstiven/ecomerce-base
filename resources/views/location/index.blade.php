<x-app-layout>
    <x-container class="px-4 my-8">

        {{-- ========================= HERO ========================= --}}
        @php
            $locationTitle = setting('location_title', 'Ubicación');
            $locationDescription = setting(
                'location_description',
                'Estamos en la ciudad de Machala, Ecuador. Puedes visitarnos o contactarnos para pedidos personalizados. ¡Hacemos envíos a todo el país!'
            );
            $locationMapEmbed = setting(
                'location_map_embed',
                'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3981.028587707602!2d-79.95392!3d-3.2636928!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x90330fbbf896c7d7%3A0xeb99f3085f5faf72!2sHMB-SPORT!5e0!3m2!1ses!2sec!4v1696532538685!5m2!1ses!2sec'
            );
            $locationAddress = setting(
                'location_address',
                'Tarqui y 11ª Norte' . PHP_EOL . 'Frente al Colegio Henríquez Coello — Machala'
            );
            $locationHours = setting(
                'location_hours',
                'Lunes a Sábado — 09:00 a 18:00' . PHP_EOL . 'Domingo — Cerrado'
            );
            $locationEmail = setting('location_email', 'quisniahugo@hotmail.com');
            $locationPhonePrimary = setting('location_phone_primary', '0989009428');
            $locationPhoneSecondary = setting('location_phone_secondary', '0983284300');
            $locationPhoneSales = setting('location_phone_sales', '0979018689');
            $locationContactText = setting('location_contact_text', '');
        @endphp

        <header class="text-center mb-8">
            <h2 class="flex items-center justify-center gap-2 text-4xl md:text-5xl font-extrabold text-purple-700">
                {{ $locationTitle }}
            </h2>
            <p class="mt-2 text-gray-600 max-w-2xl mx-auto">
                {{ $locationDescription }}
            </p>
        </header>

        {{-- ========================= MAPA (FULL WIDTH Y ALTURA REAL) ========================= --}}
        <section class="w-full">
            <div class="relative overflow-hidden rounded-2xl shadow-lg ring-1 ring-black/5">
                {{-- Wrapper con altura forzada y responsive --}}
                <div class="w-full" style="height:clamp(420px, 60vh, 720px);">
                    <iframe
                        src="{{ $locationMapEmbed }}"
                        class="block w-full h-full border-0"
                        style="filter:grayscale(0.05) contrast(1.05) brightness(1.05);" allowfullscreen loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade" title="Ubicación HMB-SPORT en Google Maps">
                    </iframe>
                </div>
            </div>
        </section>


        {{-- ========================= INFO + CONTACTO (DOS TARJETAS) ========================= --}}
        <section class="mt-8 grid gap-6 md:grid-cols-2">
            {{-- CARD: INFORMACIÓN --}}
            <div class="p-6 bg-white rounded-2xl shadow-lg ring-1 ring-black/5 flex flex-col justify-between">
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
                        {!! nl2br(e($locationAddress)) !!}
                    </p>

                    <h4 class="mt-4 text-sm font-medium text-gray-900">Horario de atención</h4>
                    <p class="text-sm text-gray-700">
                        {!! nl2br(e($locationHours)) !!}
                    </p>
                </div>
            </div>

            {{-- CARD: CONTACTO --}}
            <div class="p-6 bg-white rounded-2xl shadow-lg ring-1 ring-black/5">
                <h3 class="text-lg font-semibold text-gray-900">Contáctanos</h3>
                <p class="mt-1 text-sm text-gray-600">Te atenderemos con gusto.</p>

                <div class="mt-4 space-y-4 text-sm">
                    @if ($locationContactText)
                        <div class="text-sm text-gray-700">
                            {!! nl2br(e($locationContactText)) !!}
                        </div>
                    @endif
                    <div>
                        <h4 class="font-medium text-gray-700">Correo</h4>
                        <a href="mailto:{{ $locationEmail }}"
                            class="text-purple-600 hover:text-purple-700">{{ $locationEmail }}</a>
                    </div>

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
                </div>
            </div>
        </section>

    </x-container>
</x-app-layout>
