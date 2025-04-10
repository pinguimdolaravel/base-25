<?php

declare(strict_types = 1);

namespace App\Brain\Auth\Tasks;

use Brain\Task;

/**
 * Task Check2FACode
 *
 * @property-read \App\Models\User $user
 * @property-read int $code
 */
class Check2FACode extends Task
{
    public function handle(): self
    {
        ds([
            'user' => $this->user->two_factor_code,
            'code' => $this->code,
        ]);

        if ($this->user->two_factor_code != $this->code) {
            throw new \Exception('Invalid 2FA code');
        }

        if ($this->user->two_factor_expires_at < now()) {
            throw new \Exception('2FA code expired');
        }

        $this->user->update([
            'two_factor_code'       => null,
            'two_factor_expires_at' => null,
        ]);

        session()->put('2fa:auth', true);

        return $this;
    }
}
