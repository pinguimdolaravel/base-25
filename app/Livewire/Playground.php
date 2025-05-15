<?php

declare(strict_types = 1);

namespace App\Livewire;

use App\Models\Role;
use Illuminate\Support\Facades\Context;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class Playground extends Component
{
    public function handle(): void
    {
        $role         = Role::inRandomOrder()->first();
        $randomNumber = random_int(1, 100);
        $originalName = str_contains($role->name, '::')
            ? trim(substr($role->name, strrpos($role->name, '::') + 2))
            : $role->name;
        $role->name = "Updated Role :: $randomNumber :: $originalName";
        $role->save();
        Context::add('testing', 123);

        Log::info('Role updated', [
            'id'   => $role->id,
            'name' => $role->name,
        ]);
    }

    public function render()
    {
        return view('livewire.playground');
    }
}
