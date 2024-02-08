<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Album;
use App\Models\Collection;
use Illuminate\Http\Request;

class CollectionController extends Controller
{
    public function index() // SHOW COLLECTION
    {
        $collection = auth()->user()->collections()->with('album')->paginate(10);
        return view('collection.index', compact('collection'));
    }

    public function edit(Album $album) {
        $collected = auth()->user()->collections()->where('album_id', $album->id)->first();
        return view('collection.edit', compact('collected'));
    }

    public function update(Request $request, Album $album) // UPDATE COLLECTEC ALBUM //*needs logic
    {
        $validatedData = $request->validate([

        ]);

        // Update album with validated data
        $album->update($validatedData);

        return redirect()->route('collection.index')->with('success', 'Album updated successfully.');
    }

    public function show(Album $album) // SHOW SPECIFIC COLLECTED ALBUM
    {
        $collected = auth()->user()->collections()->where('album_id', $album->id)->first();
        return view('collection.show', compact('collected'));
    }

    public function getFavorites() // SHOW FAVORITES ONLY
    {
        $collection = auth()->user()->collections()->where('favorite', 1)->with('album')->paginate(10);
        return view('collection', compact('collection'));
    }

    public function getFirstPrints() // SHOW FIRST_PRINTS ONLY
    {
        $collection = auth()->user()->collections()->where('first_print', 1)->with('album')->paginate(10);
        return view('collection', compact('collection'));
    }

    public function toggleCollection(Album $album) // SWITCH ALBUM (UN)OBTAINED //*maybe better in AblumController
    {
        $user = auth()->user();
        $collection = $user->collections()->where('album_id', $album->id)->first();
        if ($collection) {
            $collection->delete();
            $message = 'Album removed from collection successfully.';
        } else {
            $user->collections()->create([
                'album_id' => $album->id,
                'acquisition_date' => Carbon::now()
            ]);
            $message = 'Album added to collection successfully.';
        }
        return redirect()->back()->with('success', $message);
    }

    public function toggleFavorite(Album $album) // SWITCH COLLECTED ALBUM (UN)FAVORITE
    {
        $message = $this->toggleItemProperty($album, 'favorite', 'Favorite status toggled successfully.');
        return redirect()->back()->with('success', $message);
    }

    public function toggleFirstPrint(Album $album) // SWITCH COLLECTED ALBUM (NOT)FIRST_PRINT
    {
        $message = $this->toggleItemProperty($album, 'first_print', 'First print status toggled successfully.');
        return redirect()->back()->with('success', $message);
    }

    public function removeFromCollection(Album $album) // REMOVE ALBUM FROM COLLECTION //*add confirmation check
    {
        $user = auth()->user();
        $collection = $user->collections()->where('album_id', $album->id)->first();
        if ($collection) {
            $collection->delete();
        }

        return redirect()->back()->with('success', 'Album removed from collection successfully.');
    }

    protected function toggleItemProperty(Album $album, $property, $successMessage) // REUSABLE TOGGLE FUNCTION
    {
        $user = auth()->user();
        $collection = $user->collections()->where('album_id', $album->id)->first();
        if ($collection) {
            $collection->update([$property => !$collection->$property]);
            return $successMessage;
        } else {
            return 'Album is not in your collection.';
        }
    }
}