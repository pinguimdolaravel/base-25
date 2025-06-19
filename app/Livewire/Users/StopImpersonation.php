<?php

declare(strict_types=1);

namespace App\Livewire\Users;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Context;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Computed;
use Livewire\Component;

class StopImpersonation extends Component
{
    #[Computed]
    public function user(): User
    {
        return User::find(Session::get('impersonate_as'))->first();
    }

    #[Computed]
    public function isImpersonating(): bool
    {
        return Session::has('impersonate_as');
    }

    public function handle(): void
    {
        Session::forget(['impersonate_as', 'impersonator_id']);
        Context::forget(['impersonator_id', 'impersonate_as']);

        $this->redirectRoute('dashboard');
    }

    public function render(): View
    {
        return view('livewire.users.stop-impersonation');
    }
}
