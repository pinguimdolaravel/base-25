<?php

use App\Brain\Auth\Tasks\CheckToken;
use Illuminate\Support\Facades\Log;

it('should throw an exception if token doesnt match with the session', function () {
    CheckToken::dispatch(['token' => 'invalid_token']);
})->throws(\App\Brain\Auth\Exceptions\InvalidToken::class);

it('should log', function () {
    Log::shouldReceive('info')
        ->once()
        ->with('Invalid token', ['token' => 'invalid_token']);

    CheckToken::dispatchSync(['token' => 'invalid_token']);
})->throws(\App\Brain\Auth\Exceptions\InvalidToken::class);
