<x-app-layout>
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="bg-gradient-to-r from-[#1e5a8e] to-[#15436b] p-6">
            <h2 class="text-xl font-bold text-white flex items-center">
                <span class="mr-3">📝</span> Laporan Harian Magang
            </h2>
            <p class="text-blue-100 text-sm mt-1">Daftar aktivitas harian seluruh mahasiswa magang Diskominfo Binjai</p>
        </div>

        <div class="p-6">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-gray-100">
                            <th class="py-4 px-4 text-xs font-extrabold text-gray-400 uppercase tracking-wider w-16">No</th>
                            <th class="py-4 px-4 text-xs font-extrabold text-gray-400 uppercase tracking-wider">Nama Mahasiswa</th>
                            <th class="py-4 px-4 text-xs font-extrabold text-gray-400 uppercase tracking-wider w-40">Tanggal</th>
                            <th class="py-4 px-4 text-xs font-extrabold text-gray-400 uppercase tracking-wider">Kegiatan / Aktivitas</th>
                            </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @forelse($laporans as $index => $laporan)
                        <tr class="hover:bg-gray-50/50 transition-colors">
                            <td class="py-4 px-4 text-sm font-bold text-[#1e5a8e]">{{ $laporans->firstItem() + $index }}</td>
                            <td class="py-4 px-4">
                                <div class="font-bold text-gray-800">{{ $laporan->user->name ?? 'N/A' }}</div>
                                <div class="text-xs text-gray-400">{{ $laporan->user->email ?? '' }}</div>
                            </td>
                            <td class="py-4 px-4">
                                <span class="px-3 py-1 bg-blue-50 text-[#1e5a8e] text-xs font-bold rounded-full border border-blue-100 whitespace-nowrap">
                                    {{ \Carbon\Carbon::parse($laporan->tanggal)->format('d M Y') }}
                                </span>
                            </td>
                            <td class="py-4 px-4 text-sm text-gray-600 leading-relaxed max-w-md">
                                {{ $laporan->kegiatan }}
                            </td>
                            </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="py-10 text-center text-gray-400 italic">
                                Belum ada laporan harian yang masuk.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-6">
                {{ $laporans->links() }}
            </div>
        </div>
    </div>
</x-app-layout>