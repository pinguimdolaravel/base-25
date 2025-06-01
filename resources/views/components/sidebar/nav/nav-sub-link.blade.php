@props([
    'route',
    'text',
])

@php
    $active = request()->routeIs($route);
@endphp

<a {{ $attributes }} class="flex text-dark-700 dark:text-dark-200 hover:text-dark-500 hover:dark:text-dark-50 cursor-pointer px-2 py-1 {{ $active ? 'text-dark-700 dark:text-dark-200 bg-dark-300 dark:bg-dark-700 rounded-md' : '' }}">
    {{ __($text) }}
</a>
