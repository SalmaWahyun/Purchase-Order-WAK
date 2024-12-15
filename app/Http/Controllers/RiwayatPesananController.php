<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RiwayatPesanan;
use App\Models\DetailRiwayatPesanan;

class RiwayatPesananController extends Controller
{
    public function index(Request $request)
    {
        $query = RiwayatPesanan::query();

        // Filter berdasarkan range tanggal
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('tanggal_pesan', [
                $request->start_date,
                $request->end_date
            ]);
        }

        // Sorting
        $sort = $request->get('sort', 'id_pesanan');
        $order = $request->get('order', 'desc');
        
        $query->orderBy($sort, $order);

        $riwayat_pesanan = $query->paginate(10);
        
        return view('riwayat_pesanan', compact('riwayat_pesanan'));
    }

    public function detail($id)
    {
        // Ambil data riwayat pesanan
        $riwayat = RiwayatPesanan::findOrFail($id);
        
        // Ambil detail riwayat pesanan
        $detail_riwayat = DetailRiwayatPesanan::where('ms_pesanan_id_pesanan', $id)->get();

        // Jika tidak ada detail, kembalikan dengan pesan error
        if ($detail_riwayat->isEmpty()) {
            return redirect()->route('riwayat.index')
                           ->with('error', 'Detail riwayat pesanan tidak ditemukan');
        }

        return view('detail_riwayat', compact('riwayat', 'detail_riwayat'));
    }
}
