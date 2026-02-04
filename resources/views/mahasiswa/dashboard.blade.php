<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Mahasiswa - Diskominfo Binjai</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .sidebar-item-active { background-color: #eff6ff; color: #2563eb; border-right: 4px solid #2563eb; }
    </style>
</head>
<body class="bg-slate-50 min-h-screen flex">

<aside class="w-64 bg-white border-r border-slate-200 min-h-screen sticky top-0 hidden md:flex flex-col">
    <div class="p-6 border-b border-slate-100">
        <div class="flex items-center gap-3">
            <div class="bg-blue-600 p-2 rounded-lg text-white font-bold text-xl shadow-lg shadow-blue-100">M</div>
            <div class="flex flex-col">
                <span class="font-black text-slate-800 leading-none tracking-tight text-lg">Portal Magang</span>
                <span class="text-[10px] text-slate-400 font-black uppercase tracking-widest italic mt-1">Diskominfo Binjai</span>
            </div>
        </div>
    </div>

    <nav class="flex-1 py-6">
        <div class="px-6 mb-4">
            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Menu Utama</p>
        </div>
        <a href="{{ route('dashboard.mahasiswa') }}" class="flex items-center gap-3 px-6 py-4 text-sm font-bold sidebar-item-active transition">
            <span>🏠</span> Dashboard
        </a>
        @if(isset($pendaftar) && strtolower($pendaftar->status) == 'diterima')
        <a href="{{ route('laporan.index') }}" class="flex items-center gap-3 px-6 py-4 text-sm font-bold text-slate-500 hover:bg-slate-50 transition">
            <span>📝</span> Laporan Harian
        </a>
        @endif
    </nav>

    <div class="p-6 border-t border-slate-100">
        <p class="text-[10px] text-center text-slate-400 font-bold uppercase tracking-widest">v1.0 Mahasiswa</p>
    </div>
</aside>

<div class="flex-1">
    <nav class="bg-white/80 backdrop-blur-md border-b border-slate-200 px-6 py-4 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <h2 class="text-sm font-bold text-slate-700 md:block hidden tracking-tight">
                Peserta: <span class="text-blue-600 font-black">{{ Auth::user()->name }}</span>
            </h2>
            <div class="flex items-center gap-6">
                <a href="/" class="text-xs font-black text-slate-500 hover:text-blue-600 transition tracking-widest uppercase">Beranda</a>
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" onclick="return confirm('Apakah Anda yakin ingin keluar?')" class="flex items-center gap-2 text-xs font-black text-red-500 hover:text-red-700 transition tracking-widest uppercase border-l pl-6 border-slate-200">
                        <span>🚪</span> LOGOUT
                    </button>
                </form>
                <div class="w-10 h-10 bg-blue-600 rounded-2xl flex items-center justify-center text-white font-black shadow-lg shadow-blue-100 ring-2 ring-white">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
            </div>
        </div>
    </nav>

    <main class="max-w-5xl mx-auto px-6 py-10">
        <div class="mb-8">
            <h1 class="text-2xl font-black text-slate-800 tracking-tight italic">Dashboard Peserta 🚀</h1>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="md:col-span-2 bg-white p-10 rounded-[2.5rem] shadow-sm border border-slate-100 relative">
                <div class="absolute top-0 right-0 p-8">
                    @php
                        $status = strtolower($pendaftar->status ?? 'pending');
                        $color = $status == 'diterima' ? 'bg-green-100 text-green-600' : ($status == 'ditolak' ? 'bg-red-100 text-red-600' : 'bg-amber-100 text-amber-600');
                    @endphp
                    <span class="px-5 py-2 rounded-full text-[10px] font-black uppercase tracking-widest {{ $color }}">
                        {{ $pendaftar->status ?? 'PENDING' }}
                    </span>
                </div>

                <div class="space-y-10">
                    <div>
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-2">Nama Lengkap</p>
                        <h2 class="text-3xl font-black text-slate-800">{{ Auth::user()->name }}</h2>
                    </div>

                    <div>
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-2">Universitas / Sekolah</p>
                        <h2 class="text-2xl font-black text-blue-600 uppercase tracking-tight">{{ $pendaftar->asal_instansi ?? 'INSTANSI BELUM TERDATA' }}</h2>
                    </div>


            <div class="bg-blue-600 p-8 rounded-[2.5rem] shadow-xl shadow-blue-100 text-white flex flex-col items-center justify-center text-center">
                <div class="w-24 h-24 bg-white/20 rounded-[2rem] flex items-center justify-center text-4xl font-black mb-6 backdrop-blur-md border border-white/20">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
                <p class="text-blue-200 text-[10px] font-black uppercase tracking-[0.2em] mb-1">Peserta Magang</p>
                <h4 class="font-black text-xl mb-8 leading-tight">{{ Auth::user()->email }}</h4>
                
                @if(isset($pendaftar) && strtolower($pendaftar->status) == 'diterima')
                    <a href="{{ route('laporan.index') }}" class="w-full bg-white text-blue-600 py-4 rounded-2xl text-xs font-black uppercase tracking-widest hover:scale-105 transition transform shadow-lg">
                        📝 Mulai Laporan
                    </a>
                @endif
            </div>
        </div>
    </main>
</div>

</body>
</html>