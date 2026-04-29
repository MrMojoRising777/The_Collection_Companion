<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Models\Serie;
use Illuminate\View\View;
use Livewire\Component;
use App\Models\Album;
use App\Models\OwnedCopy;
use Illuminate\Support\Collection;

class Dashboard extends Component
{
    public Collection $favorites;
    public Collection $achievements;
    public Collection $seriesPercentages;

    public function mount(): void
    {
        $this->seriesPercentages = $this->calculateObtainedPercentage();
        $this->favorites = $this->getFavoriteAlbums();
        $this->achievements = $this->getUserAchievements(auth()->id());
    }

    private function getFavoriteAlbums(): Collection
    {
        return OwnedCopy::with('edition.album', 'edition.serie')
            ->where('user_id', auth()->id())
            ->where('favorite', 1)
            ->take(5)
            ->get();
    }

    private function calculateObtainedPercentage(): Collection
    {
        $userId = auth()->id();

        return Serie::query()
            ->withCount('editions')
            ->with(['editions' => function ($query) use ($userId) {
                $query->whereHas('ownedCopies', fn($q) => $q->where('user_id', $userId));
            }])
            ->get()
            ->map(fn(Serie $serie): array => [
                'serie_name' => $serie->name,
                'total'      => (int) $serie->editions_count,
                'obtained'   => $serie->editions->count(),
                'percentage' => (int) $serie->editions_count > 0
                    ? round(($serie->editions->count() / (int) $serie->editions_count) * 100)
                    : 0,
            ]);
    }

    /** TODO achievements need to be implemented */
    private function getUserAchievements($userId): Collection
    {
        return collect();
    }

    public function render(): View
    {
        return view('livewire.dashboard');
    }
}
