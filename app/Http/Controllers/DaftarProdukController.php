<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesanan; 
use App\Models\Konsumen;
use App\Models\Suplier;
use App\Models\Produk;

class DaftarProdukController extends Controller
{
    public function index()
    {
        $ms_produk = Produk::all();
        $ms_pesanan = Pesanan::all(); // Ambil semua data dari tabel
        $konsumen = Konsumen::select('id_konsumen', 'nama_konsumen')->get();
        $suplier = Suplier::select('id_suplier', 'nama_suplier')->get();

        return view('daftarproduk', compact('ms_pesanan', 'ms_produk', 'konsumen', 'suplier'));
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
}
