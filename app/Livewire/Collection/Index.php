<?php

declare(strict_types=1);

namespace App\Livewire\Collection;

use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.app')]
class Index extends Component
{
    public function goToSeries(): RedirectResponse
    {
        return redirect()->route('collection.series.index');
    }

    public function goToAlbums(): RedirectResponse
    {
        return redirect()->route('collection.albums.index');
    }

    public function render(): View
    {
        return view('livewire.collection.index');
    }
}
