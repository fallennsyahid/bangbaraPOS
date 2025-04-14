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
                        <h1 class="text-2xl font-semibold text-zinc-950">Order Details</h1>
                        <x-admin.waButton></x-admin.waButton>
                    </div>

                    <!-- Content -->
                    <div class="flex flex-col items-center justify-center min-h-screen bg-prime px-4 py-4">
                        <!-- Navigasi -->
                        <h2 class="mb-4">
                            <a href="{{ route('orders.index') }}" class="text-amber-400 hover:underline">Back</a> /
                            <a href="/admin/dashboard" class="hover:underline text-zinc-950">Home</a>
                        </h2>

                        <!-- Kontainer Tabel -->
                        <div id="printArea" class="w-full max-w-6xl bg-white shadow-lg rounded-lg p-6">
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
                                        @foreach ($products as $product)
                                            <tr class="hover:bg-gray-200">
                                                <td class="px-6 py-4 text-sm text-gray-900">#{{ $order->id }}</td>
                                                <td class="px-6 py-4 text-sm">
                                                    <img src="{{ Storage::url($product['gambar_menu']) }}"
                                                        class="w-20 h-20 object-cover rounded-md" alt="Gambar Product">
                                                </td>
                                                <td class="px-6 py-4 text-sm text-gray-900">{{ $product['nama_menu'] }}
                                                </td>
                                                @if ($product['category'] == 'Makanan')
                                                    <td class="px-6 py-4 text-sm text-gray-900">
                                                        {{ $product['sauce'] ?? '-' }}
                                                    </td>
                                                @else
                                                    <td class="px-6 py-4 text-sm text-gray-900">
                                                        {{ $product['hot_ice'] ?? '-' }}
                                                    </td>
                                                @endif
                                                <td class="px-6 py-4 text-sm text-gray-900">
                                                    Rp{{ number_format($product['price'], 0, ',', '.') }}
                                                </td>
                                                <td class="px-6 py-4 text-sm text-gray-900">{{ $product['quantity'] }}X
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <!-- Total Price -->
                            <div class="mt-4">
                                <label class="block text-gray-700 font-semibold">Total:</label>
                                <textarea class="w-full p-2 border rounded-md bg-gray-100 text-zinc-950" readonly>
Rp{{ number_format($order->total_price, 0, ',', '.') }}
                                </textarea>
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

                            <!-- Phone Number -->
                            <div class="mt-4">
                                <label class="block text-gray-700 font-semibold">Phone Number:</label>
                                <a href="https://wa.me/{{ $order->customer_phone }}" target="_blank">
                                    <input type="text" value="{{ $order->customer_phone }}"
                                        class="w-full p-2 border rounded-md bg-gray-100 text-zinc-950 cursor-pointer"
                                        readonly>
                                </a>
                            </div>

                            <!-- Tombol Cetak Struk -->
                            <div class="mt-11 flex justify-end">
                                <!-- Tombol print: menggunakan method POST onClick -->
                                <form action="" method="POST">
                                    @csrf
                                    <button type="submit"
                                        class="bg-green-700 text-white py-2 px-4 rounded-md hover:bg-green-600 shadow-lg inline-flex items-center">
                                        <img src="{{ asset('asset-view/assets/svg/export.svg') }}"
                                            class="w-5 h-5 inline-block mr-2" alt="Icon Print">
                                        Print
                                    </button>
                                </form>
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

    <!-- Tidak memuat script window.print() karena pencetakan dilakukan di sisi server -->
    <x-admin.js></x-admin.js>
</body>

</html>
