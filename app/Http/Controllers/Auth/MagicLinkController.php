<?php

declare(strict_types = 1);

namespace App\Http\Controllers\Auth;

use App\Brain\Auth\Exceptions\InvalidToken;
use App\Brain\Auth\Processes\AuthProcess;
use App\Http\Controllers\Controller;

class MagicLinkController extends Controller
{
    public function __invoke(string $token)
    {
        try {
            AuthProcess::dispatchSync([
                'token' => $token,
            ]);

            return to_route('dashboard');
        } catch (InvalidToken $th) {
            return to_route('login');
        } catch (\Throwable $th) {
            return to_route('login');
        }
    }
}
