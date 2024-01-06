<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Abbreviation;

class AbbreviationController extends Controller
{
    public function index()
    {
        $abbreviations = Abbreviation::all();
        return view('abbreviations.index', compact('abbreviations'));
    }

    public function show($id)
    {
        $abbreviation = Abbreviation::find($id);

        if (!$abbreviation) {
            // Handle case where record is not found
            return redirect()->route('abbreviations.index')->with('error', 'Abbreviation not found.');
        }

        return view('abbreviations.show', compact('abbreviation'));
    }
}
