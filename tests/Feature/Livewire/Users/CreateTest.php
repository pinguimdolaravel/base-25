<?php

declare(strict_types = 1);

use App\Livewire\Users\Create;
use Livewire\Livewire;

test('when open modal should be true', function (): void {
    Livewire::test(Create::class)
        ->call('open')
        ->assertSet('modal', true);
});

test('should call task SaveUser', function () {
    Bus::fake();

    Livewire::test(Create::class)
        ->set('name', 'test')
        ->set('email', 'joe@doe.com')
        ->call('handle')
        ->assertDispatched('users::refresh')
        ->assertSet('modal', false)
        ->assertSet('name', '')
        ->assertSet('email', '')
        ->assertHasNoErrors();

    Bus::assertDispatched(App\Brain\User\Tasks\SaveUser::class);
});

describe('validation', function (): void {
    test('name: required', function () {
        Livewire::test(Create::class)
            ->set('name', '')
            ->call('handle')
            ->assertHasErrors(['name' => 'required']);
    });

    test('name: max 255', function () {
        Livewire::test(Create::class)
            ->set('name', 'a' . str_repeat('a', 256))
            ->call('handle')
            ->assertHasErrors(['name' => 'max']);
    });

    test('email: required', function () {
        Livewire::test(Create::class)
            ->set('email', '')
            ->call('handle')
            ->assertHasErrors(['email' => 'required']);
    });

    test('email: email', function () {
        Livewire::test(Create::class)
            ->set('email', 'invalid-email')
            ->call('handle')
            ->assertHasErrors(['email' => 'email']);
    });

    test('email: max 255', function () {
        Livewire::test(Create::class)
            ->set('email', 'a' . str_repeat('a', 256) . '@<EMAIL>')
            ->call('handle')
            ->assertHasErrors(['email' => 'max']);
    });
});
