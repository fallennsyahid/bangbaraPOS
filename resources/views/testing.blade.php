<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<style>
</style>


<body>

    <table class="table-auto border-collapse border border-gray-400 w-full text-center">
        <thead class="bg-gray-200">
            <tr>
                <th class="border border-gray-400 px-4 py-2 text-gray-700 font-semibold">Current Photo</th>
                <th class="border border-gray-400 px-4 py-2 text-gray-700 font-semibold">Upload Photo</th>
                <th class="border border-gray-400 px-4 py-2 text-gray-700 font-semibold">Preview Photo</th>
            </tr>
        </thead>
        <tbody>
            <tr class="hover:bg-gray-100">
                <td class="border border-gray-400 px-4 py-2">
                    <img src="{{ asset('asset-view/assets/png/drink/1.png') }}" alt="Current Photo"
                        class="w-20 h-20 object-cover mx-auto rounded shadow-md">
                </td>
                <td class="border border-gray-400 px-4 py-2">
                    <label for="payment-image"
                        class="flex items-center gap-3 bg-red-500 px-4 py-2 rounded-md text-white font-semibold cursor-pointer hover:bg-red-600">
                        <svg fill="#ffffff" width="30px" height="30px" viewBox="0 0 1920 1920"
                            xmlns="http://www.w3.org/2000/svg" stroke="#ffffff">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round">
                            </g>
                            <g id="SVGRepo_iconCarrier">
                                <path
                                    d="m807.186 686.592 272.864 272.864H0v112.94h1080.05l-272.864 272.978 79.736 79.849 409.296-409.183-409.296-409.184-79.736 79.736ZM1870.419 434.69l-329.221-329.11C1509.688 74.07 1465.979 56 1421.48 56H451.773v730.612h112.94V168.941h790.584v451.762h451.762v1129.405H564.714v-508.233h-112.94v621.173H1920V554.52c0-45.176-17.619-87.754-49.58-119.83Zm-402.181-242.37 315.443 315.442h-315.443V192.319Z"
                                    fill-rule="evenodd"></path>
                            </g>
                        </svg>
                        Upload
                    </label>
                    <input type="file" class="hidden" id="payment-image" accept="image/*"
                        onchange="previewImage(this)" />
                </td>
                <td class="border border-gray-400 px-4 py-2">
                    <img src="{{ asset('asset-view/assets/png/drink/2.png') }}" alt="Preview Photo"
                        class="w-20 h-20 object-cover mx-auto rounded shadow-md">
                </td>
            </tr>
        </tbody>
    </table>

    <button class="flex mx-auto mt-4 bg-blue-500 text-white px-6 py-3 rounded hover:bg-blue-600 shadow-lg">
        Upload
    </button>

</body>

</html>
