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
                        <h1 class="text-2xl font-semibold text-zinc-950">Order Details</h1>
                        <x-staff.waButton></x-staff.waButton>
                    </div>


                    <!-- Content -->
                    <div class="flex flex-col items-center justify-center min-h-screen bg-prime px-4 py-4">
                        <!-- Navigasi -->
                        <h2 class="mb-4">
                            <a href="{{ route('staffOrders.index') }}" class="text-amber-400 hover:underline">Back</a> /
                            <a href="/staff/dashboard" class="hover:underline text-zinc-950">Home</a>
                        </h2>

                        <!-- Kontainer Tabel -->
                        <div class="w-full max-w-4xl bg-white shadow-lg rounded-lg p-6">
                            <!-- Detail Pemesan -->
                            <div class="mb-4">
                                <label class="block text-gray-700 font-semibold">Nama Pemesan:</label>
                                <input type="text" value="{{ $order->customer_name }}"
                                    class="w-full p-2 border rounded-md bg-gray-100 text-zinc-900" readonly>
                            </div>

                            <!-- Tabel Pesanan -->
                            <div class="overflow-x-auto shadow-md">
                                <table class="table-auto border-collapse w-full text-left shadow-md rounded-md">
                                    <tbody class="bg-gray-50">
                                        <tr class="hover:bg-gray-200">
                                            <td class="px-6 py-4 text-sm text-gray-900">#{{ $order->id }}</td>
                                            <td class="px-6 py-4 text-sm">
                                                <img src="{{ Storage::url($order->product->gambar_menu) }}"
                                                    class="w-20 h-20 object-cover rounded-md" alt="Gambar Product">
                                            </td>
                                            <td class="px-6 py-4 text-sm text-gray-900">{{ $order->product->nama_menu }}
                                            </td>
                                            <td class="px-6 py-4 text-sm text-gray-900">
                                                {{ $order->product->category->nama_kategori }}</td>
                                            <td class="px-6 py-4 text-sm text-gray-900">
                                                {{ $order->product->harga_menu }}
                                            </td>
                                            <td class="px-6 py-4 text-sm text-gray-900">{{ $order->quantity }}X</td>
                                            <td class="px-6 py-4 text-sm text-gray-900">{{ $order->total_price }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <!-- Catatan -->
                            <div class="mt-4">
                                <label class="block text-gray-700 font-semibold">Catatan:</label>
                                <textarea class="w-full p-2 border rounded-md bg-gray-100 text-zinc-950" readonly>{{ $order->request }}</textarea>
                            </div>

                            <!-- Metode Pembayaran -->
                            <div class="mt-4">
                                <label class="block text-gray-700 font-semibold">Metode Pembayaran:</label>
                                <input type="text" value="{{ $order->payment_method }}"
                                    class="w-full p-2 border rounded-md bg-gray-100 text-zinc-950" readonly>
                            </div>
                            <!-- No Telp -->
                            <div class="mt-4">
                                <label class="block text-gray-700 font-semibold">No Telp:</label>
                                <input type="text" value="{{ $order->customer_phone }}"
                                    class="w-full p-2 border rounded-md bg-gray-100 text-zinc-950" readonly>
                            </div>
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
    {{-- DataTables --}}


</body>

</html>
