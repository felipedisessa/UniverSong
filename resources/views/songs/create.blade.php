@php use App\Enum\Genre; @endphp
<x-layouts.app>
    <div class="max-w-2xl mx-auto px-4 py-8">

        <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-6">Publicar Nova Música</h1>

        {{-- Alerta de sucesso --}}
        @if(session('success'))
            <div
                class="mb-4 flex items-center p-4 text-sm text-green-800 border border-green-300 rounded-lg bg-green-50 dark:bg-green-800 dark:text-green-100 dark:border-green-600"
                role="alert">
                <span class="sr-only">Success</span>
                <div>{{ session('success') }}</div>
            </div>
        @endif

        {{-- Formulário --}}
        <form action="{{ route('songs.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            {{-- Título --}}
            <div>
                <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Título</label>
                <input type="text" name="title" id="title" value="{{ old('title') }}"
                       class="bg-gray-50 border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full p-2.5 dark:bg-zinc-700 dark:border-zinc-600 dark:text-white"
                       required>
                @error('title') <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p> @enderror
            </div>

            {{-- Arquivo de áudio --}}
            <div>
                <label for="audio_file" class="block text-sm font-medium text-gray-900 dark:text-white">Arquivo de
                    Áudio</label>
                <input type="file" name="audio_file" id="audio_file"
                       accept="audio/mpeg,audio/mp3,audio/wav"
                       class="block w-full text-sm border border-gray-300 rounded-lg dark:bg-zinc-700 dark:text-white dark:border-zinc-600">
                @error('audio_file') <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p> @enderror
            </div>

            {{-- Link alternativo --}}
            <div>
                <label for="audio_url" class="block text-sm font-medium text-gray-900 dark:text-white">Ou Link (ex:
                    YouTube)</label>
                <input type="url" name="audio_url" id="audio_url" value="{{ old('audio_url') }}"
                       placeholder="https://youtube.com/..."
                       class="block w-full text-sm border border-gray-300 rounded-lg dark:bg-zinc-700 dark:text-white dark:border-zinc-600">
                @error('audio_url') <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p> @enderror
            </div>

            {{-- Imagem --}}
            <div>
                <label for="image" class="block text-sm font-medium text-gray-900 dark:text-white">Imagem
                    (opcional)</label>
                <input type="file" name="image" id="image" accept="image/jpeg,image/png"
                       class="block w-full text-sm border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-white dark:bg-zinc-700 dark:border-zinc-600">
                @error('image') <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p> @enderror
            </div>

            {{-- Gênero --}}
            <div>
                <label for="genre" class="block text-sm font-medium text-gray-900 dark:text-white">Gênero /
                    Estilo</label>
                <select name="genre" id="genre"
                        class="w-full mt-1 rounded-md border-gray-300 shadow-sm dark:bg-zinc-700 dark:text-white dark:border-zinc-600">
                    <option value="">Selecione um gênero</option>
                    @foreach(Genre::cases() as $genre)
                        <option
                            value="{{ $genre->value }}" {{ old('genre', $song->genre ?? '') === $genre->value ? 'selected' : '' }}>
                            {{ $genre->value }}
                        </option>
                    @endforeach
                </select>
                @error('genre') <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p> @enderror
            </div>

            {{-- BPM --}}
            <div>
                <label for="bpm" class="block text-sm font-medium text-gray-900 dark:text-white">BPM</label>
                <input type="number" name="bpm" id="bpm" min="40" max="300" value="{{ old('bpm') }}"
                       class="w-full p-2.5 text-sm border rounded-lg dark:bg-zinc-700 dark:text-white dark:border-zinc-600">
                @error('bpm') <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p> @enderror
            </div>

            {{-- Tom --}}
            <div>
                <label for="key" class="block text-sm font-medium text-gray-900 dark:text-white">Tonalidade</label>
                <input type="text" name="key" id="key" value="{{ old('key') }}"
                       placeholder="Ex: C#m, D, F"
                       class="w-full p-2.5 text-sm border rounded-lg dark:bg-zinc-700 dark:text-white dark:border-zinc-600">
                @error('key') <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p> @enderror
            </div>

            {{-- Mood --}}
            <div>
                <label for="mood" class="block text-sm font-medium text-gray-900 dark:text-white">Clima / Mood</label>
                <input type="text" name="mood" id="mood" value="{{ old('mood') }}"
                       placeholder="Ex: Romântico, Triste, Reflexivo"
                       class="w-full p-2.5 text-sm border rounded-lg dark:bg-zinc-700 dark:text-white dark:border-zinc-600">
                @error('mood') <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p> @enderror
            </div>

            {{-- Idioma --}}
            <div>
                <label for="language" class="block text-sm font-medium text-gray-900 dark:text-white">Idioma</label>
                <select name="language" id="language"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-zinc-700 dark:text-white dark:border-zinc-600">
                    <option value="">Selecione um idioma</option>
                    <option value="pt">Português</option>
                    <option value="en">Inglês</option>
                    <option value="es">Espanhol</option>
                    <option value="fr">Francês</option>
                    <option value="de">Alemão</option>
                    <option value="it">Italiano</option>
                    <option value="ja">Japonês</option>
                    <option value="ko">Coreano</option>
                    <option value="zh">Chinês</option>
                </select>
                @error('language') <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p> @enderror
            </div>

            {{-- Tags --}}
            <div>
                <label for="tags" class="block text-sm font-medium text-gray-900 dark:text-white">Tags (separadas por
                    vírgula)</label>
                <input type="text" name="tags" id="tags" value="{{ old('tags') }}"
                       placeholder="ex: love, verão, vibes"
                       class="w-full p-2.5 text-sm border rounded-lg dark:bg-zinc-700 dark:text-white dark:border-zinc-600">
                @error('tags') <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p> @enderror
            </div>

            {{-- Visibilidade --}}
            <div class="flex items-center gap-2">
                <input type="checkbox" name="is_public" id="is_public" value="1" checked
                       class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:bg-zinc-700 dark:border-gray-600">
                <label for="is_public" class="text-sm text-gray-900 dark:text-white">Tornar público</label>
            </div>

            {{-- Botão --}}
            <button type="submit"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Publicar
            </button>
        </form>

    </div>
</x-layouts.app>
