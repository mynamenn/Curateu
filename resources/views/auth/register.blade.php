@extends('layouts.app')

@section('content')

    <x-guest-layout>
        <x-auths.auth-card>
            <x-slot name="logo">
                <a href="/">
                    <x-application-logo class="w-68 h-14 fill-current text-gray-500" />
                </a>
            </x-slot>

            <!-- Validation Errors -->
            <x-auths.auth-validation-errors class="mb-4" :errors="$errors" />

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Name -->
                <div>
                    <x-label for="name" :value="__('Name')" />

                    <x-forms.input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required
                        autofocus />
                </div>

                <!-- Username -->
                <div class="mt-4">
                    <x-label for="username" :value="__('Username')" />

                    <x-forms.input id="username" class="block mt-1 w-full" type="text" name="username" :value="old('username')" required
                        autofocus />
                </div>

                <!-- Email Address -->
                <div class="mt-4">
                    <x-label for="email" :value="__('Email')" />

                    <x-forms.input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-label for="password" :value="__('Password')" />

                    <x-forms.input id="password" class="block mt-1 w-full" type="password" name="password" required
                        autocomplete="new-password" />
                </div>

                <!-- Confirm Password -->
                <div class="mt-4">
                    <x-label for="password_confirmation" :value="__('Confirm Password')" />

                    <x-forms.input id="password_confirmation" class="block mt-1 w-full" type="password"
                        name="password_confirmation" required />
                </div>

                <!-- Country -->
                <div class="mt-4">
                    <x-label for="country" :value="__('Country')" />

                    <x-forms.input id="country" class="block mt-1 w-full" type="text" name="country" :value="old('country')" required
                        autofocus />
                </div>

                <!-- Referral source -->
                <div class="mt-4">
                    <x-label for="referral_source" :value="__('Where did you hear about us?')" />

                    <x-forms.input id="referral_source" class="block mt-1 w-full" type="text" name="referral_source" :value="old('referral_source')" required
                        autofocus />
                </div>

                <div class="flex items-center justify-end mt-4">
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                        {{ __('Already registered?') }}
                    </a>

                    <x-buttons.button class="ml-4">
                        {{ __('Register') }}
                    </x-buttons.button>
                </div>
            </form>
        </x-auths.auth-card>
    </x-guest-layout>
@endsection
