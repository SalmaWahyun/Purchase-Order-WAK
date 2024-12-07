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
}
