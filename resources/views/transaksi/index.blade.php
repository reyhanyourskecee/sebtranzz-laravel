@extends('layout.app')

@section('title', 'Kelola Transaksi')

@section('content')
<div class="container mt-4">

    <form action="{{ route('transaksi.konfirmasi') }}" method="POST">
        @csrf

        <table class="table table-bordered text-center" style="background-color: #fff8dc; width: 100%;">
            <thead style="background-color: #fff0c1;">
                <tr>
                    <th style="width: 5%;">No</th>
                    <th style="width: 40%;">Pilih Item</th>
                    <th style="width: 20%;">Jumlah</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bahanbakus as $index => $item)
                    <tr>
    <td>{{ $index + 0 }}</td>
    <td>{{ $item->nama }}</td>

    <td>
        <input type="number" name="items[{{ $index }}][jumlah]" value="0"
            class="form-control text-center"
            style="width: 100px; margin: auto;">

        {{-- ID --}}
        <input type="hidden" name="items[{{ $index }}][id]" value="{{ $item->id }}">

        {{-- Nama --}}
        <input type="hidden" name="items[{{ $index }}][nama]" value="{{ $item->nama }}">

        {{-- Harga --}}
        <input type="hidden" name="items[{{ $index }}][harga]" value="{{ $item->harga }}">
    </td>
</tr>
                @endforeach
            </tbody>
        </table>

        <button type="submit" class="btn btn-next mt-3">Selanjutnya</button>
    </form>
</div>
@endsection
