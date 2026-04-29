<?php

declare(strict_types=1);

namespace App\Livewire\Albums;

use App\Livewire\Modals\SeriesTable;
use App\Models\Album;
use App\Models\Wishlist;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;
use App\Models\Serie;
use Livewire\WithPagination;

#[Layout('components.layouts.app')]
class Index extends Component
{
    use WithPagination;

    public string $search = '';
    public ?int $serieId = null;
    public string $view = 'table';
    public bool $filteredOnSerie = false;

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
        $this->filteredOnSerie = false;

        $this->resetPage();
    }

    public function setView(string $view): void
    {
        $this->view = $view;
    }

    public function openCollectModal(Album $album): void
    {
        $this->dispatch('openModal',
            component: SeriesTable::class,
            props: [
                'albumId' => $album->id,
            ],
            title: $album->name,
        );
    }

    public function render(): View
    {
        $series = Serie::all();

        $wishlist = Wishlist::query()
            ->where('user_id', auth()->id())
            ->get();

        $albums = Album::query()
            ->with(['series', 'editions'])
            ->withCount('editions')

            // search
            ->when($this->search, function (Builder $query): void {
                $query->where(function (Builder $subquery): void {
                    $subquery->where('name', 'like', "%{$this->search}%")
                        ->orWhereHas('series', function (Builder $q2): void {
                            $q2->where('name', 'like', "%{$this->search}%");
                        });
                });
            })

            // serie filter
            ->when($this->serieId, function (Builder $query): void {
                $this->filteredOnSerie = true;

                $query->whereHas('series', function (Builder $subquery): void {
                    $subquery->where('series.id', $this->serieId);
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
