<?php

declare(strict_types=1);

namespace App\Livewire\Modals;

use App\Models\OwnedCopy;
use App\Models\User;
use App\Traits\HasAlerts;
use Illuminate\View\View;
use Livewire\Component;

class editCollection extends Component
{
    use HasAlerts;

    public OwnedCopy $collection;

    public function mount(int $albumSerieId): void
    {
        $this->collection = $this->getCollection(id: $albumSerieId);
    }

    private function getCollection(int $id): OwnedCopy
    {
        /** @var User $user */
        $user = auth()->user();

        return $user->collections()
            ->where('album_serie_id', $id)
            ->first();
    }

    public function render(): View
    {
        return view('livewire.modals.edit-collection');
    }
}
