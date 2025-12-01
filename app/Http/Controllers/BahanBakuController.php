<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BahanBakuController extends Controller
{
    
    public function index()
    {
        $bahanbakus = DB::table('bahanbakus')->get();

        // Perbarui status otomatis
        foreach ($bahanbakus as $bahan) {
            $status = $bahan->stok <= 0 ? 'Habis' : 'Tersedia';
            DB::table('bahanbakus')
                ->where('id', $bahan->id)
                ->update(['status' => $status]);
        }

        $bahanbakus = DB::table('bahanbakus')->get();

        return view('bahanbaku.index', compact('bahanbakus'));
    }

    public function create()
    {
        return view('bahanbaku.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'stok' => 'required|integer|min:0',
            'harga' => 'required|integer|min:0',
        ]);

        $existing = DB::table('bahanbakus')->where('nama', $request->nama)->first();

        if ($existing) {
            $newStok = $existing->stok + $request->stok;

            if ($newStok < 0) {
                $newStok = 0;
            }

            DB::table('bahanbakus')->where('id', $existing->id)->update([
                'stok' => $newStok,
                'harga' => $request->harga,
                'status' => $newStok <= 0 ? 'Habis' : 'Tersedia',
                'satuan_harga' => $request->satuan_harga,
                'updated_at' => now(),
            ]);
        } else {
            DB::table('bahanbakus')->insert([
                'nama' => $request->nama,
                'stok' => $request->stok,
                'harga' => $request->harga,
                'status' => $request->stok <= 0 ? 'Habis' : 'Tersedia',
                'satuan_harga' => $request->satuan_harga,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        return redirect()->route('bahanbaku.index')->with('success', 'Data berhasil disimpan!');
    }


    public function edit($id)
    {
        $bahanbaku = DB::table('bahanbakus')->where('id', $id)->first();
        return view('bahanbaku.edit', compact('bahanbaku'));
    }

    public function update(Request $request, $id)
    {
      
        $request->validate([
            'nama' => 'required',
            'stok' => 'required|integer|min:0',
            'harga' => 'required|integer|min:0',
        ]);

        DB::table('bahanbakus')->where('id', $id)->update([
            'nama' => $request->nama,
            'stok' => $request->stok,
            'harga' => $request->harga,
            'status' => $request->stok <= 0 ? 'Habis' : 'Tersedia',
            'satuan_harga' => $request->satuan_harga,
            'updated_at' => now(),
        ]);

        return redirect()->route('bahanbaku.index')->with('success', 'Data bahan baku berhasil diperbarui!');
    }

    public function destroy($id)
    {
        DB::table('bahanbakus')->where('id', $id)->delete();
        return redirect()->route('bahanbaku.index')->with('success', 'Data berhasil dihapus!');
    }
}

