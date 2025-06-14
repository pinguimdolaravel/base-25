<?php

declare(strict_types = 1);

namespace Tests\Feature\Livewire;

use App\Models\User;
use Livewire\Livewire;

it('can render login page', function (): void {
    $this->get(route('login'))->assertStatus(200);
});

describe('validation', function (): void {
    it('validates email is required', function (): void {
        Livewire::test('pages.login')
            ->set('email', '')
            ->call('handle')
            ->assertHasErrors(['email' => 'required']);
    });

    it('validates email format', function (): void {
        Livewire::test('pages.login')
            ->set('email', 'invalid-email')
            ->call('handle')
            ->assertHasErrors(['email' => 'email']);
    });
});

it('sends magic link on valid email', function (): void {
    $user = User::factory()->create();

    Livewire::test('pages.login')
        ->set('email', $user->email)
        ->call('handle')
        ->assertSet('showMessage', true);
});
