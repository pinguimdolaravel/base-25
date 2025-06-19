<?php

declare(strict_types = 1);

namespace App\Brain\Auth\Tasks;

use App\Models\User;
use Brain\Task;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

/**
 * Task Login
 *
 * @property User $user
 * @property string $ip
 */
class Login extends Task
{
    public function handle(): self
    {
        $userId = session()->get('user_id');

        if (! $userId) {
            throw ValidationException::withMessages([
                'user_id' => 'User ID is required.',
            ]);
        }

        /** @var ?Authenticatable $user */
        $user = User::query()->find($userId);

        if (! $user) {
            throw ValidationException::withMessages([
                'user_id' => 'User not found.',
            ]);
        }

        Auth::login($user);

        $this->user = Auth::user();
        $this->ip   = request()->ip();

        return $this;
    }
}
