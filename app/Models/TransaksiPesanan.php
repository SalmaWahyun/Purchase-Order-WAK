<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiPesanan extends Model
{
    use HasFactory;

    
    protected $table = 'tr_pesanan'; // Nama tabel di database
    protected $fillable = ['jumlah', 'harga', 'sub_total', 'ms_produk_id_produk', 'ms_pesanan_id_pesanan'];
    public $timestamps = false;
    protected $primaryKey = 'id_tr_pesanan'; 

    public function trPesananPesananProduk()
    {
        return $this->belongsTo(Pesanan::class, 'ms_pesanan_id_pesanan ', 'id_pesanan');
    }
    public function produk()
    {
        return $this->belongsTo(Produk::class, 'ms_produk_id_produk', 'id_produk');
    }
}
