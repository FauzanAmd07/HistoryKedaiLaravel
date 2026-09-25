<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Karyawan - HistoryKedai</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        :root {
            --color-primary: #6D28D9; --color-secondary: #8B5CF6;
            --color-light: #E6E0FF; --color-white: #FFFFFF;
            --font-body: 'Poppins', sans-serif; --border-radius: 16px;
        }
        * { box-sizing: border-box; }
        body { font-family: var(--font-body); background: radial-gradient(circle, var(--color-light) 0%, var(--color-white) 70%); display: flex; justify-content: center; align-items: center; min-height: 100vh; margin: 0; }
        .back-link { position: fixed; top: 30px; left: 30px; text-decoration: none; color: var(--color-primary); font-weight: 500; display: flex; align-items: center; gap: 8px; transition: opacity 0.3s; }
        .back-link:hover { opacity: 0.7; }
        .login-card { background: var(--color-white); padding: 40px; border-radius: var(--border-radius); box-shadow: 0 10px 40px rgba(109,40,217,0.1); width: 380px; }
        .login-card h2 { font-size: 2rem; color: var(--color-primary); margin: 0 0 8px; text-align: center; }
        .login-card p { text-align: center; color: #6B7280; margin: 0 0 30px; }
        .alert { padding: 10px 15px; border-radius: 8px; margin-bottom: 20px; font-size: 0.9em; }
        .alert-danger { background: #FEE2E2; color: #991B1B; }
        .alert-success { background: #D1FAE5; color: #065F46; }
        .form-group { position: relative; margin-bottom: 20px; }
        .form-group .icon { position: absolute; left: 15px; top: 50%; transform: translateY(-50%); color: #9CA3AF; }
        .form-group input { width: 100%; padding: 13px 45px; border: 1px solid #E5E7EB; border-radius: 10px; font-family: var(--font-body); font-size: 1em; transition: border-color 0.3s; outline: none; }
        .form-group input:focus { border-color: var(--color-secondary); box-shadow: 0 0 0 3px rgba(139,92,246,0.1); }
        .toggle-pw { position: absolute; right: 15px; top: 50%; transform: translateY(-50%); color: #9CA3AF; cursor: pointer; background: none; border: none; }
        .btn-login { display: block; width: 100%; padding: 13px; background: var(--color-primary); color: white; border: none; border-radius: 50px; font-family: var(--font-body); font-size: 1.05em; font-weight: 600; cursor: pointer; transition: all 0.3s; margin-top: 10px; }
        .btn-login:hover { transform: translateY(-2px); box-shadow: 0 5px 20px rgba(109,40,217,0.3); }
    </style>
</head>
<body>
    <a href="{{ route('home') }}" class="back-link"><i class="fas fa-arrow-left"></i> Kembali ke Beranda</a>
    <div class="login-card">
        <h2>☕ Login</h2>
        <p>Masuk sebagai karyawan HistoryKedai</p>

        @if($errors->any())
            <div class="alert alert-danger"><i class="fas fa-exclamation-circle"></i> {{ $errors->first() }}</div>
        @endif
        @if(session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
        @endif

        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="form-group">
                <i class="fas fa-user icon"></i>
                <input type="text" name="username" value="{{ old('username') }}" placeholder="Username" required autofocus>
            </div>
            <div class="form-group">
                <i class="fas fa-lock icon"></i>
                <input type="password" name="password" id="passwordInput" placeholder="Password" required>
                <button type="button" class="toggle-pw" onclick="togglePw()"><i class="fas fa-eye" id="eyeIcon"></i></button>
            </div>
            <button type="submit" class="btn-login">LOGIN</button>
        </form>
    </div>
    <script>
    function togglePw() {
        const inp = document.getElementById('passwordInput');
        const icon = document.getElementById('eyeIcon');
        inp.type = inp.type === 'password' ? 'text' : 'password';
        icon.classList.toggle('fa-eye');
        icon.classList.toggle('fa-eye-slash');
    }
    </script>
</body>
</html>
