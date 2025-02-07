<x-layout-view>
    {{-- Hero Section Start --}}
    <section class="relative h-[50vh] header-cart">
        <div class="absolute inset-0 bg-black/40 flex flex-col items-center justify-center">
            <h1 class="text-white text-4xl font-bold">Cart</h1>
            <p class="text-white cursor-pointer">
                Back /
                <a href="{{ route('index') }}"><span class="text-rose-400 hover:underline">Home</span></a>
            </p>
        </div>
    </section>
    {{-- Hero Section End --}}

    <!--  Cart List Start  -->
    <section
        class="relative z-10 after:contents-[''] after:absolute after:z-0 after:h-full xl:after:w-1/3 after:top-0 after:right-0 after:bg-gray-50">
        <div class="w-full max-w-7xl px-4 md:px-5 lg-6 mx-auto relative z-10">
            <div class="grid grid-cols-12">
                <!-- Shopping Cart Section -->
                <div
                    class="col-span-12 xl:col-span-8 lg:pr-8 pt-14 pb-8 lg:py-24 w-full max-xl:max-w-3xl max-xl:mx-auto">
                    <!-- Header -->
                    <div class="flex items-center justify-between pb-8 border-b border-gray-300">
                        <h2 class="font-manrope font-bold text-3xl leading-10 text-black">
                            Shopping Cart
                        </h2>
                        <h2 class="font-manrope font-bold text-xl leading-8 text-gray-600">
                            1 Items
                        </h2>
                    </div>

                    <!-- Product Details Header -->
                    <div class="grid grid-cols-12 mt-8 max-md:hidden pb-6 border-b border-gray-200">
                        <div class="col-span-12 md:col-span-7">
                            <p class="font-normal text-lg leading-8 text-gray-400">
                                Product Details
                            </p>
                        </div>
                        <div class="col-span-12 md:col-span-5">
                            <div class="grid grid-cols-5">
                                <div class="col-span-3">
                                    <p class="font-normal text-lg leading-8 text-gray-400 text-center">
                                        Quantity
                                    </p>
                                </div>
                                <div class="col-span-2">
                                    <p class="font-normal text-lg leading-8 text-gray-400 text-center">
                                        Total
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Product Item -->
                    <div
                        class="flex flex-col min-[500px]:flex-row min-[500px]:items-center gap-5 py-6 border-b border-gray-200 group">
                        <div class="w-full max-w-[126px] sm:justify-center">
                            <img src="{{ asset('asset-view/assets/png/food/1.png') }}" alt=""
                                class="mx-auto rounded-xl object-cover" />
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-4 w-full">
                            <div class="md:col-span-2">
                                <div class="flex flex-col max-[500px]:items-center gap-3">
                                    <h6 class="font-semibold text-base leading-7 text-black">
                                        Steak
                                    </h6>
                                    <h6 class="font-normal text-base leading-7 text-gray-500">
                                        Makanan
                                    </h6>
                                    <h6
                                        class="font-medium text-base leading-7 text-gray-600 transition-all duration-300 group-hover:text-rose-300">
                                        Rp 86.000,00
                                    </h6>
                                </div>
                            </div>
                            <div class="flex items-center max-[500px]:justify-center h-full max-md:mt-3">
                                <div class="flex items-center justify-center h-full">
                                    <form action="#" method="POST" style="display: inline">
                                        {{-- <input type="hidden" name="id" value="{{ $item->product->id }}" /> --}}
                                        <input type="hidden" name="id" value="" />
                                        {{-- <button type="submit" name="quantity" value="{{ $item->quantity - 1 }}" --}}
                                        <button type="submit" name="quantity" value=""
                                            class="group rounded-l-xl px-5 py-[18px] border border-gray-200 flex items-center justify-center shadow-sm transition-all duration-500 hover:bg-gray-50 hover:border-gray-300 focus-within:outline-gray-300">
                                            <svg class="stroke-gray-900 transition-all duration-500 group-hover:stroke-black"
                                                xmlns="http://www.w3.org/2000/svg" width="22" height="22"
                                                viewBox="0 0 22 22" fill="none">
                                                <path d="M16.5 11H5.5" stroke-width="1.6" stroke-linecap="round" />
                                            </svg>
                                        </button>
                                    </form>
                                    <input type="text"
                                        class="border-y border-gray-200 outline-none text-gray-900 font-semibold text-lg w-full max-w-[73px] min-w-[60px] text-center bg-transparent"
                                        value="2" readonly />
                                    <form action="" method="POST" style="display: inline">
                                        {{-- <input type="hidden" name="id" value="{{ $item->product->id }}" /> --}}
                                        <input type="hidden" name="id" value="" />
                                        {{-- <button type="submit" name="quantity" value="{{ $item->quantity + 1 }}" --}}
                                        <button type="submit" name="quantity" value=""
                                            class="group rounded-r-xl px-5 py-[18px] border border-gray-200 flex items-center justify-center shadow-sm transition-all duration-500 hover:bg-gray-50 hover:border-gray-300 focus-within:outline-gray-300">
                                            <svg class="stroke-gray-900 transition-all duration-500 group-hover:stroke-black"
                                                xmlns="http://www.w3.org/2000/svg" width="22" height="22"
                                                viewBox="0 0 22 22" fill="none">
                                                <path d="M11 5.5V16.5M16.5 11H5.5" stroke-width="1.6"
                                                    stroke-linecap="round" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </div>
                            <div class="flex items-center max-[500px]:justify-center md:justify-end max-md:mt-3 h-full">
                                <p
                                    class="font-bold text-lg leading-8 text-gray-600 text-center transition-all duration-300 group-hover:text-rose-300">
                                    Rp 86.000,00
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Total Price -->
                    <div class="flex justify-end mt-4">
                        <h3 class="font-bold text-xl">Total: Rp 90.000,00</h3>
                    </div>
                </div>

                <!-- Order Summary Section -->
                <div
                    class="col-span-12 xl:col-span-4 bg-gray-50 w-full max-xl:px-6 max-w-3xl xl:max-w-lg mx-auto lg:pl-8 py-24">
                    <h2 class="font-manrope font-bold text-3xl leading-10 text-black pb-8 border-b border-gray-300">
                        Order Summary
                    </h2>

                    <!-- Order Details -->
                    <div class="mt-8">
                        <div class="flex items-center justify-between pb-6">
                            <p class="font-normal text-lg leading-8 text-black">1 Items</p>
                            <p class="font-medium text-lg leading-8 text-black">
                                Rp 90.000,00
                            </p>
                        </div>

                        <form action="" method="POST">
                            <div class="relative">
                                <!-- Nama -->
                                <label for="nama" class="block mb-2 font-medium text-base">
                                    Masukkan nama Anda
                                </label>
                                <input type="text" placeholder="contoh: Atas nama Rendi"
                                    class="w-full border border-gray-300 rounded-lg pr-16 px-3 py-3 font-alkatra font-normal focus:ring-gray-400 focus:border-gray-400 focus:shadow-lg" />

                                <!-- No Telp -->
                                <label for="nama" class="block mt-4 mb-2 font-medium text-base">
                                    Masukkan nomor telepon
                                </label>
                                <input type="number" placeholder="contoh: +62"
                                    class="input-number w-full border border-gray-300 rounded-lg pr-16 px-3 py-3 font-alkatra font-normal focus:ring-gray-400 focus:border-gray-400 focus:shadow-lg" />

                                <!-- Promo Code -->
                                <label for="promo-code" class="block mt-4 mb-2 font-medium text-base">
                                    Kode Promo
                                    <span> (Jika Ada)</span>
                                </label>
                                <div class="relative mb-4">
                                    <input type="text" id="promo-code" placeholder="x5612"
                                        class="w-full border border-gray-300 rounded-lg pr-16 px-3 py-3 font-alkatra font-normal text-base focus:ring-gray-400 focus:border-gray-400 focus:shadow-lg" />
                                    <button
                                        class="absolute h-full right-0 bg-black text-white font-alkatra px-3 py-1 rounded-r-lg transition duration-300 ease-in-out hover:opacity-80 focus:outline-none">
                                        Submit
                                    </button>
                                </div>

                                <!-- Note -->
                                <label for="" class="block mt-4 mb-2 font-medium text-base">
                                    Catatan
                                </label>
                                <div class="relative w-full flex items-center">
                                    <textarea name="message" id="message" rows="1"
                                        class="w-full border border-gray-300 rounded-lg px-3 py-3 mb-4 focus:ring-1 focus:ring-gray-400 focus:border-gray-400 placeholder:px-10"
                                        placeholder="Masukkan">
                                    </textarea>
                                    <svg width="32" height="32" viewBox="0 0 32 32" fill="none"
                                        xmlns="http://www.w3.org/2000/svg" class="flex absolute left-2.5 top-2"
                                        id="notebook">
                                        <path
                                            d="M23.3333 24.6667V27.3333C23.3333 27.5111 23.4 27.6667 23.5333 27.8C23.6667 27.9333 23.8222 28 24 28C24.1778 28 24.3333 27.9333 24.4667 27.8C24.6 27.6667 24.6667 27.5111 24.6667 27.3333V24.6667H27.3333C27.5111 24.6667 27.6667 24.6 27.8 24.4667C27.9333 24.3333 28 24.1778 28 24C28 23.8222 27.9333 23.6667 27.8 23.5333C27.6667 23.4 27.5111 23.3333 27.3333 23.3333H24.6667V20.6667C24.6667 20.4889 24.6 20.3333 24.4667 20.2C24.3333 20.0667 24.1778 20 24 20C23.8222 20 23.6667 20.0667 23.5333 20.2C23.4 20.3333 23.3333 20.4889 23.3333 20.6667V23.3333H20.6667C20.4889 23.3333 20.3333 23.4 20.2 23.5333C20.0667 23.6667 20 23.8222 20 24C20 24.1778 20.0667 24.3333 20.2 24.4667C20.3333 24.6 20.4889 24.6667 20.6667 24.6667H23.3333ZM24 30.6667C22.1556 30.6667 20.5836 30.0164 19.284 28.716C17.9844 27.4156 17.3342 25.8436 17.3333 24C17.3324 22.1564 17.9827 20.5844 19.284 19.284C20.5853 17.9836 22.1573 17.3333 24 17.3333C25.8427 17.3333 27.4151 17.9836 28.7173 19.284C30.0196 20.5844 30.6693 22.1564 30.6667 24C30.664 25.8436 30.0138 27.416 28.716 28.7173C27.4182 30.0187 25.8462 30.6684 24 30.6667ZM10.6667 12H21.3333C21.7111 12 22.028 11.872 22.284 11.616C22.54 11.36 22.6676 11.0436 22.6667 10.6667C22.6658 10.2898 22.5378 9.97333 22.2827 9.71733C22.0276 9.46133 21.7111 9.33333 21.3333 9.33333H10.6667C10.2889 9.33333 9.97244 9.46133 9.71733 9.71733C9.46222 9.97333 9.33422 10.2898 9.33333 10.6667C9.33244 11.0436 9.46044 11.3604 9.71733 11.6173C9.97422 11.8742 10.2907 12.0018 10.6667 12ZM6.66667 28C5.93333 28 5.30578 27.7391 4.784 27.2173C4.26222 26.6956 4.00089 26.0676 4 25.3333V6.66667C4 5.93333 4.26133 5.30578 4.784 4.784C5.30667 4.26222 5.93422 4.00089 6.66667 4H25.3333C26.0667 4 26.6947 4.26133 27.2173 4.784C27.74 5.30667 28.0009 5.93422 28 6.66667V13.9333C28 14.3333 27.8333 14.6444 27.5 14.8667C27.1667 15.0889 26.8111 15.1333 26.4333 15C26.0556 14.8889 25.6609 14.8053 25.2493 14.7493C24.8378 14.6933 24.4213 14.6658 24 14.6667C23.7556 14.6667 23.5276 14.6724 23.316 14.684C23.1044 14.6956 22.888 14.7231 22.6667 14.7667C22.4667 14.7222 22.2444 14.6947 22 14.684C21.7556 14.6733 21.5333 14.6676 21.3333 14.6667H10.6667C10.2889 14.6667 9.97244 14.7947 9.71733 15.0507C9.46222 15.3067 9.33422 15.6231 9.33333 16C9.33244 16.3769 9.46044 16.6938 9.71733 16.9507C9.97422 17.2076 10.2907 17.3351 10.6667 17.3333H17.5C17.1 17.7111 16.7391 18.1222 16.4173 18.5667C16.0956 19.0111 15.812 19.4889 15.5667 20H10.6667C10.2889 20 9.97244 20.128 9.71733 20.384C9.46222 20.64 9.33422 20.9564 9.33333 21.3333C9.33244 21.7102 9.46044 22.0271 9.71733 22.284C9.97422 22.5409 10.2907 22.6684 10.6667 22.6667H14.7667C14.7222 22.8889 14.6947 23.1058 14.684 23.3173C14.6733 23.5289 14.6676 23.7564 14.6667 24C14.6667 24.4444 14.6889 24.8667 14.7333 25.2667C14.7778 25.6667 14.8556 26.0556 14.9667 26.4333C15.0778 26.8111 15.0222 27.1667 14.8 27.5C14.5778 27.8333 14.2778 28 13.9 28H6.66667Z"
                                            fill="black" fill-opacity="0.34" />
                                    </svg>
                                </div>

                                <!-- Subtotal -->
                                <div class="flex justify-between pb-4 font-semibold">
                                    <span>Subtotal</span>
                                    <span class="text-shadow-2">Rp 251.000</span>
                                </div>
                                <hr class="border-[1.5px] rounded-full border-black" />

                                <!-- Discount -->
                                <div class="flex justify-between py-4 font-semibold">
                                    <span>Potongan Harga</span>
                                    <span></span>
                                </div>
                                <hr class="border-[1.5px] rounded-full border-black" />

                                <!-- Total -->
                                <div class="flex justify-between py-3 font-semibold">
                                    <span>Total</span>
                                    <span class="text-shadow-2">Rp 251.000</span>
                                </div>

                                <!-- Metode Pembayaran -->
                                <div class="mb-4">
                                    <h3 class="font-semibold mt-6 mb-2">Metode Pembayaran</h3>
                                    <select name="metodePembayaran" id="metodePembayaran"
                                        class="w-3/4 border border-black rounded-lg font-medium py-2 px-2 focus:ring-gray-400 focus:border-gray-400">
                                        <option value="-">Pilih Opsi Pembayaran</option>
                                        <option value="tunai">Tunai</option>
                                        <option value="non-tunai">Non-Tunai</option>
                                    </select>
                                </div>
                            </div>

                            <!-- File (Bukti Pembayaran) -->
                            <div class="hidden relative" id="bukti-pembayaran">
                                <label for="file-upload" class="block mt-4 mb-2 font-semibold text-base">
                                    Upload Bukti Pembayaran (Jika Non-Tunai)
                                </label>
                                <div class="flex items-center space-x-2 mb-4">
                                    <label for="file-upload"
                                        class="flex bg-blue-500 text-white gap-2 px-4 py-2 rounded-lg cursor-pointer text-base hover:bg-blue-600 transition duration-200 ease-in">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                            class="feather feather-upload">
                                            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                            <polyline points="17 8 12 3 7 8"></polyline>
                                            <line x1="12" y1="3" x2="12" y2="15">
                                            </line>
                                        </svg>
                                        Upload File
                                    </label>
                                    <span id="file-name" class="text-xs"></span>
                                </div>
                                <input type="file" id="file-upload" class="hidden"
                                    onchange="updateFileName(this)" />
                            </div>

                            <!-- Submit Button -->
                            <div class="flex items-center border-b-2 border-gray-200 py-4">
                                <input type="submit" id="order" value="Pesan"
                                    class="py-2 px-4 w-full bg-red-600 rounded-lg text-white font-semibold cursor-pointer transition duration-300 ease-linear hover:bg-red-700 hover:scale-105 active:bg-red-800 active:scale-100" />
                            </div>
                        </form>

                        <!-- Shipping Details -->
                        {{-- <div class="mt-5">
                            <h4 class="mb-3 font-bold">Rincian Ongkir</h4>
                            <ul class="mb-3">
                                <li class="font-semibold">
                                    Asal Kota: <span class="font-light">Bogor</span>
                                </li>
                                <li class="font-semibold">
                                    Kota Tujuan: <span class="font-light">Bali</span>
                                </li>
                                <p class="text-gray-500">
                                    Detail kota asal atau tujuan belum tersedia.
                                </p>
                                <li class="font-semibold">
                                    Berat Paket: <span class="font-light">100 gram</span>
                                </li>
                            </ul>
                            Total Payment
                            <div class="flex items-center justify-between py-8">
                                <p class="font-medium text-xl leading-8 text-black">
                                    1 Items
                                </p>
                                <p class="font-semibold text-xl leading-8 text-rose-300">
                                    Rp 100.000,00
                                </p>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- QRCODE -->
    <section>
        <div class="hidden justify-center items-center fixed left-0 top-0 w-full h-full overflow-auto bg-black/80 z-[9999]"
            id="qrcode">
            <img src="{{ asset('asset-view/assets/png/maps.png') }}" alt="" id="imagePayment" />
        </div>
    </section>

    <script>
        const metodePembayaran = document.querySelector('#metodePembayaran');
        const buktiPembayaran = document.getElementById('bukti-pembayaran');
        const qrCode = document.querySelector('#qrcode');
        const imagePayment = document.querySelector('#imagePayment');

        metodePembayaran.addEventListener("change", function() {
            if (this.value === 'non-tunai') {
                qrCode.classList.remove('hidden');
                qrCode.classList.add('flex');
                buktiPembayaran.classList.remove('hidden');
                buktiPembayaran.classList.add('block');
            } else {
                qrCode.classList.add('hidden');
                qrCode.classList.remove('flex');
                buktiPembayaran.classList.add('hidden');
                buktiPembayaran.classList.remove('block');
            }
        });

        imagePayment.addEventListener('click', () => {
            qrCode.classList.add('hidden');
        });
    </script>


</x-layout-view>
