@php use App\Enum\Genre; @endphp
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
                @error('title') <p class="text-sm text-red-500 mt-1">{{ $message }}</p> @enderror
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
                    <a href="{{ $song->audio_url }}" target="_blank"
                       class="text-blue-600 dark:text-blue-400 hover:underline text-sm">
                        {{ $song->audio_url }}
                    </a>
                </div>
            @endif

            <!-- Novo arquivo de áudio -->
            <div class="mb-4">
                <label for="audio_file" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Enviar Novo
                    Arquivo de Áudio (opcional)</label>
                <input type="file" name="audio_file" id="audio_file"
                       accept="audio/mpeg,audio/mp3,audio/wav"
                       class="block w-full text-sm border border-gray-300 rounded-lg dark:bg-zinc-700 dark:text-white dark:border-zinc-600">
                @error('audio_file') <p class="text-sm text-red-500 mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Novo link -->
            <div class="mb-4">
                <label for="audio_url" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Ou informe um
                    novo link (YouTube, etc.)</label>
                <input type="url" name="audio_url" id="audio_url" value="{{ old('audio_url', $song->audio_url) }}"
                       placeholder="https://youtube.com/..."
                       class="block w-full text-sm border border-gray-300 rounded-lg dark:bg-zinc-700 dark:text-white dark:border-zinc-600">
                @error('audio_url') <p class="text-sm text-red-500 mt-1">{{ $message }}</p> @enderror
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
                @error('image') <p class="text-sm text-red-500 mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Gênero -->
            <div class="mb-4">
                <label for="genre" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Gênero /
                    Estilo</label>
                <select name="genre" id="genre"
                        class="w-full mt-1 rounded-md border-gray-300 shadow-sm dark:bg-zinc-700 dark:text-white dark:border-zinc-600">
                    <option value="">Selecione um gênero</option>
                    @foreach(Genre::cases() as $genre)
                        <option
                            value="{{ $genre->value }}" {{ old('genre', $song->genre) === $genre->value ? 'selected' : '' }}>
                            {{ $genre->value }}
                        </option>
                    @endforeach
                </select>
                @error('genre') <p class="text-sm text-red-500 mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- BPM -->
            <div class="mb-4">
                <label for="bpm" class="block text-sm font-medium text-gray-700 dark:text-gray-300">BPM</label>
                <input type="number" name="bpm" id="bpm" min="40" max="300" value="{{ old('bpm', $song->bpm) }}"
                       class="w-full px-4 py-2 mt-1 border rounded-md dark:bg-zinc-700 dark:text-white">
                @error('bpm') <p class="text-sm text-red-500 mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Tom -->
            <div class="mb-4">
                <label for="key" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tonalidade</label>
                <input type="text" name="key" id="key" value="{{ old('key', $song->key) }}"
                       placeholder="Ex: C#m, F"
                       class="w-full px-4 py-2 mt-1 border rounded-md dark:bg-zinc-700 dark:text-white">
                @error('key') <p class="text-sm text-red-500 mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Mood -->
            <div class="mb-4">
                <label for="mood" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Mood</label>
                <input type="text" name="mood" id="mood" value="{{ old('mood', $song->mood) }}"
                       placeholder="Ex: Triste, Romântico"
                       class="w-full px-4 py-2 mt-1 border rounded-md dark:bg-zinc-700 dark:text-white">
                @error('mood') <p class="text-sm text-red-500 mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Idioma --}}
            <div class="mb-4">
                <label for="language" class="block text-sm font-medium text-gray-900 dark:text-white">Idioma</label>
                <select name="language" id="language"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-zinc-700 dark:text-white dark:border-zinc-600">
                    <option value="">Selecione um idioma</option>
                    <option value="pt" {{ old('language', $song->language) === 'pt' ? 'selected' : '' }}>Português
                    </option>
                    <option value="en" {{ old('language', $song->language) === 'en' ? 'selected' : '' }}>Inglês</option>
                    <option value="es" {{ old('language', $song->language) === 'es' ? 'selected' : '' }}>Espanhol
                    </option>
                    <option value="fr" {{ old('language', $song->language) === 'fr' ? 'selected' : '' }}>Francês
                    </option>
                    <option value="de" {{ old('language', $song->language) === 'de' ? 'selected' : '' }}>Alemão</option>
                    <option value="it" {{ old('language', $song->language) === 'it' ? 'selected' : '' }}>Italiano
                    </option>
                    <option value="ja" {{ old('language', $song->language) === 'ja' ? 'selected' : '' }}>Japonês
                    </option>
                    <option value="ko" {{ old('language', $song->language) === 'ko' ? 'selected' : '' }}>Coreano
                    </option>
                    <option value="zh" {{ old('language', $song->language) === 'zh' ? 'selected' : '' }}>Chinês</option>
                </select>
                @error('language') <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p> @enderror
            </div>

            <!-- Tags -->
            <div class="mb-4">
                <label for="tags" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tags (separadas por
                    vírgula)</label>
                <input type="text" name="tags" id="tags" value="{{ old('tags', $song->tags) }}"
                       placeholder="ex: love, verão, vibes"
                       class="w-full px-4 py-2 mt-1 border rounded-md dark:bg-zinc-700 dark:text-white">
                @error('tags') <p class="text-sm text-red-500 mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Visibilidade -->
            <div class="flex items-center mb-6 gap-2">
                <input type="checkbox" name="is_public" id="is_public" value="1"
                       {{ old('is_public', $song->is_public) ? 'checked' : '' }}
                       class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded dark:bg-zinc-700 dark:border-gray-600">
                <label for="is_public" class="text-sm text-gray-900 dark:text-white">Tornar público</label>
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
