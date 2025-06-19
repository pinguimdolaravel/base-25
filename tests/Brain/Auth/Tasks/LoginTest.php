<?php

declare(strict_types = 1);

use App\Brain\Auth\Tasks\Login;
use App\Brain\Auth\Tasks\SendMagicLink;
use App\Models\User;
use App\Notifications\MagicLinkNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

beforeEach(function () {
    $this->user = User::factory()->create();

    session()->put('user_id', $this->user->id);
});

it('should be able to login', function (): void {
    Notification::fake();

    SendMagicLink::dispatch([
        'email' => $this->user->email,
    ]);

    Notification::assertSentTo(
        notifiable: $this->user,
        notification: MagicLinkNotification::class
    );
});

it("should be able to login with magic link", function (): void {
    Notification::fake();

    $user = User::factory()->create();

    $token = Str::random(16);

    session()->put('magic_link_token', $token);

    session()->put('user_id', $user->id);

    $link = URL::temporarySignedRoute(
        name: '2fa.magic-link',
        expiration: now()->addMinutes(30),
        parameters: [
            'token' => $token,
        ]
    );

    $user->notify(new MagicLinkNotification($link));

    Notification::assertSentTo(
        notifiable: $user,
        notification: MagicLinkNotification::class,
        callback: function ($notification) use (&$magicLink, $user): bool {
            $magicLink = $notification->toMail($user)->actionUrl;

            return true;
        }
    );

    expect($magicLink)->not->toBeNull();

    $response = $this->withSession([
        'magic_link_token' => $token,
        'user_id'          => $user->id,
    ])->get($magicLink);

    $this->assertAuthenticatedAs($user);

    expect(Auth::check())->toBeTrue()
        ->and(Auth::id())->toBe($user->id);
});

it('it should add user to the payload', function (): void {
    $task = Login::dispatchSync([]);

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
