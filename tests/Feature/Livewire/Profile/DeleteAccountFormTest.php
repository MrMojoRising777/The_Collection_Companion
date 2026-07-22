<?php

declare(strict_types=1);

namespace Feature\Livewire\Profile;

use App\Livewire\Profile\Partials\DeleteAccountForm;
use App\Models\User;
use Database\Factories\UserFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class DeleteAccountFormTest extends TestCase
{
    use RefreshDatabase;

    public User $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->withSession([]);

        $this->user = UserFactory::new()->create();
    }

    public function test_user_can_delete_account(): void
    {
        Livewire::actingAs($this->user)
            ->test(DeleteAccountForm::class)
            ->set('password', 'password')
            ->call('deleteUser')
            ->assertRedirect('/');

        $this->assertGuest();

        $this->assertDatabaseMissing('users', [
            'id' => $this->user->id,
        ]);
    }

    public function test_correct_password_is_required_to_delete_account(): void
    {
        Livewire::actingAs($this->user)
            ->test(DeleteAccountForm::class)
            ->set('password', 'wrong-password')
            ->call('deleteUser')
            ->assertHasErrors(['password']);

        $this->assertDatabaseHas('users', [
            'id' => $this->user->id,
        ]);
    }
}
