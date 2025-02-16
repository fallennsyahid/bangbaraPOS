<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    {{-- CART 1 --}}
    <div class="flex flex-col min-[500px]:flex-row min-[500px]:items-center gap-5 py-6 border-b border-gray-200 group">
        <div class="w-full max-w-[126px] sm:justify-center">
            <img src="${item.image}" alt="${item.name}" class="mx-auto rounded-xl object-cover">
        </div>
        <div class="grid grid-cols-1 md:grid-cols-4 w-full">
            <div class="md:col-span-2">
                <div class="flex flex-col max-[500px]:items-center gap-3">
                    <h6 class="font-semibold text-base leading-7 text-black">
                        ${item.name}
                    </h6>
                    <h6 class="font-normal text-base leading-7 text-gray-500">
                        ${item.category}
                    </h6>
                    <h6
                        class="font-medium text-base leading-7 text-gray-600 transition-all duration-300 group-hover:text-rose-300">
                        Rp ${item.price.toLocaleString("id-ID")}
                    </h6>
                </div>
            </div>
            <div class="flex items-center max-[500px]:justify-center h-full max-md:mt-3">
                <div class="flex items-center justify-center h-full" style="flex-direction: row;">
                    <button type="" name="" value="" onclick="updateQuantity(${item.id}, -1)"
                        class="group rounded-l-xl px-5 py-[18px] border border-gray-200 flex items-center justify-center shadow-sm transition-all duration-500 hover:bg-gray-50 hover:border-gray-300 focus-within:outline-gray-300">
                        <svg class="stroke-gray-900 transition-all duration-500 group-hover:stroke-black"
                            xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22 22"
                            fill="none">
                            <path d="M16.5 11H5.5" stroke-width="1.6" stroke-linecap="round" />
                        </svg>
                    </button>


                    <input type="text"
                        class="border-y border-gray-200 outline-none text-gray-900 font-semibold text-lg w-full max-w-[73px] min-w-[60px] text-center bg-transparent"
                        id="quantity-${item.id}" value="${item.quantity}" readonly>

                    <button type="" name="" value="" onclick="updateQuantity(${item.id}, 1)"
                        class="group rounded-r-xl px-5 py-[18px] border border-gray-200 flex items-center justify-center shadow-sm transition-all duration-500 hover:bg-gray-50 hover:border-gray-300 focus-within:outline-gray-300">
                        <svg class="stroke-gray-900 transition-all duration-500 group-hover:stroke-black"
                            xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22 22"
                            fill="none">
                            <path d="M11 5.5V16.5M16.5 11H5.5" stroke-width="1.6" stroke-linecap="round" />
                        </svg>
                    </button>
                </div>
            </div>
            <div class="flex items-center max-[500px]:justify-center md:justify-end max-md:mt-3 h-full">
                <p
                    class="font-bold text-lg leading-8 text-gray-600 text-center transition-all duration-300 group-hover:text-rose-300">
                    Rp ${totalItemPrice.toLocaleString()}
                </p>
            </div>
        </div>
    </div>

    {{-- Cart 2 --}}
    <div class="flex flex-col min-[500px]:flex-row min-[500px]:items-center gap-5 py-6 border-b border-gray-200 group">
        <div class="w-full max-w-[126px] sm:justify-center">
            <img src="${item.image}" alt="${item.name}" class="mx-auto rounded-xl object-cover" />
        </div>
        <div class="grid grid-cols-1 md:grid-cols-4 w-full">
            <div class="md:col-span-2">
                <div class="flex flex-col max-[500px]:items-center gap-3">
                    <h6 class="font-semibold text-base leading-7 text-black">${item.name}</h6>
                    <h6 class="font-medium text-base leading-7 text-gray-600 transition-all duration-300">
                        Rp ${item.price.toLocaleString("id-ID")}
                    </h6>
                </div>
            </div>
            <div class="flex items-center max-[500px]:justify-center h-full max-md:mt-3">
                <div class="flex items-center justify-center h-full">
                    <button onclick="updateQuantity(${item.id}, -1)" class="px-4 py-2 border">-</button>
                    <input type="text" id="quantity-${item.id}" value="${item.quantity}" readonly
                        class="w-12 text-center" />
                    <button onclick="updateQuantity(${item.id}, 1)" class="px-4 py-2 border">+</button>
                </div>
            </div>
            <div class="flex items-center max-[500px]:justify-center md:justify-end max-md:mt-3 h-full">
                <p class="font-bold text-lg text-gray-600">Rp ${totalItemPrice.toLocaleString()}</p>
            </div>
        </div>
    </div>
</body>

</html>
