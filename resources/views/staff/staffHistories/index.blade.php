<x-staff.header></x-staff.header>

<body>
    <div x-data="setup()" x-init="$refs.loading.classList.add('hidden');
    setColors(color);" :class="{ 'dark': isDark }">
        <div class="flex h-screen antialiased text-gray-950 bg-prime dark:text-light">
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
                    <div class="flex flex-col items-center justify-center min-h-full bg-prime px-4 py-4">
                        <!-- Tombol View on GitHub -->
                        <!-- Tabel -->
                        {{-- <div class="mb-4 mt-3">
                            <a href="{{ route('admin.histories.export') }}?{{ http_build_query(request()->all()) }}"
                                id="exportExcel"
                                class="bg-green-700 text-white py-2 px-4 rounded-md hover:bg-green-600">
                                Export Excel
                            </a>
                        </div> --}}
                        <div class="mb-4 mt-3 flex justify-end w-full max-w-6xl">
                            <a href="{{ route('histories.today') }}"
                                class="bg-green-700 text-white py-2 px-4 rounded-md hover:bg-green-600 shadow-lg">
                                <img src="{{ asset('asset-view/assets/svg/export.svg') }}"
                                    class="w-5 h-5 inline-block mr-2">
                                Export
                            </a>
                        </div>
                        <div class="w-full max-w-6xl overflow-x-auto text-zinc-950">
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
                                    @foreach ($histories as $index => $history)
                                        <tr>
                                            <td class="px-4 py-2 text-sm">#{{ $index + 1 }}</td>
                                            <td class="px-4 py-2 text-sm">{{ $history->casier_name }}</td>
                                            <td class="px-4 py-2 text-sm">{{ $history->customer_name }}</td>
                                            <td class="px-4 py-2 text-sm">{{ $history->created_at->format('d/m/y') }}
                                            </td>
                                            <td class="px-4 py-2 text-sm">Rp
                                                {{ number_format($history->total_price, 2) }}</td>
                                            <td class="px-4 py-2 text-sm">{{ $history->payment_method }}</td>
                                            <td class="px-4 py-2 text-sm">
                                                <span
                                                    class="
                                                    {{ $history->status == 'Cancelled' ? 'text-red-700 font-extrabold' : '' }}">
                                                    {{ $history->status }}
                                                </span>
                                            </td>
                                            <td
                                                class="px-4
                                                    py-2 text-sm">
                                                @if ($history->payment_method === 'nonTunai')
                                                    <a href="{{ Storage::url($history->payment_photo) }}"
                                                        target="_blank">
                                                        <button
                                                            class="bg-blue-500 text-white px-4 py-2 rounded-md text-xs">File</button>
                                                    </a>
                                                @else
                                                    <p class="text-center">-</p>
                                                @endif
                                            </td>
                                            <td class="px-4 py-2 text-sm flex justify-evenly items-center">
                                                <a href="{{ route('staffHistories.show', $history->id) }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                        height="24" viewBox="0 0 24 24">
                                                        <path fill="#6c80e4"
                                                            d="M12 17.8c4.034 0 7.686-2.25 9.648-5.8C19.686 8.45 16.034 6.2 12 6.2S4.314 8.45 2.352 12c1.962 3.55 5.614 5.8 9.648 5.8M12 5c4.808 0 8.972 2.848 11 7c-2.028 4.152-6.192 7-11 7s-8.972-2.848-11-7c2.028-4.152 6.192-7 11-7m0 9.8a2.8 2.8 0 1 0 0-5.6a2.8 2.8 0 0 0 0 5.6m0 1.2a4 4 0 1 1 0-8a4 4 0 0 1 0 8" />
                                                    </svg>
                                                </a>
                                                {{-- ini untuk cetak struk --}}
                                                <a href="javascript:void(0);"
                                                    onclick="printReceipt({{ $history->id }})"><svg width="42"
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

                                            </td>
                                        </tr>
                                    @endforeach
                                    {{-- <tr>
                                            <td class="text-center py-4">No data available for the
                                                selected filters.</td>
                                        </tr> --}}
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

    {{-- Script cetak struck --}}
    <script>
        function printReceipt(id) {
            fetch(`/staff/histories/print-struk/${id}`, {
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

            const url = `/export-histories?year=${year}&month=${month}&day=${day}`;
            window.location.href = url;
        });
    </script> --}}

    {{-- <script>
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
                                    <td class="px-6 py-4 font-medium text-sm text-zinc-950">${history.casier_name}</td>
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
    </script> --}}

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
