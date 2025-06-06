<x-layouts.app>
    <div class="max-w-3xl mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-6">
            Editar Tradução: <span class="text-blue-600">{{ $song->title }}</span>
        </h1>

        <form method="POST" action="{{ route('songs.translations.update', $song) }}" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label for="translated_lyrics" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tradução</label>
                <textarea name="translated_lyrics" id="translated_lyrics" rows="10"
                          class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-zinc-700 dark:border-zinc-600 dark:placeholder-gray-400 dark:text-white"
                          required>{{ old('translated_lyrics', $translation->translated_lyrics) }}</textarea>
                @error('translated_lyrics')
                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit"
                    class="text-white bg-yellow-600 hover:bg-yellow-700 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-yellow-500 dark:hover:bg-yellow-600 focus:outline-none dark:focus:ring-yellow-800">
                Atualizar Tradução
            </button>
        </form>
    </div>
</x-layouts.app>
