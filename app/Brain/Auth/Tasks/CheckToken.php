<?php

declare(strict_types = 1);

namespace App\Brain\Auth\Tasks;

use App\Brain\Auth\Exceptions\InvalidToken;
use Brain\Task;
use Illuminate\Support\Facades\Log;

/**
 * Task CheckToken
 *
 * @property-read string $token
 */
class CheckToken extends Task
{
    public function handle(): self
    {
        if ($this->token != session('magic_link_token')) {
            Log::info('Invalid token', ['token' => $this->token]);

            $this->cancelProcess();

            throw new InvalidToken();
        }

        return $this;
    }
}
