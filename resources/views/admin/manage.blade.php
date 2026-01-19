<x-app-layout>
    <div class="mb-8">
        <h1 class="text-3xl font-800 text-slate-800 tracking-tight">Kelola Admin</h1>
        <p class="text-slate-500 mt-1 font-medium">Manajemen akun administrator sistem B-Panel</p>
    </div>

    <div class="mb-6 flex justify-end">
        <a href="{{ route('admin.register') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2.5 rounded-xl font-bold text-sm transition-all shadow-lg shadow-blue-200 flex items-center gap-2">
            <span>➕</span> Tambah Admin Baru
        </a>
    </div>

    @if(session('success'))
    <div class="mb-6 p-4 bg-emerald-50 border-l-4 border-emerald-500 text-emerald-700 rounded-r-xl font-medium">
        {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
    <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 text-red-700 rounded-r-xl font-medium">
        {{ session('error') }}
    </div>
    @endif

    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
        <table class="w-full text-left">
            <thead class="bg-slate-50 border-b border-slate-100">
                <tr>
                    <th class="p-4 text-xs font-800 text-slate-400 uppercase tracking-wider">Nama Admin</th>
                    <th class="p-4 text-xs font-800 text-slate-400 uppercase tracking-wider">Email</th>
                    <th class="p-4 text-xs font-800 text-slate-400 uppercase tracking-wider text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                @foreach($admins as $admin)
                <tr class="hover:bg-slate-50/50 transition-colors">
                    <td class="p-4 flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-bold">
                            {{ strtoupper(substr($admin->name, 0, 1)) }}
                        </div>
                        <span class="font-700 text-slate-700">{{ $admin->name }}</span>
                    </td>
                    <td class="p-4 text-sm text-slate-600 font-medium">{{ $admin->email }}</td>
                    <td class="p-4 text-center">
                        @if($admin->id !== Auth::id())
                            <form action="{{ route('admin.destroy', $admin->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus admin ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-50 hover:bg-red-100 text-red-600 px-3 py-1.5 rounded-lg text-xs font-bold transition-colors flex items-center gap-1 mx-auto">
                                    <span>🗑️</span> Hapus
                                </button>
                            </form>
                        @else
                            <span class="px-2 py-1 bg-blue-100 text-blue-700 rounded text-[10px] font-bold">ANDA (AKTIF)</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>