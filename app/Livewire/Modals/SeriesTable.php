<?php

declare(strict_types=1);

namespace App\Livewire\Modals;

use App\Models\Album;
use App\Models\Edition;
use App\Models\User;
use App\Traits\HasAlerts;
use Illuminate\View\View;
use Livewire\Component;

class SeriesTable extends Component
{
    use HasAlerts;

    public Album $album;

    public function mount(int $albumId): void
    {
        $this->album = $this->getAlbum(id: $albumId);
    }

    private function getAlbum(int $id): Album
    {
        /** @var Album $album */
        $album = Album::query()
            ->with('editions.serie')
            ->findOrFail($id);

        return $album;
    }

    public function collectAlbum(Edition $edition): void
    {
        /** @var User $user */
        $user = auth()->user();

        $user->ownedCopies()->create([
            'edition_id' => $edition->id,
            'acquisition_date' => now(),
        ]);

        $this->alert(message: 'Added to collection!');
    }

    public function showAlbum(Edition $edition): void
    {
        $this->redirectRoute(
            'collection.albums.show',
            [
                'albumSerie' => $edition->id,
            ],
        );
    }

    public function render(): View
    {
        return view('livewire.modals.series-table');
    }
}
