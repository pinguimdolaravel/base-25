<?php

use App\Brain\Auth\Tasks\LogLogin;

use function Pest\Laravel\assertDatabaseHas;

it('should create a new login record', function () {
    $user = \App\Models\User::factory()->create();

    LogLogin::dispatchSync([
        'user' => $user,
        'ip' => '127.0.0.1'
    ]);

    assertDatabaseHas('logins', [
        'user_id' => $user->id,
        'ip' => '127.0.0.1'
    ]);
});

it('should run in a queue', function() {
    expect(LogLogin::class)
        ->toImplement(\Illuminate\Contracts\Queue\ShouldQueue::class);
});
