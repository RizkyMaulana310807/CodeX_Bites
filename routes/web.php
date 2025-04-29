<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Database\Eloquent\Collection;
use App\Models\Menu;
use App\Models\Keranjang;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KeranjangController;



Route::get('/', action: function () {
    return view('Pengguna.home', ["title" => "Beranda", "menus" => Menu::all()]);
});

Route::get('/profile', action: function () {
    return view('Pengguna.profile', ["title" => "Profile"]);
});

Route::get('/keranjang', function () {
    return view('Pengguna.keranjang', ["title" => "Keranjang"]);
})->name('Pengguna.keranjang');

Route::get('/menu/{menu}', function (Menu $menu) {
    return view('Pengguna.menu', ["title" => "Detail Menu", "menu" => $menu]);
});
Route::get('/menus', function (Menu $menu) {
    return view('Pengguna.menus', ["menus" => Menu::all()]);
});

Route::get('/auth', function () {
    return view('Auth.auth', ["title" => "Login"]);
});

Route::post('/login', [AuthController::class, 'login'])->name('login');

// Route untuk proses register
Route::post('/register', [AuthController::class, 'register'])->name('register');

// Route untuk logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::post('/keranjang', [KeranjangController::class, 'store'])->middleware('auth');
// Tambahkan routes berikut pada file routes/web.php

// Routes untuk keranjang belanja
Route::middleware(['auth'])->group(function () {
    // Menampilkan keranjang
    Route::get('/keranjang', [KeranjangController::class, 'index'])->name('keranjang.index');

    // Tambah item ke keranjang
    Route::post('/keranjang', [KeranjangController::class, 'store'])->name('keranjang.tambah');

    // Hapus item dari keranjang
    Route::delete('/keranjang/{id}', [KeranjangController::class, 'delete'])->name('keranjang.hapus');

    // Kosongkan keranjang
    Route::delete('/keranjang', [KeranjangController::class, 'empty'])->name('keranjang.kosongkan');

    // Update jumlah item di keranjang
    Route::patch('/keranjang/{id}/jumlah', [KeranjangController::class, 'updateJumlah'])->name('keranjang.update-jumlah');

    // Hapus multiple items yang dipilih
    Route::delete('/keranjang/hapus-terpilih', [KeranjangController::class, 'deleteSelected'])->name('keranjang.hapus-terpilih');
    Route::post('/keranjang/checkout', [KeranjangController::class, 'checkout'])->name('keranjang.checkout')->middleware('auth');
});
