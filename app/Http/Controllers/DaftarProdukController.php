<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesanan; 
use App\Models\Konsumen;
use App\Models\Suplier;
use App\Models\Produk;

class DaftarProdukController extends Controller
{
    public function index(Request $request)
    {
        // Query dasar
        $query = Produk::query();

        // Sorting
        $sort = $request->get('sort', 'id_produk');
        $order = $request->get('order', 'asc');

        // Daftar kolom yang diizinkan untuk sorting
        $allowedSortColumns = [
            'id_produk',
            'nama_produk',
            'harga_produk',
            'satuan'
        ];

        // Terapkan sorting
        if (in_array($sort, $allowedSortColumns)) {
            $query->orderBy($sort, $order);
        }

        // Pagination
        $ms_produk = $query->paginate(10);
        
        // Data lainnya
        $ms_pesanan = Pesanan::all();
        $konsumen = Konsumen::select('id_konsumen', 'nama_konsumen')->get();
        $suplier = Suplier::select('id_suplier', 'nama_suplier')->get();

        return view('daftarproduk', compact(
            'ms_pesanan', 
            'ms_produk', 
            'konsumen', 
            'suplier'
        ));
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

        // Update produk
        $produk->update($validated);

        return redirect()->back()->with('success', 'Produk berhasil diperbarui.');
    }

    public function deleteProduk($id)
    {
        try {
            $produk = Produk::findOrFail($id);
            
            // Cek apakah produk digunakan di pesanan yang sudah dikirim
            $pesananDikirim = Pesanan::whereHas('transaksiPesanan', function($query) use ($id) {
                $query->where('ms_produk_id_produk', $id);
            })->where('status', 'dikirim')->first();

            if ($pesananDikirim) {
                return redirect()->back()
                    ->with('error', "Produk masih digunakan dalam pesanan yang sudah dikirim. Tidak dapat menghapus produk.");
            }

            // Cek apakah produk digunakan di pesanan yang masih berstatus pesanan
            $pesananAktif = Pesanan::whereHas('transaksiPesanan', function($query) use ($id) {
                $query->where('ms_produk_id_produk', $id);
            })->where('status', 'pesanan')->first();

            if ($pesananAktif) {
                return redirect()->back()
                    ->with('warning', "Produk digunakan dalam pesanan yang masih aktif. Silakan edit atau hapus produk dari pesanan terlebih dahulu.")
                    ->with('pesananId', $pesananAktif->id_pesanan);
            }

            // Jika tidak ada masalah, hapus produk
            $produk->delete();
            return redirect()->route('daftarproduk')
                ->with('success', 'Produk berhasil dihapus');
                
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat menghapus produk');
        }
    }
}
