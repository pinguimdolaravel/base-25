<?php

declare(strict_types = 1);

namespace App\Brain\User\Tasks;

use App\Models\User;
use Brain\Task;
use Illuminate\Support\Str;

/**
 * Task SaveUser
 *
 * @property-read string $name
 * @property-read string $email
 * @property ?int $id
 */
class SaveUser extends Task
{
    public function handle(): self
    {
        $user = $this->id ? User::find($this->id) : new User();

        $user->name     = $this->name;
        $user->email    = $this->email;
        $user->password = Str::random();

        $user->save();

        return $this;
    }
}
