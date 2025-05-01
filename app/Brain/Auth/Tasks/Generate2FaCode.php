<?php

declare(strict_types = 1);

namespace App\Brain\Auth\Tasks;

use App\Models\User;
use App\Notifications\Login2FaCodeNotification;
use Brain\Task;

/**
 * Task Generate2FaCode
 *
 * @property-read User $user
 */
class Generate2FaCode extends Task
{
    public function handle(): self
    {
        $code = random_int(100000, 999999);

        $this->user->update([
            'two_factor_code'       => $code,
            'two_factor_expires_at' => now()->addMinutes(10),
        ]);

        $this->user->notify(new Login2FaCodeNotification());

        return $this;
    }
}
