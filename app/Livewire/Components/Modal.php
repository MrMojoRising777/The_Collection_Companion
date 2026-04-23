<?php

declare(strict_types=1);

namespace App\Livewire\Components;

use Illuminate\View\View;
use Livewire\Component;

class Modal extends Component
{
    public bool $open = false;
    public string $title = '';
    public ?string $view = null;
    public array $viewData = [];

    protected $listeners = [
        'openModal' => 'open',
        'closeModal' => 'close',
    ];

    public function open(
        string $title = '',
        string $view = '',
        array $viewData = [],
    ): void {
        $this->title = $title;
        $this->view = $view;
        $this->viewData = $viewData;
//dd($title, $view, $viewData);
        $this->open = true;
    }

    public function close(): void
    {
        $this->open = false;
    }

    public function render(): View
    {
        return view('livewire.components.modal');
    }
}
