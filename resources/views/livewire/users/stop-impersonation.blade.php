<div>
    @if ($this->isImpersonating)
        <x-banner
            :color="[
                'background' => 'bg-primary-500',
                'text' => 'text-primary-900',
            ]"
        >
            <x-slot:text>
                {{ __('You are impersonating') }} {{ $this->user->name }}.
                <x-button outline text="{{ __('Stop Impersonation') }}" sm wire:click="handle" color="dark" />
            </x-slot>
        </x-banner>
    @endif
</div>
