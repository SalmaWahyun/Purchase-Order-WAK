<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Konsumen extends Model
{
    use HasFactory;

    protected $table = 'ms_konsumen'; // Nama tabel di database
    protected $fillable = ['nama_konsumen', 'alamat', 'no_hp', 'email'];
    public $timestamps = false;
    protected $primaryKey = 'id_konsumen'; 
}
