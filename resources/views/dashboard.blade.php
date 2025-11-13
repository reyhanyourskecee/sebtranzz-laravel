@extends('layout.app')

@section('title', 'Dashboard')

@section('content')
<div class="container mt-4">
    <h3 class="mb-4 fw-bold">Ringkasan Hari Ini</h3>

    <div class="row g-4">
        <div class="col-md-4">
            <div class="card text-center p-4 shadow-sm">
                <h5>Total Transaksi</h5>
                <h2>{{ $totalTransaksi }}</h2>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center p-4 shadow-sm">
                <h5>Barang Masuk</h5>
                <h2>{{ $barangMasuk }}</h2>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center p-4 shadow-sm">
                <h5>Barang Keluar</h5>
                <h2>{{ $barangKeluar }}</h2>
            </div>
        </div>
    </div>
</div>
@endsection
