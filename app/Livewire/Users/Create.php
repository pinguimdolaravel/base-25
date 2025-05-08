<?php

declare(strict_types = 1);

namespace App\Livewire\Users;

use App\Brain\User\Tasks\SaveUser;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;
use TallStackUi\Traits\Interactions;

class Create extends Component
{
    use Interactions;

    public bool $modal = false;

    #[Validate(['required', 'string', 'max:255'])]
    public string $name = '';

    #[Validate(['required', 'email', 'string', 'max:255'])]
    public string $email = '';

    #[On('users::create')]
    public function open(): void
    {
        $this->modal = true;
    }

    public function handle(): void
    {
        $this->validate();

        SaveUser::dispatch([
            'name'  => $this->name,
            'email' => $this->email,
        ]);

        $this->toast()->success('User created!')->send();
        $this->reset();
        $this->dispatch('users::refresh');
    }

    public function render(): View
    {
        return view('livewire.users.create');
    }
}
