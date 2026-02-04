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
        html { scroll-behavior: smooth; }
    </style>
</head>
<body class="bg-slate-50 min-h-screen flex">

<aside class="w-64 bg-white border-r border-slate-200 min-h-screen sticky top-0 hidden md:flex flex-col">
    <div class="p-6 border-b border-slate-100">
        <div class="flex items-center gap-3">
            <div class="bg-blue-600 p-2 rounded-lg text-white font-bold">DB</div>
            <div class="flex flex-col">
                <span class="font-bold text-slate-800 leading-none">Portal Magang</span>
                <span class="text-[10px] text-slate-400 font-bold uppercase tracking-tighter italic">Diskominfo Binjai</span>
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
        
        @php $statusObj = strtolower(trim($pendaftar->status)); @endphp
        
        @if($statusObj == 'diterima')
        <a href="#form-laporan" class="flex items-center gap-3 px-6 py-4 text-sm font-bold text-slate-500 hover:bg-slate-50 transition">
            <span>📝</span> Laporan Harian
        </a>
        @endif
        
        <a href="#" class="flex items-center gap-3 px-6 py-4 text-sm font-bold text-slate-500 hover:bg-slate-50 transition">
            <span>📂</span> Berkas Magang
        </a>
    </nav>

    <div class="p-6 border-t border-slate-100">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="w-full flex items-center justify-center gap-2 bg-red-50 text-red-600 py-3 rounded-xl text-xs font-black hover:bg-red-100 transition">
                🚪 KELUAR SISTEM
            </button>
        </form>
    </div>
</aside>

<div class="flex-1">
    <nav class="bg-white/80 backdrop-blur-md border-b border-slate-200 px-6 py-4 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <h2 class="text-sm font-bold text-slate-700 md:block hidden">Peserta: <span class="text-blue-600">{{ Auth::user()->name }}</span></h2>
            <div class="flex items-center gap-4">
                <a href="/" class="text-xs font-extrabold text-slate-500 hover:text-blue-600 transition">BERANDA</a>
                <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center text-xs font-bold text-blue-600">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
            </div>
        </div>
    </nav>

    <main class="max-w-5xl mx-auto px-6 py-10">
        @if(session('success'))
            <div class="mb-6 p-4 bg-emerald-100 border border-emerald-200 text-emerald-700 rounded-2xl font-bold text-sm">
                {{ session('success') }}
            </div>
        @endif

        <div class="mb-10">
            <h1 class="text-3xl font-black text-slate-800 tracking-tight">Selamat Datang! 👋</h1>
            <p class="text-slate-500 text-sm mt-1">Berikut adalah ringkasan status pendaftaran magang Anda.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="md:col-span-1 space-y-6">
                <div class="bg-white p-8 rounded-3xl shadow-sm border border-slate-200 text-center">
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-6">Status Pendaftaran</p>
                    
                    @if($statusObj == 'diterima')
                        <div class="inline-flex flex-col items-center">
                            <div class="bg-emerald-100 text-emerald-600 p-4 rounded-full mb-4 text-2xl">✅</div>
                            <span class="text-emerald-600 font-black text-sm px-4 py-2 bg-emerald-50 rounded-xl border border-emerald-100 uppercase tracking-wide">Diterima</span>
                        </div>
                    @elseif($statusObj == 'ditolak')
                        <div class="inline-flex flex-col items-center">
                            <div class="bg-red-100 text-red-600 p-4 rounded-full mb-4 text-2xl">❌</div>
                            <span class="text-red-600 font-black text-sm px-4 py-2 bg-red-50 rounded-xl border border-red-100 uppercase">Ditolak</span>
                        </div>
                    @else
                        <div class="inline-flex flex-col items-center">
                            <div class="bg-amber-100 text-amber-600 p-4 rounded-full mb-4 text-2xl">⏳</div>
                            <span class="text-amber-600 font-black text-sm px-4 py-2 bg-amber-50 rounded-xl border border-amber-100 uppercase">Sedang Diproses</span>
                        </div>
                    @endif
                    
                    <p class="mt-8 text-[11px] text-slate-400 leading-relaxed italic">Mohon cek dashboard ini secara berkala.</p>
                </div>
            </div>

            <div class="md:col-span-2 space-y-8">
                @if($statusObj == 'diterima')
                <div id="form-laporan" class="bg-white rounded-3xl shadow-sm border border-blue-200 overflow-hidden">
                    <div class="bg-blue-600 px-8 py-5">
                        <h2 class="font-black text-white text-xs uppercase tracking-widest">📝 Input Laporan Harian</h2>
                    </div>
                    <form action="{{ route('laporan.simpan') }}" method="POST" class="p-8 space-y-4">
                        @csrf
                        <div class="grid grid-cols-1 gap-4">
                            <div>
                                <label class="text-[10px] font-black text-slate-400 uppercase mb-2 block">Tanggal Kegiatan</label>
                                <input type="date" name="tanggal" value="{{ date('Y-m-d') }}" required
                                    class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm font-bold text-slate-700 focus:ring-2 focus:ring-blue-500 outline-none">
                            </div>
                            <div>
                                <label class="text-[10px] font-black text-slate-400 uppercase mb-2 block">Deskripsi Kegiatan</label>
                                <textarea name="kegiatan" rows="3" required placeholder="Jelaskan aktivitas magang Anda hari ini..."
                                    class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm font-medium text-slate-700 focus:ring-2 focus:ring-blue-500 outline-none"></textarea>
                            </div>
                        </div>
                        <button type="submit" class="w-full bg-blue-600 text-white py-4 rounded-2xl font-black text-xs uppercase tracking-widest hover:bg-blue-700 transition shadow-lg shadow-blue-100">
                            KIRIM LAPORAN SEKARANG
                        </button>
                    </form>
                </div>
                @endif

                <div class="bg-white rounded-3xl shadow-sm border border-slate-200 overflow-hidden">
                    <div class="bg-slate-50 px-8 py-5 border-b border-slate-200">
                        <h2 class="font-black text-slate-700 text-xs uppercase tracking-widest">📋 Riwayat Aktivitas</h2>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead>
                                <tr class="border-b border-slate-100">
                                    <th class="px-8 py-4 text-[10px] font-black text-slate-400 uppercase">Tanggal</th>
                                    <th class="px-8 py-4 text-[10px] font-black text-slate-400 uppercase">Kegiatan</th>
                                    <th class="px-8 py-4 text-[10px] font-black text-slate-400 uppercase text-center">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-50">
                                @forelse($riwayatLaporan as $laporan)
                                <tr class="hover:bg-slate-50/50 transition">
                                    <td class="px-8 py-5 text-xs font-bold text-slate-700 whitespace-nowrap">
                                        {{ \Carbon\Carbon::parse($laporan->tanggal)->format('d/m/Y') }}
                                    </td>
                                    <td class="px-8 py-5 text-xs text-slate-600 font-medium">
                                        {{ $laporan->kegiatan }}
                                    </td>
                                    <td class="px-8 py-5 text-center">
                                        <span class="px-3 py-1 rounded-lg text-[10px] font-black uppercase {{ strtolower($laporan->status_laporan) == 'disetujui' ? 'bg-emerald-100 text-emerald-600' : 'bg-amber-100 text-amber-600' }}">
                                            {{ $laporan->status_laporan }}
                                        </span>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3" class="px-8 py-10 text-center text-slate-400 text-xs font-bold italic">
                                        Belum ada laporan harian yang diinput.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="bg-white rounded-3xl shadow-sm border border-slate-200 overflow-hidden">
                    <div class="bg-slate-50 px-8 py-5 border-b border-slate-200">
                        <h2 class="font-black text-slate-700 text-xs uppercase tracking-widest">Informasi Utama</h2>
                    </div>
                    <div class="p-8">
                        <div class="space-y-4">
                            <div class="flex justify-between items-center py-3 border-b border-slate-50">
                                <span class="text-sm text-slate-500 font-medium">Instansi/Sekolah</span>
                                <span class="text-sm font-bold text-slate-800">{{ $pendaftar->asal_sekolah }}</span>
                            </div>
                            <div class="flex justify-between items-center py-3 border-b border-slate-50">
                                <span class="text-sm text-slate-500 font-medium">Bidang Diminati</span>
                                <span class="text-sm font-bold text-blue-600">{{ $pendaftar->posisi }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>

</body>
</html>