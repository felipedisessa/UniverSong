<?php

namespace App\Http\Controllers;

use App\Enum\Genre;
use App\Models\Song;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $query = Song::with('user')
            ->where('is_public', true)
            ->latest();

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('genre')) {
            $query->where('genre', $request->genre);
        }

        if ($request->filled('language')) {
            $query->where('language', $request->language);
        }

        $songs = $query->paginate(9)->withQueryString();

        return view('dashboard', [
            'songs' => $songs,
            'genres' => Genre::cases(),
            'selectedGenre' => $request->genre,
            'selectedLanguage' => $request->language,
        ]);
    }
}
