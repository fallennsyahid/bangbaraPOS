<x-staff.header></x-staff.header>

<body>
    <div x-data="setup()" x-init="$refs.loading.classList.add('hidden');
    setColors(color);" :class="{ 'dark': isDark }">
        <div class="flex h-screen antialiased text-gray-950 bg-gray-100 dark:bg-dark dark:text-light">
            <!-- Loading screen -->
            <div x-ref="loading"
                class="fixed inset-0 z-50 flex items-center justify-center text-2xl font-semibold text-amber-300 bg-slate-950">
                Loading.....
            </div>

            <x-staff.sidebar></x-staff.sidebar>

            <div class="flex-1 h-full overflow-x-hidden overflow-y-auto">
                <x-staff.navbar></x-staff.navbar>

                <!-- Main content -->
                <main class="bg-prime">
                    <!-- Content header -->
                    <div class="flex items-center justify-between px-4 py-2 border-b lg:py-4">
                        <h1 class="text-2xl font-semibold text-zinc-950">Manage Orders</h1>
                        <x-staff.waButton></x-staff.waButton>
                    </div>


                    <!-- Content -->
                    <div class="flex flex-col items-center justify-center min-h-screen bg-prime px-4 py-4">
                        <!-- Tombol View on GitHub -->
                        <!-- Tabel -->
                        <div class="mb-4 mt-3 flex justify-end w-full max-w-4xl">
                            <a href="{{ route('orders.today') }}"
                                class="bg-green-700 text-white py-2 px-4 rounded-md hover:bg-green-600 shadow-lg">
                                <img src="{{ asset('asset-view/assets/svg/export.svg') }}"
                                    class="w-5 h-5 inline-block mr-2">
                                Export
                            </a>
                        </div>
                        <div class="w-full max-w-4xl overflow-x-auto text-zinc-950">

                            <table class="table-auto border-collapse w-full text-left shadow-lg rounded-md"
                                id="myTable">
                                <!-- Header -->
                                <thead class="bg-thead text-white shadow-md">
                                    <tr>
                                        <th class="px-6 py-3 text-sm font-bold uppercase tracking-wide text-zinc-950">ID
                                        </th>
                                        <th class="px-6 py-3 text-sm font-bold uppercase tracking-wide text-zinc-950">
                                            Costumer</th>
                                        <th class="px-6 py-3 text-sm font-bold uppercase tracking-wide text-zinc-950">
                                            Status</th>
                                        <th class="px-6 py-3 text-sm font-bold uppercase tracking-wide text-zinc-950">
                                            Price</th>
                                        <th class="px-6 py-3 text-sm font-bold uppercase tracking-wide text-zinc-950">
                                            Method</th>
                                        <th class="px-6 py-3 text-sm font-bold uppercase tracking-wide text-zinc-950">
                                            Time</th>
                                        <th class="px-6 py-3 text-sm font-bold uppercase tracking-wide text-zinc-950">
                                            Photo</th>
                                        <th class="px-6 py-3 text-sm font-bold uppercase tracking-wide text-zinc-950">
                                            Aksi</th>
                                    </tr>
                                </thead>

                                <!-- Body -->
                                <tbody class="bg-tbody" id="productTable">
                                    @foreach ($orders as $index => $order)
                                        <tr class="hover:bg-thead" data-category="{{ $order->id }}">
                                            <td class="px-6 py-4 font-medium text-sm text-zinc-950">#{{ $index + 1 }}
                                            </td>
                                            <td class="px-6 py-4 font-medium text-sm text-zinc-950">
                                                {{ $order->customer_name }}
                                            </td>
                                            <td class="px-6 py-4 font-medium text-sm">
                                                <h5 id="order-status-{{ $order->id }}"
                                                    class="{{ $order->status == 'Processed' ? 'bg-yellow-800 rounded-md px-3 py-2 text-center text-white' : '' }}
                                                    {{ $order->status == 'Pending' ? 'bg-amber-300 rounded-md px-3 py-2 text-center text-white' : '' }}
                                                    {{ $order->status == 'Cancelled' ? 'bg-red-600 rounded-md px-3 py-2 text-center text-white' : '' }}
                                                    {{ $order->status == 'Completed' ? 'bg-green-500 rounded-md px-3 py-2 text-center text-white' : '' }}">
                                                    {{ $order->status }}
                                                </h5>

                                            </td>
                                            <td class="px-6 py-4 font-medium text-sm text-zinc-950">
                                                Rp {{ number_format($order->total_price, 2) }}
                                            </td>
                                            <td class="px-6 py-4 font-medium text-sm text-zinc-950">
                                                {{ $order->payment_method }}
                                            </td>
                                            <td class="px-6 py-4 font-medium text-sm text-zinc-950">
                                                {{-- <a href="https://wa.me/{{ $order->customer_phone }}"
                                                class="hover:text-blue-400 hover:underline"
                                                target="_blank">{{ $order->customer_phone }}</a> --}}
                                                {{ $order->created_at->diffForHumans() }}
                                            </td>
                                            <td class="px-6 py-4 font-medium text-sm text-zinc-950">
                                                @if ($order->payment_method === 'nonTunai')
                                                    <a href="{{ Storage::url($order->payment_photo) }}"
                                                        target="_blank">
                                                        <button
                                                            class="bg-[#2196F3] rounded-md px-4 py-2 font-semibold text-xs text-slate-950">
                                                            <h6>File</h6>
                                                        </button>
                                                    </a>
                                                @else
                                                    <p class="text-zinc-950 text-2xl text-center mr-2">-</p>
                                                @endif
                                            </td>
                                            {{-- <td class="px-6 py-4 flex gap-3 mt-4">
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
                                            </td> --}}
                                            <td class="px-6 py-4 flex gap-3 mt-4">

                                                <a href="{{ route('staffOrders.show', $order->id) }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="30"
                                                        height="30" viewBox="0 0 24 24">
                                                        <path fill="#6c80e4" fill-rule="evenodd"
                                                            d="M12 17.8c4.034 0 7.686-2.25 9.648-5.8C19.686 8.45 16.034 6.2 12 6.2S4.314 8.45 2.352 12c1.962 3.55 5.614 5.8 9.648 5.8M12 5c4.808 0 8.972 2.848 11 7c-2.028 4.152-6.192 7-11 7s-8.972-2.848-11-7c2.028-4.152 6.192-7 11-7m0 9.8a2.8 2.8 0 1 0 0-5.6a2.8 2.8 0 0 0 0 5.6m0 1.2a4 4 0 1 1 0-8a4 4 0 0 1 0 8" />
                                                    </svg>
                                                </a>

                                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30"
                                                    viewBox="0 0 24 24" onclick="openModal({{ $order->id }})">
                                                    <g fill="none" stroke="#28A745" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2">
                                                        <path
                                                            d="M7 7H6a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2-2v-1" />
                                                        <path
                                                            d="M20.385 6.585a2.1 2.1 0 0 0-2.97-2.97L9 12v3h3zM16 5l3 3" />
                                                    </g>
                                                </svg>

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
                            // Hapus semua class status lama
                            statusElement.classList.remove('bg-yellow-800', 'bg-amber-300', 'bg-red-600',
                                'bg-green-500');

                            // Tambahkan class status baru
                            if (status === 'Processed') {
                                statusElement.classList.add('bg-yellow-800', 'rounded-md', 'px-3', 'py-2',
                                    'text-center', 'text-white');
                            } else if (status === 'Pending') {
                                statusElement.classList.add('bg-amber-300', 'rounded-md', 'px-3', 'py-2', 'text-center',
                                    'text-white');
                            } else if (status === 'Cancelled') {
                                statusElement.classList.add('bg-red-600', 'rounded-md', 'px-3', 'py-2', 'text-center',
                                    'text-white');
                            } else if (status === 'Completed') {
                                statusElement.classList.add('bg-green-500', 'rounded-md', 'px-3', 'py-2', 'text-center',
                                    'text-white');
                            }

                            // Update status text
                            statusElement.innerText = status;
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
