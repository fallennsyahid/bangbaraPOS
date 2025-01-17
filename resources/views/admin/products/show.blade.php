<x-admin.header></x-admin.header>

<body>
    <div x-data="setup()" x-init="$refs.loading.classList.add('hidden');
    setColors(color);" :class="{ 'dark': isDark }">
        <div class="flex h-screen antialiased text-gray-950 bg-gray-100 dark:bg-dark dark:text-light">
            <!-- Loading screen -->
            <div x-ref="loading"
                class="fixed inset-0 z-50 flex items-center justify-center text-2xl font-semibold text-amber-300 bg-slate-950">
                Loading.....
            </div>

            <x-admin.sidebar></x-admin.sidebar>

            <div class="flex-1 h-full overflow-x-hidden overflow-y-auto">
                <x-admin.navbar></x-admin.navbar>

                <!-- Main content -->
                <main class="dark:bg-zinc-950">
                    <!-- Content header -->
                    <div class="flex items-center justify-between px-4 py-2 border-b lg:py-4 dark:border-slate-950">
                        <h1 class="text-2xl font-semibold">Manage Categories</h1>
                        <x-admin.waButton></x-admin.waButton>

                    </div>

                    {{-- Content --}}
                    <div class="min-h-screen flex items-center justify-center dark:bg-zinc-950 py-10">
                        <div class="bg-[#CAAC44] p-6 rounded-lg shadow-lg max-w-lg w-full">
                            <div class="bg-[#D4B131] p-4 rounded-md">
                                <h1 class="text-2xl font-bold text-white mb-4">Detail Products</h1>
                                <div class="space-y-3">
                                    <!-- Field: Title -->
                                    <div>
                                        <h2 class="text-lg font-semibold text-white">Products Name:</h2>
                                        <p class="text-white">{{ $product->nama_menu }}</p>
                                    </div>
                                    <!-- Field: Category -->
                                    <div>
                                        <h2 class="text-lg font-semibold text-white">Products Name:</h2>
                                        <p class="text-white">{{ $product->category->nama_kategori }}</p>
                                    </div>
                                    <!-- Field: Description -->
                                    <div>
                                        <h2 class="text-lg font-semibold text-white">Description:</h2>
                                        <p class="text-white">{{ $product->deskripsi_menu }}</p>
                                    </div>
                                    <!-- Field: Date -->
                                    <div>
                                        <h2 class="text-lg font-semibold text-white">Created At:</h2>
                                        <p class="text-white">{{ $product->created_at->format('d/m/y') }}</p>
                                    </div>
                                    <div>
                                        <h2 class="text-lg font-semibold text-white">Product Image:</h2>
                                        <img src="{{ Storage::url($product->gambar_menu) }}" alt="Product Image"
                                            class="w-48b h-48 object-cover rounded-lg" />
                                    </div>
                                </div>
                            </div>
                            <div class="mt-6 flex justify-end space-x-4">
                                <a href="{{ route('products.index') }}"
                                    class="bg-red-700 text-white px-4 py-2 rounded-lg font-semibold shadow-md hover:bg-white hover:text-red-700 transition">
                                    Back
                                </a>
                                <a href="{{ route('products.edit', $product->id) }}"
                                    class="bg-red-700 text-white px-4 py-2 rounded-lg font-semibold shadow-md hover:bg-white hover:text-red-700 transition">
                                    Edit
                                </a>
                            </div>
                        </div>
                    </div>

                </main>

                <!-- Main footer -->
                <footer
                    class="flex items-center justify-between p-4 bg-white dark:bg-zinc-900 dark:border-primary-darker">
                    <div>Bangbara &copy; 2025</div>
                    <div>
                        Made by
                        <a href="https://github.com/Kamona-WD" target="_blank"
                            class="text-blue-500 hover:underline">BangbaraPos</a>
                    </div>
                </footer>
            </div>

            <x-admin.panel-content></x-admin.panel-content>
        </div>
    </div>

    <!-- All javascript code in this project for now is just for demo DON'T RELY ON IT  -->
    <x-admin.js></x-admin.js>
</body>

</html>
