<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Datang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #1e88e5 0%, #ffffff 50%, #eceff1 100%);
            min-height: 100vh;
        }
        .welcome-container {
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .welcome-content {
            text-align: center;
            padding: 3rem;
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 15px;
            box-shadow: 0 8px 32px rgba(30, 136, 229, 0.2);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.18);
            max-width: 500px;
            width: 90%;
        }
        h1 {
            color: #1565c0;
            font-weight: 600;
            margin-bottom: 1.5rem;
        }
        p {
            color: #546e7a;
            font-size: 1.1rem;
        }
        .btn {
            padding: 12px 24px;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
        }
        .btn-primary {
            background-color: #1e88e5;
            border-color: #1e88e5;
        }
        .btn-primary:hover {
            background-color: #1565c0;
            border-color: #1565c0;
            transform: translateY(-2px);
        }
        .btn-success {
            background-color: #2196f3;
            border-color: #2196f3;
        }
        .btn-success:hover {
            background-color: #1976d2;
            border-color: #1976d2;
            transform: translateY(-2px);
        }
        .btn-danger {
            background-color: #e53935;
            border-color: #e53935;
        }
        .btn-danger:hover {
            background-color: #d32f2f;
            border-color: #d32f2f;
            transform: translateY(-2px);
        }
        .logo-container {
            margin-bottom: 2rem;
        }
        .logo-image {
            max-width: 150px;
            height: auto;
            margin-bottom: 1.5rem;
        }
    </style>
</head>
<body>
    <div class="welcome-container">
        <div class="welcome-content">
            <div class="logo-container">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="logo-image">
            </div>
            <h1 class="mb-4">Selamat Datang di Aplikasi Kami</h1>
            <p class="mb-4">Silakan pilih opsi di bawah ini untuk melanjutkan:</p>
            <div class="d-grid gap-3">
                @auth
                    <a href="{{ route('dashboard') }}" class="btn btn-primary">Dashboard</a>
                    <a href="{{ route('posts.index') }}" class="btn btn-success">Lihat Postingan</a>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-danger w-100">Keluar</button>
                    </form>
                @else
                    <a href="{{ route('login.form') }}" class="btn btn-primary">Masuk</a>
                    <a href="{{ route('register.form') }}" class="btn btn-success">Daftar</a>
                @endauth
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
