<div x-data="{ open: false }" class="mt-6 flex justify-between px-6 relative">
    <!-- Tombol User -->
    <div
        class="bg-[#A31621] py-7 px-4 inline-flex items-center justify-center rounded-full hover:cursor-pointer drop-shadow-lg">
        <i class="fas fa-user fa-2xl text-white"></i>
    </div>

    <!-- Tombol Notifikasi -->
    <div @click="open = !open"
        class="bg-[#A31621] py-7 px-4 inline-flex items-center justify-center rounded-full hover:cursor-pointer drop-shadow-lg relative">
        <i class="fas fa-bell fa-2xl text-white"></i>
    </div>

    <!-- Load Komponen Notifikasi -->
    <div x-show="open" @click.away="open = false" class="absolute right-0 top-16 w-64 z-50">
        <x-notification></x-notification>
    </div>
</div>
