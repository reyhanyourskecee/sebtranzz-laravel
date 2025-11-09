@extends('layout.app')

@section('content')
<div class="container mt-4">
    <h2>Detail Transaksi</h2>
    <p><strong>Tanggal:</strong> {{ $transaksi->created_at->format('d/m/Y H:i') }}</p>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama Bahan</th>
                <th>Jumlah</th>
                <th>Harga Satuan</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transaksi->items as $item)
                <tr>
                    <td>{{ $item->bahanbaku->nama }}</td>
                    <td>{{ $item->jumlah }}</td>
                    <td>Rp {{ number_format($item->bahanbaku->harga, 0, ',', '.') }}</td>
                    <td>Rp {{ number_format($item->bahanbaku->harga * $item->jumlah, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('transaksi.laporan') }}" class="btn btn-danger">Kembali</a>
</div>
@endsection
