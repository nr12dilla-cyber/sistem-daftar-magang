<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - Diskominfo Binjai</title>
    <script src="https://cdn.tailwindcss.com"></script>
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

        .card-auth-xl {
            background: white;
            border-radius: 3rem;
            box-shadow: 0 40px 100px -20px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            border: 1px solid #e2e8f0;
        }

        .header-gradient {
            background: linear-gradient(135deg, var(--blue-primary) 0%, var(--blue-dark) 100%);
        }

        .form-input {
            width: 100%;
            background-color: #f8fafc;
            border: 2px solid #e2e8f0;
            border-radius: 1rem;
            padding: 1rem 1.25rem;
            font-size: 0.95rem;
            transition: all 0.2s;
        }

        .form-input:focus {
            border-color: var(--blue-primary);
            outline: none;
            background-color: #fff;
            box-shadow: 0 0 0 5px rgba(0, 102, 204, 0.08);
        }

        .btn-main {
            background: linear-gradient(135deg, var(--blue-primary) 0%, var(--blue-dark) 100%);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .btn-main:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 30px -5px rgba(0, 102, 204, 0.4);
        }
    </style>
</head>
<body class="flex flex-col">

<nav class="nav-custom">
    <div class="max-w-7xl mx-auto px-8 py-5 flex justify-between items-center">
        <div class="flex items-center gap-4">
            <img src="https://tse3.mm.bing.net/th/id/OIP.lT6599E9vZtjj81vWTllEwHaIO?pid=Api&P=0&h=180" alt="Logo" class="h-12 w-auto object-contain">
            <div>
                <p class="font-black text-slate-800 leading-none text-lg tracking-tight">DISKOMINFO</p>
                <p class="text-[11px] font-bold text-blue-600 tracking-[0.2em] uppercase">Kota Binjai</p>
            </div>
        </div>
        <a href="{{ url('/') }}" class="group flex items-center gap-2 text-sm font-bold text-slate-600 hover:text-blue-600 transition-all">
            Beranda
        </a>
    </div>
</nav>

<main class="flex-grow flex items-center justify-center px-6 py-20">
    <div class="max-w-4xl w-full card-auth-xl">
        
        <div class="header-gradient p-12 md:p-16 text-center text-white relative overflow-hidden">
            <div class="absolute inset-0 opacity-10 pointer-events-none" style="background-image: radial-gradient(circle at 2px 2px, white 1px, transparent 0); background-size: 30px 30px;"></div>
            
            <div class="relative z-10 flex flex-col items-center">
                <div class="w-24 h-24 bg-white rounded-[2rem] flex items-center justify-center mb-6 shadow-2xl border border-white/20 p-4">
                    <img src="{{ asset('images/logo-diskominfo.png') }}" alt="Logo" class="w-full h-full object-contain">
                </div>
                <h1 class="text-4xl font-black mb-3 tracking-tight" style="font-family: 'Poppins';">Login Admin</h1>
                <p class="text-blue-50 text-base font-medium opacity-90 max-w-xl">Selamat datang kembali! Silahkan masuk untuk mengelola sistem informasi magang.</p>
            </div>
        </div>

        <div class="p-12 md:p-20">
            @if (session('status'))
                <div class="mb-6 font-medium text-sm text-green-600 bg-green-50 p-4 rounded-xl border border-green-100">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-8">
                @csrf

                <div class="grid grid-cols-1 gap-8 max-w-md mx-auto">
                    <div class="space-y-2">
                        <label class="text-[12px] font-black text-slate-500 uppercase tracking-[0.1em] ml-1">Email Instansi</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                            class="form-input" placeholder="admin@binjaikota.go.id">
                        @error('email') <p class="text-red-500 text-xs mt-2 font-bold">{{ $message }}</p> @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="text-[12px] font-black text-slate-500 uppercase tracking-[0.1em] ml-1">Password</label>
                        <input id="password" type="password" name="password" required
                            class="form-input" placeholder="Masukkan password Anda">
                        @error('password') <p class="text-red-500 text-xs mt-2 font-bold">{{ $message }}</p> @enderror
                    </div>

                    <div class="flex items-center ml-1">
                        <input id="remember_me" type="checkbox" name="remember" class="w-5 h-5 text-blue-600 border-slate-300 rounded-lg focus:ring-blue-500">
                        <label for="remember_me" class="ms-3 text-sm font-semibold text-slate-600">Ingat perangkat ini</label>
                    </div>
                </div>

                <div class="pt-6 max-w-md mx-auto">
                    <button type="submit" class="btn-main w-full py-5 text-white font-black rounded-2xl text-xl shadow-2xl transition-all active:scale-[0.98]">
                        Masuk Sekarang
                    </button>
                </div>

                <div class="text-center mt-12 pt-10 border-t border-slate-100">
                    <p class="text-slate-500 font-semibold mb-2">Belum memiliki akun admin?</p>
                    <a href="{{ route('register') }}" class="text-blue-600 font-black hover:text-blue-800 transition-colors text-lg inline-flex items-center gap-2">
                        Daftar Akun Baru
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                        </svg>
                    </a>
                </div>
            </form>
        </div>
    </div>
</main>

<footer class="py-12 text-center">
    <div class="flex flex-col items-center gap-2">
        <p class="text-slate-400 text-[11px] font-black uppercase tracking-[0.4em]">© 2026 Diskominfo Kota Binjai</p>
        <div class="h-1 w-12 bg-blue-200 rounded-full"></div>
    </div>
</footer>

</body>
</html>