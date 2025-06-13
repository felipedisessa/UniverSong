<x-layouts.app>
    <div class="bg-[#fdfdfc] dark:bg-zinc-800 py-10">
        <div class="max-w-6xl mx-auto px-4 space-y-10">

            <!-- Banner do Artista -->
            <div class="bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-700 rounded-xl overflow-hidden shadow-md p-8 flex flex-col sm:flex-row items-center gap-6">
                <div class="flex-shrink-0">
                    <div class="w-32 h-32 rounded-full bg-blue-100 dark:bg-blue-800 flex items-center justify-center text-4xl font-bold text-blue-700 dark:text-blue-300">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>
                </div>
                <div class="flex-1">
                    <h1 class="text-3xl font-bold text-zinc-900 dark:text-white">{{ $user->name }}</h1>
                    <p class="text-zinc-600 dark:text-zinc-400 mt-1">
                        Membro desde {{ $user->created_at->translatedFormat('F \\d\\e Y') }}

                    </p>
                    <p class="text-zinc-500 dark:text-zinc-400 mt-4 max-w-2xl">
                        Este artista compartilha suas letras com a comunidade. Se você é um produtor ou está interessado em colaborar, entre em contato!
                    </p>
                    <div class="mt-5">
                        <button type="button"
                                class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                 stroke-width="1.5" viewBox="0 0 24 24"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M21 12.5v4.75A2.75 2.75 0 0118.25 20H5.75A2.75 2.75 0 013 17.25v-4.75m9-6.75L12 12m0 0l-3.5-3.5m3.5 3.5L15.5 8.5">
                                </path>
                            </svg>
                            Entrar em Contato
                        </button>
                    </div>
                </div>
            </div>

            <div>
                <h2 class="text-xl font-semibold text-zinc-800 dark:text-white mb-4">Músicas Publicadas</h2>

                @if($user->songs->isEmpty())
                    <p class="text-zinc-500 dark:text-zinc-400">Nenhuma música publicada ainda.</p>
                @else
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach ($user->songs as $song)
                            <div class="bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-700 rounded-lg shadow-sm overflow-hidden hover:shadow-md transition">
                                @if ($song->image)
                                    <img src="{{ asset('storage/' . $song->image) }}"
                                         alt="Imagem de {{ $song->title }}"
                                         class="w-full h-40 object-cover">
                                @endif
                                    <div class="p-4">
                                        <h3 class="text-lg font-bold text-zinc-900 dark:text-white truncate">
                                            {{ $song->title }}
                                        </h3>
                                        <p class="text-sm text-zinc-500 dark:text-zinc-400 mb-3">
                                            Publicada em {{ $song->created_at->format('d/m/Y') }}
                                        </p>

                                        @if ($song->audio_path)
                                            <audio controls class="w-full mb-4">
                                                <source src="{{ asset('storage/' . $song->audio_path) }}" type="audio/mpeg">
                                                Seu navegador não suporta o player de áudio.
                                            </audio>
                                        @elseif ($song->audio_url)
                                            <p class="mb-4">
                                                <a href="{{ $song->audio_url }}" target="_blank" class="text-blue-600 dark:text-blue-400 hover:underline text-sm">
                                                    Ouvir no YouTube
                                                </a>
                                            </p>
                                        @else
                                            <p class="text-sm text-red-500 mb-4">Nenhum áudio disponível.</p>
                                        @endif

                                        <a href="{{ route('songs.show', $song) }}"
                                           class="text-blue-600 dark:text-blue-400 hover:underline text-sm font-medium">
                                            Detalhes da Música
                                        </a>
                                    </div>

                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-layouts.app>
