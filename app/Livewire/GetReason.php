<?php

namespace App\Livewire;

use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class GetReason extends Component
{
    public bool $modal = false;

    public ?int $id = null;

    public string $reason = '';

    #[On('echo:admin,AskForReason')]
    public function open(int $id): void
    {
        $this->modal = true;
        $this->id = $id;
    }

    public function handle():void
    {
       $this->validate();

       dd($this->id);
    }

    public function render(): View
    {
        return view('livewire.get-reason');
    }
}
