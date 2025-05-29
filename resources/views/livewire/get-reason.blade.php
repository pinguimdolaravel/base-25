<div>
    @if ($modal)
        <div class="mx-auto max-w-md rounded-lg bg-gray-800 p-6 shadow-lg">
            <form wire:submit="handle" class="space-y-4">
                <p class="mb-4 text-lg text-gray-200">Joe, tá querendo mudar pq campeão?</p>
                <div class="space-y-4">
                    <x-input name="reason" label="Motivo" wire:model="reason" />
                    <x-button class="w-full">Save</x-button>
                </div>
            </form>
        </div>
    @endif
</div>
