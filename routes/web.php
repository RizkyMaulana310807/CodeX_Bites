<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('logo');
});

Route::get('/home', function () {
    return view('home');
});

Route::get('/favorite', function () {
    return view('favorite');
});

Route::get('/cart', function () {
    return view('cart');
});

Route::get('/contact', function () {
    return view('contact');
});