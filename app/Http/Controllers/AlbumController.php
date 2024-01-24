<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Comic;
use App\Models\Serie;
use Illuminate\Http\Request;

class AlbumController extends Controller
{
    public function index()
    {
        $albums = Album::paginate(10);
        $series = Serie::all();
        return view('albums.index', compact('albums', 'series'));
    }

    public function markAsObtained($id)
    {
        $album = Album::find($id);

        if ($album) {
            $album->update(['obtained' => true]);
            return response()->json(['message' => 'Album marked as obtained.']);
        }

        return response()->json(['error' => 'Album not found.'], 404);
    }

    public function toggleObtained(Album $album)
    {
        $album->update(['obtained' => !$album->obtained]);

        return redirect()->back()->with('success', 'Obtained status updated successfully.');
    }

    public function show(Album $album)
    {
        return view('albums.show', compact('album'));
    }

    public function edit(Album $album)
    {
        $comics = Comic::all();
        $series = Serie::all();

        return view('albums.edit', compact('album', 'comics', 'series'));
    }

    public function update(Request $request, Album $album)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'comic_id' => 'required|exists:comics,id',
            'serie_id' => 'required|exists:series,id',
            'volume' => 'nullable|string',
            'first_print' => 'nullable|string',
            'cover' => 'nullable|string',
            'color' => 'nullable|string|max:255',
            'print_year' => 'nullable|integer',
            'obtained' => 'nullable|boolean',
            'condition' => 'nullable|string|max:255',
            'purchase_place' => 'nullable|string|max:255',
            'purchase_price' => 'nullable|numeric',
            'purchase_date' => 'nullable|date',
            'notes' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            // Handle uploaded image
            $image = $request->file('image');
            $serieId = $request->serie_id;
            
            // Fetch serie
            $serie = Serie::where('id', $serieId)->first();

            // Build filename using Serie name and original filename
            $filename = $serie->abbreviation . '_' . $image->getClientOriginalName();

            // Save image to 'public_uploads' disk
            $image->storeAs('images', $filename, ['disk' => 'public_uploads']);
            
            // Store image path in $validatedData array
            $validatedData['image'] = 'uploads/images/' . $filename;
        }

        // Update album with validated data
        $album->update($validatedData);

        return redirect()->route('albums.index')->with('success', 'Album updated successfully.');
    }

    public function destroy(Album $album)
    {
        $album->delete();

        return redirect()->route('albums.index')->with('success', 'Album deleted successfully.');
    }
    
    public function create()
    {
        $comics = Comic::all();
        $series = Serie::all();

        return view('albums.create', compact('comics', 'series'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'comic_id' => 'required',
            'serie_id' => 'required'
            // Add other validation rules for your input fields here
        ]);

        Album::create($validatedData);

        return redirect()->route('albums.index')->with('success', 'Album created successfully.');
    }
}
