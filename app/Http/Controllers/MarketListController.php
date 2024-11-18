<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk; 

class MarketListController extends Controller
{
    public function index()
    {
        $ms_produk = Produk::all(); // Ambil semua data dari tabel

        return view('marketlist', compact('ms_produk'));
    }

    public function TambahProduk(Request $request)
    {
        $validated = $request->validate([
            'nama_produk' => 'required|string|max:50',
            'deskripsi' => 'required|string',
            'harga_produk' => 'required|numeric',
            'satuan' => 'required|string',
        ]);

        Produk::create($validated);

        return redirect()->back()->with('success', 'Produk berhasil ditambahkan.');
    }

    public function EditProduk($id)
    {
        $produk = Produk::findOrFail($id); // Mencari produk berdasarkan ID
        return view('editproduk', compact('produk')); // Tampilkan form edit dengan data produk
    }

    public function UpdateProduk(Request $request, $id)
    {
        // Validasi input
        $validated = $request->validate([
            'nama_produk' => 'required|string|max:50',
            'deskripsi' => 'required|string',
            'harga_produk' => 'required|numeric',
            'satuan' => 'required|string',
        ]);

        // Temukan produk berdasarkan ID
        $produk = Produk::findOrFail($id);

        // Perbarui produk dengan data yang telah divalidasi
        $produk->update($validated);

        // Redirect kembali ke daftar produk dengan pesan sukses
        return redirect()->route('marketlist')->with('success', 'Produk berhasil diperbarui.');
    }


}
