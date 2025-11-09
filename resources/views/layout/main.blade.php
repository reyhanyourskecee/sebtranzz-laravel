<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SEBTRANZ - @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8f1de;
            font-family: 'Poppins', sans-serif;
        }
        .navbar {
            background-color: #e95420;
        }
        .navbar a {
            color: white !important;
            font-weight: 500;
        }
        .navbar a.active {
            background-color: rgba(0,0,0,0.2);
            border-radius: 10px;
        }
        table th {
            background-color: #e95420 !important;
            color: white;
        }
        .btn-next {
            background-color: #e95420;
            color: white;
            padding: 8px 20px;
            border-radius: 20px;
            border: none;
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg px-3" style="background-color: #e95420;">
    <a class="navbar-brand text-white fw-bold" href="{{ route('dashboard') }}">SEBTRANZ</a>

    <div class="collapse navbar-collapse">
        <ul class="navbar-nav ms-auto">
            <li class="nav-item"><a class="nav-link text-white" href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="nav-item"><a class="nav-link text-white" href="{{ route('bahanbaku.index') }}">Kelola Bahan Baku</a></li>
            <li class="nav-item"><a class="nav-link text-white" href="{{ route('transaksi.index') }}">Kelola Transaksi</a></li>
            <li class="nav-item"><a class="nav-link text-white" href="{{ route('laporan.transaksi') }}">Laporan Transaksi</a></li>
            <li class="nav-item"><a class="nav-link text-white" href="{{ route('login') }}">Logout</a></li>
        </ul>
    </div>
</nav>

<div class="container mt-4">
    @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
