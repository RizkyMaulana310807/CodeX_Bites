<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Produk; // Tambahkan ini!



Route::get('/', function () {
    return view('logo', ["title" => "CodeX Bites"]);
});

Route::get('/home', function () {
    $menus = Produk::all(); // Ambil semua data dari tabel produk

    return view('home', [
        "title" => "Home",
        "menus" => $menus
]);
});

Route::get('/detail', function () {
    return view('detail', ["title" => "Detail"]);
});

Route::get('/keranjang', function () {
    return view('keranjang', ["title" => "Keranjang", "menus" => [
        [
            "id" => 1,
            "kategori" => "CodeX",
            "nama" => "Brownies",
            "deskripsi" => "Makanan enak sekali",
            "rating" => 5,
            "harga" => 3000,
            "img" => "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRzaH7SHc8cY8065OIgdM4mh37jeJdylzjs6w&s",
        ],
        [
            "id" => 2,
            "kategori" => "CodeX",
            "nama" => "Minuman",
            "deskripsi" => "Minuman segar sekali",
            "rating" => 4,
            "harga" => 3000,
            "img" => "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRzaH7SHc8cY8065OIgdM4mh37jeJdylzjs6w&s",
        ],
        [
            "id" => 3,
            "kategori" => "CodeX",
            "nama" => "Apa aja",
            "deskripsi" => "Makanan apa aja bisa",
            "rating" => 4,
            "harga" => 3000,
            "img" => "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRzaH7SHc8cY8065OIgdM4mh37jeJdylzjs6w&s",
        ]
    ]]);
});

Route::get('/profile', function () {
    return view('profile', ["title" => "Profile"]);
});

Route::get('/checkout', function () {
    return view('checkout', ["title" => "Checkout"]);
});

Route::get('/invoice', function () {
    return view('invoice', ["title" => "Invoice"]);
});