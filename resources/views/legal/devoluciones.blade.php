<x-app-layout>
    @php
        $legalContent = setting('legal_returns_content', '');
    @endphp

    <x-container class="px-4 my-8">
        <header class="text-center mb-8">
            <h1 class="text-3xl md:text-4xl font-extrabold text-purple-700">Política de devoluciones</h1>
        </header>

        @if ($legalContent)
            <div class="prose max-w-none text-gray-700">
                {!! nl2br(e($legalContent)) !!}
            </div>
        @endif
    </x-container>
</x-app-layout>
