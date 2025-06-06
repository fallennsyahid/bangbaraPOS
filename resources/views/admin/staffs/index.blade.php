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
                        <h1 class="text-2xl font-semibold text-zinc-950">Manage Staffs</h1>

                    </div>


                    <!-- Content -->
                    <div class="flex flex-col items-center justify-center min-h-full bg-prime px-4 py-4">
                        <!-- Tombol View on GitHub -->
                        <div class="mb-6 flex justify-end w-full max-w-6xl gap-3">
                            <a href="{{ route('staffs.create') }}"
                                class="px-4 py-2 text-sm text-zinc-950 font-semibold shadow-xl rounded-md bg-[#B0B0B0] hover:bg-thead focus:outline-none focus:ring focus:ring-primary focus:ring-offset-1 focus:ring-offset-white dark:focus:ring-offset-dark">
                                Create +
                            </a>

                            <!-- Tabel -->
                            <a href="{{ route('users.export') }}"
                                class="bg-green-600 text-white flex items-center py-2 px-4 rounded-md hover:bg-green-500 shadow-lg">
                                <img src="{{ asset('asset-view/assets/svg/export.svg') }}" class="w-5 h-5 mr-2">
                                Export
                            </a>
                        </div>
                        <div class="w-full max-w-6xl overflow-x-auto text-zinc-950">
                            <table class="table-auto border-collapse w-full text-left shadow-lg rounded-md"
                                id="myTable">
                                <!-- Header -->
                                <thead class="bg-thead text-white shadow-md">
                                    <tr>
                                        <th class="px-6 py-3 text-sm font-bold uppercase tracking-wide text-zinc-950">ID
                                        </th>
                                        <th class="px-6 py-3 text-sm font-bold uppercase tracking-wide text-zinc-950">
                                            Avatar</th>
                                        </th>
                                        <th class="px-6 py-3 text-sm font-bold uppercase tracking-wide text-zinc-950">
                                            Name</th>
                                        <th class="px-6 py-3 text-sm font-bold uppercase tracking-wide text-zinc-950">
                                            Email</th>
                                        <th class="px-6 py-3 text-sm font-bold uppercase tracking-wide text-zinc-950">
                                            Phone</th>
                                        <th class="px-6 py-3 text-sm font-bold uppercase tracking-wide text-zinc-950">
                                            Role</th>
                                        <th class="px-6 py-3 text-sm font-bold uppercase tracking-wide text-zinc-950">
                                            Since</th>
                                        <th class="px-6 py-3 text-sm font-bold uppercase tracking-wide text-zinc-950">
                                            Aksi</th>
                                    </tr>
                                </thead>

                                <!-- Body -->
                                <tbody class="bg-tbody" id="productTable">
                                    @foreach ($users as $index => $user)
                                        <tr class="hover:bg-thead">
                                            <td class="px-6 py-4 font-medium text-sm text-zinc-950">#{{ $index + 1 }}
                                            </td>
                                            <td class="px-6 py-4 font-medium text-sm text-zinc-950">
                                                <img src="{{ $user->avatar }}" alt="Avatar"
                                                    class="w-10 h-10 rounded-full">
                                            </td>
                                            <td class="px-6 py-4 font-medium text-sm text-zinc-950">
                                                {{ $user->name }}
                                            </td>
                                            <td class="px-6 py-4 font-medium text-sm text-zinc-950">
                                                {{ $user->email }}
                                            </td>
                                            <td class="px-6 py-4 font-medium text-sm text-zinc-950">
                                                {{ $user->phone_number }}
                                            </td>
                                            <td class="px-6 py-4 font-medium text-sm text-zinc-950">
                                                {{ $user->usertype }}
                                            </td>
                                            <td class="px-6 py-4 font-medium text-sm text-zinc-950">
                                                {{ $user->created_at->format('d/m/y') }}

                                            </td>
                                            <td class="px-6 py-4 flex gap-3 mt-4">

                                                <a href="{{ route('staffs.show', $user->id) }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="30"
                                                        height="30" viewBox="0 0 24 24">
                                                        <path fill="#6c80e4" fill-rule="evenodd"
                                                            d="M12 17.8c4.034 0 7.686-2.25 9.648-5.8C19.686 8.45 16.034 6.2 12 6.2S4.314 8.45 2.352 12c1.962 3.55 5.614 5.8 9.648 5.8M12 5c4.808 0 8.972 2.848 11 7c-2.028 4.152-6.192 7-11 7s-8.972-2.848-11-7c2.028-4.152 6.192-7 11-7m0 9.8a2.8 2.8 0 1 0 0-5.6a2.8 2.8 0 0 0 0 5.6m0 1.2a4 4 0 1 1 0-8a4 4 0 0 1 0 8" />
                                                    </svg>
                                                </a>

                                                {{-- @if ($user->usertype !== 'admin')
                                                    <a href="{{ route('staffs.edit', $user->id) }}">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="30"
                                                            height="30" viewBox="0 0 24 24">
                                                            <g fill="none" stroke="#28A745" stroke-linecap="round"
                                                                stroke-linejoin="round" stroke-width="2">
                                                                <path
                                                                    d="M7 7H6a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2-2v-1" />
                                                                <path
                                                                    d="M20.385 6.585a2.1 2.1 0 0 0-2.97-2.97L9 12v3h3zM16 5l3 3" />
                                                            </g>
                                                        </svg>
                                                    </a>
                                                @endif --}}

                                                <form id="delete-form-{{ $user->id }}"
                                                    action="{{ route('staffs.destroy', $user->id) }}" method="POST"
                                                    onsubmit="return confirm('Are you sure you want to delete this category?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="30"
                                                        height="30" viewBox="0 0 24 24"
                                                        class="cursor-pointer hover:fill-red-700 transition duration-200"
                                                        onclick="confirmDelete({{ $user->id }})">
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
            </div>

            <x-admin.panel-content></x-admin.panel-content>
        </div>
    </div>

    <!-- All javascript code in this project for now is just for demo DON'T RELY ON IT  -->
    <x-admin.js></x-admin.js>
    {{-- Confirm Alert --}}
    <script>
        function confirmDelete(userId) {
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
                    document.getElementById("delete-form-" + userId).submit();
                }
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
