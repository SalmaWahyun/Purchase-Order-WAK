<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'ms_produk'; // Nama tabel di database
    protected $fillable = ['nama_produk', 'deskripsi', 'harga_produk', 'satuan'];
    public $timestamps = false;
    protected $primaryKey = 'id_produk'; 
}
