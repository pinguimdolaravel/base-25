<div>
    <x-table :headers="$this->headers" :rows="$this->rows" filter>
        @interact('column_action', $row)
            <x-button.circle color="gray" sm flat icon="pencil"
                wire:click="$dispatch('users::edit', {id : '{{ $row->id }}'})" />

            @if (Auth::id() != $row->id)
                <x-button.circle color="red" sm flat icon="trash"
                    wire:click="$dispatch('users::destroy', {id : '{{ $row->id }}'})" />
            @endif
        @endinteract
    </x-table>
</div>
