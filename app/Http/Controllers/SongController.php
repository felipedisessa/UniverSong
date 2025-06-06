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
            'original_lyrics' => 'required|string',
        ]);

        $song->update($validated);

        return redirect()->route('songs.index')->with('success', 'Letra atualizada com sucesso!');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'original_lyrics' => 'required|string',
        ]);

        Song::create([
            'user_id' => Auth::id(),
            'title' => $validated['title'],
            'original_lyrics' => $validated['original_lyrics'],
        ]);

        return redirect()->route('songs.index')->with('success', 'Letra publicada com sucesso!');
    }

    public function destroy(Song $song)
    {
        $song->delete();

        return redirect()->route('songs.index')->with('success', 'Letra excluída com sucesso!');
    }
}
