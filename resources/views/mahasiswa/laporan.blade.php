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
                    <p class="text-[10px] font-bold text-blue-600 uppercase">{{ Auth::user()->role }}</p>
                </div>
                <div class="w-10 h-10 bg-blue-600 rounded-2xl flex items-center justify-center text-white font-black shadow-lg shadow-blue-100">
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
                <h1 class="text-4xl font-black text-slate-800 tracking-tight">Input Aktivitas 📝</h1>
                <p class="text-slate-500 font-medium mt-2">Catat apa yang Anda kerjakan hari ini agar dapat divalidasi oleh pembimbing.</p>
            </div>

            <div class="bg-white rounded-[2rem] shadow-sm border border-blue-200 overflow-hidden mb-12 transform transition hover:shadow-xl hover:shadow-blue-50/50">
                <div class="bg-blue-600 px-8 py-5">
                    <h2 class="font-black text-white text-xs uppercase tracking-widest">Buat Laporan Baru</h2>
                </div>
                <form action="{{ route('laporan.simpan') }}" method="POST" class="p-8">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                        <div class="md:col-span-1">
                            <label class="text-[10px] font-black text-slate-400 uppercase mb-3 block tracking-widest">Tanggal Kegiatan</label>
                            <input type="date" name="tanggal" value="{{ date('Y-m-d') }}" required 
                                class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-5 py-4 text-sm font-bold text-slate-700 focus:ring-4 focus:ring-blue-100 focus:border-blue-500 outline-none transition">
                        </div>
                        <div class="md:col-span-3">
                            <label class="text-[10px] font-black text-slate-400 uppercase mb-3 block tracking-widest">Deskripsi Pekerjaan</label>
                            <input type="text" name="kegiatan" required placeholder="Contoh: Maintenance database atau input data statistik..." 
                                class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-5 py-4 text-sm font-bold text-slate-700 focus:ring-4 focus:ring-blue-100 focus:border-blue-500 outline-none transition">
                        </div>
                    </div>
                    <button type="submit" class="w-full mt-8 bg-blue-600 text-white py-5 rounded-2xl font-black text-xs uppercase tracking-[0.2em] hover:bg-blue-700 hover:-translate-y-1 transition shadow-lg shadow-blue-200 active:translate-y-0">
                        🚀 KIRIM LAPORAN KEGIATAN
                    </button>
                </form>
            </div>

            <div class="bg-white rounded-[2rem] shadow-sm border border-slate-200 overflow-hidden shadow-xl shadow-slate-100/50">
                <div class="bg-slate-50 px-8 py-6 border-b border-slate-100 flex justify-between items-center">
                    <h2 class="font-black text-slate-700 text-xs uppercase tracking-widest">📋 Riwayat Aktivitas Harian</h2>
                    <span class="bg-blue-100 text-blue-600 text-[10px] font-black px-4 py-1.5 rounded-full uppercase">{{ count($riwayatLaporan) }} Total Laporan</span>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="bg-slate-50/50">
                                <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest">TANGGAL</th>
                                <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest">DETAIL KEGIATAN</th>
                                <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center">AKSI</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @foreach($riwayatLaporan as $laporan)
                            <tr class="hover:bg-blue-50/20 transition group">
                                <td class="px-8 py-6 text-xs font-black text-slate-700 whitespace-nowrap">
                                    {{ \Carbon\Carbon::parse($laporan->tanggal)->format('d/m/Y') }}
                                </td>
                                <td class="px-8 py-6 text-xs text-slate-600 font-bold leading-relaxed">
                                    {{ $laporan->kegiatan }}
                                </td>
                                <td class="px-8 py-6">
                                    <div class="flex justify-center gap-3">
                                        <button onclick="openEditModal('{{ $laporan->id }}', '{{ $laporan->tanggal }}', '{{ addslashes($laporan->kegiatan) }}')" 
                                            class="p-2.5 bg-amber-50 text-amber-600 rounded-xl hover:bg-amber-100 transition shadow-sm border border-amber-100">✏️</button>
                                        
                                        <form action="{{ route('laporan.hapus', $laporan->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus laporan ini?')">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="p-2.5 bg-red-50 text-red-600 rounded-xl hover:bg-red-100 transition shadow-sm border border-red-100">🗑️</button>
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

    <div id="editModal" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-[100] hidden items-center justify-center p-4">
        <div class="bg-white rounded-[2.5rem] w-full max-w-md overflow-hidden shadow-2xl transform transition-all scale-100 shadow-blue-900/20">
            <div class="bg-blue-600 px-8 py-6 flex justify-between items-center">
                <h3 class="text-white font-black text-xs uppercase tracking-[0.2em]">Update Laporan</h3>
                <button onclick="closeEditModal()" class="text-white/80 hover:text-white text-2xl font-bold transition">&times;</button>
            </div>
            <form id="editForm" method="POST" class="p-8 space-y-6">
                @csrf @method('PUT')
                <div>
                    <label class="text-[10px] font-black text-slate-400 uppercase mb-3 block tracking-widest">Ubah Tanggal</label>
                    <input type="date" name="tanggal" id="editTanggal" required 
                        class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-5 py-4 text-sm font-bold text-slate-700 outline-none focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition">
                </div>
                <div>
                    <label class="text-[10px] font-black text-slate-400 uppercase mb-3 block tracking-widest">Ubah Deskripsi Pekerjaan</label>
                    <textarea name="kegiatan" id="editKegiatan" rows="4" required 
                        class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-5 py-4 text-sm font-bold text-slate-700 outline-none focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition"></textarea>
                </div>
                <div class="flex gap-4 pt-4">
                    <button type="button" onclick="closeEditModal()" 
                        class="flex-1 bg-slate-100 text-slate-600 py-4 rounded-2xl font-black text-xs uppercase tracking-widest transition hover:bg-slate-200 active:scale-95">Batal</button>
                    <button type="submit" 
                        class="flex-[2] bg-blue-600 text-white py-4 rounded-2xl font-black text-xs uppercase tracking-widest transition hover:bg-blue-700 shadow-lg shadow-blue-100 active:scale-95">Update Laporan</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openEditModal(id, tanggal, kegiatan) {
            const modal = document.getElementById('editModal');
            const form = document.getElementById('editForm');
            
            // Set URL Action dengan ID yang benar
            form.action = `/mahasiswa/laporan/update/${id}`;
            
            // Masukkan data lama ke input modal
            document.getElementById('editTanggal').value = tanggal;
            document.getElementById('editKegiatan').value = kegiatan;
            
            // Tampilkan modal
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            
            // Animasi sedikit
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

        // Tutup modal jika klik di luar area modal
        window.onclick = function(event) {
            const modal = document.getElementById('editModal');
            if (event.target == modal) {
                closeEditModal();
            }
        }
    </script>
</body>
</html>