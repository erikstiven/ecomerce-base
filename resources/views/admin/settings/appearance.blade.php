<x-admin-layout :breadcrumbs="[
    [
        'name' => __('Dashboard'),
        'route' => route('admin.dashboard'),
    ],
    [
        'name' => 'Configuración',
    ],
    [
        'name' => 'Apariencia',
    ],
]">

    <div class="card-form">
        @if (session('status'))
            <div class="mb-4 rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('admin.settings.appearance.update') }}">
            @csrf
            @method('PUT')

            <x-validation-errors class="mb-4" />

            <div class="grid gap-6 md:grid-cols-2">
                <div>
                    <x-label class="mt-2">Color fondo menú superior</x-label>
                    <x-input type="color" class="w-full h-12" name="nav_top_bg"
                        value="{{ old('nav_top_bg', $settings?->nav_top_bg ?? '#1d4ed8') }}" />
                    <p class="mt-1 text-xs text-slate-500">Color del menú superior (Inicio, Servicios, etc.).</p>
                </div>
                <div>
                    <x-label class="mt-2">Color texto menú superior</x-label>
                    <x-input type="color" class="w-full h-12" name="nav_top_text"
                        value="{{ old('nav_top_text', $settings?->nav_top_text ?? '#f8fafc') }}" />
                    <p class="mt-1 text-xs text-slate-500">Color base de los enlaces.</p>
                </div>
                <div>
                    <x-label class="mt-2">Color hover menú superior</x-label>
                    <x-input type="color" class="w-full h-12" name="nav_top_hover"
                        value="{{ old('nav_top_hover', $settings?->nav_top_hover ?? '#ffffff') }}" />
                    <p class="mt-1 text-xs text-slate-500">Color al pasar el mouse.</p>
                </div>
            </div>

            <div class="mt-6">
                <h2 class="text-sm font-semibold text-slate-700">Degradado del header principal</h2>
                <div class="mt-3 grid gap-6 md:grid-cols-3">
                    <div>
                        <x-label class="mt-2">Color inicio</x-label>
                        <x-input type="color" class="w-full h-12" name="nav_header_from"
                            value="{{ old('nav_header_from', $settings?->nav_header_from ?? '#3b0764') }}" />
                    </div>
                    <div>
                        <x-label class="mt-2">Color centro</x-label>
                        <x-input type="color" class="w-full h-12" name="nav_header_via"
                            value="{{ old('nav_header_via', $settings?->nav_header_via ?? '#1e3a8a') }}" />
                    </div>
                    <div>
                        <x-label class="mt-2">Color final</x-label>
                        <x-input type="color" class="w-full h-12" name="nav_header_to"
                            value="{{ old('nav_header_to', $settings?->nav_header_to ?? '#7e22ce') }}" />
                    </div>
                </div>
            </div>

            <div class="mt-6">
                <h2 class="text-sm font-semibold text-slate-700">Degradado del footer</h2>
                <div class="mt-3 grid gap-6 md:grid-cols-3">
                    <div>
                        <x-label class="mt-2">Color inicio</x-label>
                        <x-input type="color" class="w-full h-12" name="footer_from"
                            value="{{ old('footer_from', $settings?->footer_from ?? '#3b0764') }}" />
                    </div>
                    <div>
                        <x-label class="mt-2">Color centro</x-label>
                        <x-input type="color" class="w-full h-12" name="footer_via"
                            value="{{ old('footer_via', $settings?->footer_via ?? '#1e3a8a') }}" />
                    </div>
                    <div>
                        <x-label class="mt-2">Color final</x-label>
                        <x-input type="color" class="w-full h-12" name="footer_to"
                            value="{{ old('footer_to', $settings?->footer_to ?? '#7e22ce') }}" />
                    </div>
                    <div>
                        <x-label class="mt-2">Color texto principal</x-label>
                        <x-input type="color" class="w-full h-12" name="footer_text"
                            value="{{ old('footer_text', $settings?->footer_text ?? '#f8fafc') }}" />
                    </div>
                    <div>
                        <x-label class="mt-2">Color texto secundario</x-label>
                        <x-input type="color" class="w-full h-12" name="footer_muted"
                            value="{{ old('footer_muted', $settings?->footer_muted ?? '#cbd5f5') }}" />
                    </div>
                </div>
            </div>

            <div class="mt-6">
                <h2 class="text-sm font-semibold text-slate-700">Tipografía global</h2>
                <div class="mt-3 grid gap-6 md:grid-cols-2">
                    <div>
                        <x-label class="mt-2">Fuente principal</x-label>
                        <x-input class="w-full" name="typography_font_family"
                            placeholder="Ej: 'Figtree', sans-serif"
                            value="{{ old('typography_font_family', $settings?->typography_font_family) }}" />
                        <p class="mt-1 text-xs text-slate-500">Define el stack de fuentes global.</p>
                    </div>
                    <div>
                        <x-label class="mt-2">URL de la fuente (opcional)</x-label>
                        <x-input class="w-full" name="typography_font_url"
                            placeholder="https://fonts.googleapis.com/css2?family=..."
                            value="{{ old('typography_font_url', $settings?->typography_font_url) }}" />
                        <p class="mt-1 text-xs text-slate-500">Se incluye como &lt;link&gt; en el frontend.</p>
                    </div>
                </div>
            </div>

            <div class="mt-6 flex justify-end">
                <x-button>Guardar</x-button>
            </div>
        </form>
    </div>

</x-admin-layout>
