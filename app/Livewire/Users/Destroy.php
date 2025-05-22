<?php

declare(strict_types = 1);

namespace App\Livewire\Users;

use App\Brain\User\Tasks\DestroyUser;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;
use TallStackUi\Traits\Interactions;

class Destroy extends Component
{
    use Interactions;

    public ?int $id = null;

    public ?string $name = null;

    public bool $modal = false;

    #[On('users::destroy')]
    public function open(int $id): void
    {
        $user        = User::findOrFail($id);
        $this->modal = true;
        $this->id    = $user->id;
        $this->name  = $user->name;
    }

    public function handle(): void
    {
        try {
            DestroyUser::dispatch([
                'loggedUserId' => Auth::id(),
                'id'           => $this->id,
            ]);

            $this->toast()->success('User deleted!')->send();
            $this->reset();
            $this->dispatch('users::refresh');
        } catch (\Throwable $th) {
            $this->toast()->error($th->getMessage())->send();
        } finally {
            $this->reset();
        }
    }

    public function render():View
    {
        return view('livewire.users.destroy');
    }
}
