<?php

declare(strict_types=1);

namespace App\Livewire\Collection\Albums;

use App\Models\Edition;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;
use App\Livewire\Modals\editCollection;

#[Layout('components.layouts.app')]
class Show extends Component
{
    public Edition $edition;

    public function mount(Edition $edition): void
    {
        $this->edition = $edition->load(['album', 'serie']);
    }

    public function openEditAlbumModal(Edition $edition): void
    {
        $this->dispatch('openModal',
            component: editCollection::class,
            props: [
                'albumSerieId' => $edition->id,
            ],
            title: $edition->album->name,
        );
    }

    public function render(): View
    {
        return view('livewire.collection.albums.show');
    }
}
