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
                            <a href="{{ route('histories.index') }}" class="text-amber-400 hover:underline">Back</a> /
                            <a href="/staff/dashboard" class="hover:underline text-zinc-950">Home</a>
                        </h2>

                        <!-- Kontainer Tabel -->
                        <div id="printArea" class="w-full max-w-4xl bg-white shadow-lg rounded-lg p-6">
                            <!-- Detail Pemesan -->
                            <div class="mb-4">
                                <label class="block text-gray-700 font-semibold">Nama Pemesan:</label>
                                <input type="text" value="{{ $history->customer_name }}"
                                    class="w-full p-2 border rounded-md bg-gray-100 text-zinc-900" readonly>
                            </div>

                            <div class="mb-4">
                                <label class="block text-gray-700 font-semibold">Nama Kasir:</label>
                                <input type="text" value="{{ $history->casier_name }}"
                                    class="w-full p-2 border rounded-md bg-gray-100 text-zinc-900" readonly>
                            </div>

                            <!-- Tabel Pesanan -->
                            <div class="overflow-x-auto shadow-md">
                                <table class="table-auto border-collapse w-full text-left shadow-md rounded-md">
                                    <tbody class="bg-gray-50">
                                        @foreach ($products as $product)
                                            <tr class="hover:bg-gray-200">
                                                <td class="px-6 py-4 text-sm text-gray-900">#{{ $history->id }}</td>
                                                <td class="px-6 py-4 text-sm">
                                                    <img src="{{ Storage::url($product['gambar_menu']) }}"
                                                        class="w-20 h-20 object-cover rounded-md" alt="Gambar Product">
                                                </td>
                                                <td class="px-6 py-4 text-sm text-gray-900">
                                                    {{ $product['nama_menu'] }}
                                                </td>
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
                                <textarea class="w-full p-2 border rounded-md bg-gray-100 text-zinc-950" readonly>Rp {{ number_format($history->total_price, 0, ',', '.') }}</textarea>
                            </div>

                            <!-- Catatan -->
                            <div class="mt-4">
                                <label class="block text-gray-700 font-semibold">Catatan:</label>
                                <textarea class="w-full p-2 border rounded-md bg-gray-100 text-zinc-950" readonly>{{ $history->request }}</textarea>
                            </div>

                            <!-- Metode Pembayaran -->
                            <div class="mt-4">
                                <label class="block text-gray-700 font-semibold">Metode Pembayaran:</label>
                                <input type="text" value="{{ $history->payment_method }}"
                                    class="w-full p-2 border rounded-md bg-gray-100 text-zinc-950" readonly>
                            </div>

                            <div class="mt-4">
                                <label class="block text-gray-700 font-semibold">Phone Number:</label>
                                <a href="https://wa.me/{{ $history->customer_phone }}" target="_blank">
                                    <input type="text" value="{{ $history->customer_phone }}"
                                        class="w-full p-2 border rounded-md bg-gray-100 text-zinc-950 cursor-pointer"
                                        readonly>
                                </a>
                            </div>
                            <div class="mt-11 flex justify-items-end">
                                <a href="#" id="printButton"
                                    class="bg-green-700 text-white py-2 px-4 rounded-md hover:bg-green-600 shadow-lg">
                                    <img src="{{ asset('asset-view/assets/svg/export.svg') }}"
                                        class="w-5 h-5 inline-block mr-2">
                                    Print
                                </a>
                            </div>
                        </div>
                        {{-- Print Display --}}
                        <div id="printDisplay" class="hidden">
                            <div class="flex justify-center items-center h-screen m-0 bg-gray-200 text-gray-900">
                                <div class="rounded-md relative w-72 shadow-2xl p-3 bg-white">
                                    <div class="py-2">
                                        <div class="text-center text-xl font-bold">ORDER</div>
                                        <div class="text-center text-xs font-bold">Order details</div>
                                    </div>
                                    <div class="text-center text-xs font-bold mb-1">~~~~~~~~~~~~~~~~~~~~~~~~~~~~</div>
                                    <div class="text-xs pl-2">
                                        <div class="text-xs mb-1">Customer：{{ $history->customer_name }}</div>
                                        <div class="text-xs mb-1">TelePhone：{{ $history->customer_phone }}</div>
                                        <div class="text-xs mb-1">Casier：{{ $history->casier_name }}</div>
                                        <div>OrderNumber：#{{ $history->id }}</div>
                                    </div>
                                    <div class="border-double border-t-4 border-b-4 border-gray-900 my-3">
                                        <div class="flex text-sm pt-1 px-1">
                                            <span class="w-2/6">Name</span>
                                            <span class="w-2/6 text-right">Price</span>
                                            <span class="w-2/6 text-right">QTY</span>
                                        </div>
                                        <div
                                            class="border-dashed border-t border-b border-gray-900 mt-1 my-2 py-2 px-1">
                                            @foreach ($products as $product)
                                                <div class="flex justify-between text-sm">
                                                    <span class="w-2/6 truncate">{{ $product['nama_menu'] }}</span>
                                                    <span class="w-2/6 text-right">
                                                        Rp{{ number_format($product['price'], 0, ',', '.') }}
                                                    </span>
                                                    <span class="w-2/6 text-right">{{ $product['quantity'] }}</span>
                                                </div>
                                            @endforeach
                                            <!-- Jika ada produk lain, tambahkan di sini -->
                                        </div>
                                    </div>
                                    <div class="text-xs">
                                        <div class="mb-1">Discount：Rp0</div>
                                        <div class="mb-52">Remark：--</div>
                                        <div class="text-right">
                                            <div>Time： {{ $history->created_at->format('d/m/y') }}
                                            </div>
                                            <div class="font-bold text-sm">Total：
                                                Rp{{ number_format($history->total_price, 0, ',', '.') }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
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

    <script>
        document.getElementById('printButton').addEventListener('click', function(event) {
            event.preventDefault();

            // Hide web display
            document.getElementById('printArea').classList.add('hidden');
            document.getElementById('printDisplay').classList.remove('hidden')

            // Print
            window.print();

            // return web display
            document.getElementById('printArea').classList.remove('hidden');
            document.getElementById('printDisplay').classList.add('hidden');
        });
    </script>
</body>

</html>
