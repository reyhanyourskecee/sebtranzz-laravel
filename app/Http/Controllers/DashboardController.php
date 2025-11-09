<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bahanbaku;
use App\Models\Transaksi;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Total transaksi keluar (kelola transaksi)
        $totalTransaksi = Transaksi::count();

        // Barang masuk = jumlah bahan baku baru yang dibuat hari ini
        $barangMasuk = Bahanbaku::whereDate('created_at', now()->toDateString())->count();

        // Barang keluar = total item transaksi hari ini
        $barangKeluar = DB::table('transaksi_items')
            ->whereDate('created_at', now()->toDateString())
            ->sum('jumlah');

        return view('dashboard', compact('totalTransaksi', 'barangMasuk', 'barangKeluar'));
    }
}
