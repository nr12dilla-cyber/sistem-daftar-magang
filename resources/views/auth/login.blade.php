<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - Diskominfo Binjai</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Poppins:wght@600;700;800;900&display=swap" rel="stylesheet">
    <style>
        :root {
            --blue-primary: #0066cc;
            --blue-dark: #004c99;
        }

        body { 
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            min-height: 100vh;
        }

        .nav-custom {
            background: white;
            border-bottom: 1px solid #e2e8f0;
            position: sticky;
            top: 0;
            z-index: 50;
        }

        /* UKURAN CARD DIKECILKAN */
        .card-auth-compact {
            background: white;
            border-radius: 2rem; /* Radius disesuaikan */
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            border: 1px solid #e2e8f0;
            width: 100%;
            max-width: 450px; /* Batas lebar lebih kecil */
        }

        .header-gradient {
            background: linear-gradient(135deg, var(--blue-primary) 0%, var(--blue-dark) 100%);
        }

        .form-input {
            width: 100%;
            background-color: #f8fafc;
            border: 2px solid #e2e8f0;
            border-radius: 0.75rem;
            padding: 0.75rem 1rem;
            font-size: 0.9rem;
            transition: all 0.2s;
        }

        .form-input:focus {
            border-color: var(--blue-primary);
            outline: none;
            background-color: #fff;
            box-shadow: 0 0 0 4px rgba(0, 102, 204, 0.08);
        }

        .btn-main {
            background: linear-gradient(135deg, var(--blue-primary) 0%, var(--blue-dark) 100%);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .btn-main:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px -5px rgba(0, 102, 204, 0.4);
        }

        .eye-button {
            position: absolute;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            background: none;
            border: none;
            cursor: pointer;
            display: flex;
            align-items: center;
        }
    </style>
</head>
<body class="flex flex-col">

<nav class="nav-custom">
    <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
        <div class="flex items-center gap-3">
            <img src="https://tse3.mm.bing.net/th/id/OIP.lT6599E9vZtjj81vWTllEwHaIO?pid=Api&P=0&h=180" alt="Logo" class="h-10 w-auto object-contain">
            <div>
                <p class="font-black text-slate-800 leading-none text-base tracking-tight">DISKOMINFO</p>
                <p class="text-[9px] font-bold text-blue-600 tracking-[0.2em] uppercase">Kota Binjai</p>
            </div>
        </div>
        <a href="{{ url('/') }}" class="text-xs font-bold text-slate-600 hover:text-blue-600 transition-all uppercase tracking-wider">
            Beranda
        </a>
    </div>
</nav>

<main class="flex-grow flex items-center justify-center px-6 py-12">
    <div class="card-auth-compact">
        
        <div class="header-gradient p-8 text-center text-white relative overflow-hidden">
            <div class="absolute inset-0 opacity-10 pointer-events-none" style="background-image: radial-gradient(circle at 2px 2px, white 1px, transparent 0); background-size: 20px 20px;"></div>
            
            <div class="relative z-10 flex flex-col items-center">
                <div class="w-16 h-16 bg-white rounded-2xl flex items-center justify-center mb-4 shadow-xl p-3">
                    <img src="https://tse3.mm.bing.net/th/id/OIP.lT6599E9vZtjj81vWTllEwHaIO?pid=Api&P=0&h=180" alt="Logo" class="w-full h-full object-contain">
                </div>
                <h1 class="text-2xl font-black mb-1 tracking-tight" style="font-family: 'Poppins';">Login Admin</h1>
                <p class="text-blue-50 text-xs font-medium opacity-80">Masuk ke sistem pengelola magang</p>
            </div>
        </div>

        <div class="p-8 md:p-10">
            @if (session('status'))
                <div class="mb-4 font-medium text-xs text-green-600 bg-green-50 p-3 rounded-lg border border-green-100 text-center">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                <div class="space-y-1.5">
                    <label class="text-[10px] font-black text-slate-500 uppercase tracking-[0.1em] ml-1">Email Instansi</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                        class="form-input" placeholder="admin@binjaikota.go.id">
                    @error('email') <p class="text-red-500 text-[10px] mt-1 font-bold ml-1">{{ $message }}</p> @enderror
                </div>

                <div class="space-y-1.5">
                    <label class="text-[10px] font-black text-slate-500 uppercase tracking-[0.1em] ml-1">Password</label>
                    <div class="relative">
                        <input id="password" type="password" name="password" required
                            class="form-input pr-10" placeholder="••••••••">
                        <button type="button" class="eye-button" onclick="togglePassword()">
                            <i id="eye-icon" data-lucide="eye" class="w-4 h-4"></i>
                        </button>
                    </div>
                    @error('password') <p class="text-red-500 text-[10px] mt-1 font-bold ml-1">{{ $message }}</p> @enderror
                </div>

                <div class="flex items-center justify-between ml-1 pt-1">
                    <div class="flex items-center">
                        <input id="remember_me" type="checkbox" name="remember" class="w-4 h-4 text-blue-600 border-slate-300 rounded focus:ring-blue-500">
                        <label for="remember_me" class="ms-2 text-[11px] font-semibold text-slate-600">Ingat saya</label>
                    </div>
                </div>

                <div class="pt-4">
                    <button type="submit" class="btn-main w-full py-3.5 text-white font-bold rounded-xl text-base shadow-lg transition-all active:scale-[0.98]">
                        Masuk
                    </button>
                </div>
            </form>
        </div>
    </div>
</main>

<footer class="py-8 text-center">
    <p class="text-slate-400 text-[9px] font-black uppercase tracking-[0.3em]">© 2026 Diskominfo Kota Binjai</p>
</footer>

<script>
    lucide.createIcons();

    function togglePassword() {
        const passwordInput = document.getElementById('password');
        const eyeIcon = document.getElementById('eye-icon');

        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            eyeIcon.setAttribute('data-lucide', 'eye-off');
        } else {
            passwordInput.type = 'password';
            eyeIcon.setAttribute('data-lucide', 'eye');
        }
        lucide.createIcons();
    }
</script>

</body>
</html>