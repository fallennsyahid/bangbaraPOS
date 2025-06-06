<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description"
        content="BangbaraPos - Rasa Juara, Harga Bersahabat! Nikmati steak berkualitas dengan harga terjangkau.">
    <title>{{ __('BangbaraPOS') }}</title>
    <!-- CSS -->
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="{{ asset('asset-view/css/extra.css') }}" />
    <link rel="stylesheet" href="{{ asset('asset-view/css/slider.css') }}">
    {{-- Header Image --}}
    <link rel="preload" as="image" href="{{ asset('asset-view/assets/webp/header.webp') }}" type="image/webp">
    <!-- ICON WEB -->
    <link rel="shortcut icon" href="{{ asset('asset-view/assets/png/logo_bangbara.png') }}" type="image/x-icon">
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
        integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />
    {{-- Alpine JS --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body x-data x-init="$refs.loading.classList.add('hidden')">
    <x-loading-animation></x-loading-animation>
    {{-- <span class="screen-widget"></span> --}}
    <!-- Header Start -->
    <header class="bg-transparent absolute top-0 left-0 w-full flex items-center z-10">
        <div class="container mx-auto px-4">
            <div class="flex items-center justify-between">
                <!-- Logo -->
                <div class="py-6">
                    <a href="#home" aria-label="Go to homepage">
                        <img src="{{ asset('asset-view/assets/webp/logo-navbar.webp') }}" alt="Bangbara Logo"
                            width="150" height="150" loading="lazy" />
                    </a>
                </div>

                <!-- Navigation and Controls -->
                <div class="flex items-center">
                    <!-- Navigation Menu -->
                    <nav id="nav-menu" aria-label="Main navigation"
                        class="hidden absolute top-full right-4 py-5 shadow-2xl rounded-lg max-w-[250px] w-full lg:bg-transparent lg:static lg:block lg:max-w-none lg:shadow-none lg:rounded-none lg:w-auto lg:mx-auto">
                        <ul class="block lg:flex lg:gap-8">
                            <li class="group">
                                <a href="#home" tabindex="0"
                                    class="text-base text-white py-2 mx-4 flex font-medium relative group-hover:text-primary after:content-[''] after:absolute after:bottom-0 after:left-1/2 after:w-0 after:h-[2px] after:bg-white after:transition-all after:duration-300 after:transform after:-translate-x-1/2 group-hover:after:w-3/4">
                                    Home
                                </a>
                            </li>
                            <li class="group">
                                <a href="#menu" tabindex="1"
                                    class="text-base text-white py-2 mx-4 flex font-medium relative group-hover:text-primary after:content-[''] after:absolute after:bottom-0 after:left-1/2 after:w-0 after:h-[2px] after:bg-white after:transition-all after:duration-300 after:transform after:-translate-x-1/2 group-hover:after:w-3/4">
                                    Menu
                                </a>
                            </li>
                            <li class="group">
                                <a href="#about" tabindex="2"
                                    class="text-base text-white py-2 mx-4 flex font-medium relative group-hover:text-primary after:content-[''] after:absolute after:bottom-0 after:left-1/2 after:w-0 after:h-[2px] after:bg-white after:transition-all after:duration-300 after:transform after:-translate-x-1/2 group-hover:after:w-3/4">
                                    About
                                </a>
                            </li>
                            <li class="group">
                                <a href="#contact" tabindex="3"
                                    class="text-base text-white py-2 mx-4 flex font-medium relative group-hover:text-primary after:content-[''] after:absolute after:bottom-0 after:left-1/2 after:w-0 after:h-[2px] after:bg-white after:transition-all after:duration-300 after:transform after:-translate-x-1/2 group-hover:after:w-3/4">
                                    Review
                                </a>
                            </li>
                        </ul>
                    </nav>

                    <!-- Cart and Hamburger Menu -->
                    <div class="flex items-center space-x-4 lg:hidden">
                        <!-- Cart Icon Mobile -->
                        <a href="{{ route('cart') }}" class="relative" aria-label="View shopping cart">
                            <img src="{{ asset('asset-view/assets/svg/cart.svg') }}" alt="Shopping Cart" width="40"
                                height="40px" class="hover:scale-110 transition duration-300 ease-in-out"
                                loading="lazy" />

                            <span id="cart-quantity-badge" aria-label="Cart items count" aria-live="polite"
                                class="absolute -top-2 -right-2 bg-red-600 rounded-full px-2 py-0.5 text-xs font-bold shadow-md">
                                0
                            </span>
                        </a>
                        <!-- Hamburger Menu -->
                        <button id="hamburger" name="hamburger" type="button" class="block" aria-label="Toggle menu"
                            aria-expanded="false" aria-controls="nav-menu">
                            <span
                                class="hamburger-line block w-6 h-1 bg-white transition duration-300 ease-in-out origin-top-left mb-1"></span>
                            <span
                                class="hamburger-line block w-6 h-1 bg-white transition duration-300 ease-in-out mb-1"></span>
                            <span
                                class="hamburger-line block w-6 h-1 bg-white transition duration-300 ease-in-out origin-bottom-left"></span>
                        </button>
                    </div>
                </div>

                <div class="hidden lg:block lg:items-center lg:space-x-4">
                    <!-- Cart Icon Desktop -->
                    <a href="{{ route('cart') }}" class="relative" aria-label="View shopping cart">
                        <img src="{{ asset('asset-view/assets/svg/cart.svg') }}" alt="Shopping Cart" width="40"
                            height="40" class="hover:scale-110 transition duration-300 ease-in-out" loading="lazy" />

                        <span id="cart-quantity-badge-desktop" aria-label="Cart items count" aria-live="polite"
                            class="absolute -top-2 -right-2 bg-red-600 rounded-full px-2 py-0.5 text-xs font-bold shadow-md">
                            0
                        </span>
                    </a>
                </div>
            </div>
        </div>
    </header>
    <!-- Header End -->

    <!-- Hero Section Start -->
    <section id="home" class="pt-36 header-img lg:min-h-screen">
        <div class="container mx-auto px-4">
            <div class="flex flex-wrap items-center">
                <!-- Konten -->
                <div class="w-full lg:w-3/4 px-4 pb-14 text-center lg:text-left lg:py-0">
                    <h1 class="font-euphoria text-white text-4xl md:text-6xl lg:text-7xl mt-4 mb-6 leading-tight">
                        Rasa Juara, Harga Bersahabat!
                    </h1>
                    <p
                        class="font-medium text-secondary mb-10 leading-relaxed text-white text-sm sm:text-base md:text-lg lg:text-xl lg:w-3/4">
                        Bangbara hadir untuk Anda yang menginginkan sajian steak
                        berkualitas dengan cita rasa juara, namun tetap ramah di kantong.
                        Dengan bahan pilihan dan racikan khas, setiap hidangan kami
                        dirancang untuk memberikan pengalaman makan yang lezat dan
                        memuaskan, tanpa harus menguras dompet.
                    </p>
                    <a href="#menu"
                        class="text-base sm:text-lg md:text-xl lg:text-2xl font-euphoria text-white bg-primary py-3 px-6 md:py-4 md:px-8 rounded-full shadow-lg hover:shadow-xl hover:opacity-80 transition duration-300 ease-in-out">
                        Cek Selengkapnya
                    </a>
                </div>
            </div>
        </div>
    </section>
    <!-- Hero Sectio End -->

    <!-- Menu Section Start -->
    <section id="menu" class="menu-img">
        <div class="flex flex-col items-center px-4 sm:px-8 lg:px-16">
            <!-- Header -->
            <div
                class="flex items-center bg-primary mx-auto my-5 px-8 sm:px-12 lg:px-16 text-center rounded-2xl shadow-md shadow-primary">
                <img src="{{ asset('asset-view/assets/webp/book.webp') }}" alt="Menu book icon" width="120"
                    height="120" class="mr-0 lg:mr-4 lg:scale-150" loading="lazy" />
                <h1 class="font-euphoria text-shadow text-[2.5rem] lg:text-6xl text-white">
                    Menu Kami
                </h1>
            </div>

            <!-- Tab Navigation Category -->
            <div class="w-full py-6 text-center">
                <div class="flex flex-wrap justify-center gap-x-14 gap-y-4" role="tablist"
                    aria-label="Menu categories">
                    @foreach ($categories as $index => $category)
                        @if ($index < 4)
                            <button onclick="changeSlide({{ $index }})"
                                class="menu-link relative text-white font-euphoria text-3xl sm:text-4xl lg:text-5xl hover:text-yellow-400 after:absolute after:left-0 after:bottom-0 after:h-[2px] after:rounded-full after:w-full after:bg-white hover:after:bg-yellow-400 {{ $index === 0 ? 'active' : '' }}"
                                data-index="{{ $index }}" role="tab" id="tab-{{ $index }}">
                                {{ $category->nama_kategori }}
                            </button>
                        @endif
                    @endforeach
                </div>
            </div>

            <!-- Slider Container -->
            <div id="slider" class="w-full overflow-hidden max-w-screen-lg mx-auto mt-10">
                <div id="slider-content" class="flex transition-transform duration-500"
                    style="width: {{ count($categories->take(4)) * 100 }}%">

                    @foreach ($categories->take(4) as $category)
                        <div class="w-full min-h-16 flex flex-col justify-start" role="tabpanel"
                            id="panel-{{ $index }}" aria-labelledby="tab-{{ $index }}"
                            {{ $index !== 0 ? 'hidden' : ' ' }}>
                            <div
                                class="grid grid-cols-1 sm:grid-cols-3 lg:grid-cols-3 gap-6 px-4 py-5 place-items-center">
                                @foreach ($category->products as $product)
                                    @php
                                        $isNonActive = $product->status_produk === 'Non-active';
                                        $isClose = optional($store)->status == 0;

                                    @endphp

                                    <div
                                        class="product-card flex flex-col items-center
                                    bg-white h-[22rem] w-48 md:h-[23rem] md:w-56 lg:h-[25rem] lg:w-64 rounded-md gap-3
                                    transition duration-200 ease-in 
                                    {{ $isNonActive || $isClose ? 'bg-gray-300 pointer-events-none' : 'hover:-translate-y-2' }}">

                                        <!-- Bagian Gambar -->
                                        <a href="{{ $isNonActive || $isClose ? '#' : '#item-detail-modal' }}"
                                            class="item-detail-button {{ $isNonActive ? 'pointer-events-none' : '' }}"
                                            data-product-id="{{ $product->id }}"
                                            aria-label="{{ $product->nama_menu }} details">
                                            <div class="relative group">
                                                <img src="{{ asset('storage/' . $product->gambar_menu) }}"
                                                    alt="{{ $product->nama_menu }}" loading="lazy" width="100%"
                                                    height="100%"
                                                    class="overflow-hidden rounded-t-md transition-all duration-300 ease-in-out 
                                                group-hover:brightness-75 {{ $isNonActive ? 'opacity-50' : '' }} {{ $isClose ? 'opacity-50' : '' }}" />
                                                @if ($isClose)
                                                    <div
                                                        class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-50">
                                                        <span class="text-white font-semibold text-base">
                                                            Tutup
                                                        </span>
                                                    </div>
                                                @elseif ($isNonActive)
                                                    <div
                                                        class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-50">
                                                        <span class="text-white font-semibold text-base">
                                                            Tidak tersedia
                                                        </span>
                                                    </div>
                                                @else
                                                    <div
                                                        class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-50 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                                        <span class="text-white font-semibold text-base">
                                                            View More
                                                        </span>
                                                    </div>
                                                @endif
                                            </div>
                                        </a>

                                        <p class="text-text text-base sm:text-lg text-center">
                                            {{ $product->nama_menu }}</p>
                                        <h6 class="hidden">{{ $product->deskripsi_menu }}</h6>
                                        <span class="text-price font-alkatra text-base text-center">
                                            Rp {{ number_format($product->harga_menu, 0, ',', '.') }}
                                        </span>

                                        <div class="flex mx-2">
                                            <button type="button"
                                                class="{{ $isClose
                                                    ? 'hidden'
                                                    : 'item-detail-button text-shadow text-sm sm:text-sm bg-red-600 px-2 py-1 sm:px-4 sm:py-2 rounded-full text-white text-center ' }}
                                        {{ $isNonActive ? 'bg-gray-500 cursor-disabled' : '' }}"
                                                data-product-id="{{ $product->id }}"
                                                data-product-name="{{ $product->nama_menu }}"
                                                data-product-category="{{ $category->nama_kategori }}"
                                                {{ $isNonActive ? 'disabled' : '' }}
                                                aria-label="{{ $isNonActive ? 'Tidak Tersedia' : 'Tambahkan ' . $product->nama_menu . ' ke keranjang' }}">
                                                {{ $isNonActive ? 'Tidak Tersedia' : 'Tambahkan Ke Keranjang' }}
                                            </button>

                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <!-- Menu Section End -->

    <!-- Popup Start -->
    <section id="popup">
        <div class="popup hidden fixed z-[9999] left-0 top-0 w-full h-full overflow-auto justify-center items-center bg-black/60"
            id="item-detail-modal" name="modal" role="dialog" aria-labelledby="modal-title" aria-modal="true">
            <div class="flex flex-col bg-white max-h-[90vh] w-[90%] max-w-[325px] md:max-w-[350px] lg:max-w-[375px] rounded-lg gap-2 overflow-hidden animation"
                name="modal-container">
                <a href="#"
                    class="close-icon absolute bg-white w-8 h-8 m-2 rounded-full flex items-center justify-center hover:scale-125 hover:rotate-90 transition duration-300"
                    aria-label="Close dialog">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="currentColor" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="feather feather-x text-primary">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </a>
                <input type="hidden" id="modal-product-id" name="product_id" value="">
                <img id="modal-image" src="" alt="Food" width="100%" height="100%"
                    class="w-full object-cover rounded-t-lg overflow-hidden" loading="lazy" />
                <h1 id="modal-title" class="text-center font-alatsi text-2xl pb-2"></h1>
                <p id="modal-description" class="text-center font-alatsi text-base px-4"></p>

                <div id="pilihan-saus" class="">
                    <h3 class="text-center text-base font-semibold text-gray-800 mb-2">Pilih Saus</h3>
                    <div class="sauce flex justify-center gap-2 flex-wrap" role="radiogroup"
                        aria-labelledby="sauce-heading">
                        <input type="radio" name="sauce" id="sauce-bbq" value="barbaque" class="hidden">
                        <label for="sauce-bbq"
                            class="py-1 px-2 border border-yellow-400 bg-yellow-200 cursor-pointer transition-all duration-200 ease-out shadow-sm text-sm text-gray-800 rounded 
                                hover:shadow-md active:scale-95">
                            Barbaque
                        </label>

                        <input type="radio" name="sauce" id="sauce-mushroom" value="mushroom" class="hidden">
                        <label for="sauce-mushroom"
                            class="py-1 px-2 border border-yellow-400 bg-yellow-200 cursor-pointer transition-all duration-200 ease-out shadow-sm text-sm text-gray-800 rounded 
                                hover:shadow-md active:scale-95">
                            Mushroom
                        </label>

                        <input type="radio" name="sauce" id="sauce-blackpepper" value="blackpepper"
                            class="hidden">
                        <label for="sauce-blackpepper"
                            class="py-1 px-2 border border-yellow-400 bg-yellow-200 cursor-pointer transition-all duration-200 ease-out shadow-sm text-sm text-gray-800 rounded 
                                hover:shadow-md active:scale-95">
                            Blackpepper
                        </label>


                    </div>
                </div>

                <div class="flex justify-center items-center flex-row my-4" id="quantity-button">
                    <!-- Decrease Quantity -->
                    <button id="decrease-qty" class="group rounded-l-sm border border-black/80 px-2 py-2"
                        aria-label="Decrease quantity">
                        <span class="inline-block transform transition-transform duration-200 group-hover:scale-125"> -
                        </span>
                    </button>

                    <!-- Display Quantity -->
                    <input type="text" id="modal-quantity"
                        class="border-y border-black/80 px-2 py-2 text-center w-1/4 focus:outline-none" value="1"
                        readonly aria-label="Product quantity">

                    <!-- Increase Quantity -->
                    <button id="increase-qty" class="group rounded-r-sm border border-black/80 px-2 py-2"
                        aria-label="Increase quantity">
                        <span class="inline-block transform transition-transform duration-200 group-hover:scale-125"> +
                        </span>
                    </button>
                </div>

                <!-- Hidden field untuk lokasi -->
                <input type="hidden" id="targetLatitude" value="{{ $location->latitude ?? 0 }}">
                <input type="hidden" id="targetLongitude" value="{{ $location->longitude ?? 0 }}">


                <button id="add-to-cart-modal"
                    class="bg-red-600 w-full px-4 py-2 font-marmelad text-white rounded-b-md mt-auto"
                    data-url="{{ route('cart.add') }}" data-id="" aria-label="Add to cart">
                    Tambahkan Ke Keranjang
                </button>

            </div>
        </div>
    </section>
    <!-- Popup End -->

    <!-- About Section Start -->
    <section id="about"
        class="about-img relative overflow-x-hidden bg-red-600 overflow-hidden min-h-[60vh] sm:min-h-[60vh] md:min-h-[50vh] lg:min-h-[50vh] xl:min-h-[70vh]">

        <div class="relative z-10 flex justify-center items-center p-6 md:p-10 h-full">
            <div class="text-center max-w-6xl w-full">
                <div class="flex flex-col items-center md:flex-row md:items-start">
                    <!-- Gambar normal di desktop/tablet -->
                    <img src="{{ asset('asset-view/assets/webp/steak.webp') }}" width="100%" height="100%"
                        alt="A plate with steak, fries, and vegetables" class="hidden md:block w-full md:w-2/5 h-auto"
                        loading="lazy" />

                    <!-- Teks konten -->
                    <div class="mt-6 md:mt-0 md:ml-6 text-white flex flex-col items-center">
                        <h1 class="about-title text-7xl lg:text-6xl font-euphoria text-shadow mb-4">
                            Tentang Kami
                        </h1>
                        <p class="leading-relaxed pt-4 text-lg lg:text-2xl text-shadow">
                            Bangbara adalah tempat makan yang menghadirkan steak dan chicken
                            katsu dengan cita rasa istimewa. Dengan bahan berkualitas dan harga
                            yang terjangkau, Bangbara menjadi pilihan tepat untuk menikmati
                            hidangan lezat bersama keluarga atau teman. Suasana yang nyaman dan
                            pelayanan ramah membuat setiap kunjungan menjadi pengalaman yang
                            menyenangkan.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- About Section End -->

    <!-- Contact Section Start -->
    <section id="contact" class="bg-yellow-200 overflow-x-hidden">
        <div class="container mx-auto px-4">
            <div class="flex justify-center py-4 mb-8">
                <h1
                    class="py-4 px-12 bg-red-700 rounded-full text-center text-4xl font-euphoria shadow-lg text-white sm:text-5xl lg:text-6xl">
                    Berikan Rating & Ulasan
                </h1>
            </div>
            <div class="flex flex-wrap justify-center lg:justify-around items-center pb-10 gap-8">
                <form action="{{ route('index.store') }}" method="POST" class="form-contact w-full lg:w-1/2">
                    @csrf
                    <div class="bg-yellow-300 p-6 sm:p-9 rounded-2xl ring-1 ring-yellow-400">
                        <div class="flex justify-between">
                            <h5 class="font-medium text-xl">Kualitas Produk</h5>
                            <div class="flex items-center gap-2 text-xl" id="star" role="radiogroup"
                                aria-labelledby="rating-heading">
                                <input type="radio" name="rating" id="star1" value="1" class="hidden">
                                <label for="star1" class="cursor-pointer"><i class="far fa-star"></i></label>

                                <input type="radio" name="rating" id="star2" value="2" class="hidden">
                                <label for="star2" class="cursor-pointer"><i class="far fa-star"></i></label>

                                <input type="radio" name="rating" id="star3" value="3" class="hidden">
                                <label for="star3" class="cursor-pointer"><i class="far fa-star"></i></label>

                                <input type="radio" name="rating" id="star4" value="4" class="hidden">
                                <label for="star4" class="cursor-pointer"><i class="far fa-star"></i></label>

                                <input type="radio" name="rating" id="star5" value="5" class="hidden">
                                <label for="star5" class="cursor-pointer"><i class="far fa-star"></i></label>
                            </div>
                        </div>
                        <div class="my-4">
                            <label for="username" class="sr-only">Nama</label>
                            <input type="text" name="username" id="username" placeholder="Ketik namamu disini"
                                class="p-4 rounded-xl font-medium w-full focus:outline-none focus:border-2 focus:border-yellow-400 focus:ring-2 ring-yellow-500 focus:shadow-lg">
                        </div>
                        <div class="mt-4 mb-8">
                            <label for="message" class="sr-only">Ulasan</label>
                            <textarea name="message" id="message" cols="30" rows="10" placeholder="Ketik ulasanmu disini"
                                class="p-4 rounded-xl font-medium w-full focus:outline-none focus:border-2 focus:border-yellow-400 focus:ring-2 ring-yellow-500 focus:shadow-lg"></textarea>
                        </div>
                        <div class="mt-4">
                            <input type="submit" value="Kirim Pesan"
                                class="py-2 px-10 rounded-xl font-medium bg-yellow-400 cursor-pointer transition-transform duration-300 ease-linear hover:bg-yellow-500 hover:scale-110 active:bg-yellow-600 active:scale-100">
                        </div>
                    </div>
                </form>
                <div class="hidden lg:flex lg:justify-center w-full lg:w-auto">
                    <img src="{{ asset('asset-view/assets/webp/contact.webp') }}" alt="Contact Illustration"
                        class="contact-img w-72 sm:w-96 lg:w-[400px]" loading="lazy" width="100%"
                        height="100%" />
                </div>
            </div>
        </div>
    </section>
    <!-- Contact Section End -->

    {{-- Ulasan Section Start --}}
    <section id="ulasan" class="ulasan-img">
        <h1 class="pt-10 pb-2 font-euphoria text-white text-center text-5xl lg:text-6xl">
            Apa Kata Mereka
        </h1>
        <div class="slider" aria-label="Customer reviews">
            <div class="slide-track">
                <!-- First set of reviews -->
                @foreach ($reviews as $review)
                    <div class="slide">
                        <div class="review">
                            <div class="review-message-wrapper">
                                <p class="review-message">{{ $review->message }}</p>
                            </div>
                            <div class="review-footer">
                                <p class="review-username">{{ $review->username }}</p>
                                <p class="review-rating">
                                    Rating:
                                    <span class="stars">
                                        @for ($i = 0; $i < $review->rating; $i++)
                                            <i class="fas fa-star"></i>
                                        @endfor
                                    </span>
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach

                <!-- Duplicate set for infinite scrolling -->
                @foreach ($reviews as $review)
                    <div class="ulasan-slide slide">
                        <div class="review">
                            <p class="review-message">{{ $review->message }}</p>
                            <div class="review-footer">
                                <p class="review-username">{{ $review->username }}</p>
                                <p class="review-rating">
                                    Rating:
                                    <span class="stars">
                                        @for ($i = 0; $i < $review->rating; $i++)
                                            <i class="fas fa-star"></i>
                                        @endfor
                                    </span>
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    {{-- Ulasan Section End --}}

    <!-- Footer Section Start -->
    <footer class="bg-black" id="#footer">
        <div class="container mx-auto px-4 py-6">
            <div class="flex flex-wrap justify-between items-center lg:justify-between gap-y-10">
                <!-- Logo -->
                <a href="#navbarHeader" class="logo-footer flex justify-center lg:justify-start w-full lg:w-auto">
                    <img src="{{ asset('asset-view/assets/svg/logo-navbar.svg') }}" alt="Logo" class="h-12"
                        width="100%" height="100%" loading="lazy" />
                </a>

                <!-- Account -->
                <div class="account-footer w-full sm:w-auto text-center">
                    <h3 class="font-medium text-white text-xl pb-3">Account</h3>
                    <div class="flex justify-center gap-4">
                        <a href="https://wa.me/+6283857185413" target="_blank">
                            <img src="{{ asset('asset-view/assets/svg/whatsapp_new.svg') }}" alt="WhatsApp"
                                height="100%" width="100%"
                                class="h-6 transition-transform duration-300 hover:scale-110" loading="lazy" />
                        </a>
                        <a href="https://www.instagram.com/bangbarasteak/" target="_blank">
                            <img src="{{ asset('asset-view/assets/svg/instagram.svg') }}" alt="Instagram"
                                height="100%" width="100%"
                                class="h-6 transition-transform duration-300 hover:scale-110" loading="lazy" />
                        </a>
                        <a href="https://www.tiktok.com/@bangbarasteak" target="_blank">
                            <img src="{{ asset('asset-view/assets/svg/tiktok.svg') }}" alt="TikTok" height="100%"
                                width="100%" class="h-6 transition-transform duration-300 hover:scale-110"
                                loading="lazy" />
                        </a>
                    </div>
                </div>

                <!-- Contact -->
                <div class="contact-footer w-full sm:w-auto text-center">
                    <h3 class="font-bold text-white text-xl pb-3">Kontak</h3>
                    <a href="https://wa.me/+6283857185413" target="_blank"
                        class="font-normal text-white text-lg hover:underline">
                        0838-5718-5413
                    </a>
                </div>

                <!-- Maps -->
                <div class="maps-footer w-full sm:w-auto text-center mt-6">
                    <h3 class="font-bold text-white text-xl pb-3">Maps</h3>
                    <a href="https://maps.app.goo.gl/QJJSghdQJtVT7pj77" target="_blank" class="inline-block">
                        <img src="{{ asset('asset-view/assets/webp/maps.webp') }}" alt="Google Maps" width="100%"
                            height="100%" class="h-16 transition duration-300 ease-in-out hover:scale-110"
                            loading="lazy" />
                    </a>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer Section End -->
</body>

<x-sweet-alert></x-sweet-alert>
<x-view-js></x-view-js>

<script src="{{ asset('asset-view/js/script.js') }}" defer></script>
<script src="{{ asset('asset-view/js/popup.js') }}" defer></script>

</html>
