<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="flex flex-col md:flex-row gap-6 p-4">
        <!-- Daftar Pesanan -->
        <div class="flex-grow pb-24 md:pb-0">
            <!-- Checkbox Pilih Semua -->
            <div class="flex items-center mb-3">
                <input type="checkbox" id="checkAll"
                    class="w-5 h-5 text-primary border-gray-400 rounded focus:ring-primary cursor-pointer">
                <label for="checkAll" class="ml-2 text-gray-800 font-medium">Pilih Semua</label>
            </div>

            @foreach ($menus as $menu)
                <div
                    class="flex items-center bg-white border border-gray-300 rounded-lg shadow-sm p-3 md:max-w-2xl mb-3">
                    <!-- Checkbox -->
                    <input type="checkbox"
                        class="w-5 h-5 text-primary border-gray-400 rounded focus:ring-primary cursor-pointer check-item"
                        data-price="{{ $menu['harga'] }}" data-name="{{ $menu['nama'] }}">

                    <!-- Kontainer Item -->
                    <a href="#" class="flex flex-row flex-grow items-center gap-4 px-4 transition">
                        <!-- Gambar Produk -->
                        <img class="object-cover w-20 h-20 rounded-lg border border-gray-300" src="{{ $menu['img'] }}"
                            alt="Product Image">

                        <!-- Detail Pesanan -->
                        <div class="flex flex-col flex-grow">
                            <h5 class="text-sm sm:text-lg font-bold tracking-tight text-gray-900">
                                {{ $menu['nama'] }}
                            </h5>
                            <p class="text-xs sm:text-sm text-gray-700">
                                Rp. {{ $menu['harga'] }}
                            </p>
                        </div>
                    </a>

                    <!-- Tombol Hapus (X) -->
                    <button class="text-gray-500 hover:text-primary transition p-2">
                        <i class="fas fa-times text-lg"></i>
                    </button>
                </div>
            @endforeach
        </div>

        <!-- Sidebar Checkout (Hanya di Desktop) -->
        <div id="desktopCheckout" class="hidden md:block w-1/3 bg-white shadow-md border p-4 rounded-lg h-fit">
            <h3 class="text-lg font-semibold text-gray-900">Detail Pesanan</h3>
            <ul id="desktopItemList" class="text-sm text-gray-600 mt-2"></ul>
            <p class="text-sm font-bold text-gray-800 mt-3">Total: <span id="desktopTotalPrice">Rp. 0</span></p>
            <button id="checkoutDesktopBtn"
                class="bg-primary text-white px-4 py-2 rounded-md mt-3 hover:bg-opacity-80 transition w-full">
                Checkout
            </button>
        </div>
    </div>

    <!-- Tombol Checkout di Mobile -->
    <div id="mobileCheckoutButton" class="fixed bottom-0 left-0 right-0 bg-white shadow-lg p-4 md:hidden z-40">
        <button id="showMobileCheckout"
            class="bg-primary text-white px-4 py-3 rounded-md hover:bg-opacity-80 transition w-full">
            Lihat Detail Pesanan
        </button>
    </div>

    <!-- Mobile Checkout Slider -->
    <div id="mobileCheckout"
        class="fixed inset-x-0 bottom-0 bg-white p-6 shadow-lg transform translate-y-full transition-transform duration-300 rounded-t-lg h-[70vh] md:hidden z-50">
        <div class="flex flex-col h-full">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold text-gray-900">Detail Pesanan</h3>
                <button id="closeCheckout" class="text-gray-500 hover:text-gray-700">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <!-- Scrollable Item List -->
            <div class="flex-grow overflow-y-auto mb-4">
                <ul id="mobileItemList" class="text-sm text-gray-600"></ul>
            </div>

            <!-- Fixed Bottom Section -->
            <div class="mt-auto">
                <p class="text-sm font-bold text-gray-800 mb-4">Total: <span id="mobileTotalPrice">Rp. 0</span></p>
                <button id="checkoutMobileBtn"
                    class="bg-primary text-white px-4 py-3 rounded-md hover:bg-opacity-80 transition w-full">
                    Checkout
                </button>
            </div>
        </div>
    </div>

    <!-- Overlay Blur Background -->
    <div id="checkoutOverlay"
        class="fixed inset-0 bg-black opacity-0 pointer-events-none transition-opacity duration-300 md:hidden"></div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const checkboxes = document.querySelectorAll(".check-item");
            const checkAll = document.getElementById("checkAll");
            const desktopTotalPriceElem = document.getElementById("desktopTotalPrice");
            const mobileTotalPriceElem = document.getElementById("mobileTotalPrice");
            const desktopCheckout = document.getElementById("desktopCheckout");
            const mobileCheckout = document.getElementById("mobileCheckout");
            const checkoutOverlay = document.getElementById("checkoutOverlay");
            const closeCheckout = document.getElementById("closeCheckout");
            const showMobileCheckout = document.getElementById("showMobileCheckout");
            const desktopItemList = document.getElementById("desktopItemList");
            const mobileItemList = document.getElementById("mobileItemList");

            let total = 0;

            function updateTotal() {
                total = 0;
                let selectedItems = [];

                checkboxes.forEach(checkbox => {
                    if (checkbox.checked) {
                        total += parseInt(checkbox.dataset.price);
                        selectedItems.push(
                            `<li class="py-2 border-b border-gray-200">${checkbox.dataset.name} - Rp. ${checkbox.dataset.price}</li>`
                        );
                    }
                });

                desktopTotalPriceElem.textContent = `Rp. ${total}`;
                mobileTotalPriceElem.textContent = `Rp. ${total}`;
                desktopItemList.innerHTML = selectedItems.join("");
                mobileItemList.innerHTML = selectedItems.join("");

                desktopCheckout.classList.add("hidden");
                showMobileCheckout.disabled = total === 0;
                showMobileCheckout.classList.toggle("opacity-50", total === 0);
            }

            function showMobileCheckoutScreen() {
                if (total === 0) return; 
                mobileCheckout.style.transform = "translateY(0)";
                checkoutOverlay.classList.remove("pointer-events-none", "opacity-0");
                checkoutOverlay.classList.add("opacity-50");
                document.body.style.overflow = "hidden";
                desktopCheckout.classList.add("hidden");
                // Sembunyikan tombol "Lihat Detail Pesanan"
                showMobileCheckout.classList.add("hidden");
            }

            function hideMobileCheckoutScreen() {
                mobileCheckout.style.transform = "translateY(100%)";
                checkoutOverlay.classList.add("pointer-events-none", "opacity-0");
                checkoutOverlay.classList.remove("opacity-50");
                document.body.style.overflow = "";

                // Tampilkan kembali tombol setelah slider ditutup
                showMobileCheckout.classList.remove("hidden");
            }

            checkboxes.forEach(checkbox => checkbox.addEventListener("change", updateTotal));
            checkAll.addEventListener("change", function() {
                checkboxes.forEach(checkbox => checkbox.checked = checkAll.checked);
                updateTotal();
            });

            showMobileCheckout.addEventListener("click", showMobileCheckoutScreen);
            closeCheckout.addEventListener("click", hideMobileCheckoutScreen);
            checkoutOverlay.addEventListener("click", hideMobileCheckoutScreen);

            updateTotal();
        });
    </script>
</x-layout>
