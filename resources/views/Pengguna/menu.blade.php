<x-layout>
    <x-slot:title>{{ $menu->nama }}</x-slot:title>

    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-6">

        {{-- Back Button --}}
        <div class="mb-4 md:mb-6">
            <a href="/menus" class="inline-flex items-center text-orange-600 hover:text-orange-800 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                </svg>
                Kembali
            </a>
        </div>

        {{-- DESKTOP MODE (md ke atas) --}}
        <div class="hidden md:flex gap-6">
            {{-- Gambar --}}
            <div class="w-1/2 rounded-xl overflow-hidden shadow-md">
                @if ($menu->gambar)
                    <img src="{{ asset('storage/' . $menu->gambar) }}" alt="{{ $menu->nama }}"
                        class="w-full h-[28rem] object-cover object-center" />
                @else
                    <div class="w-full h-[28rem] bg-orange-50 flex items-center justify-center text-orange-400">
                        Tidak ada gambar
                    </div>
                @endif
            </div>

            {{-- Detail --}}
            <div class="w-1/2 bg-white p-6 rounded-xl shadow-md flex flex-col justify-between">
                <div class="space-y-3">
                    <h1 class="text-3xl font-bold text-orange-800">{{ $menu->nama }}</h1>

                    <p class="text-orange-600 text-2xl font-bold">
                        Rp {{ number_format($menu->harga, 0, ',', '.') }}
                    </p>

                    @if ($menu->rating)
                        <div class="text-yellow-500 text-sm">
                            ⭐ <span class="text-orange-700 ml-1">{{ number_format($menu->rating, 1) }}</span>
                        </div>
                    @endif

                    <div class="flex flex-wrap gap-3 text-sm text-orange-600">
                        <span>Stok: <strong class="text-orange-800">{{ $menu->stock }}</strong></span>
                        <span>Terjual: <strong class="text-orange-800">{{ $menu->jumlah_terjual }}</strong></span>
                    </div>

                    <div class="pt-4 border-t border-orange-100 text-sm text-orange-700 leading-relaxed">
                        <h2 class="font-semibold mb-2">Deskripsi Produk</h2>
                        <p>{{ $menu->deskripsi ?? 'Tidak ada deskripsi tersedia.' }}</p>
                    </div>
                </div>

                {{-- Counter + Tombol --}}
                <div class="mt-6 flex items-center gap-4">
                    <div class="flex items-center border border-orange-200 rounded px-2 py-1">
                        <button type="button" class="text-lg font-bold px-2 text-orange-700 hover:text-orange-800"
                            onclick="decrement(this)">−</button>
                        <input type="number" min="1" max="10" value="1"
                            class="w-12 text-center text-sm outline-none no-spin text-orange-700" oninput="validateNumber(this)">
                        <button type="button" class="text-lg font-bold px-2 text-orange-700 hover:text-orange-800"
                            onclick="increment(this)">+</button>
                    </div>

                    <button
                        class="flex-1 bg-orange-600 hover:bg-orange-700 text-white py-2 px-4 rounded-md text-sm font-semibold transition">
                        Tambah ke Keranjang
                    </button>
                </div>
            </div>
        </div>

        {{-- MOBILE VERSION --}}
        <div class="md:hidden bg-white min-h-screen">
            {{-- Gambar --}}
            <div class="w-full aspect-square overflow-hidden">
                @if ($menu->gambar)
                    <img src="{{ asset('storage/' . $menu->gambar) }}" alt="{{ $menu->nama }}"
                        class="w-full h-full object-cover" />
                @else
                    <div class="w-full h-full bg-orange-50 flex items-center justify-center text-orange-400">
                        Tidak ada gambar
                    </div>
                @endif
            </div>

            {{-- Detail Konten --}}
            <div class="w-full -mt-4 bg-white shadow-inner">
                <div class="px-4 py-4 space-y-2 border-b border-orange-100">
                    <h1 class="text-xl font-semibold text-orange-800 leading-tight">{{ $menu->nama }}</h1>
                    <p class="text-orange-600 text-2xl font-bold">
                        Rp {{ number_format($menu->harga, 0, ',', '.') }}
                    </p>

                    <div class="flex items-center gap-4 text-xs text-orange-600">
                        @if ($menu->rating)
                            <div class="flex items-center">
                                ⭐ <span class="ml-1">{{ number_format($menu->rating, 1) }}</span>
                            </div>
                        @endif
                        <span>Stok: {{ $menu->stock }}</span>
                        <span>Terjual: {{ $menu->jumlah_terjual }}</span>
                    </div>
                </div>

                {{-- Deskripsi --}}
                <div class="px-4 py-4 space-y-2 text-sm text-orange-700 leading-relaxed">
                    <h2 class="font-semibold text-orange-800">Deskripsi Produk</h2>
                    <p>{{ $menu->deskripsi ?? 'Tidak ada deskripsi tersedia.' }}</p>
                </div>
            </div>

            {{-- Bottom Bar --}}
            <div class="fixed bottom-0 left-0 right-0 bg-white shadow-inner p-3 flex items-center gap-3 border-t border-orange-100 z-50">
                {{-- Counter --}}
                <div class="flex items-center border border-orange-200 rounded px-2 py-1 bg-orange-50">
                    <button type="button" class="text-lg font-bold px-2 text-orange-700 hover:text-orange-800"
                        onclick="decrement(this)">−</button>
                    <input type="number" min="1" max="10" value="1"
                        class="w-10 text-center text-sm outline-none bg-transparent no-spin text-orange-700"
                        oninput="validateNumber(this)">
                    <button type="button" class="text-lg font-bold px-2 text-orange-700 hover:text-orange-800"
                        onclick="increment(this)">+</button>
                </div>

                {{-- Button --}}
                <button
                    class="flex-1 bg-orange-600 hover:bg-orange-700 text-white py-2 rounded-lg text-sm font-semibold transition">
                    Tambah ke Keranjang
                </button>
            </div>

            {{-- Spacer untuk menghindari tumpang tindih dengan bottom bar --}}
            <div class="h-20"></div>
        </div>
    </div>

    <style>
        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        input[type=number] {
            -moz-appearance: textfield;
        }
    </style>

    <script>
        function increment(el) {
            const input = el.parentElement.querySelector('input');
            let value = parseInt(input.value || 1);
            if (value < 10) input.value = value + 1;
        }

        function decrement(el) {
            const input = el.parentElement.querySelector('input');
            let value = parseInt(input.value || 1);
            if (value > 1) input.value = value - 1;
        }

        function validateNumber(el) {
            let val = parseInt(el.value);
            if (isNaN(val) || val < 1) el.value = 1;
            else if (val > 10) el.value = 10;
        }
    </script>
</x-layout>