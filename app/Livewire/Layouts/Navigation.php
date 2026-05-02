<?php

declare(strict_types=1);

namespace App\Livewire\Layouts;

use Illuminate\View\View;
use Livewire\Component;

class Navigation extends Component
{
    public function openComicWizard(): void
    {
        $this->dispatch('openModal',
            component: 'modals.comic-wizard',
        );
    }

    public function render(): View
    {
        return view('livewire.layouts.navigation');
    }
}
