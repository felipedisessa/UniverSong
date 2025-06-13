<x-layouts.app>
    <div class="max-w-3xl mx-auto px-4 py-10">
        <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-6">Editar Música</h1>

        <form method="POST" action="{{ route('songs.update', $song) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Título -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Título</label>
                <input type="text" name="title" value="{{ old('title', $song->title) }}"
                       class="w-full px-4 py-2 mt-1 border rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-zinc-700 dark:text-white">
                @error('title')
                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Áudio atual -->
            @if($song->audio_path)
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Áudio Atual</label>
                    <audio controls class="w-full mt-2">
                        <source src="{{ asset('storage/' . $song->audio_path) }}" type="audio/mpeg">
                        Seu navegador não suporta o elemento de áudio.
                    </audio>
                </div>
            @elseif($song->audio_url)
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Link Atual</label>
                    <a href="{{ $song->audio_url }}" target="_blank" class="text-blue-600 dark:text-blue-400 hover:underline text-sm">
                        {{ $song->audio_url }}
                    </a>
                </div>
            @endif

            <!-- Novo arquivo de áudio -->
            <div class="mb-4">
                <label for="audio_file" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Enviar Novo Arquivo de Áudio (opcional)</label>
                <input type="file" name="audio_file" id="audio_file"
                       accept="audio/mpeg,audio/mp3,audio/wav"
                       class="block w-full text-sm border border-gray-300 rounded-lg dark:bg-zinc-700 dark:text-white dark:border-zinc-600">
                @error('audio_file')
                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Novo link da música -->
            <div class="mb-4">
                <label for="audio_url" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Ou informe um novo link (YouTube, etc.)</label>
                <input type="url" name="audio_url" id="audio_url" value="{{ old('audio_url', $song->audio_url) }}"
                       placeholder="https://youtube.com/..."
                       class="block w-full text-sm border border-gray-300 rounded-lg dark:bg-zinc-700 dark:text-white dark:border-zinc-600">
                @error('audio_url')
                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Imagem -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Imagem (opcional)</label>

                @if($song->image)
                    <div class="mb-3">
                        <img src="{{ asset('storage/' . $song->image) }}"
                             alt="Imagem atual"
                             class="w-full max-w-xs h-auto rounded border dark:border-zinc-600 shadow">
                    </div>
                @endif

                <input type="file" name="image"
                       class="block w-full text-sm text-gray-900 bg-gray-50 border border-gray-300 rounded-lg cursor-pointer focus:outline-none dark:bg-zinc-700 dark:border-zinc-600 dark:text-white">
                @error('image')
                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Botões -->
            <div class="flex justify-end gap-3">
                <a href="{{ route('songs.index') }}"
                   class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-200 rounded hover:bg-gray-300 dark:bg-zinc-600 dark:text-white dark:hover:bg-zinc-500">
                    Cancelar
                </a>
                <button type="submit"
                        class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded hover:bg-blue-700 focus:ring-2 focus:ring-blue-400 dark:focus:ring-blue-800">
                    Salvar Alterações
                </button>
            </div>
        </form>
    </div>
</x-layouts.app>
