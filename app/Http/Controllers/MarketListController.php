<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use Illuminate\Http\Request;
use App\Models\Produk; 
use App\Models\Konsumen;
use App\Models\Suplier;
use App\Models\TransaksiPesanan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\RiwayatPesanan;
use App\Models\DetailRiwayatPesanan;


class MarketListController extends Controller
{
    public function index(Request $request)
    {
        // Query dasar dengan relasi
        $query = Pesanan::with(['konsumen', 'suplier']);

        // Filter berdasarkan status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter berdasarkan range tanggal
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('tanggal_pesan', [
                date('Y-m-d 00:00:00', strtotime($request->start_date)),
                date('Y-m-d 23:59:59', strtotime($request->end_date))
            ]);
        } elseif ($request->filled('start_date')) {
            $query->where('tanggal_pesan', '>=', date('Y-m-d 00:00:00', strtotime($request->start_date)));
        } elseif ($request->filled('end_date')) {
            $query->where('tanggal_pesan', '<=', date('Y-m-d 23:59:59', strtotime($request->end_date)));
        }

        // Sorting
        $sort = $request->get('sort', 'id_pesanan');
        $order = $request->get('order', 'desc');

        // Daftar kolom yang diizinkan untuk sorting
        $allowedSortColumns = [
            'id_pesanan',
            'tanggal_pesan',
            'status'
        ];

        // Sorting untuk kolom dalam tabel pesanan
        if (in_array($sort, $allowedSortColumns)) {
            $query->orderBy($sort, $order);
        }
        // Sorting untuk kolom dari tabel relasi
        elseif ($sort === 'nama_konsumen') {
            $query->join('ms_konsumen', 'ms_pesanan.ms_konsumen_id_konsumen', '=', 'ms_konsumen.id_konsumen')
                  ->orderBy('ms_konsumen.nama_konsumen', $order)
                  ->select('ms_pesanan.*');
        }
        elseif ($sort === 'nama_suplier') {
            $query->join('ms_suplier', 'ms_pesanan.ms_suplier_id_suplier', '=', 'ms_suplier.id_suplier')
                  ->orderBy('ms_suplier.nama_suplier', $order)
                  ->select('ms_pesanan.*');
        }

        // Debug query
        Log::info('SQL Query: ' . $query->toSql());
        Log::info('Query Bindings: ', $query->getBindings());

        // Pagination dengan mempertahankan parameter filter
        $ms_pesanan = $query->paginate(10)->appends(request()->query());

        // Data untuk form dan tampilan lainnya
        $ms_produk = Produk::all();
        $tr_pesanan = TransaksiPesanan::all();
        $konsumen = Konsumen::select('id_konsumen', 'nama_konsumen')->get();
        $suplier = Suplier::select('id_suplier', 'nama_suplier')->get();
        $produk = Produk::select('id_produk', 'nama_produk')->get();

        return view('marketlist', compact(
            'ms_produk',
            'ms_pesanan', 
            'tr_pesanan', 
            'konsumen', 
            'suplier', 
            'produk'
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

    public function createPesanan()
    {
        $konsumen = Konsumen::all();
        $suplier = Suplier::all();
        $produk = Produk::all();
        return view('tambah_pesanan', compact('konsumen', 'suplier', 'produk'));
    }

    public function storePesanan(Request $request)
    {
        // Validasi input tetap sama
        $validated = $request->validate([
            'tanggal_pesan' => 'required|date',
            'tanggal_kirim' => 'required|date', 
            'status' => 'required|string',
            'ms_konsumen_id_konsumen' => 'required|exists:ms_konsumen,id_konsumen',
            'ms_suplier_id_suplier' => 'required|exists:ms_suplier,id_suplier',
            'ms_user_id_user' => 'required',
            'produk' => 'required|array',
            'produk.*.ms_produk_id_produk' => 'required|exists:ms_produk,id_produk',
            'produk.*.jumlah' => 'required|integer|min:1',
            'produk.*.harga' => 'required|numeric|min:0'
        ]);

        try {
            // DB::beginTransaction(); // Aktifkan transaction

            // Debug input
            Log::info('Request Data:', $request->all());

            // Simpan pesanan
            $pesanan = Pesanan::create([
                'tanggal_pesan' => $validated['tanggal_pesan'],
                'tanggal_kirim' => $validated['tanggal_kirim'],
                'status' => $validated['status'],
                'ms_konsumen_id_konsumen' => $validated['ms_konsumen_id_konsumen'],
                'ms_suplier_id_suplier' => $validated['ms_suplier_id_suplier'],
                'ms_user_id_user' => $validated['ms_user_id_user']
            ]);

            // Debug pesanan yang dibuat
            Log::info('Pesanan created:', $pesanan->toArray());

            // Simpan detail produk ke tr_pesanan
            foreach ($request->produk as $index => $item) {
                // Debug setiap item produk
                Log::info("Processing product item {$index}:", $item);

                $subtotal = $item['jumlah'] * $item['harga'];
                
                try {
                    $transaksi = TransaksiPesanan::create([
                        'ms_pesanan_id_pesanan' => $pesanan->id_pesanan, // Gunakan ID pesanan yang baru dibuat
                        'ms_produk_id_produk' => $item['ms_produk_id_produk'],
                        'jumlah' => $item['jumlah'],
                        'harga' => $item['harga'],
                        'sub_total' => $subtotal
                    ]);

                    // Debug transaksi yang dibuat
                    Log::info("Transaksi created for product {$index}:", $transaksi->toArray());

                } catch (\Exception $e) {
                    Log::error("Error creating transaction for product {$index}: " . $e->getMessage());
                    throw $e;
                }
            }

            // DB::commit(); // Commit transaction jika semua berhasil
            
            return redirect()->route('marketlist')->with('success', 'Pesanan berhasil ditambahkan');

        } catch (\Exception $e) {
            // DB::rollback(); // Rollback jika terjadi error
            
            Log::error('Error saat menyimpan pesanan: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());
            
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function detailPesanan($id)
    {
        // Ambil data pesanan dengan eager loading semua relasi yang dibutuhkan
        $pesanan = Pesanan::with(['konsumen', 'suplier', 'transaksiPesanan.produk'])
            ->findOrFail($id);

        // Ambil transaksi pesanan melalui relasi
        $transaksiPesanan = $pesanan->transaksiPesanan;

        return view('detail_pesanan', compact('pesanan', 'transaksiPesanan'));
    }

    public function editPesanan($id)
    {
        // Ambil data pesanan dengan relasi
        $pesanan = Pesanan::with([
            'konsumen',
            'suplier',
            'transaksiPesanan.produk'
        ])->findOrFail($id);

        // Ambil data untuk dropdown
        $konsumens = Konsumen::all();
        $supliers = Suplier::all();
        $produks = Produk::all();

        return view('edit_pesanan', compact('pesanan', 'konsumens', 'supliers', 'produks'));
    }

    public function updatePesanan(Request $request, $id)
    {
        $request->validate([
            'tanggal_pesan' => 'required|date',
            'tanggal_kirim' => 'required|date',
            'status' => 'required',
            'ms_konsumen_id_konsumen' => 'required|exists:ms_konsumen,id_konsumen',
            'ms_suplier_id_suplier' => 'required|exists:ms_suplier,id_suplier',
            'transaksi' => 'required|array',
            'transaksi.*.id_tr_pesanan' => 'required|exists:tr_pesanan,id_tr_pesanan',
            'transaksi.*.jumlah' => 'required|numeric|min:1',
            'transaksi.*.harga' => 'required|numeric|min:0'
        ]);

        try {
            DB::beginTransaction();

            // Update pesanan utama
            $pesanan = Pesanan::findOrFail($id);
            $pesanan->update([
                'tanggal_pesan' => $request->tanggal_pesan,
                'tanggal_kirim' => $request->tanggal_kirim,
                'status' => $request->status,
                'ms_konsumen_id_konsumen' => $request->ms_konsumen_id_konsumen,
                'ms_suplier_id_suplier' => $request->ms_suplier_id_suplier
            ]);

            // Update transaksi pesanan
            foreach ($request->transaksi as $item) {
                $transaksi = TransaksiPesanan::findOrFail($item['id_tr_pesanan']);
                $subtotal = $item['jumlah'] * $item['harga'];
                
                $transaksi->update([
                    'jumlah' => $item['jumlah'],
                    'harga' => $item['harga'],
                    'sub_total' => $subtotal
                ]);
            }

            DB::commit();
            return redirect()->route('marketlist')->with('success', 'Pesanan berhasil diperbarui');

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function deleteTransaksi($id)
    {
        try {
            $transaksi = TransaksiPesanan::findOrFail($id);
            $pesananId = $transaksi->ms_pesanan_id_pesanan;
            
            // Hitung jumlah produk dalam pesanan ini
            $jumlahProduk = TransaksiPesanan::where('ms_pesanan_id_pesanan', $pesananId)->count();
            
            // Jika hanya 1 produk, simpan informasi ini untuk view
            if ($jumlahProduk <= 1) {
                return redirect()->back()
                    ->with('showDeleteConfirm', true)
                    ->with('deleteId', $id)
                    ->with('pesananId', $pesananId);
            }
            
            // Jika lebih dari 1 produk, langsung hapus
            $transaksi->delete();
            return redirect()->route('pesanan.edit', $pesananId)
                ->with('success', 'Produk berhasil dihapus dari pesanan');
            
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat menghapus produk');
        }
    }

    public function deleteTransaksiAndPesanan($id)
    {
        try {
            DB::beginTransaction();
            
            // Cari transaksi dan pesanan terkait
            $transaksi = TransaksiPesanan::findOrFail($id);
            $pesanan = Pesanan::findOrFail($transaksi->ms_pesanan_id_pesanan);
            
            // Hapus semua transaksi terkait pesanan ini
            TransaksiPesanan::where('ms_pesanan_id_pesanan', $pesanan->id_pesanan)->delete();
            
            // Hapus pesanan
            $pesanan->delete();
            
            DB::commit();
            return redirect()->route('marketlist')
                ->with('success', 'Pesanan dan semua produknya berhasil dihapus');
            
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error deleting pesanan: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat menghapus pesanan: ' . $e->getMessage());
        }
    }

    public function storeTransaksi(Request $request, $pesananId)
    {
        $request->validate([
            'ms_produk_id_produk' => 'required|exists:ms_produk,id_produk',
            'jumlah' => 'required|numeric|min:1',
            'harga' => 'required|numeric|min:0'
        ]);

        try {
            DB::beginTransaction();

            // Cek apakah produk sudah ada di pesanan ini
            $existingTransaksi = TransaksiPesanan::where('ms_pesanan_id_pesanan', $pesananId)
                ->where('ms_produk_id_produk', $request->ms_produk_id_produk)
                ->first();

            if ($existingTransaksi) {
                // Update jumlah dan subtotal jika produk sudah ada
                $jumlahBaru = $existingTransaksi->jumlah + $request->jumlah;
                $subtotal = $jumlahBaru * $request->harga;
                
                $existingTransaksi->update([
                    'jumlah' => $jumlahBaru,
                    'harga' => $request->harga,
                    'sub_total' => $subtotal
                ]);
            } else {
                // Buat transaksi baru jika produk belum ada
                $subtotal = $request->jumlah * $request->harga;
                
                TransaksiPesanan::create([
                    'ms_pesanan_id_pesanan' => $pesananId,
                    'ms_produk_id_produk' => $request->ms_produk_id_produk,
                    'jumlah' => $request->jumlah,
                    'harga' => $request->harga,
                    'sub_total' => $subtotal
                ]);
            }

            DB::commit();
            return redirect()->route('pesanan.edit', $pesananId)
                ->with('success', 'Produk berhasil ditambahkan ke pesanan');

        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error adding product to pesanan: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat menambah produk: ' . $e->getMessage());
        }
    }

    public function deletePesanan($id)
    {
        try {
            DB::beginTransaction();
            
            // Cari pesanan
            $pesanan = Pesanan::findOrFail($id);
            
            // Hapus semua transaksi terkait
            TransaksiPesanan::where('ms_pesanan_id_pesanan', $id)->delete();
            
            // Hapus pesanan
            $pesanan->delete();
            
            DB::commit();
            return redirect()->route('marketlist')
                ->with('success', 'Pesanan berhasil dihapus');
            
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error deleting pesanan: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat menghapus pesanan');
        }
    }

    public function selesaikanPesanan($id)
    {
        try {
            DB::beginTransaction();
            
            // Cari pesanan beserta semua relasinya
            $pesanan = Pesanan::with(['transaksiPesanan.produk', 'konsumen', 'suplier', 'user'])
                             ->findOrFail($id);
            
            if ($pesanan->status !== 'dikirim') {
                throw new \Exception('Hanya pesanan dengan status dikirim yang dapat diselesaikan');
            }

            // Simpan ID pesanan untuk digunakan sebagai referensi
            $pesananId = $pesanan->id_pesanan;

            // Buat record di riwayat_pesanan dengan ID yang sama
            $riwayat = RiwayatPesanan::create([
                'id_pesanan' => $pesananId,
                'tanggal_pesan' => $pesanan->tanggal_pesan,
                'tanggal_kirim' => $pesanan->tanggal_kirim,
                'status' => 'selesai',
                'nama_user' => $pesanan->user->nama_user,
                'nama_konsumen' => $pesanan->konsumen->nama_konsumen,
                'nama_suplier' => $pesanan->suplier->nama_suplier
            ]);

            // Pastikan riwayat pesanan berhasil dibuat
            if (!$riwayat) {
                throw new \Exception('Gagal membuat riwayat pesanan');
            }

            // Pindahkan detail transaksi dengan ID yang sama
            foreach ($pesanan->transaksiPesanan as $transaksi) {
                DetailRiwayatPesanan::create([
                    'id_tr_pesanan' => $transaksi->id_tr_pesanan,
                    'jumlah' => $transaksi->jumlah,
                    'harga' => $transaksi->harga,
                    'sub_total' => $transaksi->sub_total,
                    'nama_produk' => $transaksi->produk->nama_produk,
                    'ms_pesanan_id_pesanan' => $pesananId  // Gunakan ID yang sama dengan riwayat
                ]);
            }

            // Hapus data dari tabel asli
            $pesanan->transaksiPesanan()->delete();
            $pesanan->delete();
            
            DB::commit();
            return redirect()->route('marketlist')
                ->with('success', 'Pesanan berhasil diselesaikan dan dipindahkan ke riwayat');
            
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error completing order: ' . $e->getMessage());
            return response()->view('errors.custom', [
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ], 500);
        }
    }

}
