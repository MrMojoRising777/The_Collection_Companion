<?php

declare(strict_types=1);

namespace App\Livewire\Components;

use Livewire\Attributes\On;
use Livewire\Component;

class Modal extends Component
{
    public bool $open = false;
    public ?string $component = null;
    public string $title = '';
    public array $props = [];

    protected $listeners = [
        'openModal' => 'open',
    ];

    public function open(
        string $component,
        string $title = '',
        array $props = [],
    ): void {
        $this->component = $component;
        $this->props = $props;
        $this->title = $title;

        $this->open = true;
    }

    #[On('closeModal')]
    public function close(): void
    {
        $this->component = null;
        $this->title = '';
        $this->props = [];
        $this->open = false;
    }
}
