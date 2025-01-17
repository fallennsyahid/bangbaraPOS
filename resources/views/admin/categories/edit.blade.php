<x-admin.header></x-admin.header>

<body>
    <div x-data="setup()" x-init="$refs.loading.classList.add('hidden');
    setColors(color);" :class="{ 'dark': isDark }">
        <div class="flex h-screen antialiased text-gray-950 bg-gray-100 dark:bg-dark dark:text-light">
            <!-- Loading screen -->
            <div x-ref="loading"
                class="fixed inset-0 z-50 flex items-center justify-center text-2xl font-semibold text-amber-300 bg-slate-950">
                Loading.....
            </div>

            <x-admin.sidebar></x-admin.sidebar>

            <div class="flex-1 h-full overflow-x-hidden overflow-y-auto">
                <x-admin.navbar></x-admin.navbar>

                <!-- Main content -->
                <main class="dark:bg-zinc-950">
                    <!-- Content header -->
                    <div class="flex items-center justify-between px-4 py-2 border-b lg:py-4 dark:border-slate-950">
                        <h1 class="text-2xl font-semibold">Edit Categories</h1>
                        <x-admin.waButton></x-admin.waButton>

                    </div>

                    <!-- Content -->
                    <div class="min-h-screen flex flex-col items-center justify-center bg-gray-100 dark:bg-black px-4">
                        <h2 class="mb-4"><a href="{{ route('categories.index') }}"
                                class="text-amber-400 hover:underline">Back </a>/
                            <a href="/admin/dashboard" class="hover:underline">Home</a>
                        </h2>
                        <form action="{{ route('categories.update', $category->id) }}" method="POST"
                            enctype="multipart/form-data"
                            class="w-full max-w-md bg-white dark:bg-zinc-900 text-gray-900 dark:text-white p-6 rounded-lg shadow-lg">
                            @csrf
                            @method('PUT')
                            <h2 class="text-2xl font-bold text-center mb-6 text-yellow-600 dark:text-yellow-300">Update
                                Category</h2>

                            <!-- Input Nama -->
                            <div class="mb-4">
                                <label for="nama" class="block text-sm font-medium mb-2">Name Category</label>
                                <input type="text" id="nama_kategori" name="nama_kategori"
                                    value="{{ old('nama_kategori', $category->nama_kategori) }}"
                                    class="w-full px-4 py-2 text-gray-900 dark:text-white bg-yellow-50 dark:bg-black border border-yellow-400 dark:border-yellow-500 rounded-md focus:ring-2 focus:ring-yellow-500 focus:outline-none"
                                    placeholder="Masukkan nama Kategori" />
                            </div>

                            <!-- Tombol Submit -->
                            <button type="submit"
                                class="w-full bg-yellow-500 mt-5 text-white font-bold py-2 px-4 rounded-md hover:bg-yellow-600 dark:hover:bg-yellow-400 focus:ring-2 focus:ring-yellow-500 focus:outline-none">
                                Submit
                            </button>
                        </form>
                    </div>




                </main>

                <!-- Main footer -->
                <footer
                    class="flex items-center justify-between p-4 bg-white dark:bg-zinc-900 dark:border-primary-darker">
                    <div>Bangbara &copy; 2025</div>
                    <div>
                        Made by
                        <a href="https://github.com/Kamona-WD" target="_blank"
                            class="text-blue-500 hover:underline">BangbaraPos</a>
                    </div>
                </footer>
            </div>

            <x-admin.panel-content></x-admin.panel-content>
        </div>
    </div>

    <!-- All javascript code in this project for now is just for demo DON'T RELY ON IT  -->
    <x-admin.js></x-admin.js>
</body>

</html>
