<div class="flex flex-col justify-center items-center">
    <div class="w-full max-w-md px-4 py-8">
        <div class="text-center mb-10">
            <x-application-logo class="w-16 h-16 mx-auto mb-4" />
            
            <h2 class="text-3xl font-extrabold text-dark-900 dark:text-dark-50">
                {{ __('Welcome back') }}
            </h2>
            <p class="mt-2 text-sm text-dark-700 dark:text-dark-200">
                {{ __('Sign in to your account') }}
            </p>
        </div>

        <x-card class="rounded-xl">
            <x-errors />
            
            <form wire:submit="handle" class="space-y-6">
                <x-input
                    label="{{ __('Email address') }}"
                    wire:model="email"
                    type="email"
                    icon="envelope"
                    class="block w-full"
                    placeholder="your@email.com"
                    invalidate 
                />

                <x-password
                    label="Password"
                    wire:model="password"
                    class="block w-full"
                    placeholder="{{ __('Enter your password') }}"
                    required
                />

                @if ($showMessage)
                    <x-alert text="{{ __('You will receive an email with a link to login.') }}" 
                        icon="exclamation-triangle" 
                        color="green" 
                        light />
                @endif

                <div class="flex items-center justify-between">
                    <x-checkbox label="{{ __('Remember me') }}" wire:model="remember" class="text-sm" />

                    <x-link
                        href="{{ route('password.request') }}"
                        class="text-sm font-medium text-primary-700 hover:text-primary-800 dark:text-primary-500 dark:hover:text-primary-400"
                    >
                        {{ __('Forgot your password?') }}
                    </x-link>
                </div>

                <div>
                    <x-button
                        class="flex w-full justify-center py-3 font-medium"
                        text="{{ __('Sign In') }}"
                        icon="arrow-right-on-rectangle"
                        type="submit"
                        primary
                        spinner
                    />
                </div>
            </form>

            <x-slot:footer>
                <p class="text-center text-sm text-dark-700 dark:text-dark-200">
                    {{ __('Not a member?') }}
                    <x-link
                        href="{{ route('register') }}"
                        class="font-medium text-primary-700 hover:text-primary-800 dark:text-primary-500 dark:hover:text-primary-400"
                    >
                        {{ __('Create your account') }}
                    </x-link>
                </p>
            </x-slot:footer>
        </x-card>
    </div>
</div>