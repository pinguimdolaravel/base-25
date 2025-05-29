<div>
    @if ($this->isImpersonating)
        <x-banner
            :color="[
                'background' => 'bg-[#fde68a]',
                'text' => 'text-[#1f2937]',
            ]"
        >
            <x-slot:text>
                You are impersonating {{ $this->user->name }}.
                <x-button outline text="Stop Impersonation" sm wire:click="handle" color="secondary" />
            </x-slot>
        </x-banner>
    @endif
</div>
