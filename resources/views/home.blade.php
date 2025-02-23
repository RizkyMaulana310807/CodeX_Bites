<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <x-searchbox></x-searchbox>
    <x-category></x-category>

    <!-- Wrapper utama dengan grid -->
    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-4 p-4 place-items-center">
        @foreach ($menus as $menu)
            <!-- Card Menu -->
            <div class="bg-white border border-gray-200 rounded-md shadow-md overflow-hidden w-full 
                        min-w-[140px] max-w-[220px] sm:max-w-[240px] md:max-w-[260px] lg:max-w-[280px] xl:max-w-[300px] 
                        flex flex-col">
                <a href="#">
                    <img class="w-full h-20 sm:h-28 object-cover" src="{{ $menu->img }}" alt="product image" />
                </a>
                <div class="p-2 flex flex-col flex-grow">
                    <a href="#">
                        <h5 class="text-[10px] sm:text-xs md:text-sm font-semibold tracking-tight text-gray-900">
                            {{ $menu->nama }}
                        </h5>
                    </a>
                    <div class="flex items-center mt-1 mb-2">
                        <div class="flex items-center space-x-0.5">
                            @for ($i = 0; $i < $menu->rating; $i++)
                                <i class="fas fa-star text-yellow-400 text-[8px] sm:text-[10px] md:text-xs"></i>
                            @endfor
                        </div>
                        <span class="bg-secondary text-primary text-[8px] sm:text-[10px] md:text-xs font-semibold px-1 py-0.5 rounded ml-1">
                            {{ $menu->rating }}
                        </span>
                    </div>
                    <div class="mt-auto flex flex-col sm:flex-row sm:items-center sm:justify-between gap-1">
                        <span class="text-sm sm:text-base font-bold text-gray-900">Rp.{{ number_format($menu->harga, 0, ',', '.') }}</span>
                        <button class="tambah-keranjang w-full sm:w-auto text-white bg-primary hover:bg-[#6B150F] 
                                focus:ring-2 focus:ring-primary/50 font-medium rounded-md text-[8px] sm:text-xs md:text-sm 
                                px-2 py-1 sm:px-3 sm:py-1.5 transition"
                            data-produk-id="{{ $menu->id }}">
                            Tambah
                        </button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <x-navbar></x-navbar>

    <!-- Footer -->
    <footer class="bg-primary text-white text-center py-4">
        <p class="text-sm">&copy; {{ date('Y') }} CodeX Bites. All rights reserved.</p>
    </footer>

    <!-- Tambahan div di bawah footer -->
    <div class="w-full h-24"></div>

    <!-- Script untuk handle Tambah ke Keranjang -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            document.querySelectorAll('.tambah-keranjang').forEach(button => {
                button.addEventListener('click', function () {
                    let produkId = this.getAttribute('data-produk-id');

                    fetch('/keranjang/add', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            produk_id: produkId
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        alert(data.message); // Notifikasi
                    })
                    .catch(error => console.error('Error:', error));
                });
            });
        });
    </script>
</x-layout>
