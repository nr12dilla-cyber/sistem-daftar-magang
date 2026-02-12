<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Absensi - Portal Magang</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        body { 
            font-family: 'Inter', sans-serif; 
            background: #f5f7fa;
        }
        .sidebar-item {
            color: #718096;
            transition: all 0.2s;
        }
        .sidebar-item:hover {
            background: #f8f9fa;
            color: #1e5a8e;
        }
        .status-badge-success {
            background: #d1fae5;
            color: #065f46;
        }
        .status-badge-danger {
            background: #fee2e2;
            color: #991b1b;
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

            <a href="{{ route('laporan.index') }}" class="flex items-center gap-3 px-6 py-3.5 text-sm font-bold sidebar-item transition rounded-r-xl mx-2 mt-1">
                <span>📝</span> Laporan Harian
            </a>
        </nav>

        <div class="p-6 border-t border-slate-100">
            <p class="text-[10px] text-center text-slate-400 font-bold uppercase tracking-widest">v1.0 Mahasiswa</p>
        </div>
    </aside>

    <div class="flex-1">
        <nav class="bg-white border-b border-slate-200 px-8 py-4 sticky top-0 z-50 shadow-sm flex justify-between items-center">
            <h2 class="text-sm font-bold text-slate-700 tracking-wide">🕒 Riwayat Absensi</h2>
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

        <main class="max-w-6xl mx-auto px-8 py-10">
            <!-- Header Section -->
            <div class="mb-8">
                <h1 class="text-3xl font-black text-slate-800 tracking-tight">Riwayat Absensi</h1>
                <p class="text-slate-500 font-medium mt-2">Daftar kehadiran dan presensi Anda selama magang</p>
            </div>

            <!-- Stats Card -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
                <div class="bg-white p-5 rounded-xl shadow-sm border border-slate-100">
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-2">Total Absen</p>
                    <p class="text-2xl font-black text-slate-800">{{ count($riwayatAbsen) }}</p>
                </div>
                <div class="bg-green-50 p-5 rounded-xl shadow-sm border border-green-100">
                    <p class="text-[10px] font-bold text-green-600 uppercase tracking-wider mb-2">Tepat Waktu</p>
                    <p class="text-2xl font-black text-green-700">
                        {{ $riwayatAbsen->filter(function($a) { 
                            return \Carbon\Carbon::parse($a->jam_masuk)->format('H:i:s') <= '08:00:00'; 
                        })->count() }}
                    </p>
                </div>
                <div class="bg-red-50 p-5 rounded-xl shadow-sm border border-red-100">
                    <p class="text-[10px] font-bold text-red-600 uppercase tracking-wider mb-2">Terlambat</p>
                    <p class="text-2xl font-black text-red-700">
                        {{ $riwayatAbsen->filter(function($a) { 
                            return \Carbon\Carbon::parse($a->jam_masuk)->format('H:i:s') > '08:00:00'; 
                        })->count() }}
                    </p>
                </div>
                <div class="bg-blue-50 p-5 rounded-xl shadow-sm border border-blue-100">
                    <p class="text-[10px] font-bold text-blue-600 uppercase tracking-wider mb-2">Belum Pulang</p>
                    <p class="text-2xl font-black text-blue-700">
                        {{ $riwayatAbsen->whereNull('jam_pulang')->count() }}
                    </p>
                </div>
            </div>

            <!-- Table Card -->
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
                <div class="bg-gradient-to-r from-blue-900 to-blue-700 px-8 py-5">
                    <h2 class="font-bold text-white text-sm tracking-wide">📋 Detail Kehadiran</h2>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="bg-slate-50 border-b border-slate-100">
                                <th class="px-8 py-4 text-[10px] font-bold text-slate-500 uppercase tracking-wider">No</th>
                                <th class="px-8 py-4 text-[10px] font-bold text-slate-500 uppercase tracking-wider">Tanggal</th>
                                <th class="px-8 py-4 text-[10px] font-bold text-slate-500 uppercase tracking-wider">Jam Masuk</th>
                                <th class="px-8 py-4 text-[10px] font-bold text-slate-500 uppercase tracking-wider">Jam Pulang</th>
                                <th class="px-8 py-4 text-[10px] font-bold text-slate-500 uppercase tracking-wider">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @forelse($riwayatAbsen as $index => $absen)
                            <tr class="hover:bg-slate-50 transition">
                                <td class="px-8 py-5 text-sm font-bold text-slate-700">
                                    {{ $index + 1 }}
                                </td>
                                <td class="px-8 py-5 text-sm font-semibold text-slate-700">
                                    {{ \Carbon\Carbon::parse($absen->tanggal)->translatedFormat('d F Y') }}
                                </td>
                                
                                {{-- Logika Jam Masuk --}}
                                <td class="px-8 py-5">
                                    @php
                                        $jamMasuk = \Carbon\Carbon::parse($absen->jam_masuk);
                                        $terlambat = $jamMasuk->format('H:i:s') > '08:00:00';
                                    @endphp
                                    <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg text-xs font-bold {{ $terlambat ? 'status-badge-danger' : 'status-badge-success' }}">
                                        <span>{{ $terlambat ? '⚠️' : '✅' }}</span>
                                        {{ $absen->jam_masuk }}
                                    </span>
                                    @if($terlambat)
                                        <span class="text-[10px] text-red-600 font-semibold block mt-1">Terlambat</span>
                                    @endif
                                </td>

                                {{-- Logika Jam Pulang --}}
                                <td class="px-8 py-5">
                                    @if($absen->jam_pulang)
                                        @php
                                            $jamPulang = \Carbon\Carbon::parse($absen->jam_pulang);
                                            $pulangCepat = $jamPulang->format('H:i:s') < '16:00:00';
                                        @endphp
                                        <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg text-xs font-bold {{ $pulangCepat ? 'status-badge-danger' : 'status-badge-success' }}">
                                            <span>{{ $pulangCepat ? '⚠️' : '✅' }}</span>
                                            {{ $absen->jam_pulang }}
                                        </span>
                                        @if($pulangCepat)
                                            <span class="text-[10px] text-red-600 font-semibold block mt-1">Pulang Cepat</span>
                                        @endif
                                    @else
                                        <span class="inline-flex items-center px-3 py-1.5 bg-slate-100 text-slate-500 rounded-lg text-xs font-semibold">
                                            ⏳ Belum Pulang
                                        </span>
                                    @endif
                                </td>
                                
                                <td class="px-8 py-5">
                                    <span class="inline-flex px-3 py-1.5 bg-blue-100 text-blue-700 rounded-lg text-xs font-bold">
                                        {{ $absen->status }}
                                    </span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-8 py-12 text-center">
                                    <div class="flex flex-col items-center gap-3">
                                        <span class="text-4xl">📭</span>
                                        <p class="text-slate-400 font-semibold">Belum ada data absensi</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Back Button -->
            <div class="mt-8">
                <a href="{{ route('dashboard.mahasiswa') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-white text-slate-700 border border-slate-200 rounded-xl font-bold text-sm hover:bg-slate-50 hover:border-slate-300 transition shadow-sm">
                    <span>←</span>
                    Kembali ke Dashboard
                </a>
            </div>
        </main>
    </div>

</body>
</html>