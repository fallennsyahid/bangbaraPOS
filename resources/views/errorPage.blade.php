@vite(['resources/css/app.css', 'resources/js/app.js'])
<section class="flex items-center h-screen p-16 bg-zinc-900">
    <div class="container flex flex-col items-center ">
        <div class="flex flex-col gap-6 max-w-md text-center">
            <h2 class="font-extrabold text-9xl text-gray-600 dark:text-gray-100">
                <span class="sr-only">Error</span>403
            </h2>
            <p class="text-2xl md:text-3xl text-amber-300">Sorry, Your Accsess Is Denied.</p>
            <a href="javascript:history.back()"
                class="px-8 py-4 text-xl font-semibold rounded bg-red-600 text-amber-200 hover:text-amber-300">Back
            </a>
        </div>
    </div>
</section>
