{{-- resources/views/Pengguna/keranjang.blade.php --}}
<x-layout>
    <x-slot:title>Keranjang Belanja</x-slot:title>

    <div class="container mx-auto px-4 py-8 max-w-4xl">
        <h1 class="text-2xl font-bold mb-6">Keranjang Belanja</h1>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if ($items->count() > 0)
            <!-- Header Keranjang -->
            <div class="bg-white rounded-lg shadow-md p-4 mb-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input type="checkbox" id="select-all" class="mr-3 h-5 w-5">
                        <label for="select-all" class="text-gray-700">Pilih Semua (<span
                                id="total-items">{{ $items->count() }}</span>)</label>
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
                @foreach ($items as $item)
                    <div class="flex flex-col md:flex-row items-start py-4 border-b space-y-4 md:space-y-0 md:items-center"
                        data-item-id="{{ $item->id }}">
                        <div class="flex items-start w-full md:w-1/2 space-x-3">
                            <input type="checkbox" class="mt-2 h-5 w-5 item-checkbox shrink-0"
                                data-price="{{ $item->menu->harga }}">
                            <img src="{{ $item->menu->gambar ? asset('storage/' . $item->menu->gambar) : 'https://via.placeholder.com/80' }}"
                                alt="{{ $item->menu->nama }}" class="w-16 h-16 sm:w-20 sm:h-20 object-cover rounded">
                            <div class="flex-1 text-sm">
                                <h3 class="font-medium text-base sm:text-lg">{{ $item->menu->nama }}</h3>
                                @if (isset($item->menu->deskripsi))
                                    <p class="text-gray-500 text-xs sm:text-sm">{{ $item->menu->deskripsi }}</p>
                                @endif
                            </div>
                        </div>
                        <div class="flex justify-between w-full md:w-1/2 text-sm sm:text-base">
                            <div class="w-1/3 text-right md:text-center">
                                <p class="font-medium">Rp{{ number_format($item->menu->harga, 0, ',', '.') }}</p>
                                @if (isset($item->menu->harga_asli) && $item->menu->harga_asli > $item->menu->harga)
                                    <p class="text-gray-500 text-xs line-through">
                                        Rp{{ number_format($item->menu->harga_asli, 0, ',', '.') }}</p>
                                    <p class="text-green-600 text-xs">
                                        -{{ round((1 - $item->menu->harga / $item->menu->harga_asli) * 100) }}%</p>
                                @endif
                            </div>
                            <div class="w-1/3">
                                <div class="flex items-center border rounded-md w-20 sm:w-24 mx-auto">
                                    <button type="button" class="px-2 py-1 text-gray-600 text-sm decrement">-</button>
                                    <input type="text" value="1"
                                        class="w-8 sm:w-10 text-center border-x quantity-input text-sm"
                                        data-item-id="{{ $item->id }}" data-price="{{ $item->menu->harga }}">
                                    <button type="button" class="px-2 py-1 text-gray-600 text-sm increment">+</button>
                                </div>
                            </div>
                            <div class="w-1/3 text-right font-medium subtotal"
                                data-subtotal="{{ $item->total_harga }}">
                                Rp{{ number_format($item->total_harga, 0, ',', '.') }}
                            </div>
                        </div>
                        <div class="w-full text-right pt-2 md:hidden">
                            <button type="button" class="text-red-500 hover:text-red-700 text-sm delete-item"
                                data-id="{{ $item->id }}">Hapus</button>
                        </div>
                        <div class="hidden md:block md:w-1/4 text-right">
                            <button type="button" class="text-red-500 hover:text-red-700 text-sm delete-item"
                                data-id="{{ $item->id }}">Hapus</button>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Ringkasan Belanja -->
            <div class="bg-white rounded-t-lg shadow-md p-4 sticky bottom-0 w-full z-10">
                <div
                    class="flex flex-col md:flex-row justify-between items-start md:items-center space-y-4 md:space-y-0 md:space-x-4">

                    <!-- Checkbox & Hapus -->
                    <div class="flex items-center flex-wrap gap-3 w-full md:w-auto">
                        <input type="checkbox" id="select-all-bottom" class="h-5 w-5">
                        <label for="select-all-bottom" class="text-gray-700 text-sm sm:text-base">
                            Pilih Semua (<span id="total-items-bottom">{{ $items->count() }}</span>)
                        </label>
                        <button type="button" id="btn-hapus-selected"
                            class="text-gray-600 hover:text-gray-800 text-sm sm:text-base">Hapus</button>
                    </div>

                    <!-- Total & Tombol Beli -->
                    <div
                        class="flex flex-col sm:flex-row items-end sm:items-center justify-end w-full md:w-auto space-y-2 sm:space-y-0 sm:space-x-4">
                        <div class="text-right w-full sm:w-auto">
                            <p class="text-gray-600 text-sm sm:text-base">
                                Total (<span id="selected-items">0</span> produk):
                            </p>
                            <p class="text-lg sm:text-xl md:text-2xl font-bold text-red-600 total-price">Rp0</p>
                        </div>
                        <form action="{{ route('keranjang.checkout') }}" method="POST">
                            @csrf

                            <button id="btn-checkout"
                                class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 sm:px-6 sm:py-2 md:px-8 md:py-3 rounded-md font-medium w-full sm:w-auto disabled:bg-gray-400 disabled:cursor-not-allowed"
                                disabled>
                                Beli (<span id="buy-count">0</span>)
                            </button>
                        </form>

                    </div>
                </div>
            </div>
        @else
            <div class="bg-white rounded-lg shadow-md p-8 text-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-gray-400 mb-4" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                </svg>
                <h2 class="text-xl font-semibold mb-2">Keranjang Belanja Kosong</h2>
                <p class="text-gray-600 mb-6">Anda belum menambahkan produk apapun ke keranjang</p>
                <a href="/menus" class="bg-orange-600 hover:bg-orange-700 text-white px-6 py-2 rounded-md font-medium">
                    Mulai Belanja
                </a>
            </div>
        @endif

        <!-- Form for sending CSRF token -->
        <form id="delete-form" method="POST" style="display: none;">
            @csrf
            @method('DELETE')
        </form>

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
                        const item = checkbox.closest('[data-item-id]');
                        const subtotalEl = item.querySelector('.subtotal');
                        const subtotal = parseFloat(subtotalEl.getAttribute('data-subtotal'));
                        total += subtotal;
                    });

                    // Format total harga
                    document.querySelector('.total-price').textContent = 'Rp' + total.toLocaleString('id-ID');

                    // Enable/disable tombol checkout
                    const checkoutBtn = document.getElementById('btn-checkout');
                    if (selectedCount > 0) {
                        checkoutBtn.disabled = false;
                    } else {
                        checkoutBtn.disabled = true;
                    }
                }

                // Event listener untuk checkbox
                document.querySelectorAll('.item-checkbox').forEach(checkbox => {
                    checkbox.addEventListener('change', updateTotals);
                });

                // Select all
                const selectAllCheckboxes = [
                    document.getElementById('select-all'),
                    document.getElementById('select-all-bottom')
                ];

                selectAllCheckboxes.forEach(checkbox => {
                    checkbox.addEventListener('change', function() {
                        const isChecked = this.checked;

                        // Update all checkboxes
                        document.querySelectorAll('.item-checkbox').forEach(itemCheckbox => {
                            itemCheckbox.checked = isChecked;
                        });

                        // Update other "select all" checkbox
                        selectAllCheckboxes.forEach(otherCheckbox => {
                            if (otherCheckbox !== this) {
                                otherCheckbox.checked = isChecked;
                            }
                        });

                        updateTotals();
                    });
                });

                // Tombol +/-
                document.querySelectorAll('.increment').forEach(button => {
                    button.addEventListener('click', function() {
                        const input = this.previousElementSibling;
                        input.value = parseInt(input.value) + 1;
                        updateItemQuantity(input);
                    });
                });

                document.querySelectorAll('.decrement').forEach(button => {
                    button.addEventListener('click', function() {
                        const input = this.nextElementSibling;
                        if (parseInt(input.value) > 1) {
                            input.value = parseInt(input.value) - 1;
                            updateItemQuantity(input);
                        }
                    });
                });

                // Input quantity
                document.querySelectorAll('.quantity-input').forEach(input => {
                    input.addEventListener('change', function() {
                        if (parseInt(this.value) < 1) this.value = 1;
                        updateItemQuantity(this);
                    });
                });

                // Fungsi update jumlah item via AJAX
                function updateItemQuantity(input) {
                    const itemId = input.getAttribute('data-item-id');
                    const quantity = parseInt(input.value);
                    const price = parseFloat(input.getAttribute('data-price'));

                    // Update UI dulu untuk responsiveness
                    const item = input.closest('[data-item-id]');
                    const subtotalEl = item.querySelector('.subtotal');
                    const newSubtotal = price * quantity;
                    subtotalEl.textContent = 'Rp' + newSubtotal.toLocaleString('id-ID');
                    subtotalEl.setAttribute('data-subtotal', newSubtotal);

                    // Update total jika checkbox tercentang
                    if (item.querySelector('.item-checkbox').checked) {
                        updateTotals();
                    }

                    // Kirim update ke server
                    fetch(`/keranjang/${itemId}/jumlah`, {
                            method: 'PATCH',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                                    'content')
                            },
                            body: JSON.stringify({
                                jumlah: quantity
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                console.log('Jumlah berhasil diupdate');
                            }
                        })
                        .catch(error => {
                            console.error('Error updating quantity:', error);
                        });
                }

                // Hapus item individual
                document.querySelectorAll('.delete-item').forEach(button => {
                    button.addEventListener('click', function() {
                        const itemId = this.getAttribute('data-id');

                        if (confirm('Apakah Anda yakin ingin menghapus item ini?')) {
                            const form = document.getElementById('delete-form');
                            form.action = `/keranjang/${itemId}`;
                            form.submit();
                        }
                    });
                });

                // Hapus item terpilih
                document.getElementById('btn-hapus-selected').addEventListener('click', function() {
                    const selectedItems = document.querySelectorAll('.item-checkbox:checked');
                    if (selectedItems.length === 0) {
                        alert('Silakan pilih item yang akan dihapus');
                        return;
                    }

                    if (confirm('Apakah Anda yakin ingin menghapus ' + selectedItems.length +
                            ' item yang dipilih?')) {
                        const itemIds = Array.from(selectedItems).map(checkbox => {
                            return checkbox.closest('[data-item-id]').getAttribute('data-item-id');
                        });

                        // Hapus satu per satu dengan fetch API
                        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content');

                        Promise.all(itemIds.map(id => {
                                return fetch(`/keranjang/${id}`, {
                                    method: 'DELETE',
                                    headers: {
                                        'X-CSRF-TOKEN': csrfToken,
                                        'Content-Type': 'application/json',
                                        'Accept': 'application/json'
                                    }
                                });
                            }))
                            .then(() => {
                                window.location.reload();
                            })
                            .catch(error => {
                                console.error('Error deleting items:', error);
                                alert('Terjadi kesalahan saat menghapus item');
                            });
                    }
                });

                // Tombol checkout
                document.getElementById('btn-checkout').addEventListener('click', function() {
                    const selectedItems = document.querySelectorAll('.item-checkbox:checked');
                    if (selectedItems.length === 0) {
                        alert('Silakan pilih item yang akan dibeli');
                        return;
                    }

                    // Simpan data item terpilih ke session storage jika diperlukan
                    const selectedIds = Array.from(selectedItems).map(checkbox => {
                        return checkbox.closest('[data-item-id]').getAttribute('data-item-id');
                    });

                    sessionStorage.setItem('selectedItems', JSON.stringify(selectedIds));

                    // Redirect ke halaman checkout
                    window.location.href = '/checkout';
                });

                // Init totals
                updateTotals();
            });
        </script>
    </div>
</x-layout>
