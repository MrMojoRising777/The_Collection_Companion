<?php

declare(strict_types=1);

namespace App\Livewire\Profile\Partials;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\Features\SupportRedirects\Redirector;

class DeleteAccountForm extends Component
{
    #[validate(['required', 'current_password'])]
    public string $password = '';
    public bool $confirmingUserDeletion = false;

    public function confirmUserDeletion(): void
    {
        $this->resetErrorBag();
        $this->password = '';
        $this->confirmingUserDeletion = true;
    }

    public function deleteUser(): Redirector
    {
        $this->validate();

        $user = Auth::user();

        Auth::logout();

        $user->delete();

        app('session')->invalidate();
        app('session')->regenerateToken();

        return redirect('/');
    }

    public function render(): View
    {
        return view('livewire.profile.partials.delete-account-form');
    }
}
