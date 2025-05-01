<x-admin.header></x-admin.header>

<body>
    <div x-data="setup()" x-init="$refs.loading.classList.add('hidden');
    setColors(color);" :class="{ 'dark': isDark }">
        <div class="flex h-screen antialiased text-gray-950 bg-prime dark:text-light">
            <!-- Loading screen -->
            <div x-ref="loading"
                class="fixed inset-0 z-50 flex items-center justify-center text-2xl font-semibold text-amber-300 bg-slate-950">
                Loading.....
            </div>

            <x-admin.sidebar></x-admin.sidebar>

            <div class="flex-1 h-full overflow-x-hidden overflow-y-auto">
                <x-admin.navbar></x-admin.navbar>

                <!-- Main content -->
                <main class="bg-prime p-6">
                    <!-- Content header -->
                    <div class="flex items-center justify-between px-4 py-2 border-b lg:py-4">
                        <h1 class="text-2xl font-semibold text-zinc-950">Staffs Details</h1>

                    </div>
                    <h2 class="mb-4 text-center">
                        <a href="{{ route('staffs.index') }}" class="text-amber-400 hover:underline">Back </a>/
                        <a href="/admin/dashboard" class="hover:underline text-zinc-950">Home</a>
                    </h2>
                    <div class="min-h-full mt-4 items-center justify-center bg-prime">
                        <!-- Profile Header -->
                        <div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-lg">
                            <div class="flex items-center space-x-4">
                                <img src="{{ $user->avatar }}" alt="Profile Picture" class="w-24 h-24 rounded-full">
                                <div>
                                    <h1 class="text-2xl font-bold text-gray-900">{{ $user->name }}</h1>
                                    <p class="text-gray-600">{{ $user->usertype }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Personal Information -->
                        <div class="max-w-4xl mx-auto mt-6 bg-white p-6 rounded-lg shadow-lg">
                            <h2 class="text-xl font-semibold text-gray-900 mb-4">Personal Information</h2>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <p class="text-gray-600">First Name</p>
                                    <p class="text-gray-900 font-medium">{{ $user->name }}</p>
                                </div>
                                <div>
                                    <p class="text-gray-600">Join Since</p>
                                    <p class="text-gray-900 font-medium">{{ $user->created_at->format('d/m/y') }}</p>
                                </div>
                                <div>
                                    <p class="text-gray-600">Email</p>
                                    <p class="text-gray-900 font-medium">{{ $user->email }}</p>
                                </div>

                                <div>
                                    <p class="text-gray-600">User Role</p>
                                    <p class="text-gray-900 font-medium">{{ $user->usertype }}</p>
                                </div>
                                <div>
                                    <p class="text-gray-600">Phone Number</p>
                                    <p class="text-gray-900 font-medium">{{ $user->phone_number }}</p>
                                </div>
                                <div>
                                    <p class="text-gray-600">Address</p>
                                    <p class="text-gray-900 font-medium">{{ $user->address }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                </main>
            </div>

            <x-admin.panel-content></x-admin.panel-content>
        </div>
    </div>

    <x-admin.js></x-admin.js>
</body>

</html>
