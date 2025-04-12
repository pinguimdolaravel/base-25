<?php

declare(strict_types = 1);

namespace App\Models;

use Database\Factories\PermissionFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Permission extends Model
{
    /**
     * @use HasFactory<PermissionFactory>
     */
    use HasFactory;

    /**
     * @return BelongsToMany<Role,$this>
     */
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class);
    }

    /**
     * @return BelongsToMany<User,$this>
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }
}
