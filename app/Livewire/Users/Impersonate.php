<?php

declare(strict_types = 1);

namespace App\Livewire\Users;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\On;
use Livewire\Component;
use TallStackUi\Traits\Interactions;

class Impersonate extends Component
{
    use Interactions;

    public ?int $id = null;

    public ?string $name = null;

    public bool $modal = false;

    #[On('users::impersonate')]
    public function open(int $id): void
    {
        if (Auth::id() == $id) {
            $this->toast()->error('You can not impersonate yourself!')->send();

            return;
        }

        $user        = User::findOrFail($id);
        $this->modal = true;
        $this->id    = $user->id;
        $this->name  = $user->name;
    }

    public function handle(): void
    {
        Session::put('impersonate_as', $this->id);
        Session::put('impersonator_id', Auth::id());

        $this->redirectRoute('dashboard');
    }

    public function render()
    {
        return view('livewire.users.impersonate');
    }
}
