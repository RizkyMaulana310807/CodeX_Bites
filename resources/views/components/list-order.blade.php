<div x-data="{ favorite: false, loveCount: 0 }" 
    class="flex items-center bg-white rounded-lg shadow-md overflow-hidden border p-2 w-full max-w-[450px] mx-6 my-2">

    <!-- Gambar Produk -->
    <div class="relative w-16 h-16 flex-shrink-0">
        <img src="https://blog-admin.avoskinbeauty.com/wp-content/uploads/2021/12/resep-brownies-kukus-pandan-min.jpg" 
            alt="Makanan" class="w-full h-full object-cover rounded-md">

        <!-- Tombol Favorite -->
        <button 
            @click="favorite = !favorite; favorite ? loveCount++ : loveCount--" 
            class="absolute top-0 right-0 bg-white p-1 rounded-full shadow-md flex items-center">
            <i x-bind:class="favorite ? 'fas fa-heart text-red-500' : 'far fa-heart text-gray-500'"></i>
        </button>

        <!-- Label "Stock Habis" -->
        {{-- <span class="absolute bottom-0 right-0 bg-red-500 text-white text-xs px-2 py-1 rounded-md shadow-md">
            Stock Habis
        </span> --}}
    </div>

    <!-- Informasi Produk -->
    <div class="flex flex-col justify-between ml-3 flex-grow">
        <h2 class="text-sm font-semibold text-gray-800 truncate">Brownies Kukus Pandan</h2>
        <p class="text-xs text-gray-500 truncate">Brownies kukus dengan rasa pandan yang lembut</p>
    </div>

    <!-- Harga -->
    <div class="text-right">
        <span class="text-gray-800 font-semibold text-sm md:text-base">Rp 25.000</span>
    </div>
</div>
