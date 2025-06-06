<x-layouts.app>
    <div class="max-w-3xl mx-auto px-4 py-8">

        <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-6">Adicionar Tradução para: <span class="text-blue-600">{{ $song->title }}</span></h1>

        <form method="POST" action="{{ route('songs.translations.store', $song) }}" class="space-y-6">
            @csrf

            <div>
                <label for="translated_lyrics" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tradução</label>
                <textarea name="translated_lyrics" id="translated_lyrics" rows="10"
                          class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-zinc-700 dark:border-zinc-600 dark:placeholder-gray-400 dark:text-white"
                          required>{{ old('translated_lyrics') }}</textarea>
                @error('translated_lyrics')
                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                Salvar Tradução
            </button>
        </form>
    </div>
</x-layouts.app>
