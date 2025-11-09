<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bahanbaku;
use App\Models\Transaksi;
use App\Models\TransaksiItem;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    public function index()
    {
        // Ambil semua bahan baku dari tabel 'bahanbakus'
        $bahanbakus = DB::table('bahanbakus')->get();

        // Kirim ke view
        return view('transaksi.index', compact('bahanbakus'));
    }
    public function konfirmasi(Request $request)

    {
        $items = $request->input('items', []);

        // Hitung total harga
        $totalHarga = 0;
        foreach ($items as $item) {
            $bahan = Bahanbaku::find($item['id']);
            if ($bahan) {
                $totalHarga += $bahan->harga * $item['jumlah'];
            }
        }

        return view('transaksi.konfirmasi', compact('items', 'totalHarga'));

    }

    public function selesai(Request $request)
{
    $items = $request->input('items', []);

    try {
        DB::beginTransaction();

        // 1️⃣ Hitung total harga semua item
        $totalHarga = 0;
        foreach ($items as $item) {
            $bahan = Bahanbaku::find($item['id']);
            if ($bahan) {
                $totalHarga += $bahan->harga * $item['jumlah'];
            }
        }

        // 2️⃣ Simpan ke tabel transaksis
        $transaksi = new Transaksi();
        $transaksi->tanggal = now();
        $transaksi->total = $totalHarga;
        $transaksi->save();

        // 3️⃣ Simpan item-item transaksi ke tabel transaksi_items
        foreach ($items as $item) {
            $bahan = Bahanbaku::find($item['id']);
            if ($bahan) {
                // Kurangi stok bahan
                $bahan->stok -= $item['jumlah'];
                if ($bahan->stok < 0) {
                    $bahan->stok = 0;
                }
                $bahan->save();

                // Simpan item transaksi
                $transaksiItem = new TransaksiItem();
                $transaksiItem->transaksi_id = $transaksi->id;
                $transaksiItem->bahanbaku_id = $bahan->id;
                $transaksiItem->jumlah = $item['jumlah'];
                $transaksiItem->subtotal = $bahan->harga * $item['jumlah'];
                $transaksiItem->save();
            }
        }

        DB::commit();

        return redirect()->route('bahanbaku.index')->with('success', 'Transaksi selesai dan tersimpan!');
    } catch (\Exception $e) {
        DB::rollBack();
        return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
    }
}


    public function laporan()
{
    $transaksis = \App\Models\Transaksi::with('items.bahanbaku')->get();
    return view('transaksi.laporan', compact('transaksis'));
}


    public function filter(Request $request)
{
    $tanggal = $request->tanggal;

    $transaksis = \App\Models\Transaksi::whereDate('created_at', $tanggal)
        ->with('items.bahanbaku')
        ->get();

    return view('transaksi.laporan', compact('transaksis', 'tanggal'));
}

    public function detail($id)
{
    $transaksi = Transaksi::with('items.bahanbaku')->findOrFail($id);
    return view('transaksi.detail', compact('transaksi'));
}

}
