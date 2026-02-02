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
        :root { --blue-primary: #1e5a8e; --blue-dark: #15436b; }
        body { font-family: 'Inter', sans-serif; background: #f5f7fa; min-height: 100vh; }
        h1, h2, label, button { font-family: 'Poppins', sans-serif; }
        .nav-custom { background: white; border-bottom: 1px solid #e9ecef; position: sticky; top: 0; z-index: 50; box-shadow: 0 2px 8px rgba(0,0,0,0.04); }
        .card-combined { background: white; border-radius: 24px; box-shadow: 0 10px 40px rgba(0, 0, 0, 0.05); overflow: hidden; border: 1px solid #f1f3f5; }
        .header-gradient { background: linear-gradient(135deg, #1e5a8e 0%, #15436b 100%); padding: 3rem 1rem; text-align: center; }
        .circle-logo-wrapper { background: white; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; width: 85px; height: 85px; box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15); margin-bottom: 1.25rem; }
        .form-input, .form-select { width: 100%; background-color: #f8f9fa; border: 2px solid #e9ecef; border-radius: 12px; padding: 0.875rem 1.125rem; transition: all 0.2s ease; font-size: 0.875rem; }
        .form-input:focus { border-color: var(--blue-primary); outline: none; background-color: white; box-shadow: 0 0 0 4px rgba(30, 90, 142, 0.08); }
        .submit-button { background: linear-gradient(135deg, #1e5a8e 0%, #15436b 100%); color: white; font-weight: 700; padding: 1.125rem; border-radius: 14px; width: 100%; transition: 0.3s; box-shadow: 0 4px 15px rgba(30, 90, 142, 0.3); }
        .submit-button:hover { transform: translateY(-2px); box-shadow: 0 8px 25px rgba(30, 90, 142, 0.4); }
        .section-title-badge { background: #f1f5f9; color: #64748b; padding: 6px 16px; border-radius: 50px; font-size: 10px; font-weight: 800; text-transform: uppercase; letter-spacing: 1px; }
    </style>
</head>
<body class="flex flex-col">

<nav class="nav-custom">
    <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
        <div class="flex items-center gap-3">
            <img src="{{ asset('images/logobinjai.png') }}" alt="Logo" class="h-10 w-auto">
            <div class="flex flex-col">
                <p class="font-black text-slate-800 leading-none text-lg">DISKOMINFO</p>
                <p class="text-[10px] font-bold text-blue-600 tracking-[0.2em] uppercase">Kota Binjai</p>
            </div>
        </div>
        <a href="{{ url('/') }}" class="bg-slate-50 text-slate-600 px-4 py-2 rounded-xl text-xs font-bold border border-slate-200 hover:bg-slate-100 transition">← KEMBALI</a>
    </div>
</nav>

<main class="flex-grow flex items-center justify-center px-4 py-12">
    <div class="max-w-4xl w-full card-combined">
        <div class="header-gradient text-white flex flex-col items-center">
            <div class="circle-logo-wrapper">
                <img src="{{ asset('images/logobinjai.png') }}" alt="Logo Binjai" class="h-12 w-auto">
            </div>
            <h1 class="text-2xl md:text-4xl font-black mb-2 tracking-tight">Portal Magang Online</h1>
            <p class="text-blue-100 text-xs md:text-sm opacity-80 font-medium">Lengkapi formulir di bawah untuk bergabung bersama kami</p>
        </div>

        <div class="p-8 md:p-12">
            <div class="bg-blue-50/50 border border-blue-100 rounded-3xl p-6 md:p-8 mb-12">
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
                    <div class="max-w-xs">
                        <h2 class="text-lg font-extrabold text-blue-900 flex items-center gap-2"><span>🔍</span> Cek Status</h2>
                        <p class="text-xs text-blue-700/70 mt-1 font-medium">Sudah mendaftar? Periksa progres data Anda di sini.</p>
                    </div>
                    <form action="{{ url()->current() }}" method="GET" class="flex flex-col sm:flex-row gap-2 flex-grow max-w-md">
                        <input type="email" name="email_cek" required placeholder="Masukkan email terdaftar..." class="form-input border-blue-200 focus:border-blue-500 bg-white">
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl font-bold text-xs transition-all whitespace-nowrap shadow-lg shadow-blue-200">CEK DATA</button>
                    </form>
                </div>
            </div>

            <div class="space-y-8">
                <div class="flex items-center gap-4">
                    <span class="section-title-badge">Formulir Pendaftaran</span>
                    <div class="h-[1px] bg-slate-100 flex-grow"></div>
                </div>

                <form action="{{ route('pendaftaran.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="md:col-span-2">
                            <label class="text-[11px] font-bold text-slate-500 uppercase mb-2 block tracking-wider">Nama Lengkap Ketua Kelompok</label>
                            <input type="text" name="nama" value="{{ old('nama') }}" required class="form-input" placeholder="Nama sesuai identitas">
                        </div>
                        
                        <div>
                            <label class="text-[11px] font-bold text-slate-500 uppercase mb-2 block tracking-wider">Email Aktif</label>
                            <input type="email" name="email" value="{{ old('email') }}" required class="form-input" placeholder="contoh@mail.com">
                        </div>
                        <div>
                            <label class="text-[11px] font-bold text-slate-500 uppercase mb-2 block tracking-wider">Nomor WhatsApp</label>
                            <input type="text" id="nomor_wa" name="nomor_wa" value="{{ old('nomor_wa') }}" required 
                                   class="form-input" placeholder="08XX-XXXX-XXXX-XX" maxlength="15">
                        </div>
                        <div class="md:col-span-2">
                            <label class="text-[11px] font-bold text-slate-500 uppercase mb-2 block tracking-wider">Asal Instansi Pendidikan</label>
                            <input type="text" name="asal_sekolah" value="{{ old('asal_sekolah') }}" required class="form-input" placeholder="Nama Universitas / Sekolah">
                        </div>
                        <div>
                            <label class="text-[11px] font-bold text-slate-500 uppercase mb-2 block tracking-wider">Pilihan Bidang</label>
                            <select name="posisi" required class="form-select">
                                <option value="">Pilih Bidang...</option>
                                <option value="IKP (Informasi Komunikasi Publik)" {{ old('posisi') == 'IKP (Informasi Komunikasi Publik)' ? 'selected' : '' }}>IKP (Informasi Komunikasi Publik)</option>
                                <option value="APTIKA (Aplikasi Informatika)" {{ old('posisi') == 'APTIKA (Aplikasi Informatika)' ? 'selected' : '' }}>APTIKA (Aplikasi Informatika)</option>
                                <option value="Statistik & Persandian" {{ old('posisi') == 'Statistik & Persandian' ? 'selected' : '' }}>Statistik & Persandian</option>
                            </select>
                        </div>
                        <div>
                            <label class="text-[11px] font-bold text-slate-500 uppercase mb-2 block tracking-wider">Jumlah Anggota</label>
                            <input type="number" id="jumlah_anggota" name="jumlah_anggota" min="1" max="10" value="{{ old('jumlah_anggota', 1) }}" required class="form-input">
                        </div>

                        <div class="md:col-span-2 p-8 bg-slate-50 rounded-3xl border-2 border-slate-200 border-dashed space-y-8">
                            
                            <div class="space-y-4">
                                <div class="text-center">
                                    <label class="text-xs font-bold text-slate-500 block uppercase tracking-widest">Unggah Pas Foto Anggota (4x6)</label>
                                    <p class="text-[9px] text-blue-500 font-bold mt-1 uppercase tracking-tight">* JPG, PNG, JPEG | Maksimal 5MB per file</p>
                                </div>
                                <div id="container-foto-dinamis" class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4"></div>
                            </div>

                            <div class="h-[1px] bg-slate-200"></div>

                            <div class="space-y-4">
                                <div class="text-left">
                                    <label class="text-xs font-bold text-slate-500 block uppercase tracking-widest">Surat Pengantar Instansi (PDF)</label>
                                    <p class="text-[9px] text-red-500 font-bold mt-1 uppercase tracking-tight">* Wajib format PDF | Maksimal 5MB</p>
                                </div>
                                
                                <div id="preview-pdf-container" class="hidden w-full flex justify-start">
                                    <div class="flex items-center gap-3 p-3 bg-white rounded-2xl border border-blue-100 shadow-sm mb-3 w-fit">
                                        <div class="flex items-center gap-3 border-r border-slate-100 pr-3">
                                            <div class="bg-red-500 text-white px-2 py-1 rounded-lg text-[10px] font-black uppercase">PDF</div>
                                            <span id="pdf-name" class="text-xs font-bold text-slate-600 truncate max-w-[150px]">file.pdf</span>
                                        </div>
                                        <button type="button" id="btn-view-pdf" class="text-[10px] bg-blue-50 text-blue-600 font-bold px-4 py-2 rounded-xl border border-blue-100 hover:bg-blue-100 transition">PRATINJAU</button>
                                    </div>
                                </div>
                                <input type="file" name="surat" id="input-pdf" accept=".pdf" required class="text-xs text-slate-400 block w-full file:mr-4 file:py-2 file:px-6 file:rounded-full file:border-0 file:text-xs file:font-bold file:bg-blue-600 file:text-white hover:file:bg-blue-700 cursor-pointer">
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="submit-button mt-4">KIRIM PENDAFTARAN SEKARANG →</button>
                </form>
            </div>
        </div>
    </div>
</main>

<footer class="py-10">
    <p class="text-slate-400 text-[10px] font-bold text-center uppercase tracking-[0.4em]">© 2026 DISKOMINFO KOTA BINJAI</p>
</footer>

<script>
    // --- FORMAT OTOMATIS NOMOR WHATSAPP ---
    const inputWA = document.getElementById('nomor_wa');
    inputWA.addEventListener('input', function (e) {
        let input = e.target.value.replace(/\D/g, '');
        if (input.length > 13) input = input.substring(0, 13);
        let formatted = "";
        for (let i = 0; i < input.length; i++) {
            if (i > 0 && i % 4 === 0) formatted += "-";
            formatted += input[i];
        }
        e.target.value = formatted;
    });

    // --- FOTO LOGIC ---
    const inputJumlah = document.getElementById('jumlah_anggota');
    const containerFoto = document.getElementById('container-foto-dinamis');
    function generatePhotoSlots() {
        const jumlah = parseInt(inputJumlah.value) || 1;
        containerFoto.innerHTML = ''; 
        for (let i = 0; i < jumlah; i++) {
            const slot = document.createElement('div');
            slot.className = "relative h-36 bg-white rounded-2xl border-2 border-slate-200 border-dashed hover:border-blue-400 transition-all cursor-pointer overflow-hidden flex flex-col items-center justify-center";
            slot.innerHTML = `
                <img id="prev-img-${i}" class="absolute inset-0 w-full h-full object-cover hidden z-10">
                <div id="placeholder-icon-${i}" class="text-center z-0">
                    <span class="text-xl">👤</span>
                    <p class="text-[8px] font-bold text-slate-400 uppercase mt-1">Anggota ${i + 1}</p>
                </div>
                <input type="file" name="foto[]" accept="image/*" required class="absolute inset-0 opacity-0 cursor-pointer z-20" onchange="previewIndividualPhoto(this, ${i})">
            `;
            containerFoto.appendChild(slot);
        }
    }
    function previewIndividualPhoto(input, index) {
        const [file] = input.files;
        if (file) {
            if(file.size > 5 * 1024 * 1024) {
                Swal.fire('Ukuran Terlalu Besar', 'Maksimal ukuran foto adalah 5MB', 'warning');
                input.value = "";
                return;
            }
            const img = document.getElementById(`prev-img-${index}`);
            const icon = document.getElementById(`placeholder-icon-${index}`);
            img.src = URL.createObjectURL(file);
            img.classList.remove('hidden');
            icon.classList.add('hidden');
        }
    }
    inputJumlah.addEventListener('input', generatePhotoSlots);
    window.addEventListener('DOMContentLoaded', generatePhotoSlots);

    // --- PDF PREVIEW ---
    const inputPdf = document.getElementById('input-pdf');
    const previewPdfContainer = document.getElementById('preview-pdf-container');
    const pdfNameDisplay = document.getElementById('pdf-name');
    const btnViewPdf = document.getElementById('btn-view-pdf');
    let pdfUrl = null;
    inputPdf.onchange = () => {
        const [file] = inputPdf.files;
        if (file) {
            if(file.size > 5 * 1024 * 1024) {
                Swal.fire('Ukuran Terlalu Besar', 'Maksimal ukuran file PDF adalah 5MB', 'warning');
                inputPdf.value = "";
                previewPdfContainer.classList.add('hidden');
                return;
            }
            pdfNameDisplay.innerText = file.name;
            previewPdfContainer.classList.remove('hidden');
            pdfUrl = URL.createObjectURL(file);
        }
    }
    btnViewPdf.onclick = () => { if (pdfUrl) window.open(pdfUrl, '_blank'); }

    // --- SWEETALERT ---
    @if(session('success'))
        Swal.fire({ icon: 'success', title: 'Berhasil!', text: "{{ session('success') }}", confirmButtonColor: '#1e5a8e' });
    @endif
    @if($errors->any())
        Swal.fire({
            icon: 'error',
            title: 'Pendaftaran Gagal',
            html: `<div class="text-left text-xs text-red-600 bg-red-50 p-3 rounded-lg"><ul>@foreach($errors->all() as $error)<li>• {{ $error }}</li>@endforeach</ul></div>`,
            confirmButtonColor: '#1e5a8e'
        });
    @endif
    @if(isset($statusCari) && $statusCari)
        Swal.fire({
            icon: '{{ $hasilCek ? "info" : "error" }}',
            title: 'Status Pendaftaran',
            html: `{!! $hasilCek ? '<div class="p-4 bg-slate-50 rounded-xl text-left border border-slate-200"><p class="text-[10px] text-slate-400 uppercase font-black">Status Sekarang:</p><p class="text-2xl font-black text-slate-800">'.$hasilCek->status.'</p></div>' : 'Email tidak ditemukan.' !!}`,
            confirmButtonColor: '#1e5a8e'
        });
    @endif
</script>
</body>
</html>