<x-modal title="Delete a User" wire persistent center>
    <p>Are you sure you want to delete <span class="font-bold">{{ $name }}</span>?</p>
    <p class="text-sm text-gray-500">This action cannot be undone.</p>

    <x-slot:footer>
        <x-button type="cancel" text="Cancel" color="secondary" sm wire:click="$set('modal', false)" />
        <x-button type="button" wire:click="handle" text="Yes, I'm sure" sm wire:loading.attr="disabled" />
    </x-slot:footer>
</x-modal>
