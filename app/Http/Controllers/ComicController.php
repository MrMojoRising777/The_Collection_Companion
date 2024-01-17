<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Serie;
use App\Models\Comic;

class ComicController extends Controller
{
    public function index()
    {
        $comics = Comic::all();
        $series = Serie::all();

        return view('comics.index', compact('comics', 'series'));
    }

    public function show(Comic $comic)
    {
        return view('comics.show', compact('comic'));
    }

    public function filter(Request $request)
    {
        $serie = $request->input('serie');
        $filteredComics = Comic::where($abbreviation, '>', 0)->get();

        return view('comics.filtered', compact('filteredComics', 'serie'));
    }

    public function markAsObtained($id)
    {
        $comic = Comic::find($id);

        if ($comic) {
            $comic->update(['obtained' => true]);
            return response()->json(['message' => 'Comic marked as obtained.']);
        }

        return response()->json(['error' => 'Comic not found.'], 404);
    }

    public function toggleObtained(Comic $comic)
    {
        $comic->update(['obtained' => !$comic->obtained]);

        return redirect()->back()->with('success', 'Obtained status updated successfully.');
    }
}
