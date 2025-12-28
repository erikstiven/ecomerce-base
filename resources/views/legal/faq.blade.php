<x-app-layout>
    @php
        $faqTitle = setting('faq_title', 'Preguntas frecuentes');
        $faqContent = setting('faq_content', '');
        $faqItems = \App\Models\Faq::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();
    @endphp

    <x-container class="px-4 my-8">
        <header class="text-center mb-8">
            <h1 class="text-3xl md:text-4xl font-extrabold text-purple-700">{{ $faqTitle }}</h1>
        </header>

        @if ($faqItems->isNotEmpty())
            <div class="mt-6 space-y-4">
                @foreach ($faqItems as $faq)
                    <div class="rounded-xl bg-white p-4 shadow-sm ring-1 ring-black/5">
                        <h2 class="text-base font-semibold text-gray-900">{{ $faq->question }}</h2>
                        <p class="mt-2 text-sm text-gray-700">{{ $faq->answer }}</p>
                    </div>
                @endforeach
            </div>
        @elseif ($faqContent)
            <div class="prose max-w-none text-gray-700">
                {!! nl2br(e($faqContent)) !!}
            </div>
        @endif
    </x-container>
</x-app-layout>
