<div>
    Dashboard

    <div class="grid grid-cols-3 gap-4">
        @for ($i = 0; $i < 12; $i++)
            <livewire:dashboard-card :num="$i" />
        @endfor

    </div>

</div>
