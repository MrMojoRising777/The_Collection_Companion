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
}
