<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Album;
use App\Models\OwnedCopy;
use Illuminate\Support\Collection;

class DashboardController extends Controller
{
    public function index()
    {
        $recentAlbums = $this->getRecentAlbums(5);
//        $mostValuedAlbums = $this->getMostValuedAlbums(5);
//        $collectionValue = $this->calculateCollectionValue();
        $seriesPercentages = $this->calculateObtainedPercentage();
        $favorites = $this->getFavoriteAlbums();
//        $achievements = $this->getUserAchievements(1);

        return view('dashboard', compact(
            'recentAlbums',
//            'mostValuedAlbums',
//            'collectionValue',
            'favorites',
//            'achievements',
            'seriesPercentages',
        ));
    }

    /**
     * @return Collection<int, OwnedCopy>
     */
    private function getRecentAlbums(int $limit): Collection
    {
        return OwnedCopy::with('edition')
            ->join('albums', 'collections.album_id', '=', 'albums.id')
            ->select('albums.*')
            ->orderBy('collections.updated_at', 'desc')
            ->take($limit)
            ->get();
    }

    /**
     * @return Collection<int, OwnedCopy>
     */
    private function getMostValuedAlbums(int $limit): Collection
    {
        return OwnedCopy::with('edition')
            ->join('albums', 'collections.album_id', '=', 'albums.id')
            ->orderBy('albums.value', 'desc')
            ->take($limit)
            ->get(['albums.*']);
    }

    /**
     * @return Collection<int, OwnedCopy>
     */
    private function calculateCollectionValue(): Collection
    {
        return OwnedCopy::join('albums', 'collections.album_id', '=', 'albums.id')
            ->sum('albums.value');
    }

    /**
     * @return Collection<int, Album>
     */
    private function calculateObtainedPercentage(): Collection
    {
        $groupedAlbums = Album::with('series')->get()->groupBy('serie.name');
        $groupedObtainedAlbums = OwnedCopy::with('edition')->get()->groupBy('album.serie.name');

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

    /**
     * @return Collection<int, OwnedCopy>
     */
    private function getFavoriteAlbums(): Collection
    {
        return OwnedCopy::with('edition')
            ->where('favorite', 1)
            ->take(5)
            ->get();
    }

//    private function getUserAchievements(int $userId): Collection
//    {
//        $user = User::findOrFail($userId);
//        return $user->achievements;
//    }
}
