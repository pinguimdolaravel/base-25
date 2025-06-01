<?php

declare(strict_types = 1);

namespace App\Livewire\Users;

use App\Models\User;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Contracts\View\View;
use Illuminate\Pagination\AbstractPaginator;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;

#[On('users::refresh')]
class Table extends Component
{
    public ?int $quantity = 10;

    public ?string $search = null;

    /**
     * @return array<array-key, array{index: string, label?: string}>
     */
    #[Computed]
    public function headers(): array
    {
        return [
            ['index' => 'id', 'label' => '#'],
            ['index' => 'name', 'label' => 'Member'],
            ['index' => 'email', 'label' => 'Email'],
            ['index' => 'action'],
        ];
    }

    /**
     * @return \Illuminate\Pagination\LengthAwarePaginator<int, User>
     */
    #[Computed]
    public function rows(): AbstractPaginator
    {
        return User::query()
            ->when($this->search, fn (Builder $query) => $query
                ->where('name', 'like', "%{$this->search}%")
                ->orWhere('email', 'like', "%{$this->search}%"))
            ->paginate($this->quantity)
            ->withQueryString();
    }

    public function render(): View
    {
        return view('livewire.users.table');
    }
}
