<?php

declare(strict_types = 1);

namespace App\Livewire\Auth;

use App\Brain\Auth\Tasks\Check2FACode;
use App\Brain\Auth\Tasks\Generate2FaCode;
use Livewire\Component;

class TwoFa extends Component
{
    public ?int $code = null;

    public function mount()
    {
        if (session()->has('2fa:auth')) {
            $this->redirect(route('dashboard'));
        }

        if (! auth()->user()->two_factor_code) {
            $this->redirect(route('login'));
        }
    }

    public function login()
    {
        Check2FACode::dispatch([
            'user' => auth()->user(),
            'code' => $this->code,
        ]);

        $this->redirect(route('dashboard'));
    }

    public function resendCode()
    {
        ds('mandei');
        Generate2FaCode::dispatch([
            'user' => auth()->user(),
        ]);
    }

    public function render()
    {
        return view('livewire.auth.two-fa');
    }
}
