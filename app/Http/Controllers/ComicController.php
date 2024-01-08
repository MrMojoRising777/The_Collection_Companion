<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Abbreviation;
use App\Models\Comic;

class ComicController extends Controller
{
    public function index()
    {
        $comics = Comic::all();
        $abbreviations = Abbreviation::all();

        return view('comics.index', compact('comics', 'abbreviations'));
    }

    public function filter(Request $request)
    {
        $abbreviation = $request->input('abbreviation');
        $filteredComics = Comic::where($abbreviation, '>', 0)->get();

        return view('comics.filtered', compact('filteredComics', 'abbreviation'));
    }
}
