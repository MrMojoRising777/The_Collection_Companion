<?php

declare(strict_types=1);

namespace App\Livewire\Albums;

use App\Models\User;
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

    public function hasAlbum(): bool
    {
        /** @var User $user */
        $user = auth()->user();

        return $user
            ->albums()
            ->where('album_id', $this->album->id)
            ->exists();
    }

    public function render(): View
    {
        return view('livewire.albums.show');
    }
}
