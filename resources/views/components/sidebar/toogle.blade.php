<button @click="$store.sidebar.toggleSidebar()"
    class="hidden sm:block focus:outline-none absolute p-1 -right-3 top-10 bg-primary-600 dark:bg-primary-500 rounded-full shadow-md">
    <x-icon name="chevron-left" class="h-4 w-4 transform text-dark-950" x-bind:class="$store.sidebar.full ? '':'-rotate-180 '"/>
</button>