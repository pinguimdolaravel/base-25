<x-modal title="Impersonate User" wire persistent center>
    <p>
        Are you sure you want to impersonate
        <span class="font-bold">{{ $name }}</span>
        ?
    </p>

    <x-slot:footer>
        <x-button type="cancel" text="Cancel" color="secondary" sm wire:click="$set('modal', false)" />
        <x-button type="button" wire:click="handle" text="Yes, I'm sure" sm wire:loading.attr="disabled" />
    </x-slot>
</x-modal>
