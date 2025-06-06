@php use Illuminate\Support\Str; @endphp

<x-layouts.app>
    <div class="max-w-5xl mx-auto px-4 py-8">

        {{-- Cabeçalho com botão de nova letra --}}
        <div class="flex items-center justify-between mb-8">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Minhas Letras</h1>

            <a href="{{ route('songs.create') }}"
               class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                <svg class="w-4 h-4 mr-2 -ml-1" fill="none" stroke="currentColor" stroke-width="2"
                     viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M12 4v16m8-8H4"></path>
                </svg>
                Nova Letra
            </a>
        </div>

        {{-- Lista de músicas --}}
        @if ($songs->isEmpty())
            <div class="p-6 text-center text-gray-500 bg-white border border-gray-200 rounded-lg shadow dark:bg-zinc-800 dark:border-zinc-700 dark:text-gray-400">
                Você ainda não publicou nenhuma letra.
            </div>
        @else
            <div class="grid gap-6">
                @foreach ($songs as $song)
                    <div class="p-6 bg-white border border-gray-200 rounded-lg shadow hover:shadow-lg transition dark:bg-zinc-800 dark:border-zinc-700">
                        <h2 class="mb-1 text-2xl font-semibold text-gray-900 dark:text-white">{{ $song->title }}</h2>
                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            Publicado em {{ $song->created_at->format('d/m/Y H:i') }}
                        </p>
                        <hr class="my-3 border-gray-200 dark:border-gray-700">
                        <p class="text-gray-700 dark:text-gray-300 whitespace-pre-line">
                            {{ Str::limit($song->original_lyrics, 200) }}
                        </p>
                    </div>
                @endforeach
            </div>
        @endif

    </div>
</x-layouts.app>
