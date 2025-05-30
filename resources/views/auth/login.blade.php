@include('layouts.web-nav')

<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
    
    <!-- Validation Errors -->
    <form method="POST" action="{{ route('login') }}" style="bottom: 50px;">
        @csrf
        <!-- Form Label -->
        <h1 style="margin-bottom: 10px; color: white; font-size: x-large; text-align: center;">
            Login to LandSeek
        </h1>
        <!-- Email Address -->
        <div>
            <x-input-label for="email">
                <i class="fa fa-envelope" aria-hidden="true" style="margin-right: 5px;"></i>
                {{ __('Email') }}
            </x-input-label>
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password">
                <i class="fa fa-lock" aria-hidden="true" style="margin-right: 5px;"></i>
                {{ __('Password') }}
            </x-input-label>

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>

        <br>

        <div class="register-link" style="text-align: center">
            @if (Route::has('register'))
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('register') }}">
                    {{ __('Click here to create an account now') }}
                </a>
            @endif
        
    </form>
</x-guest-layout>

<footer style="padding: 50px;">
    <p style="color: white; bottom: 0;">&copy; 2025 LandSeek: A Digital Marketplace for Land Hunting. All Rights Reserved.</p>
</footer>