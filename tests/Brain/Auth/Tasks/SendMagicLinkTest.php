<?php

use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\URL;
use App\Brain\Auth\Tasks\SendMagicLink;
use App\Notifications\MagicLinkNotification;
use Illuminate\Support\Facades\Notification;

test('if user doesnt exists log and return', function () {
    Notification::fake();

    $email = 'joe@doe.com';

    Log::shouldReceive('info')
        ->once()
        ->with("User not found", [
            'email' => $email,
        ]);

    SendMagicLink::dispatch([
        'email' => $email,
    ]);

    Notification::assertNothingSent();
});

it('should update the session with the magic_link_token', function () {
    $user = User::factory()->create();

    SendMagicLink::dispatchSync(['email' => $user->email]);

    expect(session('magic_link_token'))->toBeString()
        ->and(session('user_id'))->toBe($user->id);
});

it('should send a magic link notification', function () {
    Notification::fake();

    $user = User::factory()->create();

    SendMagicLink::dispatchSync(['email' => $user->email]);

    Notification::assertSentTo($user, \App\Notifications\MagicLinkNotification::class);
});

it('should generate a valid magic link', function () {
    Notification::fake();

    $user = User::factory()->create();

    SendMagicLink::dispatchSync(['email' => $user->email]);

    Notification::assertSentTo(
        $user,
        MagicLinkNotification::class,
        function (MagicLinkNotification $notification) {
            $link = $notification->link;

            expect(
                URL::hasValidSignature(
                    request()->create($link, 'GET'),
                    true
                )
            )->toBeTrue();

            return true;
        }
    );
});
