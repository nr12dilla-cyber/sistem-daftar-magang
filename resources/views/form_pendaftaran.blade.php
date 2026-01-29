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
        :root { 
            --blue-primary: #1e5a8e; 
            --blue-dark: #15436b; 
            --blue-darker: #0d2f4d;
        }
        
        body { 
            font-family: 'Inter', sans-serif; 
            background: #f5f7fa;
            min-height: 100vh;
        }
        
        h1, h2, label, button { font-family: 'Poppins', sans-serif; }
        
        .nav-custom { 
            background: white;
            border-bottom: 1px solid #e9ecef; 
            position: sticky; 
            top: 0; 
            z-index: 50; 
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
        }
        
        .card-combined { 
            background: white; 
            border-radius: 24px; 
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.08); 
            overflow: hidden; 
            border: 1px solid #f1f3f5;
        }
        
        .header-gradient { 
            background: linear-gradient(135deg, #1e5a8e 0%, #15436b 100%); 
            padding: 2.5rem 1rem; 
            text-align: center; 
        }
        
        .circle-logo-wrapper { 
            background: white; 
            border-radius: 50%; 
            display: inline-flex; 
            align-items: center; 
            justify-content: center; 
            width: 85px; 
            height: 85px; 
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2); 
            border: 4px solid rgba(255, 255, 255, 0.3); 
            margin-bottom: 1rem; 
        }
        
        .form-input, .form-select { 
            width: 100%; 
            background-color: #f8f9fa; 
            border: 2px solid #e9ecef; 
            border-radius: 12px; 
            padding: 0.875rem 1.125rem; 
            transition: all 0.2s ease; 
        }
        
        .form-input:focus { 
            border-color: #1e5a8e; 
            outline: none; 
            background-color: white; 
            box-shadow: 0 0 0 3px rgba(30, 90, 142, 0.1); 
        }
        
        .submit-button { 
            background: linear-gradient(135deg, #1e5a8e 0%, #15436b 100%); 
            color: white; 
            font-weight: 700; 
            padding: 1.125rem; 
            border-radius: 12px; 
            width: 100%; 
            transition: 0.2s; 
            box-shadow: 0 4px 15px rgba(30, 90, 142, 0.4); 
        }
        
        .submit-button:hover { 
            transform: translateY(-2px); 
            box-shadow: 0 6px 20px rgba(30, 90, 142, 0.5); 
        }
        
        /* Cek Status di Sudut */
        .cek-status-corner {
            position: fixed;
            top: 100px;
            right: 20px;
            z-index: 40;
            background: white;
            border-radius: 16px;
            padding: 20px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            border: 1px solid #f1f3f5;
            max-width: 320px;
        }
        
        .btn-check-status {
            background: linear-gradient(135deg, #1e5a8e 0%, #15436b 100%);
            color: white;
            font-weight: 700;
            padding: 10px 16px;
            border-radius: 10px;
            font-size: 0.75rem;
            letter-spacing: 0.5px;
            width: 100%;
            transition: all 0.2s;
            box-shadow: 0 4px 12px rgba(30, 90, 142, 0.3);
        }
        
        .btn-check-status:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(30, 90, 142, 0.4);
        }
        
        @media (max-width: 768px) {
            .cek-status-corner {
                position: relative;
                top: 0;
                right: 0;
                max-width: 100%;
                margin: 20px auto;
            }
        }
    </style>
</head>
<body class="flex flex-col">

<nav class="nav-custom">
    <div class="w-full px-6 md:px-10 py-4 flex justify-between items-center">
        <div class="flex items-center gap-3">
            <img src="{{ asset('images/logobinjai.png') }}" alt="Logo" class="h-10 w-auto">
            <div class="flex flex-col text-left">
                <p class="font-extrabold text-slate-800 leading-none">DISKOMINFO</p>
                <p class="text-[10px] font-bold text-blue-600 tracking-widest uppercase">Kota Binjai</p>
            </div>
        </div>
        <a href="{{ url('/') }}" class="bg-blue-50 text-blue-700 px-5 py-2 rounded-lg text-sm font-bold border border-blue-100 hover:bg-blue-100 transition">← Beranda</a>
    </div>
</nav>

<!-- Cek Status di Sudut Kanan (Desktop) / Atas Form (Mobile) -->
<div class="cek-status-corner">
    <h2 class="text-sm font-bold text-slate-800 flex items-center gap-2 mb-3">
        <span class="text-lg">🔍</span> Cek Status Pendaftaran
    </h2>
    <form action="{{ url()->current() }}" method="GET" class="space-y-2">
        <input type="email" name="email_cek" required placeholder="Email anda..." class="form-input text-sm">
        <button type="submit" class="btn-check-status">
            PERIKSA STATUS
        </button>
    </form>
</div>

<main class="flex-grow flex items-center justify-center px-4 py-10">
    <div class="max-w-4xl w-full card-combined">
        <div class="header-gradient text-white flex flex-col items-center">
            <div class="circle-logo-wrapper">
                <img src="{{ asset('images/logobinjai.png') }}" alt="Logo Binjai" class="h-12 w-auto">
            </div>
            <h1 class="text-2xl md:text-3xl font-black mb-1 tracking-tight">Pendaftaran Magang Online</h1>
            <p class="text-blue-100 text-[10px] md:text-xs opacity-90 tracking-wide">Data Center Diskominfo Kota Binjai</p>
        </div>

        <div class="p-8 md:p-12 space-y-10">

            <div class="relative">
                <div class="absolute inset-0 flex items-center" aria-hidden="true"><div class="w-full border-t border-slate-200"></div></div>
                <div class="relative flex justify-center"><span class="bg-white px-4 text-xs font-bold text-slate-400 uppercase tracking-widest">Formulir Pendaftaran</span></div>
            </div>

            <form action="{{ route('pendaftaran.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div class="md:col-span-2">
                        <label class="text-[10px] font-bold text-slate-500 uppercase mb-2 block tracking-widest">Nama Lengkap Ketua Kelompok</label>
                        <input type="text" name="nama" value="{{ old('nama') }}" required class="form-input" placeholder="Masukkan nama lengkap">
                    </div>
                    
                    <div>
                        <label class="text-[10px] font-bold text-slate-500 uppercase mb-2 block tracking-widest">Email Aktif</label>
                        <input type="email" name="email" value="{{ old('email') }}" required class="form-input" placeholder="email@instansi.com">
                    </div>

                    <div>
                        <label class="text-[10px] font-bold text-slate-500 uppercase mb-2 block tracking-widest">Nomor WhatsApp</label>
                        <input type="tel" name="nomor_wa" value="{{ old('nomor_wa') }}" required class="form-input" placeholder="08xxxxxxxxxx">
                    </div>

                    <div class="md:col-span-2">
                        <label class="text-[10px] font-bold text-slate-500 uppercase mb-2 block tracking-widest">Asal Sekolah / Kampus</label>
                        <input type="text" name="asal_sekolah" value="{{ old('asal_sekolah') }}" required class="form-input" placeholder="Contoh: Universitas Sumatera Utara">
                    </div>

                    <div>
                        <label class="text-[10px] font-bold text-slate-500 uppercase mb-2 block tracking-widest">Bidang Magang</label>
                        <select name="posisi" required class="form-select text-sm">
                            <option value="">Pilih Bidang...</option>
                            <option {{ old('posisi') == 'IKP (Informasi Komunikasi Publik)' ? 'selected' : '' }}>IKP (Informasi Komunikasi Publik)</option>
                            <option {{ old('posisi') == 'APTIKA (Aplikasi Informatika)' ? 'selected' : '' }}>APTIKA (Aplikasi Informatika)</option>
                            <option {{ old('posisi') == 'Statistik & Persandian' ? 'selected' : '' }}>Statistik & Persandian</option>
                        </select>
                    </div>

                    <div>
                        <label class="text-[10px] font-bold text-slate-500 uppercase mb-2 block tracking-widest">Jumlah Personil (Maks. 10)</label>
                        <input type="number" id="jumlah_anggota" name="jumlah_anggota" min="1" max="10" value="{{ old('jumlah_anggota', 1) }}" required class="form-input">
                    </div>

                    <div class="md:col-span-2 p-6 bg-slate-50 rounded-2xl border-2 border-slate-100 border-dashed space-y-6">
                        <div class="space-y-3">
                            <label class="text-[10px] font-bold text-slate-400 block uppercase tracking-widest text-center">Pas Foto Anggota (Portrait 4x6)</label>
                            <div id="container-foto-dinamis" class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-3 p-1"></div>
                        </div>

                        <div class="w-full border-t border-slate-200"></div>

                        <div class="space-y-3">
                            <label class="text-[10px] font-bold text-slate-400 block uppercase tracking-widest text-center">Surat Pengantar Instansi (PDF)</label>
                            <div id="preview-pdf-container" class="hidden max-w-sm mx-auto">
                                <div class="flex items-center justify-between p-3 bg-white rounded-xl border border-red-100 shadow-sm mb-2">
                                    <div class="flex items-center gap-3">
                                        <div class="bg-red-500 text-white px-2 py-1 rounded text-[8px] font-bold uppercase">PDF</div>
                                        <span id="pdf-name" class="text-[10px] font-bold text-slate-700 truncate max-w-[120px]">file.pdf</span>
                                    </div>
                                    <button type="button" id="btn-view-pdf" class="text-[8px] bg-blue-50 text-blue-600 font-bold px-3 py-1.5 rounded-lg border border-blue-100">LIHAT</button>
                                </div>
                            </div>
                            <input type="file" name="surat" id="input-pdf" accept=".pdf" required class="text-[10px] text-slate-500 block w-full file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-[10px] file:font-bold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                        </div>
                    </div>
                </div>

                <button type="submit" class="submit-button">
                    Kirim Pendaftaran Sekarang →
                </button>
            </form>
        </div>
    </div>
</main>

<footer class="py-8 mt-auto">
    <p class="text-slate-400 text-[9px] font-bold text-center uppercase tracking-[0.3em]">
        © 2026 DISKOMINFO KOTA BINJAI
    </p>
</footer>

<script>
    // --- KODE GENERATOR FORM FOTO & PDF ---
    const inputJumlah = document.getElementById('jumlah_anggota');
    const containerFoto = document.getElementById('container-foto-dinamis');

    function generatePhotoSlots() {
        const jumlah = parseInt(inputJumlah.value) || 1;
        containerFoto.innerHTML = ''; 
        for (let i = 0; i < jumlah; i++) {
            const slot = document.createElement('div');
            slot.id = `slot-container-${i}`;
            slot.className = "relative h-32 bg-white rounded-xl border-2 border-slate-200 border-dashed hover:border-blue-400 transition-all cursor-pointer overflow-hidden flex flex-col items-center justify-center";
            slot.innerHTML = `
                <img id="prev-img-${i}" class="absolute inset-0 w-full h-full object-cover hidden z-10">
                <button type="button" id="btn-delete-${i}" onclick="removePhoto(event, ${i})" class="absolute top-1 right-1 z-40 bg-red-500 text-white w-5 h-5 rounded-md shadow flex items-center justify-center hidden"><span class="text-[8px]">✕</span></button>
                <div id="placeholder-icon-${i}" class="text-center z-0">
                    <span class="text-lg">👤</span>
                    <p class="text-[7px] font-bold text-slate-400 uppercase tracking-tighter">Anggota ${i + 1}</p>
                </div>
                <input type="file" name="foto[]" id="file-input-${i}" accept="image/*" required class="absolute inset-0 opacity-0 cursor-pointer z-20" onchange="previewIndividualPhoto(this, ${i})">
            `;
            containerFoto.appendChild(slot);
        }
    }

    function previewIndividualPhoto(input, index) {
        const [file] = input.files;
        if (file) {
            const img = document.getElementById(`prev-img-${index}`);
            const icon = document.getElementById(`placeholder-icon-${index}`);
            const btnDel = document.getElementById(`btn-delete-${index}`);
            const container = document.getElementById(`slot-container-${index}`);
            img.src = URL.createObjectURL(file);
            img.classList.remove('hidden');
            icon.classList.add('hidden');
            btnDel.classList.remove('hidden');
            container.classList.replace('border-dashed', 'border-solid');
            container.classList.add('border-blue-500');
        }
    }

    function removePhoto(event, index) {
        event.preventDefault();
        event.stopPropagation();
        const input = document.getElementById(`file-input-${index}`);
        const img = document.getElementById(`prev-img-${index}`);
        const icon = document.getElementById(`placeholder-icon-${index}`);
        const btnDel = document.getElementById(`btn-delete-${index}`);
        const container = document.getElementById(`slot-container-${index}`);
        input.value = ""; img.src = "";
        img.classList.add('hidden');
        icon.classList.remove('hidden');
        btnDel.classList.add('hidden');
        container.classList.replace('border-solid', 'border-dashed');
        container.classList.remove('border-blue-500');
    }

    inputJumlah.addEventListener('input', generatePhotoSlots);
    window.addEventListener('DOMContentLoaded', generatePhotoSlots);

    const inputPdf = document.getElementById('input-pdf');
    const pdfNameDisplay = document.getElementById('pdf-name');
    const previewPdfContainer = document.getElementById('preview-pdf-container');
    const btnViewPdf = document.getElementById('btn-view-pdf');
    let pdfUrl = null;

    inputPdf.onchange = () => {
        const [file] = inputPdf.files;
        if (file) {
            pdfNameDisplay.innerText = file.name;
            previewPdfContainer.classList.remove('hidden');
            if (pdfUrl) URL.revokeObjectURL(pdfUrl);
            pdfUrl = URL.createObjectURL(file);
        }
    }
    btnViewPdf.onclick = () => { if (pdfUrl) window.open(pdfUrl, '_blank'); }

    // --- KODE NOTIFIKASI SWEETALERT (CEK STATUS, SUKSES, ERROR) ---
    @if($statusCari)
        @if($hasilCek)
            Swal.fire({
                icon: 'info',
                title: 'Status Pendaftaran',
                html: '<div class="p-6 bg-slate-50 rounded-2xl border-2 border-slate-100 text-left">' +
                      '<p class="text-sm text-slate-500 mb-2">Email: <b>{{ $hasilCek->email }}</b></p>' +
                      '<p class="text-[10px] uppercase font-bold text-blue-600 tracking-widest mb-1">Status Anda Saat Ini:</p>' +
                      '<b class="text-3xl text-slate-800 uppercase font-black tracking-tight">{{ $hasilCek->status }}</b>' +
                      '</div>',
                confirmButtonColor: '#1e5a8e'
            });
        @else
            Swal.fire({
                icon: 'error',
                title: 'Tidak Terdaftar',
                text: 'Maaf, email "{{ request('email_cek') }}" tidak ditemukan dalam sistem.',
                confirmButtonColor: '#ef4444'
            });
        @endif
        
        // Membersihkan URL agar notifikasi tidak muncul lagi saat refresh
        if (typeof window.history.replaceState == 'function') {
            window.history.replaceState({}, document.title, window.location.pathname);
        }
    @endif

    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: "{{ session('success') }}",
            confirmButtonColor: '#10b981'
        });
    @endif

    @if($errors->any())
        Swal.fire({
            icon: 'warning',
            title: 'Pendaftaran Gagal',
            text: "{{ $errors->first() }}",
            confirmButtonColor: '#f59e0b'
        });
    @endif
</script>

</body>
</html>