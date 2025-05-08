<?php

declare(strict_types = 1);

namespace App\Livewire\Users;

use App\Models\User;
use Livewire\Attributes\Computed;
use Livewire\Component;

class StopImpersonation extends Component
{
    #[Computed]
    public function user(): User
    {
        return User::find(session()->get('impersonate_as'));
    }

    #[Computed]
    public function isImpersonating(): bool
    {
        return session()->has('impersonate_as');
    }

    public function handle(): void
    {
        session()->forget('impersonate_as');

        $this->redirectRoute('dashboard');
    }

    public function render()
    {
        return view('livewire.users.stop-impersonation');
    }
}
