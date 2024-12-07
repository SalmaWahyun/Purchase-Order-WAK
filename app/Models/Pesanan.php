<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;

    protected $table = 'ms_pesanan'; // Nama tabel di database
    protected $fillable = ['tanggal_pesan', 'tanggal_kirim', 'penerima', 'catatan', 'status', 'ms_user_id_user', 'ms_konsumen_id_konsumen', 'ms_suplier_id_suplier'];
    public $timestamps = false;
    protected $primaryKey = 'id_pesanan'; 

    public function konsumen()
    {
        return $this->belongsTo(Konsumen::class, 'ms_konsumen_id_konsumen', 'id_konsumen');
    }

    public function suplier()
    {
        return $this->belongsTo(Suplier::class, 'ms_suplier_id_suplier', 'id_suplier');
    }

}
