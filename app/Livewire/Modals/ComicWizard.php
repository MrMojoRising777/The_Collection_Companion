<?php

declare(strict_types=1);

namespace App\Livewire\Modals;

use App\Data\ComicData;
use App\Models\User;
use App\Services\ComicResolverService;
use App\Traits\HasAlerts;
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
    use HasAlerts;

    public string $step = 'scan';// scan | search | manual | confirm
    public ?ComicData $comic = null;
    public ?array $results = null;
    public ?string $query = null;
    public ?int $serieId = null;

    public bool $scanStarted = false;
    public bool $isMobile = true;

    protected ComicResolverService $resolver;

    protected $listeners = ['albumSelected'];

    public function boot(ComicResolverService $resolver): void
    {
        $this->resolver = $resolver;
    }

    public function mount(): void
    {
        $this->step = 'search';
//        $this->step = $this->isMobile() ? 'scan' : 'search';
        $this->isMobile = $this->isMobile();
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

        if ($results->isEmpty()) {
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

    /**
     * @param array{
     *     id: int,
     *     editionId: int,
     *     name: string,
     *     abbreviation: string,
     *     period: string,
     *     created_at: string,
     *     updated_at: string,
     * } $payload
     */
    public function albumSelected(array $payload): void
    {
        /** @var User $user */
        $user = auth()->user();

        $edition = Edition::query()
            ->find($payload['editionId']);

        if (! $edition) {
            return;
        }

        if ($user->ownedCopies()->where('edition_id', $edition->id)->exists()) {
            $this->alert(
                message: 'Comic already in collection!',
                type: 'info',
            );

            return;
        }

        $user->ownedCopies()->create([
            'edition_id' => $edition->id,
            'acquisition_date' => now(),
        ]);

        $this->alert(message: 'Comic added!');

        $this->dispatch('closeModal');
    }

    public function getSeriesProperty()
    {
        return Serie::query()
            ->orderBy('name')
            ->get();
    }

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
