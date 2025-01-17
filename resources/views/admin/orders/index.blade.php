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
                        <h1 class="text-2xl font-semibold">Manage Orders</h1>
                        <x-admin.waButton></x-admin.waButton>
                    </div>


                    <!-- Content -->
                    <div class="flex flex-col items-center justify-center min-h-screen dark:bg-black px-4 py-4">
                        <!-- Tombol View on GitHub -->
                        <!-- Tabel -->
                        <div class="mb-4 mt-3">
                            <a href="{{ route('orders.export') }}"
                                class="bg-green-700 text-white py-2 px-4 rounded-md hover:bg-green-600">
                                Export Excel
                            </a>
                        </div>
                        <div class="w-full max-w-4xl overflow-x-auto">
                            <div class="flex mx-auto justify-between">
                            </div>
                            <table class="table-auto border-collapse w-full text-left shadow-lg rounded-md"
                                id="myTable">
                                <!-- Header -->
                                <thead class="bg-[#D4B131] text-white shadow-md">
                                    <tr>
                                        <th class="px-6 py-3 text-sm font-bold uppercase tracking-wide">ID</th>
                                        <th class="px-6 py-3 text-sm font-bold uppercase tracking-wide">Costumer</th>
                                        <th class="px-6 py-3 text-sm font-bold uppercase tracking-wide">Phone</th>
                                        <th class="px-6 py-3 text-sm font-bold uppercase tracking-wide">Status</th>
                                        <th class="px-6 py-3 text-sm font-bold uppercase tracking-wide">Price</th>
                                        <th class="px-6 py-3 text-sm font-bold uppercase tracking-wide">Method</th>
                                        <th class="px-6 py-3 text-sm font-bold uppercase tracking-wide">Photo</th>
                                        <th class="px-6 py-3 text-sm font-bold uppercase tracking-wide">
                                            Aksi</th>
                                    </tr>
                                </thead>

                                <!-- Body -->
                                <tbody class="bg-[#CAAC44]" id="productTable">
                                    @foreach ($orders as $index => $order)
                                        <tr class="hover:bg-yellow-300" data-category="{{ $order->id }}">
                                            <td class="px-6 py-4 font-medium text-sm">#{{ $index + 1 }}</td>
                                            <td class="px-6 py-4 font-medium text-sm">
                                                {{ $order->customer_name }}
                                            </td>
                                            <td class="px-6 py-4 font-medium text-sm">
                                                {{ $order->customer_phone }}
                                            </td>
                                            <td class="px-6 py-4 font-medium text-sm"
                                                id="order-status-{{ $order->id }}">
                                                {{ $order->status }}
                                            </td>
                                            <td class="px-6 py-4 font-medium text-sm">
                                                Rp {{ number_format($order->total_price, 2) }}
                                            </td>
                                            <td class="px-6 py-4 font-medium text-sm">
                                                {{ $order->payment_method }}
                                            </td>
                                            <td class="px-6 py-4 font-medium text-sm">
                                                {{ $order->payment_photo }}
                                            </td>
                                            <td class="px-6 py-4 flex gap-3 mt-4">
                                                <button onclick="openModal({{ $order->id }})"
                                                    class="bg-yellow-800 text-white text-sm px-4 py-2 rounded-md shadow-md hover:bg-yellow-900 focus:ring-2 focus:ring-yellow-700 focus:outline-none">
                                                    Update
                                                </button>
                                                <button
                                                    class="bg-green-500 text-white text-sm px-4 py-2 rounded-md shadow-md hover:bg-green-600 focus:ring-2 focus:ring-yellow-700 focus:outline-none">
                                                    <a href="{{ route('orders.show', $order->id) }}">
                                                        Detail
                                                    </a>
                                                </button>
                                                <form id="delete-form-{{ $order->id }}"
                                                    action="{{ route('orders.destroy', $order->id) }}" method="POST"
                                                    onsubmit="return confirm('Are you sure you want to delete this category?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button"
                                                        class="bg-red-600 text-white text-sm px-4 py-2 rounded-md shadow-md hover:bg-red-700 focus:ring-2 focus:ring-red-500 focus:outline-none"
                                                        onclick="confirmDelete({{ $order->id }})">
                                                        Delete
                                                    </button>
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

    {{-- openModal --}}
    <div id="modalConfirm"
        class="fixed hidden z-50 inset-0 bg-gray-900 bg-opacity-60 overflow-y-auto h-full w-full px-4 ">
        <div class="relative top-40 mx-auto shadow-xl rounded-md bg-white dark:bg-zinc-900 max-w-md">

            <div class="flex justify-end p-2">
                <button onclick="closeModal('modalConfirm')" type="button"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>

            <div class="p-6 pt-0 text-center">
                <svg class="w-20 h-20 text-red-600 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <h3 class="text-xl font-normal text-gray-500 mt-5 mb-6">Change Status: </h3>
                @foreach ($statusOptions as $status)
                    <button onclick="updateStatus('{{ $status }}', orderId)"
                        class="{{ $status == 'Processed' ? 'bg-yellow-800 hover:bg-yellow-700 focus:ring-4 focus:ring-amber-300 font-medium inline-flex items-center rounded-md px-2 py-3 text-white' : '' }}
                                {{ $status == 'Pending' ? 'bg-amber-300 hover:bg-amber-200 focus:ring-4 focus:ring-amber-300 font-medium inline-flex items-center rounded-md px-2 py-3 text-white' : '' }}
                                {{ $status == 'Cancelled' ? 'bg-red-700 hover:bg-red-600 focus:ring-4 focus:ring-amber-300 font-medium inline-flex items-center rounded-md px-2 py-3 text-white' : '' }}
                                {{ $status == 'Completed' ? 'bg-green-500 hover:bg-green-400 focus:ring-4 focus:ring-amber-300 font-medium inline-flex items-center rounded-md px-2 py-3 text-white' : '' }}">
                        {{ $status }}
                    </button>
                @endforeach
            </div>

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
    <script type="text/javascript">
        window.openModal = function(modalId) {
            document.getElementById(modalId).style.display = 'block'
            document.getElementsByTagName('body')[0].classList.add('overflow-y-hidden')
        }

        window.closeModal = function(modalId) {
            document.getElementById(modalId).style.display = 'none'
            document.getElementsByTagName('body')[0].classList.remove('overflow-y-hidden')
        }

        // Close all modals when press ESC
        document.onkeydown = function(event) {
            event = event || window.event;
            if (event.keyCode === 27) {
                document.getElementsByTagName('body')[0].classList.remove('overflow-y-hidden')
                let modals = document.getElementsByClassName('modal');
                Array.prototype.slice.call(modals).forEach(i => {
                    i.style.display = 'none'
                })
            }
        };
    </script>
    <script>
        let orderId = null;

        function openModal(id) {
            orderId = id;
            document.getElementById("modalConfirm").classList.remove("hidden");
        }

        function closeModal(modalId) {
            document.getElementById(modalId).classList.add("hidden");
        }

        function updateStatus(status) {
            fetch(`/admin/orders/${orderId}/status`, {
                    method: 'PATCH',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        status: status
                    })
                })
                .then(response => response.json())
                .then(data => {
                    console.log(data); // Debugging: lihat apa yang dikembalikan
                    if (data.message) {
                        // Menggunakan SweetAlert untuk menampilkan pesan sukses
                        Swal.fire({
                            title: 'Success',
                            text: data.message,
                            icon: 'success',
                            confirmButtonText: 'OK',
                            confirmButtonColor: '#fcd34d',
                        });

                        // Update status di UI
                        const statusElement = document.getElementById(`order-status-${orderId}`);
                        if (statusElement) {
                            statusElement.innerText = status; // Ganti status di UI
                        }
                    } else {
                        // Menggunakan SweetAlert untuk menampilkan pesan gagal
                        Swal.fire({
                            title: 'Error',
                            text: 'Status update failed',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                    closeModal('modalConfirm'); // Menutup modal
                })
                .catch(error => {
                    console.error('Error:', error);
                    // Menggunakan SweetAlert untuk menampilkan pesan error
                    Swal.fire({
                        title: 'Error',
                        text: error.message,
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                });
        }
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
