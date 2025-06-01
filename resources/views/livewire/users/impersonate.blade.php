<x-modal title="{{ __('Impersonate User') }}" wire persistent center>
    <p>
        {{ __('Are you sure you want to impersonate') }} <b>{{ $name }}</b>?
    </p>

    <x-slot:footer>
        <x-button type="cancel" text="{{ __('Cancel') }}" color="secondary" sm wire:click="$set('modal', false)" />
        <x-button type="button" wire:click="handle" text="{!! __('Yes, I\'m sure') !!}" sm wire:loading.attr="disabled" />
    </x-slot>
</x-modal>
