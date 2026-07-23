<?php

declare(strict_types=1);

namespace App\Livewire\Dashboard;

use App\Models\Serie;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Livewire\Attributes\Computed;
use Livewire\Component;

/**
 * @phpstan-type SerieProgessArray array{
 *     id: int,
 *     serie_name: string,
 *     total: int,
 *     obtained: int,
 *     percentage: int,
 * }
 * @property-read Collection<int, SerieProgessArray> $series
 */
class SeriesProgressBars extends Component
{
    /**
     * @return Collection<int, SerieProgessArray>
     */
    #[Computed]
    public function series(): Collection
    {
        return Serie::query()
            ->withCount([
                'editions as total',
                'ownedCopies as obtained',
            ])
            ->orderBy('name')
            ->get()
            ->map(fn (Serie $serie): array => [
                'id' => $serie->id,
                'serie_name' => $serie->name,
                'total' => $serie->total,
                'obtained' => $serie->obtained,
                'percentage' => $serie->total === 0
                    ? 0
                    : (int) round(($serie->obtained / $serie->total) * 100),
            ]);
    }

    public function render(): View
    {
        return view('livewire.dashboard.series-progress-bars');
    }
}
