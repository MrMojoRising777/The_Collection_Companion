<?php

declare(strict_types=1);

namespace App\Livewire\Auth;

use Illuminate\View\View;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Logout extends Component
{
    public function logout(): void
    {
        Auth::guard('web')->logout();

        request()->session()->invalidate();
        request()->session()->regenerateToken();

        $this->redirectRoute('login');
    }

    public function render(): View
    {
        return view('livewire.auth.logout');
    }
}
