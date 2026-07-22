<?php

declare(strict_types=1);

namespace App\Livewire\Collection;

use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.app')]
class Index extends Component
{
    public function goToSeries(): void
    {
        $this->redirectRoute('collection.series.index');
    }

    public function goToAlbums(): void
    {
        $this->redirectRoute('collection.albums.index');
    }

    public function render(): View
    {
        return view('livewire.collection.index');
    }
}
