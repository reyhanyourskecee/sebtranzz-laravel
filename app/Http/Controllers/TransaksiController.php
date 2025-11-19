<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bahanbaku;
use App\Models\Transaksi;
use App\Models\TransaksiItem;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    // ===============================
    // HALAMAN INPUT TRANSAKSI
    // ===============================
    public function index()
    {
        $bahanbakus = Bahanbaku::all();
        return view('transaksi.index', compact('bahanbakus'));
    }

    // ===============================
    // HALAMAN KONFIRMASI
    // ===============================
    public function konfirmasi(Request $request)
    {
        $items = $request->input('items', []);

        // Filter item jumlah > 0
        $items = array_filter($items, function ($item) {
            return isset($item['jumlah']) && $item['jumlah'] > 0;
        });

        // WAJIB: reindex array !!!
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

    // ===============================
    // PROSES SELESAI TRANSAKSI
    // ===============================
    public function selesai(Request $request)
    {

        $items = $request->input('items', []);

        // Filter & reindex
        $items = array_filter($items, function ($item) {
            return isset($item['jumlah']) && $item['jumlah'] > 0;
        });

        $items = array_values($items); // PENTING

        if (count($items) == 0) {
            return back()->with('error', 'Tidak ada item yang dipilih.');
        }

        try {

            DB::beginTransaction();

            // Hitung total
            $totalHarga = 0;

            foreach ($items as $item) {
                $bahan = Bahanbaku::find($item['id']);
                if ($bahan) {
                    $totalHarga += $bahan->harga * $item['jumlah'];
                }
            }

            // Simpan transaksi
            $transaksi = Transaksi::create([
                'tanggal' => now(),
                'total' => $totalHarga,
            ]);

            // Simpan item + kurangi stok
            foreach ($items as $item) {

                $bahan = Bahanbaku::find($item['id']);
                if (!$bahan)
                    continue;

                // Kurangi stok
                $bahan->stok -= $item['jumlah'];
                $bahan->stok = max($bahan->stok, 0);
                $bahan->save();

                // Simpan item transaksi
                TransaksiItem::create([
                    'transaksi_id' => $transaksi->id,
                    'bahanbaku_id' => $bahan->id,
                    'nama_barang' => $bahan->nama,      // gunakan kolom yg sudah ada
                    'harga_satuan' => $bahan->harga,     // gunakan kolom yg sudah ada
                    'jumlah' => $item['jumlah'],
                    'subtotal' => $bahan->harga * $item['jumlah'],
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

    // ===============================
    // LAPORAN TRANSAKSI
    // ===============================
    public function laporan()
    {
        $transaksis = Transaksi::with('items.bahanbaku')
            ->orderBy('id', 'DESC')
            ->get();

        return view('transaksi.laporan', compact('transaksis'));
    }

    public function filter(Request $request)
    {
        $tanggal = $request->tanggal;

        $transaksis = Transaksi::whereDate('tanggal', $tanggal)
            ->with('items.bahanbaku')
            ->get();

        return view('transaksi.laporan', compact('transaksis', 'tanggal'));
    }

    // ===============================
    // DETAIL TRANSAKSI
    // ===============================
    public function detail($id)
    {
        $transaksi = Transaksi::with('items.bahanbaku')->findOrFail($id);
        return view('transaksi.detail', compact('transaksi'));
    }
}
