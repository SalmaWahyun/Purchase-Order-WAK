<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\TransaksiPesanan;
use App\Models\Konsumen;
use App\Models\Suplier;
use App\Models\User;

class Pesanan extends Model
{
    use HasFactory;

    protected $table = 'ms_pesanan';
    protected $fillable = ['tanggal_pesan', 'tanggal_kirim', 'status', 'ms_user_id_user', 'ms_konsumen_id_konsumen', 'ms_suplier_id_suplier'];
    public $timestamps = false;
    protected $primaryKey = 'id_pesanan'; 

    public function transaksiPesanan()
    {
        return $this->hasMany(TransaksiPesanan::class, 'ms_pesanan_id_pesanan', 'id_pesanan');
    }

    public function konsumen()
    {
        return $this->belongsTo(Konsumen::class, 'ms_konsumen_id_konsumen', 'id_konsumen');
    }

    public function suplier()
    {
        return $this->belongsTo(Suplier::class, 'ms_suplier_id_suplier', 'id_suplier');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'ms_user_id_user', 'id_user');
    }
}
