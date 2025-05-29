<div
    class="flex min-h-screen items-center justify-center bg-gradient-to-br from-gray-50 to-gray-100 dark:from-gray-900 dark:to-gray-800"
>
    <div class="w-full max-w-md px-4 py-8">
        <div class="mb-10 text-center">
            <x-application-logo class="mx-auto mb-4 h-16 w-16" />
            <h2 class="text-3xl font-extrabold text-gray-900 dark:text-white">Welcome back</h2>
            <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">Sign in to your account</p>
        </div>

        <x-card class="rounded-xl bg-white/90 shadow-xl backdrop-blur-xl dark:bg-gray-800/90">
            <form wire:submit="handle" class="space-y-6">
                <div class="space-y-5">
                    <x-input
                        label="Email address"
                        wire:model="email"
                        type="email"
                        icon="envelope"
                        class="block w-full dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300"
                        placeholder="your@email.com"
                        required
                    />

                    <x-input
                        label="Password"
                        wire:model="password"
                        type="password"
                        icon="key"
                        class="block w-full dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300"
                        placeholder="Enter your password"
                        required
                    />
                </div>

                <div class="flex items-center justify-between">
                    <x-checkbox label="Remember me" wire:model="remember" class="text-sm dark:text-gray-300" />

                    <x-link
                        href="{{ route('password.request') }}"
                        class="text-sm font-medium text-primary-600 hover:text-primary-500 dark:text-primary-400 dark:hover:text-primary-300"
                    >
                        Forgot your password?
                    </x-link>
                </div>

                <div>
                    <x-button
                        class="flex w-full justify-center py-3 font-medium"
                        label="Sign In"
                        icon="arrow-right-on-rectangle"
                        type="submit"
                        primary
                        spinner
                    />
                </div>
            </form>

            <x-slot:footer>
                <p class="text-center text-sm text-gray-600 dark:text-gray-400">
                    Not a member?
                    <x-link
                        href="{{ route('register') }}"
                        class="font-medium text-primary-600 hover:text-primary-500 dark:text-primary-400 dark:hover:text-primary-300"
                    >
                        Create your account
                    </x-link>
                </p>
            </x-slot>
        </x-card>
    </div>
</div>
