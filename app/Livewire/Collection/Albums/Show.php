<?php

declare(strict_types=1);

namespace App\Livewire\Collection\Albums;

use App\Models\AlbumSerie;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.app')]
class Show extends Component
{
    public AlbumSerie $albumSerie;

    public function mount(AlbumSerie $albumSerie): void
    {
        $this->albumSerie = $albumSerie->load(['album', 'serie']);
    }

    public function render(): View
    {
        return view('livewire.collection.albums.show');
    }
}
