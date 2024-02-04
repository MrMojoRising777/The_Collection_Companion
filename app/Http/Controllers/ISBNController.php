<?php

namespace App\Http\Controllers;

use App\Models\Album;
use Illuminate\Http\Request;

class ISBNController extends Controller
{
    public function setAlbumObtainedByTitle($title)
    {
        // Implement your logic to handle the title in the controller
        $Album = Album::where('name', $title)->first();

        return response()->json(['result' => $Album]);
    }
}
