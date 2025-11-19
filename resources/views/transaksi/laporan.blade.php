@extends('layout.app')

@section('title', 'Laporan Transaksi')

@section('content')
<div class="container mt-4">
    <h2 class="mb-3">Laporan Transaksi</h2>

    {{-- Filter tanggal --}}
    <form action="{{ route('laporan.filter') }}" method="POST" class="mb-3">
        @csrf
        <label for="tanggal">Filter tanggal:</label>
        <input type="date" name="tanggal" id="tanggal" value="{{ $tanggal ?? '' }}" class="form-control w-25 d-inline-block">
        <button type="submit" class="btn btn-primary">Tampilkan</button>
    </form>

    {{-- Tabel laporan --}}
    <div class="mt-4">
        <h5>Tabel laporan</h5>
        <table class="table table-bordered" style="background-color: #fff8dc;">
            <thead style="background-color: #fff0c1;">
                <tr>
                    <th>No</th>
                    <th>Tanggal & Jam</th>
                    <th>Total Barang Dibeli</th>
                    <th>Total Harga</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($transaksis as $t)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ \Carbon\Carbon::parse($t->tanggal)->format('d/m/Y H:i') }}</td>
                        <td>{{ $t->items?->sum('jumlah') ?? 0 }}</td>

                        <td>Rp {{ number_format($t->total, 0, ',', '.') }}</td>
                        <td>
                            <a href="{{ route('laporan.detail', $t->id) }}" class="btn btn-sm btn-info">
                                    Selengkapnya
                             </a>

                        </td>
                    </tr>

                    {{-- Detail transaksi (collapse) --}}
<tr class="collapse" id="detail{{ $t->id }}">
    <td colspan="5">
        <table class="table table-sm table-bordered mb-0">
            <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>Nama Bahan</th>
                    <th>Jumlah</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($t->items as $i => $item)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td>{{ $item->bahanbaku->nama ?? '-' }}</td>
                        <td>{{ $item->jumlah }}</td>
                        <td>Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </td>
</tr>

                @empty
                    <tr>
                        <td colspan="5" class="text-center">Tidak ada data transaksi</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <a href="{{ url('/dashboard') }}" class="btn btn-warning mt-3">Kembali</a>
    </div>
</div>
@endsection
