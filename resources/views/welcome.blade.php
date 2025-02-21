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

    <link rel="stylesheet" href="{{ asset('asset-view/css/slider.css') }}">

    <!-- ICON -->
    <link rel="icon" href="{{ asset('asset-view/assets/png/logo_bangbara.png') }}" />
    <!-- ICON WEB -->
    <link rel="shortcut icon" href="{{ asset('asset-view/assets/png/logo_bangbara.png') }}" type="image/x-icon">

    <!-- FONTS -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Euphoria+Script&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet" />

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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

                <div class="hidden lg:block lg:items-center lg:space-x-4">
                    <!-- Cart Icon -->
                    <a href="{{ route('cart') }}" class=" relative">
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
            <div id="slider" class="relative overflow-hidden w-full max-w-screen-lg mx-auto mt-10">
                <div id="slider-content" class="flex transition-transform duration-500 justify-center"
                    style="width: 300%">

                    @foreach ($categories as $category)
                        <div
                            class="w-full grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-3 gap-6 px-4 py-5 justify-start">
                            @foreach ($category->products as $product)
                                <div
                                    class="product-card bg-white h-[21rem] w-48 sm:h-80 sm:w-56 lg:h-96 lg:w-64 rounded-md flex flex-col items-center gap-3">
                                    <a href="#item-detail-modal" class="item-detail-button">
                                        <div class="relative group">
                                            <img src="{{ asset('storage/' . $product->gambar_menu) }}"
                                                alt="{{ $product->nama_menu }}"
                                                class="overflow-hidden rounded-t-md transition-all duration-300 ease-in-out group-hover:brightness-75" />
                                            <div
                                                class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-50 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                                <span class="text-white font-semibold text-base">View More</span>
                                            </div>
                                        </div>
                                    </a>
                                    <p class="text-text text-base text-center">{{ $product->nama_menu }}</p>
                                    <h6 class="hidden">{{ $product->deskripsi_menu }}</h6>
                                    <span class="text-price font-alkatra text-sm text-center">Rp
                                        {{ number_format($product->harga_menu, 0, ',', '.') }}</span>


                                    <form action="{{ route('cart.add') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <button type="submit"
                                            class="text shadow text-sm sm:text-sm bg-[#BF0000] px-2 py-1 sm:px-4 sm:py-2 rounded-full text-white text-center">
                                            Tambahkan Ke Keranjang
                                        </button>
                                    </form>
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <!-- Menu Section End -->

    <!-- POPUP START -->
    <section id="popup">
        <div class="hidden fixed z-[9999] left-0 top-0 w-full h-full overflow-auto justify-center items-center bg-[rgba(0,0,0,0.6)]"
            id="item-detail-modal" name="modal">
            <div class="flex flex-col bg-white h-3/4 w-[90%] md:w-1/2 lg:w-1/3 xl:w-1/4 rounded-lg gap-2 overflow-hidden"
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
                <input type="hidden" id="modal-product-id" name="product_id" value="">
                <img id="modal-image" src="" alt="Food" class="rounded-t-lg overflow-hidden" />
                <h1 id="modal-title" class="text-center font-alatsi text-2xl pb-2"></h1>
                <p id="modal-description" class="text-center font-alatsi text-base px-4"></p>

                <div class="flex justify-center items-center flex-row my-4">
                    <!-- Decrease Quantity -->
                    <button id="decrease-qty" class="group rounded-l-sm border border-black/80 px-2 py-2">
                        <span class="inline-block transform transition-transform duration-200 group-hover:scale-125"> -
                        </span>
                    </button>

                    <!-- Display Quantity -->
                    <input type="text" id="modal-quantity"
                        class="border-y border-black/80 px-2 py-2 text-center w-1/4 focus:outline-none" value="1"
                        readonly>

                    <!-- Increase Quantity -->
                    <button id="increase-qty" class="group rounded-r-sm border border-black/80 px-2 py-2">
                        <span class="inline-block transform transition-transform duration-200 group-hover:scale-125"> +
                        </span>
                    </button>
                </div>

                <button id="add-to-cart-modal"
                    class="bg-[#BF0000] w-full px-4 py-2 font-marmelad text-white rounded-b-md mt-auto"
                    data-url="{{ route('cart.add') }}" data-id="">
                    Tambahkan Ke Keranjang
                </button>

            </div>
        </div>
    </section>
    {{-- POP UP END --}}

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const itemDetailModal = document.querySelector("#item-detail-modal");
            const itemDetailButtons = document.querySelectorAll(".item-detail-button");
            const closeButton = document.querySelector(".close-icon");
            const addToCartButton = document.querySelector("#add-to-cart-modal");
            const quantityInput = document.querySelector("#modal-quantity");
            const decreaseQtyButton = document.querySelector("#decrease-qty");
            const increaseQtyButton = document.querySelector("#increase-qty");

            // Pastikan CSRF token tersedia
            let csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            // Event saat tombol "View More" diklik
            itemDetailButtons.forEach((btn) => {
                btn.onclick = (e) => {
                    e.preventDefault();

                    const productCard = btn.closest(".product-card");
                    const productId = productCard.querySelector("input[name='product_id']").value;
                    const productImage = productCard.querySelector("img").src;
                    const productName = productCard.querySelector("p").innerText;
                    const productDescription = productCard.querySelector("h6").innerText;

                    if (!productId) {
                        alert("Produk tidak ditemukan!");
                        return;
                    }

                    // Update isi modal
                    itemDetailModal.querySelector("img").src = productImage;
                    itemDetailModal.querySelector("h1").innerText = productName;
                    itemDetailModal.querySelector("p").innerText = productDescription;

                    // Set product ID di input hidden dalam modal
                    document.querySelector("#modal-product-id").value = productId;

                    // Tampilkan modal
                    itemDetailModal.classList.remove("hidden");
                    itemDetailModal.classList.add("flex");
                };
            });

            // Tutup modal saat tombol close diklik
            closeButton.onclick = () => closeModal();
            itemDetailModal.onclick = (e) => {
                if (e.target === itemDetailModal) closeModal();
            };

            function closeModal() {
                itemDetailModal.classList.add("hidden");
                itemDetailModal.classList.remove("flex");
            }

            // Fitur tambah/kurang quantity dalam modal
            increaseQtyButton.onclick = () => {
                quantityInput.value = parseInt(quantityInput.value) + 1;
            };

            decreaseQtyButton.onclick = () => {
                let currentQty = parseInt(quantityInput.value);
                if (currentQty > 1) quantityInput.value = currentQty - 1;
            };

            // Event untuk menambahkan produk ke keranjang
            addToCartButton.onclick = function() {
                let productId = itemDetailModal.querySelector("input[name='product_id']").value;
                let quantity = quantityInput.value;
                let url = this.dataset.url;

                // Cek apakah productId dan URL benar
                console.log("Product ID:", productId);
                console.log("Quantity:", quantity);
                console.log("URL:", url);

                if (!productId) {
                    alert("Produk tidak valid! ID tidak ditemukan.");
                    return;
                }

                // Buat form untuk dikirim ke Laravel
                let form = document.createElement("form");
                form.method = "POST";
                form.action = url;

                // Tambahkan CSRF token
                let csrfInput = document.createElement("input");
                csrfInput.type = "hidden";
                csrfInput.name = "_token";
                csrfInput.value = csrfToken;
                form.appendChild(csrfInput);

                // Tambahkan product_id
                let productInput = document.createElement("input");
                productInput.type = "hidden";
                productInput.name = "product_id";
                productInput.value = productId;
                form.appendChild(productInput);

                // Tambahkan quantity
                let quantityInputField = document.createElement("input");
                quantityInputField.type = "hidden";
                quantityInputField.name = "quantity";
                quantityInputField.value = quantity;
                form.appendChild(quantityInputField);

                document.body.appendChild(form);
                form.submit();
            };
        });
    </script>

    <!-- About Section Start -->
    <section id="about" class="bg-red-600 flex justify-center items-center min-h-screen">
        <div class="text-center p-6 bg-red-600">
            <div class="flex flex-col items-center md:flex-row md:items-start">
                <img src="{{ asset('asset-view/assets/svg/steak.svg') }}"
                    alt="A plate with steak, fries, and vegetables" class="" height="40%" width="40%" />
                <div class="mt-6 md:mt-0 md:ml-6 text-white">
                    <h1 class="text-5xl sm:text-6xl lg:text-7xl font-europhia text-shadow mb-4">
                        Tentang Kami
                    </h1>
                    <p class="leading-relaxed text-shadow-2 pt-6 text-lg sm:text-xl md:text-xl lg:text-2xl">
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
                <form action="{{ route('index.store') }}" method="POST" class="w-full lg:w-1/2">
                    @csrf
                    <div class="bg-[#F5EB55] p-6 sm:p-9 rounded-2xl ring-1 ring-[#BBB34E]">
                        <div class="flex justify-between">
                            <h5 class="font-medium text-xl">Kualitas Produk</h5>
                            <div class="flex items-center gap-2 text-xl" id="star">
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
                        <input type="text" name="username" id="username" placeholder="Ketik namamu disini"
                            class="p-4 my-4 rounded-xl font-medium w-full focus:outline-none focus:border-2 focus:border-yellow-400 focus:ring-2 ring-yellow-500 focus:shadow-lg">
                        <textarea name="message" id="message" cols="30" rows="10" placeholder="Ketik ulasanmu disini"
                            class="p-4 mt-4 mb-2 rounded-xl font-medium w-full focus:outline-none focus:border-2 focus:border-yellow-400 focus:ring-2 ring-yellow-500 focus:shadow-lg"></textarea>
                        <div class="mt-6">
                            <input type="submit" value="Kirim Pesan"
                                class="py-2 px-12 rounded-xl font-medium bg-[#FFA500] cursor-pointer transition duration-100 ease-linear hover:bg-[#F59F00] hover:scale-110 active:bg-[#EA9800] active:scale-100">
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


    {{-- Ulasan Section Start --}}
    <section id="ulasan" class="ulasan-img">
        <div class="container">
            <h1 class="py-12 font-europhia text-white text-center text-4xl sm:text-5xl lg:text-6xl">
                Apa Kata Mereka
            </h1>
            <div class="slider">
                @foreach ($reviews as $index => $review)
                    <div class="review bg-white text-black rounded-lg shadow-lg max-w-sm ring-4 ring-[#D6D6D6] p-4 overflow-hidden"
                        style="--pos: {{ $index + 1 }}">
                        <p class="text-center px-4 py-8">
                            {{ $review->message }}
                        </p>
                        <div class="px-4 py-2 border-t-2 border-[#D6D6D6]">
                            <p class="font-semibold text-gray-500">{{ $review->username }}</p>
                            <p class="flex font-semibold text-gray-500">Rating:
                                <span class="flex items-center text-xl mx-2 gap-1 text-yellow-500">
                                    @for ($i = 0; $i < $review->rating; $i++)
                                        <i class="fas fa-star"></i>
                                    @endfor
                                </span>
                            </p>
                        </div>
                    </div>
                @endforeach
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

</body>
@stack('scripts')
<script>
    @if (session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: {!! json_encode(session('success')) !!},
            showConfirmButton: false,
            timer: 1500,
        });
    @endif
</script>

<script src="{{ asset('asset-view/js/script.js') }}"></script>

</html>
