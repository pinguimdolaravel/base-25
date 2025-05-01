<?php

declare(strict_types = 1);

namespace App\Brain\Auth\Tasks;

use Brain\Task;
use Illuminate\Contracts\Queue\ShouldQueue;

/**
 * Task LogLogin
 *
 * @property-read \App\Models\User $user
 * @property-read string $ip
 */
class LogLogin extends Task implements ShouldQueue
{
    public function handle(): self
    {
        $this->user->logins()->create([
            'ip' => $this->ip,
        ]);

        return $this;
    }
}
