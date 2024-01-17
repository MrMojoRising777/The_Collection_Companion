<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Serie;

class SerieController extends Controller
{
    public function index()
    {
        $series = Serie::all();
        return view('series.index', compact('series'));
    }

    public function show($id)
    {
        $serie = Serie::find($id);

        if (!$serie) {
            // Handle case where record is not found
            return redirect()->route('series.index')->with('error', 'Serie not found.');
        }

        return view('series.show', compact('serie'));
    }
}
