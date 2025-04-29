<x-layout>
    <x-slot:title>Profil</x-slot:title>

    <div class="max-w-4xl mx-auto px-4 py-10">
        <h2 class="text-3xl font-bold text-gray-800 mb-8">Profil Pengguna</h2>

        <div class="flex flex-col md:flex-row items-center md:items-start gap-8">
            {{-- Avatar Placeholder --}}
            <div
                class="w-32 aspect-square rounded-full bg-gray-200 flex items-center justify-center text-gray-500 text-4xl font-bold">
                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
            </div>

            {{-- Informasi Profil --}}
            <div class="w-full">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-4 text-gray-700">
                    <div>
                        <div class="text-sm text-gray-500">Nama</div>
                        <div class="text-lg font-medium">{{ Auth::user()->name }}</div>
                    </div>
                    <div>
                        <div class="text-sm text-gray-500">Kelas</div>
                        <div class="text-lg font-medium">{{ Auth::user()->class }}</div>
                    </div>
                    <div>
                        <div class="text-sm text-gray-500">No. Telepon</div>
                        <div class="text-lg font-medium">{{ Auth::user()->phone }}</div>
                    </div>
                    <div>
                        <div class="text-sm text-gray-500">Email</div>
                        <div class="text-lg font-medium">{{ Auth::user()->email }}</div>
                    </div>
                    <div class="sm:col-span-2">
                        <div class="text-sm text-gray-500">Username</div>
                        <div class="text-lg font-medium">{{ Auth::user()->username }}</div>
                    </div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="text-sm text-white bg-red-600 border-2 border-transparent px-4 py-2 rounded hover:bg-red-900 hover:border-white hover:font-bold transition w-full">
                            Logout
                        </button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-layout>
