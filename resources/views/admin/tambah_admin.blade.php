<x-app-layout>
    <div class="py-6 px-4 sm:px-6 lg:px-8">
        <div class="mb-8 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <a href="{{ route('admin.manage') }}" class="group inline-flex items-center text-sm font-semibold text-blue-600 hover:text-blue-700 transition-colors mb-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 transform group-hover:-translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Kembali ke Manajemen Akun
                </a>
                <h1 class="text-4xl font-black text-slate-900 tracking-tight">Tambah Administrator</h1>
                <p class="text-slate-500 mt-1 text-base font-medium">Lengkapi formulir di bawah untuk mendaftarkan akun pengelola baru.</p>
            </div>
            
            <div class="hidden md:block">
                <span class="inline-flex items-center px-4 py-2 bg-blue-50 text-blue-700 rounded-2xl text-sm font-bold border border-blue-100">
                    <span class="flex h-2 w-2 rounded-full bg-blue-600 mr-2 animate-pulse"></span>
                    Sesi Admin Aktif
                </span>
            </div>
        </div>

        <div class="max-w-full bg-white rounded-[2rem] shadow-2xl shadow-slate-200/50 border border-slate-100 overflow-hidden">
            <div class="bg-gradient-to-r from-blue-600 via-indigo-600 to-violet-700 h-2.5 w-full"></div>
            
            <form action="{{ route('admin.register.store') }}" method="POST" class="p-8 lg:p-12">
                @csrf
                
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-x-12 gap-y-8">
                    
                    <div class="space-y-6">
                        <h2 class="text-xl font-bold text-slate-800 flex items-center gap-2 mb-4">
                            <span class="p-2 bg-slate-100 rounded-lg text-lg">👤</span>
                            Informasi Identitas
                        </h2>
                        
                        <div>
                            <label class="block text-xs font-black text-slate-500 uppercase tracking-widest mb-2 ml-1">Nama Lengkap</label>
                            <input type="text" name="name" required 
                                class="w-full px-5 py-4 bg-slate-50 border-2 border-slate-100 rounded-2xl focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all outline-none text-slate-700 font-semibold text-lg"
                                placeholder="Masukkan nama lengkap...">
                        </div>

                        <div>
                            <label class="block text-xs font-black text-slate-500 uppercase tracking-widest mb-2 ml-1">Alamat Email Instansi</label>
                            <input type="email" name="email" required 
                                class="w-full px-5 py-4 bg-slate-50 border-2 border-slate-100 rounded-2xl focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all outline-none text-slate-700 font-semibold text-lg"
                                placeholder="nama@binjai.go.id">
                        </div>
                    </div>

                    <div class="space-y-6">
                        <h2 class="text-xl font-bold text-slate-800 flex items-center gap-2 mb-4">
                            <span class="p-2 bg-slate-100 rounded-lg text-lg">🔒</span>
                            Kredensial Keamanan
                        </h2>

                        <div>
                            <label class="block text-xs font-black text-slate-500 uppercase tracking-widest mb-2 ml-1">Kata Sandi Baru</label>
                            <input type="password" name="password" required 
                                class="w-full px-5 py-4 bg-slate-50 border-2 border-slate-100 rounded-2xl focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all outline-none text-slate-700 font-semibold text-lg"
                                placeholder="••••••••">
                        </div>

                        <div>
                            <label class="block text-xs font-black text-slate-500 uppercase tracking-widest mb-2 ml-1">Ulangi Kata Sandi</label>
                            <input type="password" name="password_confirmation" required 
                                class="w-full px-5 py-4 bg-slate-50 border-2 border-slate-100 rounded-2xl focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all outline-none text-slate-700 font-semibold text-lg"
                                placeholder="••••••••">
                        </div>
                    </div>
                </div>

                <div class="mt-12 pt-8 border-t border-slate-50 flex flex-col md:flex-row items-center justify-between gap-6">
                    <div class="text-sm text-slate-400 font-medium max-w-sm text-center md:text-left">

                    </div>
                    
                    <div class="flex items-center gap-4 w-full md:w-auto">
                        <button type="reset" class="px-8 py-4 rounded-2xl font-bold text-slate-500 hover:bg-slate-100 transition-all">
                            Reset Form
                        </button>
                        <button type="submit" 
                            class="flex-1 md:flex-none px-12 py-4 bg-blue-600 hover:bg-blue-700 text-white rounded-2xl font-bold text-lg shadow-xl shadow-blue-200 hover:shadow-blue-300 transform hover:-translate-y-1 active:translate-y-0 transition-all duration-200">
                            Simpan Akun
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>