<?php

declare(strict_types = 1);

namespace App\Brain\Auth\Tasks;

use App\Models\User;
use App\Notifications\MagicLinkNotification;
use Brain\Task;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

/**
 * Task SendMagicLink
 *
 * @property-read string $email
 */
class SendMagicLink extends Task
{
    public function handle(): self
    {
        $user = User::where('email', $this->email)->first();

        if (! $user) {
            Log::info('User not found', [
                'email' => $this->email,
            ]);

            return $this;
        }

        $token = Str::random(16);
        session()->put('magic_link_token', $token);
        session()->put('user_id', $user->id);

        $link = URL::temporarySignedRoute('2fa.magic-link', now()->addMinutes(30), [
            'token' => $token,
        ]);

        $user->notify(new MagicLinkNotification($link));

        return $this;
    }
}
