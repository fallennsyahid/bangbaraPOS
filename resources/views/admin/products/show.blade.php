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
                        <h1 class="text-2xl font-semibold text-zinc-950">Detail Product</h1>

                    </div>

                    {{-- Content --}}
                    <div class="min-h-full flex items-center justify-center bg-prime py-10">
                        <div class="bg-thead p-6 rounded-lg shadow-lg max-w-5xl w-full">
                            <div class="bg-tbody p-4 rounded-md flex flex-col md:flex-row gap-10 md:gap-x-20">
                                <div class="flex justify-center">
                                    <img src="{{ Storage::url($product->gambar_menu) }}" alt="Product Image"
                                        class="w-40 md:w-60 lg:w-80 object-cover rounded-lg" />
                                </div>
                                <div class="space-y-3 flex-1">
                                    <h1 class="text-xl md:text-2xl font-bold text-zinc-950 mb-4">Detail Products</h1>
                                    <!-- Field: Title -->
                                    <div class="flex flex-col md:flex-row gap-4">
                                        <div>
                                            <h2 class="text-lg font-semibold text-zinc-950">Products Name:</h2>
                                            <p class="text-zinc-950">{{ $product->nama_menu }}</p>
                                        </div>
                                        <!-- Field: Category -->
                                        <div>
                                            <h2 class="text-lg font-semibold text-zinc-950">Category:</h2>
                                            <p class="text-zinc-950">{{ $product->category->nama_kategori }}</p>
                                        </div>
                                    </div>

                                    <div class="flex flex-col md:flex-row gap-4 md:gap-[100px]">
                                        <!-- Field: Price -->
                                        <div>
                                            <h2 class="text-lg font-semibold text-zinc-950">Price:</h2>
                                            <p class="text-zinc-950">{{ number_format($product->harga_menu) }}</p>
                                        </div>
                                        <!-- Field: Date -->
                                        <div>
                                            <h2 class="text-lg font-semibold text-zinc-950">Created At:</h2>
                                            <p class="text-zinc-950">{{ $product->created_at->format('d/m/y') }}</p>
                                        </div>
                                    </div>
                                    <div>
                                        <h2 class="text-lg font-semibold text-zinc-950">Description:</h2>
                                        <p class="text-zinc-950">{{ $product->deskripsi_menu }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-6 flex flex-col md:flex-row justify-end space-y-4 md:space-y-0 md:space-x-4">
                                <a href="{{ route('products.index') }}"
                                    class="bg-red-700 text-white px-4 py-2 rounded-lg font-semibold shadow-md hover:bg-white hover:text-red-700 transition text-center">
                                    Back
                                </a>
                                <a href="{{ route('products.edit', $product->id) }}"
                                    class="bg-red-700 text-white px-4 py-2 rounded-lg font-semibold shadow-md hover:bg-white hover:text-red-700 transition text-center">
                                    Edit
                                </a>
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
