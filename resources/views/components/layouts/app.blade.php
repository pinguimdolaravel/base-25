<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="tallstackui_darkTheme({ default: 'dark' })">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>{{ $title ?? 'Page Title' }}</title>
    <tallstackui:script />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body x-cloak>
    <livewire:users.stop-impersonation />
    <x-toast />

    <div class="min-h-screen bg-gray-50 dark:bg-gray-900">
        <!-- Sidebar -->
        <aside class="fixed inset-y-0 left-0 z-10 w-64 bg-white shadow-xl dark:bg-gray-800">
            <div class="flex h-full flex-col">
                <!-- Logo -->
                <div class="flex h-16 items-center justify-center bg-primary-700 px-4 dark:bg-primary-800">
                    <x-application-logo class="h-8 w-8" />
                    <span class="ml-2 text-xl font-bold text-white">{{ config('app.name') }}</span>
                </div>

                <!-- Navigation -->
                <nav class="flex-1 space-y-1 overflow-y-auto px-4 py-6">
                    <x-nav-link href="{{ route('dashboard') }}" icon="home"
                        active="{{ request()->routeIs('dashboard') }}">
                        Dashboard
                    </x-nav-link>
                    <x-nav-link href="{{ route('users.index') }}" icon="users"
                        active="{{ request()->routeIs('users.*') }}">
                        Users
                    </x-nav-link>
                    <x-nav-link href="#" icon="cog">Settings</x-nav-link>
                </nav>

                <!-- User Profile -->
                <div class="border-t border-gray-200 p-4 dark:border-gray-700">
                    <div class="flex items-center justify-between">
                        <div class="flex min-w-0 items-center">
                            <div class="flex-shrink-0">
                                <div
                                    class="flex h-10 w-10 items-center justify-center rounded-full bg-primary-100 dark:bg-primary-900">
                                    <span class="text-sm font-medium text-primary-700 dark:text-primary-300">
                                        {{ substr(auth()->user()->email, 0, 2) }}
                                    </span>
                                </div>
                            </div>
                            <div class="ml-3 min-w-0">
                                <p class="truncate text-sm font-medium text-gray-700 dark:text-gray-300">
                                    {{ auth()->user()->email }}
                                </p>
                            </div>
                        </div>
                        <form method="POST" action="{{ route('logout') }}" class="flex">
                            @csrf
                            <button type="submit"
                                class="flex items-center text-sm text-gray-500 hover:text-primary-700 dark:text-gray-400 dark:hover:text-primary-300">
                                <x-icon name="arrow-left-start-on-rectangle" class="mr-2 h-5 w-5" />
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="ml-64 p-6">
            {{ $slot }}
        </div>
    </div>
</body>

</html>
