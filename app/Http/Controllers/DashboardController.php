<?php

namespace App\Http\Controllers;

use App\Models\Album;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $recentAlbums = $this->getRecentAdditions();
        $valueAlbums = $this->getMostValued();

        dd($valueAlbums);

        return view('dashboard', compact('recentAlbums', 'valueAlbums'));
    }

    private function getRecentAdditions()
    {
        $recentAlbums = Album::with('comics')
        ->orderBy('updated_at', 'desc')
        ->take(10)
        ->get();

        return $recentAlbums;
    }

    private function getMostValued()
    {
        $valueAlbums = Album::with('comics')
        ->where('obtained', 1)
        ->orderBy('value', 'desc')
        ->take(5)
        ->get();

        return $valueAlbums;
    }
}
