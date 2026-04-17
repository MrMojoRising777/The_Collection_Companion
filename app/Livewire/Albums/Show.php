<?php

declare(strict_types=1);

namespace App\Livewire\Albums;

use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;
use App\Models\Album;

#[Layout('components.layouts.app')]
class Show extends Component
{
    public Album $album;

    public function mount(Album $album): void
    {
        $this->album = $album->loadCount('series');
    }

    public function render(): View
    {
        return view('livewire.albums.show');
    }
}
