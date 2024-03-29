<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Comic;
use App\Models\Serie;
use App\Models\Wishlist;
use Illuminate\Http\Request;

class AlbumController extends Controller
{
    public function index(Request $request)
    {
        // Get all series for filter dropdown
        $series = Serie::all();

        // Start with all albums
        $albums = Album::query();

        // wishlist albums
        $wishlist = Wishlist::where('user_id', auth()->id())->get();

        if ($request->has('serie_id')) {
            $serieId = $request->input('serie_id');

            if ($serieId !== null) {
                $albums->where('serie_id', $serieId);
            }
        }

        // Paginate the filtered albums
        $albums = $albums->paginate(10);

        return view('albums.index', compact('albums', 'series', 'wishlist'));
    }

    public function getObtained()
    {
        $albums = Album::where('obtained', 1)->paginate(15);
        $series = Serie::all();
        return view('albums.index', compact('albums', 'series'));
    }

    public function getFavorites()
    {
        $albums = Album::where('favorite', 1)->paginate(15);
        $series = Serie::all();
        return view('albums.index', compact('albums', 'series'));
    }

    public function getWanted()
    {
        $albums = Album::where('wanted', 1)->paginate(15);
        $series = Serie::all();
        return view('albums.index', compact('albums', 'series'));
    }

    public function getFirstPrints()
    {
        $albums = Album::where('first_print_obtained', 1)->paginate(15);
        $series = Serie::all();
        return view('albums.index', compact('albums', 'series'));
    }

    public function getDamaged()
    {
        $albums = Album::where('damaged', 1)->paginate(15);
        $series = Serie::all();
        return view('albums.index', compact('albums', 'series'));
    }

    public function search(Request $request)
    {
        $search = $request->input('search');
        $albums = Album::where('name', 'like', '%'.$search.'%')->paginate(15);
        $series = Serie::all();
        return view('albums.index', compact('albums', 'series'));
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
            'condition' => 'nullable|string|max:255',
            'purchase_place' => 'nullable|string|max:255',
            'purchase_price' => 'nullable|numeric',
            'purchase_date' => 'nullable|date',
            'notes' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'value' => 'nullable|numeric'
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
        ]);

        Album::create($validatedData);

        return redirect()->route('albums.index')->with('success', 'Album created successfully.');
    }

    public function wishlist()
    {
        // wishlist albums
        $wishlist = Wishlist::where('user_id', auth()->id())->paginate(10);

        return view('wishlist', compact('wishlist'));
    }

    public function toggleWishlist(Album $album)
    {
        // Find the wishlist entry for the specified comic and authenticated user
        $wishlistEntry = Wishlist::where('user_id', auth()->id())->where('album_id', $album->id)->first();

        // Toggle wishlist status
        if ($wishlistEntry) {
            $wishlistEntry->delete();
            $message = 'Album succesvol verwijderd uit je verlanglijst.';
        } else {
            // If the album is not in the wishlist, add it
            Wishlist::create([
                'user_id' => auth()->id(),
                'album_id' => $album->id,
            ]);
            $message = 'Album succesvol toegevoegd aan je verlanglijst.';
        }

        return redirect()->route('albums.index')->with(['message' => $message]);
    }

    public function remove($id)
    {
        // Find the wishlist item by its ID
        $wishlistItem = Wishlist::findOrFail($id);

        // Ensure that the authenticated user owns the wishlist item
        if ($wishlistItem->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        // Delete the wishlist item
        $wishlistItem->delete();

        return redirect()->route('wishlist')->with('success', 'Album successfully removed from the wishlist.');
    }
}
