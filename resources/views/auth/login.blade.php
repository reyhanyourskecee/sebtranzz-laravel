<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SEBTRANZ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8f1de;
            font-family: 'Poppins', sans-serif;
        }

        /* Logo */
        .logo-container {
            text-align: center;
            margin-top: 40px; /* 🔽 ubah dari 100px jadi 40px biar lebih dekat */
            margin-bottom: 10px; /* jarak kecil ke bawah */
        }

        .logo-container img {
            width: 220px;
        }

        /* Kotak login */
        .login-box {
            background-color: white;
            border-radius: 20px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            padding: 30px;
            max-width: 350px;
            margin: 0 auto;
        }

        /* Tombol */
        .btn-login {
            background-color: #e95420;
            color: white;
            font-weight: 600;
            border: none;
            border-radius: 20px;
            width: 100%;
            padding: 10px;
            transition: background 0.3s;
        }

        .btn-login:hover {
            background-color: #cf491c;
        }

        h3 {
            text-align: center;
            font-weight: 700;
            margin-bottom: 25px;
        }
    </style>
</head>
<body>

    <div class="logo-container">
        <img src="{{ asset('images/sebtranz.png') }}" alt="SEBTRANZ Logo">
    </div>

        <div class="login-box mt-2">
            <h3>LOGIN</h3>
            <form action="{{ route('login') }}" method="POST">
                @csrf
                <input type="text" name="username" class="form-control mb-3 rounded-pill text-center" placeholder="Username">
            <input type="password" name="password" class="form-control mb-3 rounded-pill text-center" placeholder="Password">
            <button type="submit" class="btn-login">MASUK</button>
            @if(session('error'))
    <div class="alert alert-danger text-center">
        {{ session('error') }}
    </div>
@endif

        </form>
        </div>
    </div>
</body>
</html>
