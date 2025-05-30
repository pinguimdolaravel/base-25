<?php

declare(strict_types = 1);

use App\Brain\User\Tasks\DestroyUser;

use function Pest\Laravel\assertSoftDeleted;

it('should be able to delete a user', function () {
    $user = App\Models\User::factory()->create();

    DestroyUser::dispatch([
        'id'           => $user->id,
        'loggedUserId' => 2, // Simulating a different logged user
    ]);

    assertSoftDeleted('users', [
        'id' => $user->id,
    ]);
});

it('should throw an exception when is the logged user', function () {
    $user = App\Models\User::factory()->create();

    DestroyUser::dispatch([
        'id'           => $user->id,
        'loggedUserId' => $user->id, // Simulating the logged user trying to delete themselves
    ]);
})->throws(Exception::class, 'You can not delete yourself!');
