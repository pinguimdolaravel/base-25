<div class="flex items-center justify-center py-2">
    <x-application-logo x-bind:class="$store.sidebar.full ? 'w-13s h-13' : 'w-12 h-12'" />

    <span class="text-dark-900 dark:text-dark-200 font-extrabold py-3"
        x-bind:class="$store.sidebar.full ? 'text-2xl px-2' : 'hidden'">   
        {{ config('app.name') }}
    </span>
</div>