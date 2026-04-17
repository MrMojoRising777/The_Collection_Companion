<?php

declare(strict_types=1);

namespace App\Livewire\Series;

use Illuminate\Support\Collection;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;
use App\Models\Serie;
use Illuminate\Support\Facades\Auth;
use Livewire\Features\SupportRedirects\Redirector;

#[Layout('components.layouts.app')]
class Index extends Component
{
    public string $search = '';
    public string $view = 'table';

    public function setView(string $view): void
    {
        $this->view = $view;
    }

    public function toggleTracking($serieId): void
    {
        $user = Auth::user();
        $serie = Serie::findOrFail($serieId);

        if ($user->trackedSeries->contains($serie)) {
            $user->trackedSeries()->detach($serie->id);
        } else {
            $user->trackedSeries()->attach($serie->id);
        }

        // refresh relation
        $user->refresh();
    }

    public function showSerie(Serie $serie): Redirector
    {
        return redirect()->route('series.show', $serie);
    }

    public function getSeriesProperty(): Collection
    {
        return Serie::query()
            ->withCount('albums')
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
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
