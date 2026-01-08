<x-app-layout>
    @php
        $faqItems = \App\Models\Faq::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();
    @endphp

    <x-container class="px-4 my-8">
        <header class="text-center mb-8">
            <h1 class="text-3xl md:text-4xl font-extrabold text-purple-700">Preguntas frecuentes</h1>
        </header>

        @if ($faqItems->isNotEmpty())
            <div class="mt-6 space-y-4">
                @foreach ($faqItems as $faq)
                    <details
                        class="group rounded-xl bg-white p-4 shadow-sm ring-1 ring-black/5 transition hover:-translate-y-0.5 hover:shadow-md">
                        <summary class="flex cursor-pointer list-none items-center justify-between">
                            <span class="text-base font-semibold text-gray-900">{{ $faq->question }}</span>
                            <span class="ml-4 inline-flex h-7 w-7 items-center justify-center rounded-full bg-purple-100 text-purple-700 transition group-open:rotate-180">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24"
                                    fill="currentColor" aria-hidden="true">
                                    <path d="M12 15.5 6 9.5 7.4 8.1 12 12.7 16.6 8.1 18 9.5Z" />
                                </svg>
                            </span>
                        </summary>
                        <p class="mt-3 text-sm text-gray-700">{{ $faq->answer }}</p>
                    </details>
                @endforeach
            </div>
        @else
            <div class="rounded-xl bg-white p-6 text-center text-sm text-gray-600 shadow-sm ring-1 ring-black/5">
                No hay preguntas frecuentes registradas aún.
            </div>
        @endif
    </x-container>
</x-app-layout>
