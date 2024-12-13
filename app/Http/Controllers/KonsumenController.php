<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Konsumen;

class KonsumenController extends Controller
{
    public function index()
    {
        $ms_konsumen = Konsumen::all();

        return view('konsumen', compact('ms_konsumen'));
    }

    public function TambahKonsumen(Request $request)
    {
        $validated = $request->validate([
            'nama_konsumen' => 'required|string',
            'alamat' => 'required|string',
            'no_hp' => 'required|string',
            'email' => 'required|string',
        ]);

        Konsumen::create($validated);

        return redirect()->back()->with('success', 'Konsumen berhasil ditambahkan.');
    }
}
