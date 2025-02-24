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
                <main class="bg-prime">
                    <!-- Content header -->
                    <div class="flex items-center justify-between px-4 py-2 border-b lg:py-4">
                        <h1 class="text-2xl font-semibold text-zinc-950">Edit Product</h1>
                        <x-admin.waButton></x-admin.waButton>

                    </div>

                    <!-- Content -->
                    <div class="min-h-screen mb-4 py-5 flex flex-col items-center justify-center bg-prime px-4">
                        <h2 class="mb-4"><a href="{{ route('products.index') }}"
                                class="text-amber-400 hover:underline">Back </a>/
                            <a href="/admin/dashboard" class="hover:underline text-zinc-900">Home</a>
                        </h2>
                        <form action="{{ route('products.update', $product->id) }}" method="POST"
                            enctype="multipart/form-data"
                            class="w-full max-w-md bg-thead text-gray-900 p-6 rounded-lg shadow-lg">
                            @csrf
                            @method('PUT')
                            <h2 class="text-2xl font-bold text-center mb-6 text-zinc-900">
                                Edit
                                Product</h2>

                            <!-- Input Nama Produk -->
                            <div class="mb-4">
                                <label for="name" class="block text-sm font-medium mb-2">Product Name</label>
                                <input type="text" id="nama_menu" name="nama_menu"
                                    value="{{ old('nama_menu', $product->nama_menu) }}"
                                    class="w-full px-4 py-2 text-gray-900 bg-yellow-50 border border-yellow-400 dark:border-yellow-500 rounded-md focus:ring-2 focus:ring-yellow-500 focus:outline-none"
                                    placeholder="Enter product name" required />
                            </div>

                            <!-- Input Deskripsi Produk -->
                            <div class="mb-4">
                                <label for="description" class="block text-sm font-medium mb-2">Product
                                    Description</label>
                                <textarea id="deskripsi_menu" name="deskripsi_menu" rows="4"
                                    value="{{ old('deskripsi_menu', $product->deskripsi_menu) }}"
                                    class="w-full px-4 py-2 text-gray-900 bg-yellow-50 border border-yellow-400 dark:border-yellow-500 rounded-md focus:ring-2 focus:ring-yellow-500 focus:outline-none"
                                    placeholder="Enter product description">{{ old('deskripsi_menu', $product->deskripsi_menu) }}</textarea>
                            </div>

                            <!-- Input Harga -->
                            <div class="mb-4">
                                <label for="price" class="block text-sm font-medium mb-2">Price</label>
                                <input type="number" id="harga_menu" name="harga_menu" step="0.01"
                                    value="{{ old('harga_menu', $product->harga_menu) }}"
                                    class="w-full px-4 py-2 text-gray-900  bg-yellow-50 border border-yellow-400 dark:border-yellow-500 rounded-md focus:ring-2 focus:ring-yellow-500 focus:outline-none"
                                    placeholder="Enter product price" required />
                            </div>

                            <!-- Dropdown Kategori -->
                            <div class="mb-4">
                                <label for="category_id" class="block text-sm font-medium mb-2">Category</label>
                                <select id="category_id" name="category_id"
                                    class="w-full px-4 py-2 text-gray-900  bg-yellow-50 border border-yellow-400 dark:border-yellow-500 rounded-md focus:ring-2 focus:ring-yellow-500 focus:outline-none"
                                    required>
                                    <option value="">Select a Category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ old('category_id', $product->category_id ?? '') == $category->id ? 'selected' : '' }}>
                                            {{ $category->nama_kategori }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Input Gambar Produk (Opsional) -->
                            <div class="mb-4">
                                <label for="image" class="block text-sm font-medium mb-2">Product Image</label>

                                <!-- Pratinjau Gambar Lama -->
                                @if (!empty($product->gambar_menu))
                                    <div class="mb-2">
                                        <img src="{{ asset('storage/' . $product->gambar_menu) }}"
                                            alt="Current Product Image" class="w-32 h-32 object-cover rounded-md">
                                    </div>
                                @endif

                                <!-- Input File -->
                                <input type="file" id="gambar_menu" name="gambar_menu"
                                    class="w-full px-4 py-2 text-gray-900  bg-yellow-50 border border-yellow-400 dark:border-yellow-500 rounded-md focus:ring-2 focus:ring-yellow-500 focus:outline-none" />
                            </div>


                            <div class="mb-4">
                                <label for="status_produk" class="block text-sm font-medium mb-2">Product
                                    Status</label>
                                <select id="status_produk" name="status_produk"
                                    class="w-full px-4 py-2 text-gray-900  bg-yellow-50 border border-yellow-400 dark:border-yellow-500 rounded-md focus:ring-2 focus:ring-yellow-500 focus:outline-none">
                                    <option value="Active"
                                        {{ old('status_produk', $product->status_produk) === 'Active' ? 'selected' : '' }}>
                                        Active
                                    </option>
                                    <option value="Non-active"
                                        {{ old('status_produk', $product->status_produk) === 'Non-active' ? 'selected' : '' }}>
                                        Non-active
                                    </option>
                                </select>
                            </div>


                            <!-- Tombol Submit -->
                            <button type="submit"
                                class="w-full bg-yellow-500 mt-5 text-white font-bold py-2 px-4 rounded-md hover:bg-yellow-600 dark:hover:bg-yellow-400 focus:ring-2 focus:ring-yellow-500 focus:outline-none">
                                Submit
                            </button>
                        </form>
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
