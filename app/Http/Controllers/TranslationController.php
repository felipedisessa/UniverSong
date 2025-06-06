<?php

namespace App\Http\Controllers;

use App\Models\Song;
use App\Models\Translation;
use Illuminate\Http\Request;

class TranslationController extends Controller
{
    public function create(Song $song)
    {
        if ($song->translation) {
            return back()->with('error', 'Esta letra ja foi traduzida!');
        }

        return view('translations.create', compact('song'));
    }

    public function store(Request $request, Song $song)
    {
        $validated = $request->validate([
            'translated_lyrics' => 'required|string',
        ]);

        $song->translation()->create($validated);

        return redirect()->route('songs.index')->with('success', 'Letra traduzida com sucesso!');
    }
}
