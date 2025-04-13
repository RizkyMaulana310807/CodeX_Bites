<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Database\Eloquent\Collection;
use App\Models\Menu;
use App\Http\Controllers\AuthController;


Route::get('/', action: function () {
    return view('Pengguna.menus', ["title" => "Beranda", "menus" => Menu::all()]);
});

Route::get('/menu/{menu}', function (Menu $menu) {
    return view('Pengguna.menu', ["title" => "Detail Menu", "menu" => $menu]);
});

Route::get('/auth', function () {
    return view('Auth.auth', ["title" => "Login"]);
});

Route::post('/login', [AuthController::class, 'login'])->name('login');

// Route untuk proses register
Route::post('/register', [AuthController::class, 'register'])->name('register');

// Route untuk logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
