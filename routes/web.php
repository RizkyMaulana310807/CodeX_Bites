<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Database\Eloquent\Collection;
use App\Models\Menu;

Route::get('/', action: function () {
    return view('Pengguna.menus', ["title" => "Beranda", "menus"=>Menu::all()]);
});

Route::get('/menu/{menu}', function (Menu $menu) {
    return view('Pengguna.menu', ["title" => "Detail Menu", "menu" => $menu]);
});