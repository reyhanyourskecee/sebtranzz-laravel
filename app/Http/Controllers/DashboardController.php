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
        $totalTransaksi = Transaksi::count();

        $barangMasuk = Bahanbaku::whereDate('created_at', now()->toDateString())->count();

        $barangKeluar = DB::table('transaksi_items')
            ->whereDate('created_at', now()->toDateString())
            ->sum('jumlah');

        return view('dashboard', compact('totalTransaksi', 'barangMasuk', 'barangKeluar'));
    }
}
