<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Song;
use Illuminate\Support\Facades\Auth;

class SongController extends Controller
{
    public function create()
    {
        return view('songs.create');
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

        return redirect()->route('songs.create')->with('success', 'Letra publicada com sucesso!');
    }
}
