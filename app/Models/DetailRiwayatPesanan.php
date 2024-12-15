<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailRiwayatPesanan extends Model
{
    protected $table = 'detail_riwayat_pesanan';
    protected $primaryKey = 'id_tr_pesanan';
    public $timestamps = false;
    
    protected $fillable = [
        'id_tr_pesanan',
        'jumlah',
        'harga',
        'sub_total',
        'nama_produk',
        'ms_pesanan_id_pesanan'
    ];

    public function riwayatPesanan()
    {
        return $this->belongsTo(RiwayatPesanan::class, 'ms_pesanan_id_pesanan', 'id_pesanan');
    }
}
