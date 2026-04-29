<?php

declare(strict_types=1);

namespace App\Livewire\Collection\Albums;

use App\Models\Edition;
use App\Traits\HasAlerts;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\OwnedCopy;

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

    public function remove(Edition $edition): void
    {
        OwnedCopy::query()
            ->where('user_id', auth()->id())
            ->where('edition_id', $edition->id)
            ->delete();

        $this->alert(message: 'Deleted successfully!');
    }

    public function toggleFavorite(Edition $edition): void
    {
        /** @var OwnedCopy $item */
        $item = OwnedCopy::query()
            ->where('user_id', auth()->id())
            ->where('edition_id', $edition->id)
            ->first();

        if ($item) {
            $item->favorite = ! $item->favorite;
            $item->save();

            $this->alert(message: 'Saved successfully!');
        }
    }

    public function toggleFirstPrint(Edition $edition): void
    {
        /** @var OwnedCopy $item */
        $item = OwnedCopy::query()
            ->where('user_id', auth()->id())
            ->where('edition_id', $edition->id)
            ->first();

        if ($item) {
            $item->firstPrint = ! $item->firstPrint;
            $item->save();

            $this->alert(message: 'Saved successfully!');
        }
    }

    public function showAlbum(Edition $edition): void
    {
        $this->redirectRoute(
            'collection.albums.show',
            ['edition' => $edition]
        );
    }

    public function render(): View
    {
        $collection = OwnedCopy::query()
            ->with(['edition.album', 'edition.serie'])
            ->where('user_id', auth()->id())
            ->paginate(10);

        return view('livewire.collection.albums.index', [
            'collection' => $collection,
        ]);
    }
}
