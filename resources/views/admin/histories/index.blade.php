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
                        <h1 class="text-2xl font-semibold text-zinc-950">Manage Histories</h1>
                        <x-admin.waButton></x-admin.waButton>
                    </div>


                    <!-- Content -->
                    <div class="flex flex-col items-center justify-center min-h-screen bg-prime px-4 py-4">

                        <div class="p-4 w-full max-w-6xl ">
                            <h2 class="text-xl font-semibold text-gray-800 mb-4">Pilih Periode</h2>

                            <form id="filterForm" class="space-y-4">
                                <div class="flex items-center space-x-4">
                                    <div>
                                        <label for="periode_awal" class="text-gray-700 text-sm font-medium">Periode
                                            Awal</label>
                                        <input type="date" id="periode_awal" name="periode_awal"
                                            class="text-white mt-1 block w-48 px-3 py-2 border border-[#CC0000] bg-[#CC0000] rounded-md shadow-sm">
                                    </div>

                                    <span class="text-gray-700 mt-4">-</span>

                                    <div>
                                        <label for="periode_akhir" class="text-gray-700 text-sm font-medium">Periode
                                            Akhir</label>
                                        <input type="date" id="periode_akhir" name="periode_akhir"
                                            class="text-white mt-1 block w-48 px-3 py-2 border border-[#CC0000] bg-[#CC0000] rounded-md shadow-sm">
                                    </div>
                                </div>

                                <button type="submit"
                                    class="bg-red-500 hover:bg-red-600 text-white font-semibold py-2 px-4 rounded-lg shadow-md">
                                    Filter
                                </button>
                            </form>

                        </div>
                        <div class="mb-4 mt-3 flex justify-between w-full max-w-6xl">
                            <a href="#" id="exportExcel"
                                class="bg-green-700 text-white py-2 px-4 rounded-md hover:bg-green-600 shadow-lg">
                                <img src="{{ asset('asset-view/assets/svg/export.svg') }}"
                                    class="w-5 h-5 inline-block mr-2">
                                Export
                            </a>
                            <button id="bulkDeleteButton" class="bg-red-700 text-white px-4 py-2 rounded-lg">Delete
                                Selected</button>

                        </div>
                        <div class="w-full max-w-6xl overflow-x-auto text-zinc-950">
                            <div class="flex mx-auto justify-between">
                            </div>
                            <table class="table-auto border-collapse w-full text-left shadow-lg rounded-md"
                                id="myTable">
                                <!-- Header -->
                                <thead class="bg-thead text-white shadow-md">
                                    <tr>
                                        <th class="px-6 py-3 text-sm font-bold uppercase tracking-wide text-zinc-950">
                                            <input type="checkbox" id="select-all" />
                                        </th>
                                        <th class="px-6 py-3 text-sm font-bold uppercase tracking-wide text-zinc-950">ID
                                        </th>
                                        <th class="px-6 py-3 text-sm font-bold uppercase tracking-wide text-zinc-950">
                                            Casier</th>
                                        <th class="px-6 py-3 text-sm font-bold uppercase tracking-wide text-zinc-950">
                                            Costumer</th>
                                        <th class="px-6 py-3 text-sm font-bold uppercase tracking-wide text-zinc-950">
                                            Date</th>
                                        <th class="px-6 py-3 text-sm font-bold uppercase tracking-wide text-zinc-950">
                                            Total</th>
                                        <th class="px-6 py-3 text-sm font-bold uppercase tracking-wide text-zinc-950">
                                            Method</th>
                                        <th class="px-6 py-3 text-sm font-bold uppercase tracking-wide text-zinc-950">
                                            Status</th>
                                        <th class="px-6 py-3 text-sm font-bold uppercase tracking-wide text-zinc-950">
                                            Photo</th>
                                        <th class="px-6 py-3 text-sm font-bold uppercase tracking-wide text-zinc-950">
                                            Aksi</th>
                                    </tr>
                                </thead>

                                <!-- Body -->
                                <tbody id="productTable" class="bg-tbody">
                                    @forelse ($histories as $index => $history)
                                        <tr class="hover:bg-thead" data-category="{{ $history->id }}">
                                            <td class="px-6 py-4 font-medium text-sm text-zinc-900">
                                                <input type="checkbox" class="select-item" value="{{ $history->id }}">
                                            </td>
                                            <td class="px-6 py-4 font-medium text-sm text-zinc-900">
                                                #{{ $index + 1 }}
                                            </td>
                                            <td class="px-6 py-4 font-medium text-sm text-zinc-900">
                                                {{ $history->casier_name }}
                                            </td>
                                            <td class="px-6 py-4 font-medium text-sm text-zinc-900">
                                                {{ $history->customer_name }}
                                            </td>
                                            <td class="px-6 py-4 font-medium text-sm text-zinc-900">
                                                {{ $history->created_at->format('d/m/y') }}
                                            </td>
                                            <td class="px-6 py-4 font-medium text-sm text-zinc-900">Rp
                                                {{ number_format($history->total_price, 2) }}</td>
                                            <td class="px-6 py-4 font-medium text-sm text-zinc-900">
                                                {{ $history->payment_method }}
                                            </td>
                                            <td class="px-6 py-4 font-medium text-sm text-zinc-900"
                                                id="history-status-{{ $history->id }}">
                                                <h5
                                                    class="
                                                             {{ $history->status == 'Cancelled' ? 'bg-red-600 rounded-md px-3 py-2 text-center text-white' : '' }}
                                                             {{ $history->status == 'Completed' ? 'bg-green-500 rounded-md px-3 py-2 text-center text-white' : '' }}
                                                    ">
                                                    {{ $history->status }}</h4>
                                            </td>
                                            <td class="px-6 py-4 font-medium text-sm text-zinc-900">
                                                @if ($history->payment_method === 'nonTunai')
                                                    <a href="{{ Storage::url($history->payment_photo) }}"
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
                                                <a href="{{ route('histories.show', $history->id) }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="30"
                                                        height="30" viewBox="0 0 24 24">
                                                        <path fill="#6c80e4" fill-rule="evenodd"
                                                            d="M12 17.8c4.034 0 7.686-2.25 9.648-5.8C19.686 8.45 16.034 6.2 12 6.2S4.314 8.45 2.352 12c1.962 3.55 5.614 5.8 9.648 5.8M12 5c4.808 0 8.972 2.848 11 7c-2.028 4.152-6.192 7-11 7s-8.972-2.848-11-7c2.028-4.152 6.192-7 11-7m0 9.8a2.8 2.8 0 1 0 0-5.6a2.8 2.8 0 0 0 0 5.6m0 1.2a4 4 0 1 1 0-8a4 4 0 0 1 0 8" />
                                                    </svg>
                                                </a>

                                                <form id="delete-form-{{ $history->id }}"
                                                    action="{{ route('histories.destroy', $history->id) }}"
                                                    method="POST"
                                                    onsubmit="return confirm('Are you sure you want to delete this category?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="30"
                                                        height="30" viewBox="0 0 24 24"
                                                        class="cursor-pointer hover:fill-red-700 transition duration-200"
                                                        onclick="confirmDelete({{ $history->id }})">
                                                        <path fill="red"
                                                            d="M19 4h-3.5l-1-1h-5l-1 1H5v2h14M6 19a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V7H6z" />
                                                    </svg>
                                                </form>

                                                {{-- ini untuk cetak struk --}}
                                                <a href="javascript:void(0);"
                                                    onclick="printReceipt({{ $history->id }})"><button
                                                        class="px-4 py-2 bg-blue-500 rounded-xl text-white">Cetak
                                                        Struk</button></a>

                                            </td>

                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center py-4">No data available for the
                                                selected filters.</td>
                                        </tr>
                                    @endforelse
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

    <script>
        function printReceipt(id) {
            fetch(`/admin/print-struk/${id}`, {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(res => res.json())
                .then(data => {
                    if (data.status === 'success') {
                        alert("Struk berhasil dicetak!");
                    } else {
                        alert("Gagal cetak struk: " + data.message);
                    }
                })
                .catch(err => {
                    console.error("Error:", err);
                    alert("Terjadi kesalahan saat mencetak struk.");
                });
        }
    </script>

    {{-- Script Tombol Export --}}
    {{-- <script>
        document.getElementById('exportExcel').addEventListener('click', () => {
            const year = document.getElementById('filter-year').value;
            const month = document.getElementById('filter-month').value;
            const day = document.getElementById('filter-day').value;

            const url = /export-histories?year=${year}&month=${month}&day=${day};
            window.location.href = url;
        });
    </script> --}}
    <script>
        document.getElementById('exportExcel').addEventListener('click', (e) => {
                    e.preventDefault();

                    const periode_awal = document.getElementById('periode_awal').value;
                    const periode_akhir = document.getElementById('periode_akhir').value;

                    if (!periode_awal || !periode_akhir) {
                        alert('Please select the date range first');
                        return;
                    }

                    const url = /export-histories?periode_awal=${periode_awal}&periode_akhir=${periode_akhir} + ?
                    periode_awal = $ {
                            const url = `/export-histories?periode_awal=${periode_awal}&periode_akhir=${periode_akhir}`;
    </script>


    <script>
        document.getElementById('filterForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Cegah reload halaman

            let periode_awal = document.getElementById('periode_awal').value;
            let periode_akhir = document.getElementById('periode_akhir').value;

            fetch(/get-histories?periode_awal=${periode_awal}&periode_akhir=${periode_akhir})
                .then(response => response.json())
                .then(data => {
                        let tableBody = document.querySelector('#myTable tbody');
                        tableBody.innerHTML = ''; // Kosongkan tabel sebelum menambahkan data baru

                        if (data.length > 0) {
                            fetch(`/get-histories?periode_awal=${periode_awal}&periode_akhir=${periode_akhir}`)
                            let paymentPhoto = history.payment_method === 'nonTunai' ?
                                `<a href="{{ Storage::url($history->payment_photo) }}" target="_blank">
                                    <button class="bg-[#2196F3] rounded-md px-4 py-2 font-semibold text-xs text-slate-950">
                                        <h6>File</h6>
                                    </button>
                                </a>` : '-';
                            let row = `
                        <tr>
                            <td class="px-6 py-4 font-medium text-sm text-zinc-900">#${index + 1}</td>
                            <td class="px-6 py-4 font-medium text-sm text-zinc-900">${history.casier_name}</td>
                            <td class="px-6 py-4 font-medium text-sm text-zinc-900">${history.customer_name}</td>
                            <td class="px-6 py-4 font-medium text-sm text-zinc-900">${new Date(history.created_at).toLocaleDateString()}</td>
                            <td class="px-6 py-4 font-medium text-sm text-zinc-900">Rp ${history.total_price.toLocaleString()}</td>
                            <td class="px-6 py-4 font-medium text-sm text-zinc-900">${history.payment_method}</td>
                            <td class="px-6 py-4 font-medium text-sm text-zinc-900">
                                <span class="${history.status === 'Cancelled' ? 'bg-red-600 text-white px-3 py-2 rounded-md' : 'bg-green-500 text-white px-3 py-2 rounded-md'}">
                                    ${history.status}
                                </span>
                            </td>
                            <td class="px-6 py-4 font-medium text-sm text-zinc-900">
                                ${paymentPhoto}
                            </td>
                                   <td class="px-6 py-4 flex gap-3 mt-4">
                                                <a href="{{ route('histories.show', $history->id) }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="30"
                                                        height="30" viewBox="0 0 24 24">
                                                        <path fill="#6c80e4" fill-rule="evenodd"
                                                            d="M12 17.8c4.034 0 7.686-2.25 9.648-5.8C19.686 8.45 16.034 6.2 12 6.2S4.314 8.45 2.352 12c1.962 3.55 5.614 5.8 9.648 5.8M12 5c4.808 0 8.972 2.848 11 7c-2.028 4.152-6.192 7-11 7s-8.972-2.848-11-7c2.028-4.152 6.192-7 11-7m0 9.8a2.8 2.8 0 1 0 0-5.6a2.8 2.8 0 0 0 0 5.6m0 1.2a4 4 0 1 1 0-8a4 4 0 0 1 0 8" />
                                                    </svg>
                                                </a>

                                                <form id="delete-form-{{ $history->id }}"
                                                    action="{{ route('histories.destroy', $history->id) }}"
                                                    method="POST"
                                                    onsubmit="return confirm('Are you sure you want to delete this category?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="30"
                                                        height="30" viewBox="0 0 24 24"
                                                        class="cursor-pointer hover:fill-red-700 transition duration-200"
                                                        onclick="confirmDelete({{ $history->id }})">
                                                        <path fill="red"
                                                            d="M19 4h-3.5l-1-1h-5l-1 1H5v2h14M6 19a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V7H6z" />
                                                    </svg>
                                                </form>

                                            </td>
                        </tr>
                    `;
                            tableBody.innerHTML += row;
                        });
                }
                else {
                    tableBody.innerHTML = <
                        tr > < td colspan = "7"
                    class = "text-center" > No data available < /td></tr > ;
                }
            })
        .catch(error => console.error('Error:', error));
        });
    </script>



    {{-- DataTables --}}
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/2.1.8/js/dataTables.min.js"></script>

    {{-- BulkDelete script --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const selectedIds = new Set();
            const allIds = @json($histories->pluck('id')); // Laravel mengirimkan seluruh ID
            const selectAll = document.getElementById('select-all');
            const bulkDeleteButton = document.getElementById('bulkDeleteButton');

            // Inisialisasi DataTable
            const table = new DataTable('#myTable', {
                ordering: false
            });

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
                        fetch('{{ route('histories.bulkDelete') }}', {
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
