<x-app-layout>
    <div class="p-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl p-6 border border-gray-100">
            <div class="flex justify-between items-center mb-6">
                <div>
                    <h2 class="text-2xl font-extrabold text-gray-800 tracking-tight">Monitoring Absensi Mahasiswa</h2>
                    <p class="text-sm text-gray-500 mt-1">Daftar kehadiran seluruh peserta magang secara real-time.</p>
                </div>
                <div class="bg-blue-50 text-blue-700 px-4 py-2 rounded-lg font-bold text-sm border border-blue-100">
                    Total: {{ $allAbsensi->total() }} Record
                </div>
            </div>

            <div class="overflow-x-auto rounded-xl border border-gray-200">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Mahasiswa</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Tanggal</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Jam Masuk</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Jam Pulang</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Status</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-100 text-sm">
                        @forelse($allAbsensi as $absen)
                        <tr class="hover:bg-blue-50/50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="font-semibold text-gray-900">{{ $absen->user->name }}</div>
                                <div class="text-xs text-gray-400">{{ $absen->user->email }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-gray-600 font-medium">
                                {{ \Carbon\Carbon::parse($absen->tanggal)->translatedFormat('d F Y') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @php $terlambat = $absen->jam_masuk > '08:00:00'; @endphp
                                <span class="px-3 py-1 rounded-full text-xs font-bold {{ $terlambat ? 'bg-red-100 text-red-600' : 'bg-green-100 text-green-600' }}">
                                    {{ $absen->jam_masuk }}
                                    @if($terlambat) <span class="ml-1 text-[10px] uppercase">(Telat)</span> @endif
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($absen->jam_pulang)
                                    @php $pulangCepat = $absen->jam_pulang < '16:00:00'; @endphp
                                    <span class="px-3 py-1 rounded-full text-xs font-bold {{ $pulangCepat ? 'bg-orange-100 text-orange-600' : 'bg-blue-100 text-blue-600' }}">
                                        {{ $absen->jam_pulang }}
                                    </span>
                                @else
                                    <span class="text-gray-300 italic text-xs">Belum Absen Pulang</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="bg-gray-100 text-gray-700 px-2 py-1 rounded text-[10px] font-black uppercase">{{ $absen->status }}</span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-gray-400">
                                <div class="flex flex-col items-center">
                                    <span class="text-4xl mb-2">📅</span>
                                    <p>Belum ada data absensi yang tercatat.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- BAGIAN PAGINATION --}}
            <div class="mt-6">
                {{ $allAbsensi->links() }}
            </div>
            
        </div>
    </div>
</x-app-layout>