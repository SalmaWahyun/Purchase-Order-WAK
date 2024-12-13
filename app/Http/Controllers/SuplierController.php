<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Suplier;

class SuplierController extends Controller
{
    public function index()
    {
        $ms_suplier = Suplier::all();

        return view('suplier', compact('ms_suplier'));
    }

    public function TambahSuplier(Request $request)
    {
        $validated = $request->validate([
            'nama_suplier' => 'required|string',
            'alamat' => 'required|string',
            'no_hp' => 'required|string',
            'email' => 'required|string',
        ]);

        Suplier::create($validated);

        return redirect()->back()->with('success', 'Suplier berhasil ditambahkan.');
    }
}
