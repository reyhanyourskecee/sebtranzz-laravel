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
        $bahanbakus = Bahanbaku::where('stok', '>', 0)->get();
        return view('transaksi.index', compact('bahanbakus'));
    }

    public function konfirmasi(Request $request)
    {
        $items = $request->input('items', []);

        $items = array_filter($items, function ($item) {
            return isset($item['jumlah']) && $item['jumlah'] > 0;
        });

        $items = array_values($items);

        $detailItems = [];
        $totalHarga = 0;

        foreach ($items as $item) {

            $bahan = Bahanbaku::find($item['id']);
            if (!$bahan)
                continue;

            $subtotal = $bahan->harga * $item['jumlah'];

            $detailItems[] = [
                'id' => $bahan->id,
                'nama' => $bahan->nama,
                'jumlah' => $item['jumlah'],
                'harga' => $bahan->harga,
                'subtotal' => $subtotal,
            ];

            $totalHarga += $subtotal;
        }

        return view('transaksi.konfirmasi', [
            'items' => $detailItems,
            'totalHarga' => $totalHarga
        ]);
    }

    public function selesai(Request $request)
    {

        $items = $request->input('items', []);

        $items = array_filter($items, function ($item) {
            return isset($item['jumlah']) && $item['jumlah'] > 0;
        });

        $items = array_values($items);

        if (count($items) == 0) {
            return back()->with('error', 'Tidak ada item yang dipilih.');
        }

        try {

            DB::beginTransaction();

            $totalHarga = 0;

            foreach ($items as $item) {
                $bahan = Bahanbaku::find($item['id']);
                if ($bahan) {
                    $totalHarga += $bahan->harga * $item['jumlah'];
                }
            }

            $transaksi = Transaksi::create([
                'tanggal' => now(),
                'total' => $totalHarga,
            ]);
            foreach ($items as $item) {

                $bahan = Bahanbaku::find($item['id']);
                if (!$bahan)
                    continue;

                $bahan->stok -= $item['jumlah'];
                $bahan->stok = max($bahan->stok, 0);
                $bahan->save();

                TransaksiItem::create([
    'transaksi_id'  => $transaksi->id,
    'bahanbaku_id'  => $bahan->id,
    'nama_barang'   => $bahan->nama,
    'harga_satuan'  => $bahan->harga,
    'jumlah'        => $item['jumlah'],
    'subtotal'      => $bahan->harga * $item['jumlah'],
]);

            }

            DB::commit();

            return redirect()
                ->route('laporan.transaksi')
                ->with('success', 'Transaksi berhasil disimpan!');

        } catch (\Exception $e) {

            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

   public function laporan()
{
    $transaksis = Transaksi::with('items')
        ->orderBy('id', 'DESC')
        ->get();

    return view('transaksi.laporan', compact('transaksis'));
}

public function filter(Request $request)
{
    $tanggal = $request->tanggal;

    $transaksis = Transaksi::whereDate('tanggal', $tanggal)
        ->with('items')
        ->get();

    return view('transaksi.laporan', compact('transaksis', 'tanggal'));
}

    public function detail($id)
    {
        $transaksi = Transaksi::with('items.bahanbaku')->findOrFail($id);
        return view('transaksi.detail', compact('transaksi'));
    }
}
