<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BahanBakuController extends Controller
{
    // ======================
    // 🔸 TAMPILKAN DATA
    // ======================
    public function index()
    {
        // Ambil semua data bahan baku
        $bahanbakus = DB::table('bahanbakus')->get();

        // Update status berdasarkan stok
        foreach ($bahanbakus as $bahan) {
            $status = $bahan->stok <= 0 ? 'Habis' : 'Tersedia';
            DB::table('bahanbakus')
                ->where('id', $bahan->id)
                ->update(['status' => $status]);
        }

        // Ambil ulang setelah update status
        $bahanbakus = DB::table('bahanbakus')->get();

        return view('bahanbaku.index', compact('bahanbakus'));
    }

    // ======================
    // 🔸 FORM TAMBAH DATA
    // ======================
    public function create()
    {
        return view('bahanbaku.create');
    }

    // ======================
    // 🔸 SIMPAN DATA BARU
    // ======================
    public function store(Request $request)
    {
        // Cek apakah bahan sudah ada
        $existing = DB::table('bahanbakus')->where('nama', $request->nama)->first();

        if ($existing) {
            // Jika sudah ada, update stok
            $newStok = $existing->stok + $request->stok;

            DB::table('bahanbakus')->where('id', $existing->id)->update([
                'stok' => $newStok,
                'harga' => $request->harga,
                'status' => $request->status,
                'satuan_harga' => $request->satuan_harga,
                'updated_at' => now(),
            ]);
        } else {
            // Jika belum ada, insert baru
            DB::table('bahanbakus')->insert([
                'nama' => $request->nama,
                'stok' => $request->stok,
                'harga' => $request->harga,
                'status' => $request->status,
                'satuan_harga' => $request->satuan_harga,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        return redirect()->route('bahanbaku.index')->with('success', 'Data berhasil disimpan!');
    }

    // ======================
    // 🔸 FORM EDIT
    // ======================
    public function edit($id)
    {
        $bahanbaku = DB::table('bahanbakus')->where('id', $id)->first();
        return view('bahanbaku.edit', compact('bahanbaku'));
    }

    // ======================
    // 🔸 UPDATE DATA
    // ======================
    public function update(Request $request, $id)
    {
        DB::table('bahanbakus')->where('id', $id)->update([
            'nama' => $request->nama,
            'stok' => $request->stok,
            'harga' => $request->harga,
            'status' => $request->status,
            'satuan_harga' => $request->satuan_harga,
            'updated_at' => now(),
        ]);

        return redirect()->route('bahanbaku.index')->with('success', 'Data bahan baku berhasil diperbarui!');
    }

    // ======================
    // 🔸 HAPUS DATA
    // ======================
    public function destroy($id)
    {
        DB::table('bahanbakus')->where('id', $id)->delete();
        return redirect()->route('bahanbaku.index')->with('success', 'Data berhasil dihapus!');
    }
}
