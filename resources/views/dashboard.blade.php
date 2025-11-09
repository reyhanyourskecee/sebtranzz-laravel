<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SEBTRANZ - Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f1de;
            font-family: 'Poppins', sans-serif;
        }
        .navbar {
            background-color: #e95420;
        }
        .navbar a.nav-link {
            color: white !important;
            font-weight: 500;
        }
        .navbar a.nav-link.active {
            background-color: rgba(0,0,0,0.2);
            border-radius: 10px;
        }
        .card {
            border-radius: 20px;
            box-shadow: 0px 4px 8px rgba(0,0,0,0.1);
        }
        .summary {
            margin-top: 60px;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand text-white fw-bold" href="#">SEBTRANZ</a>
            <button class="navbar-toggler text-white" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon text-white"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link active" href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('bahanbaku.index') }}">Kelola Bahan Baku</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('transaksi.index') }}">Kelola Transaksi</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Laporan Transaksi</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Ringkasan -->
    <div class="container summary">
        <h3 class="mb-4">Ringkasan hari ini</h3>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card text-center p-4">
                    <h5>Total Transaksi</h5>
                    <h2>{{ $totalTransaksi }}</h2>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-center p-4">
                    <h5>Barang Masuk</h5>
                    <h2>{{ $barangMasuk }}</h2>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-center p-4">
                    <h5>Barang Keluar</h5>
                    <h2>{{ $barangKeluar }}</h2>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
