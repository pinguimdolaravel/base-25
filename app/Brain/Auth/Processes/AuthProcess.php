<?php

declare(strict_types=1);

namespace App\Brain\Auth\Processes;

use App\Brain\Auth\Exceptions\InvalidToken;
use App\Brain\Auth\Tasks\CheckToken;
use App\Brain\Auth\Tasks\Login;
use App\Brain\Auth\Tasks\LogLogin;
use Brain\Process;

/**
 * @throws InvalidToken
 */
class AuthProcess extends Process
{
    protected array $tasks = [
        CheckToken::class,
        Login::class,
        LogLogin::class,
    ];
}
