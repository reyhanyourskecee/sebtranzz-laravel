<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SEBTRANZ - Login</title>
    <style>
        body {
            background-color: #f8f1de;
            font-family: 'Poppins', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .login-container {
            background-color: white;
            padding: 50px;
            border-radius: 25px;
            box-shadow: 0px 4px 10px rgba(0,0,0,0.1);
            width: 350px;
            text-align: center;
        }
        .login-container h2 {
            margin-bottom: 30px;
            color: #333;
        }
        .login-container input {
            width: 100%;
            padding: 12px 15px;
            margin: 10px 0;
            border: none;
            background-color: #ddd;
            border-radius: 25px;
            text-align: center;
            font-size: 14px;
        }
        .login-container button {
            width: 100%;
            padding: 12px;
            background-color: #e95420;
            color: white;
            border: none;
            border-radius: 25px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
        }
        .login-container button:hover {
            background-color: #cf471b;
        }
        .logo {
            display: block;
            margin: 0 auto 20px auto;
            width: 120px;
        }
    </style>
</head>
<body>
    <div>
        <img src="/images/logo.png" alt="sebtranz logo" class="logo">
        <div class="login-container">
            <h2>LOGIN</h2>
            <form action="{{ route('login') }}" method="POST">
                @csrf
                <input type="text" name="username" placeholder="MASUKAN NAMA ANDA" required>
                <input type="password" name="password" placeholder="PASSWORD" required>
                <button type="submit">MASUK</button>
            </form>
        </div>
    </div>
</body>
</html>
