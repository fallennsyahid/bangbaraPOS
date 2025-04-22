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
                        <h1 class="text-2xl font-semibold text-zinc-950">Reviews</h1>
                    </div>


                    <!-- Content -->
                    <div class="flex flex-col items-center justify-center min-h-full bg-prime px-4 py-4">
                        <div class="w-full max-w-6xl overflow-x-auto text-zinc-950">
                            <div class="mb-4 mt-3 py-2 flex justify-end">
                                <button id="bulkDeleteButton"
                                    class="bg-red-700 text-white px-4 py-2 rounded-lg hidden">Delete
                                    Selected</button>
                            </div>
                            {{-- <table class="table-auto border-collapse w-full text-left shadow-lg rounded-md"
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
                                            Username
                                        </th>
                                        <th class="px-6 py-3 text-sm font-bold uppercase tracking-wide text-zinc-950">
                                            Message
                                        </th>
                                        <th class="px-6 py-3 text-sm font-bold uppercase tracking-wide text-zinc-950">
                                            Rating
                                        </th>
                                        <th class="px-6 py-3 text-sm font-bold uppercase tracking-wide text-zinc-950">
                                            Time
                                        </th>
                                        <th class="px-6 py-3 text-sm font-bold uppercase tracking-wide text-zinc-950">
                                            Aksi
                                        </th>
                                    </tr>
                                </thead>

                                <!-- Body -->
                                <tbody class="bg-tbody" id="productTable">
                                    @foreach ($reviews as $index => $row)
                                        <tr class="hover:bg-thead">
                                            <td class="px-6 py-4 font-medium text-sm text-zinc-950">
                                                <input type="checkbox" class="select-item" value="{{ $row->id }}">

                                            </td>
                                            <td class="px-6 py-4 font-medium text-sm text-zinc-950">
                                                #{{ $index + 1 }}
                                            </td>
                                            <td class="px-6 py-4 font-medium text-sm text-zinc-950">
                                                {{ $row->username }}
                                            </td>
                                            <td class="px-6 py-4 font-medium text-sm text-zinc-950">
                                                {{ $row->message }}
                                            </td>
                                            <td class="px-6 py-4 font-medium text-sm text-zinc-950">
                                                {{ $row->rating }} Bintang
                                            </td>
                                            <td class="px-6 py-4 font-medium text-sm text-zinc-950">
                                                {{ $row->created_at->diffForHumans() }}
                                            </td>
                                            <td class="px-6 py-4 font-medium text-sm text-zinc-950">
                                                <form id="delete-form-{{ $row->id }}"
                                                    action="{{ route('reviews.destroy', $row->id) }}" method="POST"
                                                    onsubmit="return confirm('Are you sure you want to delete this category?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="30"
                                                        height="30" viewBox="0 0 24 24"
                                                        class="cursor-pointer hover:fill-red-700 transition duration-200"
                                                        onclick="confirmDelete({{ $row->id }})">
                                                        <path fill="red"
                                                            d="M19 4h-3.5l-1-1h-5l-1 1H5v2h14M6 19a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V7H6z" />
                                                    </svg>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table> --}}
                            <section>

                                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center p-4">
                                    @foreach ($reviews as $index => $row)
                                        <div
                                            class="space-y-4 bg-slate-100 px-0 py-6 border-2 border-slate-200 rounded-xl">
                                            <h5 class="text-lg font-semibold">{{ $row->username }}</h5>
                                            <p class="text-gray-600 px-6">
                                                {{ $row->message }}
                                            </p>
                                            <div class="flex justify-center space-x-1">
                                                @for ($i = 0; $i < $row->rating; $i++)
                                                    <img src="{{ asset('asset-admin/public/img/star-icon.svg') }}"
                                                        alt="">
                                                @endfor

                                            </div>
                                            <div
                                                class="border-t-2 border-slate-200 w-full pt-6 px-6 flex justify-between items-center">
                                                <span>{{ $row->created_at->diffForHumans() }}</span>
                                                <form id="delete-form-{{ $row->id }}"
                                                    action="{{ route('reviews.destroy', $row->id) }}" method="POST"
                                                    onsubmit="return confirm('Are you sure you want to delete this category?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="30"
                                                        height="30" viewBox="0 0 24 24"
                                                        class="cursor-pointer hover:fill-red-700 transition duration-200"
                                                        onclick="confirmDelete({{ $row->id }})">
                                                        <path fill="red"
                                                            d="M19 4h-3.5l-1-1h-5l-1 1H5v2h14M6 19a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V7H6z" />
                                                    </svg>
                                                </form>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                {{ $reviews->links() }}
                            </section>

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

    {{-- DataTables --}}
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/2.1.8/js/dataTables.min.js"></script>

    {{-- BulkDelte Script --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const selectedIds = new Set();
            const allIds = @json($reviews->pluck('id')); // Laravel mengirimkan seluruh ID
            const selectAll = document.getElementById('select-all');
            const bulkDeleteButton = document.getElementById('bulkDeleteButton');

            // Inisialisasi DataTable
            const table = new DataTable('#myTable', {
                ordering: false
            });

            // function bulkDeleteButton display
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
                        fetch('{{ route('reviews.bulkDelete') }}', {
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
