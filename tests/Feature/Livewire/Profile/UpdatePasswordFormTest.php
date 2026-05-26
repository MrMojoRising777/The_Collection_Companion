<?php

declare(strict_types=1);

namespace Tests\Feature\Livewire\Profile;

use App\Livewire\Profile\Partials\UpdatePasswordForm;
use Database\Factories\UserFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Livewire\Livewire;
use Tests\TestCase;

class UpdatePasswordFormTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_update_password(): void
    {
        $user = UserFactory::new()->create([
            'password' => Hash::make('old-password'),
        ]);

        Livewire::actingAs($user)
            ->test(UpdatePasswordForm::class)
            ->set('current_password', 'old-password')
            ->set('password', 'new-password')
            ->set('password_confirmation', 'new-password')
            ->call('updatePassword')
            ->assertHasNoErrors();

        $this->assertTrue(Hash::check(
            'new-password',
            $user->fresh()->password
        ));
    }

    public function test_password_update_requires_correct_current_password(): void
    {
        $user = UserFactory::new()->create([
            'password' => Hash::make('correct-password'),
        ]);

        Livewire::actingAs($user)
            ->test(UpdatePasswordForm::class)
            ->set('current_password', 'wrong-password')
            ->set('password', 'new-password')
            ->set('password_confirmation', 'new-password')
            ->call('updatePassword')
            ->assertHasErrors(['current_password']);
    }
}
