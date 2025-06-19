<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="tallstackui_darkTheme({ default: 'dark' })">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>{{ $title ?? 'Brain Kit' }}</title>
    <tallstackui:script />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

    <body x-cloak class="flex min-h-screen justify-content-between bg-linear-to-br" 
        x-bind:class="{'dark from-dark-950 dark:to-dark-900 text-dark-50': darkTheme, 'from-dark-50 to-dark-200 text-dark-900': !darkTheme }"
    >
        <x-toast />

        <x-sidebar.sidebar />

        <!-- Main Content -->
        <div class="flex flex-col w-full">
            <livewire:users.stop-impersonation />

            <span class="absolute top-2 right-2">
                <x-theme-switch only-icons xl/>
            </span>

            <div class="m-8">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
