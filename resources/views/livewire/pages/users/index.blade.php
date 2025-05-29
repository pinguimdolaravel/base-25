<div>
    <x-h1 class="mb-8 flex justify-between">
        <span>Users</span>
        <x-button text="Create New User" light sm wire:click="$dispatch('users::create')" />
    </x-h1>

    <livewire:users.table />

    <livewire:users.create />
    <livewire:users.edit />
    <livewire:users.destroy />
    <livewire:users.impersonate />
</div>
