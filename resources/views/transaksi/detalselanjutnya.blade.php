@extends('layouts.app')

@section('title', 'Detail Transaksi')

@section('content')
<div class="container mt-4">
    <h2>Detail Transaksi</h2>
    <p><strong>Tanggal & Jam:</strong> {{ $transaksi->created_at }}</p>
    <p><strong>Total Barang Dibeli:</strong> {{ $transaksi->items->sum('jumlah') }}</p>
    <p><strong>Total Harga:</strong> Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}</p>

    <hr>

    <h4>Daftar Barang</h4>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Bahan</th>
                <th>Jumlah</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transaksi->items as $i => $item)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $item->bahanbaku->nama }}</td>
                    <td>{{ $item->jumlah }}</td>
                    <td>Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('laporan.transaksi') }}" class="btn btn-danger">Kembali</a>

</div>
@endsection
