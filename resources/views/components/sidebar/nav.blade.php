<nav class="px-2" x-bind:class="{ 'px-4': !$store.sidebar.full }">
    <x-sidebar.nav.nav-link href="{{ route('dashboard') }}" route="dashboard" text="Dashboard" icon="home" />

    <x-sidebar.nav.nav-link href="{{ route('users.index') }}" route="users.*" text="Users" icon="users" />

    {{-- Multi Level --}}
    <x-sidebar.nav.nav-dropdown toogle="test" text="Multi Level" icon="check" :routes="['']">

        <x-sidebar.nav.nav-sub-link href="javascript:void(0)" route="home" text="Test" />

    </x-sidebar.nav.nav-dropdown>
</nav>
