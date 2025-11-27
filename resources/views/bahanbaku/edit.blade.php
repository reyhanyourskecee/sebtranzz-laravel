@extends('layout.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4 text-center">Edit Data Bahan Baku</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <form action="{{ route('bahanbaku.update', $bahanbaku->id) }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nama" class="form-label">Nama Bahan Baku</label>
            <input type="text" name="nama" id="nama" class="form-control" value="{{ $bahanbaku->nama }}" required>
        </div>

        <div class="mb-3">
            <label for="stok" class="form-label">Stok</label>
            <input type="number" name="stok" id="stok" class="form-control" value="{{ $bahanbaku->stok }}" required>
        </div>

        <div class="mb-3">
            <label for="harga" class="form-label">Harga</label>
            <input type="number" name="harga" id="harga" class="form-control" value="{{ $bahanbaku->harga }}" required>
        </div>

        <div class="mb-3">
            <label for="satuan_harga" class="form-label">Satuan Harga</label>
            <select name="satuan_harga" id="satuan_harga" class="form-select" required>
                <option value="/pcs" {{ $bahanbaku->satuan_harga == '/pcs' ? 'selected' : '' }}>/pcs</option>
                <option value="/kg" {{ $bahanbaku->satuan_harga == '/kg' ? 'selected' : '' }}>/kg</option>
                <option value="/plastik" {{ $bahanbaku->satuan_harga == '/plastik' ? 'selected' : '' }}>/plastik</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" id="status" class="form-select" required>
                <option value="Tersedia" {{ $bahanbaku->status == 'Tersedia' ? 'selected' : '' }}>Tersedia</option>
                <option value="Habis" {{ $bahanbaku->status == 'Habis' ? 'selected' : '' }}>Habis</option>
            </select>
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('bahanbaku.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </form>
</div>
@endsection
