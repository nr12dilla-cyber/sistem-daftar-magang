<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Mahasiswa - Diskominfo Binjai</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        body { 
            font-family: 'Inter', sans-serif; 
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
        }
        
        .sidebar-item-active { 
            background: linear-gradient(135deg, #1e5a8e 0%, #15436b 100%);
            color: white; 
            box-shadow: 0 4px 12px rgba(30, 90, 142, 0.25);
        }
        .sidebar-item {
            color: #718096;
            transition: all 0.2s;
        }
        .sidebar-item:hover {
            background: #f8f9fa;
            color: #1e5a8e;
            transform: translateX(4px);
        }
        
        /* Glass morphism effect */
        .glass-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }
        
        /* Card hover effects */
        .card-hover {
            transition: all 0.3s ease;
        }
        .card-hover:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 24px rgba(30, 90, 142, 0.12);
        }
    </style>
</head>
<body class="min-h-screen flex">

<aside class="w-64 bg-white border-r border-slate-200 min-h-screen sticky top-0 hidden md:flex flex-col shadow-sm">
    <div class="p-6 border-b border-slate-100">
        <div class="flex items-center gap-3">
            <div class="w-12 h-12 bg-white rounded-xl shadow-md flex items-center justify-center flex-shrink-0 p-2 border border-slate-200">
                <img src="{{ asset('images/logobinjai.png') }}" 
                     alt="Logo Diskominfo Binjai" 
                     class="w-full h-full object-contain"
                     onerror="this.style.display='none'; this.nextElementSibling.style.display='flex'">
                <div class="w-full h-full bg-gradient-to-br from-blue-900 to-blue-700 rounded-lg hidden items-center justify-center text-white font-black text-base">
                    D
                </div>
            </div>
            <div class="flex flex-col">
                <span class="font-black text-slate-800 leading-none tracking-tight text-lg">Portal Magang</span>
                <span class="text-[10px] text-slate-400 font-bold uppercase tracking-widest mt-1">Diskominfo Binjai</span>
            </div>
        </div>
    </div>

    <nav class="flex-1 py-6">
        <div class="px-6 mb-4">
            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Menu Utama</p>
        </div>
        <a href="{{ route('dashboard.mahasiswa') }}" class="flex items-center gap-3 px-6 py-3.5 text-sm font-bold sidebar-item-active transition rounded-r-xl mx-2">
            <span>🏠</span> Dashboard
        </a>
        
        @if(isset($pendaftar) && strtolower($pendaftar->status) == 'diterima')
        <a href="{{ route('absen.index') }}" class="flex items-center gap-3 px-6 py-3.5 text-sm font-bold sidebar-item transition rounded-r-xl mx-2 mt-1">
            <span>📅</span> Presensi / Absen
        </a>
        <a href="{{ route('laporan.index') }}" class="flex items-center gap-3 px-6 py-3.5 text-sm font-bold sidebar-item transition rounded-r-xl mx-2 mt-1">
            <span>📝</span> Laporan Harian
        </a>
        @endif
    </nav>

    <div class="p-6 border-t border-slate-100">
        <p class="text-[10px] text-center text-slate-400 font-bold uppercase tracking-widest">Diskominfo Binjai</p>
    </div>
</aside>

<div class="flex-1">
    <nav class="bg-white border-b border-slate-200 px-6 py-4 sticky top-0 z-50 shadow-sm">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <h2 class="text-sm font-bold text-slate-700 md:block hidden">
                Peserta: <span class="text-blue-900 font-black">{{ Auth::user()->name }}</span>
            </h2>
            <div class="flex items-center gap-6">
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" onclick="return confirm('Apakah Anda yakin ingin keluar?')" class="flex items-center gap-2 text-xs font-bold text-red-600 hover:text-red-700 transition tracking-wide uppercase">
                        <span>🚪</span> LOGOUT
                    </button>
                </form>
                <div class="w-10 h-10 bg-gradient-to-br from-blue-900 to-blue-700 rounded-xl flex items-center justify-center text-white font-black shadow-md">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
            </div>
        </div>
    </nav>

    <main class="max-w-6xl mx-auto px-6 py-8">
        
        @if(session('success'))
            <div class="mb-4 p-4 bg-green-100 border-l-4 border-green-500 text-green-700 text-sm font-bold rounded-r-lg">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="mb-4 p-4 bg-red-100 border-l-4 border-red-500 text-red-700 text-sm font-bold rounded-r-lg">
                {{ session('error') }}
            </div>
        @endif

        <div class="mb-8">
            <h1 class="text-3xl font-black text-slate-800 tracking-tight mb-1">Dashboard Peserta</h1>
            <p class="text-slate-500 text-sm font-medium">Selamat datang di portal magang Diskominfo Binjai</p>
        </div>

        @if(isset($pendaftar) && strtolower($pendaftar->status) == 'diterima')
        <div class="mb-6">
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 card-hover overflow-hidden relative">
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
                    <div>
                        <h3 class="text-lg font-black text-slate-800 mb-1 flex items-center gap-2">
                            <span>⏱️</span> Presensi Hari Ini
                        </h3>
                        <p class="text-slate-500 text-xs font-bold uppercase tracking-widest">{{ date('d F Y') }}</p>
                    </div>

                    <div class="flex flex-wrap gap-3">
                        @if(!$absenHariIni)
                        <form action="{{ route('absen.masuk') }}" method="POST">
                            @csrf
                            <button type="submit" class="px-6 py-3 bg-blue-600 text-white rounded-xl text-xs font-black uppercase tracking-widest hover:bg-blue-700 transition shadow-lg shadow-blue-200">
                                📌 Absen Masuk
                            </button>
                        </form>
                        @else
                        <div class="px-6 py-3 bg-slate-100 text-slate-400 rounded-xl text-xs font-black border border-slate-200">
                            ✅ Masuk: {{ $absenHariIni->jam_masuk }}
                        </div>
                        @endif

                        @if($absenHariIni && !$absenHariIni->jam_pulang)
                        <form action="{{ route('absen.pulang') }}" method="POST">
                            @csrf
                            <button type="submit" class="px-6 py-3 bg-emerald-600 text-white rounded-xl text-xs font-black uppercase tracking-widest hover:bg-emerald-700 transition shadow-lg shadow-emerald-200">
                                🏠 Absen Pulang
                            </button>
                        </form>
                        @elseif($absenHariIni && $absenHariIni->jam_pulang)
                        <div class="px-6 py-3 bg-emerald-50 text-emerald-600 rounded-xl text-xs font-black border border-emerald-100">
                            🏁 Selesai: {{ $absenHariIni->jam_pulang }}
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
            <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm border border-slate-200 p-8 card-hover relative overflow-hidden">
                <div class="absolute top-6 right-6">
                    @php
                        $status = strtolower($pendaftar->status ?? 'pending');
                        $color = $status == 'diterima' ? 'bg-green-100 text-green-700 border-green-200' : ($status == 'ditolak' ? 'bg-red-100 text-red-700 border-red-200' : 'bg-amber-100 text-amber-700 border-amber-200');
                    @endphp
                    <span class="px-4 py-2 rounded-xl text-[10px] font-black uppercase tracking-wider {{ $color }} border shadow-sm">
                        {{ $pendaftar->status ?? 'PENDING' }}
                    </span>
                </div>

                <div class="space-y-6 pr-32">
                    <div>
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-2 flex items-center gap-2">
                            <span>👤</span> Nama Lengkap
                        </p>
                        <h2 class="text-2xl font-black text-slate-800">{{ Auth::user()->name }}</h2>
                    </div>

                    <div>
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-2 flex items-center gap-2">
                            <span>🎓</span> Universitas / Sekolah
                        </p>
                        <h3 class="text-lg font-bold text-blue-900">{{ $pendaftar->asal_instansi ?? 'Instansi belum terdata' }}</h3>
                    </div>

                    <div class="pt-4 border-t border-slate-200">
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-2 flex items-center gap-2">
                            <span>✉️</span> Email
                        </p>
                        <p class="text-sm font-semibold text-slate-700">{{ Auth::user()->email }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-br from-blue-900 via-blue-800 to-blue-700 rounded-2xl shadow-lg p-8 text-white flex flex-col items-center justify-center text-center card-hover relative overflow-hidden">
                <div class="absolute -top-10 -right-10 w-32 h-32 bg-white/10 rounded-full blur-3xl"></div>
                <div class="absolute -bottom-10 -left-10 w-32 h-32 bg-white/10 rounded-full blur-3xl"></div>
                
                <div class="relative z-10 w-full">
                    <div class="w-20 h-20 bg-white/20 rounded-2xl flex items-center justify-center text-3xl font-black mb-4 backdrop-blur-sm border-2 border-white/30 shadow-lg mx-auto">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                    
                    <p class="text-blue-200 text-[10px] font-bold uppercase tracking-wider mb-2">Peserta Magang</p>
                    <h4 class="font-bold text-base mb-1 leading-tight">{{ Auth::user()->name }}</h4>
                    <p class="text-blue-200 text-xs mb-6">{{ Auth::user()->email }}</p>
                    
                    @if(isset($pendaftar) && strtolower($pendaftar->status) == 'diterima')
                        <a href="{{ route('laporan.index') }}" class="w-full bg-white text-blue-900 py-3 rounded-xl text-xs font-bold uppercase tracking-wide hover:scale-105 transition transform shadow-xl inline-block">
                            📝 Mulai Laporan
                        </a>
                    @else
                        <div class="w-full bg-white/10 text-white/70 py-3 rounded-xl text-xs font-bold uppercase tracking-wide border border-white/20 backdrop-blur-sm">
                            Menunggu Persetujuan
                        </div>
                    @endif
                </div>
            </div>
        </div>

        @if(isset($pendaftar))
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 card-hover">
            <h3 class="text-sm font-bold text-slate-800 mb-5 flex items-center gap-2">
                <span class="text-lg">📋</span> Informasi Pendaftaran
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="p-5 bg-gradient-to-br from-slate-50 to-blue-50/50 rounded-xl border border-slate-200 hover:shadow-md transition">
                    <div class="flex items-center gap-2 mb-2">
                        <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center">
                            <span class="text-base">📱</span>
                        </div>
                        <p class="text-[10px] font-bold text-slate-500 uppercase tracking-wider">Nomor WhatsApp</p>
                    </div>
                    <p class="text-sm font-bold text-slate-800">{{ $pendaftar->nomor_wa ?? '-' }}</p>
                </div>

                <div class="p-5 bg-gradient-to-br from-slate-50 to-blue-50/50 rounded-xl border border-slate-200 hover:shadow-md transition">
                    <div class="flex items-center gap-2 mb-2">
                        <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center">
                            <span class="text-base">💼</span>
                        </div>
                        <p class="text-[10px] font-bold text-slate-500 uppercase tracking-wider">Bidang Magang</p>
                    </div>
                    <p class="text-sm font-bold text-slate-800">{{ $pendaftar->posisi ?? '-' }}</p>
                </div>

                <div class="p-5 bg-gradient-to-br from-slate-50 to-blue-50/50 rounded-xl border border-slate-200 hover:shadow-md transition">
                    <div class="flex items-center gap-2 mb-2">
                        <div class="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center">
                            <span class="text-base">👥</span>
                        </div>
                        <p class="text-[10px] font-bold text-slate-500 uppercase tracking-wider">Jumlah Anggota</p>
                    </div>
                    <p class="text-sm font-bold text-slate-800">{{ $pendaftar->jumlah_anggota ?? 1 }} Orang</p>
                </div>
            </div>
        </div>
        @endif

    </main>
</div>

</body>
</html>