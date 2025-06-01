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

it('should send magic link notification to the user', function (): void {
    Notification::fake();

    $user = User::factory()->create();

    SendMagicLink::dispatch([
        'email' => $user->email,
    ]);

    Notification::assertSentTo(
        notifiable: $user,
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

    $response->assertRedirect(route('dashboard'));
});

it('should redirect to login if token is invalid', function (): void {
    $user = User::factory()->create();

    $invalidToken = 'invalid-token';

    $response = $this->withSession([
        'magic_link_token' => 'correct-token',
        'user_id'          => $user->id,
    ])->get(route('2fa.magic-link', ['token' => $invalidToken]));

    $this->assertGuest();

    $response->assertRedirect(route('login'));
});

it('should add user to the payload', function (): void {
    $user = User::factory()->create();

    session(['user_id' => $user->id]);

    $task = Login::dispatchSync([]);

    expect($task->payload)->user->id->toBe($user->id);
});
