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
                        <a href="https://github.com/Kamona-WD/kwd-dashboard" target="_blank"
                            class="px-4 py-2 text-sm text-white rounded-md bg-amber-300 dark:bg-red-700 hover:bg-amber-400 hover:dark:bg-red-800 focus:outline-none focus:ring focus:ring-primary focus:ring-offset-1 focus:ring-offset-white dark:focus:ring-offset-dark">
                            View on github
                        </a>
                    </div>


                    <!-- Content -->
                    <div class="flex flex-col items-center justify-center min-h-screen dark:bg-black px-4">
                        <!-- Tombol View on GitHub -->
                        <div class="mb-6">
                            <a href="{{ route('categories.create') }}"
                                class="px-4 py-2 text-sm text-white rounded-md bg-amber-300 dark:bg-red-700 hover:bg-amber-400 hover:dark:bg-red-800 focus:outline-none focus:ring focus:ring-primary focus:ring-offset-1 focus:ring-offset-white dark:focus:ring-offset-dark">
                                Create Category
                            </a>
                        </div>

                        <!-- Tabel -->
                        <div class="w-full max-w-4xl overflow-x-auto">
                            <div class="mb-4 mt-3 py-2">
                                <a href="{{ route('categories.export') }}"
                                    class="bg-green-700 text-white py-2 px-4 rounded-md hover:bg-green-600">
                                    Export Excel
                                </a>
                            </div>
                            <table class="table-auto border-collapse w-full text-left shadow-lg" id="myTable">
                                <!-- Header -->
                                <thead class="bg-[#D4B131] text-white shadow-md">
                                    <tr>
                                        <th class="px-6 py-3 text-sm font-bold uppercase tracking-wide">ID</th>
                                        <th class="px-6 py-3 text-sm font-bold uppercase tracking-wide">Nama Kategori
                                        </th>
                                        <th class="px-6 py-3 text-sm font-bold uppercase tracking-wide">Total Products
                                        </th>
                                        <th class="px-6 py-3 text-sm font-bold uppercase tracking-wide">Aksi</th>
                                    </tr>
                                </thead>

                                <!-- Body -->
                                <tbody class="bg-[#CAAC44]">
                                    @foreach ($categories as $index => $category)
                                        <tr class="hover:bg-yellow-300">
                                            <td class="px-6 py-4 font-medium text-smb">#{{ $index + 1 }}</td>
                                            <td class="px-6 py-4 font-medium text-sm text-slate-700">
                                                {{ $category->nama_kategori }}
                                            </td>
                                            <td class="px-6 py-4 font-medium text-sm text-slate-700">
                                                {{ $category->products->count() }}
                                            </td>
                                            <td class="px-6 py-4 flex gap-3">
                                                <form id="delete-form-{{ $category->id }}"
                                                    action="{{ route('categories.destroy', $category->id) }}"
                                                    method="POST"
                                                    onsubmit="return confirm('Are you sure you want to delete this category?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button"
                                                        class="bg-red-600 text-white text-sm px-4 py-2 rounded-md shadow-md hover:bg-red-700 focus:ring-2 focus:ring-red-500 focus:outline-none"
                                                        onclick="confirmDelete({{ $category->id }})">
                                                        Delete
                                                    </button>
                                                </form>

                                                <button
                                                    class="bg-yellow-800 text-white text-sm px-4 py-2 rounded-md shadow-md hover:bg-yellow-900 focus:ring-2 focus:ring-yellow-700 focus:outline-none">
                                                    <a href="{{ route('categories.edit', $category->id) }}">
                                                        Update
                                                    </a>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                    <!-- Tambahkan baris lain sesuai kebutuhan -->
                                </tbody>
                            </table>
                            {{-- Confirm Alert --}}
                            <script>
                                function confirmDelete(categoryId) {
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
                                            document.getElementById("delete-form-" + categoryId).submit();
                                        }
                                    });
                                }
                            </script>

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
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/2.1.8/js/dataTables.min.js"></script>
    <script>
        let table = new DataTable('#myTable');
    </script>
</body>

</html>
