<?php

declare(strict_types = 1);

namespace App\Livewire;

use App\Models\Role;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class Playground extends Component
{
    public function handle(): void
    {
        $role         = Role::inRandomOrder()->first();
        $randomNumber = random_int(1, 100);
        $originalName = str_contains((string) $role->name, '::')
            ? trim(substr((string) $role->name, strrpos((string) $role->name, '::') + 2))
            : $role->name;
        $role->name = "Updated Role :: $randomNumber :: $originalName";
        $role->save();

        Log::info('Role updated');
    }

    public function render(): View
    {
        return view('livewire.playground');
    }
}
