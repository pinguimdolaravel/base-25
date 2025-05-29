<div
    class="flex min-h-screen items-center justify-center bg-gradient-to-br from-gray-50 to-gray-100 dark:from-gray-900 dark:to-gray-800"
>
    <div class="w-full max-w-md px-4 py-8">
        <div class="mb-10 text-center">
            <x-application-logo class="mx-auto mb-4 h-16 w-16" />
            <h2 class="text-3xl font-extrabold text-gray-900 dark:text-white">2FA Code</h2>
            <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">Enter the 2FA code sent to your email address</p>
        </div>

        <x-card class="rounded-xl bg-white/90 shadow-xl backdrop-blur-xl dark:bg-gray-800/90">
            <form wire:submit="login" class="space-y-6">
                <div class="space-y-5">
                    <x-pin
                        wire:model="code"
                        length="6"
                        label="Insert the code"
                        hint="We sent a 6-digit code to your email."
                    />
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
                    Didn't receive the code?
                    <x-button
                        wire:click="resendCode"
                        type="button"
                        class="font-medium text-primary-600 hover:text-primary-500 dark:text-primary-400 dark:hover:text-primary-300"
                    >
                        Resend the code
                    </x-button>
                </p>
            </x-slot>
        </x-card>
    </div>
</div>
