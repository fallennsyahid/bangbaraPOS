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
                        <h1 class="text-2xl font-semibold text-zinc-950">Add Product</h1>

                    </div>

                    <!-- Content -->
                    <div class="min-h-full mb-4 py-5 flex flex-col items-center justify-center bg-prime px-4">
                        <h2 class="mb-4"><a href="{{ route('products.index') }}"
                                class="text-amber-400 hover:underline">Back </a>/
                            <a href="/admin/dashboard" class="hover:underline text-zinc-950">Home</a>
                        </h2>
                        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data"
                            class="w-full max-w-5xl bg-thead text-gray-900 p-6 rounded-lg shadow-lg">
                            @csrf
                            <h2 class="text-2xl font-bold text-center mb-6 text-zinc-950">Add
                                Product</h2>

                            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                                <!-- Input Nama Produk -->
                                <div class="mb-4">
                                    <label for="name" class="block text-sm font-medium mb-2">Product Name</label>
                                    <input type="text" id="nama_menu" name="nama_menu"
                                        class="w-full px-4 py-2 text-gray-900 bg-yellow-50 border border-yellow-400 dark:border-yellow-500 rounded-md focus:ring-2 focus:ring-yellow-500 focus:outline-none"
                                        placeholder="Enter product name" required />
                                </div>

                                <!-- Input Harga -->
                                <div class="mb-4">
                                    <label for="price" class="block text-sm font-medium mb-2">Price</label>
                                    <input type="number" id="harga_menu" name="harga_menu" step="0.01"
                                        class="input-number w-full px-4 py-2 text-gray-900 bg-yellow-50 border border-yellow-400 dark:border-yellow-500 rounded-md focus:ring-2 focus:ring-yellow-500 focus:outline-none"
                                        placeholder="Enter product price" required />
                                </div>

                                <!-- Input Deskripsi Produk -->
                                <div class="mb-4">
                                    <label for="description" class="block text-sm font-medium mb-2">Product
                                        Description</label>
                                    <textarea id="deskripsi_menu" name="deskripsi_menu" rows="4"
                                        class="w-full px-4 py-2 text-gray-900 bg-yellow-50 border border-yellow-400 dark:border-yellow-500 rounded-md focus:ring-2 focus:ring-yellow-500 focus:outline-none"
                                        placeholder="Enter product description"></textarea>
                                </div>

                                <!-- Input Gambar Produk (Opsional) -->
                                <div class="mb-4">
                                    <label for="image" class="block text-sm font-medium mb-2">Product Image</label>
                                    <input type="file" id="gambar_menu" name="gambar_menu"
                                        class="w-full px-4 py-2 text-gray-900 bg-yellow-50 border border-yellow-400 dark:border-yellow-500 rounded-md focus:ring-2 focus:ring-yellow-500 focus:outline-none" />
                                    <p class="text-red-700 text-xs p-2">The Image Must be 1181x1181</p>
                                </div>

                                <!-- Dropdown Kategori -->
                                <div class="mb-4">
                                    <label for="category_id" class="block text-sm font-medium mb-2">Category</label>
                                    <select id="category_id" name="category_id"
                                        class="w-full px-4 py-2 text-gray-900 bg-yellow-50 border border-yellow-400 dark:border-yellow-500 rounded-md focus:ring-2 focus:ring-yellow-500 focus:outline-none"
                                        required>
                                        <option value="">Select a Category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}" class="text-zinc-950">
                                                {{ $category->nama_kategori }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-4">
                                    <div class="mb-4">
                                        <label for="status_produk" class="block text-sm font-medium mb-2">Product
                                            Status</label>
                                        <select id="status_produk" name="status_produk"
                                            class="w-full px-4 py-2 text-gray-900 bg-yellow-50 border border-yellow-400 dark:border-yellow-500 rounded-md focus:ring-2 focus:ring-yellow-500 focus:outline-none">
                                            <option value="Active">Active</option>
                                            <option value="Non-active">Non-active</option>
                                        </select>
                                    </div>
                                </div>
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
<script>
    document.getElementById('gambar_menu').addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (!file) return;

        const img = new Image();
        img.src = URL.createObjectURL(file);

        img.onload = function() {
            if (img.width > 1181 || img.height > 1181) {
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "Ukuran gambar tidak boleh lebih dari 1181px x 1181px.",
                    showConfirmButton: true,
                    customClass: {
                        confirmButton: 'confirm-button',
                    },
                });
                event.target.value = ''; // Reset input
            }
            URL.revokeObjectURL(img.src); // Hapus URL setelah digunakan
        };
    });
</script>


</html>
