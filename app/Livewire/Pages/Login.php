<?php

declare(strict_types = 1);

namespace App\Livewire\Pages;

use App\Brain\Auth\Tasks\SendMagicLink;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Login extends Component
{
    #[Validate('required|email')]
    public string $email = '';

    public bool $showMessage = false;

    public function handle(): void
    {
        $this->validate();

        SendMagicLink::dispatch([
            'email' => $this->email,
        ]);

        $this->showMessage = true;
    }

    #[Layout('components.layouts.guest')]
    public function render(): View
    {
        return view('livewire.auth.login');
    }
}
