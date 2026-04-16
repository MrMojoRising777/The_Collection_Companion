<?php

declare(strict_types=1);

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Password;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;

#[Layout('components.layouts.guest')]
class ForgotPassword extends Component
{
    #[Validate(['required', 'string', 'email', 'max:255'])]
    public string $email = '';

    public function sendResetLink(): void
    {
        $this->validate();

        Password::sendResetLink([
            'email' => $this->email,
        ]);

        session()->flash('status', __(Password::RESET_LINK_SENT));
    }

    public function render(): View
    {
        return view('livewire.auth.forgot-password');
    }
}
