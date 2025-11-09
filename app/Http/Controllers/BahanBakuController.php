<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BahanBakuController extends Controller
{
    public function index()
{
    // Ambil semua data bahan baku
    $bahanbakus = DB::table('bahanbakus')->get();

    // Cek stok satu per satu
    foreach ($bahanbakus as $bahan) {
        $status = $bahan->stok <= 0 ? 'habis' : 'ada';
        DB::table('bahanbakus')
            ->where('id', $bahan->id)
            ->update(['status' => $status]);
    }

    // Ambil ulang setelah update
    $bahanbakus = DB::table('bahanbakus')->get();

    return view('bahanbaku.index', compact('bahanbakus'));
}


    public function create()
    {
        return view('bahanbaku.create');
    }

    public function store(Request $request)
{
    DB::table('bahanbakus')->insert([
        'nama' => $request->nama,
        'stok' => $request->stok,
        'harga' => $request->harga,
        'status' => $request->status,
        'satuan_harga' => $request->satuan_harga,
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    $existing = DB::table('bahanbakus')->where('nama', $request->nama)->first();

    if ($existing) {
        $newStok = $existing->stok + $request->stok;

        DB::table('bahanbakus')->where('id', $existing->id)->update([
            'stok' => $newStok,
            'updated_at' => now(),
        ]);
    } else {
        DB::table('bahanbakus')->insert([
            'nama' => $request->nama,
            'stok' => $request->stok,
            'harga' => $request->harga,
            'status' => $request->status,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    return redirect()->route('bahanbaku.index')->with('success', 'Data berhasil disimpan!');
} // 👈<<< ini penting, jangan lupa kurung tutupnya!


// method destroy ditulis setelah itu
public function destroy($id)
{
    DB::table('bahanbakus')->where('id', $id)->delete();
    return redirect()->route('bahanbaku.index')->with('success', 'Data berhasil dihapus!');
}
}