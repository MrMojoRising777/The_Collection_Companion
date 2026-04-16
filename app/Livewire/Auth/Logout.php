<?php

declare(strict_types=1);

namespace App\Livewire\Auth;

use Illuminate\View\View;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\Features\SupportRedirects\Redirector;

class Logout extends Component
{
    public function logout(): Redirector
    {
        Auth::guard('web')->logout();

        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect('/');
    }

    public function render(): View
    {
        return view('livewire.auth.logout');
    }
}
