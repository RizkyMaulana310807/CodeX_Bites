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

    /* Prevent link clicks on counter buttons */
    .counter-button {
        pointer-events: auto;
    }
</style>

<x-layout>
    <x-slot:title>Daftar Menu</x-slot:title>

    <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
        @foreach ($menus as $menu)
            {{-- Versi Desktop/Tablet --}}
            <div
                class="hidden md:flex flex-col bg-white rounded-2xl shadow-md hover:shadow-lg hover:scale-105 transform transition-all duration-300 ease-in-out overflow-hidden h-full">
                {{-- Clickable image area --}}
                <a href="{{ url('/menu/' . $menu->id) }}" class="block relative aspect-square w-full overflow-hidden">
                    @if ($menu->gambar)
                        <img class="w-full h-full object-cover" src="{{ asset('storage/' . $menu->gambar) }}"
                            alt="{{ $menu->nama }}">
                    @else
                        <div class="w-full h-full bg-orange-50 flex items-center justify-center text-sm text-orange-400">
                            Tidak ada gambar</div>
                    @endif
                </a>

                <div class="p-3 flex flex-col justify-between flex-1">
                    {{-- Clickable title area --}}
                    <a href="{{ url('/menu/' . $menu->id) }}" class="block space-y-1">
                        <h2 class="text-sm font-semibold text-orange-800 truncate hover:underline">{{ $menu->nama }}
                        </h2>
                        <p class="text-sm text-orange-600">Rp {{ number_format($menu->harga, 0, ',', '.') }}</p>

                        @if ($menu->rating)
                            <div class="flex items-center text-sm text-yellow-500">
                                ⭐ <span class="ml-1 text-orange-700">{{ number_format($menu->rating, 1) }}</span>
                            </div>
                        @endif

                        <div class="flex flex-wrap gap-2 mt-2">
                            <span class="px-3 py-0.5 rounded-full text-xs bg-orange-100 text-orange-800">
                                Stok: {{ $menu->stock }}
                            </span>
                            <span class="px-3 py-0.5 rounded-full text-xs bg-yellow-100 text-yellow-800">
                                Terjual: {{ $menu->jumlah_terjual }}
                            </span>
                        </div>
                    </a>

                    <div class="flex items-center justify-between mt-3 gap-2">
                        <div class="flex items-center border border-orange-200 rounded px-2 py-1"
                            onclick="event.stopPropagation()">
                            <button type="button"
                                class="counter-button text-sm font-bold px-2 text-orange-700 hover:text-orange-800"
                                onclick="event.preventDefault(); decrement(this)">-</button>
                            <input type="number" min="1" max="10" value="1"
                                class="w-10 text-center text-sm outline-none text-orange-700"
                                onblur="validateNumber(this)">
                            <button type="button"
                                class="counter-button text-sm font-bold px-2 text-orange-700 hover:text-orange-800"
                                onclick="event.preventDefault(); increment(this)">+</button>
                        </div>
                        <form action="{{ url('/keranjang') }}" method="POST" class="flex-1"
                            onsubmit="syncJumlahInput(this)">
                            @csrf
                            <input type="hidden" name="menu_id" value="{{ $menu->id }}">
                            <input type="hidden" name="jumlah" value="1" class="jumlah-input">

                            <button type="submit"
                                class="w-full bg-white hover:bg-orange-600 hover:text-white text-orange-600 border-2 border-orange-600 text-sm py-2 px-3 rounded-md transition-all duration-200 ease-in-out">
                                Pesan
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            {{-- Versi Mobile --}}
            <div class="flex flex-col md:hidden bg-white rounded-2xl shadow-md overflow-hidden h-full">
                <a href="{{ url('/menu/' . $menu->id) }}" class="block relative aspect-square w-full overflow-hidden">
                    @if ($menu->gambar)
                        <img class="w-full h-full object-cover" src="{{ asset('storage/' . $menu->gambar) }}"
                            alt="{{ $menu->nama }}">
                    @else
                        <div
                            class="w-full h-full bg-orange-50 flex items-center justify-center text-sm text-orange-400">
                            Tidak ada gambar</div>
                    @endif

                    {{-- Badge stok kiri atas mobile --}}
                    <span
                        class="absolute top-2 left-2 px-2 py-0.5 rounded-full text-xs font-medium bg-orange-100 text-orange-800">
                        Stok: {{ $menu->stock }}
                    </span>
                </a>

                <div class="p-3 flex flex-col justify-between flex-1">
                    <a href="{{ url('/menu/' . $menu->id) }}" class="block space-y-1">
                        <h2 class="text-sm font-semibold text-orange-800 truncate hover:underline">{{ $menu->nama }}
                        </h2>
                        <p class="text-sm text-orange-600">Rp {{ number_format($menu->harga, 0, ',', '.') }}</p>

                        @if ($menu->rating)
                            <div class="flex items-center text-sm text-yellow-500">
                                ⭐ <span class="ml-1 text-orange-700">{{ number_format($menu->rating, 1) }}</span>
                            </div>
                        @endif
                    </a>

                    <div class="mt-3">
                        <a href="{{ url('/menu/' . $menu->id) }}"
                            class="w-full block text-center bg-white hover:bg-orange-600 hover:text-white text-orange-600 border-2 border-orange-600 text-sm py-1.5 rounded-md transition-all duration-200 ease-in-out">
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
            const input = el.parentElement.querySelector('input[type=number]');
            let value = parseInt(input.value || 1);
            if (value < 10) input.value = value + 1;
            updateHiddenInput(input);
        }

        function decrement(el) {
            const input = el.parentElement.querySelector('input[type=number]');
            let value = parseInt(input.value || 1);
            if (value > 1) input.value = value - 1;
            updateHiddenInput(input);
        }

        function validateNumber(el) {
            setTimeout(() => {
                let val = parseInt(el.value);
                if (isNaN(val) || val < 1) el.value = 1;
                if (val > 10) el.value = 10;
                updateHiddenInput(el);
            }, 100);
        }

        function updateHiddenInput(numberInput) {
            const jumlahInput = numberInput.closest('form').querySelector('.jumlah-input');
            jumlahInput.value = numberInput.value;
        }

        function syncJumlahInput(form) {
            const numberInput = form.closest('.flex').querySelector('input[type=number]');
            const hiddenInput = form.querySelector('.jumlah-input');
            hiddenInput.value = numberInput.value;
        }
    </script>
</x-layout>
