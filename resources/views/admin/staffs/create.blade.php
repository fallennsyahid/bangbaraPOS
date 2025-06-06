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
                        <h1 class="text-2xl font-semibold text-zinc-950">Add Staff</h1>

                    </div>

                    <!-- Content -->
                    <div class="min-h-full mb-4 py-5 flex flex-col items-center justify-center bg-prime">
                        <h2 class="mb-4">
                            <a href="{{ route('staffs.index') }}" class="text-amber-400 hover:underline">Back </a>/
                            <a href="/admin/dashboard" class="hover:underline text-zinc-950">Home</a>
                        </h2>
                        <form action="{{ route('staffs.store') }}" method="POST" enctype="multipart/form-data"
                            class="w-full max-w-6xl bg-thead text-gray-900 p-6 rounded-lg shadow-lg">
                            @csrf
                            <h2 class="text-2xl font-bold text-center mb-6 text-zinc-950">Add
                                Staff</h2>

                            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                                <!-- Input Nama Staff -->
                                <div class="mb-4">
                                    <label for="name" class="block text-sm font-medium mb-2">Name</label>
                                    <input type="text" id="name" name="name"
                                        class="w-full px-4 py-2 text-gray-900 bg-yellow-50 border border-yellow-400 dark:border-yellow-500 rounded-md focus:ring-2 focus:ring-yellow-500 focus:outline-none"
                                        placeholder="Enter staff name" required />
                                </div>

                                <!-- Input Email -->
                                <div class="mb-4">
                                    <label for="price" class="block text-sm font-medium mb-2">Email</label>
                                    <input type="email" id="email" name="email" step="0.01"
                                        class="w-full px-4 py-2 text-gray-900 bg-yellow-50 border border-yellow-400 dark:border-yellow-500 rounded-md focus:ring-2 focus:ring-yellow-500 focus:outline-none"
                                        placeholder="Enter staff email" required />
                                </div>

                                <!-- Input no telp -->
                                <div class="mb-4">
                                    <label for="phone_number" class="block text-sm font-medium mb-2">Telephone</label>
                                    <input type="number" id="phone_number" name="phone_number" step="0.01"
                                        class="input-number w-full px-4 py-2 text-gray-900 bg-yellow-50 border border-yellow-400 dark:border-yellow-500 rounded-md focus:ring-2 focus:ring-yellow-500 focus:outline-none"
                                        placeholder="08xxxxx" required />
                                </div>

                                <!-- Dropdown Kategori -->
                                <div class="mb-4">
                                    <label for="usertype" class="block text-sm font-medium mb-2">Role</label>
                                    <select id="usertype" name="usertype"
                                        class="w-full px-4 py-2 text-gray-900 bg-yellow-50 border border-yellow-400 dark:border-yellow-500 rounded-md focus:ring-2 focus:ring-yellow-500 focus:outline-none"
                                        required>
                                        <option value="">Select a Role</option>
                                        <option value="staff">Staff</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Input address -->
                            <div class="mb-4">
                                <label for="address" class="block text-sm font-medium mb-2">Address</label>
                                <textarea id="address" name="address" rows="4"
                                    class="w-full px-4 py-2 text-gray-900 bg-yellow-50 border border-yellow-400 dark:border-yellow-500 rounded-md focus:ring-2 focus:ring-yellow-500 focus:outline-none"
                                    placeholder="Enter staff address" required></textarea>
                            </div>

                            <!-- Tombol Submit -->
                            <button type="submit"
                                class="w-full bg-yellow-500 mt-5 text-white font-bold py-2 px-4 rounded-md hover:bg-yellow-600 dark:hover:bg-yellow-400 focus:ring-2 focus:ring-yellow-500 focus:outline-none">
                                Submit
                            </button>
                        </form>
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
