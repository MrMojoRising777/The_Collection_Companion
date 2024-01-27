<?php

namespace App\Http\Controllers;

use App\Models\Album;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $recentAlbums = $this->getRecentAdditions();

        return view('dashboard', compact('recentAlbums'));
    }

    private function getRecentAdditions()
    {
        $recentAlbums = Album::with('comics')
        ->orderBy('updated_at', 'desc')
        ->take(10)
        ->get();

        return $recentAlbums;
    }
}
