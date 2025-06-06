<x-layouts.app>
    <div class="max-w-3xl mx-auto px-4 py-10">
        <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-6">Editar Letra</h1>

        <form method="POST" action="{{ route('songs.update', $song) }}">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Título</label>
                <input type="text" name="title" value="{{ old('title', $song->title) }}"
                       class="w-full px-4 py-2 mt-1 border rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-zinc-700 dark:text-white">
                @error('title')
                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Letra Original</label>
                <textarea name="original_lyrics" rows="10"
                          class="w-full px-4 py-2 mt-1 border rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-zinc-700 dark:text-white">{{ old('original_lyrics', $song->original_lyrics) }}</textarea>
                @error('original_lyrics')
                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

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
