<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login & Daftar</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Alpine JS CDN -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .bg-chocolate {
            background-color: #6B4423;
        }

        .text-chocolate {
            color: #6B4423;
        }

        .border-chocolate {
            border-color: #6B4423;
        }

        .hover\:bg-chocolate:hover {
            background-color: #5A371D;
        }

        /* Section animation */
        .section-transition {
            transition: all 0.4s ease;
        }

        /* Progress bar styles */
        .progress-container {
            width: 100%;
            height: 6px;
            background-color: #E0E0E0;
            border-radius: 3px;
            margin-bottom: 1.5rem;
            display: flex;
        }

        .progress-step {
            height: 100%;
            border-radius: 3px;
            transition: all 0.3s ease;
            flex-grow: 1;
            margin-right: 2px;
        }

        .progress-step:last-child {
            margin-right: 0;
        }

        .progress-step.incomplete {
            background-color: #E0E0E0;
        }

        .progress-step.active {
            background-color: #FBBF24;
            /* Kuning */
        }

        .progress-step.completed {
            background-color: #10B981;
            /* Hijau */
        }
    </style>
</head>

<body class="bg-amber-50 min-h-screen flex items-center justify-center p-4">
    <div x-data="authApp()" class="w-full max-w-md mx-auto">
        <!-- Tab Selector -->
        <div class="flex mb-6 md:mb-8">
            <button @click="currentTab = 'login'"
                :class="{ 'bg-chocolate text-white': currentTab === 'login', 'bg-white text-chocolate': currentTab !== 'login' }"
                class="flex-1 py-2 md:py-3 px-4 rounded-tl-lg rounded-bl-lg font-medium transition-colors duration-300 border border-chocolate text-sm md:text-base">
                Masuk
            </button>
            <button @click="currentTab = 'register'; resetRegisterForm()"
                :class="{ 'bg-chocolate text-white': currentTab === 'register', 'bg-white text-chocolate': currentTab !== 'register' }"
                class="flex-1 py-2 md:py-3 px-4 rounded-tr-lg rounded-br-lg font-medium transition-colors duration-300 border border-chocolate text-sm md:text-base">
                Daftar
            </button>
        </div>

        <!-- Login Form -->
        <div x-show="currentTab === 'login'" x-transition
            class="bg-white p-6 md:p-8 rounded-lg shadow-lg border border-amber-200">
            <h2 class="text-xl md:text-2xl font-bold text-chocolate mb-4 md:mb-6 text-center">Masuk ke Akun Anda</h2>

            <form method="POST" action="{{ route('login') }}" class="space-y-3 md:space-y-4">
                @csrf

                <div>
                    <label for="login-identifier" class="block text-sm font-medium text-amber-900 mb-1">Username atau
                        Email</label>
                    <input type="text" id="login-identifier" x-model="loginData.identifier" required
                        class="w-full px-3 md:px-4 py-2 rounded-lg border border-amber-300 focus:ring-2 focus:ring-amber-500 focus:border-amber-500 outline-none transition text-sm md:text-base"
                        placeholder="username atau email@contoh.com">
                </div>

                <div>
                    <label for="login-password" class="block text-sm font-medium text-amber-900 mb-1">Password</label>
                    <div class="relative">
                        <input :type="showLoginPassword ? 'text' : 'password'" id="login-password"
                            x-model="loginData.password" required
                            class="w-full px-3 md:px-4 py-2 rounded-lg border border-amber-300 focus:ring-2 focus:ring-amber-500 focus:border-amber-500 outline-none transition text-sm md:text-base"
                            placeholder="••••••••">
                        <button type="button" @click="showLoginPassword = !showLoginPassword"
                            class="absolute right-3 top-1/2 transform -translate-y-1/2 text-amber-700 hover:text-amber-900">
                            <i :class="showLoginPassword ? 'fa-eye-slash' : 'fa-eye'"
                                class="fas text-sm md:text-base"></i>
                        </button>
                    </div>
                </div>

                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input type="checkbox" id="remember-me"
                            class="h-4 w-4 text-amber-600 focus:ring-amber-500 border-amber-300 rounded">
                        <label for="remember-me" class="ml-2 block text-xs md:text-sm text-amber-800">Ingat saya</label>
                    </div>
                    <a href="#" class="text-xs md:text-sm font-medium text-amber-700 hover:text-amber-900">Lupa
                        password?</a>
                </div>

                <button type="submit"
                    class="w-full bg-chocolate text-white py-2 px-4 rounded-lg hover:bg-amber-800 transition-colors duration-300 font-medium text-sm md:text-base">
                    Masuk
                </button>
            </form>
        </div>

        <!-- Register Form -->
        <div x-show="currentTab === 'register'" x-transition
            class="bg-white p-6 md:p-8 rounded-lg shadow-lg border border-amber-200">
            <h2 class="text-xl md:text-2xl font-bold text-chocolate mb-4 md:mb-6 text-center">Buat Akun Baru</h2>

            <!-- Progress Bar -->
            <div class="progress-container">
                <div class="progress-step"
                    :class="{
                        'completed': registrationSection === 2 || (registrationSection === 1 && isBasicInfoValid()),
                        'active': registrationSection === 1 && !isBasicInfoValid(),
                        'incomplete': registrationSection === 1 && !isBasicInfoValid()
                    }">
                </div>
                <div class="progress-step"
                    :class="{
                        'completed': registrationSection === 2 && isFormValid(),
                        'active': registrationSection === 2 && !isFormValid(),
                        'incomplete': registrationSection === 1 || (registrationSection === 2 && !isFormValid())
                    }">
                </div>
            </div>

            <!-- Single Registration Form with Sequential Sections -->
            <form method="POST" action="{{ route('register') }}" class="space-y-3 md:space-y-4">
                @csrf
                <!-- First Section: Basic Info -->
                <div x-show="registrationSection === 1" class="section-transition space-y-3 md:space-y-4">
                    <div>
                        <label for="register-name" class="block text-sm font-medium text-amber-900 mb-1">Nama
                            Lengkap</label>
                        <input type="text" name="name" id="register-name" x-model="registerData.name" required
                            @input="validateForm"
                            class="w-full px-3 md:px-4 py-2 rounded-lg border border-amber-300 focus:ring-2 focus:ring-amber-500 focus:border-amber-500 outline-none transition text-sm md:text-base"
                            placeholder="Nama lengkap Anda">
                    </div>

                    <div>
                        <label for="register-email" class="block text-sm font-medium text-amber-900 mb-1">Email</label>
                        <input type="email" name="email" id="register-email" x-model="registerData.email" required
                            @input="validateForm"
                            class="w-full px-3 md:px-4 py-2 rounded-lg border border-amber-300 focus:ring-2 focus:ring-amber-500 focus:border-amber-500 outline-none transition text-sm md:text-base"
                            placeholder="email@contoh.com">
                    </div>

                    <div>
                        <label for="register-password"
                            class="block text-sm font-medium text-amber-900 mb-1">Password</label>
                        <div class="relative">
                            <input :type="showRegisterPasswords ? 'text' : 'password'" name="password"
                                id="register-password" x-model="registerData.password" required minlength="6"
                                @input="validateForm"
                                class="w-full px-3 md:px-4 py-2 rounded-lg border border-amber-300 focus:ring-2 focus:ring-amber-500 focus:border-amber-500 outline-none transition text-sm md:text-base"
                                placeholder="••••••••">
                        </div>
                    </div>

                    <div>
                        <label for="register-confirm-password"
                            class="block text-sm font-medium text-amber-900 mb-1">Konfirmasi Password</label>
                        <div class="relative">
                            <input :type="showRegisterPasswords ? 'text' : 'password'" id="register-confirm-password" name="password_confirmation"
                                x-model="registerData.confirmPassword" required minlength="6" @input="validateForm"
                                class="w-full px-3 md:px-4 py-2 rounded-lg border border-amber-300 focus:ring-2 focus:ring-amber-500 focus:border-amber-500 outline-none transition text-sm md:text-base"
                                placeholder="••••••••">
                            <button type="button" @click="showRegisterPasswords = !showRegisterPasswords"
                                class="absolute right-3 top-1/2 transform -translate-y-1/2 text-amber-700 hover:text-amber-900">
                                <i :class="showRegisterPasswords ? 'fa-eye-slash' : 'fa-eye'"
                                    class="fas text-sm md:text-base"></i>
                            </button>
                        </div>
                        <p x-show="registerData.password && registerData.confirmPassword && registerData.password !== registerData.confirmPassword"
                            class="text-red-500 text-xs mt-1">Password tidak cocok</p>
                    </div>

                    <button type="button" @click="goToAdditionalInfo" :disabled="!isBasicInfoValid()"
                        :class="{ 'opacity-50 cursor-not-allowed': !isBasicInfoValid() }"
                        class="w-full bg-chocolate text-white py-2 px-4 rounded-lg hover:bg-amber-800 transition-colors duration-300 font-medium text-sm md:text-base">
                        Selanjutnya
                    </button>
                </div>

                <!-- Second Section: Additional Info -->
                <div x-show="registrationSection === 2" class="section-transition space-y-3 md:space-y-4">
                    <div class="flex justify-between items-center mb-3 md:mb-4">
                        <h3 class="text-base md:text-lg font-medium text-amber-900">Informasi Tambahan</h3>
                        <span class="text-xs md:text-sm text-amber-700">Langkah 2 dari 2</span>
                    </div>

                    <div>
                        <label for="register-username"
                            class="block text-sm font-medium text-amber-900 mb-1">Username</label>
                        <input type="text" id="register-username" x-model="registerData.username" required
                            @input="validateForm"
                            name="username"
                            class="w-full px-3 md:px-4 py-2 rounded-lg border border-amber-300 focus:ring-2 focus:ring-amber-500 focus:border-amber-500 outline-none transition text-sm md:text-base"
                            placeholder="nama_pengguna">
                    </div>

                    <div>
                        <label for="register-class"
                            class="block text-sm font-medium text-amber-900 mb-1">Kelas</label>
                        <select id="register-class" name="class" x-model="registerData.class" required @change="validateForm" 
                            class="w-full px-3 md:px-4 py-2 rounded-lg border border-amber-300 focus:ring-2 focus:ring-amber-500 focus:border-amber-500 outline-none transition bg-white text-sm md:text-base">
                            <option value="" disabled selected>Pilih kelas</option>
                            <option value="10">Kelas 10</option>
                            <option value="11">Kelas 11</option>
                            <option value="12">Kelas 12</option>
                        </select>
                    </div>

                    <div>
                        <label for="register-phone" class="block text-sm font-medium text-amber-900 mb-1">Nomor
                            Telepon</label>
                        <input type="tel" name="phone" id="register-phone" x-model="registerData.phone" @input="validateForm"
                            class="w-full px-3 md:px-4 py-2 rounded-lg border border-amber-300 focus:ring-2 focus:ring-amber-500 focus:border-amber-500 outline-none transition text-sm md:text-base"
                            placeholder="081234567890">
                    </div>

                    <div class="flex items-start">
                        <input type="checkbox" id="terms" required x-model="termsAccepted"
                            @change="validateForm"
                            class="h-4 w-4 mt-1 text-amber-600 focus:ring-amber-500 border-amber-300 rounded">
                        <label for="terms" class="ml-2 block text-xs md:text-sm text-amber-800">
                            Saya menyetujui <a href="#"
                                class="text-amber-700 hover:text-amber-900 font-medium">Syarat & Ketentuan</a>
                        </label>
                    </div>

                    <div class="flex space-x-2 md:space-x-3">
                        <button type="button" @click="registrationSection = 1"
                            class="flex-1 bg-white text-chocolate py-2 px-4 rounded-lg border border-chocolate hover:bg-amber-50 transition-colors duration-300 font-medium text-sm md:text-base">
                            Kembali
                        </button>
                        <button type="submit" :disabled="!isFormValid()"
                            :class="{ 'opacity-50 cursor-not-allowed': !isFormValid() }"
                            class="flex-1 bg-chocolate text-white py-2 px-4 rounded-lg hover:bg-amber-800 transition-colors duration-300 font-medium text-sm md:text-base">
                            Buat Akun
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('authApp', () => ({
                currentTab: 'login',
                registrationSection: 1,
                termsAccepted: false,

                // Login Data
                loginData: {
                    identifier: '',
                    password: ''
                },
                showLoginPassword: false,

                // Register Data
                registerData: {
                    name: '',
                    email: '',
                    password: '',
                    confirmPassword: '',
                    username: '',
                    class: '',
                    phone: ''
                },
                showRegisterPasswords: false,

                // Methods
                resetRegisterForm() {
                    this.registrationSection = 1;
                    this.termsAccepted = false;
                    this.registerData = {
                        name: '',
                        email: '',
                        password: '',
                        confirmPassword: '',
                        username: '',
                        class: '',
                        phone: ''
                    };
                    this.showRegisterPasswords = false;
                },

                goToAdditionalInfo() {
                    if (this.isBasicInfoValid()) {
                        this.registrationSection = 2;
                    }
                },

                isBasicInfoValid() {
                    return this.registerData.name &&
                        this.registerData.email &&
                        this.registerData.password &&
                        this.registerData.confirmPassword &&
                        this.registerData.password === this.registerData.confirmPassword;
                },

                isFormValid() {
                    return this.isBasicInfoValid() &&
                        this.registerData.username &&
                        this.registerData.class &&
                        this.termsAccepted;
                },

                validateForm() {
                    // This method is called on input events to trigger reactivity
                },

                login() {
                    alert(
                        `Login attempt with:\nIdentifier: ${this.loginData.identifier}\nPassword: ${this.loginData.password}`);
                    // Here you would typically make an API call
                },

                register() {
                    if (!this.isFormValid()) {
                        return;
                    }
                    alert(`Registration data:\n${JSON.stringify(this.registerData, null, 2)}`);
                    // Here you would typically make an API call
                }
            }));
        });
    </script>
</body>

</html>
