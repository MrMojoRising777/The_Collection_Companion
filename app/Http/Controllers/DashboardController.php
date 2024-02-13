<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Album;
use App\Models\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $recentAlbums = $this->getRecentAlbums(5);
        $mostValuedAlbums = $this->getMostValuedAlbums(5);
        $collectionValue = $this->calculateCollectionValue();
        $seriesPercentages = $this->calculateObtainedPercentage();
        $favorites = $this->getFavoriteAlbums();
        $achievements = $this->getUserAchievements(1);

        return view('dashboard', compact('recentAlbums', 'mostValuedAlbums', 'collectionValue', 'favorites', 'achievements', 'seriesPercentages'));
    }

    private function getRecentAlbums($limit)
    {
        return Collection::with('album')
            ->join('albums', 'collections.album_id', '=', 'albums.id')
            ->select('albums.*')
            ->orderBy('collections.updated_at', 'desc')
            ->take($limit)
            ->get();
    }
    
    private function getMostValuedAlbums($limit)
    {
        return Collection::with('album')
            ->join('albums', 'collections.album_id', '=', 'albums.id')
            ->orderBy('albums.value', 'desc')
            ->take($limit)
            ->get(['albums.*']);
    }

    private function calculateCollectionValue()
    {
        return Collection::join('albums', 'collections.album_id', '=', 'albums.id')->sum('albums.value');
    }

    private function calculateObtainedPercentage()
    {
        $groupedAlbums = Album::with('serie')->get()->groupBy('serie.name');
        $groupedObtainedAlbums = Collection::with('album')->get()->groupBy('album.serie.name');

        return $groupedAlbums->map(function ($albums, $seriesName) use ($groupedObtainedAlbums) {
            $totalAlbums = count($albums);
            $obtainedAlbums = $groupedObtainedAlbums->has($seriesName) ? count($groupedObtainedAlbums[$seriesName]) : 0;
            $percentage = ($totalAlbums > 0) ? round(($obtainedAlbums / $totalAlbums) * 100) : 0;

            return [
                'serie_name' => $seriesName,
                'total' => $totalAlbums,
                'obtained' => $obtainedAlbums,
                'percentage' => $percentage,
            ];
        });
    }

    private function getFavoriteAlbums()
    {
        return Collection::with('album')
            ->where('favorite', 1)
            ->take(5)
            ->get();
    }

    private function getUserAchievements($userId)
    {
        $user = User::findOrFail($userId);
        return $user->achievements;
    }
}
