<?php

declare(strict_types=1);

namespace App\Livewire\Collection\Albums;

use App\Models\Album;
use App\Models\AlbumSerie;
use App\Traits\HasAlerts;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\Features\SupportRedirects\Redirector;
use Livewire\WithPagination;
use App\Models\Collection;

#[Layout('components.layouts.app')]
class Index extends Component
{
    use HasAlerts,
        WithPagination;

    public string $viewMode = 'table';

    public function switchView(string $view): void
    {
        $this->viewMode = $view;
    }

    public function remove(Album $album): void
    {
        Collection::query()
            ->where('user_id', auth()->id())
            ->where('album_id', $album->id)
            ->delete();

        $this->alert(message: 'Deleted successfully!');
    }

    public function toggleFavorite(Album $album): void
    {
        /** @var Collection $item */
        $item = Collection::query()
            ->where('user_id', auth()->id())
            ->where('album_id', $album->id)
            ->first();

        if ($item) {
            $item->favorite = ! $item->favorite;
            $item->save();

            $this->alert(message: 'Saved successfully!');
        }
    }

    public function toggleFirstPrint(Album $album): void
    {
        /** @var Collection $item */
        $item = Collection::query()
            ->where('user_id', auth()->id())
            ->where('album_id', $album->id)
            ->first();

        if ($item) {
            $item->firstPrint = ! $item->firstPrint;
            $item->save();

            $this->alert(message: 'Saved successfully!');
        }
    }

    public function showAlbum(AlbumSerie $albumSerie): void
    {
        $this->redirectRoute(
            'collection.albums.show',
            ['albumSerie' => $albumSerie]
        );
    }

    public function render(): View
    {
        $collection = Collection::query()
            ->with(['albumSerie.album', 'albumSerie.serie'])
            ->where('user_id', auth()->id())
            ->paginate(10);

        return view('livewire.collection.albums.index', [
            'collection' => $collection,
        ]);
    }
}
