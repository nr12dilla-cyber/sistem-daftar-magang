<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Admin - Diskominfo Binjai</title>
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

        /* Style tambahan untuk tombol mata */
        .eye-button {
            position: absolute;
            right: 1.25rem;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            transition: color 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .eye-button:hover {
            color: var(--blue-primary);
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
        <a href="{{ route('login') }}" class="group flex items-center gap-2 text-sm font-bold text-slate-600 hover:text-blue-600 transition-all">
            <div class="p-2 bg-slate-50 group-hover:bg-blue-50 rounded-full transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 15l-3-3m0 0l3-3m-3 3h8M3 12a9 9 0 1118 0 9 9 0 01-18 0z"></path>
                </svg>
            </div>
            Kembali ke Login
        </a>
    </div>
</nav>

<main class="flex-grow flex items-center justify-center px-6 py-20">
    <div class="max-w-4xl w-full card-auth-xl">
        
        <div class="header-gradient p-12 md:p-16 text-center text-white relative overflow-hidden">
            <div class="absolute inset-0 opacity-10 pointer-events-none" style="background-image: radial-gradient(circle at 2px 2px, white 1px, transparent 0); background-size: 30px 30px;"></div>
            
            <div class="relative z-10 flex flex-col items-center">
                <div class="w-24 h-24 bg-white rounded-[2rem] flex items-center justify-center mb-6 shadow-2xl border border-white/20 p-4">
                    <img src="https://tse3.mm.bing.net/th/id/OIP.lT6599E9vZtjj81vWTllEwHaIO?pid=Api&P=0&h=180" alt="Logo" class="w-full h-full object-contain">
                </div>
                <h1 class="text-4xl font-black mb-3 tracking-tight" style="font-family: 'Poppins';">Pendaftaran Admin Baru</h1>
                <p class="text-blue-50 text-base font-medium opacity-90 max-w-xl">Silahkan isi formulir di bawah untuk membuat akun administrator sistem informasi magang.</p>
            </div>
        </div>

        <div class="p-12 md:p-20">
            <form method="POST" action="{{ route('register') }}" class="space-y-8">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="space-y-2">
                        <label class="text-[12px] font-black text-slate-500 uppercase tracking-[0.1em] ml-1">Nama Lengkap</label>
                        <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus
                            class="form-input" placeholder="Masukkan nama lengkap admin">
                        @error('name') <p class="text-red-500 text-xs mt-2 font-bold flex items-center gap-1"><span class="w-1 h-1 bg-red-500 rounded-full"></span> {{ $message }}</p> @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="text-[12px] font-black text-slate-500 uppercase tracking-[0.1em] ml-1">Email Instansi</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required
                            class="form-input" placeholder="admin@binjaikota.go.id">
                        @error('email') <p class="text-red-500 text-xs mt-2 font-bold flex items-center gap-1"><span class="w-1 h-1 bg-red-500 rounded-full"></span> {{ $message }}</p> @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="text-[12px] font-black text-slate-500 uppercase tracking-[0.1em] ml-1">Password</label>
                        <div class="relative">
                            <input id="password" type="password" name="password" required
                                class="form-input pr-12" placeholder="Buat password kuat">
                            <button type="button" class="eye-button" onclick="togglePassword('password', 'eye-icon-password')">
                                <i id="eye-icon-password" data-lucide="eye" class="w-5 h-5"></i>
                            </button>
                        </div>
                        @error('password') <p class="text-red-500 text-xs mt-2 font-bold flex items-center gap-1"><span class="w-1 h-1 bg-red-500 rounded-full"></span> {{ $message }}</p> @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="text-[12px] font-black text-slate-500 uppercase tracking-[0.1em] ml-1">Konfirmasi Password</label>
                        <div class="relative">
                            <input id="password_confirmation" type="password" name="password_confirmation" required
                                class="form-input pr-12" placeholder="Ulangi password">
                            <button type="button" class="eye-button" onclick="togglePassword('password_confirmation', 'eye-icon-confirm')">
                                <i id="eye-icon-confirm" data-lucide="eye" class="w-5 h-5"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="pt-6">
                    <button type="submit" class="btn-main w-full py-5 text-white font-black rounded-2xl text-xl shadow-2xl transition-all active:scale-[0.98]">
                        Daftar Akun Admin
                    </button>
                    <p class="text-center text-slate-400 text-xs mt-4 italic font-medium">Pastikan data yang Anda masukkan sudah benar sebelum menekan tombol daftar.</p>
                </div>

                <div class="text-center mt-12 pt-10 border-t border-slate-100">
                    <p class="text-slate-500 font-semibold mb-2">Sudah memiliki akses ke dashboard?</p>
                    <a href="{{ route('login') }}" class="text-blue-600 font-black hover:text-blue-800 transition-colors text-lg inline-flex items-center gap-2">
                        Masuk Sekarang
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

<script>
    // Inisialisasi ikon Lucide
    lucide.createIcons();

    function togglePassword(inputId, iconId) {
        const input = document.getElementById(inputId);
        const icon = document.getElementById(iconId);
        
        if (input.type === "password") {
            input.type = "text";
            icon.setAttribute("data-lucide", "eye-off");
        } else {
            input.type = "password";
            icon.setAttribute("data-lucide", "eye");
        }
        
        // Render ulang ikon setelah perubahan atribut
        lucide.createIcons();
    }
</script>

</body>
</html>