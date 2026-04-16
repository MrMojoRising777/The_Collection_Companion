<?php

declare(strict_types=1);

namespace App\Livewire\Auth;

use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\Features\SupportRedirects\Redirector;

#[Layout('components.layouts.guest')]
class ResetPassword extends Component
{
    #[Validate(['required'])]
    public string $token;

    #[Validate(['required', 'string', 'email', 'max:255'])]
    public string $email = '';

    #[Validate(['required', 'string', 'min:8', 'confirmed'])]
    public string $password = '';

    public string $password_confirmation = '';

    public function mount(
        $token = null,
        $email = null,
    ): void {
        $this->token = $token ?? request()->route('token');
        $this->email = $email ?? request()->email ?? '';
    }

    public function resetPassword(): Redirector|null
    {
        $this->validate();

        $status = Password::reset(
            [
                'email' => $this->email,
                'password' => $this->password,
                'password_confirmation' => $this->password_confirmation,
                'token' => $this->token,
            ],
            function (User $user) {
                $user->forceFill([
                    'password' => Hash::make($this->password),
                    'remember_token' => Str::random(60),
                ])->save();

                event(new PasswordReset($user));
            }
        );

        if ($status === Password::PASSWORD_RESET) {
            return redirect()->route('login')->with('status', __($status));
        }

        $this->addError('email', __($status));
    }

    public function render(): View
    {
        return view('livewire.auth.reset-password');
    }
}
