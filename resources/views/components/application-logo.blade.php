<svg
    xmlns="http://www.w3.org/2000/svg"
    {{ $attributes->merge(['class' => $class]) }}
    viewBox="0 0 120 120"
    fill="none"
>
    <!-- Main hexagon -->
    <path d="M60 10L105 35V85L60 110L15 85V35L60 10Z" class="fill-primary-600" fill-opacity="0.9" />

    <!-- Inner hexagon -->
    <path d="M60 30L90 45V75L60 90L30 75V45L60 30Z" class="fill-primary-700" fill-opacity="0.95" />

    <!-- Center circle -->
    <circle cx="60" cy="60" r="15" class="fill-white" />

    <!-- Connecting dots -->
    <circle cx="60" cy="25" r="4" class="fill-white" />
    <circle cx="95" cy="60" r="4" class="fill-white" />
    <circle cx="25" cy="60" r="4" class="fill-white" />
    <circle cx="60" cy="95" r="4" class="fill-white" />

    <!-- Connection lines -->
    <path d="M60 40L60 25M75 60L95 60M45 60L25 60M60 80L60 95" stroke="white" stroke-width="2" stroke-linecap="round" />

    <!-- Inner glow effect -->
    <circle cx="60" cy="60" r="8" class="fill-primary-400" fill-opacity="0.5" />
</svg>
