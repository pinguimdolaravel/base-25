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
        {{ $slot }}
    </body>
</html>
