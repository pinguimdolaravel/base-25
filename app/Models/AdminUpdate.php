<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminUpdate extends Model
{
    protected function casts(): array
    {
        return [
            'changes' => 'array',
        ];
    }
}
