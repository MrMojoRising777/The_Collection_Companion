<?php

declare(strict_types=1);

namespace Feature\Livewire\Profile;

use App\Livewire\Profile\Partials\UpdateProfileInformationForm;
use App\Models\User;
use Database\Factories\UserFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class UpdateProfileInformationFormTest extends TestCase
{
    use RefreshDatabase;

    public User $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = UserFactory::new()->create();
    }

    public function test_user_can_update_profile_information(): void
    {
        Livewire::actingAs($this->user)
            ->test(UpdateProfileInformationForm::class)
            ->set('name', 'New Name')
            ->set('email', 'new@example.com')
            ->call('updateProfile')
            ->assertHasNoErrors();

        $this->assertDatabaseHas('users', [
            'id' => $this->user->id,
            'name' => 'New Name',
            'email' => 'new@example.com',
        ]);
    }

    public function test_email_verification_is_reset_when_email_changes(): void
    {
        Livewire::actingAs($this->user)
            ->test(UpdateProfileInformationForm::class)
            ->set('name', $this->user->name)
            ->set('email', 'changed@example.com')
            ->call('updateProfile');

        $this->assertNull($this->user->fresh()->emailVerifiedAt);
    }

    public function test_email_verification_remains_when_email_is_unchanged(): void
    {
        Livewire::actingAs($this->user)
            ->test(UpdateProfileInformationForm::class)
            ->set('name', 'Updated Name')
            ->set('email', $this->user->email)
            ->call('updateProfile');

        $this->assertNotNull($this->user->fresh()->emailVerifiedAt);
    }
}
