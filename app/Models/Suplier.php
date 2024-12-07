<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suplier extends Model
{
    use HasFactory;

    protected $table = 'ms_suplier'; // Nama tabel di database
    protected $fillable = ['nama_suplier', 'alamat', 'no_hp', 'email'];
    public $timestamps = false;
    protected $primaryKey = 'id_suplier'; 
}
