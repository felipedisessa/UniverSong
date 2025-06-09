<x-layouts.app>
    <div class="bg-[#fdfdfc] dark:bg-zinc-800 py-10">
        <div class="max-w-7xl mx-auto px-4">
            <!-- Hero Section -->
            <div class="text-center mb-12">
                <h1 class="text-5xl font-extrabold text-zinc-900 dark:text-white mb-3">Descubra Letras de Músicas</h1>
                <p class="text-zinc-600 dark:text-zinc-400 text-lg max-w-2xl mx-auto">
                    Explore as mais recentes letras publicadas por artistas da comunidade. Compartilhe suas próprias criações ou busque inspiração.
                </p>
            </div>

            <!-- Search Bar -->
            <form method="GET" action="{{ route('dashboard') }}" class="flex flex-col md:flex-row justify-center gap-3 mb-10">
                <input type="text" name="search" value="{{ request('search') }}"
                       placeholder="Buscar por título ou artista..."
                       class="w-full md:w-96 px-5 py-3 border border-zinc-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-zinc-700 dark:text-white dark:border-zinc-600" />
                <button type="submit"
                        class="inline-flex items-center justify-center px-6 py-3 text-sm font-semibold text-white bg-blue-600 hover:bg-blue-700 rounded-lg transition">
                    Buscar
                </button>
            </form>

            <!-- Songs Grid -->
            @if($songs->isEmpty())
                <div class="p-6 text-center bg-white border rounded-lg dark:bg-zinc-800 dark:text-gray-300">
                    Nenhuma música encontrada.
                </div>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach ($songs as $song)
                        <div class="bg-white dark:bg-zinc-800 border border-zinc-200 dark:border-zinc-700 rounded-lg overflow-hidden shadow-sm hover:shadow-lg transition">

                            @if ($song->image)
                                <img src="{{ asset('storage/' . $song->image) }}"
                                     alt="Imagem de {{ $song->title }}"
                                     class="w-full h-48 object-cover" />
                            @endif

                            <div class="p-6">
                                <h2 class="text-xl font-bold text-zinc-900 dark:text-white truncate mb-1">{{ $song->title }}</h2>
                                <p class="text-sm text-zinc-500 dark:text-zinc-400 mb-4">
                                    por <span class="font-medium">{{ $song->user->name ?? 'Anônimo' }}</span> • {{ $song->created_at->format('d/m/Y') }}
                                </p>
                                <p class="text-sm text-zinc-700 dark:text-zinc-300 whitespace-pre-line leading-snug">
                                    {{ Str::words(strip_tags($song->original_lyrics), 30, '...') }}
                                </p>
                            </div>

                            <div class="px-6 pb-4">
                                <a href="{{ route('songs.show', $song) }}"
                                   class="text-blue-600 dark:text-blue-400 hover:underline text-sm font-medium">
                                    Ver Letra Completa
                                </a>
                            </div>
                        </div>

                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-10 flex justify-center">
                    {{ $songs->links() }}
                </div>
            @endif
        </div>
    </div>
</x-layouts.app>
