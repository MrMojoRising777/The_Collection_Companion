<?php

declare(strict_types=1);

namespace App\Livewire\Auth;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\Features\SupportRedirects\Redirector;

#[Layout('components.layouts.guest')]
class Register extends Component
{
    #[Validate(['required', 'string', 'max:255'])]
    public string $name = '';

    #[Validate(['required', 'string', 'email', 'max:255', 'unique:users'])]
    public string $email = '';

    #[Validate(['required', 'string', 'min:8', 'confirmed'])]
    public string $password = '';

    public string $password_confirmation = '';

    public function register(): Redirector
    {
        $this->validate();

        /** @var User $user */
        $user = User::query()
            ->create([
                'name' => $this->name,
                'email' => $this->email,
                'password' => Hash::make($this->password),
            ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect()->intended(route('dashboard'));
    }

    public function render(): View
    {
        return view('livewire.auth.register');
    }
}
