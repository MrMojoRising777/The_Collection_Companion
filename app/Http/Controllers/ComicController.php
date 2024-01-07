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
}
