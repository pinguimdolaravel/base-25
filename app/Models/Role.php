<?php

declare(strict_types = 1);

namespace App\Models;

use Database\Factories\RoleFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Role extends Model
{
    /**
     * @use HasFactory<RoleFactory>
     */
    use HasFactory;

    /**
     * @return BelongsToMany<Permission,$this>
     */
    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(Permission::class);
    }

    /**
     * @return BelongsToMany<User,$this>
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }
}
