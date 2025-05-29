<x-modal title="Create new User" wire persistent center>
    <form wire:submit="handle" id="create-user-form" class="space-y-4">
        <x-input label="Name" wire:model="name" />
        <x-input label="E-mail" wire:model="email" />
    </form>

    <x-slot:footer>
        <x-button type="cancel" text="Cancel" color="secondary" sm wire:click="$set('modal', false)" />
        <x-button form="create-user-form" type="submit" text="Create" sm wire:loading.attr="disabled" />
    </x-slot>
</x-modal>
