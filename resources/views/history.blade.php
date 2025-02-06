<x-layout-view>
    <div class="cart-img">
        <nav class="p-4 bg-transparent" id="nav-history">
            <a href="{{ route('index') }}">
                <img src="{{ asset('asset-view/assets/svg/arrow-left.svg') }}" alt="Arrow Left" />
            </a>
        </nav>
        <div class="container mx-auto p-4">
            <h1 class="text-5xl font-europhia text-white mb-4 lg:text-7xl">
                Riwayat Pesanan
            </h1>
            <div class="flex mb-6">
                <!-- Button 1 -->
                <button id="btn-semua"
                    class="relative overflow-hidden bg-transparent text-white font-medium px-4 py-2 rounded-l-full group history-menu active"
                    onclick="showContent('semua')">
                    <span class="relative z-10">Semua</span>
                    <div
                        class="absolute top-0 left-0 h-full w-0 bg-primary transition-all duration-300 ease-in-out group-hover:w-full">
                    </div>
                </button>
                <!-- Button 2 -->
                <button id="btn-proses"
                    class="relative overflow-hidden bg-transparent text-white font-medium px-4 py-2 rounded-r-full group history-menu"
                    onclick="showContent('proses')">
                    <span class="relative z-10">Dalam Proses</span>
                    <div
                        class="absolute top-0 right-0 h-full w-0 bg-primary transition-all duration-300 ease-in-out group-hover:w-full">
                    </div>
                </button>
            </div>

            <!-- Slide Container -->
            <div class="overflow-hidden relative">
                <div id="slider" class="flex transition-transform duration-500 ease-in-out"
                    style="width: 200%; transform: translateX(0)">
                    <!-- Semua Content Start -->
                    <div class="w-full p-4 space-y-6">
                        <div class="bg-white text-black rounded-lg p-4 shadow-lg">
                            <div class="flex justify-start items-center mb-4">
                                <span class="text-lg font-semibold">19 Des, 17:35</span>
                            </div>
                            <div class="flex justify-between items-center mb-4 py-4 pr-20 border-b-2">
                                <div class="flex space-x-14">
                                    <div class="flex flex-col items-center space-y-2">
                                        <img alt="Chicken Steak" class="w-32 h-32 rounded"
                                            src="./assets/png/food/1.png" />
                                        <span>Chicken Steak</span>
                                    </div>
                                </div>
                                <div class="flex flex-col items-center">
                                    <span class="font-bold text-lg">Total: 1 Item</span>
                                    <a href="{{ route('details') }}" class="font-medium text-slate-500 underline">
                                        12 Menu >
                                    </a>
                                </div>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-base font-medium text-gray-500 flex">
                                    <img src="./assets/svg/done.svg" alt="" class="pl-1 pr-2" />
                                    Pesanan Selesai
                                </span>
                                <button
                                    class="bg-red-600 text-white px-4 py-2 mr-20 rounded hover:bg-red-700 transition duration-300 ease-linear">
                                    Pesan lagi
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- Semua Content End -->

                    <!-- Dalam Proses Content Start -->
                    <div class="w-full p-4 space-y-6">
                        <div class="bg-white text-black rounded-lg p-4 shadow-lg">
                            <div class="flex justify-start items-center mb-4 ml-4">
                                <span class="text-lg font-semibold">19 Des, 17:35</span>
                            </div>
                            <div class="flex justify-between items-center mb-4 py-4 pr-20 border-b-2">
                                <div class="flex space-x-14">
                                    <div class="flex flex-col items-center space-y-2">
                                        <img alt="Chicken Steak" class="w-32 h-32 rounded"
                                            src="./assets/png/food/1.png" />
                                        <span>Chicken Steak</span>
                                    </div>
                                </div>
                                <div class="flex flex-col items-center">
                                    <span class="font-bold text-lg">Total: 1 Item</span>
                                    <a href=""
                                        class="font-medium text-slate-500 underline hover:text-slate-700 transition">
                                        12 Menu >
                                    </a>
                                </div>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-base font-medium text-gray-500 flex items-center">
                                    <img src="./assets/svg/process.svg" alt="" class="pl-1 pr-2" />
                                    Pesanan Sedang di Proses
                                </span>
                            </div>
                        </div>
                    </div>
                    <!-- Dalam Proses Content End -->
                </div>
            </div>
        </div>
    </div>
</x-layout-view>
