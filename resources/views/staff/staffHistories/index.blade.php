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
                        <h1 class="text-2xl font-semibold text-zinc-950">Histories</h1>
                        <x-staff.waButton></x-staff.waButton>
                    </div>


                    <!-- Content -->
                    <div class="flex flex-col items-center justify-center min-h-screen bg-prime px-4 py-4">
                        <!-- Tombol View on GitHub -->
                        <!-- Tabel -->
                        {{-- <div class="mb-4 mt-3">
                            <a href="{{ route('admin.histories.export') }}?{{ http_build_query(request()->all()) }}"
                                id="exportExcel"
                                class="bg-green-700 text-white py-2 px-4 rounded-md hover:bg-green-600">
                                Export Excel
                            </a>
                        </div> --}}
                        <div class="mb-4 mt-3 flex justify-end w-full max-w-4xl">
                            <a href="{{ route('histories.today') }}"
                                class="bg-green-700 text-white py-2 px-4 rounded-md hover:bg-green-600 shadow-lg">
                                <img src="{{ asset('asset-view/assets/svg/export.svg') }}"
                                    class="w-5 h-5 inline-block mr-2">
                                Export
                            </a>
                        </div>
                        <div class="w-full max-w-4xl overflow-x-auto text-zinc-950">
                            <div class="flex mx-auto justify-between">
                            </div>
                            <table class="table-auto border-collapse w-full text-left shadow-lg rounded-md"
                                id="myTable">
                                <!-- Header -->
                                <thead class="bg-thead text-white shadow-md">
                                    <tr>
                                        <th class="px-6 py-3 text-sm font-bold uppercase tracking-wide text-zinc-950">ID
                                        </th>
                                        <th class="px-6 py-3 text-sm font-bold uppercase tracking-wide text-zinc-950">
                                            Casier</th>
                                        <th class="px-6 py-3 text-sm font-bold uppercase tracking-wide text-zinc-950">
                                            Costumer</th>
                                        <th class="px-6 py-3 text-sm font-bold uppercase tracking-wide text-zinc-950">
                                            Time</th>
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
                                            <td class="px-6 py-4 font-medium text-sm text-zinc-900">#{{ $index + 1 }}
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
                                                <a href="{{ route('staffHistories.show', $history->id) }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="30"
                                                        height="30" viewBox="0 0 24 24">
                                                        <path fill="#6c80e4" fill-rule="evenodd"
                                                            d="M12 17.8c4.034 0 7.686-2.25 9.648-5.8C19.686 8.45 16.034 6.2 12 6.2S4.314 8.45 2.352 12c1.962 3.55 5.614 5.8 9.648 5.8M12 5c4.808 0 8.972 2.848 11 7c-2.028 4.152-6.192 7-11 7s-8.972-2.848-11-7c2.028-4.152 6.192-7 11-7m0 9.8a2.8 2.8 0 1 0 0-5.6a2.8 2.8 0 0 0 0 5.6m0 1.2a4 4 0 1 1 0-8a4 4 0 0 1 0 8" />
                                                    </svg>
                                                </a>

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

    {{-- Script Tombol Export --}}
    {{-- <script>
        document.getElementById('exportExcel').addEventListener('click', () => {
            const year = document.getElementById('filter-year').value;
            const month = document.getElementById('filter-month').value;
            const day = document.getElementById('filter-day').value;

            const url = `/export-histories?year=${year}&month=${month}&day=${day}`;
            window.location.href = url;
        });
    </script> --}}

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const filters = document.querySelectorAll('#filter_year, #filter_month, #filter_day');
            const exportButton = document.getElementById('exportExcel');

            filters.forEach(filter => {
                filter.addEventListener('change', () => {
                    const year = document.getElementById('filter_year').value;
                    const month = document.getElementById('filter_month').value;
                    const day = document.getElementById('filter_day').value;

                    // Membuat URLSearchParams untuk query
                    const params = new URLSearchParams();
                    if (year) params.append('filter_year', year);
                    if (month) params.append('filter_month', month);
                    if (day) params.append('filter_day', day);

                    // Update URL untuk tombol export
                    const exportUrl = `/admin/histories/export?${params.toString()}`;
                    exportButton.setAttribute('href', exportUrl);

                    // Update data di tabel
                    const url = `/admin/histories?${params.toString()}`;

                    fetch(url, {
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest'
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            const tableBody = document.getElementById('productTable');
                            tableBody.innerHTML = ''; // Kosongkan tabel

                            if (data.histories && data.histories.length > 0) {
                                data.histories.forEach((history, index) => {
                                    tableBody.innerHTML += `
                                <tr class="hover:bg-thead" data-category="${history.id}">
                                    <td class="px-6 py-4 font-medium text-sm text-zinc-950">#${index + 1}</td>
                                    <td class="px-6 py-4 font-medium text-sm text-zinc-950">${history.customer_name}</td>
                                    <td class="px-6 py-4 font-medium text-sm text-zinc-950">${history.customer_phone}</td>
                                    <td class="px-6 py-4 font-medium text-sm text-zinc-950">Rp ${parseFloat(history.total_price).toLocaleString('id-ID', { minimumFractionDigits: 2 })}</td>
                                    <td class="px-6 py-4 font-medium text-sm text-zinc-950">${history.payment_method}</td>
                                    <td class="px-6 py-4 font-medium text-sm text-zinc-950"><a href="${history.payment_photo}">
                                                    <button class="bg-[#CA1100] rounded-md px-4 py-2">
                                                        <h5 class="text-xs font-semibold">Lihat File</h5>
                                                    </button>
                                                </a></td>
                                    <td class="px-6 py-4 flex gap-3 mt-4">
                                        <button class="bg-green-500 text-white text-sm px-4 py-2 rounded-md shadow-md hover:bg-green-600">
                                            <a href="/admin/histories/${history.id}">Detail</a>
                                        </button>
                                    </td>
                                </tr>
                            `;
                                });
                            } else {
                                tableBody.innerHTML = `
                            <tr>
                                <td colspan="7" class="text-center py-4">No data available for the selected filters.</td>
                            </tr>
                        `;
                            }
                        })
                        .catch(error => console.error('Error:', error));
                });
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
