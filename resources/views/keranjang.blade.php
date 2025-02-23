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

            @foreach ($menus as $item)
                <div class="flex items-center bg-white border border-gray-300 rounded-lg shadow-sm p-3 md:max-w-2xl mb-3">
                    <!-- Checkbox -->
                    <input type="checkbox"
                        class="w-5 h-5 text-primary border-gray-400 rounded focus:ring-primary cursor-pointer check-item"
                        data-price="{{ $item->produk->harga }}" data-name="{{ $item->produk->nama }}" 
                        data-id="{{ $item->id }}" data-quantity="{{ $item->jumlah }}">

                    <!-- Kontainer Item -->
                    <a href="#" class="flex flex-row flex-grow items-center gap-4 px-4 transition">
                        <!-- Gambar Produk -->
                        <img class="object-cover w-20 h-20 rounded-lg border border-gray-300"
                            src="{{ $item->produk->img }}" alt="Product Image">

                        <!-- Detail Pesanan -->
                        <div class="flex flex-col flex-grow">
                            <h5 class="text-sm sm:text-lg font-bold tracking-tight text-gray-900">
                                {{ $item->produk->nama }}
                            </h5>
                            <p class="text-xs sm:text-sm text-gray-700">
                                Rp. <span class="harga-produk">{{ number_format($item->produk->harga, 0, ',', '.') }}</span>
                            </p>
                        </div>
                    </a>

                    <!-- Tambah & Kurang Jumlah -->
                    <div class="flex items-center">
                        <button class="px-3 py-1 bg-gray-200 rounded-l quantity-decrease" data-id="{{ $item->id }}">-</button>
                        <input type="text" value="{{ $item->jumlah }}" 
                            class="w-10 text-center border border-gray-300 quantity-input" data-id="{{ $item->id }}">
                        <button class="px-3 py-1 bg-gray-200 rounded-r quantity-increase" data-id="{{ $item->id }}">+</button>
                    </div>

                    <!-- Tombol Hapus -->
                    <form action="{{ route('keranjang.remove', $item->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="text-gray-500 hover:text-primary transition p-2">
                            <i class="fas fa-times text-lg"></i>
                        </button>
                    </form>
                </div>
            @endforeach
        </div>

        <!-- Sidebar Checkout -->
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

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const checkboxes = document.querySelectorAll(".check-item");
            const checkAll = document.getElementById("checkAll");
            const desktopTotalPriceElem = document.getElementById("desktopTotalPrice");

            function updateTotal() {
                let total = 0;
                checkboxes.forEach(checkbox => {
                    if (checkbox.checked) {
                        let harga = parseInt(checkbox.dataset.price);
                        let jumlah = parseInt(checkbox.dataset.quantity);
                        total += harga * jumlah;
                    }
                });

                desktopTotalPriceElem.textContent = `Rp. ${total.toLocaleString("id-ID")}`;
            }

            checkboxes.forEach(checkbox => {
                checkbox.addEventListener("change", function () {
                    this.dataset.quantity = document.querySelector(`.quantity-input[data-id="${this.dataset.id}"]`).value;
                    updateTotal();
                });
            });

            checkAll.addEventListener("change", function () {
                checkboxes.forEach(checkbox => checkbox.checked = checkAll.checked);
                updateTotal();
            });

            function updateQuantity(id, newQuantity) {
                fetch(`/keranjang/update/${id}`, {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({ jumlah: newQuantity })
                })
                .then(response => response.json())
                .then(data => {
                    document.querySelector(`.quantity-input[data-id="${id}"]`).value = newQuantity;
                    document.querySelector(`.check-item[data-id="${id}"]`).dataset.quantity = newQuantity;
                    updateTotal();
                })
                .catch(error => console.error("Error:", error));
            }

            document.querySelectorAll(".quantity-increase").forEach(button => {
                button.addEventListener("click", function () {
                    let id = this.dataset.id;
                    let input = document.querySelector(`.quantity-input[data-id="${id}"]`);
                    let newQuantity = parseInt(input.value) + 1;
                    updateQuantity(id, newQuantity);
                });
            });

            document.querySelectorAll(".quantity-decrease").forEach(button => {
                button.addEventListener("click", function () {
                    let id = this.dataset.id;
                    let input = document.querySelector(`.quantity-input[data-id="${id}"]`);
                    let newQuantity = Math.max(1, parseInt(input.value) - 1);
                    updateQuantity(id, newQuantity);
                });
            });

            document.querySelectorAll(".quantity-input").forEach(input => {
                input.addEventListener("change", function () {
                    let id = this.dataset.id;
                    let newQuantity = Math.max(1, parseInt(this.value));
                    updateQuantity(id, newQuantity);
                });
            });

            updateTotal();
        });
    </script>
</x-layout>
