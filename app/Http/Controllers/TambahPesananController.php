<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Pesanan; 
use App\Models\Konsumen;
use App\Models\Suplier;  

class TambahPesananController extends Controller
{
    public function index()
    {
        $ms_pesanan = Pesanan::all(); // Ambil semua data dari tabel
        $konsumen = Konsumen::select('id_konsumen', 'nama_konsumen')->get();
        $suplier = Suplier::select('id_suplier', 'nama_suplier')->get();

        return view('tambahpesanan', compact('ms_pesanan', 'konsumen', 'suplier'));
    }
}
