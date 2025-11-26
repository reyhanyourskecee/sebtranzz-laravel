
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SEBTRANZ - @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color:   #f0e2d0;
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
            background-color: rgba(0, 0, 0, 0.2);
            border-radius: 10px;
        }
        table th {
            background-color: #b4461b  !important;    
            color: white;
        }
        .btn-next {
            background-color: #096e04ff;
            color: white;
            padding: 8px 20px;
            border-radius: 20px;
            border: none;
        }
        .btn-orange {
    background-color: #16801dff;
    color: white;
    border: none;
    border-radius: 10px;
    padding: 8px 20px;
    font-weight: 500;
    transition: 0.3s;
}
.btn-orange:hover {
    background-color: #8b948cff;
    color: white;
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
            <li class="nav-item"><a class="nav-link text-white" href="{{ route('bahanbaku.index') }}">Bahan Baku</a></li>
            <li class="nav-item"><a class="nav-link text-white" href="{{ route('transaksi.index') }}">Transaksi</a></li>
            <li class="nav-item"><a class="nav-link text-white" href="{{ route('laporan.transaksi') }}">Laporan</a></li>
            <li class="nav-item">
    <a class="nav-link text-white" href="#"
       onclick="event.preventDefault(); if(confirm('Yakin ingin logout?')) document.getElementById('logout-form').submit();">
       Keluar
    </a>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
</li>

        </ul>
    </div>
</nav>

<div class="container mt-4">
    @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
