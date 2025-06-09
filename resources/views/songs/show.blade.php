<x-layouts.app>
    <div class="bg-[#fdfdfc] dark:bg-zinc-800 py-10">
        <div class="max-w-4xl mx-auto px-4">

            <!-- Voltar -->
            <div class="mb-6">
                <a href="{{ url()->previous() }}"
                   class="text-blue-600 dark:text-blue-400 hover:underline text-sm flex items-center gap-1">
                    ← Voltar
                </a>
            </div>

            <!-- Card da música -->
            <div class="bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-700 rounded-lg shadow-md overflow-hidden">
                @if ($song->image)
                    <img src="{{ asset('storage/' . $song->image) }}"
                         alt="Imagem de {{ $song->title }}"
                         class="w-full h-64 object-cover">
                @endif

                <div class="p-6">
                    <h1 class="text-3xl font-extrabold text-zinc-900 dark:text-white mb-2">
                        {{ $song->title }}
                    </h1>

                    <p class="text-sm text-zinc-500 dark:text-zinc-400 mb-4">
                        por <span class="font-medium">{{ $song->user->name ?? 'Anônimo' }}</span> • {{ $song->created_at->format('d/m/Y') }}
                    </p>

                    <div class="prose prose-zinc max-w-none dark:prose-invert text-base leading-relaxed whitespace-pre-line mb-6">
                        {{ $song->original_lyrics }}
                    </div>

                    <!-- Sobre o artista -->
                    @if($song->user)
                        <div class="mt-8 border-t pt-6 dark:border-zinc-700">
                            <h2 class="text-lg font-semibold text-zinc-900 dark:text-white mb-2">Sobre o Artista</h2>

                            <div class="flex items-center gap-4">
                                <div class="flex-shrink-0">
                                    <div class="w-12 h-12 bg-blue-100 text-blue-600 dark:bg-blue-900 dark:text-blue-300 rounded-full flex items-center justify-center font-bold text-lg uppercase">
                                        {{ strtoupper(substr($song->user->name, 0, 1)) }}
                                    </div>
                                </div>
                                <div>
                                    <p class="text-zinc-800 dark:text-zinc-200 font-medium">
                                        {{ $song->user->name }}
                                    </p>
                                    <p class="text-sm text-zinc-500 dark:text-zinc-400">
                                        Membro desde {{ $song->user->created_at->format('M/Y') }}
                                    </p>
                                </div>
                                <div class="ml-auto">
                                    <a href="#"
                                       class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-lg transition shadow-sm">
                                        Ver Perfil
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
</x-layouts.app>
