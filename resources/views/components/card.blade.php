<div x-data="{ favorite: false, loveCount: 0 }" 
class="max-w-[200px] md:max-w-[250px] bg-white rounded-lg shadow-lg overflow-hidden border m-6">

<!-- Bagian Gambar -->
<div class="relative">
    <img src="https://blog-admin.avoskinbeauty.com/wp-content/uploads/2021/12/resep-brownies-kukus-pandan-min.jpg" alt="Makanan" class="w-full h-32 object-cover">

    <!-- Tombol Favorite dengan Counter Love -->
    <button 
        @click="favorite = !favorite; favorite ? loveCount++ : loveCount--" 
        class="absolute top-2 right-2 bg-white py-1 px-1 md:px-2 rounded-full shadow-md flex items-center space-x-1"
    >
        <i x-bind:class="favorite ? 'fas fa-heart text-red-500' : 'far fa-heart text-gray-500'"></i>
        <span x-text="loveCount" class="text-gray-800 text-xs font-semibold"></span>
    </button>

    <!-- Label "Stock Habis" -->
    <span class="absolute bottom-2 right-2 bg-red-500 text-white text-xs px-2 py-1 rounded-lg shadow-md">
        Stock Habis
    </span>
</div>

<!-- Bagian Informasi -->
<div class="p-2 md:p-3">
    <h2 class="text-sm md:text-base font-semibold text-gray-800 truncate">Brownies</h2>
    <div class="flex justify-between items-center mt-1 md:mt-2">
        <span class="text-gray-600 font-semibold text-sm md:text-lg">Rp 25.000</span>
        <!-- Tombol Plus -->
        <button class="bg-blue-500 text-white px-1 md:px-2 rounded-full shadow-md hover:bg-blue-600 transition">
            <i class="fas fa-plus"></i>
        </button>
    </div>
</div>
</div>
