<?php

declare(strict_types=1);

namespace App\Livewire\Series;

use App\Models\Album;
use App\Models\Edition;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Artisan;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;
use App\Models\Serie;
use Illuminate\Support\Facades\Auth;
use Livewire\Features\SupportRedirects\Redirector;
use Native\Mobile\Attributes\OnNative;
use Native\Mobile\Facades\Scanner;
use Native\Mobile\Events\Scanner\CodeScanned;
use App\Services\IsbnScraperService;

/**
 * @property Collection<int, Edition> $books
 */
#[Layout('components.layouts.app')]
class Index extends Component
{
    public string $search = '';
    public string $view = 'table';
    protected IsbnScraperService $scraper;

    public function boot(IsbnScraperService $scraper): void
    {
        $this->scraper = $scraper;
    }

    public function setView(string $view): void
    {
        $this->view = $view;
    }

    public function seedDB(): void // TODO remove
    {
        if (Album::query()->count() === 0) {
            Artisan::call('migrate --seed');
        }
    }

    public function scanISBN(): void
    {
        Scanner::scan()->formats(['ean13']);
    }

    #[OnNative(CodeScanned::class)]
    public function handleScan(string $data): void
    {
        $isbn = preg_replace('/[^0-9X]/', '', trim($data));

        $book = $this->scraper->fetch(isbn: $isbn);

        if (! $book) {
            $this->dispatch('notify', type: 'error', message: 'Book not found');
            return;
        }

        $albums = Edition::query()
            ->whereHas('album', function (Builder $query) use ($book): Builder {
                return $query->where('name', $book->title);
            })
            ->with(['album', 'serie'])
            ->get()
            ->toArray();;

        $this->dispatch('openModal',
            title: 'Scanned: '.$book->title.' - '.$book->publishedDate,
            view: 'modals.albums-table',
            viewData: [
                'albums' => $albums,
            ],
        );
    }

    public function toggleTracking($serieId): void
    {
        $user = Auth::user();
        $serie = Serie::findOrFail($serieId);

        if ($user->trackedSeries->contains($serie)) {
            $user->trackedSeries()->detach($serie->id);
        } else {
            $user->trackedSeries()->attach($serie->id);
        }

        // refresh relation
        $user->refresh();
    }

    public function showSerie(Serie $serie): Redirector
    {
        return redirect()->route('series.show', $serie);
    }

    public function getSeriesProperty(): Collection
    {
        return Serie::query()
            ->withCount('albums')
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('abbreviation', 'like', '%' . $this->search . '%');
            })
            ->orderBy('name')
            ->get();
    }

    public function render(): View
    {
        return view('livewire.series.index', [
            'series' => $this->series,
            'user' => Auth::user(),
        ]);
    }
}
