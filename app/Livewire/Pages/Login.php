<?php

declare(strict_types = 1);

namespace App\Livewire\Pages;

use App\Brain\Auth\Tasks\SendMagicLink;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Login extends Component
{
    public string $email = '';

    public bool $showMessage = false;

    public function login()
    {
        // converter para um processo
        // 1. LoginRateLimit
        // 2. SendMagicLink

        SendMagicLink::dispatch([
            'email' => $this->email,
        ]);

        $this->showMessage = true;
    }

    #[Layout('components.layouts.guest')]
    public function render()
    {
        return view('livewire.auth.login');
    }
}
