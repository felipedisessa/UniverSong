<x-layouts.app>
    <div class="max-w-6xl mx-auto px-4 py-10">
        {{-- Toast de sucesso --}}
        @if (session('success'))
            <div id="toast-success"
                 class="flex items-center w-full max-w-md p-4 mb-6 text-sm text-green-700 bg-green-50 border border-green-200 rounded-lg shadow dark:text-green-300 dark:bg-green-800 dark:border-green-700"
                 role="alert">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                </svg>
                <div>{{ session('success') }}</div>
                <button data-dismiss-target="#toast-success"
                        class="ml-auto bg-transparent text-green-700 hover:text-green-900 dark:text-green-300 dark:hover:text-white">
                    <span class="sr-only">Fechar</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        @endif

        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-10">
            <h1 class="text-4xl font-extrabold text-gray-900 dark:text-white">Minhas Letras</h1>
            <a href="{{ route('songs.create') }}"
               class="inline-flex items-center gap-2 px-4 py-2.5 text-base font-medium text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                </svg>
                Publicar Nova Letra
            </a>
        </div>

        {{-- Lista ou mensagem --}}
        @if ($songs->isEmpty())
            <div class="p-6 text-center text-gray-600 bg-white border border-gray-200 rounded-lg shadow dark:bg-zinc-800 dark:border-zinc-700 dark:text-gray-300">
                Você ainda não publicou nenhuma letra.
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach ($songs as $song)
                    <div class="p-6 bg-white border border-gray-200 rounded-xl shadow hover:shadow-md transition dark:bg-zinc-800 dark:border-zinc-700">
                        <div class="flex items-center justify-between">
                            <h2 class="text-2xl font-bold text-gray-900 dark:text-white">{{ $song->title }}</h2>
                            <span class="text-xs text-gray-400 dark:text-gray-500">{{ $song->created_at->format('d/m/Y H:i') }}</span>
                        </div>

                        <hr class="my-4 border-gray-200 dark:border-gray-700">

                        <p class="text-gray-700 dark:text-gray-300 whitespace-pre-line text-sm leading-relaxed">
                            {{ Str::words(strip_tags($song->original_lyrics), 20, '...') }}
                        </p>

                        <div class="mt-6 flex flex-wrap gap-3">
                            {{-- Traduções --}}
{{--                            @if (!$song->translation)--}}
{{--                                <a href="{{ route('songs.translations.create', $song) }}"--}}
{{--                                   class="inline-flex items-center px-2 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-2 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-600 dark:focus:ring-blue-800">--}}
{{--                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">--}}
{{--                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>--}}
{{--                                    </svg>--}}
{{--                                    Criar Tradução--}}
{{--                                </a>--}}
{{--                            @else--}}
{{--                                <a href="{{ route('songs.translations.edit', $song) }}"--}}
{{--                                   class="inline-flex items-center px-2 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-2 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-600 dark:focus:ring-blue-800">--}}
{{--                                    <svg class="w-5 h-5 mr-2 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">--}}
{{--                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z"/>--}}
{{--                                    </svg>--}}
{{--                                    Editar Tradução--}}
{{--                                </a>--}}
{{--                            @endif--}}
                            <a href="{{ route('songs.edit', $song) }}"
                               class="flex items-center px-2 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-2 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-600 dark:focus:ring-blue-800">
                               <svg class="w-5 h-5 mr-2 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z"/>
                               </svg>
                                Editar Letra
                            </a>
                            {{-- Botão de exclusão --}}
                            <button data-modal-target="delete-modal-{{ $song->id }}" data-modal-toggle="delete-modal-{{ $song->id }}"
                                    class="flex items-center px-2 py-2 text-sm font-medium text-white bg-red-600 rounded-lg hover:bg-red-700 focus:ring-2 focus:ring-red-300 dark:bg-red-500 dark:hover:bg-red-600 dark:focus:ring-red-800">
                                <svg class="w-5 h-5 mr-2 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z"/>
                                </svg>
                                Excluir
                            </button>
                            @include('songs.modal.destroy')
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="mt-8">
                {{ $songs->links() }}
            </div>
        @endif
    </div>
</x-layouts.app>
