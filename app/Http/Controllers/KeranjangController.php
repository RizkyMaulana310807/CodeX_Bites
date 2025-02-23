<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Keranjang;
use App\Models\Produk;

class KeranjangController extends Controller
{
    // Menampilkan daftar produk di keranjang
    public function index()
    {
        $keranjang = Keranjang::with('produk')->get(); // Ambil semua data keranjang dengan relasi produk

        return view('keranjang', [
            'title' => 'Keranjang Belanja',
            'menus' => $keranjang
        ]);
    }

    // Update quantity

    public function updateQuantity(Request $request, $id)
    {
        $keranjang = Keranjang::findOrFail($id);
        $keranjang->jumlah = $request->jumlah;
        $keranjang->save();

        return response()->json(['success' => true, 'message' => 'Jumlah berhasil diperbarui']);
    }


    // Menambahkan produk ke keranjang
    public function add(Request $request)
    {
        try {
            $request->validate([
                'produk_id' => 'required|exists:produk,id',
            ]);

            // Cek apakah produk sudah ada di keranjang
            $keranjang = Keranjang::where('produk_id', $request->produk_id)->first();

            if ($keranjang) {
                // Jika sudah ada, tambahkan jumlahnya
                $keranjang->increment('jumlah');
            } else {
                // Jika belum ada, tambahkan baru
                Keranjang::create([
                    'produk_id' => $request->produk_id,
                    'jumlah' => 1
                ]);
            }

            return response()->json([
                'message' => 'Produk berhasil ditambahkan ke keranjang!'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    // Menghapus produk dari keranjang
    public function remove($id)
    {
        $keranjang = Keranjang::findOrFail($id);
        $keranjang->delete();

        return redirect()->route('keranjang.index')->with('success', 'Produk dihapus dari keranjang');
    }

    // Mengupdate jumlah produk di keranjang
    public function update(Request $request, $id)
    {
        $request->validate([
            'jumlah' => 'required|integer|min:1'
        ]);

        $keranjang = Keranjang::findOrFail($id);
        $keranjang->update(['jumlah' => $request->jumlah]);

        return redirect()->route('keranjang.index')->with('success', 'Jumlah produk diperbarui');
    }

    // Mengosongkan keranjang
    public function clear()
    {
        Keranjang::truncate();

        return redirect()->route('keranjang.index')->with('success', 'Keranjang dikosongkan');
    }
}
