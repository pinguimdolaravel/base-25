<x-modal title="Edit user" wire persistent center>
    <form wire:submit="handle" id="edit-user-form" class="space-y-4">
        <x-input label="Name" wire:model="name" />
        <x-input label="E-mail" wire:model="email" />
    </form>

    <x-slot:footer>
        <x-button type="cancel" text="Cancel" color="secondary" sm wire:click="$set('modal', false)" />
        <x-button form="edit-user-form" type="submit" text="Save" sm wire:loading.attr="disabled" />
    </x-slot:footer>
</x-modal>
