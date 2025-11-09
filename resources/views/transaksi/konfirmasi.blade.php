@extends('layout.main')

@section('title', 'Konfirmasi Transaksi')

@section('content')
<div class="container mt-4">
    <h2>Konfirmasi Transaksi</h2>

    <h4 class="mt-3">Total Harga: Rp {{ number_format($totalHarga, 0, ',', '.') }}</h4>

    <form method="POST" action="{{ route('transaksi.selesai') }}">
        @csrf
        @foreach ($items as $index => $item)
            <input type="hidden" name="items[{{ $index }}][id]" value="{{ $item['id'] }}">
            <input type="hidden" name="items[{{ $index }}][jumlah]" value="{{ $item['jumlah'] }}">
        @endforeach
        <button type="submit" class="btn btn-success mt-3">Selesai</button>
    </form>
</div>
@endsection
