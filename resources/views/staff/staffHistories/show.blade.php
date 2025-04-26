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
                        <h1 class="text-2xl font-semibold text-zinc-950">Order Details</h1>
                    </div>


                    <!-- Content -->
                    <div class="flex flex-col items-center justify-center min-h-full bg-prime px-4 py-4">
                        <!-- Navigasi -->
                        <h2 class="mb-4">
                            <a href="{{ route('staffHistories.index') }}"
                                class="text-amber-400 hover:underline">Back</a> /
                            <a href="/staff/dashboard" class="hover:underline text-zinc-950">Home</a>
                        </h2>

                        <!-- Kontainer Tabel -->
                        <div id="printArea" class="w-full max-w-6xl bg-white shadow-lg rounded-lg p-6">
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

                            <!-- Opsi layanan -->
                            <div class="mt-4">
                                <label class="block text-gray-700 font-semibold">Layanan:</label>
                                <input type="text" value="{{ $history->serve_option }}"
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
