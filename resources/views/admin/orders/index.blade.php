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
                        <h1 class="text-2xl font-semibold text-zinc-950">Manage Orders</h1>
                        <x-admin.waButton></x-admin.waButton>
                    </div>


                    <!-- Content -->
                    <div class="flex flex-col items-center justify-center min-h-screen bg-prime px-4 py-4">
                        <!-- Tombol View on GitHub -->
                        <!-- Tabel -->
                        {{-- <div class="flex justify-between w-full max-w-4xl mb-4"> --}}
                        {{-- <button id="delete-selected"
                                class="bg-red-700 text-white py-2 px-4 rounded-md hover:bg-red-600 shadow-lg flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30"
                                    viewBox="0 0 24 24"
                                    class="cursor-pointer hover:fill-red-700 transition duration-200 inline-block mr-2">
                                    <path fill="red"
                                        d="M19 4h-3.5l-1-1h-5l-1 1H5v2h14M6 19a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V7H6z" />
                                </svg>
                                Delete
                            </button> --}}

                        <div class="flex justify-end w-full max-w-6xl mb-4">
                            <a href="{{ route('orders.export') }}"
                                class="bg-green-700 text-white py-2 px-4 rounded-md hover:bg-green-600 shadow-lg flex items-center">
                                <img src="{{ asset('asset-view/assets/svg/export.svg') }}"
                                    class="w-5 h-5 inline-block mr-2">
                                Export
                            </a>
                        </div>
                        {{-- </div> --}}
                        <div class="w-full max-w-6xl overflow-x-auto text-zinc-950">

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
                                <tbody class="bg-tbody" id="orderTableBody">
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
                                            <td class="px-6 py-4 flex gap-3 mt-4">

                                                <a href="{{ route('orders.show', $order->id) }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="30"
                                                        height="30" viewBox="0 0 24 24">
                                                        <path fill="#6c80e4" fill-rule="evenodd"
                                                            d="M12 17.8c4.034 0 7.686-2.25 9.648-5.8C19.686 8.45 16.034 6.2 12 6.2S4.314 8.45 2.352 12c1.962 3.55 5.614 5.8 9.648 5.8M12 5c4.808 0 8.972 2.848 11 7c-2.028 4.152-6.192 7-11 7s-8.972-2.848-11-7c2.028-4.152 6.192-7 11-7m0 9.8a2.8 2.8 0 1 0 0-5.6a2.8 2.8 0 0 0 0 5.6m0 1.2a4 4 0 1 1 0-8a4 4 0 0 1 0 8" />
                                                    </svg>
                                                </a>

                                                @if ($order->status !== 'Completed' && $order->status !== 'Cancelled')
                                                    <svg id="order-status-{{ $order->id }}"
                                                        xmlns="http://www.w3.org/2000/svg" width="30" height="30"
                                                        viewBox="0 0 24 24" onclick="openModal(this)"
                                                        data-id="{{ $order->id }}"
                                                        data-status="{{ $order->status }}">
                                                        <g fill="none" stroke="#28A745" stroke-linecap="round"
                                                            stroke-linejoin="round" stroke-width="2">
                                                            <path
                                                                d="M7 7H6a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h9a2 2 0 2-2v-1" />
                                                            <path
                                                                d="M20.385 6.585a2.1 2.1 0 0 0-2.97-2.97L9 12v3h3zM16 5l3 3" />
                                                        </g>
                                                    </svg>
                                                @endif


                                                <form id="delete-form-{{ $order->id }}"
                                                    action="{{ route('orders.destroy', $order->id) }}" method="POST"
                                                    onsubmit="return confirm('Are you sure you want to delete this category?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="30"
                                                        height="30" viewBox="0 0 24 24"
                                                        class="cursor-pointer hover:fill-red-700 transition duration-200"
                                                        onclick="confirmDelete({{ $order->id }})">
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
        class="fixed hidden z-50 inset-0 bg-gray-900 bg-opacity-60 overflow-y-auto h-full w-full px-4">
        <div class="relative top-40 mx-auto shadow-xl rounded-md bg-white dark:bg-zinc-900 max-w-md">
            <div class="flex justify-end p-2">
                <button onclick="closeModal()" type="button"
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
                <h3 class="text-xl font-normal text-gray-500 mt-5 mb-6">
                    Change Status for Order <span id="modalCurrentStatus"></span>:
                </h3>

                <input type="hidden" id="modalOrderId">
                <div id="modalStatusOptions" class="flex justify-center gap-2"></div>
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
                denyButtonText: "Don't delete",
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
            fetch(/admin/orders / $ {
                    orderId
                }
                /status, {
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
                    const statusElement = document.getElementById(order - status - $ {
                        orderId
                    });
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
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
    <script>
        let lastOrderTimestamp = null;
        let orderId = null;

        function checkNewOrders() {
            $.ajax({
                url: "/orders/latest",
                type: "GET",
                success: function(data) {
                    if (data && (!lastOrderTimestamp || new Date(data.created_at) > new Date(
                            lastOrderTimestamp))) {
                        lastOrderTimestamp = data.created_at;
                        updateTable();
                    }
                },
                error: function(xhr, status, error) {
                    console.error("Error fetching orders:", error);
                }
            });
        }

        function updateTable() {
            $.ajax({
                url: "/admin/orders",
                type: "GET",
                success: function(data) {
                    let newTbody = $(data).find("tbody").html();

                    // Hapus DataTables jika sudah ada
                    if ($.fn.DataTable.isDataTable("#myTable")) {
                        $('#myTable').DataTable().clear().destroy();
                    }

                    // Update isi tabel
                    $("#orderTableBody").html(newTbody);

                    // Re-inisialisasi DataTables setelah update
                    $('#myTable').DataTable({
                        "columnDefs": [{
                            "targets": 0,
                            "render": function(data, type, row, meta) {
                                return meta.row + 1;
                            }
                        }],
                        "ordering": false,
                        "responsive": true,
                        "pageLength": 10
                    });

                    // Trigger resize untuk memastikan tampilan DataTables responsif
                    $(window).trigger('resize');

                    // Panggil ulang event listener setelah update
                    initializeEventListeners();
                },
                error: function(xhr, status, error) {
                    console.error("Error updating order table:", error);
                }
            });
        }

        function initializeEventListeners() {
            // Event listener untuk tombol hapus
            document.querySelectorAll('.delete-button').forEach(button => {
                button.addEventListener('click', function() {
                    const orderId = this.dataset.orderId;
                    confirmDelete(orderId);
                });
            });

            // Event listener untuk tombol modal
            document.querySelectorAll('.open-modal-button').forEach(button => {
                button.addEventListener('click', function() {
                    const orderId = this.dataset.orderId;
                    openModal(orderId);
                });
            });
        }

        function confirmDelete(orderId) {
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this",
                showDenyButton: true,
                showConfirmButton: true,
                confirmButtonText: "Delete",
                icon: "warning",
                denyButtonText: "Don't delete",
                customClass: {
                    confirmButton: 'confirm-button',
                    denyButton: 'cancel-button',
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    let form = document.getElementById(`delete-form-${orderId}`);
                    if (form) form.submit();
                }
            });
        }

        function openModal(element) {
            let orderId = element.getAttribute("data-id");
            let currentStatus = element.getAttribute("data-status");

            // Perbarui modal dengan data order yang diklik
            document.getElementById("modalOrderId").value = orderId;
            document.getElementById("modalCurrentStatus").textContent = currentStatus;

            // Tentukan status yang bisa dipilih
            let availableStatuses = [];
            if (currentStatus === "Pending") {
                availableStatuses = ["Processed", "Cancelled"];
            } else if (currentStatus === "Processed") {
                availableStatuses = ["Completed", "Cancelled"];
            }

            // Bersihkan tombol status sebelumnya
            let statusContainer = document.getElementById("modalStatusOptions");
            statusContainer.innerHTML = "";

            // Tambahkan tombol baru berdasarkan status yang tersedia
            availableStatuses.forEach(status => {
                let button = document.createElement("button");
                button.textContent = status;
                button.className = "px-4 py-2 rounded-md text-white mx-2 " +
                    (status === "Processed" ? "bg-yellow-800 hover:bg-yellow-700" :
                        status === "Cancelled" ? "bg-red-700 hover:bg-red-600" :
                        "bg-green-500 hover:bg-green-400");

                button.onclick = function() {
                    updateStatus(status, orderId);
                };

                statusContainer.appendChild(button);
            });
            document.getElementById("modalConfirm").classList.remove("hidden");
        }


        function closeModal(modalId) {
            document.getElementById('modalConfirm').classList.add("hidden");
        }

        function updateStatus(currentStatus, orderId) {
            fetch(`/admin/orders/${orderId}/status`, {
                    method: 'PATCH',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        status: currentStatus
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.message) {
                        Swal.fire({
                            title: 'Success',
                            text: data.message,
                            icon: 'success',
                            confirmButtonText: 'OK',
                            confirmButtonColor: '#fcd34d',
                        });

                        let statusElement = document.getElementById(`order-status-${orderId}`);
                        if (statusElement) {
                            statusElement.className = 'rounded-md px-3 py-2 text-center text-white';

                            let statusClasses = {
                                'Processed': 'bg-yellow-800',
                                'Pending': 'bg-amber-300',
                                'Cancelled': 'bg-red-600',
                                'Completed': 'bg-green-500'
                            };

                            statusElement.classList.add(statusClasses[currentStatus] || '');
                            statusElement.innerText = currentStatus;
                        }

                        // ✅ UPDATE STATUS DI ATTRIBUT DATA
                        document.querySelector(`[data-id="${orderId}"]`).setAttribute("data-status", currentStatus);

                    } else {
                        Swal.fire({
                            title: 'Error',
                            text: 'Status update failed',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                    closeModal();
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire({
                        title: 'Error',
                        text: error.message,
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                });
        }

        // Fungsi untuk svg dinamis
        function updateOrderStatus(orderId, newStatus) {
            const svgElement = document.getElementById(`order-status-${orderId}`);
            if (svgElement) {
                svgElement.setAttribute('data-status', newStatus);
                if (newStatus === 'Completed' || newStatus === 'Cancelled') {
                    svgElement.style.display = 'none';
                } else {
                    svgElement.style.display = 'block';
                }
            }
        }




        // Inisialisasi event listener saat halaman pertama kali dimuat
        document.addEventListener('DOMContentLoaded', function() {
            initializeEventListeners();

            if (!$.fn.DataTable.isDataTable("#myTable")) {
                $('#myTable').DataTable({
                    "columnDefs": [{
                        "targets": 0,
                        "render": function(data, type, row, meta) {
                            return meta.row + 1;
                        }
                    }],
                    "ordering": false,
                    "responsive": true,
                    "pageLength": 10
                });
            }
        });

        setInterval(checkNewOrders, 5000); // Cek setiap 5 detik
    </script>




</body>

</html>
