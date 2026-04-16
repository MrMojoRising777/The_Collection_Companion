<?php

declare(strict_types=1);

namespace App\Livewire\Series;

use Livewire\Component;
use App\Models\Serie;
use Illuminate\Support\Facades\Auth;

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

    public function getSeriesProperty()
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

    public function render()
    {
        return view('livewire.series.index', [
            'series' => $this->series,
            'user' => Auth::user(),
        ]);
    }
}
