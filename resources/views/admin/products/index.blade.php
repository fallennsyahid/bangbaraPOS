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
                        <h1 class="text-2xl font-semibold text-zinc-950">Manage Products</h1>
                    </div>


                    <!-- Content -->
                    <div class="flex flex-col items-center justify-center min-h-full bg-prime px-4 py-4">
                        <!-- Tombol View on GitHub -->

                        <!-- Tabel -->
                        {{-- <div class="flex mx-auto space-x-10 justify-between w-full max-w-4xl mb-6"> --}}
                        <div class="flex justify-between items-center w-full max-w-6xl">
                            <!-- Filter Category di ujung kiri -->
                            <div>
                                <select id="categoryFilter"
                                    class="bg-[#D3CD6B] text-white rounded-lg px-4 py-2 shadow-lg focus:ring-2 focus:ring-amber-300 focus:outline-none transition duration-300 transform hover:shadow-2xl">
                                    <option value="">Filter by Category</option>
                                    <option value="">All</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->nama_kategori }}">
                                            {{ $category->nama_kategori }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Tombol Export & Create di ujung kanan -->
                            <div class="flex space-x-3">
                                <form action="{{ route('products.import') }}" method="POST"
                                    enctype="multipart/form-data" class="flex items-center">
                                    @csrf
                                    <label for="file_upload"
                                        class="cursor-pointer bg-green-600 text-white flex items-center py-2 px-4 rounded-md hover:bg-green-500 shadow-lg">
                                        <img src="{{ asset('asset-view/assets/svg/export.svg') }}" class="w-5 h-5 mr-2">
                                        Import
                                    </label>
                                    <input id="file_upload" type="file" name="file" class="hidden"
                                        accept=".xlsx, .xls" onchange="this.form.submit();">
                                </form>


                                <a href="{{ route('products.create') }}"
                                    class="px-4 py-2 flex items-center text-sm text-gray-900 font-semibold shadow-md rounded-md bg-gray-300 hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-500">
                                    Create +
                                </a>
                                <button id="bulkDeleteButton"
                                    class="bg-red-700 text-white px-4 py-2 rounded-lg hidden">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                        viewBox="0 0 24 24" class="inline-block">
                                        <path fill="red"
                                            d="M19 4h-3.5l-1-1h-5l-1 1H5v2h14M6 19a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V7H6z" />
                                    </svg>
                                    Delete
                                    Selected</button>
                            </div>
                        </div>


                        <div class="w-full max-w-6xl overflow-x-auto text-zinc-950">
                            <table class="table-auto border-collapse w-full text-left shadow-lg rounded-md"
                                id="myTable">
                                <!-- Header -->
                                <thead class="bg-thead shadow-md">
                                    <tr>
                                        <th class="px-6 py-3 text-sm font-bold uppercase tracking-wide text-zinc-950">
                                            <input type="checkbox" id="select-all" />
                                        </th>

                                        <th class="px-6 py-3 text-sm font-bold uppercase tracking-wide text-zinc-950">ID
                                        </th>
                                        <th class="px-6 py-3 text-sm font-bold uppercase tracking-wide text-zinc-950">
                                            Products</th>
                                        <th class="px-6 py-3 text-sm font-bold uppercase tracking-wide text-zinc-950">
                                            Picture</th>
                                        <th class="px-6 py-3 text-sm font-bold uppercase tracking-wide text-zinc-950">
                                            Category</th>
                                        <th class="px-6 py-3 text-sm font-bold uppercase tracking-wide text-zinc-950">
                                            Status</th>
                                        <th class="px-6 py-3 text-sm font-bold uppercase tracking-wide text-zinc-950">
                                            Price</th>
                                        <th class="px-6 py-3 text-sm font-bold uppercase tracking-wide text-zinc-950">
                                            Aksi</th>
                                    </tr>
                                </thead>

                                <!-- Body -->
                                <tbody class="bg-tbody" id="productTable">
                                    @foreach ($products as $index => $product)
                                        <tr class="hover:bg-thead" data-category="{{ $product->category_id }}">
                                            <td class="px-6 py-4 font-medium text-sm text-zinc-900">
                                                <input type="checkbox" class="select-item" value="{{ $product->id }}">
                                            </td>
                                            <td class="px-6 py-4 font-medium text-sm text-zinc-950">#{{ $index + 1 }}
                                            </td>
                                            <td class="px-6 py-4 font-medium text-sm text-zinc-950">
                                                {{ $product->nama_menu }}
                                            </td>
                                            <td class="px-6 py-4 font-medium text-sm text-zinc-950">
                                                <img src="{{ Storage::url($product->gambar_menu) }}"
                                                    class="w-20 h-20 object-cover rounded-md" alt="Gambar Product">
                                            </td>
                                            <td class="px-6 py-4 font-medium text-sm text-zinc-950">
                                                {{ $product->category->nama_kategori }}
                                            </td>
                                            <td class="px-6 py-4 font-medium text-sm text-zinc-950">
                                                <h4>
                                                    {{ $product->status_produk }}</h4>
                                            </td>
                                            <td class="px-6 py-4 font-medium text-sm text-zinc-950">
                                                Rp {{ number_format($product->harga_menu, 2) }}
                                            </td>
                                            <td class="px-6 py-4 flex gap-3 mt-4">

                                                <a href="{{ route('products.show', $product->id) }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="30"
                                                        height="30" viewBox="0 0 24 24">
                                                        <path fill="#6c80e4" fill-rule="evenodd"
                                                            d="M12 17.8c4.034 0 7.686-2.25 9.648-5.8C19.686 8.45 16.034 6.2 12 6.2S4.314 8.45 2.352 12c1.962 3.55 5.614 5.8 9.648 5.8M12 5c4.808 0 8.972 2.848 11 7c-2.028 4.152-6.192 7-11 7s-8.972-2.848-11-7c2.028-4.152 6.192-7 11-7m0 9.8a2.8 2.8 0 1 0 0-5.6a2.8 2.8 0 0 0 0 5.6m0 1.2a4 4 0 1 1 0-8a4 4 0 0 1 0 8" />
                                                    </svg>
                                                </a>

                                                <a href="{{ route('products.edit', $product->id) }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="30"
                                                        height="30" viewBox="0 0 24 24">
                                                        <g fill="none" stroke="#28A745" stroke-linecap="round"
                                                            stroke-linejoin="round" stroke-width="2">
                                                            <path
                                                                d="M7 7H6a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2-2v-1" />
                                                            <path
                                                                d="M20.385 6.585a2.1 2.1 0 0 0-2.97-2.97L9 12v3h3zM16 5l3 3" />
                                                        </g>
                                                    </svg>
                                                </a>

                                                <form id="delete-form-{{ $product->id }}"
                                                    action="{{ route('products.destroy', $product->id) }}"
                                                    method="POST"
                                                    onsubmit="return confirm('Are you sure you want to delete this category?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="30"
                                                        height="30" viewBox="0 0 24 24"
                                                        class="cursor-pointer hover:fill-red-700 transition duration-200"
                                                        onclick="confirmDelete({{ $product->id }})">
                                                        <path fill="red"
                                                            d="M19 4h-3.5l-1-1h-5l-1 1H5v2h14M6 19a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V7H6z" />
                                                    </svg>
                                                </form>

                                            </td>
                                        </tr>
                                    @endforeach
                                    <!-- Tambahkan baris lain sesuai kebutuhan -->
                                </tbody>
                            </table>


                            <x-admin.success-alert></x-admin.success-alert>
                        </div>
                    </div>

                </main>
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
    {{-- <script>
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
    </script> --}}


    {{-- DataTables --}}
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/2.1.8/js/dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            const table = $('#myTable').DataTable();

            $('#categoryFilter').on('change', function() {
                const selectedCategory = this.value;

                // Gunakan regex false dan smart false biar pas exact match
                table.column(4) // Pastikan angka ini sesuai dengan index kolom 'Category' di tabel kamu
                    .search(selectedCategory || '', false, false)
                    .draw();
            });
        });
    </script>


    {{-- BulkDelete script --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const selectedIds = new Set();
            const allIds = @json($products->pluck('id')); // Laravel mengirimkan seluruh ID
            const selectAll = document.getElementById('select-all');
            const bulkDeleteButton = document.getElementById('bulkDeleteButton');

            // Inisialisasi DataTable
            const table = new DataTable('#myTable', {
                ordering: false
            });

            // Function BulDeleteButton
            function updateBulkDeleteButton() {
                bulkDeleteButton.classList.toggle('hidden', selectedIds.size === 0);
            }

            // Saat draw (ganti halaman), sinkronisasi checkbox berdasarkan selectedIds
            table.on('draw', function() {
                document.querySelectorAll('.select-item').forEach(cb => {
                    cb.checked = selectedIds.has(cb.value);
                });

                const allVisibleChecked = Array.from(document.querySelectorAll('.select-item')).every(cb =>
                    cb.checked);
                selectAll.checked = allVisibleChecked;
            });

            // Checkbox individual
            document.querySelector('#myTable').addEventListener('change', function(e) {
                if (e.target.classList.contains('select-item')) {
                    const id = e.target.value;
                    if (e.target.checked) {
                        selectedIds.add(id);
                    } else {
                        selectedIds.delete(id);
                    }
                    updateBulkDeleteButton();
                    // Update selectAll state
                    const allVisibleChecked = Array.from(document.querySelectorAll('.select-item')).every(
                        cb => cb.checked);
                    selectAll.checked = allVisibleChecked;

                }
            });

            // Select All
            selectAll.addEventListener('change', function() {
                if (this.checked) {
                    allIds.forEach(id => selectedIds.add(String(id)));
                } else {
                    selectedIds.clear();
                }

                // Update visible checkboxes only
                document.querySelectorAll('.select-item').forEach(cb => {
                    cb.checked = selectAll.checked;
                });
                updateBulkDeleteButton();
            });

            // Bulk Delete
            bulkDeleteButton.addEventListener('click', function() {
                if (selectedIds.size === 0) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'No items selected',
                        text: 'Please select items to delete.',
                        customClass: {
                            confirmButton: 'confirm-button',
                        }
                    });
                    return;
                }

                Swal.fire({
                    title: 'Are you sure?',
                    text: 'This action cannot be undone!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete them!',
                    cancelButtonText: 'Cancel',
                    customClass: {
                        confirmButton: 'confirm-button',
                        cancelButton: 'cancel-button',
                    }
                }).then(result => {
                    if (result.isConfirmed) {
                        fetch('{{ route('products.bulkDelete') }}', {
                                method: 'DELETE',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
                                body: JSON.stringify({
                                    ids: Array.from(selectedIds)
                                })
                            })
                            .then(res => res.json())
                            .then(data => {
                                if (data.success) {
                                    location.reload();
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Failed!',
                                        text: 'Deletion failed, try again.'
                                    });
                                }
                            })
                            .catch(error => console.error(error));
                    }
                });
            });
        });
    </script>


</body>

</html>
