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
        <h4 class="fw-bold mb-3 text-center">Tambah Bahan Baku</h4>

        <form action="{{ route('bahanbaku.store') }}" method="POST">
            @csrf

            <!-- Nama -->
            <div class="mb-3">
                <label class="form-label">Nama Bahan</label>
                <input type="text" name="nama" class="form-control" required>
            </div>

            <!-- Stok -->
            <div class="mb-3">
                <label class="form-label">Stok</label>
                <input type="number" name="stok" class="form-control" required>
            </div>

            <!-- Harga -->
            <div class="mb-3">
                <label class="form-label">Harga</label>
                <input type="number" name="harga" class="form-control" required>
            </div>

            <!-- Status -->
            <div class="mb-3">
                <label class="form-label">Status</label>
                <select name="status" class="form-select" required>
                    <option value="">-- Pilih Status --</option>
                    <option value="Tersedia">Tersedia</option>
                    <option value="Habis">Habis</option>
                </select>
            </div>

            <!-- Satuan Harga -->
            <div class="mb-3">
                <label class="form-label">Satuan Harga</label>
                <select name="satuan_harga" class="form-select" required>
                    <option value="">-- Pilih Satuan --</option>
                    <option value="/plastik">/plastik</option>
                    <option value="/kg">/kg</option>
                    <option value="/pcs">/pcs</option>
                </select>
            </div>

            <!-- Tombol -->
            <div class="d-flex justify-content-between">
                <a href="{{ route('bahanbaku.index') }}" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-orange">Simpan</button>
            </div>
        </form>
    </div>
</div>

</body>
</html>
