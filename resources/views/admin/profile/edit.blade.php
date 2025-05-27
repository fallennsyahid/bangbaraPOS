<x-admin.header></x-admin.header>

<body>
    <div x-data="setup()" x-init="$refs.loading.classList.add('hidden');
    setColors(color);" :class="{ 'dark': isDark }">
        <div class="flex h-screen antialiased text-gray-950 bg-prime dark:text-light">
            <!-- Loading screen -->
            <div x-ref="loading"
                class="fixed inset-0 z-50 flex items-center justify-center text-2xl font-semibold text-amber-300 bg-slate-950">
                Loading.....
            </div>

            <x-admin.sidebar></x-admin.sidebar>

            <div class="flex-1 h-full overflow-x-hidden overflow-y-auto">
                <x-admin.navbar></x-admin.navbar>

                <!-- Main content -->
                <main class="bg-prime">
                    <!-- Content header -->
                    <div class="flex items-center justify-between px-4 py-2 border-b lg:py-4">
                        <h1 class="text-2xl font-semibold text-zinc-950">Edit Profile</h1>

                    </div>

                    <!-- Content -->
                    <div class="min-h-full flex flex-col items-center justify-center bg-prime py-5">
                        <h2 class="mb-4 text-center">
                            <a href="javascript:history.back()" class="text-amber-400 hover:underline">Back </a>/
                            <a href="/admin/dashboard" class="hover:underline text-zinc-950">Home</a>
                        </h2>
                        <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-6xl">
                            <h2 class="text-2xl font-bold text-gray-800 mb-4">Profile</h2>

                            <div class="flex flex-col md:flex-row items-center md:items-start gap-6">
                                <!-- Bagian Avatar -->
                                <div class="flex flex-col items-center w-full md:w-1/3">
                                    <img src="{{ Avatar::create(Auth::user()->name)->toBase64() }}"
                                        alt="Profile Picture"
                                        class="w-80 rounded-full object-contain border-gray-300 mb-4">
                                </div>

                                <!-- Container untuk kedua form -->
                                <div class="w-full md:w-2/3 flex flex-col md:flex-row gap-6">
                                    <!-- Form Update Profile -->
                                    <form action="{{ route('staffs.update', $user->id) }}" method="POST"
                                        enctype="multipart/form-data" class="w-full md:w-1/2">
                                        @csrf
                                        @method('PUT')

                                        <!-- Input Username -->
                                        <div class="mb-4">
                                            <label for="name"
                                                class="block text-sm font-medium text-gray-700">Username</label>
                                            <input type="text" id="name" name="name"
                                                value="{{ old('name', $user->name) }}"
                                                class="w-full px-4 py-2 text-gray-900 bg-gray-100 border border-gray-400 rounded-md focus:ring focus:ring-yellow-500"
                                                required />
                                        </div>

                                        <!-- Input Email -->
                                        <div class="mb-4">
                                            <label for="email" class="block text-sm font-medium text-gray-700">Email
                                                Address</label>
                                            <input type="email" id="email" name="email"
                                                value="{{ old('email', $user->email) }}"
                                                class="w-full px-4 py-2 text-gray-900 bg-gray-100 border border-gray-400 rounded-md focus:ring focus:ring-yellow-500"
                                                required />
                                        </div>

                                        <!-- Input Usertype -->
                                        <div class="mb-4">
                                            <label for="usertype"
                                                class="block text-sm font-medium text-gray-700">Usertype</label>
                                            <input type="text" name="usertype" id="usertype"
                                                value="{{ old('usertype', $user->usertype) }}"
                                                class="w-full px-4 py-2 text-gray-900 bg-gray-100 border border-gray-400 rounded-md"
                                                readonly>
                                        </div>

                                        <!-- Input Phone Number -->
                                        <div class="mb-4">
                                            <label for="phone_number"
                                                class="block text-sm font-medium text-gray-700">Phone Number</label>
                                            <input type="text" name="phone_number" id="phone_number"
                                                value="{{ old('phone_number', $user->phone_number) }}"
                                                class="w-full px-4 py-2 text-gray-900 bg-gray-100 border border-gray-400 rounded-md focus:ring focus:ring-yellow-500">
                                        </div>

                                        <!-- Input Address -->
                                        <div class="mb-4">
                                            <label for="address"
                                                class="block text-sm font-medium text-gray-700">Address</label>
                                            <input type="text" name="address" id="address"
                                                value="{{ old('address', $user->address) }}"
                                                class="w-full px-4 py-2 text-gray-900 bg-gray-100 border border-gray-400 rounded-md focus:ring focus:ring-yellow-500">
                                        </div>

                                        <!-- Tombol Update Profile -->
                                        <button type="submit"
                                            class="w-full bg-yellow-400 text-white font-bold py-2 px-4 rounded-md hover:bg-blue-700 focus:ring focus:ring-blue-500">
                                            Update Profile
                                        </button>
                                    </form>

                                    <!-- Form Update Password -->
                                    <form method="post" action="{{ route('password.update') }}"
                                        class="w-full md:w-1/2">
                                        @csrf
                                        @method('PUT')

                                        <!-- Input Password Lama -->
                                        <div class="mb-4">
                                            <label for="current_password"
                                                class="block text-sm font-medium text-gray-700">Old Password</label>
                                            <input type="password" id="update_password_current_password"
                                                name="current_password"
                                                class="w-full px-4 py-2 text-gray-900 bg-gray-100 border border-gray-400 rounded-md focus:ring focus:ring-yellow-500"
                                                required />
                                            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
                                        </div>

                                        <!-- Input Password Baru -->
                                        <div class="mb-4">
                                            <label for="password" class="block text-sm font-medium text-gray-700">New
                                                Password</label>
                                            <input type="password" id="update_password_password" name="password"
                                                class="w-full px-4 py-2 text-gray-900 bg-gray-100 border border-gray-400 rounded-md focus:ring focus:ring-yellow-500"
                                                required />
                                            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
                                        </div>

                                        <!-- Input Konfirmasi Password -->
                                        <div class="mb-4">
                                            <label for="password_confirmation"
                                                class="block text-sm font-medium text-gray-700">Confirm Password</label>
                                            <input type="password" id="update_password_password_confirmation"
                                                name="password_confirmation"
                                                class="w-full px-4 py-2 text-gray-900 bg-gray-100 border border-gray-400 rounded-md focus:ring focus:ring-yellow-500"
                                                required />
                                            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
                                        </div>

                                        <!-- Tombol Update Password -->
                                        <button type="submit"
                                            class="w-full bg-red-600 text-white font-bold py-2 px-4 rounded-md hover:bg-red-700 focus:ring focus:ring-red-500">
                                            Update Password
                                        </button>
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>

                </main>
            </div>

            <x-admin.panel-content></x-admin.panel-content>
        </div>
    </div>

    <!-- All javascript code in this project for now is just for demo DON'T RELY ON IT  -->
    <x-admin.js></x-admin.js>
</body>

</html>
