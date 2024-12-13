<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use Illuminate\Http\Request;
use App\Models\Produk; 
use App\Models\Konsumen;
use App\Models\Suplier;
use App\Models\TransaksiPesanan;


class MarketListController extends Controller
{
    public function index()
    {
        $ms_produk = Produk::all(); // Ambil semua data dari tabel
        $ms_pesanan = Pesanan::all(); // Ambil semua data dari tabel
        $tr_pesanan = TransaksiPesanan::all();
        $konsumen = Konsumen::select('id_konsumen', 'nama_konsumen')->get();
        $suplier = Suplier::select('id_suplier', 'nama_suplier')->get();
        $produk = Produk::select('id_produk', 'nama_produk')->get();

        return view('marketlist', compact('ms_produk','ms_pesanan', 'tr_pesanan', 'konsumen', 'suplier', 'produk'));
        
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

    public function TambahPesanan(Request $request)
    {
        
        $validated = $request->validate([
            'tanggal_pesan' => 'required|date',
            'tanggal_kirim' => 'required|date',
            'status' => 'required|string',
            'ms_user_id_user' => 'required|integer|exists:ms_user,id_user',
            'ms_konsumen_id_konsumen' => 'required|integer|exists:ms_konsumen,id_konsumen',
            'ms_suplier_id_suplier' => 'required|integer|exists:ms_suplier,id_suplier',
        ]);
        dd($request->all());
        Pesanan::create($validated);
    
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
