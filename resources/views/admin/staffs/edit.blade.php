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
                    <div class="min-h-full flex items-center justify-center bg-gray-200 py-5">
                        <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-4xl">
                            <h2 class="text-2xl font-bold text-gray-800 mb-4">Profile</h2>

                            <div class="flex flex-col md:flex-row items-center gap-6">
                                <!-- Bagian Avatar -->
                                <div class="flex flex-col items-center w-full md:w-1/3">
                                    <img src="{{ asset('asset-admin/public/img/person.jpg') }}" alt="Profile Picture"
                                        class="w-32 h-32 rounded-full border border-gray-300 mb-4">
                                </div>

                                <!-- Container untuk kedua form -->
                                <div class="w-full flex flex-col">
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
                                                class="block text-sm font-medium mb-2 text-gray-700">Role</label>
                                            <select id="usertype" name="usertype"
                                                class="w-full px-4 py-2 text-gray-900 bg-yellow-50 border border-yellow-400 dark:border-yellow-500 rounded-md focus:ring-2 focus:ring-yellow-500 focus:outline-none"
                                                required>
                                                <option value="{{ old('usertype', $user->usertype) }}">Select a Role
                                                </option>
                                                <option value="staff">Staff</option>
                                                <option value="admin">Admin</option>
                                            </select>
                                        </div>

                                        <!-- Tombol Update Profile -->
                                        <button type="submit"
                                            class="w-full bg-red-700 text-white font-bold py-2 px-4 rounded-md hover:bg-red-600 focus:ring focus:ring-blue-500">
                                            Update Profile
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
