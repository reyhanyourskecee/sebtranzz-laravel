@extends('layout.main')

@section('title', 'Kelola Transaksi')

@section('content')
<div class="container mt-4">
    <h2>Kelola Transaksi</h2>

    {{-- Form untuk kirim data ke TransaksiController --}}
    <form method="POST" action="{{ route('transaksi.konfirmasi') }}">
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
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item->nama }}</td>
                        <td>
                            <input type="number" name="items[{{ $index }}][jumlah]" value="1"
                                class="form-control text-center"
                                style="width: 100px; margin: auto;">

                            {{-- Simpan ID bahanbaku --}}
                            <input type="hidden" name="items[{{ $index }}][id]" value="{{ $item->id }}">
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <button type="submit" class="btn btn-next mt-3">Selanjutnya</button>
    </form>
</div>
@endsection
