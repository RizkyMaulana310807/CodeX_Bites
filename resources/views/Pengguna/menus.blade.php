<style>
    /* Hilangkan spinner number input di Chrome, Safari, Edge, Opera */
    input[type=number]::-webkit-inner-spin-button,
    input[type=number]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    /* Hilangkan spinner number input di Firefox */
    input[type=number] {
        -moz-appearance: textfield;
    }
</style>

<x-layout>
    <x-slot:title>Daftar Menu</x-slot:title>

    <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
        @foreach ($menus as $menu)
            {{-- Versi Desktop/Tablet --}}
            <a href="{{ url('/menu/'.$menu->id) }}"
               class="hidden md:flex flex-col bg-white rounded-2xl shadow-md hover:shadow-lg hover:scale-105 transform transition-all duration-300 ease-in-out overflow-hidden h-full">
                {{-- Gambar + stok badge kecil kiri atas --}}
                <div class="relative aspect-square w-full overflow-hidden">
                    @if ($menu->gambar)
                        <img class="w-full h-full object-cover" src="{{ asset('storage/' . $menu->gambar) }}" alt="{{ $menu->nama }}">
                    @else
                        <div class="w-full h-full bg-gray-100 flex items-center justify-center text-sm text-gray-500">Tidak ada gambar</div>
                    @endif
                </div>

                <div class="p-3 flex flex-col justify-between flex-1">
                    <div class="space-y-1">
                        <h2 class="text-sm font-semibold text-gray-800 truncate">{{ $menu->nama }}</h2>
                        <p class="text-sm text-gray-600">Rp {{ number_format($menu->harga, 0, ',', '.') }}</p>

                        @if ($menu->rating)
                            <div class="flex items-center text-sm text-yellow-500">
                                ⭐ <span class="ml-1 text-gray-700">{{ number_format($menu->rating, 1) }}</span>
                            </div>
                        @endif

                        <div class="flex flex-wrap gap-2 mt-2">
                            <span class="px-3 py-0.5 rounded-full text-xs bg-green-100 text-green-800">
                                Stok: {{ $menu->stock }}
                            </span>
                            <span class="px-3 py-0.5 rounded-full text-xs bg-blue-100 text-blue-800">
                                Terjual: {{ $menu->jumlah_terjual }}
                            </span>
                        </div>
                    </div>

                    <div class="flex items-center justify-between mt-3 gap-2">
                        <div class="flex items-center border rounded px-2 py-1">
                            <button type="button" class="text-sm font-bold px-2 text-gray-700 hover:text-indigo-600"
                                onclick="decrement(this)">-</button>
                            <input type="number" min="1" max="10" value="1"
                                class="w-10 text-center text-sm outline-none" onblur="validateNumber(this)">
                            <button type="button" class="text-sm font-bold px-2 text-gray-700 hover:text-indigo-600"
                                onclick="increment(this)">+</button>
                        </div>
                        <button
                            class="flex-1 bg-white hover:bg-[#3E2723] hover:text-white text-[#3E2723] border-2 border-[#3E2723] text-sm py-2 px-3 rounded-md transition-all duration-200 ease-in-out">
                            Pesan
                        </button>
                    </div>
                </div>
            </a>

            {{-- Versi Mobile --}}
            <div class="flex flex-col md:hidden bg-white rounded-2xl shadow-md overflow-hidden h-full">
                <div class="relative aspect-square w-full overflow-hidden">
                    @if ($menu->gambar)
                        <img class="w-full h-full object-cover" src="{{ asset('storage/' . $menu->gambar) }}" alt="{{ $menu->nama }}">
                    @else
                        <div class="w-full h-full bg-gray-100 flex items-center justify-center text-sm text-gray-500">Tidak ada gambar</div>
                    @endif

                    {{-- Badge stok kiri atas mobile --}}
                    <span class="absolute top-2 left-2 px-2 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                        Stok: {{ $menu->stock }}
                    </span>
                </div>

                <div class="p-3 flex flex-col justify-between flex-1">
                    <div class="space-y-1">
                        <h2 class="text-sm font-semibold text-gray-800 truncate">{{ $menu->nama }}</h2>
                        <p class="text-sm text-gray-600">Rp {{ number_format($menu->harga, 0, ',', '.') }}</p>

                        @if ($menu->rating)
                            <div class="flex items-center text-sm text-yellow-500">
                                ⭐ <span class="ml-1 text-gray-700">{{ number_format($menu->rating, 1) }}</span>
                            </div>
                        @endif
                    </div>

                    <div class="mt-3">
                        <a href="{{ url('/menu/'.$menu->id) }}"
                           class="w-full block text-center bg-white hover:bg-[#3E2723] hover:text-white text-[#3E2723] border-2 border-[#3E2723] text-sm py-1.5 rounded-md transition-all duration-200 ease-in-out">
                            Lihat Detail
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    {{-- Script Counter --}}
    <script>
        function increment(el) {
            const input = el.parentElement.querySelector('input');
            let value = parseInt(input.value || 1);
            if (value < 10) {
                input.value = value + 1;
            }
        }

        function decrement(el) {
            const input = el.parentElement.querySelector('input');
            let value = parseInt(input.value || 1);
            if (value > 1) {
                input.value = value - 1;
            }
        }

        function validateNumber(el) {
            setTimeout(() => {
                let val = parseInt(el.value);
                if (isNaN(val) || val < 1) {
                    el.value = 1;
                } else if (val > 10) {
                    el.value = 10;
                }
            }, 100); // Delay agar user bisa hapus angka dengan lebih natural
        }
    </script>
</x-layout>
