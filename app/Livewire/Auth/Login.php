<?php

declare(strict_types = 1);

namespace App\Livewire\Auth;

use App\Brain\Auth\Processes\AuthProcess;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Livewire\Component;

class Login extends Component
{
    public string $email = '';

    public string $password = '';

    public bool $remember = false;

    public function login(): RedirectResponse
    {
        AuthProcess::dispatch([
            'email'    => $this->email,
            'password' => $this->password,
        ]);

        return redirect()->intended(route('dashboard'));
    }

    public function render(): View|Application|Factory|\Illuminate\View\View
    {
        return view('livewire.auth.login');
    }
}
