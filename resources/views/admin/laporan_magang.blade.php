<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50 py-6 px-4">
        <div class="max-w-7xl mx-auto">
            
            <!-- Header Card -->
            <div class="bg-white rounded-3xl shadow-lg overflow-hidden mb-6 border border-gray-100">
                <div class="relative bg-gradient-to-r from-[#1e5a8e] via-[#15436b] to-[#0d3049] p-8">
                    <!-- Decorative circles -->
                    <div class="absolute top-0 right-0 w-40 h-40 bg-white/10 rounded-full blur-3xl"></div>
                    <div class="absolute bottom-0 left-20 w-32 h-32 bg-white/10 rounded-full blur-2xl"></div>
                    
                    <div class="relative z-10">
                        <div class="flex items-center gap-4 mb-2">
                            <div class="w-14 h-14 bg-white/20 backdrop-blur-sm rounded-2xl flex items-center justify-center shadow-xl">
                                <span class="text-3xl">📝</span>
                            </div>
                            <div>
                                <h2 class="text-2xl md:text-3xl font-bold text-white tracking-tight">
                                    Laporan Harian Magang
                                </h2>
                                <p class="text-blue-100 text-sm mt-1">
                                    Daftar aktivitas harian seluruh mahasiswa magang Diskominfo Binjai
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Stats Bar -->
                <div class="bg-gradient-to-r from-gray-50 to-slate-50 px-8 py-4 border-b border-gray-100">
                    <div class="flex flex-wrap items-center gap-6 text-sm">
                        <div class="flex items-center gap-2">
                            <span class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></span>
                            <span class="text-gray-600 font-medium">Total Laporan:</span>
                            <span class="font-bold text-gray-800">{{ $laporans->total() }}</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="text-gray-400">•</span>
                            <span class="text-gray-600 font-medium">Halaman:</span>
                            <span class="font-bold text-gray-800">{{ $laporans->currentPage() }} / {{ $laporans->lastPage() }}</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="text-gray-400">•</span>
                            <span class="text-gray-600 font-medium">Tanggal:</span>
                            <span class="font-bold text-gray-800">{{ now()->format('d F Y') }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Table Card -->
            <div class="bg-white rounded-3xl shadow-lg overflow-hidden border border-gray-100">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="bg-gradient-to-r from-slate-100 via-gray-100 to-slate-100">
                                <th class="py-5 px-6 text-left w-20">
                                    <span class="text-xs font-extrabold text-gray-500 uppercase tracking-wider">No</span>
                                </th>
                                <th class="py-5 px-6 text-left">
                                    <span class="text-xs font-extrabold text-gray-500 uppercase tracking-wider">Nama Mahasiswa</span>
                                </th>
                                <th class="py-5 px-6 text-left w-48">
                                    <span class="text-xs font-extrabold text-gray-500 uppercase tracking-wider">Tanggal</span>
                                </th>
                                <th class="py-5 px-6 text-left">
                                    <span class="text-xs font-extrabold text-gray-500 uppercase tracking-wider">Kegiatan / Aktivitas</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($laporans as $index => $laporan)
                            <tr class="hover:bg-gradient-to-r hover:from-blue-50/30 hover:to-indigo-50/30 transition-all duration-200 group">
                                <!-- Nomor -->
                                <td class="py-5 px-6">
                                    <div class="flex items-center justify-center w-10 h-10 bg-gradient-to-br from-[#1e5a8e] to-[#15436b] text-white font-bold rounded-xl shadow-md group-hover:shadow-lg group-hover:scale-105 transition-all duration-200">
                                        {{ $laporans->firstItem() + $index }}
                                    </div>
                                </td>

                                <!-- Nama Mahasiswa -->
                                <td class="py-5 px-6">
                                    <div class="flex items-center gap-3">
                                        <!-- Avatar -->
                                        <div class="flex-shrink-0 w-12 h-12 bg-gradient-to-br from-blue-400 via-indigo-400 to-purple-400 rounded-xl flex items-center justify-center text-white font-bold text-lg shadow-md">
                                            {{ strtoupper(substr($laporan->user->name ?? 'N', 0, 1)) }}
                                        </div>
                                        <div>
                                            <div class="font-bold text-gray-800 text-sm group-hover:text-[#1e5a8e] transition-colors">
                                                {{ $laporan->user->name ?? 'N/A' }}
                                            </div>
                                            <div class="text-xs text-gray-500 flex items-center gap-1 mt-0.5">
                                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path>
                                                    <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path>
                                                </svg>
                                                {{ $laporan->user->email ?? '-' }}
                                            </div>
                                        </div>
                                    </div>
                                </td>

                                <!-- Tanggal -->
                                <td class="py-5 px-6">
                                    <div class="inline-flex items-center gap-2 px-4 py-2.5 bg-gradient-to-r from-blue-50 to-indigo-50 border border-blue-200 rounded-xl shadow-sm">
                                        <svg class="w-4 h-4 text-[#1e5a8e]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                        <span class="text-xs font-bold text-[#1e5a8e]">
                                            {{ \Carbon\Carbon::parse($laporan->tanggal)->format('d M Y') }}
                                        </span>
                                    </div>
                                </td>

                                <!-- Kegiatan -->
                                <td class="py-5 px-6">
                                    <div class="max-w-2xl">
                                        <p class="text-sm text-gray-700 leading-relaxed">
                                            {{ $laporan->kegiatan }}
                                        </p>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="py-20">
                                    <div class="text-center">
                                        <!-- Empty State Icon -->
                                        <div class="mb-6 flex justify-center">
                                            <div class="w-24 h-24 bg-gradient-to-br from-gray-100 to-gray-200 rounded-3xl flex items-center justify-center shadow-inner">
                                                <span class="text-6xl opacity-40">📋</span>
                                            </div>
                                        </div>
                                        <h3 class="text-xl font-bold text-gray-700 mb-2">
                                            Belum Ada Laporan
                                        </h3>
                                        <p class="text-sm text-gray-500 max-w-md mx-auto leading-relaxed">
                                            Laporan harian akan muncul di sini setelah mahasiswa mengirimkan aktivitas mereka.
                                        </p>
                                        <div class="mt-6">
                                            <span class="inline-flex items-center gap-2 px-4 py-2 bg-blue-50 text-blue-600 text-xs font-semibold rounded-lg border border-blue-100">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                                Refresh halaman untuk memuat data terbaru
                                            </span>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if($laporans->hasPages())
                <div class="px-6 py-5 bg-gradient-to-r from-gray-50 to-slate-50 border-t border-gray-200">
                    {{ $laporans->links() }}
                </div>
                @endif
            </div>

            <!-- Footer Info -->
            <div class="mt-6 bg-white rounded-2xl shadow-sm border border-gray-100 px-6 py-4">
                <div class="flex items-center gap-3 text-sm text-gray-600">
                    <div class="flex items-center gap-2">
                        <div class="w-8 h-8 bg-gradient-to-br from-amber-400 to-orange-400 rounded-lg flex items-center justify-center shadow-sm">
                            <span class="text-lg">💡</span>
                        </div>
                        <span class="font-semibold text-gray-700">Tips:</span>
                    </div>
                    <p>Gunakan fitur pagination di bawah untuk navigasi antar halaman laporan</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>