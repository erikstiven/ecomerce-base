<x-admin-layout :breadcrumbs="[
    [
        'name' => __('Dashboard'),
        'route' => route('admin.dashboard'),
    ],
    [
        'name' => 'Configuración',
    ],
    [
        'name' => 'Footer',
    ],
]">

    <div class="card-form">
        @if (session('status'))
            <div class="mb-4 rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('admin.settings.footer.update') }}">
            @csrf
            @method('PUT')

            <x-validation-errors class="mb-4" />

            <div class="grid gap-6 md:grid-cols-2">
                <div>
                    <x-label class="mt-2">Nombre de la empresa</x-label>
                    <x-input class="w-full" name="name" value="{{ old('name', $settings?->name) }}" />
                    <p class="mt-1 text-xs text-slate-500">Se muestra en el footer como nombre comercial.</p>
                </div>
                <div>
                    <x-label class="mt-2">Nombre legal</x-label>
                    <x-input class="w-full" name="legal_company_name"
                        value="{{ old('legal_company_name', $settings?->legal_company_name) }}" />
                    <p class="mt-1 text-xs text-slate-500">Se usa en el aviso legal de derechos reservados.</p>
                </div>
            </div>

            <div class="mt-4">
                <x-label class="mt-2">Descripción corta</x-label>
                <x-textarea class="w-full" name="footer_description" rows="2">{{ old('footer_description', $settings?->footer_description) }}</x-textarea>
                <p class="mt-1 text-xs text-slate-500">Resumen breve que acompaña el logo en el footer.</p>
            </div>

            <div class="mt-4 grid gap-6 md:grid-cols-2">
                <div>
                    <x-label class="mt-2">Email de contacto</x-label>
                    <x-input class="w-full" name="footer_email" value="{{ old('footer_email', $settings?->footer_email) }}" />
                    <p class="mt-1 text-xs text-slate-500">Se muestra como enlace de contacto en el footer.</p>
                </div>
                <div>
                    <x-label class="mt-2">Teléfono de contacto</x-label>
                    <x-input class="w-full" name="footer_phone" value="{{ old('footer_phone', $settings?->footer_phone) }}" />
                    <p class="mt-1 text-xs text-slate-500">Se usa si no hay email configurado.</p>
                </div>
            </div>

            @php
                $footerLogo = $settings?->footer_logo;
                $footerLogoUrl = $footerLogo
                    ? (\Illuminate\Support\Str::startsWith($footerLogo, ['http://', 'https://', '/'])
                        ? $footerLogo
                        : (\Illuminate\Support\Facades\Storage::disk('public')->exists($footerLogo)
                            ? \Illuminate\Support\Facades\Storage::url($footerLogo)
                            : asset('img/logo.png')))
                    : null;
            @endphp

            <div class="mt-4">
                <x-label class="mt-2">URL del logo</x-label>
                <x-input class="w-full" name="footer_logo" value="{{ old('footer_logo', $settings?->footer_logo) }}" />
                <p class="mt-1 text-xs text-slate-500">Usa un enlace directo (https://...) para mostrar el logo en el footer.</p>
                @if ($footerLogoUrl)
                    <div class="mt-3 flex items-center gap-3 text-xs text-slate-600">
                        <img class="h-10 w-auto" src="{{ $footerLogoUrl }}" alt="Logo actual" />
                        <span>Logo actual</span>
                    </div>
                @endif
            </div>

            <div class="mt-6">
                <h2 class="text-sm font-semibold text-slate-700">Redes sociales</h2>
                <div class="mt-3 grid gap-4 md:grid-cols-2">
                    <div>
                        <x-label class="mt-2">Facebook</x-label>
                        <x-input class="w-full" name="facebook" value="{{ old('facebook', $settings?->facebook) }}" />
                        <p class="mt-1 text-xs text-slate-500">Enlace completo del perfil.</p>
                    </div>
                    <div>
                        <x-label class="mt-2">Instagram</x-label>
                        <x-input class="w-full" name="instagram" value="{{ old('instagram', $settings?->instagram) }}" />
                        <p class="mt-1 text-xs text-slate-500">Enlace completo del perfil.</p>
                    </div>
                    <div>
                        <x-label class="mt-2">TikTok</x-label>
                        <x-input class="w-full" name="tiktok" value="{{ old('tiktok', $settings?->tiktok) }}" />
                        <p class="mt-1 text-xs text-slate-500">Enlace completo del perfil.</p>
                    </div>
                    <div>
                        <x-label class="mt-2">YouTube</x-label>
                        <x-input class="w-full" name="youtube" value="{{ old('youtube', $settings?->youtube) }}" />
                        <p class="mt-1 text-xs text-slate-500">Enlace completo del canal.</p>
                    </div>
                </div>
            </div>

            <div class="mt-6 flex justify-end">
                <x-button>Guardar</x-button>
            </div>
        </form>
    </div>

</x-admin-layout>
