<?php

declare(strict_types = 1);

namespace App\Livewire\Pages;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Component;

class Dashboard extends Component
{
    public function render(): View | Application | Factory | \Illuminate\View\View
    {
        return view('livewire.dashboard');
    }
}
