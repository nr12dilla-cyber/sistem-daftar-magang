<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Magang - Diskominfo Binjai</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Poppins:wght@600;700;800;900&display=swap" rel="stylesheet">
    <style>
        :root {
            --blue-primary: #0066cc;
            --blue-dark: #004c99;
        }

        body { 
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 50%, #f0f9ff 100%);
            min-height: 100vh;
            position: relative;
            overflow-x: hidden;
        }

        /* Animated Background Gradient */
        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            opacity: 0.6;
            background: 
                radial-gradient(circle at 20% 30%, rgba(0, 102, 204, 0.15) 0%, transparent 50%),
                radial-gradient(circle at 80% 70%, rgba(255, 120, 0, 0.12) 0%, transparent 50%),
                radial-gradient(circle at 40% 80%, rgba(0, 102, 204, 0.1) 0%, transparent 50%);
            animation: gradientShift 15s ease-in-out infinite;
        }

        @keyframes gradientShift {
            0%, 100% {
                transform: translate(0, 0) scale(1);
                opacity: 0.6;
            }
            33% {
                transform: translate(30px, -30px) scale(1.1);
                opacity: 0.8;
            }
            66% {
                transform: translate(-20px, 20px) scale(0.95);
                opacity: 0.7;
            }
        }

        /* Decorative Floating Circles */
        .bg-decoration {
            position: fixed;
            border-radius: 50%;
            z-index: -1;
            pointer-events: none;
            filter: blur(80px);
        }

        .circle-1 {
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(0, 102, 204, 0.25) 0%, rgba(0, 102, 204, 0.1) 40%, transparent 70%);
            top: -250px;
            right: -150px;
            animation: float1 20s ease-in-out infinite;
        }

        .circle-2 {
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(255, 120, 0, 0.2) 0%, rgba(255, 120, 0, 0.08) 40%, transparent 70%);
            bottom: -200px;
            left: -150px;
            animation: float2 25s ease-in-out infinite;
        }

        .circle-3 {
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, rgba(0, 102, 204, 0.18) 0%, rgba(0, 102, 204, 0.06) 40%, transparent 70%);
            top: 35%;
            right: -50px;
            animation: float3 18s ease-in-out infinite;
        }

        .circle-4 {
            width: 350px;
            height: 350px;
            background: radial-gradient(circle, rgba(255, 120, 0, 0.15) 0%, rgba(255, 120, 0, 0.05) 40%, transparent 70%);
            top: 50%;
            left: -50px;
            animation: float4 22s ease-in-out infinite;
        }

        .circle-5 {
            width: 300px;
            height: 300px;
            background: radial-gradient(circle, rgba(0, 102, 204, 0.2) 0%, rgba(0, 102, 204, 0.08) 40%, transparent 70%);
            bottom: 20%;
            right: 15%;
            animation: pulse 12s ease-in-out infinite;
        }

        @keyframes float1 {
            0%, 100% { transform: translate(0, 0) scale(1) rotate(0deg); }
            25% { transform: translate(50px, -60px) scale(1.1) rotate(90deg); }
            50% { transform: translate(30px, -30px) scale(1.2) rotate(180deg); }
            75% { transform: translate(-20px, -50px) scale(1.05) rotate(270deg); }
        }

        @keyframes float2 {
            0%, 100% { transform: translate(0, 0) scale(1) rotate(0deg); }
            25% { transform: translate(-40px, 50px) scale(1.15) rotate(-90deg); }
            50% { transform: translate(-60px, 20px) scale(1.25) rotate(-180deg); }
            75% { transform: translate(-30px, 40px) scale(1.1) rotate(-270deg); }
        }

        @keyframes float3 {
            0%, 100% { transform: translate(0, 0) scale(1); }
            33% { transform: translate(-70px, 40px) scale(1.2); }
            66% { transform: translate(-40px, -30px) scale(0.95); }
        }

        @keyframes float4 {
            0%, 100% { transform: translate(0, 0) scale(1); }
            33% { transform: translate(60px, -50px) scale(1.15); }
            66% { transform: translate(30px, 20px) scale(0.9); }
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); opacity: 1; }
            25% { transform: scale(1.4); opacity: 0.6; }
            50% { transform: scale(1.2); opacity: 0.8; }
            75% { transform: scale(1.5); opacity: 0.5; }
        }

        /* Geometric Dot Pattern */
        .pattern-dots {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            opacity: 0.035;
            background-image: radial-gradient(circle, #0066cc 1.5px, transparent 1.5px);
            background-size: 35px 35px;
        }

        /* Floating Shapes */
        .floating-shape {
            position: fixed;
            z-index: -1;
            pointer-events: none;
            opacity: 0.2;
        }

        .shape-1 {
            width: 150px;
            height: 150px;
            background: linear-gradient(135deg, rgba(0, 102, 204, 0.3), rgba(0, 102, 204, 0.05));
            border-radius: 35px;
            top: 15%;
            left: 8%;
            animation: rotateFloat1 20s linear infinite;
        }

        .shape-2 {
            width: 120px;
            height: 120px;
            background: linear-gradient(135deg, rgba(255, 120, 0, 0.25), rgba(255, 120, 0, 0.05));
            border-radius: 50%;
            bottom: 25%;
            right: 10%;
            animation: rotateFloat2 25s linear infinite;
        }

        .shape-3 {
            width: 90px;
            height: 90px;
            background: linear-gradient(135deg, rgba(0, 102, 204, 0.2), rgba(0, 102, 204, 0.05));
            border-radius: 20px;
            top: 55%;
            left: 3%;
            animation: rotateFloat3 18s linear infinite;
        }

        .shape-4 {
            width: 100px;
            height: 100px;
            background: linear-gradient(135deg, rgba(255, 120, 0, 0.2), rgba(255, 120, 0, 0.05));
            border-radius: 25px;
            top: 25%;
            right: 20%;
            animation: rotateFloat4 22s linear infinite;
        }

        @keyframes rotateFloat1 {
            0% { transform: translate(0, 0) rotate(0deg) scale(1); }
            25% { transform: translate(30px, -40px) rotate(90deg) scale(1.1); }
            50% { transform: translate(50px, -20px) rotate(180deg) scale(0.9); }
            75% { transform: translate(20px, -50px) rotate(270deg) scale(1.05); }
            100% { transform: translate(0, 0) rotate(360deg) scale(1); }
        }

        @keyframes rotateFloat2 {
            0% { transform: translate(0, 0) rotate(0deg) scale(1); }
            25% { transform: translate(-35px, 30px) rotate(-90deg) scale(1.15); }
            50% { transform: translate(-50px, 10px) rotate(-180deg) scale(0.95); }
            75% { transform: translate(-25px, 40px) rotate(-270deg) scale(1.1); }
            100% { transform: translate(0, 0) rotate(-360deg) scale(1); }
        }

        @keyframes rotateFloat3 {
            0% { transform: translate(0, 0) rotate(0deg) scale(1); }
            33% { transform: translate(40px, -30px) rotate(120deg) scale(1.2); }
            66% { transform: translate(25px, 20px) rotate(240deg) scale(0.85); }
            100% { transform: translate(0, 0) rotate(360deg) scale(1); }
        }

        @keyframes rotateFloat4 {
            0% { transform: translate(0, 0) rotate(0deg) scale(1); }
            33% { transform: translate(-30px, 35px) rotate(-120deg) scale(1.15); }
            66% { transform: translate(-45px, -10px) rotate(-240deg) scale(0.9); }
            100% { transform: translate(0, 0) rotate(-360deg) scale(1); }
        }

        /* Ensure content is above background */
        nav, main, footer {
            position: relative;
            z-index: 10;
        }

        /* Navbar Style */
        .nav-custom {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(0, 102, 204, 0.1);
            position: sticky;
            top: 0;
            z-index: 50;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.03);
        }

        /* Card Style */
        .card-combined {
            background: white;
            border-radius: 2rem;
            box-shadow: 
                0 25px 50px -12px rgba(0, 102, 204, 0.15),
                0 0 0 1px rgba(0, 102, 204, 0.05);
            overflow: hidden;
            border: 1px solid rgba(226, 232, 240, 0.8);
        }

        .header-gradient {
            background: linear-gradient(135deg, var(--blue-primary) 0%, var(--blue-dark) 100%);
            position: relative;
            overflow: hidden;
        }

        .header-gradient::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: radial-gradient(circle at 2px 2px, rgba(255, 255, 255, 0.15) 1px, transparent 0);
            background-size: 24px 24px;
            opacity: 0.5;
        }

        .form-input, .form-select {
            width: 100%;
            background-color: #f8fafc;
            border: 2px solid #e2e8f0;
            border-radius: 0.75rem;
            padding: 0.75rem 1rem;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .form-input:focus, .form-select:focus {
            border-color: var(--blue-primary);
            outline: none;
            background-color: #fff;
            box-shadow: 0 0 0 3px rgba(0, 102, 204, 0.1);
        }

        .btn-main {
            background: linear-gradient(135deg, var(--blue-primary) 0%, var(--blue-dark) 100%);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .btn-main::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .btn-main:hover::before {
            left: 100%;
        }

        .btn-main:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px -3px rgba(0, 102, 204, 0.4);
        }

        /* Animated gradient border for status cards */
        .status-card {
            position: relative;
            background: white;
        }

        .status-card::before {
            content: '';
            position: absolute;
            top: -2px;
            left: -2px;
            right: -2px;
            bottom: -2px;
            background: linear-gradient(135deg, #0066cc, #ff7800, #0066cc);
            border-radius: inherit;
            z-index: -1;
            opacity: 0;
            transition: opacity 0.3s;
        }

        .status-card:hover::before {
            opacity: 0.3;
        }
    </style>
</head>
<body class="flex flex-col">

<div class="pattern-dots"></div>
<div class="bg-decoration circle-1"></div>
<div class="bg-decoration circle-2"></div>
<div class="bg-decoration circle-3"></div>
<div class="bg-decoration circle-4"></div>
<div class="bg-decoration circle-5"></div>
<div class="floating-shape shape-1"></div>
<div class="floating-shape shape-2"></div>
<div class="floating-shape shape-3"></div>
<div class="floating-shape shape-4"></div>

<nav class="nav-custom">
    <div class="max-w-6xl mx-auto px-6 py-4 flex justify-between items-center">
        <div class="flex items-center gap-3">
            <img src="https://tse3.mm.bing.net/th/id/OIP.lT6599E9vZtjj81vWTllEwHaIO?pid=Api&P=0&h=180" alt="Logo" class="h-10 w-auto object-contain">
            <div class="hidden sm:block">
                <p class="font-extrabold text-slate-800 leading-none">DISKOMINFO</p>
                <p class="text-[10px] font-bold text-blue-600 tracking-widest uppercase">Kota Binjai</p>
            </div>
        </div>
        <div class="flex items-center">
            <a href="{{ url('/') }}" class="bg-blue-50 text-blue-700 px-5 py-2.5 rounded-lg text-sm font-bold hover:bg-blue-100 transition-all hover:shadow-md">← Beranda</a>
        </div>
    </div>
</nav>

<main class="flex-grow flex items-center justify-center px-4 py-12">
    <div class="max-w-5xl w-full card-combined">
        
        <div class="header-gradient p-10 md:p-14 text-center text-white relative">
            <div class="relative z-10">
                <h1 class="text-3xl md:text-5xl font-black mb-3" style="font-family: 'Poppins'; letter-spacing: -0.5px;">Pendaftaran Magang Online</h1>
                <p class="text-blue-100 font-medium text-sm md:text-lg max-w-2xl mx-auto opacity-95">
                    Sistem Informasi Pendaftaran Magang Data Center Dinas Komunikasi dan Informatika Kota Binjai.
                </p>
            </div>
        </div>

        <div class="flex flex-col md:flex-row">
            
            <div class="md:w-1/3 bg-gradient-to-br from-slate-50 to-blue-50/30 p-8 border-b md:border-b-0 md:border-r border-slate-200/50">
                <div class="mb-8">
                    <h2 class="text-lg font-bold text-slate-800 flex items-center gap-2 mb-2">
                        <span class="flex items-center justify-center w-9 h-9 bg-gradient-to-br from-blue-500 to-blue-600 text-white rounded-xl text-sm shadow-lg">🔍</span>
                        Cek Status Seleksi
                    </h2>
                    <p class="text-xs text-slate-500 font-medium leading-relaxed">Masukkan email yang Anda gunakan saat mendaftar untuk melihat hasil.</p>
                </div>
                
                @if(session('error_cek'))
                <div class="mb-4 p-3 bg-red-50 border-l-4 border-red-500 text-red-700 text-xs font-bold rounded-r-lg">
                    {{ session('error_cek') }}
                </div>
                @endif

                <form action="{{ url()->current() }}" method="GET" class="space-y-3">
                    <input type="email" name="email_cek" required placeholder="Email Anda..." class="form-input text-sm" value="{{ request('email_cek') }}">
                    <button type="submit" class="w-full bg-gradient-to-r from-slate-800 to-slate-900 text-white py-3 rounded-xl font-bold text-sm hover:from-black hover:to-slate-900 transition-all shadow-lg hover:shadow-xl hover:-translate-y-0.5">Periksa Hasil</button>
                </form>

                @if(isset($hasilCek))
                    @php $statusResmi = strtolower($hasilCek->status); @endphp
                    <div class="mt-6 p-5 rounded-2xl border-2 status-card {{ $statusResmi == 'diterima' ? 'bg-gradient-to-br from-emerald-50 to-emerald-100/50 border-emerald-200' : ($statusResmi == 'ditolak' ? 'bg-gradient-to-br from-red-50 to-red-100/50 border-red-200' : 'bg-gradient-to-br from-orange-50 to-orange-100/50 border-orange-200') }}">
                        <p class="text-[10px] font-bold uppercase text-slate-400 mb-1 tracking-widest">Status Anda:</p>
                        <p class="text-2xl font-black {{ $statusResmi == 'diterima' ? 'text-emerald-600' : ($statusResmi == 'ditolak' ? 'text-red-600' : 'text-orange-600') }}">
                            {{ strtoupper($hasilCek->status) }}
                        </p>
                        <div class="mt-3 pt-3 border-t {{ $statusResmi == 'diterima' ? 'border-emerald-200' : ($statusResmi == 'ditolak' ? 'border-red-200' : 'border-orange-200') }}">
                            <p class="text-xs font-bold text-slate-700 leading-tight">{{ $hasilCek->nama }}</p>
                        </div>
                    </div>
                @endif
            </div>

            <div class="md:w-2/3 p-8 md:p-12 bg-white">
                <h2 class="text-xl font-bold text-slate-800 mb-8 flex items-center gap-3">
                    <span class="flex items-center justify-center w-9 h-9 bg-gradient-to-br from-blue-500 to-blue-600 text-white rounded-xl text-sm shadow-lg">📝</span>
                    Isi Formulir Pendaftaran
                </h2>

                @if(session('success'))
                <div class="mb-6 p-4 bg-emerald-50 border-l-4 border-emerald-500 text-emerald-700 rounded-r-xl flex items-center gap-3 shadow-sm">
                    <span class="text-xl">✅</span>
                    <div>
                        <p class="font-bold text-sm">Berhasil!</p>
                        <p class="text-xs opacity-90">{{ session('success') }}</p>
                    </div>
                </div>
                @endif

                @if($errors->any())
                <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 text-red-700 rounded-r-xl shadow-sm">
                    <p class="font-bold text-sm mb-1">Gagal Mengirim:</p>
                    <ul class="list-disc list-inside text-xs opacity-90">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                
                <form action="{{ route('pendaftaran.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div class="md:col-span-2">
                            <label class="text-[11px] font-extrabold text-slate-500 uppercase tracking-wider mb-2 block">Nama Lengkap</label>
                            <input type="text" name="nama" required class="form-input" placeholder="Masukkan nama lengkap Anda" value="{{ old('nama') }}">
                        </div>
                        <div>
                            <label class="text-[11px] font-extrabold text-slate-500 uppercase tracking-wider mb-2 block">Alamat Email</label>
                            <input type="email" name="email" required class="form-input" placeholder="contoh@gmail.com" value="{{ old('email') }}">
                        </div>
                        <div>
                            <label class="text-[11px] font-extrabold text-slate-500 uppercase tracking-wider mb-2 block">Nomor WhatsApp</label>
                            <input type="tel" name="telepon" required class="form-input" placeholder="08xxxxxxxxxx" value="{{ old('telepon') }}">
                        </div>
                        <div class="md:col-span-2">
                            <label class="text-[11px] font-extrabold text-slate-500 uppercase tracking-wider mb-2 block">Asal Instansi / Sekolah</label>
                            <input type="text" name="asal_sekolah" required class="form-input" placeholder="Nama Universitas atau Sekolah" value="{{ old('asal_sekolah') }}">
                        </div>
                        <div class="md:col-span-2">
                            <label class="text-[11px] font-extrabold text-slate-500 uppercase tracking-wider mb-2 block">Bidang Magang yang Dipilih</label>
                            <select name="posisi" required class="form-select">
                                <option value="">-- Pilih Salah Satu Bidang --</option>
                                <option {{ old('posisi') == 'Bidang Informasi dan Komunikasi Publik (IKP)' ? 'selected' : '' }}>Bidang Informasi dan Komunikasi Publik (IKP)</option>
                                <option {{ old('posisi') == 'Bidang Aplikasi dan Informatika (APTIKA)' ? 'selected' : '' }}>Bidang Aplikasi dan Informatika (APTIKA)</option>
                                <option {{ old('posisi') == 'Bidang Statistik dan Persandian' ? 'selected' : '' }}>Bidang Statistik dan Persandian</option>
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5 pt-2">
                        <div class="p-5 bg-gradient-to-br from-slate-50 to-blue-50/20 rounded-xl border-2 border-slate-200 hover:border-blue-300 transition-all">
                            <label class="text-[11px] font-bold text-slate-700 block mb-3 flex items-center gap-2">
                                <span class="text-lg">📷</span>
                                <span>Pas Foto</span>
                            </label>
                            <input type="file" name="foto" required class="text-xs w-full file:bg-gradient-to-r file:from-blue-600 file:to-blue-700 file:text-white file:border-0 file:px-4 file:py-2 file:rounded-lg file:mr-3 file:font-bold file:cursor-pointer hover:file:from-blue-700 hover:file:to-blue-800 file:transition-all file:shadow-md">
                        </div>
                        <div class="p-5 bg-gradient-to-br from-slate-50 to-blue-50/20 rounded-xl border-2 border-slate-200 hover:border-blue-300 transition-all">
                            <label class="text-[11px] font-bold text-slate-700 block mb-3 flex items-center gap-2">
                                <span class="text-lg">📄</span>
                                <span>Surat Pengantar (PDF)</span>
                            </label>
                            <input type="file" name="surat" required class="text-xs w-full file:bg-gradient-to-r file:from-blue-600 file:to-blue-700 file:text-white file:border-0 file:px-4 file:py-2 file:rounded-lg file:mr-3 file:font-bold file:cursor-pointer hover:file:from-blue-700 hover:file:to-blue-800 file:transition-all file:shadow-md">
                        </div>
                    </div>

                    <button type="submit" class="btn-main w-full py-4 text-white font-bold rounded-xl text-lg shadow-xl mt-6">
                        Kirim Data Pendaftaran →
                    </button>
                </form>
            </div>
        </div>
    </div>
</main>

<footer class="py-8 text-center">
    <p class="text-slate-400 text-[10px] font-bold uppercase tracking-[0.3em]">© 2026 Dinas Komunikasi dan Informatika Kota Binjai</p>
</footer>

</body>
</html>