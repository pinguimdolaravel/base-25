<?php

declare(strict_types = 1);

namespace App\Livewire\Users;

use App\Brain\User\Tasks\SaveUser;
use App\Models\User;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;
use TallStackUi\Traits\Interactions;

class Edit extends Component
{
    use Interactions;

    public bool $modal = false;

    public ?User $user = null;

    #[Validate(['required', 'string', 'max:255'])]
    public string $name = '';

    #[Validate(['required', 'email', 'string', 'max:255'])]
    public string $email = '';

    #[On('users::edit')]
    public function open(int $id): void
    {
        $this->user  = User::findOrFail($id);
        $this->name  = $this->user->name;
        $this->email = $this->user->email;

        $this->modal = true;
    }

    public function handle(): void
    {
        $this->validate();

        SaveUser::dispatch([
            'name'  => $this->name,
            'email' => $this->email,
            'id'    => $this->id,
        ]);

        $this->toast()->success('User updated!')->send();
        $this->reset();
        $this->dispatch('users::refresh');
    }

    public function render()
    {
        return view('livewire.users.edit');
    }
}
