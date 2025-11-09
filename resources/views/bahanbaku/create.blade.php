<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Bahan Baku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f1de; }
        .navbar { background-color: #e95420; }
        .navbar a { color: white !important; }
        .btn-orange { background-color: #e95420; color: white; }
        .btn-orange:hover { background-color: #cf421a; }
        .card { border-radius: 15px; }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg px-4">
    <a class="navbar-brand text-white fw-bold" href="#">SEBTRANZ</a>
    <div class="collapse navbar-collapse">
        <ul class="navbar-nav ms-auto">
            <li class="nav-item"><a href="{{ route('dashboard') }}" class="nav-link">Dashboard</a></li>
            <li class="nav-item"><a href="{{ route('bahanbaku.index') }}" class="nav-link">Kelola Bahan Baku</a></li>
            <li class="nav-item"><a href="#" class="nav-link">Kelola Transaksi</a></li>
            <li class="nav-item"><a href="#" class="nav-link">Laporan Transaksi</a></li>
            <li class="nav-item"><a href="#" class="nav-link">Logout</a></li>
        </ul>
    </div>
</nav>

<div class="container mt-5">
    <div class="card p-4 shadow-sm">
        <h4 class="fw-bold mb-3">Tambah Bahan Baku</h4>
        <form action="{{ route('bahanbaku.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Nama Bahan</label>
                <input type="text" name="nama" class="form-control" required>
            </div>
            <div>
    <label for="stok">Stok</label>
    <input type="number" name="stok" id="stok" class="form-control" required>
</div>

            <div class="mb-3">
                <label class="form-label">Harga</label>
                <input type="number" name="harga" class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label">Status</label>
                <input type="text" name="status" class="form-control">
            </div>
            <div class="d-flex justify-content-between">
                <a href="{{ route('bahanbaku.index') }}" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-orange">Simpan</button>
            </div>
            <div class="form-group">
    <label for="satuan_harga">Satuan Harga (contoh: /plastik, /kg, /pcs)</label>
    <input type="text" class="form-control" id="satuan_harga" name="satuan_harga" placeholder="/pcs" required>
</div>

        </form>
    </div>
</div>

</body>
</html>
