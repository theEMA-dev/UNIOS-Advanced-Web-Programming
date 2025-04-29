<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="theme" :class="{ 'dark': theme === 'dark' || (theme === 'system' && window.matchMedia('(prefers-color-scheme: dark)').matches) }">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'Laravel') }}</title>
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased">
        <div class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">
            <div class="absolute right-4 top-4 flex items-center space-x-4">
                <!-- Theme Switcher -->
                <x-theme-switcher />
                <!-- Language Switcher -->
                <x-language-switcher />
            </div>

            @if (Route::has('login'))
                <div class="p-6 text-center">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
                            {{ __('messages.dashboard') }}
                        </a>
                    @else
                        <div class="space-y-4">
                            <h1 class="text-4xl font-bold text-gray-900 dark:text-white mb-4">
                                {{ config('app.name', 'Laravel') }}
                            </h1>
                            <div class="space-x-4">
                                <a href="{{ route('login') }}" class="px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                    {{ __('messages.login') }}
                                </a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-md font-semibold text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white hover:border-gray-400 dark:hover:border-gray-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                        {{ __('messages.register') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    @endauth
                </div>
            @endif
        </div>

        @stack('scripts')
    </body>
</html>
