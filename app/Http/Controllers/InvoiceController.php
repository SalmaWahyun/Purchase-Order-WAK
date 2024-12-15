<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesanan;
use App\Models\TransaksiPesanan;

class InvoiceController extends Controller
{
    public function index()
    {
        return view('cetak_invoice');
    }


    public function Invoice($id)
    {
        $pesanan = Pesanan::with(['konsumen', 'suplier'])->findOrFail($id);
        $transaksiPesanan = TransaksiPesanan::with('produk')
                            ->where('id_tr_pesanan', $id)
                            ->get();

        return view('cetak_invoice', compact('pesanan', 'transaksiPesanan'));
    }
}
