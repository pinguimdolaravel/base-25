<div class="mt-auto px-4 py-4 border-t border-dark-200 dark:border-dark-700">
    <div class="flex flex-col items-center justify-between space-y-3">
        <div class="flex items-center min-w-0">
            <div class="h-10 w-10 rounded-full bg-primary-600 dark:bg-primary-500 flex items-center justify-center">
                <span class="text-primary-100 dark:text-primary-900 font-medium text-sm">
                    {{ Str::upper(substr(auth()->user()->email, 0, 2)) }}
                </span>
            </div>
            <div class="ml-3 min-w-0" x-bind:class="$store.sidebar.full ? '' :'sm:hidden'">
                <p class="text-sm font-medium text-dark-900 dark:text-dark-100 truncate">
                    {{ auth()->user()->name }}
                </p>
                <p class="text-xs text-dark-800 dark:text-dark-200 truncate">
                    {{ auth()->user()->email }}
                </p>
            </div>
        </div>

        <form method="POST" action="{{ route('logout') }}" class="flex mt-2">
            @csrf
            <button type="submit"
                class="text-dark-900 hover:text-primary-700 dark:text-dark-200 dark:hover:text-primary-500 flex items-center">
                <x-icon name="power" class="w-5 h-5" />
                <span class="ml-2" x-bind:class="$store.sidebar.full ? '' :'sm:hidden'">
                    {{ __('Logout') }} 
                </span>
            </button>
        </form>
    </div>
</div>