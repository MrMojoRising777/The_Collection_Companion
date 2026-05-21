<?php

declare(strict_types=1);

namespace App\Livewire\Profile\Partials;

use App\Models\User;
use App\Traits\HasAlerts;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Livewire\Component;

class UpdateProfileInformationForm extends Component
{
    use HasAlerts;

    public string $name = '';
    public string $email = '';
    public bool $verificationLinkSent = false;

    public function mount(): void
    {
        /** @var User $user */
        $user = Auth::user();

        $this->name = $user->name;
        $this->email = $user->email;
    }

    protected function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users')->ignore(Auth::id()),
            ],
        ];
    }

    public function updateProfile(): void
    {
        /** @var User $user */
        $user = Auth::user();

        $validated = $this->validate();

        if ($user->email !== $validated['email']) {
            $user->emailVerifiedAt = null;
        }

        $user->update($validated);

        $this->dispatch('profile-updated');

        $this->alert(message: 'Profile updated successfully!');
    }

    public function sendVerification(): void
    {
        /** @var User $user */
        $user = Auth::user();

        if ($user->hasVerifiedEmail()) {
            return;
        }

        $user->sendEmailVerificationNotification();

        $this->verificationLinkSent = true;
    }

    public function render(): View
    {
        return view('livewire.profile.partials.update-profile-information-form', [
            'user' => Auth::user(),
        ]);
    }
}
