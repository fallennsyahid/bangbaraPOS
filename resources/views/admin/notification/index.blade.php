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
                        <h1 class="text-2xl font-semibold text-zinc-950">Manage Products</h1>
                        <x-admin.waButton></x-admin.waButton>
                    </div>


                    <!-- Content -->
                    <div class="grid grid-cols-2 items-center justify-center min-h-screen bg-prime px-4 py-4">
                        <!-- Tombol View on GitHub -->

                        <!-- Tabel -->
                        {{-- <div class="flex mx-auto space-x-10 justify-between w-full max-w-4xl mb-6"> --}}
                        @foreach ($orders as $order)
                            <div
                                class="mx-2 my-10 rounded-xl border bg-white px-4 shadow-md sm:mx-auto sm:max-w-xl sm:px-8">
                                <div
                                    class="mb-2 flex flex-col gap-y-6 border-b py-8 sm:flex-row sm:items-center sm:justify-between">
                                    <div class="flex items-center">
                                        <img class="h-14 w-14 rounded-full object-cover"
                                            src="/images/y9s3xOJV6rnQPKIrdPYJy.png" alt="Simon Lewis" />
                                        <div class="ml-4 w-56">
                                            <p class="text-slate-800 text-xl font-extrabold">{{ $order->customer_name }}
                                            </p>
                                            <p class="text-slate-500">{{ $order->status }}</p>
                                        </div>
                                    </div>
                                    <button
                                        class="flex items-center justify-center gap-1 rounded-lg border border-emerald-500 px-4 py-2 font-medium text-emerald-500 focus:outline-none focus:ring hover:bg-emerald-100">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                            class="h-4 w-4">
                                            <path
                                                d="M11.645 20.91l-.007-.003-.022-.012a15.247 15.247 0 01-.383-.218 25.18 25.18 0 01-4.244-3.17C4.688 15.36 2.25 12.174 2.25 8.25 2.25 5.322 4.714 3 7.688 3A5.5 5.5 0 0112 5.052 5.5 5.5 0 0116.313 3c2.973 0 5.437 2.322 5.437 5.25 0 3.925-2.438 7.111-4.739 9.256a25.175 25.175 0 01-4.244 3.17 15.247 15.247 0 01-.383.219l-.022.012-.007.004-.003.001a.752.752 0 01-.704 0l-.003-.001z" />
                                        </svg>

                                        <span>Sponsor</span>
                                    </button>
                                </div>
                                <div class="mb-2 flex justify-between border-b py-8 text-sm sm:text-base">
                                    <div class="flex flex-col items-center">
                                        <p class="text-slate-700 mb-1 text-xl font-extrabold">
                                            {{ $order->payment_method }}</p>
                                        <p class="text-slate-500 text-sm font-medium">Method</p>
                                    </div>
                                    <div class="flex flex-col items-center">
                                        <p class="text-slate-700 mb-1 text-xl font-extrabold">{{ $order->products }}</p>
                                        <p class="text-slate-500 text-sm font-medium">Menu</p>
                                    </div>
                                    <div class="flex flex-col items-center">
                                        <p class="text-slate-700 mb-1 text-xl font-extrabold">25</p>
                                        <p class="text-slate-500 text-sm font-medium">Sponsors</p>
                                    </div>
                                    <div class="flex flex-col items-center">
                                        <p class="text-slate-700 mb-1 text-xl font-extrabold">3</p>
                                        <p class="text-slate-500 text-sm font-medium">Awards</p>
                                    </div>
                                </div>
                                <div class="flex justify-between py-8">
                                    <button
                                        class="text-slate-500 hover:bg-slate-100 rounded-lg border-2 px-4 py-2 font-medium focus:outline-none focus:ring">Message</button>
                                    <button
                                        class="rounded-lg border-2 border-transparent bg-blue-600 px-4 py-2 font-medium text-white focus:outline-none focus:ring hover:bg-blue-700">Follow</button>
                                </div>
                            </div>
                        @endforeach

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
        $(document).ready(function() {
            let table = $('#myTable').DataTable({
                "columnDefs": [{
                    "targets": 0, // Kolom pertama (nomor urut)
                    "render": function(data, type, row, meta) {
                        return meta.row + 1; // Menampilkan nomor urut otomatis
                    }
                }],
                "ordering": false // Nonaktifkan sorting di semua kolom (opsional)
            });
        });
    </script>


</body>

</html>
