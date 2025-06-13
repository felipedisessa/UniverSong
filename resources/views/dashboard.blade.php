@php use App\Enum\Genre; @endphp
<x-layouts.app>
    <div class="bg-[#fdfdfc] dark:bg-zinc-800 py-10">
        <div class="max-w-7xl mx-auto px-4">

            <!-- Hero Section -->
            <div class="text-center mb-10">
                <h1 class="text-5xl font-extrabold text-zinc-900 dark:text-white mb-3">Descubra Novas Músicas</h1>
                <p class="text-zinc-600 dark:text-zinc-400 text-lg max-w-2xl mx-auto">
                    Explore o que a comunidade está criando. Filtre por gênero, idioma ou nome.
                </p>
            </div>

            <!-- Filtros com Botão -->
            <form method="GET" action="{{ route('dashboard') }}" class="grid grid-cols-1 md:grid-cols-5 gap-4 items-end mb-10">
                <div class="md:col-span-2">
                    <label for="search" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-1">Buscar por título</label>
                    <input type="text" name="search" id="search" value="{{ request('search') }}"
                           placeholder="Ex: Amor, Luz, Paz..."
                           class="w-full px-4 py-2 border border-zinc-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-zinc-700 dark:text-white dark:border-zinc-600" />
                </div>

                <div>
                    <label for="genre" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-1">Gênero</label>
                    <select name="genre" id="genre"
                            class="w-full px-4 py-2 border rounded-md dark:bg-zinc-700 dark:text-white dark:border-zinc-600">
                        <option value="">Todos</option>
                        @foreach ($genres as $g)
                            <option value="{{ $g->value }}" {{ request('genre') === $g->value ? 'selected' : '' }}>
                                {{ $g->value }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="language" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-1">Idioma</label>
                    <select name="language" id="language"
                            class="w-full px-4 py-2 border rounded-md dark:bg-zinc-700 dark:text-white dark:border-zinc-600">
                        <option value="">Todos</option>
                        <option value="pt" {{ request('language') === 'pt' ? 'selected' : '' }}>Português</option>
                        <option value="en" {{ request('language') === 'en' ? 'selected' : '' }}>Inglês</option>
                        <option value="es" {{ request('language') === 'es' ? 'selected' : '' }}>Espanhol</option>
                        <option value="fr" {{ request('language') === 'fr' ? 'selected' : '' }}>Francês</option>
                        <option value="de" {{ request('language') === 'de' ? 'selected' : '' }}>Alemão</option>
                        <option value="it" {{ request('language') === 'it' ? 'selected' : '' }}>Italiano</option>
                        <option value="ja" {{ request('language') === 'ja' ? 'selected' : '' }}>Japonês</option>
                        <option value="ko" {{ request('language') === 'ko' ? 'selected' : '' }}>Coreano</option>
                        <option value="zh" {{ request('language') === 'zh' ? 'selected' : '' }}>Chinês</option>
                    </select>
                </div>

                <div class="flex justify-end">
                    <button type="submit"
                            class="w-full px-4 py-2 text-sm font-semibold text-white bg-blue-600 hover:bg-blue-700 rounded-md shadow">
                        Buscar
                    </button>
                </div>
            </form>

            <!-- Resultado -->
            @if($songs->isEmpty())
                <div class="p-6 text-center bg-white border rounded-lg dark:bg-zinc-800 dark:text-gray-300">
                    Nenhuma música encontrada com os filtros aplicados.
                </div>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach ($songs as $song)
                        <div class="bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-700 rounded-lg overflow-hidden shadow-sm hover:shadow-lg transition">

                            @if ($song->image)
                                <img src="{{ asset('storage/' . $song->image) }}"
                                     alt="Imagem de {{ $song->title }}"
                                     class="w-full h-48 object-cover" />
                            @endif

                            <div class="p-5">
                                <h2 class="text-xl font-bold text-zinc-900 dark:text-white truncate">{{ $song->title }}</h2>
                                <p class="text-sm text-zinc-500 dark:text-zinc-400 mb-2">
                                    por <span class="font-medium">{{ $song->user->name ?? 'Anônimo' }}</span><br>
                                    <span class="text-xs">{{ $song->created_at->format('d/m/Y') }}</span>
                                </p>

                                <div class="text-sm text-zinc-600 dark:text-zinc-300 mb-3">
                                    @if ($song->genre) 🎵 {{ $song->genre }} @endif
                                    @if ($song->language) • 🌍 {{ strtoupper($song->language) }} @endif
                                    @if ($song->bpm) • 🧭 {{ $song->bpm }} BPM @endif
                                </div>

                                @if ($song->audio_path)
                                    <audio controls class="w-full mb-3">
                                        <source src="{{ asset('storage/' . $song->audio_path) }}" type="audio/mpeg">
                                        Seu navegador não suporta o player de áudio.
                                    </audio>
                                @elseif ($song->audio_url)
                                    <a href="{{ $song->audio_url }}" target="_blank" class="text-blue-600 dark:text-blue-400 hover:underline text-sm">
                                        Ouvir no YouTube
                                    </a>
                                @else
                                    <p class="text-sm text-red-500">Nenhum áudio disponível.</p>
                                @endif

                                <a href="{{ route('songs.show', $song) }}"
                                   class="inline-block mt-4 text-blue-600 dark:text-blue-400 hover:underline text-sm font-medium">
                                    Detalhes da Música →
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Paginação -->
                <div class="mt-10 flex justify-center">
                    {{ $songs->links() }}
                </div>
            @endif
        </div>
    </div>
</x-layouts.app>
