<?php

declare(strict_types = 1);

namespace App\Livewire;

use Livewire\Attributes\Lazy;
use Livewire\Component;

#[Lazy]
class DashboardCard extends Component
{
    public $num = null;

    public $number = null;

    public function mount(): void
    {
        $this->number = number_format($this->num * random_int(100, 10022), 2, '.', '');
    }

    public function placeholder()
    {
        return <<<BLADE
            <div class="bg-gray rounded-lg shadow-lg p-6">
                <h3 class="text-gray-500 text-sm font-medium mb-2">Carregando</h3>
                <div class="flex items-center">
                    <div class="text-4xl font-bold text-gray-900">{{ $this->num }}</div>
                </div>
            </div>
        BLADE;
    }

    public function render()
    {
        if ($this->num) {
            sleep($this->num);
        }

        return view('livewire.dashboard-card');
    }
}
