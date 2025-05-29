@props(['active' => false, 'icon' => null])

@php
    $classes =
        $active ?? false
            ? 'group flex items-center rounded-md bg-primary-50 px-3 py-2 text-sm font-medium text-primary-700 transition-colors'
            : 'group flex items-center rounded-md px-3 py-2 text-sm font-medium text-gray-600 transition-colors hover:bg-primary-50 hover:text-primary-700';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    @if ($icon)
        <x-icon
            name="{{ $icon }}"
            class="{{ $active ? 'text-primary-700' : 'text-gray-400 group-hover:text-primary-700' }} w-5 h-5 mr-3"
        />
    @endif

    <span>{{ $slot }}</span>
</a>
