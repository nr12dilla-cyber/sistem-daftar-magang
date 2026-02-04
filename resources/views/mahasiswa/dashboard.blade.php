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
            background: #f5f7fa;
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
        }
    </style>
</head>
<body class="min-h-screen flex">

<aside class="w-64 bg-white border-r border-slate-200 min-h-screen sticky top-0 hidden md:flex flex-col shadow-sm">
    <div class="p-6 border-b border-slate-100">
        <div class="flex items-center gap-3">
            <div class="bg-gradient-to-br from-blue-900 to-blue-700 p-2.5 rounded-xl text-white font-black text-xl shadow-lg">
                M
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
        <a href="{{ route('laporan.index') }}" class="flex items-center gap-3 px-6 py-3.5 text-sm font-bold sidebar-item transition rounded-r-xl mx-2 mt-1">
            <span>📝</span> Laporan Harian
        </a>
        @endif
    </nav>

    <div class="p-6 border-t border-slate-100">
        <p class="text-[10px] text-center text-slate-400 font-bold uppercase tracking-widest">v1.0 Mahasiswa</p>
    </div>
</aside>

<div class="flex-1">
    <nav class="bg-white border-b border-slate-200 px-6 py-4 sticky top-0 z-50 shadow-sm">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <h2 class="text-sm font-bold text-slate-700 md:block hidden">
                Peserta: <span class="text-blue-900 font-black">{{ Auth::user()->name }}</span>
            </h2>
            <div class="flex items-center gap-6">
                <a href="/" class="text-xs font-bold text-slate-500 hover:text-blue-900 transition tracking-wide uppercase">Beranda</a>
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" onclick="return confirm('Apakah Anda yakin ingin keluar?')" class="flex items-center gap-2 text-xs font-bold text-red-600 hover:text-red-700 transition tracking-wide uppercase border-l pl-6 border-slate-200">
                        <span>🚪</span> LOGOUT
                    </button>
                </form>
                <div class="w-10 h-10 bg-gradient-to-br from-blue-900 to-blue-700 rounded-xl flex items-center justify-center text-white font-black shadow-lg">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
            </div>
        </div>
    </nav>

    <main class="max-w-5xl mx-auto px-6 py-10">
        <div class="mb-8">
            <h1 class="text-3xl font-black text-slate-800 tracking-tight">Dashboard Peserta</h1>
            <p class="text-slate-500 text-sm font-medium mt-2">Selamat datang di portal magang Diskominfo Binjai</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Card Info Utama -->
            <div class="md:col-span-2 bg-white p-8 rounded-2xl shadow-sm border border-slate-100 relative">
                <div class="absolute top-6 right-6">
                    @php
                        $status = strtolower($pendaftar->status ?? 'pending');
                        $color = $status == 'diterima' ? 'bg-green-100 text-green-700' : ($status == 'ditolak' ? 'bg-red-100 text-red-700' : 'bg-amber-100 text-amber-700');
                    @endphp
                    <span class="px-4 py-2 rounded-lg text-[10px] font-black uppercase tracking-wider {{ $color }}">
                        {{ $pendaftar->status ?? 'PENDING' }}
                    </span>
                </div>

                <div class="space-y-6 pr-32">
                    <div>
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-2">Nama Lengkap</p>
                        <h2 class="text-2xl font-black text-slate-800">{{ Auth::user()->name }}</h2>
                    </div>

                    <div>
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-2">Universitas / Sekolah</p>
                        <h3 class="text-xl font-bold text-blue-900">{{ $pendaftar->asal_instansi ?? 'Instansi belum terdata' }}</h3>
                    </div>

                    <div class="pt-4 border-t border-slate-100">
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-2">Email</p>
                        <p class="text-sm font-semibold text-slate-600">{{ Auth::user()->email }}</p>
                    </div>
                </div>
            </div>

            <!-- Card Profile -->
            <div class="bg-gradient-to-br from-blue-900 to-blue-700 p-8 rounded-2xl shadow-xl text-white flex flex-col items-center justify-center text-center">
                <div class="w-24 h-24 bg-white/20 rounded-2xl flex items-center justify-center text-4xl font-black mb-6 backdrop-blur-sm border-2 border-white/30">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
                <p class="text-blue-200 text-[10px] font-bold uppercase tracking-wider mb-1">Peserta Magang</p>
                <h4 class="font-bold text-lg mb-2 leading-tight">{{ Auth::user()->name }}</h4>
                <p class="text-blue-200 text-sm mb-8">{{ Auth::user()->email }}</p>
                
                @if(isset($pendaftar) && strtolower($pendaftar->status) == 'diterima')
                    <a href="{{ route('laporan.index') }}" class="w-full bg-white text-blue-900 py-3.5 rounded-xl text-xs font-bold uppercase tracking-wide hover:scale-105 transition transform shadow-lg">
                        📝 Mulai Laporan
                    </a>
                @else
                    <div class="w-full bg-white/10 text-white/60 py-3.5 rounded-xl text-xs font-bold uppercase tracking-wide border border-white/20 backdrop-blur-sm">
                        Menunggu Persetujuan
                    </div>
                @endif
            </div>
        </div>

        <!-- Info Tambahan -->
        @if(isset($pendaftar))
        <div class="mt-6 bg-white p-6 rounded-2xl shadow-sm border border-slate-100">
            <h3 class="text-sm font-bold text-slate-700 mb-4">Informasi Pendaftaran</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="p-4 bg-slate-50 rounded-xl">
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1">Nomor WhatsApp</p>
                    <p class="text-sm font-semibold text-slate-700">{{ $pendaftar->nomor_wa ?? '-' }}</p>
                </div>
                <div class="p-4 bg-slate-50 rounded-xl">
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1">Bidang Magang</p>
                    <p class="text-sm font-semibold text-slate-700">{{ $pendaftar->posisi ?? '-' }}</p>
                </div>
                <div class="p-4 bg-slate-50 rounded-xl">
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1">Jumlah Anggota</p>
                    <p class="text-sm font-semibold text-slate-700">{{ $pendaftar->jumlah_anggota ?? 1 }} Orang</p>
                </div>
            </div>
        </div>
        @endif
    </main>
</div>

</body>
</html>