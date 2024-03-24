<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Serie;

class SerieController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $series = Serie::withCount('albums')->get();
        return view('series.index', compact('series', 'user'));
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

    public function toggleTracking(Serie $serie)
    {
        $user = auth()->user();
        $user->trackedSeries()->toggle($serie);

        return back()->with('success', 'Tracking status updated successfully.');
    }

    public function search(Request $request)
    {
        $user = auth()->user();
        $search = $request->input('search');
        $series = Serie::where('name', 'like', '%'.$search.'%')->withCount('albums')->get();
        return view('series.index', compact('series', 'user'));
    }
}
