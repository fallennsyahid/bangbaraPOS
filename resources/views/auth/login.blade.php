<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ asset('assets/png/logo_bangbara.png') }}" type="image/x-icon">

    <title>BangbaraPost - Auth</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-black text-white">
    <div class="flex justify-center items-center min-h-screen px-4">
        <div
            class="bg-zinc-900 p-8 rounded-sm shadow-lg flex flex-row md:flex-row items-center space-y-6 md:space-y-0 md:space-x-8 max-w-4xl">
            <!-- Illustration -->
            <div class="hidden md:block">
                <img src="{{ asset('asset-admin/public/img/guest.png') }}" alt="Illustration" class="w-80 h-72">
            </div>

            <!-- Login Form -->
            <div class="w-full max-w-sm">
                <h1 class="text-3xl font-bold mb-6 text-center">Login</h1>
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <!-- Email -->
                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium">Email</label>
                        <input id="email" type="email" name="email" required
                            class="mt-1 p-2 block w-full rounded-md bg-gray-700 text-white border-gray-600 focus:outline-none focus:border-2 focus:border-red-700">
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div class="mb-4 relative">
                        <label for="password" class="block text-sm font-medium">Password</label>
                        <input id="password" type="password" name="password" required
                            class="p-2 mt-1 block w-full rounded-md bg-gray-700 text-white border-gray-600 focus:outline-none focus:border-2 focus:border-red-700">

                        <span id="show-password"
                            class="absolute inset-y-0 right-0 pr-3 mt-5 flex items-center cursor-pointer">
                            <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB4AAAAeCAYAAAA7MK6iAAAACXBIWXMAAAsTAAALEwEAmpwYAAABkklEQVR4nO2WvUoDQRSFPwsjoomk8wHEUpNgL9aKnVjYii/hT2FEIwgS8hBKgp1gY6ddYpGHWPNjKRKrRAZuYBj3zu5iRIs9cJs7557D3Duzs5AixT/AGlAGHoEOMJDoSO4UKE3ScBt4AUYxowls/cRwGXhIYOjGPbCU1HQX+AgR6wGHQAGYkygCR7Lm8t+BnTiGU8A5MAwRqQNZT61Za4TUGa0z0VZNa0rb6r5CRyPMfARUNY0rpaAXsVMXOaCvaF265APPITEztZERgVcgACqSs3Hs0dsfk1aBTw/RrNuohHBMzkbRozcAVgypFXEt3DYHIRyTs5GN0GwZUvsXjHMRmm1D2lCuzzgKMVp9kaDVQ2B9TKx6iObjYCMj5oHncJ149K5dsecJXacF4E3RegKm3YK8Z96NBB+QO89c81rhorwumnkuYqeaaVO0vZgFbhWBvnwczLs7L1GSmWrtvRHNWDAt21OuTtwIRCPOiL4hKy+LthutK+WEB1LFDLApr5c5/V3r16cruZpwDDdFCv4MXw/YJO5+W1zLAAAAAElFTkSuQmCC"
                                alt="visible--v1" class="h-5 w-5 text-gray-400">
                        </span>
                    </div>

                    <!-- Remember Me -->
                    <div class="flex items-center mb-4">
                        <input id="remember_me" type="checkbox" name="remember"
                            class="rounded accent-red-500 text-purple-500 focus:ring-purple-400">
                        <label for="remember_me" class="ml-2 text-sm">Remember Me</label>
                    </div>

                    <!-- Submit -->
                    <button type="submit"
                        class="w-full py-2 px-4 bg-red-700 text-white font-bold rounded-lg transition-all duration-200 hover:bg-red-600 hover:scale-110 focus:ring-2 focus:ring-amber-300 active:bg-red-700 active:scale-100">
                        Login
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

<script>
    const password = document.querySelector('#password');
    const showPassword = document.querySelector('#show-password');

    showPassword.addEventListener('click', () => {
        if (password.type === 'password') {
            password.type = 'text';
        } else {
            password.type = 'password';
        }
    });
</script>

</html>
