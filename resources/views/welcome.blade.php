<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Bangbara - Post</title>
    <link rel="stylesheet" href="css/style.css" />
    <link rel="shortcut icon" href="{{ asset('assets/png/logo_bangbara.png') }}" type="image/x-icon">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- FONTS -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Alike&family=Alkatra:wght@400..700&family=Amiri:ital,wght@0,400;0,700;1,400;1,700&family=Euphoria+Script&family=Fraunces:ital,opsz,wght@0,9..144,100..900;1,9..144,100..900&family=Marmelad&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Protest+Riot&family=Qwigley&display=swap"
        rel="stylesheet" />
</head>
<style>
    .header-img {
        background-image: url("./assets/png/header.png");
        background-size: cover;
        background-position: center;
        min-height: 100vh;
    }

    .menu-img {
        background-image: url("./assets/png/menu.png");
        background-size: cover;
        background-position: center;
        min-height: 100vh;
    }

    .about-img {
        background-image: url("./assets/png/about.png");
        background-size: cover;
        background-position: center;
        min-height: 100vh;
    }

    .input-number::-webkit-outer-spin-button,
    .input-number::-webkit-inner-spin-button {
        appearance: none;
        margin: 0;
    }
</style>

<body>
    <section id="navbarHeader" class="header-img">
        <!-- Navbar Start -->
        <nav class="flex items-center justify-between px-6 py-4 bg-transparent">
            <div>
                <a href="#navbarHeader">
                    <img src="assets/svg/logo-navbar.svg" alt="Logo Navbar" width="150px" /></a>
            </div>
            <button id="hamburger" name="hamburger" type="button" class="block absolute right-4 lg:hidden">
                <span class="hamburger-line transition duration-300 ease-in-out origin-top-left"></span>
                <span class="hamburger-line transition duration-300 ease-in-out"></span>
                <span class="hamburger-line transition duration-300 ease-in-out origin-bottom-left"></span>
            </button>
            <div class="text-white">
                <a href="#navbarHeader"
                    class="inline-block text-lg mx-4 my-0 hover:text-kuning relative after:block after:content-[''] after:w-10 after:mx-auto after:h-1 after:bg-white after:scale-x-0 hover:after:scale-x-100 after:origin-center after:transition-transform hover:after:scale-50 after:rounded-full">Home</a>
                <a href="#menu"
                    class="inline-block text-lg mx-4 my-0 hover:text-kuning relative after:block after:content-[''] after:w-10 after:mx-auto after:h-1 after:bg-white after:scale-x-0 hover:after:scale-x-100 after:origin-center after:transition-transform hover:after:scale-50 after:rounded-full">Menu</a>
                <a href="#about"
                    class="inline-block text-lg mx-4 my-0 hover:text-kuning relative after:block after:content-[''] after:w-10 after:mx-auto after:h-1 after:bg-white after:scale-x-0 hover:after:scale-x-105 after:origin-center after:transition-transform hover:after:scale-50 after:rounded-full">About</a>
                <a href="#contact"
                    class="inline-block text-lg mx-4 my-0 hover:text-kuning relative after:block after:content-[''] after:w-10 after:mx-auto after:h-1 after:bg-white after:scale-x-0 hover:after:scale-x-150 after:origin-center after:transition-transform hover:after:scale-50 after:rounded-full">Contact</a>
            </div>
            <div>
                <a href="cart.html"><img src="assets/svg/cart.svg" alt="Cart" width="40px" /></a>
            </div>
        </nav>
        <!-- Navbar -->

        <div class="container">
            <div class="py-24 px-20">
                <h1 class="text-white text-7xl pb-6 font-europhia">
                    Rasa Juara, Harga Bersahabat!
                </h1>
                <p class="text-white font-fraunces text-lg max-w-[33rem] pb-16">
                    Bangbara hadir untuk Anda yang menginginkan sajian steak berkualitas
                    dengan cita rasa juara, namun tetap ramah di kantong. Dengan bahan
                    pilihan dan racikan khas, setiap hidangan kami dirancang untuk
                    memberikan pengalaman makan yang lezat dan memuaskan, tanpa harus
                    menguras dompet.
                </p>
                <a href="#menu"
                    class="font-protest text-lg text-white text-center bg-kuning px-8 p-5 rounded-full shadow-md hover:shadow-xl hover:opacity-80 transition duration-300 ease-in-out">Cek
                    Selengkapnya</a>
            </div>
        </div>
    </section>
    <!-- Hero Section End -->

    <!-- Menu Section Start -->
    <section id="menu" class="menu-img">
        <div class="flex">
            <span class=""></span>
            <div
                class="flex items-center bg-kuning mx-auto my-4 py-2 px-16 text-center rounded-2xl shadow-md shadow-kuning">
                <img src="assets/svg/book.svg" alt="" width="100px" class="mr-4" />
                <h1 class="font-qwigley text-6xl text-white">Menu Kami</h1>
            </div>
            <span class=""></span>
        </div>
        <div id="menu-container" class="grid grid-cols-3 gap-4 mx-auto py-10 w-[55rem] text-center">
            <!-- Bagian Header -->
            <div>
                <a href="#"
                    class="relative text-white font-qwigley text-5xl hover:text-yellow-400 after:absolute after:left-0 after:bottom-0 after:h-[2px] after:w-full after:bg-white hover:after:bg-yellow-400">
                    Makanan
                </a>
            </div>

            <div>
                <a href="#"
                    class="relative text-white font-qwigley text-5xl hover:text-yellow-400 after:absolute after:left-0 after:bottom-0 after:h-[2px] after:w-full after:bg-white hover:after:bg-yellow-400">
                    Minuman
                </a>
            </div>
            <div>
                <a href="#"
                    class="relative text-white font-qwigley text-5xl hover:text-yellow-400 after:absolute after:left-0 after:bottom-0 after:h-[2px] after:w-full after:bg-white hover:after:bg-yellow-400">
                    Extra
                </a>
            </div>

            <!-- Bagian Kotak Kuning -->
            <div class="flex justify-center py-10">
                <div class="bg-white h-60 w-40 rounded-md flex flex-col items-center gap-2">
                    <img src="./assets/png/food/1.png" alt="" class="overflow-hidden" />
                    <p class="text-text text-xs font-marmelad text-center">
                        Steak Terderloin Meltique
                    </p>
                    <span class="text-price font-alkatra text-[0.6rem] text-center">
                        Rp. 38.000,00
                    </span>
                    <a href=""
                        class="font-marmelad text-[0.6rem] bg-[#BF0000] px-4 py-2 rounded-full text-white">
                        Tambahkan Ke Keranjang
                    </a>
                </div>
            </div>
            <div class="flex justify-center py-10">
                <div class="bg-white h-60 w-40 rounded-md flex flex-col items-center gap-2">
                    <img src="./assets/png/food/1.png" alt="" class="overflow-hidden" />
                    <p class="text-text text-xs font-marmelad text-center">
                        Steak Terderloin Meltique
                    </p>
                    <span class="text-price font-alkatra text-[0.6rem] text-center">
                        Rp. 38.000,00
                    </span>
                    <a href=""
                        class="font-marmelad text-[0.6rem] bg-[#BF0000] px-4 py-2 rounded-full text-white">
                        Tambahkan Ke Keranjang
                    </a>
                </div>
            </div>
            <div class="flex justify-center py-10">
                <div class="bg-white h-60 w-40 rounded-md flex flex-col items-center gap-2">
                    <img src="./assets/png/food/1.png" alt="" class="overflow-hidden" />
                    <p class="text-text text-xs font-marmelad text-center">
                        Steak Terderloin Meltique
                    </p>
                    <span class="text-price font-alkatra text-[0.6rem] text-center">
                        Rp. 38.000,00
                    </span>
                    <a href=""
                        class="font-marmelad text-[0.6rem] bg-[#BF0000] px-4 py-2 rounded-full text-white">
                        Tambahkan Ke Keranjang
                    </a>
                </div>
            </div>
            <div class="flex justify-center py-10">
                <div class="bg-white h-60 w-40 rounded-md flex flex-col items-center gap-2">
                    <img src="./assets/png/food/1.png" alt="" class="overflow-hidden" />
                    <p class="text-text text-xs font-marmelad text-center">
                        Steak Terderloin Meltique
                    </p>
                    <span class="text-price font-alkatra text-[0.6rem] text-center">
                        Rp. 38.000,00
                    </span>
                    <a href=""
                        class="font-marmelad text-[0.6rem] bg-[#BF0000] px-4 py-2 rounded-full text-white">
                        Tambahkan Ke Keranjang
                    </a>
                </div>
            </div>
            <div class="flex justify-center py-10">
                <div class="bg-white h-60 w-40 rounded-md flex flex-col items-center gap-2">
                    <img src="./assets/png/food/1.png" alt="" class="overflow-hidden" />
                    <p class="text-text text-xs font-marmelad text-center">
                        Steak Terderloin Meltique
                    </p>
                    <span class="text-price font-alkatra text-[0.6rem] text-center">
                        Rp. 38.000,00
                    </span>
                    <a href=""
                        class="font-marmelad text-[0.6rem] bg-[#BF0000] px-4 py-2 rounded-full text-white">
                        Tambahkan Ke Keranjang
                    </a>
                </div>
            </div>
            <div class="flex justify-center py-10">
                <div class="bg-white h-60 w-40 rounded-md flex flex-col items-center gap-2">
                    <img src="./assets/png/food/1.png" alt="" class="overflow-hidden" />
                    <p class="text-text text-xs font-marmelad text-center">
                        Steak Terderloin Meltique
                    </p>
                    <span class="text-price font-alkatra text-[0.6rem] text-center">
                        Rp. 38.000,00
                    </span>
                    <a href=""
                        class="font-marmelad text-[0.6rem] bg-[#BF0000] px-4 py-2 rounded-full text-white">
                        Tambahkan Ke Keranjang
                    </a>
                </div>
            </div>
        </div>
    </section>
    <!-- Menu Section End -->

    <!-- About Section Start -->
    <section id="about" class="about-img">
        <div class="container flex justify-end">
            <div class="flex flex-col">
                <h1 class="font-europhia text-7xl text-white py-16 px-14 max-w-[33rem ]">
                    Tentang Kami
                </h1>
                <p class="font-fraunces text-xl font-medium text-white px-14 max-w-[45rem]">
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
    <section id="contact" class="bg-[#FFE8A3] min-h-screen">
        <h1 class="text-black font-europhia text-center text-6xl py-10">
            Kontak Kami
        </h1>
        <div class="flex justify-around pb-10">
            <form action="# " method="post">
                <div class="bg-kuning p-9 rounded-2xl">
                    <div class="flex gap-x-5">
                        <input type="email" placeholder="Email"
                            class="p-4 rounded-xl h-12 font-alkatra flex-1 border-2 border-solid border-orange-400 focus:outline-none focus:border-red-500 focus:shadow-xl placeholder:text-[#827E7E] placeholder:font-medium" />
                        <input type="number" placeholder="No. Telepon"
                            class="input-number p-4 rounded-xl h-12 font-alkatra flex-1 border-2 border-solid border-orange-400 focus:outline-none focus:border-red-500 focus:shadow-xl placeholder:text-[#827E7E] placeholder:font-medium" />
                    </div>
                    <div class="mt-5">
                        <input type="text" placeholder="Nama"
                            class="p-4 rounded-xl h-12 font-alkatra w-full border-2 border-solid border-orange-400 focus:outline-none focus:border-red-500 focus:shadow-xl placeholder:text-[#827E7E] placeholder:font-medium placeholder:text-center" />
                        <textarea name="message" id="message" rows="10"
                            class="mt-5 p-4 w-full rounded-xl font-alkatra border-2 border-solid border-orange-400 focus:outline-none focus:border-red-500 focus:shadow-xl placeholder:text-[#827E7E] placeholder:font-medium"
                            placeholder="Pesan:"></textarea>
                        <a href=""
                            class="flex mt-4 px-6 py-4 bg-red-600 justify-center shadow-2xl text-white font-alkatra font-medium text-xl rounded-3xl transition duration-300 ease-in-out hover:bg-red-700 hover:scale-105 active:opacity-80 active:scale-100">Kirim
                            Pesan</a>
                    </div>
                </div>
            </form>
            <img src="assets/svg/contact.svg" alt="" width="400" />
        </div>
    </section>

    <!-- Contact Section End -->
    <footer class="bg-black">
        <div class="container">
            <div class="flex flex-wrap justify-between">
                <img src="assets/svg/logo-navbar.svg" alt="100px" class="p-4" />
                <div class="mt-12 mb-6">
                    <h3 class="font-amiri text-white text-xl text-center pb-3">
                        Account
                    </h3>
                    <div class="flex text-center text-white">
                        <a href=""><img src="assets/svg/whatsapp.svg" alt="" width="40px"
                                class="px-2" /></a>
                        <a href=""><img src="assets/svg/instagram.svg" alt="" width="40px"
                                class="px-2" /></a>
                        <a href=""><img src="assets/svg/tiktok.svg" alt="" width="40px"
                                class="px-2" /></a>
                        <a href=""><img src="assets/svg/facebook.svg" alt="" width="40px"
                                class="px-2" /></a>
                    </div>
                </div>
                <div class="mt-12 mb-6 mx-10">
                    <h3 class="font-amiri text-white text-xl text-center pb-3">
                        Kontak
                    </h3>
                    <span class="font-amiri text-white text-lg text-center">+6283857185413</span>
                </div>
                <div class="mt-12 mb-6 mx-10">
                    <h3 class="font-amiri text-white text-xl text-center pb-3">Maps</h3>
                    <img src="assets/svg/maps.svg" alt="" width="100px" />
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer Section End -->
</body>
<script src="js/script.js"></script>

</html>
