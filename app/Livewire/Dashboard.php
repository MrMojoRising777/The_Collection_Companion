<?php

declare(strict_types=1);

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Album;
use App\Models\Collection;

class Dashboard extends Component
{
    public $recentAlbums;
    public $favorites;
    public $achievements;
    public $seriesPercentages;

    public function mount(): void
    {
        $this->recentAlbums = $this->getRecentAlbums(5);
        $this->seriesPercentages = $this->calculateObtainedPercentage();
        $this->favorites = $this->getFavoriteAlbums();
        $this->achievements = $this->getUserAchievements(auth()->id());
    }

    public function render()
    {
        return view('livewire.dashboard');
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

    private function getFavoriteAlbums()
    {
        return Collection::with('album')
            ->where('favorite', 1)
            ->take(5)
            ->get();
    }

    private function calculateObtainedPercentage()
    {
        $groupedAlbums = Album::with('serie')->get()->groupBy('serie.name');
        $groupedObtainedAlbums = Collection::with('album')->get()->groupBy('album.serie.name');

        return $groupedAlbums->map(function ($albums, $seriesName) use ($groupedObtainedAlbums) {
            $totalAlbums = count($albums);
            $obtainedAlbums = $groupedObtainedAlbums->has($seriesName)
                ? count($groupedObtainedAlbums[$seriesName])
                : 0;

            return [
                'serie_name' => $seriesName,
                'total' => $totalAlbums,
                'obtained' => $obtainedAlbums,
                'percentage' => $totalAlbums > 0
                    ? round(($obtainedAlbums / $totalAlbums) * 100)
                    : 0,
            ];
        });
    }

    private function getUserAchievements($userId)
    {
        return User::query()->findOrFail($userId)->achievements;
    }
}
