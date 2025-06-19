<div>
    <x-table :headers="$this->headers" :rows="$this->rows" filter loading>
        @interact('column_action', $row)
            <x-button.circle color="dark" sm flat icon="eye" href="{{ route('users.show', $row->id) }}" />

            <x-button.circle
                color="dark"
                sm
                flat
                icon="pencil"
                wire:click="$dispatch('users::edit', {id : '{{ $row->id }}'})"
            />

            @if (Auth::id() != $row->id)
                <x-button.circle
                    color="red"
                    sm
                    flat
                    icon="trash"
                    wire:click="$dispatch('users::destroy', {id : '{{ $row->id }}'})"
                />
            @endif

            <x-button.circle
                color="blue"
                sm
                flat
                icon="shield-check"
                wire:click="$dispatch('users::impersonate', {id : '{{ $row->id }}'})"
            />
        @endinteract
    </x-table>
</div>
