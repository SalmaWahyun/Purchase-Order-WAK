<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk; 

class MarketListController extends Controller
{
    public function index()
    {
        $ms_produk = Produk::all(); // Ambil semua data dari tabel

        return view('marketlist', compact('ms_produk'));
    }
}
