<?php

declare(strict_types = 1);

use function Pest\Laravel\assertDatabaseHas;

it('should be able to create a new user', function (): void {
    $email = 'joe@doe.com';
    $name  = 'Joe Doe';

    App\Brain\User\Tasks\SaveUser::dispatch([
        'name'  => $name,
        'email' => $email,
    ]);

    assertDatabaseHas('users', [
        'email' => $email,
        'name'  => $name,
    ]);
});

it('should be able to edit an existing user', function (): void {
    $user  = App\Models\User::factory()->create();
    $email = 'jane@doe.com';
    $name  = 'Jane Doe';

    App\Brain\User\Tasks\SaveUser::dispatch([
        'id'    => $user->id,
        'name'  => $name,
        'email' => $email,
    ]);

    assertDatabaseHas('users', [
        'id'    => $user->id,
        'email' => $email,
        'name'  => $name,
    ]);
});
