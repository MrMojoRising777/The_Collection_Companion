<?php

declare(strict_types=1);

namespace App\Livewire\Profile\Partials;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;
use Livewire\Component;

class UpdatePasswordForm extends Component
{
    public string $current_password = '';
    public string $password = '';
    public string $password_confirmation = '';

    public bool $saved = false;

    protected function rules(): array
    {
        return [
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'confirmed', Password::defaults()],
        ];
    }

    public function updatePassword(): void
    {
        $this->validate();

        $user = Auth::user();

        $user->update([
            'password' => Hash::make($this->password),
        ]);

        // reset fields
        $this->reset(['current_password', 'password', 'password_confirmation']);

        $this->saved = true;

        $this->dispatch('password-updated');
    }

    public function render(): View
    {
        return view('livewire.profile.partials.update-password-form');
    }
}
