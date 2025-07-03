<?php

declare(strict_types=1);

use App\Livewire\Pages\Users\Show;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

uses(RefreshDatabase::class);

test('user detail page can be rendered', function () {
    $user = User::factory()->create();
    $viewedUser = User::factory()->create();

    $this->actingAs($user)
        ->get(route('users.show', $viewedUser))
        ->assertOk();
});

test('guest cannot access user detail page', function () {
    $user = User::factory()->create();

    $this->get(route('users.show', $user))
        ->assertRedirect(route('login'));
});

test('component can be mounted with user', function () {
    $user = User::factory()->create();
    $viewedUser = User::factory()->create();

    Livewire::actingAs($user)
        ->test(Show::class, ['user' => $viewedUser])
        ->assertSet('user.id', $viewedUser->id)
        ->assertOk();
});

test('404 is returned for non-existent user', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->get(route('users.show', ['user' => 999]))
        ->assertNotFound();
});
