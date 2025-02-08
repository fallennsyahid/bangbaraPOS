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
    <div class="cart-img">
        <nav class="p-4 bg-transparent" id="nav-history">
            <a href="{{ route('history') }}">
                <img src="{{ asset('asset-view/assets/svg/arrow-left.svg') }}" alt="Arrow Left" />
            </a>
        </nav>
        <div class="container mx-auto py-4 px-20">
            <h1 class="text-5xl font-europhia text-white mb-4 lg:text-7xl">
                Riwayat Pesanan
            </h1>
            <div class="bg-white p-6 rounded-lg">
                <div class="border-b-2 pb-6 border-opacity-80">
                    <h3 class="font-semibold text-2xl mb-2">Selesai</h3>
                    <a href="{{ route('indexMenu') }}" class="font-normal text-lg opacity-80 underline">
                        Penasaran dengan menu lainnya? Yuk, pesan lagi di BangbaraPos!
                    </a>
                </div>
                <h5 class="mt-6 font-medium text-lg">Rincian Pesananmu</h5>
                <table border="1" class="border border-black/70 border-collapse w-full">
                    <tr>
                        <td class="border border-black ro">
                            <div class="flex justify-between items-center w-full px-4 py-2 rounded-md">
                                <div class="flex items-center space-x-16" id="col-1">
                                    <img src="./assets/png/food/1.png" alt="" width="100px"
                                        class="rounded-md" />
                                    <span class="text-shadow opacity-75">3</span>
                                    <span class="text-shadow opacity-75">Chicken Steak</span>
                                </div>
                                <div id="col-2" class="ml-auto pl-16">
                                    <a href="">RP 218.000</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="border border-black">
                            <div class="flex justify-between items-center w-full px-4 py-2 rounded-md">
                                <div class="flex items-center space-x-16" id="col-1">
                                    <img src="./assets/png/food/1.png" alt="" width="100px"
                                        class="rounded-md" />
                                    <span class="text-shadow opacity-75">3</span>
                                    <span class="text-shadow opacity-75">Chicken Steak</span>
                                </div>
                                <div id="col-2" class="ml-auto pl-16">
                                    <a href="">RP 218.000</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="border border-black">
                            <div class="flex justify-between items-center w-full px-4 py-2 rounded-md">
                                <div class="flex items-center space-x-16" id="col-1">
                                    <img src="./assets/png/food/1.png" alt="" width="100px"
                                        class="rounded-md" />
                                    <span class="text-shadow opacity-75">3</span>
                                    <span class="text-shadow opacity-75">Chicken Steak</span>
                                </div>
                                <div id="col-2" class="ml-auto pl-16">
                                    <a href="">RP 218.000</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                </table>
                <div class="mb-8">
                    <div class="flex justify-between my-4">
                        <p class="text-black font-medium">Subtotal Pesanan (12 Menu)</p>
                        <p class="text-black font-medium">Rp 208.000,00</p>
                    </div>
                    <div class="flex justify-between my-4">
                        <p class="text-black font-medium text-sm text-opacity-75">Diskon</p>
                        <p class="text-black font-medium text-sm text-opacity-75">
                            Rp -45.000,00
                        </p>
                    </div>
                    <p class="text-end text-black font-medium">RP 250.000,00</p>
                </div>
                <div class="mb-2">
                    <div class="flex justify-between my-4">
                        <p class="text-black font-medium text-opacity-75 text-sm">
                            Catatan
                        </p>
                        <p class="text-black font-medium text-opacity-75 text-sm">
                            Tidak Ada
                        </p>
                    </div>
                    <div class="flex justify-between my-4">
                        <p class="text-black font-medium text-sm text-opacity-75">
                            Tanggal Pemesanan
                        </p>
                        <p class="text-black font-medium text-sm text-opacity-75">
                            19 Des 2024, 19.24
                        </p>
                    </div>
                    <div class="flex justify-between my-4">
                        <p class="text-black font-medium text-sm text-opacity-75">
                            Metode Pembayaran
                        </p>
                        <p class="text-black font-medium text-sm text-opacity-75">Tunai</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
{{-- <script src="{{ asset('asset-view/js/script.js') }}"></script> --}}


</html>
