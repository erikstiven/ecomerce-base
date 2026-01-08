@php
    use Illuminate\Support\Facades\Storage;
    use Illuminate\Support\Str;

    $companyName = setting('name', 'Codecima');
    $companyDescription = setting('footer_description', 'Soluciones digitales y ecommerce.');
    $footerEmail = setting('footer_email', 'contacto@codecima.com');
    $footerPhone = setting('footer_phone', '');
    $storedLogo = setting('footer_logo', '');
    $footerLogo = $storedLogo
        ? (Str::startsWith($storedLogo, ['http://', 'https://', '/'])
            ? $storedLogo
            : (Storage::disk('public')->exists($storedLogo) ? Storage::url($storedLogo) : asset('img/logo.png')))
        : asset('img/logo.png');
    $facebook = setting('facebook', '');
    $instagram = setting('instagram', '');
    $tiktok = setting('tiktok', '');
    $youtube = setting('youtube', '');
    $hasSocialLinks = $facebook || $instagram || $tiktok || $youtube;
    $legalCompanyName = setting('legal_company_name', 'Codecima');
@endphp

<footer class="bg-gradient-to-r from-[#3b0764] via-[#1e3a8a] to-[#7e22ce] text-white">
    <div class="max-w-screen-xl mx-auto px-6 md:px-8 py-10 lg:py-12">

        <!-- ============== TOP ============== -->
        <div class="grid grid-cols-1 md:grid-cols-12 gap-y-10 gap-x-8 md:items-center">

            <!-- IDENTIDAD -->
            <div
                class="md:col-span-4 flex flex-col items-center md:items-start justify-center text-center md:text-left md:self-center space-y-3">
                <a href="/" class="inline-flex" aria-label="Ir al inicio">
                    <img src="{{ $footerLogo }}" alt="{{ $companyName }}" class="h-16 md:h-20 object-contain mx-auto" />
                </a>
                <p class="text-lg font-semibold text-white/95">{{ $companyName }}</p>
                <p class="text-sm text-white/80">{{ $companyDescription }}</p>
            </div>

            <!-- CONTACTO ESENCIAL -->
            <div class="md:col-span-3">
                <h2 class="mb-3 font-semibold uppercase tracking-wide text-white/90">Contacto</h2>
                <ul class="space-y-2 text-white/90">
                    @if ($footerEmail)
                        <li>
                            <a href="mailto:{{ $footerEmail }}"
                                class="hover:underline focus:outline-none focus-visible:ring-2 focus-visible:ring-white/60 rounded">
                                {{ $footerEmail }}
                            </a>
                        </li>
                    @elseif ($footerPhone)
                        <li>
                            <a href="tel:{{ $footerPhone }}"
                                class="hover:underline focus:outline-none focus-visible:ring-2 focus-visible:ring-white/60 rounded">
                                {{ $footerPhone }}
                            </a>
                        </li>
                    @endif
                </ul>
            </div>

            <!-- REDES SOCIALES -->
            @if ($hasSocialLinks)
                <div class="md:col-span-2">
                    <h2 class="mb-3 font-semibold uppercase tracking-wide text-white/90">Redes sociales</h2>
                    <div class="flex justify-center md:justify-start gap-4">
                    @if ($facebook)
                        <a href="{{ $facebook }}" target="_blank" rel="noopener noreferrer" aria-label="Facebook"
                            class="w-11 h-11 flex items-center justify-center rounded-full border border-white/20 bg-white/5
                            hover:bg-[#1877F2]/80 hover:scale-110 hover:shadow-lg transition
                            focus:outline-none focus-visible:ring-2 focus-visible:ring-white/60">
                            <i class="fab fa-facebook-f text-white"></i>
                        </a>
                    @endif

                    @if ($instagram)
                        <a href="{{ $instagram }}" target="_blank" rel="noopener noreferrer" aria-label="Instagram"
                            class="w-11 h-11 flex items-center justify-center rounded-full border border-white/20 bg-white/5
                            hover:bg-gradient-to-tr from-pink-500 via-red-500 to-yellow-400 hover:scale-110 hover:shadow-lg transition
                            focus:outline-none focus-visible:ring-2 focus-visible:ring-white/60">
                            <i class="fab fa-instagram text-white"></i>
                        </a>
                    @endif

                    @if ($tiktok)
                        <a href="{{ $tiktok }}" target="_blank" rel="noopener noreferrer" aria-label="TikTok"
                            class="w-11 h-11 flex items-center justify-center rounded-full border border-white/20 bg-white/5
                            hover:bg-black/80 hover:scale-110 hover:shadow-lg transition
                            focus:outline-none focus-visible:ring-2 focus-visible:ring-white/60">
                            <i class="fab fa-tiktok text-white"></i>
                        </a>
                    @endif

                    @if ($youtube)
                        <a href="{{ $youtube }}" target="_blank" rel="noopener noreferrer" aria-label="YouTube"
                            class="w-11 h-11 flex items-center justify-center rounded-full border border-white/20 bg-white/5
                            hover:bg-red-600/90 hover:scale-110 hover:shadow-lg transition
                            focus:outline-none focus-visible:ring-2 focus-visible:ring-white/60">
                            <i class="fab fa-youtube text-white"></i>
                        </a>
                    @endif
                    </div>
                </div>
            @endif

            <!-- INFORMACIÓN / LEGAL -->
            <div class="md:col-span-3">
                <h2 class="mb-3 font-semibold uppercase tracking-wide text-white/90">Información</h2>
                <ul class="space-y-2 text-white/90">
                    <li>
                        <a href="/terminos-y-condiciones"
                            class="hover:underline focus:outline-none focus-visible:ring-2 focus-visible:ring-white/60 rounded">
                            Términos y condiciones
                        </a>
                    </li>
                    <li>
                        <a href="/politica-privacidad"
                            class="hover:underline focus:outline-none focus-visible:ring-2 focus-visible:ring-white/60 rounded">
                            Política de privacidad
                        </a>
                    </li>
                    <li>
                        <a href="/politica-devoluciones"
                            class="hover:underline focus:outline-none focus-visible:ring-2 focus-visible:ring-white/60 rounded">
                            Política de devoluciones
                        </a>
                    </li>
                    <li>
                        <a href="/preguntas-frecuentes"
                            class="hover:underline focus:outline-none focus-visible:ring-2 focus-visible:ring-white/60 rounded">
                            Preguntas frecuentes
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- ============== DIVISOR ============== -->
        <hr class="my-8 border-white/20" />

        <!-- ============== BOTTOM ============== -->
        <div class="flex flex-col items-center gap-2 text-center">
            <p class="text-sm text-white/70">
                © {{ now()->year }} {{ $legalCompanyName }}. Todos los derechos reservados.
            </p>
        </div>
    </div>
</footer>
