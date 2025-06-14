<?php

declare(strict_types = 1);

use App\Brain\Auth\Tasks\Login;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

beforeEach(function () {
    $this->user = User::factory()->create();

    session()->put('user_id', $this->user->id);
});

it('should be able to login', function (): void {
    Login::dispatch([
        'email' => $this->user->email,
    ]);

    expect(Auth::check())->toBeTrue()
        ->and(Auth::id())->toBe($this->user->id);
});

it('it should add user to the payload', function (): void {
    $task = Login::dispatchSync([
        'email'    => $this->user->email,
        'password' => 'password',
    ]);

    expect($task->payload)->user->id->toBe($this->user->id);
});

describe('validations', function (): void {
    it('should throw an exception if user_id is not in session', function (): void {
        session()->forget('user_id');

        $this->expectException(ValidationException::class);
        $this->expectExceptionMessage('User ID is required.');

        Login::dispatchSync([]);
    });

    it('should throw an exception if user does not exist', function (): void {
        session()->put('user_id', 9999);

        $this->expectException(ValidationException::class);
        $this->expectExceptionMessage('User not found.');

        Login::dispatchSync([]);
    });
});
