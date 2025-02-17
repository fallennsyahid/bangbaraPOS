<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Bangbara - Post</title>
    <!-- CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('asset-view/css/extra.css') }}" />

    <!-- ICON WEB -->
    <link rel="shortcut icon" href="{{ asset('asset-view/assets/png/logo_bangbara.png') }}" type="image/x-icon">

    <!-- FONTS -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Euphoria+Script&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet" />

</head>

<body>
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
                            <div
                                class="flex flex-col min-[500px]:flex-row min-[500px]:items-center gap-5 py-6 border-b border-gray-200 group">
                                <div class="w-full max-w-[126px] sm:justify-center">
                                    <img src="{{ Storage::url($item->product->gambar_menu) }}"
                                        alt="{{ $item->product->nama_menu }}" class="mx-auto rounded-xl object-cover">
                                </div>
                                <div class="grid grid-cols-1 md:grid-cols-4 w-full">
                                    <div class="md:col-span-2">
                                        <div class="flex flex-col max-[500px]:items-center gap-3">
                                            <h6 class="font-semibold text-base leading-7 text-black">
                                                {{ $item->product->nama_menu }}</h6>
                                            <h6
                                                class="font-medium text-base leading-7 text-gray-600 transition-all duration-300 group-hover:text-red-700">
                                                Rp {{ number_format($item->product->harga_menu, 2) }}
                                            </h6>
                                        </div>
                                    </div>
                                    <div class="flex items-center max-[500px]:justify-center h-full max-md:mt-3">
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
                                                class="quantity border-y border-gray-200 outline-none text-gray-900 font-semibold text-lg w-full max-w-[73px] min-w-[60px] text-center bg-transparent"
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
                                    <div
                                        class="flex items-center max-[500px]:justify-center md:justify-end max-md:mt-3 h-full">
                                        <p class="font-bold text-lg leading-8 text-gray-600 text-center transition-all duration-300 group-hover:text-red-700 total-price"
                                            id="cart-item-{{ $item->id }}-total-price"
                                            data-price="{{ $item->product->harga_menu }}">
                                            Rp {{ number_format($item->product->harga_menu * $item->quantity, 2) }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <h1 class="py-4 text-center border-b border-gray-200 font-semibold text-xl">
                            Keranjang Kosong
                        </h1>
                    @endif


                    <!-- Total Price -->
                    <div class="flex justify-end mt-4">
                        <h3 id="cart-total-price" class="font-bold text-xl">
                            Total: Rp
                            {{ number_format($cartItems->sum(fn($item) => $item->quantity * $item->product->harga_menu), 2) }}
                        </h3>
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
                            <p class="font-normal text-lg leading-8 text-black" id="cart-total-items-2">
                                {{ $cartItems->sum('quantity') }} Items
                            </p>
                            <p class="font-medium text-lg leading-8 text-black " id="cart-total-price-2">
                                Rp.
                                {{ number_format($cartItems->sum(fn($item) => $item->quantity * $item->product->harga_menu), 2) }}
                            </p>
                        </div>

                        {{-- <form action="" id="checkout-form" method="POST" enctype="multipart/form-data"> --}}
                        <form action="{{ route('order.checkout') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="relative">
                                <!-- Nama -->
                                <label for="customer_name" class="block mb-2 font-medium text-base">
                                    Masukkan nama Anda
                                </label>
                                <input type="text" placeholder="contoh: Atas nama Rendi" id="customer_name"
                                    name="customer_name"
                                    class="w-full border border-gray-300 rounded-lg pr-16 px-3 py-3 font-alkatra font-normal focus:ring-gray-400 focus:border-gray-400 focus:shadow-lg" />

                                <!-- No Telp -->
                                <label for="customer_phone" class="block mt-4 mb-2 font-medium text-base">
                                    Masukkan nomor telepon
                                </label>
                                <input type="number" placeholder="contoh: +62" id="customer_phone"
                                    name="customer_phone" min="0" maxlength="15"
                                    class="input-number w-full border border-gray-300 rounded-lg pr-16 px-3 py-3 font-alkatra font-normal focus:ring-gray-400 focus:border-gray-400 focus:shadow-lg" />

                                <!-- Note -->
                                <label for="request" class="block mt-4 mb-2 font-medium text-base">
                                    Catatan
                                </label>
                                <textarea name="request" id="request" rows="" placeholder="Ex. Medium Rare"
                                    class="w-full border border-gray-300 rounded-lg px-3 py-3 mb-4 focus:ring-1 focus:ring-gray-400 focus:border-gray-400"></textarea>

                                <!-- Subtotal -->
                                <div class="flex justify-between pb-4 font-semibold">
                                    <span>Subtotal</span>
                                    <span class="text-shadow-2" id="subtotal">
                                        Rp.
                                        {{ number_format($cartItems->sum(fn($item) => $item->quantity * $item->product->harga_menu), 2) }}</span>
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
                                    <span class="text-shadow-2" id="total-all">
                                        Rp.
                                        {{ number_format($cartItems->sum(fn($item) => $item->quantity * $item->product->harga_menu), 2) }}</span>
                                </div>

                                <!-- Metode Pembayaran -->
                                <div class="mb-4 flex flex-col">
                                    {{-- <h3 class="font-semibold mt-6 mb-2">Metode Pembayaran</h3> --}}
                                    <label for="metodePembayaran" class="font-semibold mt-6 mb-2">Metode
                                        Pembayaran</label>
                                    <select name="payment_method" id="metodePembayaran"
                                        class="payment_method w-3/4 border border-black rounded-lg font-medium py-2 px-2 focus:ring-gray-400 focus:border-gray-400">
                                        <option value="-">Pilih Opsi Pembayaran</option>
                                        <option value="tunai">Tunai</option>
                                        <option value="non-tunai">Non-Tunai</option>
                                    </select>
                                </div>
                            </div>

                            <!-- File (Bukti Pembayaran) -->
                            <div class="hidden relative" id="bukti-pembayaran">
                                <label for="payment_photo" class="block mt-4 mb-2 font-semibold text-base">
                                    Upload Bukti Pembayaran (Jika Non-Tunai)
                                </label>
                                <div class="flex items-center space-x-2 mb-4">
                                    <label for="payment_photo"
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
                                <input type="file" id="payment_photo" name="payment_photo" class="hidden"
                                    accept="image/*" onchange="updateFileName(this)" />
                            </div>

                            <!-- Submit Button -->
                            <div class="flex items-center border-b-2 border-gray-200 py-4">
                                <button type="submit"
                                    class="py-2 px-4 w-full bg-red-600 rounded-lg text-white font-semibold cursor-pointer transition duration-300 ease-linear hover:bg-red-700 hover:scale-105 active:bg-red-800 active:scale-100">
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
            <img src="{{ asset('asset-view/assets/png/maps.png') }}" alt="" id="imagePayment" />
        </div>
    </section>

</body>

<script></script>

<script src="{{ asset('asset-view/js/cart.js') }}"></script>
{{-- <script src="{{ asset('asset-view/js/checkout.js') }}"></script> --}}

</html>
