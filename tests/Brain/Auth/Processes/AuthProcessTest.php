<?php

declare(strict_types = 1);

use App\Brain\Auth\Exceptions\InvalidToken;
use App\Brain\Auth\Processes\AuthProcess;
use App\Brain\Auth\Tasks\CheckToken;
use App\Brain\Auth\Tasks\Login;
use App\Brain\Auth\Tasks\LogLogin;
use Illuminate\Support\Facades\Bus;

test('check if auth process has all the tasks', function (): void {
    $process = new AuthProcess([]);

    expect($process->getTasks())
        ->toBe([
            CheckToken::class,
            Login::class,
            LogLogin::class,
        ]);
});

test('login should not be called when CheckToken throws an exception', function () {
    Bus::fake([Login::class]);

    AuthProcess::dispatch([
        'token' => 'invalid_token',
    ]);

    Bus::assertNotDispatched(Login::class);
})->throws(InvalidToken::class);
