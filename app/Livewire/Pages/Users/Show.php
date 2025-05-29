<?php

declare(strict_types = 1);

namespace App\Livewire\Pages\Users;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class Show extends Component
{
    public ?User $user = null;

    public function mount(User $user): void
    {
        $this->user = $user;
    }

    public function render(): View
    {
        return view('livewire.pages.users.show');
    }
}
