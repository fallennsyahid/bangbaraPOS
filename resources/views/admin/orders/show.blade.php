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
                        <h1 class="text-2xl font-semibold">Order Items</h1>
                        <x-admin.waButton></x-admin.waButton>
                    </div>


                    <!-- Content -->
                    <div class="flex flex-col items-center justify-center min-h-screen dark:bg-black px-4 py-4">
                        <!-- Tombol View on GitHub -->
                        <h2 class="mb-4"><a href="{{ route('orders.index') }}"
                                class="text-amber-400 hover:underline">Back </a>/
                            <a href="/admin/dashboard" class="hover:underline">Home</a>
                        </h2>
                        <!-- Tabel -->
                        <div class="w-full max-w-4xl">
                            {{-- <div class="mb-4 mt-3">
                                <a href="{{ route('products.export') }}"
                                    class="bg-green-700 text-white py-2 px-4 rounded-md hover:bg-green-600">
                                    Export Excel
                                </a>
                            </div> --}}
                            <table class="table-auto border-collapse w-full text-left shadow-lg rounded-md"
                                id="myTable">
                                <!-- Header -->
                                <thead class="bg-[#D4B131] text-white shadow-md">
                                    <tr>
                                        <th class="px-6 py-3 text-sm font-bold uppercase tracking-wide">ID</th>
                                        <th class="px-6 py-3 text-sm font-bold uppercase tracking-wide">Product</th>
                                        <th class="px-6 py-3 text-sm font-bold uppercase tracking-wide">Picture</th>
                                        <th class="px-6 py-3 text-sm font-bold uppercase tracking-wide">Category</th>
                                        <th class="px-6 py-3 text-sm font-bold uppercase tracking-wide">Price</th>
                                        <th class="px-6 py-3 text-sm font-bold uppercase tracking-wide">QTY</th>
                                        <th class="px-6 py-3 text-sm font-bold uppercase tracking-wide">Total</th>
                                        {{-- <th class="px-6 py-3 text-sm font-bold uppercase tracking-wide">
                                            Aksi</th> --}}
                                    </tr>
                                </thead>

                                <!-- Body -->
                                <tbody class="bg-[#CAAC44]" id="productTable">
                                    @if ($order->products)
                                        <tr class="hover:bg-yellow-300" data-category="{{ $order->id }}">
                                            <td class="px-6 py-4 font-medium text-sm">#{{ $order->id }}</td>
                                            <td class="px-6 py-4 font-medium text-sm">
                                                {{ $order->products->nama_menu }}
                                            </td>
                                            <td class="px-6 py-4 font-medium text-sm">
                                                <img src="{{ Storage::url($order->products->gambar_menu) }}"
                                                    class="w-20 h-20 object-cover rounded-md" alt="Gambar Product">
                                            </td>
                                            <td class="px-6 py-4 font-medium text-sm">
                                                {{ $order->products->category->nama_kategori }}
                                            </td>
                                            <td class="px-6 py-4 font-medium text-sm">
                                                Rp {{ number_format($order->products->harga_menu, 2) }}
                                            </td>
                                            <td class="px-6 py-4 font-medium text-sm">
                                                {{ $order->quantity }}
                                            </td>
                                            <td class="px-6 py-4 font-medium text-sm">
                                                Rp {{ number_format($order->total_price, 2) }}
                                            </td>
                                            {{-- <td class="px-6 py-4 flex gap-3 mt-4">
                                                <form id="delete-form-{{ $product->id }}"
                                                    action="{{ route('products.destroy', $product->id) }}"
                                                    method="POST"
                                                    onsubmit="return confirm('Are you sure you want to delete this category?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button"
                                                        class="bg-red-600 text-white text-sm px-4 py-2 rounded-md shadow-md hover:bg-red-700 focus:ring-2 focus:ring-red-500 focus:outline-none"
                                                        onclick="confirmDelete({{ $product->id }})">
                                                        Delete
                                                    </button>
                                                </form>

                                                <button
                                                    class="bg-yellow-800 text-white text-sm px-4 py-2 rounded-md shadow-md hover:bg-yellow-900 focus:ring-2 focus:ring-yellow-700 focus:outline-none">
                                                    <a href="{{ route('products.edit', $product->id) }}">
                                                        Update
                                                    </a>
                                                </button>
                                                <button
                                                    class="bg-green-500 text-white text-sm px-4 py-2 rounded-md shadow-md hover:bg-green-600 focus:ring-2 focus:ring-yellow-700 focus:outline-none">
                                                    <a href="{{ route('products.show', $product->id) }}">
                                                        Detail
                                                    </a>
                                                </button>
                                            </td> --}}
                                        </tr>
                                    @else
                                        <p>No Products Found for this order</p>
                                    @endif
                                    <!-- Tambahkan baris lain sesuai kebutuhan -->
                                </tbody>
                            </table>


                            <x-admin.success-alert></x-admin.success-alert>
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
    {{-- Confirm Alert --}}
    <script>
        function confirmDelete(productId) {
            Swal.fire({
                title: "Are you sure?",
                text: "You wont be able to revert this",
                showDenyButton: true,
                showConfirmButton: true,
                confirmButtonText: "Delete",
                icon: "warning",
                denyButtonText: `Don't delete`,
                customClass: {
                    confirmButton: 'confirm-button',
                    denyButton: 'cancel-button',
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    // Jika user mengonfirmasi penghapusan, submit form secara manual
                    document.getElementById("delete-form-" + productId).submit();
                }
            });
        }
    </script>
    <script>
        document.getElementById('categoryFilter').addEventListener('change', function() {
            const selectedCategory = this.value;
            const rows = document.querySelectorAll('#productTable tr');

            rows.forEach(row => {
                const categoryId = row.getAttribute('data-category');

                if (selectedCategory == '' || categoryId === selectedCategory) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none'
                }
            });
        });
    </script>
    {{-- DataTables --}}
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/2.1.8/js/dataTables.min.js"></script>
    <script>
        let table = new DataTable('#myTable');
    </script>

</body>

</html>
