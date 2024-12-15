<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesanan;
use App\Models\RiwayatPesanan;

class DashboardController extends Controller
{
    public function index()
    {
        // Hitung pesanan selesai dari tabel riwayat
        $pesananSelesai = RiwayatPesanan::count();
        
        // Hitung pesanan yang sedang dikirim
        $pesananDikirim = Pesanan::where('status', 'dikirim')->count();
        
        // Hitung pesanan yang baru dipesan
        $pesananDipesan = Pesanan::where('status', 'pesanan')->count();
        
        // Total seluruh pesanan (pesanan aktif + riwayat)
        $totalPesanan = Pesanan::count() + RiwayatPesanan::count();

        return view('dashboard', compact(
            'pesananSelesai',
            'pesananDikirim',
            'pesananDipesan',
            'totalPesanan'
        ));
    }
}
