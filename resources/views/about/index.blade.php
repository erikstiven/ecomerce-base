<x-app-layout>
    <x-container class="px-4 my-8">

        @php
            $cardBase = '
                relative overflow-hidden bg-white shadow-lg ring-1 ring-black/5
                transition-all duration-300 ease-out hover:-translate-y-0.5 hover:shadow-xl
            ';
            $aboutTitle = setting('about_title', '');
            $aboutIntro = setting('about_intro', '');
            $aboutWho = setting('about_who', '');
            $aboutDifferentials = setting('about_differentials', '');
            $aboutProcess = setting('about_process', '');
        @endphp

        <header class="text-center mb-8">
            <h2 class="flex items-center justify-center gap-2 text-4xl md:text-5xl font-extrabold text-purple-700">
                {{ $aboutTitle ?: 'Quiénes somos' }}
            </h2>
            @if ($aboutIntro)
                <p class="mt-2 text-gray-600">
                    {{ $aboutIntro }}
                </p>
            @endif
        </header>

        {{-- ========================= SECCIÓN 1 ========================= --}}
        <section class="mt-8 mx-auto w-full">
            <div class="grid gap-6 md:grid-cols-2 items-stretch">
                @if ($aboutWho)
                    <div class="p-6 {{ $cardBase }}">
                        <div class="flex items-start gap-3">
                            <span class="inline-flex h-10 w-10 items-center justify-center rounded-xl bg-purple-100 text-purple-700">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24"
                                    fill="currentColor" aria-hidden="true">
                                    <path
                                        d="M12 12a4 4 0 1 0-4-4 4 4 0 0 0 4 4Zm0 2c-3.34 0-6 1.34-6 3v1h12v-1c0-1.66-2.66-3-6-3Z" />
                                </svg>
                            </span>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900">Quiénes somos</h3>
                                <p class="mt-2 text-gray-700 leading-relaxed">
                                    {{ $aboutWho }}
                                </p>
                            </div>
                        </div>
                    </div>
                @endif

                @if ($aboutDifferentials)
                    <div class="p-6 flex flex-col {{ $cardBase }}">
                        <div class="flex items-start gap-3">
                            <span class="inline-flex h-10 w-10 items-center justify-center rounded-xl bg-emerald-100 text-emerald-700">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24"
                                    fill="currentColor" aria-hidden="true">
                                    <path
                                        d="M9.5 16.5 5 12l1.41-1.41 3.09 3.09L17.59 5.6 19 7l-9.5 9.5Z" />
                                </svg>
                            </span>
                            <div class="flex-1">
                                <h3 class="text-lg font-semibold text-gray-900">Diferenciales</h3>
                                <ul class="mt-2 space-y-2 text-gray-700 text-sm">
                                    @foreach (preg_split('/\r\n|\r|\n/', $aboutDifferentials) as $differential)
                                        @if (trim($differential) !== '')
                                            <li class="flex items-start gap-2">
                                                <span class="mt-0.5 text-emerald-600">●</span>
                                                <span>{{ $differential }}</span>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </section>

        @if ($aboutProcess)
            <section class="mt-8">
                <div class="p-6 {{ $cardBase }}">
                    <div class="flex items-start gap-3">
                        <span class="inline-flex h-10 w-10 items-center justify-center rounded-xl bg-indigo-100 text-indigo-700">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24"
                                fill="currentColor" aria-hidden="true">
                                <path
                                    d="M12 2a10 10 0 1 0 10 10A10 10 0 0 0 12 2Zm1 15h-2v-2h2Zm0-4h-2V7h2Z" />
                            </svg>
                        </span>
                        <div class="flex-1">
                            <h3 class="text-lg font-semibold text-gray-900">Nuestro proceso</h3>
                            <ol class="mt-3 space-y-3 text-sm text-gray-700">
                                @foreach (preg_split('/\r\n|\r|\n/', $aboutProcess) as $step)
                                    @if (trim($step) !== '')
                                        <li class="rounded-lg border border-gray-100 bg-gray-50/70 px-3 py-2 transition hover:-translate-y-0.5 hover:shadow-sm">
                                            {{ $step }}
                                        </li>
                                    @endif
                                @endforeach
                            </ol>
                        </div>
                    </div>
                </div>
            </section>
        @endif

    </x-container>
</x-app-layout>
