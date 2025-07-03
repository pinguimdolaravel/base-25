<?php

declare(strict_types=1);

use App\Livewire\Pages\Users\Index;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

uses(RefreshDatabase::class);

test('users page can be rendered', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->get(route('users.index'))
        ->assertOk();
});

test('guest cannot access users page', function () {
    $this->get(route('users.index'))
        ->assertRedirect(route('login'));
});

test('component can be mounted', function () {
    $user = User::factory()->create();

    Livewire::actingAs($user)
        ->test(Index::class)
        ->assertOk();
});

test('users page shows in navigation when authenticated', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->get(route('dashboard'))
        ->assertSee(route('users.index'))
        ->assertSee('Users');
});
