{{-- <x-guest-layout>
    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
                autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Email Password Reset Link') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ asset('asset-view/assets/png/logo_bangbara.png') }}" type="image/x-icon">

    <title>BangbaraPost - Forgot Password</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-black text-white">
    <div class="flex justify-center items-center min-h-screen">
        <div class="bg-zinc-900 p-8 rounded-sm shadow-lg flex flex-row items-center space-x-8 max-w-4xl relative">
            <!-- Arrow di kiri atas container -->
            <a href="{{ route('login') }}" class="absolute top-0 left-0 mt-4 ml-4">
                <img src="{{ asset('asset-view/assets/svg/arrow-left.svg') }}" alt="Arrow Left"
                    class="hover:scale-125 transition duration-300">
            </a>

            <!-- Illustration -->
            <div>
                <img src="{{ asset('asset-admin/public/img/guest.png') }}" alt="Illustration" class="w-80 h-90">
            </div>

            <!-- Login Form -->
            <div class="w-full max-w-sm">
                <h1 class="text-sm font-light mb-6">
                    Forgot your password? No problem. Just let us know your email address and we will email you a
                    password reset link that will allow you to choose a new one.
                </h1>
                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />
                <form method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <!-- Email -->
                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium">Email</label>
                        <input id="email" type="email" name="email" required
                            class="mt-1 p-2 block w-full rounded-md bg-gray-700 text-white border-gray-600 focus:border-purple-500 focus:ring-purple-500">
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Submit -->
                    <button type="submit"
                        class="w-full py-2 px-4 bg-red-700 text-white font-bold rounded-lg hover:bg-red-600 focus:ring-2 focus:ring-amber-300">
                        Email Password Reset Link
                    </button>
                </form>
            </div>
        </div>
    </div>

</body>

</html>
