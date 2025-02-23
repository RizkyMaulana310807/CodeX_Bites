<div class="fixed bottom-4 left-1/2 z-50 w-full max-w-md -translate-x-1/2 bg-white border border-gray-300 rounded-full shadow-lg">
    <div class="h-20 mx-auto rounded-full flex justify-evenly items-center">
        
        <!-- Home -->
        <x-navbar-link href="/home" :active="request()->is('home')">
            <i class="fas fa-home"></i>
            <span class="text-xs">Home</span>
        </x-navbar-link>

        <!-- Keranjang -->
        <x-navbar-link href="/keranjang" :active="request()->is('keranjang')">
            <i class="fas fa-shopping-cart"></i>
            <span class="text-xs">Keranjang</span>
        </x-navbar-link>

        <!-- Riwayat -->
        <x-navbar-link href="/invoice" :active="request()->is('invoice')">
            <i class="fas fa-history"></i>
            <span class="text-xs">Riwayat</span>
        </x-navbar-link>

        <!-- Profil -->
        <x-navbar-link href="/profile" :active="request()->is('profile')">
            <i class="fas fa-user"></i>
            <span class="text-xs">Profil</span>
        </x-navbar-link>

    </div>
</div>
