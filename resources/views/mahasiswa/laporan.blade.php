<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Harian - Portal Magang</title>
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
            
            <a href="{{ route('dashboard.mahasiswa') }}" class="flex items-center gap-3 px-6 py-3.5 text-sm font-bold sidebar-item transition rounded-r-xl mx-2">
                <span>🏠</span> Dashboard
            </a>

            <a href="{{ route('laporan.index') }}" class="flex items-center gap-3 px-6 py-3.5 text-sm font-bold sidebar-item-active transition rounded-r-xl mx-2 mt-1">
                <span>📝</span> Laporan Harian
            </a>
        </nav>

        <div class="p-6 border-t border-slate-100">
            <p class="text-[10px] text-center text-slate-400 font-bold uppercase tracking-widest">v1.0 Mahasiswa</p>
        </div>
    </aside>

    <div class="flex-1">
        <nav class="bg-white border-b border-slate-200 px-8 py-4 sticky top-0 z-50 shadow-sm flex justify-between items-center">
            <h2 class="text-sm font-bold text-slate-700 tracking-wide">📋 Laporan Magang</h2>
            <div class="flex items-center gap-4">
                <div class="text-right">
                    <p class="text-xs font-bold text-slate-800 leading-none">{{ Auth::user()->name }}</p>
                    <p class="text-[10px] font-semibold text-blue-900">{{ Auth::user()->role }}</p>
                </div>
                <div class="w-10 h-10 bg-gradient-to-br from-blue-900 to-blue-700 rounded-xl flex items-center justify-center text-white font-black shadow-lg">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
            </div>
        </nav>

        <main class="max-w-5xl mx-auto px-8 py-10">
            @if(session('success'))
                <div class="mb-8 p-4 bg-emerald-100 border-l-4 border-emerald-500 text-emerald-700 rounded-xl font-bold text-sm shadow-sm flex items-center gap-3">
                    <span>✅</span> {{ session('success') }}
                </div>
            @endif

            <div class="mb-10">
                <h1 class="text-3xl font-black text-slate-800 tracking-tight">Input Aktivitas</h1>
                <p class="text-slate-500 font-medium mt-2">Catat apa yang Anda kerjakan hari ini agar dapat divalidasi oleh pembimbing.</p>
            </div>

            <!-- Form Input Laporan -->
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden mb-12">
                <div class="bg-gradient-to-r from-blue-900 to-blue-700 px-8 py-5">
                    <h2 class="font-bold text-white text-sm tracking-wide">Buat Laporan Baru</h2>
                </div>
                <form action="{{ route('laporan.simpan') }}" method="POST" class="p-8">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                        <div class="md:col-span-1">
                            <label class="text-[10px] font-bold text-slate-500 uppercase mb-3 block tracking-wider">Tanggal Kegiatan</label>
                            <input type="date" name="tanggal" value="{{ date('Y-m-d') }}" required 
                                class="w-full bg-slate-50 border-2 border-slate-200 rounded-xl px-4 py-3 text-sm font-semibold text-slate-700 focus:ring-4 focus:ring-blue-100 focus:border-blue-900 outline-none transition">
                        </div>
                        <div class="md:col-span-3">
                            <label class="text-[10px] font-bold text-slate-500 uppercase mb-3 block tracking-wider">Deskripsi Pekerjaan</label>
                            <input type="text" name="kegiatan" required placeholder="Contoh: Maintenance database atau input data statistik..." 
                                class="w-full bg-slate-50 border-2 border-slate-200 rounded-xl px-4 py-3 text-sm font-semibold text-slate-700 focus:ring-4 focus:ring-blue-100 focus:border-blue-900 outline-none transition">
                        </div>
                    </div>
                    <button type="submit" class="w-full mt-8 bg-gradient-to-r from-blue-900 to-blue-700 text-white py-4 rounded-xl font-bold text-sm tracking-wide hover:shadow-lg hover:-translate-y-0.5 transition shadow-md active:translate-y-0">
                        🚀 KIRIM LAPORAN KEGIATAN
                    </button>
                </form>
            </div>

            <!-- Tabel Riwayat -->
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
                <div class="bg-slate-50 px-8 py-5 border-b border-slate-100 flex justify-between items-center">
                    <h2 class="font-bold text-slate-700 text-sm tracking-wide">📋 Riwayat Aktivitas Harian</h2>
                    <span class="bg-blue-100 text-blue-900 text-[10px] font-bold px-4 py-1.5 rounded-lg">{{ count($riwayatLaporan) }} Total Laporan</span>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="bg-slate-50">
                                <th class="px-8 py-4 text-[10px] font-bold text-slate-500 uppercase tracking-wider">TANGGAL</th>
                                <th class="px-8 py-4 text-[10px] font-bold text-slate-500 uppercase tracking-wider">DETAIL KEGIATAN</th>
                                <th class="px-8 py-4 text-[10px] font-bold text-slate-500 uppercase tracking-wider text-center">AKSI</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @foreach($riwayatLaporan as $laporan)
                            <tr class="hover:bg-slate-50 transition">
                                <td class="px-8 py-5 text-sm font-bold text-slate-700 whitespace-nowrap">
                                    {{ \Carbon\Carbon::parse($laporan->tanggal)->format('d/m/Y') }}
                                </td>
                                <td class="px-8 py-5 text-sm text-slate-600 font-medium leading-relaxed">
                                    {{ $laporan->kegiatan }}
                                </td>
                                <td class="px-8 py-5">
                                    <div class="flex justify-center gap-3">
                                        <button onclick="openEditModal('{{ $laporan->id }}', '{{ $laporan->tanggal }}', '{{ addslashes($laporan->kegiatan) }}')" 
                                            class="p-2 bg-amber-50 text-amber-600 rounded-lg hover:bg-amber-100 transition border border-amber-200">✏️</button>
                                        
                                        <form action="{{ route('laporan.hapus', $laporan->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus laporan ini?')">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="p-2 bg-red-50 text-red-600 rounded-lg hover:bg-red-100 transition border border-red-200">🗑️</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>

    <!-- Modal Edit -->
    <div id="editModal" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-[100] hidden items-center justify-center p-4">
        <div class="bg-white rounded-2xl w-full max-w-md overflow-hidden shadow-2xl transform transition-all scale-100">
            <div class="bg-gradient-to-r from-blue-900 to-blue-700 px-8 py-5 flex justify-between items-center">
                <h3 class="text-white font-bold text-sm tracking-wide">Update Laporan</h3>
                <button onclick="closeEditModal()" class="text-white/80 hover:text-white text-2xl font-bold transition">&times;</button>
            </div>
            <form id="editForm" method="POST" class="p-8 space-y-6">
                @csrf @method('PUT')
                <div>
                    <label class="text-[10px] font-bold text-slate-500 uppercase mb-3 block tracking-wider">Ubah Tanggal</label>
                    <input type="date" name="tanggal" id="editTanggal" required 
                        class="w-full bg-slate-50 border-2 border-slate-200 rounded-xl px-4 py-3 text-sm font-semibold text-slate-700 outline-none focus:ring-4 focus:ring-blue-100 focus:border-blue-900 transition">
                </div>
                <div>
                    <label class="text-[10px] font-bold text-slate-500 uppercase mb-3 block tracking-wider">Ubah Deskripsi Pekerjaan</label>
                    <textarea name="kegiatan" id="editKegiatan" rows="4" required 
                        class="w-full bg-slate-50 border-2 border-slate-200 rounded-xl px-4 py-3 text-sm font-semibold text-slate-700 outline-none focus:ring-4 focus:ring-blue-100 focus:border-blue-900 transition"></textarea>
                </div>
                <div class="flex gap-4 pt-4">
                    <button type="button" onclick="closeEditModal()" 
                        class="flex-1 bg-slate-100 text-slate-600 py-3 rounded-xl font-bold text-sm tracking-wide transition hover:bg-slate-200">Batal</button>
                    <button type="submit" 
                        class="flex-[2] bg-gradient-to-r from-blue-900 to-blue-700 text-white py-3 rounded-xl font-bold text-sm tracking-wide transition hover:shadow-lg">Update Laporan</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openEditModal(id, tanggal, kegiatan) {
            const modal = document.getElementById('editModal');
            const form = document.getElementById('editForm');
            
            form.action = `/mahasiswa/laporan/update/${id}`;
            document.getElementById('editTanggal').value = tanggal;
            document.getElementById('editKegiatan').value = kegiatan;
            
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            
            setTimeout(() => {
                modal.children[0].classList.add('scale-100');
                modal.children[0].classList.remove('scale-95');
            }, 10);
        }

        function closeEditModal() {
            const modal = document.getElementById('editModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        window.onclick = function(event) {
            const modal = document.getElementById('editModal');
            if (event.target == modal) {
                closeEditModal();
            }
        }
    </script>
</body>
</html>