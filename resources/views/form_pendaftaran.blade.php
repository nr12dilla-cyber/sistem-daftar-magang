<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Magang - Diskominfo Binjai</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Poppins:wght@600;700;800;900&display=swap" rel="stylesheet">
    <style>
        :root {
            --blue-primary: #0066cc;
            --blue-dark: #004c99;
        }

        body { 
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            min-height: 100vh;
        }

        /* Navbar Style */
        .nav-custom {
            background: white;
            border-bottom: 1px solid #e2e8f0;
            position: sticky;
            top: 0;
            z-index: 50;
        }

        /* Card Style */
        .card-combined {
            background: white;
            border-radius: 2rem;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            border: 1px solid #e2e8f0;
        }

        .header-gradient {
            background: linear-gradient(135deg, var(--blue-primary) 0%, var(--blue-dark) 100%);
        }

        .form-input, .form-select {
            width: 100%;
            background-color: #f8fafc;
            border: 2px solid #e2e8f0;
            border-radius: 0.75rem;
            padding: 0.75rem 1rem;
            transition: all 0.2s;
        }

        .form-input:focus {
            border-color: var(--blue-primary);
            outline: none;
            background-color: #fff;
        }

        .btn-main {
            background: linear-gradient(135deg, var(--blue-primary) 0%, var(--blue-dark) 100%);
            transition: all 0.3s ease;
        }

        .btn-main:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(0, 102, 204, 0.3);
        }
    </style>
</head>
<body class="flex flex-col">

<nav class="nav-custom">
    <div class="max-w-6xl mx-auto px-6 py-4 flex justify-between items-center">
        <div class="flex items-center gap-3">
            <img src="https://tse3.mm.bing.net/th/id/OIP.lT6599E9vZtjj81vWTllEwHaIO?pid=Api&P=0&h=180" alt="Logo" class="h-10 w-auto object-contain">
            <div class="hidden sm:block">
                <p class="font-extrabold text-slate-800 leading-none">DISKOMINFO</p>
                <p class="text-[10px] font-bold text-blue-600 tracking-widest uppercase">Kota Binjai</p>
            </div>
        </div>
        <div class="flex items-center">
            <a href="{{ url('/') }}" class="bg-blue-50 text-blue-700 px-4 py-2 rounded-lg text-sm font-bold hover:bg-blue-100 transition">Beranda</a>
        </div>
    </div>
</nav>

<main class="flex-grow flex items-center justify-center px-4 py-12">
    <div class="max-w-5xl w-full card-combined">
        
        <div class="header-gradient p-10 md:p-14 text-center text-white relative">
            <div class="absolute inset-0 opacity-10 pointer-events-none" style="background-image: radial-gradient(circle at 2px 2px, white 1px, transparent 0); background-size: 24px 24px;"></div>
            
            <div class="relative z-10">
                <h1 class="text-3xl md:text-5xl font-black mb-3" style="font-family: 'Poppins'; tracking-tight">Pendaftaran Magang Online</h1>
                <p class="text-blue-100 font-medium text-sm md:text-lg max-w-2xl mx-auto opacity-90">
                    Sistem Informasi Pendaftaran Magang Data Center Dinas Komunikasi dan Informatika Kota Binjai.
                </p>
            </div>
        </div>

        <div class="flex flex-col md:flex-row">
            
            <div class="md:w-1/3 bg-slate-50 p-8 border-b md:border-b-0 md:border-r border-slate-100">
                <div class="mb-8">
                    <h2 class="text-lg font-bold text-slate-800 flex items-center gap-2 mb-2">
                        <span class="flex items-center justify-center w-8 h-8 bg-blue-100 text-blue-600 rounded-lg text-sm">🔍</span>
                        Cek Status Seleksi
                    </h2>
                    <p class="text-xs text-slate-500 font-medium leading-relaxed">Masukkan email yang Anda gunakan saat mendaftar untuk melihat hasil.</p>
                </div>
                
                <form action="{{ url()->current() }}" method="GET" class="space-y-3">
                    <input type="email" name="email_cek" required placeholder="Email Anda..." class="form-input text-sm" value="{{ request('email_cek') }}">
                    <button type="submit" class="w-full bg-slate-800 text-white py-3 rounded-xl font-bold text-sm hover:bg-black transition shadow-sm">Periksa Hasil</button>
                </form>

                @if(isset($hasilCek))
                    @php $statusResmi = strtolower($hasilCek->status); @endphp
                    <div class="mt-6 p-5 rounded-2xl border-2 {{ $statusResmi == 'diterima' ? 'bg-emerald-50 border-emerald-100' : ($statusResmi == 'ditolak' ? 'bg-red-50 border-red-100' : 'bg-orange-50 border-orange-100') }}">
                        <p class="text-[10px] font-bold uppercase text-slate-400 mb-1 tracking-widest">Status Anda:</p>
                        <p class="text-2xl font-black {{ $statusResmi == 'diterima' ? 'text-emerald-600' : ($statusResmi == 'ditolak' ? 'text-red-600' : 'text-orange-600') }}">
                            {{ strtoupper($hasilCek->status) }}
                        </p>
                        <div class="mt-3 pt-3 border-t border-black/5">
                            <p class="text-xs font-bold text-slate-700 leading-tight">{{ $hasilCek->nama }}</p>
                        </div>
                    </div>
                @endif
            </div>

            <div class="md:w-2/3 p-8 md:p-12">
                <h2 class="text-xl font-bold text-slate-800 mb-8 flex items-center gap-3">
                    <span class="flex items-center justify-center w-8 h-8 bg-blue-600 text-white rounded-lg text-sm">📝</span>
                    Isi Formulir Pendaftaran
                </h2>
                
                <form action="{{ route('pendaftaran.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div class="md:col-span-2">
                            <label class="text-[11px] font-extrabold text-slate-500 uppercase tracking-wider mb-2 block">Nama Lengkap</label>
                            <input type="text" name="nama" required class="form-input" placeholder="Masukkan nama lengkap Anda">
                        </div>
                        <div>
                            <label class="text-[11px] font-extrabold text-slate-500 uppercase tracking-wider mb-2 block">Alamat Email</label>
                            <input type="email" name="email" required class="form-input" placeholder="contoh@gmail.com">
                        </div>
                        <div>
                            <label class="text-[11px] font-extrabold text-slate-500 uppercase tracking-wider mb-2 block">Nomor WhatsApp</label>
                            <input type="tel" name="telepon" required class="form-input" placeholder="08xxxxxxxxxx">
                        </div>
                        <div class="md:col-span-2">
                            <label class="text-[11px] font-extrabold text-slate-500 uppercase tracking-wider mb-2 block">Asal Instansi / Sekolah</label>
                            <input type="text" name="asal_sekolah" required class="form-input" placeholder="Nama Universitas atau Sekolah">
                        </div>
                        <div class="md:col-span-2">
                            <label class="text-[11px] font-extrabold text-slate-500 uppercase tracking-wider mb-2 block">Bidang Magang yang Dipilih</label>
                            <select name="posisi" required class="form-select">
                                <option value="">-- Pilih Salah Satu Bidang --</option>
                                <option>Bidang Informasi dan Komunikasi Publik (IKP)</option>
                                <option>Bidang Aplikasi dan Informatika (APTIKA)</option>
                                <option>Bidang Statistik dan Persandian</option>
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5 pt-2">
                        <div class="p-4 bg-slate-50 rounded-xl border border-slate-200">
                            <label class="text-[11px] font-bold text-slate-700 block mb-2">📷 Pas Foto</label>
                            <input type="file" name="foto" required class="text-xs w-full file:bg-blue-600 file:text-white file:border-0 file:px-3 file:py-1 file:rounded file:mr-2">
                        </div>
                        <div class="p-4 bg-slate-50 rounded-xl border border-slate-200">
                            <label class="text-[11px] font-bold text-slate-700 block mb-2">📄 Surat Pengantar (PDF)</label>
                            <input type="file" name="surat" required class="text-xs w-full file:bg-blue-600 file:text-white file:border-0 file:px-3 file:py-1 file:rounded file:mr-2">
                        </div>
                    </div>

                    <button type="submit" class="btn-main w-full py-4 text-white font-bold rounded-xl text-lg shadow-lg mt-6">Kirim Data Pendaftaran</button>
                </form>
            </div>
        </div>
    </div>
</main>

<footer class="py-8 text-center">
    <p class="text-slate-400 text-[10px] font-bold uppercase tracking-[0.3em]">© 2024 Dinas Komunikasi dan Informatika Kota Binjai</p>
</footer>

</body>
</html>