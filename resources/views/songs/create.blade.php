<x-layouts.app>
    <div class="max-w-2xl mx-auto px-4 py-8">

        <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-6">Publicar Nova Letra</h1>

        {{-- Alerta de sucesso --}}
        @if(session('success'))
            <div class="mb-4 flex items-center p-4 text-sm text-green-800 border border-green-300 rounded-lg bg-green-50 dark:bg-green-800 dark:text-green-100 dark:border-green-600" role="alert">
                <span class="sr-only">Success</span>
                <div>{{ session('success') }}</div>
            </div>
        @endif

        {{-- Formulário --}}
        <form action="{{ route('songs.store') }}" method="POST" class="space-y-6">
            @csrf

            <div>
                <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Título</label>
                <input type="text" name="title" id="title"
                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full p-2.5 dark:bg-zinc-700 dark:border-zinc-600 dark:placeholder-gray-400 dark:text-white"
                       value="{{ old('title') }}" required>
                @error('title')
                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="original_lyrics" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Letra Original</label>
                <textarea name="original_lyrics" id="original_lyrics" rows="8"
                          class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-zinc-700 dark:border-zinc-600 dark:placeholder-gray-400 dark:text-white"
                          required>{{ old('original_lyrics') }}</textarea>
                @error('original_lyrics')
                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                Publicar
            </button>
        </form>

    </div>
</x-layouts.app>
