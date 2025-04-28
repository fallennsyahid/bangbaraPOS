<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>BangbaraPos</title>
    <!-- CSS -->
    @vite(['resources/css/app.css'])
    <link rel="stylesheet" href="{{ asset('asset-view/css/extra.css') }}" />

    <!-- ICON WEB -->
    <link rel="shortcut icon" href="{{ asset('asset-view/assets/png/logo_bangbara.png') }}" type="image/x-icon">

    {{-- Alpine JS --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body x-data x-init="$refs.loading.classList.add('hidden')">
    <x-loading-animation></x-loading-animation>
    {{-- Hero Section Start --}}
    <section class="relative h-[50vh] header-cart">
        <div class="absolute inset-0 bg-black/40 flex flex-col items-center justify-center">
            <h1 class="text-white text-5xl lg:text-4xl font-bold">Cart</h1>
            <p class="text-white">
                <span class="text-xl lg:text-base">
                    Back /
                </span>
                <a href="{{ route('index') }}">
                    <span class="text-rose-500 cursor-pointer text-xl lg:text-base hover:underline">Home</span></a>
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
                        <h2 id="cart-total-items" class="font-bold text-xl text-gray-600">
                            {{ $cartItems->sum('quantity') }} Items
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

                    @if ($cartItems->isNotEmpty())
                        @foreach ($cartItems as $item)
                            <div class="flex flex-row items-start gap-5 py-6 border-b border-gray-200 group">
                                {{-- Image Product --}}
                                <div class="w-full max-w-[126px] flex mx-auto justify-center">
                                    <img src="{{ Storage::url($item->product->gambar_menu) }}"
                                        alt="{{ $item->product->nama_menu }}" class="mx-auto rounded-xl object-cover"
                                        loading="lazy">
                                </div>
                                {{-- Image Product End --}}
                                <div class="grid grid-cols-1 md:grid-cols-4 w-full">
                                    {{-- Product Description --}}
                                    <div class="md:col-span-2">
                                        <div class="flex flex-col max-[500px]:items-center gap-3">
                                            <h6 class="font-semibold text-lg sm:text-base leading-7 text-black">
                                                {{ $item->product->nama_menu }}
                                            </h6>
                                            @if ($item->sauce || $item->hot_ice)
                                                <p class="text-base sm:text-sm text-gray-600 ">
                                                    @if ($item->hot_ice)
                                                        Penyajian: {{ ucfirst($item->hot_ice) }}
                                                    @endif
                                                    @if ($item->hot_ice && $item->sauce)
                                                        |
                                                    @endif
                                                    @if ($item->sauce)
                                                        Saus: {{ ucfirst($item->sauce) }}
                                                    @endif
                                                </p>
                                            @endif
                                            <h6
                                                class="font-medium text-base leading-7 text-gray-600 transition-all duration-300 group-hover:text-red-700">
                                                Rp {{ number_format($item->product->harga_menu, 2) }}
                                            </h6>
                                        </div>
                                    </div>
                                    {{-- Product Description End --}}
                                    {{-- Button Quantity --}}
                                    <div class="flex items-center justify-center h-full max-md:mt-0">
                                        <div class="flex items-center justify-center h-full flex-row">
                                            <!-- Button Decrease Quantity -->
                                            <button
                                                class="decrease group rounded-l-xl px-5 py-[18px] border border-gray-200 flex items-center justify-center shadow-sm transition-all duration-500 hover:bg-gray-50 hover:border-gray-300 focus-within:outline-gray-300"
                                                data-id="{{ $item->id }}">
                                                <svg class="stroke-gray-900 transition-all duration-500 group-hover:stroke-black"
                                                    xmlns="http://www.w3.org/2000/svg" width="22" height="22"
                                                    viewBox="0 0 22 22" fill="none">
                                                    <path d="M16.5 11H5.5" stroke-width="1.6" stroke-linecap="round" />
                                                </svg>
                                            </button>

                                            <!-- Quantity Field -->
                                            <input type="text" id="cart-item-{{ $item->id }}"
                                                class="quantity border-y py-[15px] border-gray-200 outline-none text-gray-900 font-semibold text-lg w-full max-w-[73px] min-w-[60px] text-center bg-transparent"
                                                value="{{ $item->quantity }}" readonly>

                                            <!-- Button Increase Quantity -->
                                            <button
                                                class="increase group rounded-r-xl px-5 py-[18px] border border-gray-200 flex items-center justify-center shadow-sm transition-all duration-500 hover:bg-gray-50 hover:border-gray-300 focus-within:outline-gray-300"
                                                data-id="{{ $item->id }}">
                                                <svg class="stroke-gray-900 transition-all duration-500 group-hover:stroke-black"
                                                    xmlns="http://www.w3.org/2000/svg" width="22" height="22"
                                                    viewBox="0 0 22 22" fill="none">
                                                    <path d="M11 5.5V16.5M16.5 11H5.5" stroke-width="1.6"
                                                        stroke-linecap="round" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                    {{-- Button Quantity End --}}
                                    {{-- Final Price --}}
                                    {{-- <div
                                        class="flex items-center max-[500px]:justify-center md:justify-end max-md:mt-3 h-full"> --}}
                                    <div class="flex items-center justify-center h-full">
                                        <p class="font-bold text-lg leading-8 text-gray-600 text-center transition-all duration-300 group-hover:text-red-700 total-price"
                                            id="cart-item-{{ $item->id }}-total-price"
                                            data-price="{{ $item->product->harga_menu }}">
                                            Rp {{ number_format($item->product->harga_menu * $item->quantity, 2) }}
                                        </p>
                                    </div>
                                    {{-- Final Price --}}
                                </div>
                            </div>
                        @endforeach
                    @else
                        <h1 class="py-4 text-center border-b border-gray-200 font-semibold text-xl">
                            Keranjang Kosong
                        </h1>
                    @endif
                </div>

                <!-- Order Summary Section -->
                <div
                    class="col-span-12 xl:col-span-4 bg-gray-50 w-full max-xl:px-6 max-w-3xl xl:max-w-lg mx-auto lg:pl-8 py-24">
                    <h2 class="font-manrope font-bold text-3xl leading-10 text-black pb-8 border-b border-gray-300">
                        Order Summary
                    </h2>

                    <!-- Order Details -->
                    <div class="mt-8">

                        <form action="{{ route('order.checkout') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="relative">
                                <!-- Nama -->
                                <label for="customer_name" class="block mb-2 font-medium text-base">
                                    Masukkan nama Anda
                                </label>
                                <input type="text" placeholder="Rendi Kurniawan" id="customer_name"
                                    name="customer_name"
                                    class="w-full border border-gray-300 rounded-lg pr-16 px-3 py-3 font-alkatra font-normal focus:ring-gray-400 focus:border-gray-400 focus:shadow-lg" />

                                <!-- No Telp -->
                                <label for="customer_phone" class="block mt-4 mb-2 font-medium text-base">
                                    Masukkan nomor telepon
                                </label>
                                <input type="number" placeholder="08xx" id="customer_phone" name="customer_phone"
                                    min="0" maxlength="15"
                                    class="input-number w-full border border-gray-300 rounded-lg pr-16 px-3 py-3 font-alkatra font-normal focus:ring-gray-400 focus:border-gray-400 focus:shadow-lg" />

                                <!-- Note -->
                                <label for="request" class="block mt-4 mb-2 font-medium text-base">
                                    Catatan
                                </label>
                                <textarea name="request" id="request" rows="" placeholder="Ex. Medium Rare"
                                    class="w-full border border-gray-300 rounded-lg px-3 py-3 mb-4 focus:ring-1 focus:ring-gray-400 focus:border-gray-400"></textarea>
                                <hr class="border-[1.5px] rounded-full border-black" />

                                <!-- Total -->
                                <div class="flex justify-between py-3 font-semibold">
                                    <span>Total</span>
                                    <span class="text-shadow-2" id="cart-total-price">
                                        Rp.
                                        {{ number_format($cartItems->sum(fn($item) => $item->quantity * $item->product->harga_menu), 2) }}
                                    </span>
                                </div>
                                <hr class="border-[1.5px] rounded-full border-black" />

                            </div>

                            {{-- Opsi Penyajian --}}
                            <div class="flex flex-col">
                                <label for="serve_option" class="font-semibold mt-6 mb-2">Opsi Penyajian</label>
                                <select name="serve_option" id="serve_option" required
                                    class="w-3/4 border border-black rounded-lg font-medium py-2 px-2 focus:ring-gray-400 focus:border-gray-400">
                                    <option value="-" disabled selected>Pilih Opsi Penyajian
                                    </option>
                                    <option value="dine-in">Dine In</option>
                                    <option value="take-away">Take Away</option>
                                </select>
                            </div>

                            <!-- Metode Pembayaran -->
                            <div class="mb-4 flex flex-col">
                                {{-- <h3 class="font-semibold mt-6 mb-2">Metode Pembayaran</h3> --}}
                                <label for="metodePembayaran" class="font-semibold mt-6 mb-2">Metode
                                    Pembayaran</label>
                                <select name="payment_method" id="metodePembayaran" required
                                    class="payment_method w-3/4 border border-black rounded-lg font-medium py-2 px-2 focus:ring-gray-400 focus:border-gray-400">
                                    <option value="-" disabled selected>Pilih Opsi Pembayaran</option>
                                    <option value="Tunai">Tunai</option>
                                    <option value="nonTunai">Non-Tunai</option>
                                    <option value="Debit">Debit</option>
                                </select>
                            </div>

                            <!-- Submit Button -->
                            <div class="flex items-center border-b-2 border-gray-200 py-4">
                                <button type="button" id="checkoutButton" disabled
                                    class="py-2 px-4 w-full bg-red-500 rounded-lg text-white font-semibold cursor-not-allowed transition duration-300 ease-linear">
                                    Checkout
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- QRCODE -->
    <section>
        <div class="hidden justify-center items-center fixed left-0 top-0 w-full h-full overflow-auto bg-black/80 z-[9999]"
            id="qrcode">
            <img src="{{ Storage::url($imagePayment->payment_image) }}" alt="Barcode" id="imagePayment" />
        </div>
    </section>

</body>

<x-cart-sweetalert></x-cart-sweetalert>
<script src="{{ asset('asset-view/js/cart.js') }}"></script>


</html>
