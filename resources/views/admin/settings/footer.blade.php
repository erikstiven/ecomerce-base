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

        <form method="POST" action="{{ route('admin.settings.footer.update') }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <x-validation-errors class="mb-4" />

            <div class="grid gap-6 md:grid-cols-2">
                <div>
                    <x-label class="mt-2">Nombre de la empresa</x-label>
                    <x-input class="w-full" name="name" value="{{ old('name', $settings?->name) }}" />
                </div>
                <div>
                    <x-label class="mt-2">Nombre legal</x-label>
                    <x-input class="w-full" name="legal_company_name"
                        value="{{ old('legal_company_name', $settings?->legal_company_name) }}" />
                </div>
            </div>

            <div class="mt-4">
                <x-label class="mt-2">Descripción corta</x-label>
                <x-textarea class="w-full" name="footer_description" rows="2">{{ old('footer_description', $settings?->footer_description) }}</x-textarea>
            </div>

            <div class="mt-4 grid gap-6 md:grid-cols-2">
                <div>
                    <x-label class="mt-2">Email de contacto</x-label>
                    <x-input class="w-full" name="footer_email" value="{{ old('footer_email', $settings?->footer_email) }}" />
                </div>
                <div>
                    <x-label class="mt-2">Teléfono de contacto</x-label>
                    <x-input class="w-full" name="footer_phone" value="{{ old('footer_phone', $settings?->footer_phone) }}" />
                </div>
            </div>

            <div class="mt-4">
                <x-label class="mt-2">Logo</x-label>
                <x-input class="w-full" name="footer_logo" type="file" accept="image/*" />
            </div>

            <div class="mt-6">
                <h2 class="text-sm font-semibold text-slate-700">Redes sociales</h2>
                <div class="mt-3 grid gap-4 md:grid-cols-2">
                    <div>
                        <x-label class="mt-2">Facebook</x-label>
                        <x-input class="w-full" name="facebook" value="{{ old('facebook', $settings?->facebook) }}" />
                    </div>
                    <div>
                        <x-label class="mt-2">Instagram</x-label>
                        <x-input class="w-full" name="instagram" value="{{ old('instagram', $settings?->instagram) }}" />
                    </div>
                    <div>
                        <x-label class="mt-2">TikTok</x-label>
                        <x-input class="w-full" name="tiktok" value="{{ old('tiktok', $settings?->tiktok) }}" />
                    </div>
                    <div>
                        <x-label class="mt-2">YouTube</x-label>
                        <x-input class="w-full" name="youtube" value="{{ old('youtube', $settings?->youtube) }}" />
                    </div>
                </div>
            </div>

            <div class="mt-6 flex justify-end">
                <x-button>Guardar</x-button>
            </div>
        </form>
    </div>

</x-admin-layout>
