<?php

namespace App\Http\Controllers;

use App\Models\Song;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $query = Song::with('user')->latest();

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $songs = $query->paginate(9)->withQueryString();

        return view('dashboard', compact('songs'));
    }
}
