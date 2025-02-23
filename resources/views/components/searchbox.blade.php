<form class="w-full max-w-xs sm:max-w-md mx-auto">   
    <label for="default-search" class="sr-only">Search</label>

    <div class="flex flex-row-reverse items-center border border-gray-400 rounded-full bg-white p-1">
        <!-- Tombol Cari -->
        <button type="submit" 
            class="w-auto sm:w-fit text-white bg-primary hover:bg-primary 
            focus:ring-4 focus:outline-none focus:ring-red-500 font-medium 
            rounded-full text-xs sm:text-sm px-4 py-2 sm:px-5 sm:py-2 transition">
            Cari
        </button>

        <!-- Input Search -->
        <input type="search" id="default-search" 
            class="flex-1 text-sm sm:text-base text-gray-900 bg-transparent focus:ring-0 focus:outline-none px-3 py-2" 
            placeholder="Cari sesuatu..." required />

        <!-- Icon Search -->
        <div class="px-3 flex items-center pointer-events-none">
            <svg class="w-4 h-4 sm:w-5 sm:h-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
            </svg>
        </div>
    </div>
</form>
