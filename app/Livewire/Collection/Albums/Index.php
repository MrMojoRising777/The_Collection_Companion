<?php

declare(strict_types=1);

namespace App\Livewire\Collection\Albums;

use App\Models\Album;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Collection;

#[Layout('components.layouts.app')]
class Index extends Component
{
    use WithPagination;

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
        }
    }

    public function render(): View
    {
        $collection = Collection::query()
            ->with(['album', 'serie'])
            ->where('user_id', auth()->id())
            ->paginate(10);

        return view('livewire.collection.albums.index', [
            'collection' => $collection,
        ]);
    }
}
