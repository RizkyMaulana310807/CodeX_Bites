<nav x-data="{ open: false, cartOpen: false }" class="bg-white shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <!-- Logo di kiri -->
            <div class="flex items-center">
                <a href="{{ url('/') }}" class="flex-shrink-0 flex items-center">
                    <img class="h-12 w-auto" src="{{ asset('images/CodeX_Bites_logo/CodeX_Bites-removebg-preview.png') }}" alt="CodeX Bites Logo">
                </a>
            </div>

            <!-- Menu untuk desktop/tablet (tersembunyi di mobile) -->
            <div class="hidden md:flex items-center space-x-8">
                <a href="/" class="text-gray-700 hover:text-white hover:underline underline-offset-2 hover:bg-[#4E342E] border-2 border-transparent hover:border-[#3E2723] rounded-md px-3 py-2 text-sm font-medium transition-all duration-200 ease-in-out">Beranda</a>
                <a href="#" class="text-gray-700 hover:text-white hover:underline underline-offset-2 hover:bg-[#4E342E] border-2 border-transparent hover:border-[#3E2723] rounded-md px-3 py-2 text-sm font-medium transition-all duration-200 ease-in-out">Tentang Kami</a>
                <a href="#" class="text-gray-700 hover:text-white hover:underline underline-offset-2 hover:bg-[#4E342E] border-2 border-transparent hover:border-[#3E2723] rounded-md px-3 py-2 text-sm font-medium transition-all duration-200 ease-in-out">Profile</a>
            </div>

            <!-- Bagian kanan (icon keranjang dan hamburger) -->
            <div class="flex items-center">
                <!-- Icon Keranjang -->
                <button @click="cartOpen = !cartOpen" class="p-2 rounded-full text-gray-600 hover:text-[#3E2723] hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#4E342E]">
                    <span class="sr-only">Keranjang</span>
                    <i class="fas fa-shopping-cart"></i>
                </button>

                <!-- Hamburger menu (hanya tampil di mobile) -->
                <div class="md:hidden ml-2">
                    <button @click="open = !open" class="p-2 rounded-full text-gray-600 hover:text-[#3E2723] hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#4E342E]">
                        <span class="sr-only">Buka menu</span>
                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Menu mobile (muncul saat diklik) -->
    <div x-show="open" @click.away="open = false" class="md:hidden" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95">
        <div class="pt-2 pb-3 space-y-1">
            <a href="/" class="block px-4 py-2 text-base font-medium text-gray-700 active:text-white active:bg-[#4E342E] border-2 border-transparent hover:border-[#3E2723]">Beranda</a>
            <a href="#" class="block px-4 py-2 text-base font-medium text-gray-700 active:text-white active:bg-[#4E342E] border-2 border-transparent hover:border-[#3E2723]">Tentang Kami</a>
            <a href="#" class="block px-4 py-2 text-base font-medium text-gray-700 active:text-white active:bg-[#4E342E] border-2 border-transparent hover:border-[#3E2723]">Profile</a>
        </div>
    </div>

    <!-- Dropdown keranjang (contoh) -->
    <div x-show="cartOpen" @click.away="cartOpen = false" class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none z-50" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95">
        <div class="py-2 px-4">
            <p class="text-sm text-gray-700">Sepertinya kamu belum login nih. <a href="/auth" class="underline text-blue-800">Login</a></p>
        </div>
    </div>
</nav>