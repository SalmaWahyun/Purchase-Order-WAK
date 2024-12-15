<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Konsumen;

class KonsumenController extends Controller
{
    public function index(Request $request)
    {
        // Query dasar
        $query = Konsumen::query();

        // Sorting
        $sort = $request->get('sort', 'id_konsumen');
        $order = $request->get('order', 'asc');

        // Terapkan sorting jika yang dipilih adalah id_konsumen
        if ($sort === 'id_konsumen') {
            $query->orderBy($sort, $order);
        }

        // Pagination
        $ms_konsumen = $query->paginate(10);
        
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

    public function UpdateKonsumen(Request $request, $id)
    {
        $validated = $request->validate([
            'nama_konsumen' => 'required|string',
            'alamat' => 'required|string',
            'no_hp' => 'required|string',
            'email' => 'required|string',
        ]);

        try {
            $konsumen = Konsumen::findOrFail($id);
            $konsumen->update($validated);

            return redirect()->route('konsumen')
                ->with('success', 'Konsumen berhasil diperbarui');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat memperbarui konsumen');
        }
    }

    public function deleteKonsumen($id)
    {
        try {
            $konsumen = Konsumen::findOrFail($id);
            $konsumen->delete();
            
            return redirect()->route('konsumen')
                ->with('success', 'Konsumen berhasil dihapus');
                
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat menghapus konsumen');
        }
    }
}
