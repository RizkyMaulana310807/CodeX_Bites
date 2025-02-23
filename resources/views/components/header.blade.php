<header class="fixed top-0 left-0 w-full bg-white shadow-md py-3 px-4 flex items-center gap-3">
    <!-- Tombol Kembali -->
    <button onclick="history.back()" class="text-[#8C1C13] hover:bg-gray-200 py-2 px-4 rounded-full transition">
        <i class="fas fa-arrow-left text-lg"></i>
    </button>

    <!-- Judul Halaman -->
    <h1 class="text-lg font-semibold text-gray-900">{{ $slot}}</h1>
</header>

<!-- Spacer agar konten tidak tertutup header -->
<div class="h-14"></div>
