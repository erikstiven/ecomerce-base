<x-app-layout>
    @php
        $faqTitle = setting('faq_title', 'Preguntas frecuentes');
        $faqContent = setting('faq_content', '');
    @endphp

    <x-container class="px-4 my-8">
        <header class="text-center mb-8">
            <h1 class="text-3xl md:text-4xl font-extrabold text-purple-700">{{ $faqTitle }}</h1>
        </header>

        @if ($faqContent)
            <div class="prose max-w-none text-gray-700">
                {!! nl2br(e($faqContent)) !!}
            </div>
        @endif
    </x-container>
</x-app-layout>
