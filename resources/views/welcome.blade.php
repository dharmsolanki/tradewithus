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
<body x-data="{ open: false }" class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] flex flex-col items-center min-h-screen p-4 lg:p-8 overflow-y-auto">
    <header class="w-full max-w-full lg:max-w-4xl mb-6 flex flex-col sm:flex-row items-center justify-between gap-4">
        <!-- Hamburger for mobile -->
        <button @click="open = !open" class="sm:hidden flex items-center px-2 py-2 rounded focus:outline-none" aria-label="Open menu">
            <svg class="w-7 h-7 text-gray-700 dark:text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
        </button>
        <!-- Header links -->
        <div :class="{'hidden': !open, 'flex': open}" class="flex-col sm:flex-row flex items-center gap-2 sm:gap-4 w-full sm:w-auto sm:flex">
            <a href="https://www.youtube.com/@tradewithjayraj2110" target="_blank"
            class="inline-flex items-center gap-1 px-3 py-2 bg-red-600 text-white rounded-md font-semibold hover:bg-red-700 transition text-sm">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M23.498 6.186a2.994 2.994 0 0 0-2.112-2.112C19.413 3.5 12 3.5 12 3.5s-7.413 0-9.386.574A2.994 2.994 0 0 0 .502 6.186C0 8.159 0 12 0 12s0 3.841.502 5.814a2.994 2.994 0 0 0 2.112 2.112C4.587 20.5 12 20.5 12 20.5s7.413 0 9.386-.574a2.994 2.994 0 0 0 2.112-2.112C24 15.841 24 12 24 12s0-3.841-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                </svg>
                <span>YouTube</span>
            </a>
            <a href="https://instagram.com/tradewithjayraj" target="_blank"
            class="inline-flex items-center gap-1 px-3 py-2 bg-pink-600 text-white rounded-md font-semibold hover:bg-pink-700 transition text-sm">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M7.75 2h8.5A5.75 5.75 0 0 1 22 7.75v8.5A5.75 5.75 0 0 1 16.25 22h-8.5A5.75 5.75 0 0 1 2 16.25v-8.5A5.75 5.75 0 0 1 7.75 2zm0 1.5A4.25 4.25 0 0 0 3.5 7.75v8.5A4.25 4.25 0 0 0 7.75 20.5h8.5A4.25 4.25 0 0 0 20.5 16.25v-8.5A4.25 4.25 0 0 0 16.25 3.5h-8.5zm4.25 3.25a5.25 5.25 0 1 1 0 10.5 5.25 5.25 0 0 1 0-10.5zm0 1.5a3.75 3.75 0 1 0 0 7.5 3.75 3.75 0 0 0 0-7.5zm6.25.75a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                </svg>
                <span>Instagram</span>
            </a>
            @if (Route::has('login'))
                <nav class="flex items-center gap-2 sm:gap-4">
                    @auth
                        <a
                            href="{{ url('/dashboard') }}"
                            class="inline-flex items-center gap-1 px-3 py-2 bg-green-600 text-white rounded-md font-semibold hover:bg-green-700 transition text-sm"
                        >
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                                <path d="M10 2a6 6 0 0 0-6 6v2a6 6 0 0 0 12 0V8a6 6 0 0 0-6-6zm0 16a8 8 0 0 1-8-8V8a8 8 0 0 1 16 0v2a8 8 0 0 1-8 8z"/>
                            </svg>
                            <span>Dashboard</span>
                        </a>
                    @else
                        <a
                            href="{{ route('login') }}"
                            class="inline-flex items-center gap-1 px-3 py-2 bg-indigo-600 text-white rounded-md font-semibold hover:bg-indigo-700 transition text-sm"
                        >
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                                <path d="M10 10a4 4 0 1 0 0-8 4 4 0 0 0 0 8zm-7 8a7 7 0 0 1 14 0H3z"/>
                            </svg>
                            <span>Login (for existing users)</span>
                        </a>
                        @if (Route::has('register'))
                            <a
                                href="{{ route('register') }}"
                                class="inline-flex items-center gap-1 px-3 py-2 bg-yellow-500 text-white rounded-md font-semibold hover:bg-yellow-600 transition text-sm"
                            >
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                                    <path d="M8 9a3 3 0 1 1 6 0v1a3 3 0 1 1-6 0V9zm-2 1a5 5 0 1 1 10 0v1a5 5 0 1 1-10 0v-1z"/>
                                </svg>
                                <span>Register (for new users)</span>
                            </a>
                        @endif
                    @endauth
                </nav>
            @endif
        </div>
    </header>
   <!-- ...existing code above... -->
    <div class="w-full max-w-[335px] lg:max-w-4xl mx-auto">
    <h1 class="text-3xl lg:text-5xl font-bold mb-6 text-gray-900 dark:text-gray-100 text-center">
        Welcome to {{ config('app.name', 'Laravel') }}
    </h1>
    <p class="mb-6 text-gray-700 dark:text-gray-300 text-center">
        Invest with us and track your investment status easily. Connect with us on Instagram and follow the steps below to get started.<br>
        <span class="font-semibold text-blue-600 dark:text-blue-400">We will provide learning tutorials on our YouTube channel to help you understand trading and investments.</span>
    </p>
    <div class="mt-6 text-center">
        <a href="https://www.youtube.com/@tradewithjayraj2110" target="_blank" class="underline text-blue-600 dark:text-blue-400 font-medium">Visit our YouTube channel</a>
    </div>
    <div class="mt-10">
        <h2 class="text-xl font-semibold mb-4 text-gray-900 dark:text-gray-100 text-center">How to use this platform?</h2>
        <ol class="list-decimal list-inside space-y-2 text-gray-700 dark:text-gray-300">
            <li>Contact us on Instagram (<a href="https://instagram.com/tradewithjayraj" target="_blank" class="underline text-pink-600 dark:text-pink-400">@tradewithjayraj</a>).</li>
            <li>Register yourself on our platform.</li>
            <li>Login to your account.</li>
            <li>Go to the <span class="font-semibold text-green-600 dark:text-green-400">Dashboard</span> section and find our bank details.</li>
            <li>Make the payment to our account.</li>
            <li>Go to the <span class="font-semibold text-red-600 dark:text-red-400">Invest</span> tab and add your payment details after successful payment.</li>
            <li>Wait for 24-48 hours for payment verification and approval.</li>
        </ol>
    </div>
    <div class="mt-10 text-center">
        <h2 class="text-xl font-semibold mb-4 text-gray-900 dark:text-gray-100">Contact Us</h2>
        <p class="text-gray-700 dark:text-gray-300 mb-2">
            You can contact us directly on Instagram:
        </p>
        <a href="https://instagram.com/tradewithjayraj" target="_blank"
        class="inline-block px-4 py-2 bg-pink-600 text-white rounded-md font-semibold hover:bg-pink-700 transition">
            @tradewithjayraj
            </a>
        </div>
    </div>
    <!-- ...existing code below... -->
    @if (Route::has('login'))
        <div class="h-14.5 hidden lg:block"></div>
    @endif
</body>
</html>