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

    public function UpdateSuplier(Request $request, $id)
    {
        // Validasi input
        $validated = $request->validate([
            'nama_suplier' => 'required|string',
            'alamat' => 'required|string',
            'no_hp' => 'required|string',
            'email' => 'required|string',
        ]);

        try {
            // Temukan suplier berdasarkan ID
            $suplier = Suplier::findOrFail($id);

            // Update suplier
            $suplier->update($validated);

            return redirect()->route('suplier')
                ->with('success', 'Suplier berhasil diperbarui');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat memperbarui suplier');
        }
    }

    public function deleteSuplier($id)
    {
        try {
            $suplier = Suplier::findOrFail($id);
            $suplier->delete();
            
            return redirect()->route('suplier')
                ->with('success', 'Suplier berhasil dihapus');
                
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat menghapus suplier');
        }
    }
}
