<aside x-data class="min-h-screen flex antialiased z-50">
    <!-- Mobile Menu Toggle -->
    <button @click="$store.sidebar.navOpen = !$store.sidebar.navOpen"
            class="sm:hidden absolute top-5 right-5 focus:outline-none">
        <!-- Menu Icons -->
        <svg xmlns="http://www.w3.org/2000/svg"
            class="h-6 w-6"
            x-bind:class="$store.sidebar.navOpen ? 'hidden':''"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor">

            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
        </svg>

        <!-- Close Menu -->
        <svg x-cloak
            xmlns="http://www.w3.org/2000/svg"
            class="h-6 w-6"
            x-bind:class="$store.sidebar.navOpen ? '':'hidden'"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor">

            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
    </button>

    <div class="flex flex-col h-full fixed sm:relative bg-dark-200 dark:bg-dark-800" x-bind:class="{'w-64':$store.sidebar.full, 'w-64 sm:w-20':!$store.sidebar.full,'top-0 left-0':$store.sidebar.navOpen,'top-0 -left-64 sm:left-0':!$store.sidebar.navOpen}">
        <div class="flex flex-col transition-all duration-300 space-y-2">
            <x-sidebar.toogle />
            
            <x-sidebar.app-logo-name />

            <x-sidebar.nav />
        </div>

        @auth
            <x-sidebar.user-profile />
        @endauth
    </div>
</aside>

@assets
<script>
    document.addEventListener('alpine:init', () => {
        // Stores variable globally 
        Alpine.store('sidebar', {
            full: JSON.parse(localStorage.getItem('sidebar_full') ?? 'true'),
            dropdownOpen: '',
            navOpen: false,

            toggleSidebar() {
                this.full = !this.full;
                localStorage.setItem('sidebar_full', JSON.stringify(this.full));
            }
        });
        // Creating component Dropdown
        Alpine.data('dropdown', () => ({
            open: false,
            toggle(toogle) {
                this.open = !this.open;
                Alpine.store('sidebar').dropdownOpen = this.open ? toogle : '';
            },
            activeClass: 'dark:bg-dark-800 dark:text-dark-200',
            expandedClass: 'border-l border-dark-400 ml-4 pl-4',
            shrinkedClass: 'sm:absolute top-0 left-[65px] sm:shadow-md sm:rounded-md sm:p-2 ml-4 pl-4 sm:ml-0 w-40 sm:bg-dark-300 sm:dark:bg-dark-600 text-dark-700 dark:text-dark-100 border-l sm:border-none border-dark-400 dark:border-dark-500 '
        }));
        // Creating component Sub Dropdown
        Alpine.data('sub_dropdown', () => ({
            sub_open: false,
            sub_toggle() {
                this.sub_open = !this.sub_open;
            },
            sub_expandedClass: 'border-l border-dark-700 dark:border-dark-400 ml-4 pl-4',
            sub_shrinkedClass: 'sm:absolute top-0 left-[145px] sm:shadow-md sm:z-10 sm:bg-dark-500 sm:dark:bg-dark-700 sm:rounded-md sm:p-4 border-l sm:border-none border-dark-400 ml-4 pl-4 sm:ml-0 w-40'
        }));
        // Creating tooltip
        Alpine.data('tooltip', () => ({
            show: false,
            visibleClass:'block sm:absolute -top-7 left-5 sm:border sm:text-sm sm:px-2 sm:py-1 sm:rounded-md text-secondary-50 dark:text-secondary-50 border-primary-700 dark:border-primary-600 bg-primary-600 dark:bg-primary-500 '
        }))
    })
</script>
@endassets