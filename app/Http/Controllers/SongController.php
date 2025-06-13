<?php

namespace App\Http\Controllers;

use App\Models\Song;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SongController extends Controller
{
    public function index(Request $request)
    {
        $query = Auth::user()->songs()->latest();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('title', 'like', '%' . $search . '%');
        }

        $songs = $query->paginate(9)->withQueryString();

        return view('songs.index', compact('songs'));
    }

    public function show(Song $song)
    {
        return view('songs.show', compact('song'));
    }

    public function create()
    {
        return view('songs.create');
    }

    public function edit(Song $song)
    {
        return view('songs.edit', compact('song'));
    }

    public function update(Request $request, Song $song)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'audio_file' => 'nullable|file|mimetypes:audio/mpeg,audio/mp3,wav|max:20480',
            'audio_url' => 'nullable|url',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'genre' => 'nullable|string|max:100',
            'bpm' => 'nullable|integer|min:40|max:300',
            'key' => 'nullable|string|max:10',
            'mood' => 'nullable|string|max:100',
            'language' => 'nullable|string|max:10',
            'tags' => 'nullable|string|max:255',
            'is_public' => 'sometimes|boolean',
        ]);

        if (!$request->hasFile('audio_file') && !$request->filled('audio_url') && !$song->audio_path && !$song->audio_url) {
            return back()->withErrors(['audio_file' => 'Você precisa manter ou enviar um arquivo de áudio ou link.']);
        }

        $updateData = [
            'title' => $validated['title'],
            'genre' => $validated['genre'] ?? null,
            'bpm' => $validated['bpm'] ?? null,
            'key' => $validated['key'] ?? null,
            'mood' => $validated['mood'] ?? null,
            'language' => $validated['language'] ?? null,
            'tags' => $validated['tags'] ?? null,
            'is_public' => $request->boolean('is_public', true),
        ];

        if ($request->hasFile('image')) {
            $updateData['image'] = $request->file('image')->store('songs', 'public');
        }

        if ($request->hasFile('audio_file')) {
            $updateData['audio_path'] = $request->file('audio_file')->store('songs/audio', 'public');
            $updateData['audio_url'] = null;
        } elseif ($request->filled('audio_url')) {
            $updateData['audio_url'] = $validated['audio_url'];
            $updateData['audio_path'] = null;
        }

        $song->update($updateData);

        return redirect()->route('songs.index')->with('success', 'Música atualizada com sucesso!');
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'audio_file' => 'nullable|file|mimetypes:audio/mpeg,audio/mp3,wav|max:20480',
            'audio_url' => 'nullable|url',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'genre' => 'nullable|string|max:100',
            'bpm' => 'nullable|integer|min:40|max:300',
            'key' => 'nullable|string|max:10',
            'mood' => 'nullable|string|max:100',
            'language' => 'nullable|string|max:10',
            'tags' => 'nullable|string|max:255',
            'is_public' => 'sometimes|boolean',
        ]);

        if (!$request->hasFile('audio_file') && !$request->filled('audio_url')) {
            return back()->withErrors(['audio_file' => 'Envie um arquivo de áudio ou forneça um link.']);
        }

        $audioPath = $request->hasFile('audio_file')
            ? $request->file('audio_file')->store('songs/audio', 'public')
            : null;

        $imagePath = $request->hasFile('image')
            ? $request->file('image')->store('songs', 'public')
            : null;

        Song::create([
            'user_id' => Auth::id(),
            'title' => $validated['title'],
            'audio_path' => $audioPath,
            'audio_url' => $validated['audio_url'],
            'image' => $imagePath,
            'genre' => $validated['genre'] ?? null,
            'bpm' => $validated['bpm'] ?? null,
            'key' => $validated['key'] ?? null,
            'mood' => $validated['mood'] ?? null,
            'language' => $validated['language'] ?? null,
            'tags' => $validated['tags'] ?? null,
            'is_public' => $request->boolean('is_public', true),
        ]);

        return redirect()->route('songs.index')->with('success', 'Letra publicada com sucesso!');
    }

    public function destroy(Song $song)
    {
        $song->delete();

        return redirect()->route('songs.index')->with('success', 'Letra excluída com sucesso!');
    }
}
