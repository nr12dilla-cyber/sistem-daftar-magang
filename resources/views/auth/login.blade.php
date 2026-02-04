<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Portal Magang Diskominfo Binjai</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { 
            font-family: 'Inter', sans-serif;
            height: 100vh;
            overflow: hidden;
            background-color: #ffffff;
        }
        .login-container {
            display: flex;
            height: 100vh;
            width: 100%;
            position: relative;
        }
        .home-button {
            position: absolute;
            top: 2rem;
            right: 2rem;
            z-index: 50;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.6rem 1.2rem;
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            border: 1px solid #e2e8f0;
            border-radius: 50px;
            color: #1e293b;
            font-weight: 600;
            font-size: 0.875rem;
            transition: all 0.3s ease;
            text-decoration: none;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        }
        .home-button:hover {
            background: #ffffff;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0,0,0,0.1);
            color: #0066cc;
        }
        .left-section {
            flex: 1.2;
            position: relative;
            background: #003366; 
            overflow: hidden;
        }
        .left-section::before {
            content: '';
            position: absolute;
            inset: 0;
            background-image: url('https://images.unsplash.com/photo-1497366216548-37526070297c?w=1200');
            background-size: cover;
            background-position: center;
            opacity: 0.7;
        }
        .left-section::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(0, 76, 153, 0.5) 0%, rgba(0, 31, 63, 0.7) 100%);
            z-index: 1;
        }
        .left-content {
            position: relative;
            z-index: 10;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 3rem;
            color: white;
            text-align: center;
        }
        .logo-box {
            width: 110px;
            height: 110px;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 2rem;
            box-shadow: 0 15px 35px rgba(0,0,0,0.2);
            padding: 1.2rem;
        }
        .welcome-text {
            font-family: 'Poppins', sans-serif;
            font-size: 3rem;
            font-weight: 800;
            line-height: 1.1;
            text-shadow: 0 4px 10px rgba(0,0,0,0.3);
        }
        .right-section {
            flex: 1;
            background: white;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
            z-index: 2;
            clip-path: polygon(10% 0, 100% 0, 100% 100%, 0% 100%);
        }
        .form-container {
            width: 100%;
            max-width: 380px;
            margin-left: 10%;
        }
        .form-input {
            width: 100%;
            padding: 1rem 1rem 1rem 3.2rem;
            border: 2px solid #f1f5f9;
            border-radius: 12px;
            transition: all 0.3s;
            background: #f8fafc;
            appearance: none;
        }
        .form-input:focus {
            outline: none;
            border-color: #0066cc;
            background: white;
            box-shadow: 0 0 0 4px rgba(0, 102, 204, 0.1);
        }
        .btn-login {
            width: 100%;
            padding: 1.1rem;
            background: #0066cc;
            color: white;
            border: none;
            border-radius: 12px;
            font-weight: 700;
            transition: all 0.3s;
            margin-top: 1.5rem;
        }
        .btn-login:hover {
            background: #0052a3;
            transform: translateY(-2px);
        }
        @media (max-width: 1024px) {
            .right-section { clip-path: none; }
            .form-container { margin-left: 0; }
        }
        @media (max-width: 768px) {
            .login-container { flex-direction: column; }
            .left-section { flex: 0 0 35%; }
            .right-section { border-top-left-radius: 30px; margin-top: -30px; }
            .welcome-text { font-size: 2rem; }
            .home-button { top: 1rem; right: 1rem; }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <a href="/" class="home-button">
            <i data-lucide="home" style="width: 18px; height: 18px;"></i>
            <span>Beranda</span>
        </a>

        <div class="left-section">
            <div class="left-content">
                <div class="logo-box">
                    <img src="https://tse3.mm.bing.net/th/id/OIP.lT6599E9vZtjj81vWTllEwHaIO?pid=Api&P=0&h=180" alt="Logo" class="w-full h-full object-contain">
                </div>
                <h1 class="welcome-text">Selamat<br>Datang</h1>
                <p class="mt-4 text-blue-100 tracking-[0.2em] font-medium uppercase text-sm">Sistem Portal Magang</p>
                <p class="font-bold text-white text-lg mt-1">Diskominfo Kota Binjai</p>
            </div>
        </div>

        <div class="right-section">
            <div class="form-container">
                <div class="mb-10">
                    <h2 class="text-3xl font-bold text-slate-800">Masuk</h2>
                    <p class="text-slate-500 mt-2">Silakan pilih akses dan masukkan kredensial</p>
                </div>

                @if ($errors->any())
                    <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 text-red-700 text-sm rounded">
                        {{ $errors->first() }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" class="space-y-5">
                    @csrf
                    
                    <div class="relative">
                        <i data-lucide="user-cog" class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 w-5 h-5"></i>
                        <select name="role" class="form-input cursor-pointer pr-10" required>
                            <option value="" disabled selected>Pilih Login Sebagai...</option>
                            <option value="user">Peserta Magang</option>
                            <option value="admin">Administrator</option>
                        </select>
                        <i data-lucide="chevron-down" class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 w-4 h-4 pointer-events-none"></i>
                    </div>

                    <div class="relative">
                        <i data-lucide="mail" class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 w-5 h-5"></i>
                        <input type="email" name="email" value="{{ old('email') }}" class="form-input" placeholder="Alamat Email" required autofocus>
                    </div>

                    <div class="relative">
                        <i data-lucide="lock" class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 w-5 h-5"></i>
                        <input type="password" id="password" name="password" class="form-input" placeholder="Kata Sandi" required>
                        <button type="button" class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-400" onclick="togglePassword()">
                            <i id="eye-icon" data-lucide="eye" class="w-5 h-5"></i>
                        </button>
                    </div>

                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <input type="checkbox" id="remember" name="remember" class="w-4 h-4 text-blue-600 rounded">
                            <label for="remember" class="text-sm text-slate-600 font-medium cursor-pointer">Ingat saya</label>
                        </div>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-sm text-blue-600 hover:underline">Lupa sandi?</a>
                        @endif
                    </div>

                    <button type="submit" class="btn-login shadow-lg shadow-blue-200">
                        Masuk Ke Dashboard
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        lucide.createIcons();
        function togglePassword() {
            const pw = document.getElementById('password');
            const icon = document.getElementById('eye-icon');
            if (pw.type === 'password') {
                pw.type = 'text';
                icon.setAttribute('data-lucide', 'eye-off');
            } else {
                pw.type = 'password';
                icon.setAttribute('data-lucide', 'eye');
            }
            lucide.createIcons();
        }
    </script>
</body>
</html>