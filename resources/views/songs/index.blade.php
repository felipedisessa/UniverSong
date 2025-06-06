@php use Illuminate\Support\Str; @endphp
<x-layouts.app>
    <div class="max-w-4xl mx-auto p-4">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold">Minhas Letras</h1>
            <a href="{{ route('songs.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                + Nova Letra
            </a>
        </div>

        @if ($songs->isEmpty())
            <p class="text-gray-600">Você ainda não publicou nenhuma letra.</p>
        @else
            <div class="space-y-4">
                @foreach ($songs as $song)
                    <div class="p-4 border rounded shadow-sm hover:shadow-md transition">
                        <h2 class="text-xl font-semibold">{{ $song->title }}</h2>
                        <p class="text-sm text-gray-500">Publicado em {{ $song->created_at->format('d/m/Y H:i') }}</p>
                        <p class="mt-2 text-gray-700 whitespace-pre-line line-clamp-3">
                            {{ Str::limit($song->original_lyrics, 200) }}
                        </p>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</x-layouts.app>
