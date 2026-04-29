<?php

declare(strict_types=1);

namespace App\Livewire\Components;

use App\Models\OwnedCopy;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

/**
 * @property Collection<int, OwnedCopy> $recentAlbums
 */
class Carousel extends Component
{
    public Collection $recentAlbums;
    public int $currentIndex = 0;

    public function mount(): void
    {
        $this->recentAlbums = $this->getRecentAlbums();
    }

    /**
     * @return Collection<int, OwnedCopy>
     */
    private function getRecentAlbums(): Collection
    {
        return OwnedCopy::query()
            ->with('edition.album', 'edition.serie')
            ->orderBy('updated_at', 'desc')
            ->take(5)
            ->get();
    }

    #[On('next')]
    public function next(): void
    {
        $this->currentIndex = ($this->currentIndex + 1) % count($this->recentAlbums);
    }

    public function prev(): void
    {
        $this->currentIndex = ($this->currentIndex - 1 + count($this->recentAlbums)) % count($this->recentAlbums);
    }

    public function goTo(int $index): void
    {
        $this->currentIndex = $index;
    }

    public function render(): View
    {
    return view('livewire.components.carousel');
    }
}
