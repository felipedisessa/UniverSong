<?php

namespace App\Http\Controllers;

use App\Models\Song;
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

    public function edit(Song $song)
    {
        $translation = $song->translation;

        if (! $translation) {
            return redirect()->route('songs.translations.create', $song)
                ->with('info', 'Esta música ainda não possui uma tradução.');
        }

        return view('translations.edit', compact('song', 'translation'));
    }

    public function update(Request $request, Song $song)
    {
        $translation = $song->translation;

        if (! $translation) {
            return back()->with('error', 'Tradução não encontrada.');
        }

        $validated = $request->validate([
            'translated_lyrics' => 'required|string',
        ]);

        $translation->update($validated);

        return redirect()->route('songs.index')->with('success', 'Tradução atualizada com sucesso!');
    }
}
