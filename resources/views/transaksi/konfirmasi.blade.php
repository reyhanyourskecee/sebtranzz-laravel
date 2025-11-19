@extends('layout.app')

@section('content')

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

    <div class="container mt-5">

        <div class="card shadow-lg border-0">

            {{-- Header --}}
            <div class="card-header bg-orange text-white text-center py-3">
                <h3 class="mb-0">Konfirmasi Transaksi</h3>
            </div>

            {{-- Table --}}
            <table class="table table-bordered table-striped align-middle">
                <thead class="table-dark text-center">
                    <tr>
                        <th style="width: 60px;">No</th>
                        <th class="text-start">Nama Barang</th>
                        <th style="width: 120px;">Jumlah</th>
                        <th style="width: 180px;">Harga Satuan</th>
                        <th style="width: 180px;">Subtotal</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($items as $i => $item)
                        @if($item['jumlah'] > 0)
                            <tr>
                                <td class="text-center">{{ $i + 1 }}</td>
                                <td class="text-start">{{ $item['nama'] }}</td>
                                <td class="text-center">{{ $item['jumlah'] }}</td>
                                <td class="text-end">Rp {{ number_format($item['harga'], 0, ',', '.') }}</td>
                                <td class="text-end fw-bold">
                                    Rp {{ number_format($item['jumlah'] * $item['harga'], 0, ',', '.') }}
                                </td>
                            </tr>
                        @endif
                    @endforeach

                </tbody>
            </table>

            {{-- Total Harga --}}
            <div class="text-end pe-4 mb-4">
                <h4 class="fw-bold mb-0">
                    Total Harga:
                    <span class="text-success">
                        Rp {{ number_format($totalHarga, 0, ',', '.') }}
                    </span>
                </h4>
            </div>

            {{-- Submit Form --}}
            <div class="text-center pb-4">

                <form action="{{ route('transaksi.selesai') }}" method="POST">
                    @csrf

                    @foreach($items as $i => $item)
                        <input type="hidden" name="items[{{ $i }}][id]" value="{{ $item['id'] }}">
                        <input type="hidden" name="items[{{ $i }}][jumlah]" value="{{ $item['jumlah'] }}">

                    @endforeach

                    <button type="submit" class="btn btn-success">Selesaikan Transaksi</button>
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