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
                        <h1 class="text-2xl font-semibold text-zinc-950">Order Details</h1>
                    </div>

                    <!-- Content -->
                    <div class="flex flex-col items-center justify-center min-h-full bg-prime px-4 py-4">
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

                            <div class="mb-4">
                                <label class="block text-gray-700 font-semibold">Nama Kasir:</label>
                                <input type="text" value="{{ $order->casier_name }}"
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

<<<<<<< HEAD
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
=======
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
                                        <div class="text-xs mb-1">Customer：{{ $order->customer_name }}</div>
                                        <div class="text-xs mb-1">Casier：{{ $order->casier_name }}</div>
                                        <div>OrderNumber：#{{ $order->id }}</div>
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
                                            <div>Time： {{ $order->created_at->format('d/m/y') }}
                                            </div>
                                            <div class="font-bold text-sm">Total：
                                                Rp{{ number_format($order->total_price, 0, ',', '.') }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
>>>>>>> ba63282505d71938bef16983cb1dcd840224129c
                            </div>
                        </div>
                    </div>
                </main>
            </div>

            <x-admin.panel-content></x-admin.panel-content>
        </div>
    </div>

    <!-- Tidak memuat script window.print() karena pencetakan dilakukan di sisi server -->
    <x-admin.js></x-admin.js>
</body>

</html>
