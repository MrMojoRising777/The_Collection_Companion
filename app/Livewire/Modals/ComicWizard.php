<?php

declare(strict_types=1);

namespace App\Livewire\Modals;

use App\Data\ComicData;
use App\Services\ComicResolverService;
use Illuminate\Support\Collection;
use Illuminate\View\View;
use Livewire\Component;
use App\Models\Serie;
use App\Models\Edition;
use Native\Mobile\Facades\Scanner;
use Native\Mobile\Attributes\OnNative;
use Native\Mobile\Events\Scanner\CodeScanned;
use Native\Mobile\Facades\System;

class ComicWizard extends Component
{
    public string $step = 'scan';// scan | search | manual | confirm
    public ?ComicData $comic = null;
    public ?array $results = null;
    public ?string $query = null;
    public ?int $serieId = null;

    public bool $scanStarted = false;

    protected ComicResolverService $resolver;

    public function boot(ComicResolverService $resolver): void
    {
        $this->resolver = $resolver;
    }

    public function mount(): void
    {
        $this->step = $this->isMobile() ? 'scan' : 'search';
    }

    public function rendered(): void
    {
        if ($this->step === 'scan' && ! $this->scanStarted) {
            $this->js('window.setTimeout(() => $wire.startScan(), 200)');
        }
    }

    public function startScan(): void
    {
        if ($this->scanStarted) {
            return;
        }

        $this->scanStarted = true;

        Scanner::scan()
            ->prompt('Scan comic ISBN')
            ->formats(['ean13']);
    }

    public function rescan(): void
    {
        $this->scanStarted = false;
        $this->step = 'scan';

        $this->startScan();
    }

    #[OnNative(CodeScanned::class)]
    public function handleScan(string $data): void
    {
        $isbn = preg_replace('/[^0-9X]/', '', trim($data));

        $comic = $this->resolver->resolveFromIsbn(isbn: $isbn);

        if (! $comic) {
            // fallback → search mode
            $this->step = 'search';
            $this->query = null;

            return;
        }

        $this->results = $comic->toArray();
        $this->step = 'confirm'; // TODO on closing modal, reset comic and check
    }

    /* --------------------------------
     | SEARCH FLOW (legacy comics)
     |--------------------------------*/

    public function search(): void
    {
        if (! $this->query) {
            return;
        }

        $results = $this->resolver->resolveFromSearch(query: $this->query);

        if (empty($results)) {
            // fallback → manual
            $this->step = 'manual';
            return;
        }

        $this->results = $results->map(function (ComicData $comic): array {
            return [
                'title' => $comic->title,
                'content' => $comic->series ?? [],
            ];
        })->all();
        $this->step = 'confirm';
    }

    /* --------------------------------
     | SAVE FLOW
     |--------------------------------*/

    public function save(): void
    {
        if (! $this->comic || ! $this->serieId) {
            $this->dispatch('notify', type: 'error', message: 'Missing data');
            return;
        }

        Edition::query()
            ->create([
                'serie_id' => $this->serieId,
                'isbn' => $this->comic->isbn,
                'title' => $this->comic->title,
            ]);

        $this->dispatch('notify', type: 'success', message: 'Comic added');

        $this->dispatch('closeModal');
    }

    /* --------------------------------
     | DATA
     |--------------------------------*/

    public function getSeriesProperty()
    {
        return Serie::query()
            ->orderBy('name')
            ->get();
    }

    /* --------------------------------
     | VIEW
     |--------------------------------*/

    public function render(): View
    {
        return view('livewire.modals.comic-wizard', [
            'series' => $this->series,
        ]);
    }

    private function isMobile(): bool
    {
        return System::isAndroid() || System::isIOS();
    }
}
