<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Bahan Baku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f1de; }
        .navbar { background-color: #e95420; }
        .navbar a { color: white !important; }
        .btn-orange { background-color: #e95420; color: white; }
        .btn-orange:hover { background-color: #cf421a; }
    </style>
</head>
<body>

{{-- 🔸 Navbar sama kayak dashboard --}}
<nav class="navbar navbar-expand-lg px-4">
    <a class="navbar-brand text-white fw-bold" href="#">SEBTRANZ</a>
    <div class="collapse navbar-collapse">
        <ul class="navbar-nav ms-auto">
            <li class="nav-item"><a href="{{ route('dashboard') }}" class="nav-link">Dashboard</a></li>
            <li class="nav-item"><a href="{{ route('bahanbaku.index') }}" class="nav-link active">Kelola Bahan Baku</a></li>
            <li class="nav-item"><a href="#" class="nav-link">Kelola Transaksi</a></li>
            <li class="nav-item"><a href="#" class="nav-link">Laporan Transaksi</a></li>
            <li class="nav-item"><a href="#" class="nav-link">Logout</a></li>
        </ul>
    </div>
</nav>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="fw-bold">Kelola Bahan Baku</h4>
        <a href="{{ route('bahanbaku.create') }}" class="btn btn-orange">Tambah Bahan Baku</a>
    </div>

    <table class="table table-bordered">
        <thead class="table-warning text-center">
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Satuan</th>
                <th>Harga</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($bahanbakus as $i => $bahan)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $bahan->nama }}</td>
                    <td>{{ $bahan->stok }}</td>
<td>Rp{{ number_format($bahan->harga, 0, ',', '.') }}{{ $bahan->satuan_harga }}</td>


                    <td>{{ $bahan->status }}</td>
                    <td class="text-center">
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

</body>
</html>
