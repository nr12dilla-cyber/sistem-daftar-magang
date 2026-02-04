<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Harian - Portal Magang</title>
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
            
            <a href="{{ route('dashboard.mahasiswa') }}" class="flex items-center gap-3 px-6 py-4 text-sm font-bold text-slate-500 hover:bg-slate-50 transition">
                <span>🏠</span> Dashboard
            </a>

            <a href="{{ route('laporan.index') }}" class="flex items-center gap-3 px-6 py-4 text-sm font-bold sidebar-item-active transition">
                <span>📝</span> Laporan Harian
            </a>
        </nav>
    </aside>

    <div class="flex-1">
        <nav class="bg-white/80 backdrop-blur-md border-b border-slate-200 px-8 py-4 sticky top-0 z-50 flex justify-between items-center">
            <h2 class="text-sm font-black text-slate-700 uppercase tracking-widest">📋 Laporan Magang</h2>
            <div class="flex items-center gap-4">
                <div class="text-right">
                    <p class="text-xs font-black text-slate-800 leading-none">{{ Auth::user()->name }}</p>
                    <p class="text-[10px] font-bold text-blue-600 uppercase">MAHASISWA</p>
                </div>
                <div class="w-10 h-10 bg-blue-600 rounded-2xl flex items-center justify-center text-white font-black shadow-lg shadow-blue-100">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
            </div>
        </nav>

        <main class="max-w-5xl mx-auto px-8 py-10">
            <div class="bg-white rounded-[2rem] shadow-sm border border-blue-200 overflow-hidden mb-12">
                <div class="bg-blue-600 px-8 py-5">
                    <h2 class="font-black text-white text-xs uppercase tracking-widest">Buat Laporan Baru</h2>
                </div>
                <form action="{{ route('laporan.store') }}" method="POST" class="p-8">
                    @csrf
                    <div class="mb-6">
                        <label class="text-[10px] font-black text-slate-400 uppercase mb-3 block tracking-widest">Apa kegiatanmu hari ini?</label>
                        <textarea name="kegiatan" rows="4" required placeholder="Contoh: Memperbaiki tampilan web portal magang..." 
                            class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-5 py-4 text-sm font-bold text-slate-700 focus:ring-4 focus:ring-blue-100 focus:border-blue-500 outline-none transition"></textarea>
                    </div>
                    <button type="submit" class="w-full bg-blue-600 text-white py-5 rounded-2xl font-black text-xs uppercase tracking-[0.2em] hover:bg-blue-700 transition shadow-lg shadow-blue-200">
                        🚀 KIRIM LAPORAN KEGIATAN
                    </button>
                </form>
            </div>

            <div class="bg-white rounded-[2rem] shadow-sm border border-slate-200 overflow-hidden">
                <div class="bg-slate-50 px-8 py-6 border-b border-slate-100">
                    <h2 class="font-black text-slate-700 text-xs uppercase tracking-widest">📋 Riwayat Aktivitas</h2>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="bg-slate-50/50">
                                <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest">Tanggal</th>
                                <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest">Kegiatan</th>
                                <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @foreach($laporans as $l)
                            <tr class="hover:bg-blue-50/20 transition group">
                                <td class="px-8 py-6 text-xs font-black text-slate-700 whitespace-nowrap">
                                    {{ $l->tanggal }}
                                </td>
                                <td class="px-8 py-6 text-xs text-slate-600 font-bold leading-relaxed">
                                    {{ $l->kegiatan }}
                                </td>
                                <td class="px-8 py-6 text-center">
                                    <span class="px-4 py-1.5 rounded-xl text-[10px] font-black uppercase tracking-tighter 
                                        {{ $l->status_laporan == 'Diterima' ? 'bg-emerald-100 text-emerald-600' : 'bg-amber-100 text-amber-600' }}">
                                        {{ $l->status_laporan }}
                                    </span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>

</body>
</html>