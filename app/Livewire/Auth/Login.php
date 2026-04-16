<?php

declare(strict_types=1);

namespace App\Livewire\Auth;

use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Events\Lockout;
use Livewire\Features\SupportRedirects\Redirector;

#[Layout('components.layouts.guest')]
class Login extends Component
{
    #[Validate(['required', 'string', 'email'])]
    public string $email = '';

    #[Validate(['required', 'string'])]
    public string $password = '';

    #[Validate(['required', 'bool'])]
    public bool $remember = false;

    public function login(): Redirector
    {
        $this->validate();

        $this->ensureIsNotRateLimited();

        if (! Auth::attempt([
            'email' => $this->email,
            'password' => $this->password,
        ], $this->remember)) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'email' => __('auth.failed'),
            ]);
        }

        RateLimiter::clear($this->throttleKey());

        request()->session()->regenerate();

        return redirect()->intended(route('dashboard'));
    }

    protected function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout(request()));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    protected function throttleKey(): string
    {
        return Str::transliterate(
            Str::lower($this->email).'|'.request()->ip()
        );
    }

    public function render(): View
    {
        return view('livewire.auth.login');
    }
}
