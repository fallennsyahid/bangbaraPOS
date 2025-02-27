<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ asset('asset-view/assets/png/logo_bangbara.png') }}" type="image/x-icon">

    <title>BangbaraPost - Auth</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-black text-white">
    <div class="flex justify-center items-center min-h-screen">
        <div class="bg-zinc-900 p-8 rounded-sm shadow-lg flex flex-row items-center space-x-8 max-w-4xl">
            <!-- Illustration -->
            <div>
                <img src="{{ asset('asset-admin/public/img/guest.png') }}" alt="Illustration" class="w-80 h-72">
            </div>

            <!-- Login Form -->
            <div class="w-full max-w-sm">
                <h1 class="text-3xl font-bold mb-6 text-center">Reset Password</h1>
                <form method="POST" action="{{ route('password.store') }}">
                    @csrf

                    <!-- Password Reset Token -->
                    <input type="hidden" name="token" value="{{ $request->route('token') }}">

                    <!-- Email -->
                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium">Email</label>
                        <input id="email" type="email" name="email" value="{{ old('email', $request->email) }}"
                            required autofocus autocomplete="username"
                            class="mt-1 block w-full rounded-md bg-gray-700 text-white border-gray-600 focus:border-purple-500 focus:ring-purple-500">
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div class="mb-4 relative">
                        <label for="password" class="block text-sm font-medium">Password</label>
                        <input id="password" type="password" name="password" required
                            class="mt-1 block w-full rounded-md bg-gray-700 text-white border-gray-600 focus:border-purple-500 focus:ring-purple-500">
                        <span class="absolute inset-y-0 right-0 pr-3 flex items-center cursor-pointer">
                            <svg class="h-5 w-5 text-gray-400" fill="none" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0zm-7.293-2.293a8 8 0 0110.586 0M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </span>
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Password Confirmation-->
                    <div class="mb-4 relative">
                        <label for="password_confirmation" class="block text-sm font-medium">Confirm Password</label>
                        <input id="password_confirmation" type="password" name="password_confirmation" required
                            class="mt-1 block w-full rounded-md bg-gray-700 text-white border-gray-600 focus:border-purple-500 focus:ring-purple-500">
                        <span class="absolute inset-y-0 right-0 pr-3 flex items-center cursor-pointer">
                            <svg class="h-5 w-5 text-gray-400" fill="none" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0zm-7.293-2.293a8 8 0 0110.586 0M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </span>
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>

                    <!-- Submit -->
                    <button type="submit"
                        class="w-full py-2 px-4 bg-red-700 text-white font-bold rounded-lg hover:bg-red-600 focus:ring-2 focus:ring-amber-300">
                        Reset Password
                    </button>

                    <!-- Forgot Password -->
                    <div class="mt-4 text-center">
                        <a href="{{ route('password.request') }}" class="text-sm text-amber-300 hover:underline">Forgot
                            your Password?</a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</body>

</html>
