<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'Laravel') }}</title>
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
        <!-- Styles / Scripts -->
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @else
            <style>
                /*! tailwindcss v4.0.7 | MIT License | https://tailwindcss.com */
                /* ...existing tailwind style... */
            </style>
        @endif
    </head>
    <body class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] flex flex-col items-center min-h-screen p-6 lg:p-8 overflow-y-auto">
        <header class="w-full lg:max-w-4xl max-w-[335px] text-sm mb-6 not-has-[nav]:hidden">
            @if (Route::has('login'))
                <nav class="flex items-center justify-end gap-4">
                    @auth
                        <a
                            href="{{ url('/dashboard') }}"
                            class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal"
                        >
                            Dashboard
                        </a>
                    @else
                        <a
                            href="{{ route('login') }}"
                            class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] text-[#1b1b18] border border-transparent hover:border-[#19140035] dark:hover:border-[#3E3E3A] rounded-sm text-sm leading-normal"
                        >
                            Log in
                        </a>
                        @if (Route::has('register'))
                            <a
                                href="{{ route('register') }}"
                                class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal">
                                Register
                            </a>
                        @endif
                    @endauth
                </nav>
            @endif
        </header>
        <div class="w-full max-w-[335px] lg:max-w-4xl bg-white dark:bg-[#18181b] dark:shadow-lg dark:rounded-xl p-6 lg:p-10 mx-auto">
            <h1 class="text-3xl lg:text-5xl font-bold mb-6 text-gray-900 dark:text-gray-100 text-center">
                Welcome to {{ config('app.name', 'Laravel') }}
            </h1>
            <p class="mb-6 text-gray-700 dark:text-gray-300 text-center">
                We provide learning through our YouTube channel. The purpose of this site is to help users track their investments.
            </p>
            <ul class="mb-6 space-y-3">
                <li class="flex items-start">
                    <span class="text-red-600 dark:text-red-400 mr-2 font-bold">✔</span>
                    <span class="text-gray-800 dark:text-gray-200">Send your investment to us and add your payment details on this platform.</span>
                </li>
                <li class="flex items-start">
                    <span class="text-red-600 dark:text-red-400 mr-2 font-bold">✔</span>
                    <span class="text-gray-800 dark:text-gray-200">After submitting payment details, your payment will be verified and approved within 24-48 hours.</span>
                </li>
                <li class="flex items-start">
                    <span class="text-red-600 dark:text-red-400 mr-2 font-bold">✔</span>
                    <span class="text-gray-800 dark:text-gray-200">Track your investment status and history easily.</span>
                </li>
                <li class="flex items-start">
                    <span class="text-red-600 dark:text-red-400 mr-2 font-bold">✔</span>
                    <span class="text-gray-800 dark:text-gray-200">Learn trading strategies and market updates from our YouTube channel.</span>
                </li>
            </ul>
            <div class="mt-6 text-center">
                <a href="https://www.youtube.com/@tradewithjayraj2110" target="_blank" class="underline text-blue-600 dark:text-blue-400 font-medium">Visit our YouTube channel</a>
            </div>
            <div class="mt-10">
                <h2 class="text-xl font-semibold mb-4 text-gray-900 dark:text-gray-100 text-center">How to use this platform?</h2>
                <ol class="list-decimal list-inside space-y-2 text-gray-700 dark:text-gray-300">
                    <li>Step 1: Register yourself</li>
                    <li>Step 2: Login</li>
                    <li>Step 3: Go to the <span class="font-semibold text-red-600 dark:text-red-400">Invest</span> tab and add your payment details</li>
                </ol>
            </div>
        </div>
        @if (Route::has('login'))
            <div class="h-14.5 hidden lg:block"></div>
        @endif
    </body>
</html>