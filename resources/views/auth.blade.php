<x-layout>
    <x-slot:title>Login & Daftar</x-slot:title>

    <div class="flex justify-center items-center min-h-screen bg-gray-100 px-4">
        <div class="bg-white shadow-lg rounded-lg p-6 w-full max-w-md">
            <!-- Tabs -->
            <div class="flex mb-4 border-b">
                <button id="loginTab" class="flex-1 text-center py-2 font-semibold border-b-2 border-primary text-primary">
                    Login
                </button>
                <button id="registerTab" class="flex-1 text-center py-2 font-semibold border-b-2 border-gray-200 text-gray-500">
                    Daftar
                </button>
            </div>

            <!-- Login Form -->
            <form id="loginForm" action="{{ route('login') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-gray-700">Email</label>
                    <input type="email" name="email" class="w-full p-2 border rounded-md focus:ring-primary focus:border-primary" required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Password</label>
                    <div class="relative">
                        <input type="password" id="loginPassword" name="password" class="w-full p-2 border rounded-md focus:ring-primary focus:border-primary" required>
                        <button type="button" class="absolute right-3 top-2 text-gray-500 toggle-password" data-target="loginPassword">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>
                <button type="submit" class="w-full bg-primary text-white py-2 rounded-md hover:bg-opacity-80 transition">
                    Login
                </button>
            </form>

            <!-- Register Form (Hidden by Default) -->
            <form id="registerForm" action="{{ route('register') }}" method="POST" class="space-y-4 hidden">
                @csrf
                <div>
                    <label class="block text-gray-700">Nama Lengkap</label>
                    <input type="text" name="name" class="w-full p-2 border rounded-md focus:ring-primary focus:border-primary" required>
                </div>
                <div>
                    <label class="block text-gray-700">Email</label>
                    <input type="email" name="email" class="w-full p-2 border rounded-md focus:ring-primary focus:border-primary" required>
                </div>
                <div>
                    <label class="block text-gray-700">Nomor Kelas</label>
                    <select name="kelas" class="w-full p-2 border rounded-md focus:ring-primary focus:border-primary" required>
                        <option value="" disabled selected>Pilih Kelas</option>
                        <option value="X">X</option>
                        <option value="XI">XI</option>
                        <option value="XII">XII</option>
                    </select>
                </div>
                <div>
                    <label class="block text-gray-700">Password</label>
                    <div class="relative">
                        <input type="password" id="registerPassword" name="password" class="w-full p-2 border rounded-md focus:ring-primary focus:border-primary" required>
                        <button type="button" class="absolute right-3 top-2 text-gray-500 toggle-password" data-target="registerPassword">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Konfirmasi Password</label>
                    <div class="relative">
                        <input type="password" id="confirmPassword" name="password_confirmation" class="w-full p-2 border rounded-md focus:ring-primary focus:border-primary" required>
                        <button type="button" class="absolute right-3 top-2 text-gray-500 toggle-password" data-target="confirmPassword">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>
                <button type="submit" class="w-full bg-primary text-white py-2 rounded-md hover:bg-opacity-80 transition">
                    Daftar
                </button>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const loginTab = document.getElementById("loginTab");
            const registerTab = document.getElementById("registerTab");
            const loginForm = document.getElementById("loginForm");
            const registerForm = document.getElementById("registerForm");

            loginTab.addEventListener("click", function() {
                loginForm.classList.remove("hidden");
                registerForm.classList.add("hidden");
                loginTab.classList.add("text-primary", "border-primary");
                registerTab.classList.remove("text-primary", "border-primary");
                registerTab.classList.add("text-gray-500", "border-gray-200");
            });

            registerTab.addEventListener("click", function() {
                registerForm.classList.remove("hidden");
                loginForm.classList.add("hidden");
                registerTab.classList.add("text-primary", "border-primary");
                loginTab.classList.remove("text-primary", "border-primary");
                loginTab.classList.add("text-gray-500", "border-gray-200");
            });

            // Toggle Password Visibility
            document.querySelectorAll(".toggle-password").forEach(button => {
                button.addEventListener("click", function() {
                    const target = document.getElementById(this.dataset.target);
                    if (target.type === "password") {
                        target.type = "text";
                        this.innerHTML = '<i class="fas fa-eye-slash"></i>';
                        setTimeout(() => {
                            target.type = "password";
                            this.innerHTML = '<i class="fas fa-eye"></i>';
                        }, 3000); // Sembunyikan kembali setelah 3 detik
                    }
                });
            });
        });
    </script>
</x-layout>
