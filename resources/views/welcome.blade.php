<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
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
    <!-- Header Start -->
    <header class="bg-transparent absolute top-0 left-0 w-full flex items-center z-10">
        <div class="container mx-auto px-4">
            <div class="flex items-center justify-between">
                <!-- Logo -->
                <div class="py-6">
                    <a href="#home">
                        <img src="{{ asset('asset-view/assets/svg/logo-navbar.svg') }}" alt="Logo" width="150px" />
                    </a>
                </div>

                <!-- Navigation and Controls -->
                <div class="flex items-center">
                    <!-- Navigation Menu -->
                    <nav id="nav-menu"
                        class="hidden absolute top-full right-4 py-5 bg-transparent backdrop-blur-xl shadow-2xl rounded-lg max-w-[250px] w-full lg:static lg:block lg:max-w-none lg:shadow-none lg:rounded-none lg:w-auto lg:mx-auto">
                        <ul class="block lg:flex lg:gap-8">
                            <li class="group">
                                <a href="#home"
                                    class="text-base text-white py-2 mx-4 flex font-medium relative group-hover:text-primary after:content-[''] after:absolute after:bottom-0 after:left-1/2 after:w-0 after:h-[2px] after:bg-white after:transition-all after:duration-300 after:transform after:-translate-x-1/2 group-hover:after:w-3/4">
                                    Home
                                </a>
                            </li>
                            <li class="group">
                                <a href="#menu"
                                    class="text-base text-white py-2 mx-4 flex font-medium relative group-hover:text-primary after:content-[''] after:absolute after:bottom-0 after:left-1/2 after:w-0 after:h-[2px] after:bg-white after:transition-all after:duration-300 after:transform after:-translate-x-1/2 group-hover:after:w-3/4">
                                    Menu
                                </a>
                            </li>
                            <li class="group">
                                <a href="#about"
                                    class="text-base text-white py-2 mx-4 flex font-medium relative group-hover:text-primary after:content-[''] after:absolute after:bottom-0 after:left-1/2 after:w-0 after:h-[2px] after:bg-white after:transition-all after:duration-300 after:transform after:-translate-x-1/2 group-hover:after:w-3/4">
                                    About
                                </a>
                            </li>
                            <li class="group">
                                <a href="#contact"
                                    class="text-base text-white py-2 mx-4 flex font-medium relative group-hover:text-primary after:content-[''] after:absolute after:bottom-0 after:left-1/2 after:w-0 after:h-[2px] after:bg-white after:transition-all after:duration-300 after:transform after:-translate-x-1/2 group-hover:after:w-3/4">
                                    Contact
                                </a>
                            </li>
                        </ul>
                    </nav>

                    <!-- Cart and Hamburger Menu -->
                    <div class="flex items-center space-x-4 lg:hidden">
                        <!-- Clock Icon -->
                        <a href="{{ route('history') }}">
                            <img src="{{ asset('asset-view/assets/svg/clock.svg') }}" alt="" width="35px"
                                class="hover:scale-110 transition duration-300 ease-in-out" />
                        </a>

                        <!-- Cart Icon -->
                        <a href="{{ route('cart') }}">
                            <img src="{{ asset('asset-view/assets/svg/cart.svg') }}" alt="Cart" width="40px"
                                class="hover:scale-110 transition duration-300 ease-in-out" />
                        </a>
                        <!-- Hamburger Menu -->
                        <button id="hamburger" name="hamburger" type="button" class="block">
                            <span
                                class="hamburger-line block w-6 h-1 bg-white transition duration-300 ease-in-out origin-top-left mb-1"></span>
                            <span
                                class="hamburger-line block w-6 h-1 bg-white transition duration-300 ease-in-out mb-1"></span>
                            <span
                                class="hamburger-line block w-6 h-1 bg-white transition duration-300 ease-in-out origin-bottom-left"></span>
                        </button>
                    </div>
                </div>

                <!-- Cart and Clock Icon (Desktop Only) -->
                <div class="hidden lg:flex lg:items-center lg:space-x-4">
                    <!-- Clock Icon -->
                    <a href="{{ route('history') }}">
                        <img src="{{ asset('asset-view/assets/svg/clock.svg') }}" alt="" width="35px"
                            class="hover:scale-110 transition duration-300 ease-in-out" />
                    </a>

                    <!-- Cart Icon -->
                    <a href="{{ route('cart') }}">
                        <img src="{{ asset('asset-view/assets/svg/cart.svg') }}" alt="Cart" width="40px"
                            class="hover:scale-110 transition duration-300 ease-in-out" />
                    </a>
                </div>
            </div>
        </div>
    </header>

    <!-- Header End -->

    <!-- Hero Section Start -->
    <section id="home" class="pt-36 header-img bg-cover bg-center">
        <div class="container mx-auto px-4">
            <div class="flex flex-wrap items-center">
                <!-- Konten -->
                <div class="w-full lg:w-3/4 px-4 text-center lg:text-left">
                    <h1
                        class="font-europhia text-white text-4xl sm:text-5xl md:text-6xl lg:text-7xl mt-4 mb-6 leading-tight">
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
                        class="text-base sm:text-lg md:text-xl lg:text-2xl font-europhia text-white bg-primary py-3 px-6 md:py-4 md:px-8 rounded-full shadow-lg hover:shadow-xl hover:opacity-80 transition duration-300 ease-in-out">Cek
                        Selengkapnya</a>
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
                <img src="{{ asset('asset-view/assets/svg/book.svg') }}" alt="" width="120px"
                    class="mr-4" />
                <h1 class="font-europhia text-shadow text-4xl sm:text-5xl lg:text-6xl text-white">
                    Menu Kami
                </h1>
            </div>

            <!-- Tab Navigation -->
            <div class="w-full py-6 text-center">
                <div class="flex flex-wrap justify-center gap-x-14 gap-y-4">
                    <button onclick="changeSlide(0)"
                        class="menu-link relative text-white font-europhia text-3xl sm:text-4xl lg:text-5xl hover:text-yellow-400 after:absolute after:left-0 after:bottom-0 after:h-[2px] after:rounded-full after:w-full after:bg-white hover:after:bg-yellow-400 active">
                        Makanan
                    </button>
                    <button onclick="changeSlide(1)"
                        class="menu-link relative text-white font-europhia text-3xl sm:text-4xl lg:text-5xl hover:text-yellow-400 after:absolute after:left-0 after:bottom-0 after:h-[2px] after:rounded-full after:w-full after:bg-white hover:after:bg-yellow-400">
                        Minuman
                    </button>
                    <button onclick="changeSlide(2)"
                        class="menu-link relative text-white font-europhia text-3xl sm:text-4xl lg:text-5xl hover:text-yellow-400 after:absolute after:left-0 after:bottom-0 after:h-[2px] after:rounded-full after:w-full after:bg-white hover:after:bg-yellow-400">
                        Extra
                    </button>
                </div>
            </div>

            <!-- Slider Container -->
            <div id="slider" class="relative overflow-hidden w-full mt-10">
                <div id="slider-content" class="flex transition-transform duration-500" style="width: 300%">
                    <!-- Slide 1: Makanan Start -->
                    @foreach ($products as $product)
                        <div class="w-full grid grid-cols-3 sm:grid-cols-2 lg:grid-cols-3 gap-6 px-4">
                            <div class="flex justify-center py-5 sm:py-1">
                                <div
                                    class="bg-white h-[21rem] w-48 sm:h-80 sm:w-56 lg:h-96 lg:w-64 rounded-md flex flex-col items-center gap-3">
                                    <a href="" id="item-modal-button" class="item-detail-button">
                                        <div class="relative group">
                                            <img src="{{ asset('storage/' . $product->gambar_menu) }}"
                                                alt="{{ Storage::url($product->nama_menu) }}"
                                                class="overflow-hidden rounded-t-md transition-all duration-300 ease-in-out group-hover:brightness-75" />
                                            <div
                                                class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-50 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                                <p class="text-white font-semibold text-base">
                                                    View More
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                    <p class="text-text text-base text-center">
                                        {{ $product->nama_menu }}
                                    </p>
                                    <span class="text-price font-alkatra text-sm text-center">
                                        Rp {{ $product->harga_menu }}
                                    </span>
                                    <a href=""
                                        class="text shadow text-sm sm:text-sm bg-[#BF0000] px-2 py-1 sm:px-4 sm:py-2 rounded-full text-white text-center">
                                        Tambahkan Ke Keranjang
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <!-- Slide 1: Makanan End -->

                    <!-- Slide 2: Minuman Start -->
                    <div class="w-full grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 px-4">
                        <div class="flex justify-center py-5">
                            <div
                                class="bg-white h-72 w-48 sm:h-80 sm:w-56 lg:h-96 lg:w-64 rounded-md flex flex-col items-center gap-3">
                                <a href="" id="item-modal-button" class="item-detail-button">
                                    <div class="relative group">
                                        <img src="./assets/png/drink/1.png" alt="Drink"
                                            class="overflow-hidden rounded-t-md transition-all duration-300 ease-in-out group-hover:brightness-75" />
                                        <div
                                            class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-50 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                            <p class="text-white font-semibold text-base">
                                                View More
                                            </p>
                                        </div>
                                    </div>
                                </a>
                                <p class="text-text text-sm font-marmelad text-center">
                                    Air Mineral
                                </p>
                                <span class="text-price font-alkatra text-sm text-center">
                                    Rp. 5.000,00
                                </span>
                                <a href=""
                                    class="font-marmelad text-sm bg-[#BF0000] px-5 py-2 rounded-full text-white">Tambahkan
                                    Ke Keranjang</a>
                            </div>
                        </div>
                    </div>
                    <!-- Slide 2: Minuman End -->

                    <!-- Slide 3: Extra Start -->
                    <div class="w-full grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 px-4">
                        <div class="flex justify-center py-5">
                            <div
                                class="bg-white h-72 w-48 sm:h-80 sm:w-56 lg:h-96 lg:w-64 rounded-md flex flex-col items-center gap-3">
                                <a href="" id="item-modal-button" class="item-detail-button">
                                    <div class="relative group">
                                        <img src="./assets/png/extra/1.png" alt="Extra"
                                            class="overflow-hidden rounded-t-md transition-all duration-300 ease-in-out group-hover:brightness-75" />
                                        <div
                                            class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-50 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                            <p class="text-white font-semibold text-base">
                                                View More
                                            </p>
                                        </div>
                                    </div>
                                </a>
                                <p class="text-text text-sm font-marmelad text-center">
                                    Sate Dakkochi
                                </p>
                                <span class="text-price font-alkatra text-sm text-center">
                                    Rp. 5.000,00
                                </span>
                                <a href=""
                                    class="font-marmelad text-sm bg-[#BF0000] px-5 py-2 rounded-full text-white">Tambahkan
                                    Ke Keranjang</a>
                            </div>
                        </div>
                    </div>
                    <!-- Slide 3: Extra End -->
                </div>
            </div>
        </div>
    </section>
    <!-- Menu Section End -->

    <!-- About Section Start -->
    <section id="about" class="about-img">
        <div class="container flex justify-end sm:px-8 lg:px-16">
            <div class="flex flex-col items-center sm:items-start">
                <h1
                    class="font-europhia text-5xl sm:text-6xl lg:text-7xl text-white py-8 sm:py-12 lg:py-16 px-4 sm:px-8 lg:px-14 max-w-[20rem] sm:max-w-[30rem] lg:max-w-[33rem] text-center sm:text-left">
                    Tentang Kami
                </h1>
                <p
                    class="text-base sm:text-lg lg:text-xl font-normal text-shadow text-white px-4 sm:px-8 lg:px-14 max-w-[28rem] sm:max-w-[40rem] lg:max-w-[45rem]">
                    Bangbara adalah tempat makan yang menghadirkan steak dan chicken
                    katsu dengan cita rasa istimewa. Dengan bahan berkualitas dan harga
                    yang terjangkau, Bangbara menjadi pilihan tepat untuk menikmati
                    hidangan lezat bersama keluarga atau teman. Suasana yang nyaman dan
                    pelayanan ramah membuat setiap kunjungan menjadi pengalaman yang
                    menyenangkan.
                </p>
            </div>
        </div>
    </section>
    <!-- About Section End -->

    <!-- Contact Section Start -->
    <section id="contact" class="bg-[#FFF890] min-h-screen">
        <div class="container mx-auto px-4">
            <div class="flex justify-center py-4 mb-8">
                <a href=""
                    class="py-4 px-12 bg-[#CC0000] rounded-full text-center text-4xl font-europhia shadow-lg text-white cursor-default sm:text-5xl lg:text-6xl">
                    Berikan Rating & Ulasan
                </a>
            </div>
            <div class="flex flex-wrap justify-center lg:justify-around items-center pb-10 gap-8 shadow-lg">
                <form action="#" method="POST" class="w-full lg:w-1/2">
                    <div class="bg-[#F5EB55] p-6 sm:p-9 rounded-2xl ring-1 ring-[#BBB34E]">
                        <div class="flex justify-between">
                            <h5 class="font-medium text-lg">Kualitas Produk</h5>
                            <div class="flex gap-2 text-lg">
                                <i class="far fa-star"></i>
                                <i class="far fa-star"></i>
                                <i class="far fa-star"></i>
                                <i class="far fa-star"></i>
                                <i class="far fa-star"></i>
                            </div>
                        </div>
                        <input type="text" name="username" id="username" placeholder="Ketik namamu disini"
                            class="p-4 my-4 rounded-xl font-medium w-full focus:outline-none focus:border-2 focus:border-yellow-400 focus:ring-2 ring-yellow-500 focus:shadow-lg">
                        <textarea name="message" id="message" cols="30" rows="10" placeholder="Ketik ulasanmu disini"
                            class="p-4 my-4 rounded-xl font-medium w-full focus:outline-none focus:border-2 focus:border-yellow-400 focus:ring-2 ring-yellow-500 focus:shadow-lg"></textarea>
                        <div class="mt-6">
                            <a href="#"
                                class="py-2 px-12 rounded-xl font-medium bg-[#FFA500] transition duration-100 ease-linear hover:bg-[#F59F00] hover:scale-105 active:bg-[#EA9800] active:scale-110">Kirim
                                Pesan
                            </a>
                        </div>
                    </div>
                </form>
                <div class="w-full lg:w-auto flex justify-center">
                    <img src="{{ asset('asset-view/assets/svg/contact.svg') }}" alt="Contact Illustration"
                        class="w-72 sm:w-96 lg:w-[400px]" />
                </div>
            </div>
        </div>
    </section>
    <!-- Contact Section End -->

    <style>
        @keyframes marquee {
            0% {
                transform: translateX(0);
            }

            100% {
                transform: translateX(-100%);
            }
        }

        .animate-marquee {
            display: flex;
            animation: marquee 15s linear infinite;
            white-space: normal;
        }
    </style>

    {{-- Ulasan Section Start --}}
    <section id="ulasan" class="ulasan-img">
        <div class="container">
            <h1 class="py-6 font-europhia text-white text-center text-4xl sm:text-5xl lg:text-6xl">Apa Kata Mereka</h1>
            <div class="overflow-hidden w-full" x-data="{ start() { this.$refs.track.style.animationPlayState = 'running' }, stop() { this.$refs.track.style.animationPlayState = 'paused' } }">
                <div class="flex w-max space-x-8 animate-marquee" x-ref="track">
                    <template x-for="i in 5" :key="i">
                        <div
                            class="carousel-item bg-white text-black rounded-lg shadow-lg  max-w-sm border-4 border-[##D6D6D6] w-96   overflow-hidden">
                            <p class="text-center px-4 py-8">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                incididunt ut labore et dolore magna aliqua.
                            </p>
                            <div class="px-4 py-2 border-t-2 border-[#D6D6D6]">
                                <p class="font-semibold text-gray-500">Kunto Aji</p>
                                <p class="flex font-semibold text-gray-500">Rating:
                                    <span class="flex items-center text-xl mx-2 gap-1 text-yellow-500">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </span>
                                </p>
                            </div>
                        </div>
                    </template>
                </div>
            </div>
        </div>
    </section>
    {{-- Ulasan Section End --}}

    <!-- Footer Section Start -->
    <footer class="bg-black">
        <div class="container mx-auto px-4 py-6">
            <div class="flex flex-wrap justify-between items-center lg:justify-between gap-y-10">
                <!-- Logo -->
                <a href="#navbarHeader" class="flex justify-center lg:justify-start w-full lg:w-auto">
                    <img src="{{ asset('asset-view/assets/svg/logo-navbar.svg') }}" alt="Logo" height=""
                        class="h-12" />
                </a>

                <!-- Account -->
                <div class="w-full sm:w-auto text-center">
                    <h3 class="font-medium text-white text-xl pb-3">Account</h3>
                    <div class="flex justify-center gap-4">
                        <a href="https://wa.me/+6283857185413" target="_blank">
                            <img src="{{ asset('asset-view/assets/svg/whatsapp_new.svg') }}" alt="WhatsApp"
                                class="h-6 transition-transform duration-300 hover:scale-110" />
                        </a>
                        <a href="" target="_blank">
                            <img src="{{ asset('asset-view/assets/svg/instagram.svg') }}" alt="Instagram"
                                class="h-6 transition-transform duration-300 hover:scale-110" />
                        </a>
                        <a href="https://www.tiktok.com/@bangbarasteak" target="_blank"><img
                                src="{{ asset('asset-view/assets/svg/tiktok.svg') }}" alt="TikTok"
                                class="h-6 transition-transform duration-300 hover:scale-110" />
                        </a>
                        <a href=""><img src="{{ asset('asset-view/assets/svg/facebook.svg') }}"
                                alt="Facebook" class="h-6 transition-transform duration-300 hover:scale-110" />
                        </a>
                    </div>
                </div>

                <!-- Contact -->
                <div class="w-full sm:w-auto text-center">
                    <h3 class="font-bold text-white text-xl pb-3">Kontak</h3>
                    <a href="https://wa.me/+6283857185413" target="_blank"
                        class="font-normal text-white text-lg hover:underline">
                        0838-5718-5413
                    </a>
                </div>

                <!-- Maps -->
                <div class="w-full sm:w-auto text-center mt-6">
                    <h3 class="font-bold text-white text-xl pb-3">Maps</h3>
                    <a href="https://maps.app.goo.gl/QJJSghdQJtVT7pj77" target="_blank" class="inline-block">
                        <img src="{{ asset('asset-view/assets/svg/maps.svg') }}" alt="Google Maps" width=""
                            class="h-16 transition duration-300 ease-in-out hover:scale-110" />
                    </a>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer Section End -->

    <!-- POPUP START -->
    <section id="popup">
        <div class="hidden fixed z-[9999] left-0 top-0 w-full h-full overflow-auto justify-center items-center bg-[rgba(0,0,0,0.6)]"
            id="item-detail-modal" name="modal">
            <div class="flex flex-col bg-white h-3/4 w-[90%] md:w-1/2 lg:w-1/3 xl:w-1/4 rounded-lg gap-2"
                name="modal-container">
                <a href="#"
                    class="close-icon absolute bg-white w-8 h-8 m-2 rounded-full flex items-center justify-center hover:scale-125 hover:rotate-90 transition duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="currentColor" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="feather feather-x text-primary">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </a>
                <img src="./assets/png/food/1.png" alt="Food" width=""
                    class="rounded-t-lg overflow-hidden" />
                <h1 class="text-center font-alatsi text-2xl pb-2">Product 1</h1>
                <p class="text-center font-alatsi text-base px-4">
                    Lorem, ipsum dolor sit amet consectetur adipisicing elit. Error
                    tenetur vitae ducimus facilis non obcaecati veniam dolore, esse
                    consectetur fuga.
                </p>
                <a href="#"
                    class="bg-[#BF0000] px-4 py-2 font-marmelad text-white rounded-md my-4 mx-auto w-3/4 text-center">
                    Tambahkan Ke Keranjang
                </a>
            </div>
        </div>
    </section>
    {{-- POP UP END --}}
</body>
<script src="{{ asset('asset-view/js/script.js') }}"></script>

</html>
