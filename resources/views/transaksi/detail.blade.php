
@extends('layout.app') {{-- ganti jadi layout.main biar pakai tema oranye --}}

@section('title', 'Detail Transaksi')

@section('content')
<div class="container mt-4">
    <h2 class="fw-bold text-dark">Detail Transaksi</h2>

    <p><strong>Tanggal:</strong> 
        {{ $transaksi->created_at ? $transaksi->created_at->format('d/m/Y H:i') : '-' }}
    </p>

    <table class="table table-bordered mt-3">
        <thead style="background-color: #e95420; color: white;">
            <tr>
                <th>No</th>
                <th>Nama Bahan</th>
                <th>Jumlah</th>
                <th>Harga Satuan</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @php $total = 0; @endphp
            @foreach ($transaksi->items as $i => $item)
                @php 
                    $subtotal = $item->bahanbaku->harga * $item->jumlah; 
                    $total += $subtotal; 
                @endphp
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $item->bahanbaku->nama }}</td>
                    <td>{{ $item->jumlah }}</td>
                    <td>Rp {{ number_format($item->bahanbaku->harga, 0, ',', '.') }}</td>
                    <td>Rp {{ number_format($subtotal, 0, ',', '.') }}</td>
                </tr>
            @endforeach
            <tr class="table-light">
                <td colspan="4" class="text-end"><strong>Total</strong></td>
                <td><strong>Rp {{ number_format($total, 0, ',', '.') }}</strong></td>
            </tr>
        </tbody>
    </table>

    <a href="{{ route('laporan.transaksi') }}" 
       class="btn text-white fw-semibold" 
       style="background-color: #e95420; border-radius: 20px; padding: 8px 25px;">
       Kembali
    </a>
</div>
@endsection
