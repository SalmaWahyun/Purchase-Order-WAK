<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RiwayatPesanan extends Model
{
    protected $table = 'riwayat_pesanan';
    protected $primaryKey = 'id_pesanan';
    public $timestamps = false;
    
    protected $fillable = [
        'id_pesanan',
        'tanggal_pesan',
        'tanggal_kirim',
        'status',
        'nama_user',
        'nama_konsumen',
        'nama_suplier'
    ];

    public function detailRiwayat()
    {
        return $this->hasMany(DetailRiwayatPesanan::class, 'ms_pesanan_id_pesanan', 'id_pesanan');
    }
}
