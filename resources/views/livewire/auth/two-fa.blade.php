<div
    class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 dark:from-gray-900 dark:to-gray-800 flex items-center justify-center">
    <div class="w-full max-w-md px-4 py-8">
        <div class="text-center mb-10">
            <x-application-logo class="w-16 h-16 mx-auto mb-4" />
            <h2 class="text-3xl font-extrabold text-gray-900 dark:text-white">
                2FA Code
            </h2>
            <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                Enter the 2FA code sent to your email address
            </p>
        </div>

        <x-card class="backdrop-blur-xl bg-white/90 dark:bg-gray-800/90 shadow-xl rounded-xl">
            <form wire:submit="login" class="space-y-6">
                <div class="space-y-5">
                    <x-pin wire:model="code" length="6" label="Insert the code"
                        hint="We sent a 5-digit code to your email." />
                </div>

                <div>
                    <x-button class="w-full flex justify-center py-3 font-medium" label="Sign In"
                        icon="arrow-right-on-rectangle" type="submit" primary spinner />
                </div>
            </form>

            <x-slot:footer>
                <p class="text-center text-sm text-gray-600 dark:text-gray-400">
                    Didn't receive the code?
                    <x-button wire:click="resendCode" type="button"
                        class="font-medium text-primary-600 hover:text-primary-500 dark:text-primary-400 dark:hover:text-primary-300">
                        Resend the code
                    </x-button>
                </p>
            </x-slot:footer>
        </x-card>
    </div>
</div>
