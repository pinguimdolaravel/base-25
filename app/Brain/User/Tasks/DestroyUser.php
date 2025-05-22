<?php

declare(strict_types = 1);

namespace App\Brain\User\Tasks;

use App\Models\User;
use Brain\Task;

/**
 * Task DestroyUser
 *
 * @property-read int $loggedUserId
 * @property-read int $id
 */
class DestroyUser extends Task
{
    public function handle(): self
    {
        if ($this->loggedUserId == $this->id) {
            throw new \Exception('You can not delete yourself!');
        }

        $user = User::findOrFail($this->id);

        $user->delete();

        return $this;
    }
}
