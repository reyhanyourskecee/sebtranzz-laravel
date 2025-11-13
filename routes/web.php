<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BahanBakuController;
use App\Http\Controllers\TransaksiController;

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/bahanbaku', [BahanBakuController::class, 'index'])->name('bahanbaku.index');
Route::get('/bahanbaku/create', [BahanBakuController::class, 'create'])->name('bahanbaku.create');
Route::post('/bahanbaku/store', [BahanBakuController::class, 'store'])->name('bahanbaku.store');
Route::get('/bahanbaku/edit/{id}', [BahanBakuController::class, 'edit'])->name('bahanbaku.edit');
Route::post('/bahanbaku/update/{id}', [BahanBakuController::class, 'update'])->name('bahanbaku.update');
Route::delete('/bahanbaku/delete/{id}', [BahanBakuController::class, 'destroy'])->name('bahanbaku.destroy');

// TRANSAKSI
Route::get('/transaksi', [TransaksiController::class, 'index'])->name('transaksi.index');
Route::post('/transaksi/konfirmasi', [TransaksiController::class, 'konfirmasi'])->name('transaksi.konfirmasi');
Route::post('/transaksi/selesai', [TransaksiController::class, 'selesai'])->name('transaksi.selesai');

Route::get('/laporan', [TransaksiController::class, 'laporan'])->name('laporan.transaksi');
Route::post('/laporan', [TransaksiController::class, 'filter'])->name('laporan.filter');
Route::get('/laporan/{id}', [TransaksiController::class, 'detail'])->name('transaksi.detail');
Route::get('/transaksi/detail/{id}', [TransaksiController::class, 'detail'])->name('transaksi.detail');


// LAPORAN
Route::get('/laporan', [TransaksiController::class, 'laporan'])->name('laporan.transaksi');
Route::post('/laporan', [TransaksiController::class, 'filter'])->name('laporan.filter');
Route::get('/laporan/{id}', [TransaksiController::class, 'detail'])->name('laporan.detail');
