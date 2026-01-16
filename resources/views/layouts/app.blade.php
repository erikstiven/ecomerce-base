<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'HMBSport') }}</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('hmbsports-new.svg') }}?v={{ time() }}">



    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    @php
        $fontFamily = setting('typography_font_family', "Figtree, sans-serif");
        $fontUrl = setting('typography_font_url', '');
        $navTopBg = setting('nav_top_bg', '#1d4ed8');
        $navTopText = setting('nav_top_text', '#f8fafc');
        $navTopHover = setting('nav_top_hover', '#ffffff');
        $navHeaderFrom = setting('nav_header_from', '#3b0764');
        $navHeaderVia = setting('nav_header_via', '#1e3a8a');
        $navHeaderTo = setting('nav_header_to', '#7e22ce');
        $footerFrom = setting('footer_from', '#3b0764');
        $footerVia = setting('footer_via', '#1e3a8a');
        $footerTo = setting('footer_to', '#7e22ce');
        $footerText = setting('footer_text', '#f8fafc');
        $footerMuted = setting('footer_muted', '#cbd5f5');
    @endphp

    @if ($fontUrl)
        <link rel="stylesheet" href="{{ $fontUrl }}">
    @endif

    <style>
        :root {
            --nav-top-bg: {{ $navTopBg }};
            --nav-top-text: {{ $navTopText }};
            --nav-top-hover: {{ $navTopHover }};
            --nav-header-from: {{ $navHeaderFrom }};
            --nav-header-via: {{ $navHeaderVia }};
            --nav-header-to: {{ $navHeaderTo }};
            --footer-from: {{ $footerFrom }};
            --footer-via: {{ $footerVia }};
            --footer-to: {{ $footerTo }};
            --footer-text: {{ $footerText }};
            --footer-muted: {{ $footerMuted }};
            --body-font-family: {{ $fontFamily }};
        }

        .nav-top-link {
            color: var(--nav-top-text);
        }

        .nav-top-link:hover {
            color: var(--nav-top-hover);
        }

        .footer-text {
            color: var(--footer-text);
        }

        .footer-muted {
            color: var(--footer-muted);
        }
    </style>

    @stack('css')

    <!-- Iconos -->
    <script src="https://kit.fontawesome.com/624f2e432c.js" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/lucide@latest"></script>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles

    {{-- Payphone --}}
    <link rel="stylesheet" href="https://cdn.payphonetodoesposible.com/box/v1.1/payphone-payment-box.css">
    <script type="module" src="https://cdn.payphonetodoesposible.com/box/v1.1/payphone-payment-box.js"></script>
</head>

<body class="font-sans antialiased bg-gray-100 dark:bg-gray-900 flex flex-col min-h-screen"
    style="font-family: var(--body-font-family);">
    <x-banner />

    {{-- Navegación --}}
    @livewire('navegation')

    <!-- Page Content -->
    <main class="flex-1 mb-12">
        {{ $slot }}
    </main>

    {{-- Footer --}}
    @include('layouts.partials.app.footer')

    {{-- Botones flotantes --}}
    @include('layouts.partials.app.floating-buttons')

    @stack('modals')


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @livewireScripts
    @stack('js')

    @if (session('swal'))
        <script>
            Swal.fire({!! json_encode(session('swal')) !!});
        </script>
    @endif

    <script>
        Livewire.on('swal', data => {
            Swal.fire(data[0]);
        });
    </script>
</body>

</html>
