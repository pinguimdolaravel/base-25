@props([
    'route',
    'text',
    'icon' => 'slash',
    'badgeValue' => null,
    'badgeColor' => 'bg-green-400',
])

@php
    $active = request()->routeIs($route);
@endphp

<a {{ $attributes }}
    x-data="tooltip"
    x-on:mouseover="show = true"
    x-on:mouseleave="show = false"
    class="relative flex justify-between items-center rounded-md p-2 cursor-pointer text-dark-950 dark:text-dark-50 hover:bg-dark-300 hover:dark:bg-dark-600 hover:text-dark-950 hover:dark:text-dark-50 {{ $active ? 'text-dark-950 dark:text-dark-900 bg-primary-600 dark:bg-primary-500' : '' }}"
    x-bind:class="{'justify-start space-x-2': $store.sidebar.full, 'sm:justify-center':!$store.sidebar.full}">

    <div class="flex items-center" x-bind:class="{'space-x-2': $store.sidebar.full}">
        <x-icon name="{{ $icon }}" class="h-5 w-5" x-bind:class="{'w-6 h-6': !$store.sidebar.full}"/>

        <span x-cloak x-bind:class="!$store.sidebar.full && show ? visibleClass :'' || !$store.sidebar.full && !show ? 'sm:hidden':''">
            {{ __($text) }}
        </span>
    </div>

    @if ($badgeValue !== null)
        <span x-cloak x-bind:class="$store.sidebar.full ? '' :'sm:hidden'" class="w-5 h-5 p-1 {{ $badgeColor }} rounded-sm text-sm leading-3 text-center text-dark-50 font-bold antialiased">
            {{ $badgeValue }}
        </span>
    @endif
</a>
