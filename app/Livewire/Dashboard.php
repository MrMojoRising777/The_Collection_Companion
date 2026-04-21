<?php

declare(strict_types=1);

namespace App\Livewire;

use Illuminate\View\View;
use Livewire\Component;
use App\Models\Album;
use App\Models\Collection as CollectionModel;
use Illuminate\Support\Collection;

/**
 * @property Collection<int, CollectionModel> $recentAlbums
 */
class Dashboard extends Component
{
    public Collection $recentAlbums;
    public Collection $favorites;
    public Collection $achievements;
    public Collection $seriesPercentages;

    public function mount(): void
    {
        $this->recentAlbums = $this->getRecentAlbums();
        $this->seriesPercentages = $this->calculateObtainedPercentage();
        $this->favorites = $this->getFavoriteAlbums();
        $this->achievements = $this->getUserAchievements(auth()->id());
    }

    private function getRecentAlbums(): Collection
    {
        return CollectionModel::query()
            ->with('album')
            ->join('albums', 'collections.album_id', '=', 'albums.id')
            ->select('albums.*')
            ->orderBy('collections.updated_at', 'desc')
            ->take(5)
            ->get();
    }

    private function getFavoriteAlbums(): Collection
    {
        return CollectionModel::with('album')
            ->where('favorite', 1)
            ->take(5)
            ->get();
    }

    private function calculateObtainedPercentage(): Collection
    {
        $groupedAlbums = Album::query()
            ->with('serie')
            ->get()
            ->groupBy('serie.name');

        $groupedObtainedAlbums = CollectionModel::query()
            ->with('album')
            ->get()
            ->groupBy('album.serie.name');

        return $groupedAlbums->map(function ($albums, $seriesName) use ($groupedObtainedAlbums): array {
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

    /** TODO achievements need to be implemented */
    private function getUserAchievements($userId): Collection
    {
        return collect();
//        return User::query()->findOrFail($userId)->achievements;
    }

    public function render(): View
    {
        return view('livewire.dashboard');
    }
}
