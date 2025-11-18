@extends('layout.app')

@section('content')
<div class="container mt-5">

    <div class="card shadow-lg border-0">
        <div class="card-header bg-orange text-white text-center py-3">
            <h3 class="mb-0">Konfirmasi Transaksi</h3>
        </div>

        <table class="table table-bordered table-striped text-center">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Nama Barang</th>
                    <th>Jumlah</th>
                    <th>Harga Satuan</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($items as $i => $item)
                    <tr>
                        <td>{{ $i+1 }}</td>
                        <td>{{ $item['nama'] }}</td>
                        <td>{{ $item['qty'] }}</td>
                        <td>Rp {{ number_format($item['harga'], 0, ',', '.') }}</td>
                        <td>Rp {{ number_format($item['qty'] * $item['harga'], 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="text-end mt-4">
            <h4><strong>Total Harga: Rp {{ number_format($totalHarga, 0, ',', '.') }}</strong></h4>
        </div>

        <div class="text-center mt-4">

            {{-- FORM POST untuk menyelesaikan transaksi --}}
           <form action="{{ route('transaksi.selesai') }}" method="POST" class="text-center mt-4">
    @csrf

    @foreach($items as $i => $item)
        <input type="hidden" name="items[{{ $i }}][id]" value="{{ $item['id'] }}">
        <input type="hidden" name="items[{{ $i }}][jumlah]" value="{{ $item['qty'] }}">
    @endforeach

    <button type="submit" class="btn btn-success btn-lg px-5 py-2" style="border-radius: 10px;">
        Selesaikan Transaksi
    </button>
</form>

        </div>
    </div>

</div>

<style>
    .bg-orange {
        background-color: #e85d04 !important;
    }
</style>

@endsection
