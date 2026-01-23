<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Magang - Diskominfo Binjai</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Poppins:wght@600;700;800;900&display=swap" rel="stylesheet">
    <style>
        :root { --blue-primary: #0066cc; --blue-dark: #004c99; }
        body { font-family: 'Inter', sans-serif; background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 50%, #f0f9ff 100%); min-height: 100vh; }
        h1, h2, label, button { font-family: 'Poppins', sans-serif; font-style: normal !important; }
        .nav-custom { background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(10px); border-bottom: 1px solid rgba(0, 102, 204, 0.1); position: sticky; top: 0; z-index: 50; }
        .logo-clean { mix-blend-mode: multiply; }
        .card-combined { background: white; border-radius: 2rem; box-shadow: 0 25px 50px -12px rgba(0, 102, 204, 0.15); overflow: hidden; border: 1px solid rgba(226, 232, 240, 0.8); }
        .header-gradient { background: linear-gradient(135deg, var(--blue-primary) 0%, var(--blue-dark) 100%); }
        .form-input, .form-select { width: 100%; background-color: #f8fafc; border: 2px solid #e2e8f0; border-radius: 0.75rem; padding: 0.75rem 1rem; transition: all 0.3s ease; }
        .circle-logo-wrapper { background: white; border-radius: 9999px; display: flex; align-items: center; justify-content: center; width: 100px; height: 100px; box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2); border: 4px solid rgba(255, 255, 255, 0.3); margin-bottom: 1.5rem; overflow: hidden; }
        .logo-inner { height: 75%; width: auto; transform: scale(1.15); object-fit: contain; }
    </style>
</head>
<body class="flex flex-col">

<nav class="nav-custom">
    <div class="w-full px-6 md:px-10 py-4 flex justify-between items-center">
        <div class="flex items-center gap-3">
            <img src="{{ asset('images/logobinjai.png') }}" alt="Logo" class="h-12 w-auto logo-clean">
            <div class="flex flex-col">
                <p class="font-extrabold text-slate-800 leading-none">DISKOMINFO</p>
                <p class="text-[10px] font-bold text-blue-600 tracking-widest uppercase">Kota Binjai</p>
            </div>
        </div>
        <a href="{{ url('/') }}" class="bg-blue-50 text-blue-700 px-5 py-2.5 rounded-lg text-sm font-bold hover:bg-blue-100 transition-all border border-blue-100">← Beranda</a>
    </div>
</nav>

<main class="flex-grow flex items-center justify-center px-4 py-12 mb-20">
    <div class="max-w-5xl w-full card-combined">
        <div class="header-gradient p-10 md:p-14 text-center text-white relative">
            <div class="relative z-10 flex flex-col items-center">
                <div class="circle-logo-wrapper">
                    <img src="{{ asset('images/logobinjai.png') }}" alt="Logo Binjai" class="logo-inner logo-clean">
                </div>
                <h1 class="text-3xl md:text-5xl font-black mb-3 tracking-tight">Pendaftaran Magang Online</h1>
                <p class="text-blue-100 font-medium text-sm md:text-lg max-w-2xl mx-auto opacity-95">
                    Sistem Informasi Pendaftaran Magang Data Center Dinas Komunikasi dan Informatika Kota Binjai.
                </p>
            </div>
        </div>

        <div class="flex flex-col md:flex-row">
            <div class="md:w-1/3 bg-gradient-to-br from-slate-50 to-blue-50/30 p-8 border-b md:border-b-0 md:border-r border-slate-200/50">
                <div class="mb-8">
                    <h2 class="text-lg font-bold text-slate-800 flex items-center gap-2 mb-2">
                        <span class="flex items-center justify-center w-9 h-9 bg-blue-600 text-white rounded-xl text-sm shadow-lg">🔍</span>
                        Cek Status Seleksi
                    </h2>
                </div>
                <form action="{{ url()->current() }}" method="GET" class="space-y-3">
                    <input type="email" name="email_cek" required placeholder="Email Anda..." class="form-input text-sm" value="{{ request('email_cek') }}">
                    <button type="submit" class="w-full bg-slate-800 text-white py-3 rounded-xl font-bold text-sm hover:bg-black transition-all shadow-lg uppercase tracking-wider">Periksa Hasil</button>
                </form>

                @if(isset($hasilCek))
                    <div class="mt-6 p-5 rounded-2xl border-2 bg-white shadow-sm border-blue-100 animate-pulse">
                        <p class="text-[10px] font-bold uppercase text-slate-400 mb-1 tracking-widest">Status:</p>
                        <p class="text-2xl font-black text-blue-600">{{ strtoupper($hasilCek->status) }}</p>
                        <p class="text-xs font-bold text-slate-700 mt-2">{{ $hasilCek->nama }}</p>
                    </div>
                @endif
            </div>

            <div class="md:w-2/3 p-8 md:p-12 bg-white">
                <h2 class="text-xl font-bold text-slate-800 mb-8 flex items-center gap-3">
                    <span class="flex items-center justify-center w-9 h-9 bg-blue-600 text-white rounded-xl text-sm shadow-lg">📝</span>
                    Formulir Pendaftaran
                </h2>

                <form action="{{ route('pendaftaran.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div class="md:col-span-2">
                            <label class="text-[11px] font-extrabold text-slate-500 uppercase mb-2 block tracking-wider">Nama Lengkap</label>
                            <input type="text" name="nama" required class="form-input" placeholder="Nama lengkap pendaftar">
                        </div>
                        <div>
                            <label class="text-[11px] font-extrabold text-slate-500 uppercase mb-2 block tracking-wider">Email</label>
                            <input type="email" name="email" required class="form-input" placeholder="email@contoh.com">
                        </div>
                        <div>
                            <label class="text-[11px] font-extrabold text-slate-500 uppercase mb-2 block tracking-wider">WhatsApp</label>
                            <input type="tel" name="nomor_wa" required class="form-input" placeholder="08xxxxxxxxxx">
                        </div>
                        <div class="md:col-span-2">
                            <label class="text-[11px] font-extrabold text-slate-500 uppercase mb-2 block tracking-wider">Asal Sekolah / Kampus</label>
                            <input type="text" name="asal_sekolah" required class="form-input" placeholder="Nama Instansi Pendidikan">
                        </div>
                        <div class="md:col-span-2">
                            <label class="text-[11px] font-extrabold text-slate-500 uppercase mb-2 block tracking-wider">Bidang Magang</label>
                            <select name="posisi" required class="form-select">
                                <option value="">-- Pilih Bidang --</option>
                                <option>Bidang Informasi dan Komunikasi Publik (IKP)</option>
                                <option>Bidang Aplikasi dan Informatika (APTIKA)</option>
                                <option>Bidang Statistik dan Persandian</option>
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div class="p-4 bg-slate-50 rounded-xl border-2 border-dashed border-slate-200 hover:border-blue-300 transition-all">
                            <div class="flex justify-between items-center mb-3">
                                <label class="text-[11px] font-bold text-slate-700 uppercase tracking-wider">Pas Foto</label>
                                <span class="text-[9px] text-blue-700 font-extrabold uppercase bg-blue-100 px-2 py-0.5 rounded shadow-sm">Max: 5MB</span>
                            </div>
                            <input type="file" name="foto" required class="text-xs w-full file:mr-3 file:py-1 file:px-2 file:rounded file:border-0 file:text-xs file:bg-blue-600 file:text-white hover:file:bg-blue-700 transition-all cursor-pointer">
                            <p class="text-[8px] text-slate-400 mt-2 font-medium">* Format: JPG, PNG</p>
                        </div>

                        <div class="p-4 bg-slate-50 rounded-xl border-2 border-dashed border-slate-200 hover:border-blue-300 transition-all">
                            <div class="flex justify-between items-center mb-3">
                                <label class="text-[11px] font-bold text-slate-700 uppercase tracking-wider">Surat Pengantar</label>
                                <span class="text-[9px] text-blue-700 font-extrabold uppercase bg-blue-100 px-2 py-0.5 rounded shadow-sm">Max: 5MB</span>
                            </div>
                            <input type="file" name="surat" required class="text-xs w-full file:mr-3 file:py-1 file:px-2 file:rounded file:border-0 file:text-xs file:bg-blue-600 file:text-white hover:file:bg-blue-700 transition-all cursor-pointer">
                            <p class="text-[8px] text-slate-400 mt-2 font-medium">* Format: PDF Saja</p>
                        </div>
                    </div>

                    <button type="submit" class="w-full py-4 bg-blue-600 text-white font-bold rounded-xl text-lg shadow-xl mt-4 hover:bg-blue-700 transition-all uppercase tracking-widest">
                        Submit Pendaftaran
                    </button>
                </form>
            </div>
        </div>
    </div>
</main>

<footer class="bg-white border-t border-slate-200 pt-12 pb-16">
    <div class="max-w-5xl w-full mx-auto px-4">
        <div class="flex flex-wrap justify-center gap-x-12 gap-y-6 text-slate-500 mb-10">
            <div class="flex items-center gap-4">
                <div class="p-3 bg-blue-50 rounded-xl shadow-sm">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                </div>
                <span class="text-[12px] font-bold tracking-wider uppercase">Jl. Jend. Sudirman No. 6, Binjai Kota</span>
            </div>
            <div class="flex items-center gap-4">
                <div class="p-3 bg-blue-50 rounded-xl shadow-sm">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                </div>
                <span class="text-[12px] font-bold tracking-wider uppercase">kominfo@binjaikota.go.id</span>
            </div>
        </div>

        <div class="flex flex-col items-center gap-3 border-t border-slate-100 pt-8 text-center">
            <p class="text-slate-400 text-[10px] font-extrabold uppercase tracking-[0.4em]">
                © 2026 Pemerintah Kota Binjai
            </p>
            <div class="flex items-center gap-4 text-slate-400 text-[9px] font-bold uppercase tracking-widest">
                <span>Dinas Komunikasi dan Informatika</span>
                <span class="text-blue-300 font-black">/</span>
                <span>All Rights Reserved</span>
            </div>
        </div>
    </div>
</footer>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const mediumSwal = {
            width: '28rem',
            padding: '1.25rem',
            customClass: {
                title: 'text-xl font-bold',
                htmlContainer: 'text-sm font-medium'
            }
        };

        @if(session('success'))
            Swal.fire({
                ...mediumSwal,
                title: "Berhasil!",
                text: "{{ session('success') }}",
                icon: "success",
                confirmButtonColor: "#0066cc",
                confirmButtonText: "Selesai"
            });
        @endif

        @if($errors->any())
            Swal.fire({
                ...mediumSwal,
                title: "Opps!",
                text: "{{ $errors->first() }}",
                icon: "error",
                confirmButtonColor: "#d33",
                confirmButtonText: "Perbaiki"
            });
        @endif
    });
</script>

</body>
</html>