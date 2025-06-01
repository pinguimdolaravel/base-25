@props([
    'toogle',
    'text',
    'icon' => 'slash',
    'routes' => [],
])

@php
    $anyActive = collect($routes)->contains(fn ($route) => request()->routeIs($route));
@endphp

<div x-data="dropdown" class="relative">
    <!-- Dropdown head -->
    <div @click="toggle('{{ $toogle }}')"
        x-data="tooltip"
        x-on:mouseover="show = true"
        x-on:mouseleave="show = false"
        class="relative flex justify-between items-center rounded-md p-2 cursor-pointer text-dark-950 dark:text-dark-50 hover:bg-dark-300 hover:dark:bg-dark-600 hover:text-dark-950 hover:dark:text-dark-50 {{ $anyActive ? 'text-dark-950 dark:text-dark-900 bg-primary-600 dark:bg-primary-500' : '' }}"
        x-bind:class="{'justify-start space-x-2': $store.sidebar.full, 'sm:justify-center':!$store.sidebar.full}">
        <div class="relative flex items-center" x-bind:class="{'space-x-2': $store.sidebar.full}">
            <x-icon name="{{ $icon }}" class="h-5 w-5" x-bind:class="{'w-6 h-6': !$store.sidebar.full}"/>
            
            <span x-cloak x-bind:class="!$store.sidebar.full && show ? visibleClass :'' || !$store.sidebar.full && !show ? 'sm:hidden':''">
                {{ __($text) }}
            </span>
        </div>

        <x-icon x-cloak name="chevron-right" class="h-3 w-3" x-bind:class="{'sm:hidden':!$store.sidebar.full, 'transform rotate-90':$store.sidebar.dropdownOpen, 'transform rotate-0':!$store.sidebar.dropdownOpen}" />
    </div>

    <!-- Dropdown content -->
    <div x-cloak 
        x-show="open"
        @click.outside="open = false"
        x-bind:class="$store.sidebar.full ? expandedClass : shrinkedClass"
        class="text-dark-800 dark:text-dark-400">
        
        {{ $slot }}
    </div>
</div>