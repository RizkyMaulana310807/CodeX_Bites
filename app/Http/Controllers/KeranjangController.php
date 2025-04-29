<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Keranjang;
use App\Models\Menu;
use App\Models\transaksi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class KeranjangController extends Controller
{
    public function index()
    {
        // Ambil semua item keranjang milik user yang sedang login
        $items = Keranjang::with('menu')
            ->where('user_id', Auth::id())
            ->get();

        // Hitung total harga semua item
        $totalHarga = $items->sum('total_harga');

        return view('Pengguna.keranjang', compact('items', 'totalHarga'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'menu_id' => 'required|exists:menus,id',
            'jumlah' => 'required|integer|min:1|max:10',
        ]);

        $menu = Menu::findOrFail($request->menu_id);
        $jumlah = $request->jumlah;

        // Cek apakah item sudah ada di keranjang
        $existingItem = Keranjang::where('user_id', Auth::id())
            ->where('menu_id', $menu->id)
            ->first();

        if ($existingItem) {
            // Update jumlah jika sudah ada
            $existingItem->total_harga = $menu->harga * $jumlah;
            $existingItem->save();
        } else {
            // Tambahkan baru jika belum ada
            Keranjang::create([
                'user_id' => Auth::id(),
                'menu_id' => $menu->id,
                'total_harga' => $menu->harga * $jumlah,
            ]);
        }

        return back()->with('success', 'Item berhasil ditambahkan ke keranjang.');
    }

    public function delete($id)
    {
        // Menggunakan try-catch untuk menangani jika item tidak ditemukan
        try {
            $item = Keranjang::where('id', $id)
                ->where('user_id', Auth::id())
                ->firstOrFail();

            $item->delete();

            if (request()->ajax()) {
                return response()->json(['success' => true]);
            }

            return redirect()->route('keranjang.index')->with('success', 'Item berhasil dihapus dari keranjang');
        } catch (\Exception $e) {
            if (request()->ajax()) {
                return response()->json(['success' => false, 'message' => 'Item tidak ditemukan'], 404);
            }

            return redirect()->route('keranjang.index')->with('error', 'Item tidak ditemukan');
        }
    }

    public function empty()
    {
        Keranjang::where('user_id', Auth::id())->delete();

        return redirect()->route('keranjang.index')->with('success', 'Keranjang berhasil dikosongkan');
    }

    public function updateJumlah(Request $request, $id)
    {
        $request->validate([
            'jumlah' => 'required|integer|min:1',
        ]);

        $item = Keranjang::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        // Ambil harga satuan dari menu
        $hargaSatuan = $item->menu->harga;

        // Update total harga berdasarkan jumlah baru
        $item->total_harga = $hargaSatuan * $request->jumlah;
        $item->save();

        return response()->json([
            'success' => true,
            'subtotal' => $item->total_harga,
            'formatted_subtotal' => 'Rp' . number_format($item->total_harga, 0, ',', '.'),
        ]);
    }

    public function deleteSelected(Request $request)
    {
        $request->validate([
            'item_ids' => 'required|array',
            'item_ids.*' => 'integer|exists:keranjangs,id',
        ]);

        // Hapus semua item yang dipilih dan milik user saat ini
        Keranjang::whereIn('id', $request->item_ids)
            ->where('user_id', Auth::id())
            ->delete();

        if ($request->ajax()) {
            return response()->json(['success' => true]);
        }

        return redirect()->route('keranjang.index')->with('success', 'Item yang dipilih berhasil dihapus');
    }

    public function checkout(Request $request)
    {
        $userId = Auth::id();

        // Ambil semua data dari keranjang user
        $keranjangs = Keranjang::where('user_id', $userId)->get();

        // Cek apakah keranjang kosong
        if ($keranjangs->isEmpty()) {
            return redirect()->back()->with('error', 'Keranjang masih kosong.');
        }

        // Simpan data dari keranjang ke transaksi
        foreach ($keranjangs as $item) {
            $totalHarga = $item->total_harga; // Mengambil total harga yang sebelumnya sudah dihitung
        
            transaksi::create([
                'user_id'     => $userId,
                'menu_id'     => $item->menu_id,
                'total_harga' => $totalHarga,
            ]);
        }
        
        // Hapus isi keranjang setelah checkout
        Keranjang::where('user_id', $userId)->delete();

        return redirect('/keranjang')->with('success', 'Checkout berhasil!');
    }
}
