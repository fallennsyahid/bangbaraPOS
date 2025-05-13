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
                        <h1 class="text-2xl font-semibold text-zinc-950">Manage Orders</h1>
                    </div>


                    <!-- Content -->
                    <div class="flex flex-col items-center justify-center min-h-full bg-prime px-4 py-4">
                        <!-- Tombol View on GitHub -->
                        <!-- Tabel -->

                        <div class="flex flex-wrap justify-between w-full max-w-6xl mb-4 gap-4">
                            {{-- Export Button --}}
                            <div class="">
                                <a href="{{ route('orders.export') }}"
                                    class="bg-green-700 text-white py-2 px-4 rounded-md hover:bg-green-600 shadow-lg flex items-center">
                                    <img src="{{ asset('asset-view/assets/svg/export.svg') }}"
                                        class="w-5 h-5 inline-block mr-2">
                                    Export
                                </a>
                            </div>

                            {{-- Bulk Delete --}}
                            <div class="">
                                <button id="bulkDeleteButton" class="bg-red-700 text-white px-4 py-2 rounded-lg hidden">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                        viewBox="0 0 24 24" class="inline-block">
                                        <path fill="red"
                                            d="M19 4h-3.5l-1-1h-5l-1 1H5v2h14M6 19a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V7H6z" />
                                    </svg>
                                    Delete Selected
                                </button>
                            </div>
                        </div>
                        <div class="w-full max-w-6xl overflow-x-auto text-zinc-950">

                            <table class="table-auto border-collapse w-full text-left shadow-lg rounded-md"
                                id="myTable">
                                <!-- Header -->
                                <thead class="bg-thead text-white shadow-md">
                                    <tr>
                                        <th class="px-6 py-3 text-sm font-bold uppercase tracking-wide text-zinc-950">
                                            <input type="checkbox" id="select-all" />
                                        </th>
                                        <th class="px-6 py-3 text-sm font-bold uppercase tracking-wide text-zinc-950">
                                            ID
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
                                            Aksi</th>
                                    </tr>
                                </thead>

                                <!-- Body -->
                                <tbody class="bg-tbody" id="orderTableBody">
                                    @foreach ($orders as $index => $order)
                                        <tr class="hover:bg-thead" data-category="{{ $order->id }}">
                                            <td class="px-6 py-4 font-medium text-sm text-zinc-950"> <input
                                                    type="checkbox" class="select-item" value="{{ $order->id }}">

                                            </td>
                                            <td class="px-6 py-4 font-medium text-sm text-zinc-950">
                                                #{{ $index + 1 }}
                                            </td>
                                            <td id="customer-name-{{ $order->id }}"
                                                class="px-6 py-4 font-medium text-sm text-zinc-950">
                                                {{ $order->customer_name }}
                                            </td>
                                            <td class="px-6 py-4 font-medium text-sm">
                                                <h5 id="order-status-{{ $order->id }}"
                                                    class="
                                                    {{ $order->status == 'Pending' ? 'font-extrabold text-yellow-500' : '' }}">
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

                                                {{ $order->created_at->diffForHumans() }}
                                            </td>

                                            <!-- Actions -->
                                            <td class="px-6 py-4 flex items-center gap-3 mt-4">

                                                <!-- Detail button -->
                                                <a href="{{ route('orders.show', $order->id) }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="30"
                                                        height="30" viewBox="0 0 24 24">
                                                        <path fill="#6c80e4" fill-rule="evenodd"
                                                            d="M12 17.8c4.034 0 7.686-2.25 9.648-5.8C19.686 8.45 16.034 6.2 12 6.2S4.314 8.45 2.352 12c1.962 3.55 5.614 5.8 9.648 5.8M12 5c4.808 0 8.972 2.848 11 7c-2.028 4.152-6.192 7-11 7s-8.972-2.848-11-7c2.028-4.152 6.192-7 11-7m0 9.8a2.8 2.8 0 1 0 0-5.6a2.8 2.8 0 0 0 0 5.6m0 1.2a4 4 0 1 1 0-8a4 4 0 0 1 0 8" />
                                                    </svg>
                                                </a>

                                                <!-- Update status button -->
                                                @if ($order->status !== 'Completed' && $order->status !== 'Cancelled')
                                                    <svg id="order-status-{{ $order->id }}" class="cursor-pointer"
                                                        xmlns="http://www.w3.org/2000/svg" width="30"
                                                        height="30" viewBox="0 0 24 24" onclick="openModal(this)"
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


                                                <!-- Delete button -->
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

                                                <!-- {{-- ini untuk cetak struk --}} -->
                                                <a href="javascript:void(0)"
                                                    onclick="printReceipt({{ $order->id }})"><svg width="42"
                                                        height="42" viewBox="0 0 42 42" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M28.2851 23.8717H28.9156C30.1048 23.8717 30.6987 23.8717 31.0682 23.5022C31.4377 23.1328 31.4377 22.5388 31.4377 21.3496V20.0886C31.4377 17.7103 31.4377 16.5224 30.6987 15.7834C29.9598 15.0444 28.7719 15.0444 26.3935 15.0444H15.0442C12.6658 15.0444 11.4779 15.0444 10.739 15.7834C10 16.5224 10 17.7103 10 20.0886V22.6107C10 23.2046 10 23.5022 10.1841 23.6876C10.3695 23.8717 10.6671 23.8717 11.261 23.8717H13.1526"
                                                            stroke="#9F6802" stroke-width="1.33333" />
                                                        <path
                                                            d="M13.7832 31.8239V21.3497C13.7832 20.1606 13.7832 19.5666 14.1527 19.1971C14.5222 18.8276 15.1161 18.8276 16.3053 18.8276H25.1326C26.3217 18.8276 26.9157 18.8276 27.2852 19.1971C27.6547 19.5666 27.6547 20.1606 27.6547 21.3497V31.8239C27.6547 32.2237 27.6547 32.4229 27.5235 32.5175C27.3924 32.6121 27.2032 32.549 26.8249 32.4229L24.091 31.5112C24.022 31.4806 23.9481 31.4627 23.8728 31.4582C23.7976 31.467 23.7245 31.4892 23.6572 31.5238L20.9535 32.6058C20.8806 32.644 20.8009 32.6676 20.7189 32.6751C20.637 32.6676 20.5573 32.644 20.4844 32.6058L17.7807 31.5238C17.6748 31.4809 17.6218 31.4608 17.5663 31.4582C17.5108 31.4557 17.4554 31.4746 17.3469 31.5112L14.613 32.4229C14.2347 32.549 14.0455 32.6121 13.9144 32.5175C13.7832 32.4229 13.7832 32.2237 13.7832 31.8239Z"
                                                            stroke="#9F6802" stroke-width="1.33333" />
                                                        <path d="M17.5664 23.8711H22.6106M17.5664 27.6542H23.8716"
                                                            stroke="#9F6802" stroke-width="1.33333"
                                                            stroke-linecap="round" />
                                                        <path
                                                            d="M27.6547 15.0442V14.5398C27.6547 12.3998 27.6547 11.3291 26.9901 10.6646C26.3255 10 25.2549 10 23.1149 10H18.323C16.183 10 15.1123 10 14.4478 10.6646C13.7832 11.3291 13.7832 12.3998 13.7832 14.5398V15.0442"
                                                            stroke="#9F6802" stroke-width="1.33333" />
                                                    </svg>
                                                </a>

                                                <!-- Button panggil pelanggan -->
                                                <button onclick="panggilNama({{ $order->id }})">
                                                    <svg version="1.0" id="Layer_1"
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        xmlns:xlink="http://www.w3.org/1999/xlink" width="28px"
                                                        height="28px" viewBox="0 0 64 64"
                                                        enable-background="new 0 0 64 64" xml:space="preserve"
                                                        fill="#000000">
                                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                            stroke-linejoin="round"></g>
                                                        <g id="SVGRepo_iconCarrier">
                                                            <g>
                                                                <path fill="#000000"
                                                                    d="M59.998,28.001h-7.999c-2.211,0-4,1.789-4,4s1.789,4,4,4h7.999c2.211,0,4-1.789,4-4 S62.209,28.001,59.998,28.001z">
                                                                </path>
                                                                <path fill="#000000"
                                                                    d="M49.71,19.466l6.929-4c1.914-1.105,2.57-3.551,1.461-5.465c-1.102-1.914-3.547-2.57-5.46-1.465l-6.93,4 c-1.914,1.105-2.57,3.551-1.461,5.464C45.351,19.915,47.796,20.571,49.71,19.466z">
                                                                </path>
                                                                <path fill="#000000"
                                                                    d="M56.639,48.535l-6.929-3.999c-1.914-1.105-4.355-0.449-5.461,1.464c-1.105,1.914-0.453,4.359,1.461,5.465 l6.93,4c1.913,1.105,4.358,0.449,5.464-1.465S58.553,49.641,56.639,48.535z">
                                                                </path>
                                                                <path fill="#000000"
                                                                    d="M37.53,0.307c-1.492-0.625-3.211-0.277-4.359,0.867L18.343,16.001H4c-2.211,0-4,1.789-4,4v24 C0,46.211,1.789,48,4,48h14.343l14.828,14.828C33.937,63.594,34.96,64,35.999,64c0.516,0,1.035-0.098,1.531-0.305 c1.496-0.617,2.469-2.078,2.469-3.695V4.001C39.999,2.384,39.026,0.924,37.53,0.307z">
                                                                </path>
                                                            </g>
                                                        </g>
                                                    </svg>
                                                </button>


                                            </td>
                                        </tr>
                                    @endforeach
                                    <!-- Tambahkan baris lain sesuai kebutuhan -->
                                </tbody>
                            </table>


                            <!-- <x-admin.success-alert></x-admin.success-alert> -->
                        </div>
                    </div>
                </main>
            </div>

            <x-admin.panel-content></x-admin.panel-content>
        </div>
    </div>

    <!-- Open Modal Content -->
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

    <!-- Script untuk panggil nama -->
    <script>
        function panggilNama(orderId) {
            const customerCell = document.getElementById('customer-name-' + orderId);
            const customerName = customerCell.textContent.trim();
            const teks = "Atas nama " + customerName + ", Silahkan menuju ke kasir";
            const suara = new SpeechSynthesisUtterance(teks);
            suara.lang = 'id-ID'; // Bahasa Indonesia
            suara.rate = 1; // Kecepatan bicara
            suara.pitch = 1; // Nada suara
            window.speechSynthesis.speak(suara);
        }
    </script>

    <!--  Confirm Alert  -->
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

    <!-- Open Modal Script -->
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

    <!-- Script action access -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Ambil semua baris order
            const rows = document.querySelectorAll('#orderTableBody tr');

            rows.forEach(row => {
                const orderId = row.dataset.category;
                const statusEl = document.getElementById(`order-status-${orderId}`);
                const status = statusEl?.innerText?.trim();

                // Cek jika status adalah Pending, Cancelled, atau Completed
                if (['Pending', 'Cancelled', 'Completed'].includes(status)) {
                    // Nonaktifkan cetak struk
                    const printBtn = row.querySelector(`a[onclick^="printReceipt"]`);
                    if (printBtn) {
                        printBtn.style.cursor = 'default';
                        printBtn.style.pointerEvents = 'none';
                        printBtn.style.opacity = '0.5';
                        printBtn.title = 'Tidak dapat mencetak struk pada status ini';
                    }

                    // Nonaktifkan tombol panggil
                    const panggilBtn = row.querySelector(`button[onclick^="panggilNama"]`);
                    if (panggilBtn) {
                        panggilBtn.disabled = true;
                        panggilBtn.title = 'Tidak dapat memanggil pelanggan pada status ini';
                        panggilBtn.style.opacity = '0.5';
                        panggilBtn.style.cursor = 'not-allowed';
                    }
                }
            });
        });
    </script>


    <!-- {{-- DataTables --}} -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/2.1.8/js/dataTables.min.js"></script>
    <!-- {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}} -->

    <!-- Update realtime table -->
    <script>
        let lastOrderTimestamp = null;
        let orderId = null;
        const selectedIds = new Set();

        document.addEventListener('DOMContentLoaded', function() {
            initializeEventListeners();
            disableActionsBasedOnStatus();
            applyOrderActionAccess();



            // Inisialisasi DataTable (jika belum)
            if (!$.fn.DataTable.isDataTable("#myTable")) {
                $('#myTable').DataTable({
                    "columnDefs": [{
                        "targets": 0,
                    }],
                    "ordering": false,
                    "responsive": true,
                    "pageLength": 10
                });
            }


            // Checkbox select-all dan select-item
            const allIds = @json($orders->pluck('id')); // Ganti jika ID diambil dari controller
            const selectAll = document.getElementById('select-all');
            const bulkDeleteButton = document.getElementById('bulkDeleteButton');

            const table = $('#myTable').DataTable();

            // Function display delete selected
            function updateBulkDeleteButton() {
                bulkDeleteButton.classList.toggle('hidden', selectedIds.size === 0);
            }

            // Sync checkbox saat pagination berubah
            table.on('draw', function() {
                document.querySelectorAll('.select-item').forEach(cb => {
                    cb.checked = selectedIds.has(cb.value);
                });

                const allVisibleChecked = Array.from(document.querySelectorAll('.select-item')).every(cb =>
                    cb.checked);
                if (selectAll) selectAll.checked = allVisibleChecked;
            });

            // Event untuk select-item
            document.querySelector('#myTable').addEventListener('change', function(e) {
                if (e.target.classList.contains('select-item')) {
                    const id = e.target.value;
                    if (e.target.checked) {
                        selectedIds.add(id);
                    } else {
                        selectedIds.delete(id);
                    }
                    updateBulkDeleteButton();

                    const allVisibleChecked = Array.from(document.querySelectorAll('.select-item')).every(
                        cb => cb.checked);
                    if (selectAll) selectAll.checked = allVisibleChecked;
                }
            });

            // Event untuk select-all
            if (selectAll) {
                selectAll.addEventListener('change', function() {
                    if (this.checked) {
                        allIds.forEach(id => selectedIds.add(String(id)));
                    } else {
                        selectedIds.clear();
                    }

                    document.querySelectorAll('.select-item').forEach(cb => {
                        cb.checked = selectAll.checked;
                    });
                    updateBulkDeleteButton();
                });
            }

            // Event untuk tombol Bulk Delete
            if (bulkDeleteButton) {
                bulkDeleteButton.addEventListener('click', function() {
                    if (selectedIds.size === 0) {
                        Swal.fire({
                            icon: 'warning',
                            title: 'No items selected',
                            text: 'Please select items to delete.',
                            showConfirmButton: true,
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
                            fetch('{{ route('orders.bulkDelete') }}', {
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
            }
        });

        // Cek order baru setiap 5 detik
        setInterval(checkNewOrders, 10000);


        // Fungsi untuk check new orders
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

        // Fungsi untuk update table
        function updateTable() {
            $.ajax({
                url: "/admin/orders",
                type: "GET",
                success: function(data) {
                    let newTbody = $(data).find("tbody").html();

                    if ($.fn.DataTable.isDataTable("#myTable")) {
                        $('#myTable').DataTable().clear().destroy();
                    }

                    $("#orderTableBody").html(newTbody);

                    $('#myTable').DataTable({
                        "columnDefs": [{
                            "targets": 0,
                        }],
                        "ordering": false,
                        "responsive": true,
                        "pageLength": 10
                    });

                    $(window).trigger('resize');
                    disableActionsBasedOnStatus();
                    applyOrderActionAccess();
                    initializeEventListeners();
                },
                error: function(xhr, status, error) {
                    console.error("Error updating order table:", error);
                }
            });
        }

        // Fungsi untuk disable button
        function disableActionsBasedOnStatus() {
            const rows = document.querySelectorAll('#orderTableBody tr');

            rows.forEach(row => {
                const orderId = row.dataset.category;
                const statusEl = document.getElementById(`order-status-${orderId}`);
                const status = statusEl?.innerText?.trim();

                if (['Pending', 'Cancelled', 'Completed'].includes(status)) {
                    const printBtn = row.querySelector(`a[onclick^="printReceipt"]`);
                    if (printBtn) {
                        printBtn.style.cursor = 'default';
                        printBtn.style.pointerEvents = 'none';
                        printBtn.style.opacity = '0.5';
                        printBtn.title = 'Tidak dapat mencetak struk pada status ini';
                    }

                    const panggilBtn = row.querySelector(`button[onclick^="panggilNama"]`);
                    if (panggilBtn) {
                        panggilBtn.disabled = true;
                        panggilBtn.title = 'Tidak dapat memanggil pelanggan pada status ini';
                        panggilBtn.style.opacity = '0.5';
                        panggilBtn.style.cursor = 'not-allowed';
                    }
                }
            });
        }

        // Realtime action access
        function applyOrderActionAccess() {
            const rows = document.querySelectorAll('#orderTableBody tr');

            rows.forEach(row => {
                const orderId = row.dataset.category;
                const statusEl = document.getElementById(`order-status-${orderId}`);
                const status = statusEl?.innerText?.trim();

                if (['Pending', 'Cancelled', 'Completed'].includes(status)) {
                    const printBtn = row.querySelector(`a[onclick^="printReceipt"]`);
                    if (printBtn) {
                        printBtn.style.cursor = 'default';
                        printBtn.style.pointerEvents = 'none';
                        printBtn.style.opacity = '0.5';
                        printBtn.title = 'Tidak dapat mencetak struk pada status ini';
                    }

                    const panggilBtn = row.querySelector(`button[onclick^="panggilNama"]`);
                    if (panggilBtn) {
                        panggilBtn.disabled = true;
                        panggilBtn.title = 'Tidak dapat memanggil pelanggan pada status ini';
                        panggilBtn.style.opacity = '0.5';
                        panggilBtn.style.cursor = 'not-allowed';
                    }

                } else {
                    // Aktifkan kembali jika status bukan yang di-lock
                    const printBtn = row.querySelector(`a[onclick^="printReceipt"]`);
                    if (printBtn) {
                        printBtn.style.cursor = 'pointer';
                        printBtn.style.pointerEvents = 'auto';
                        printBtn.style.opacity = '1';
                        printBtn.title = '';
                    }

                    const panggilBtn = row.querySelector(`button[onclick^="panggilNama"]`);
                    if (panggilBtn) {
                        panggilBtn.disabled = false;
                        panggilBtn.style.opacity = '1';
                        panggilBtn.style.cursor = 'pointer';
                        panggilBtn.title = '';
                    }
                }
            });
        }


        // fungsi untuk inisialiasi
        function initializeEventListeners() {
            document.querySelectorAll('.delete-button').forEach(button => {
                button.addEventListener('click', function() {
                    const orderId = this.dataset.orderId;
                    confirmDelete(orderId);
                });
            });

            document.querySelectorAll('.open-modal-button').forEach(button => {
                button.addEventListener('click', function() {
                    const orderId = this.dataset.orderId;
                    openModal(this);
                });
            });

            // Tambahkan event listener untuk tombol cetak struk
            document.querySelectorAll('.print-button').forEach(button => {
                button.addEventListener('click', function() {
                    const orderId = this.dataset.orderId;
                    printReceipt(orderId);
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
                denyButtonText: "Don't delete"
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

            document.getElementById("modalOrderId").value = orderId;
            document.getElementById("modalCurrentStatus").textContent = currentStatus;

            let availableStatuses = [];
            if (currentStatus === "Pending") {
                availableStatuses = ["Processed", "Cancelled"];
            } else if (currentStatus === "Processed") {
                availableStatuses = ["Completed", "Cancelled"];
            }

            let statusContainer = document.getElementById("modalStatusOptions");
            statusContainer.innerHTML = "";

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

        function closeModal() {
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
                            const statusClasses = {
                                'Processed': 'text-black',
                                'Pending': 'text-yellow-300 font-extrabold',
                                'Cancelled': 'text-black',
                                'Completed': 'text-black',
                            };

                            statusElement.className = `text-center ${statusClasses[currentStatus] || ''}`;
                            statusElement.innerText = currentStatus;
                        }

                        document.querySelector(`[data-id="${orderId}"]`).setAttribute("data-status", currentStatus);
                        updateOrderStatus(orderId, currentStatus);

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

        function updateOrderStatus(orderId, newStatus) {
            const statusElement = document.getElementById(`order-status-${orderId}`);
            if (statusElement) {
                statusElement.setAttribute('data-status', newStatus);
                statusElement.style.display = 'block'; // pastikan tetap tampil

                // Update class dan isi teks juga bisa ditaruh di sini (opsional)
                const statusClasses = {
                    'Processed': 'text-black',
                    'Pending': 'text-yellow-300 font-extrabold',
                    'Cancelled': 'text-black',
                    'Completed': 'text-black',
                };
                statusElement.className = `text-center ${statusClasses[newStatus] || ''}`;
                statusElement.innerText = newStatus;
            }
            applyOrderActionAccess();

        }

        function printReceipt(id) {
            fetch(`/admin/orders/print-struk/${id}`, {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(res => res.json())
                .then(data => {
                    if (data.status === 'success') {
                        Swal.fire({
                            position: "top-end",
                            icon: "success",
                            title: "{{ session('message', $title ?? 'Successfully Printed Struck') }}",
                            showConfirmButton: false,
                            timer: 1500
                        });
                    } else {
                        Swal.fire({
                            position: "top-end",
                            icon: "error",
                            title: "Oops...",
                            text: data.message || "Failed to print struck!",
                            customClass: {
                                confirmButton: 'confirm-button',
                            }
                        });
                        // alert("Gagal cetak struk: " + data.message);
                    }
                })
                .catch(err => {
                    console.error("Error:", err);
                    Swal.fire({
                        position: "top-end",
                        icon: "error",
                        title: "Oops...",
                        text: "Failed to print struck!",
                    });
                });
        }
    </script>
</body>

</html>
