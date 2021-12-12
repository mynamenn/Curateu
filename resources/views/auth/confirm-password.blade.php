<x-guest-layout>
    <x-auths.auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-68 h-14 fill-current text-gray-500" />
            </a>
        </x-slot>

        <div class="mb-4 text-sm text-gray-600">
            {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
        </div>

        <!-- Validation Errors -->
        <x-auths.auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('password.confirm') }}">
            @csrf

            <!-- Password -->
            <div>
                <x-label for="password" :value="__('Password')" />

                <x-forms.input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="current-password" />
            </div>

            <div class="flex justify-end mt-4">
                <x-buttons.button>
                    {{ __('Confirm') }}
                </x-buttons.button>
            </div>
        </form>
    </x-auths.auth-card>
</x-guest-layout>
