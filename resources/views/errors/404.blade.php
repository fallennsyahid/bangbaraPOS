<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>404 - Halaman Tidak Ditemukan</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <section class="flex items-center h-screen p-16 bg-zinc-900">
        <div class="container flex flex-col items-center ">
            <div class="flex flex-col gap-6 max-w-md text-center">
                <h2 class="font-extrabold text-9xl text-gray-600 dark:text-gray-100">
                    <span class="sr-only">Error</span>404
                </h2>
                <p class="text-2xl md:text-3xl text-amber-300">Sorry, Page Not Found</p>
                <a href="javascript:history.back()"
                    class="px-8 py-4 text-xl font-semibold rounded bg-red-600 text-amber-200 hover:text-amber-300">Back
                </a>
            </div>
        </div>
    </section>
</body>

</html>
