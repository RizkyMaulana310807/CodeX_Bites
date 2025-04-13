<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="container mx-auto px-4 py-8 max-w-4xl">
        <h1 class="text-2xl font-bold mb-6">Keranjang Belanja</h1>

        <!-- Header Keranjang -->
        <div class="bg-white rounded-lg shadow-md p-4 mb-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <input type="checkbox" id="select-all" class="mr-3 h-5 w-5">
                    <label for="select-all" class="text-gray-700">Pilih Semua (<span id="total-items">2</span>)</label>
                </div>
                <div class="hidden md:flex space-x-6">
                    <span class="text-gray-600">Harga</span>
                    <span class="text-gray-600">Jumlah</span>
                    <span class="text-gray-600">Subtotal</span>
                    <span class="text-gray-600">Aksi</span>
                </div>
            </div>
        </div>

        <!-- Daftar Produk -->
        <div class="bg-white rounded-lg shadow-md p-4 mb-4">
            <!-- Item Produk 1 -->
            <!-- Item Produk 1 -->
            <div class="flex flex-col md:flex-row items-start py-4 border-b space-y-4 md:space-y-0 md:items-center">
                <div class="flex items-start w-full md:w-1/2 space-x-3">
                    <input type="checkbox" class="mt-2 h-5 w-5 item-checkbox shrink-0">
                    <img src="https://via.placeholder.com/80" alt="Produk"
                        class="w-16 h-16 sm:w-20 sm:h-20 object-cover rounded">
                    <div class="flex-1 text-sm">
                        <h3 class="font-medium text-base sm:text-lg">Smartphone XYZ Pro 128GB</h3>
                        <p class="text-gray-500 text-xs sm:text-sm">Warna: Hitam</p>
                        <p class="text-gray-500 text-xs sm:text-sm">Garansi Resmi 1 Tahun</p>
                    </div>
                </div>
                <div class="flex justify-between w-full md:w-1/2 text-sm sm:text-base">
                    <div class="w-1/3 text-right md:text-center">
                        <p class="font-medium">Rp4.999.000</p>
                        <p class="text-gray-500 text-xs line-through">Rp5.500.000</p>
                        <p class="text-green-600 text-xs">-9%</p>
                    </div>
                    <div class="w-1/3">
                        <div class="flex items-center border rounded-md w-20 sm:w-24 mx-auto">
                            <button class="px-2 py-1 text-gray-600 text-sm decrement">-</button>
                            <input type="text" value="1"
                                class="w-8 sm:w-10 text-center border-x quantity-input text-sm">
                            <button class="px-2 py-1 text-gray-600 text-sm increment">+</button>
                        </div>
                    </div>
                    <div class="w-1/3 text-right font-medium subtotal">Rp4.999.000</div>
                </div>
                <div class="w-full text-right pt-2 md:hidden">
                    <button class="text-red-500 hover:text-red-700 text-sm">Hapus</button>
                </div>
                <div class="hidden md:block md:w-1/4 text-right">
                    <button class="text-red-500 hover:text-red-700 text-sm">Hapus</button>
                </div>
            </div>


            <!-- Item Produk 2 -->
            <!-- Item Produk 1 -->
            <div class="flex flex-col md:flex-row items-start py-4 border-b space-y-4 md:space-y-0 md:items-center">
                <div class="flex items-start w-full md:w-1/2 space-x-3">
                    <input type="checkbox" class="mt-2 h-5 w-5 item-checkbox shrink-0">
                    <img src="https://via.placeholder.com/80" alt="Produk"
                        class="w-16 h-16 sm:w-20 sm:h-20 object-cover rounded">
                    <div class="flex-1 text-sm">
                        <h3 class="font-medium text-base sm:text-lg">Smartphone XYZ Pro 128GB</h3>
                        <p class="text-gray-500 text-xs sm:text-sm">Warna: Hitam</p>
                        <p class="text-gray-500 text-xs sm:text-sm">Garansi Resmi 1 Tahun</p>
                    </div>
                </div>
                <div class="flex justify-between w-full md:w-1/2 text-sm sm:text-base">
                    <div class="w-1/3 text-right md:text-center">
                        <p class="font-medium">Rp4.999.000</p>
                        <p class="text-gray-500 text-xs line-through">Rp5.500.000</p>
                        <p class="text-green-600 text-xs">-9%</p>
                    </div>
                    <div class="w-1/3">
                        <div class="flex items-center border rounded-md w-20 sm:w-24 mx-auto">
                            <button class="px-2 py-1 text-gray-600 text-sm decrement">-</button>
                            <input type="text" value="1"
                                class="w-8 sm:w-10 text-center border-x quantity-input text-sm">
                            <button class="px-2 py-1 text-gray-600 text-sm increment">+</button>
                        </div>
                    </div>
                    <div class="w-1/3 text-right font-medium subtotal">Rp4.999.000</div>
                </div>
                <div class="w-full text-right pt-2 md:hidden">
                    <button class="text-red-500 hover:text-red-700 text-sm">Hapus</button>
                </div>
                <div class="hidden md:block md:w-1/4 text-right">
                    <button class="text-red-500 hover:text-red-700 text-sm">Hapus</button>
                </div>
            </div>

        </div>

        <!-- Ringkasan Belanja -->
        <div class="bg-white rounded-t-lg shadow-md p-4 sticky bottom-0 w-full z-10">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center space-y-4 md:space-y-0 md:space-x-4">
                
                <!-- Checkbox & Hapus -->
                <div class="flex items-center flex-wrap gap-3 w-full md:w-auto">
                    <input type="checkbox" id="select-all-bottom" class="h-5 w-5">
                    <label for="select-all-bottom" class="text-gray-700 text-sm sm:text-base">
                        Pilih Semua (<span id="total-items-bottom">2</span>)
                    </label>
                    <button class="text-gray-600 hover:text-gray-800 text-sm sm:text-base">Hapus</button>
                </div>
                
                <!-- Total & Tombol Beli -->
                <div class="flex flex-col sm:flex-row items-end sm:items-center justify-end w-full md:w-auto space-y-2 sm:space-y-0 sm:space-x-4">
                    <div class="text-right w-full sm:w-auto">
                        <p class="text-gray-600 text-sm sm:text-base">
                            Total (<span id="selected-items">2</span> produk):
                        </p>
                        <p class="text-lg sm:text-xl md:text-2xl font-bold text-red-600 total-price">Rp7.499.000</p>
                    </div>
                    <button
                        class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 sm:px-6 sm:py-2 md:px-8 md:py-3 rounded-md font-medium w-full sm:w-auto">
                        Beli (<span id="buy-count">2</span>)
                    </button>
                </div>
            </div>
        </div>
        

        <!-- JavaScript untuk interaktivitas -->
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Fungsi untuk update total
                function updateTotals() {
                    const checkboxes = document.querySelectorAll('.item-checkbox:checked');
                    const selectedCount = checkboxes.length;

                    // Update counter
                    document.getElementById('selected-items').textContent = selectedCount;
                    document.getElementById('buy-count').textContent = selectedCount;

                    // Hitung total harga
                    let total = 0;
                    checkboxes.forEach(checkbox => {
                        const item = checkbox.closest('.flex.flex-col');
                        const subtotal = item.querySelector('.subtotal').textContent;
                        total += parseInt(subtotal.replace(/\D/g, ''));
                    });

                    // Format total harga
                    document.querySelector('.total-price').textContent = 'Rp' + total.toLocaleString('id-ID');
                }

                // Event listener untuk checkbox
                document.querySelectorAll('.item-checkbox').forEach(checkbox => {
                    checkbox.addEventListener('change', updateTotals);
                });

                // Select all
                document.getElementById('select-all').addEventListener('change', function() {
                    const checkboxes = document.querySelectorAll('.item-checkbox');
                    checkboxes.forEach(checkbox => {
                        checkbox.checked = this.checked;
                    });
                    updateTotals();
                });

                document.getElementById('select-all-bottom').addEventListener('change', function() {
                    const checkboxes = document.querySelectorAll('.item-checkbox');
                    checkboxes.forEach(checkbox => {
                        checkbox.checked = this.checked;
                    });
                    updateTotals();
                });

                // Tombol +/-
                document.querySelectorAll('.increment').forEach(button => {
                    button.addEventListener('click', function() {
                        const input = this.previousElementSibling;
                        input.value = parseInt(input.value) + 1;
                        updateItemSubtotal(input);
                    });
                });

                document.querySelectorAll('.decrement').forEach(button => {
                    button.addEventListener('click', function() {
                        const input = this.nextElementSibling;
                        if (parseInt(input.value) > 1) {
                            input.value = parseInt(input.value) - 1;
                            updateItemSubtotal(input);
                        }
                    });
                });

                // Input quantity
                document.querySelectorAll('.quantity-input').forEach(input => {
                    input.addEventListener('change', function() {
                        if (parseInt(this.value) < 1) this.value = 1;
                        updateItemSubtotal(this);
                    });
                });

                // Fungsi update subtotal per item
                function updateItemSubtotal(input) {
                    const item = input.closest('.flex.flex-col');
                    const priceText = item.querySelector('div:nth-child(2) > div:nth-child(1) > p:nth-child(1)')
                        .textContent;
                    const price = parseInt(priceText.replace(/\D/g, ''));
                    const quantity = parseInt(input.value);
                    const subtotal = price * quantity;

                    item.querySelector('.subtotal').textContent = 'Rp' + subtotal.toLocaleString('id-ID');
                    updateTotals();
                }

                // Tombol hapus
                document.querySelectorAll('.remove-item').forEach(button => {
                    button.addEventListener('click', function() {
                        this.closest('.flex.flex-col').remove();
                        updateTotals();
                    });
                });
            });
        </script>
    </div>
</x-layout>
