<?php

declare(strict_types=1);

namespace App\Livewire\Series;

use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;
use App\Models\Serie;

#[Layout('components.layouts.app')]
class Show extends Component
{
    public Serie $serie;

    public function mount(Serie $serie): void
    {
        $this->serie = $serie->loadCount('albums');
    }

    public function render(): View
    {
        return view('livewire.series.show');
    }
}
