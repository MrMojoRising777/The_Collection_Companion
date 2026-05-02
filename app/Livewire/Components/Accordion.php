<?php

declare(strict_types=1);

namespace App\Livewire\Components;

use Illuminate\View\View;
use Livewire\Component;

class Accordion extends Component
{
    public array $items = [];
    public ?int $openIndex = null;
    public string $contentKey = 'content';

    public function toggle(int $index): void
    {
        $this->openIndex = $this->openIndex === $index
            ? null
            : $index;
    }

    public function render(): View
    {
        return view('livewire.components.accordion');
    }
}
