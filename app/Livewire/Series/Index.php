<?php

declare(strict_types=1);

namespace App\Livewire\Series;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Illuminate\View\View;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Component;
use App\Models\Serie;
use Illuminate\Support\Facades\Auth;
use Livewire\Features\SupportRedirects\Redirector;

/**
 * @property Collection<int, Serie> $series
 */
#[Layout('components.layouts.app')]
class Index extends Component
{
    public string $search = '';
    public string $view = 'table';

    public function setView(string $view): void
    {
        $this->view = $view;
    }

    public function toggleTracking(Serie $serie): void
    {
        $user = Auth::user();

        if ($user->trackedSeries->contains($serie)) {
            $user->trackedSeries()->detach($serie->id);
        } else {
            $user->trackedSeries()->attach($serie->id);
        }

        $user->refresh();
    }

    public function showSerie(Serie $serie): Redirector
    {
        return redirect()->route('series.show', $serie);
    }

    #[Computed]
    public function series(): Collection
    {
        return Serie::query()
            ->withCount('albums')
            ->when($this->search, function (Builder $query): Builder {
                return $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('abbreviation', 'like', '%' . $this->search . '%');
            })
            ->orderBy('name')
            ->get();
    }

    public function render(): View
    {
        return view('livewire.series.index', [
            'series' => $this->series,
            'user' => Auth::user(),
        ]);
    }
}
