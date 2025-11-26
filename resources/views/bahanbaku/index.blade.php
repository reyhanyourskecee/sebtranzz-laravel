@extends('layout.app')

@section('title', 'Kelola Bahan Baku')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="fw-bold"></h4>
        <a href="{{ route('bahanbaku.create') }}" class="btn btn-orange">Tambah Bahan Baku</a>
    </div>
    
    <table class="table table-bordered align-middle">
    <thead class="table-warning text-center" style="color: white;">
        <tr>
            <th>No.</th>
            <th>Nama</th>
            <th>Stok</th>
            <th>Harga Satuan</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>

        <tbody>
            @forelse ($bahanbakus as $i => $bahan)
                <tr>
                    <td class="text-center">{{ $i + 1 }}</td>
                    <td>{{ $bahan->nama }}</td>
                    <td class="text-center">{{ $bahan->stok }}</td>
                    <td>
                        Rp{{ number_format($bahan->harga, 0, ',', '.') }}
                        {{ $bahan->satuan_harga ?? '' }}
                    </td>
                    <td class="text-center">
                        <span class="badge {{ $bahan->status == 'Tersedia' ? 'bg-success' : 'bg-danger' }}">
                            {{ $bahan->status }}
                        </span>
                    </td>
                    <td class="text-center d-flex justify-content-center gap-2">
                        <a href="{{ route('bahanbaku.edit', $bahan->id) }}" class="btn btn-warning btn-sm">Edit</a>

                        <form action="{{ route('bahanbaku.destroy', $bahan->id) }}" method="POST" onsubmit="return confirm('Hapus bahan ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">Belum ada data bahan baku</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
