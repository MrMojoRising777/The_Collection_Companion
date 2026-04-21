<?php

declare(strict_types=1);

namespace App\Livewire\Albums;

use App\Models\Album;
use App\Models\User;
use App\Models\Wishlist;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;
use App\Models\Serie;
use Livewire\Features\SupportRedirects\Redirector;
use Livewire\WithPagination;

#[Layout('components.layouts.app')]
class Index extends Component
{
    use WithPagination;

    public string $search = '';
    public ?int $serieId = null;
    public string $view = 'table';

    protected array $queryString = [
        'search' => ['except' => ''],
        'serieId' => ['except' => null],
        'view' => ['except' => 'table'],
    ];

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function updatingSerieId(): void
    {
        $this->resetPage();
    }

    public function setView(string $view): void
    {
        $this->view = $view;
    }

    public function showAlbum(Album $album): Redirector
    {
        return redirect()->route('albums.show', $album);
    }

    public function collectAlbum(Album $album): void
    {
        /** @var User $user */
        $user = auth()->user();

        $user->albums()->attach($album->id, [
            'acquisition_date' => now(),
        ]);
    }

    public function hasAlbum(Album $album): bool
    {
        /** @var User $user */
        $user = auth()->user();

        return $user
            ->albums()
            ->where('album_id', $album->id)
            ->exists();
    }

    public function render(): View
    {
        $series = Serie::all();

        $wishlist = Wishlist::query()
            ->where('user_id', auth()->id())
            ->get();

        $albums = Album::query()
            ->with('series')
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('name', 'like', "%{$this->search}%")
                        ->orWhereHas('series', function ($q2) {
                            $q2->where('name', 'like', "%{$this->search}%");
                        });
                });
            })
            ->when($this->serieId, function ($query) {
                $query->whereHas('series', function ($q) {
                    $q->where('series.id', $this->serieId);
                });
            })
            ->paginate(15);

        return view('livewire.albums.index', [
            'albums' => $albums,
            'series' => $series,
            'wishlist' => $wishlist,
        ]);
    }
}
