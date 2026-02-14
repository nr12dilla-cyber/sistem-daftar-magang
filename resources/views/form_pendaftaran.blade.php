<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Akun Magang - Diskominfo Binjai</title>
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
        .form-input { width: 100%; background-color: #f8f9fa; border: 2px solid #e9ecef; border-radius: 12px; padding: 0.875rem 1.125rem; transition: all 0.2s ease; font-size: 0.875rem; }
        .form-input:focus { border-color: var(--blue-primary); outline: none; background-color: white; box-shadow: 0 0 0 4px rgba(30, 90, 142, 0.08); }
        .submit-button { background: linear-gradient(135deg, #1e5a8e 0%, #15436b 100%); color: white; font-weight: 700; padding: 1.125rem; border-radius: 14px; width: 100%; transition: 0.3s; box-shadow: 0 4px 15px rgba(30, 90, 142, 0.3); display: flex; align-items: center; justify-content: center; gap: 8px; }
        .submit-button:hover { transform: translateY(-2px); box-shadow: 0 8px 25px rgba(30, 90, 142, 0.4); }
        .submit-button:disabled { opacity: 0.7; cursor: not-allowed; transform: none; }
        .section-title-badge { background: #f1f5f9; color: #64748b; padding: 6px 16px; border-radius: 50px; font-size: 10px; font-weight: 800; text-transform: uppercase; letter-spacing: 1px; }
        .foto-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); gap: 1rem; }
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
            <h1 class="text-2xl md:text-4xl font-black mb-2 tracking-tight">Formulir Pendaftaran Magang</h1>
            <p class="text-blue-100 text-xs md:text-sm opacity-80 font-medium">Lengkapi data diri dan berkas untuk verifikasi</p>
        </div>

        <div class="p-8 md:p-12">
            <form action="{{ route('pendaftaran.store') }}" method="POST" enctype="multipart/form-data" id="formPendaftaran">
                @csrf
                
                <div class="space-y-6">
                    <div class="flex items-center gap-4">
                        <span class="section-title-badge">Informasi Akun</span>
                        <div class="h-[1px] bg-slate-100 flex-grow"></div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="md:col-span-2">
                            <label class="text-[11px] font-bold text-slate-500 uppercase mb-2 block tracking-wider">Nama Lengkap Ketua</label>
                            <input type="text" name="name" id="nama_ketua" value="{{ old('name') }}" required class="form-input" placeholder="Masukkan nama lengkap Anda" oninput="sinkronNamaKetua()">
                        </div>
                        <div>
                            <label class="text-[11px] font-bold text-slate-500 uppercase mb-2 block tracking-wider">Email Utama</label>
                            <input type="email" name="email" value="{{ old('email') }}" required class="form-input" placeholder="contoh@mail.com">
                        </div>
                        <div>
                            <label class="text-[11px] font-bold text-slate-500 uppercase mb-2 block tracking-wider">Nomor WhatsApp</label>
                            <input type="text" id="input_wa" name="phone" value="{{ old('phone') }}" required class="form-input" placeholder="08xxxxxxxxxx">
                        </div>
                        <div>
                            <label class="text-[11px] font-bold text-slate-500 uppercase mb-2 block tracking-wider">Kata Sandi</label>
                            <input type="password" name="password" required class="form-input" placeholder="Minimal 8 karakter">
                        </div>
                        <div>
                            <label class="text-[11px] font-bold text-slate-500 uppercase mb-2 block tracking-wider">Konfirmasi Kata Sandi</label>
                            <input type="password" name="password_confirmation" required class="form-input" placeholder="Ulangi kata sandi">
                        </div>
                    </div>
                </div>

                <div class="space-y-6 mt-8">
                    <div class="flex items-center gap-4">
                        <span class="section-title-badge">Detail Magang</span>
                        <div class="h-[1px] bg-slate-100 flex-grow"></div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="md:col-span-2">
                            <label class="text-[11px] font-bold text-slate-500 uppercase mb-2 block tracking-wider">Asal Sekolah / Universitas</label>
                            <input type="text" name="asal_sekolah" value="{{ old('asal_sekolah') }}" required class="form-input" placeholder="Contoh: Universitas Sumatera Utara">
                        </div>
                        <div>
                            <label class="text-[11px] font-bold text-slate-500 uppercase mb-2 block tracking-wider">Bidang Yang Diminati</label>
                            <select name="posisi" required class="form-input">
                                <option value="">Pilih Bidang</option>
                                <option value="Aplikasi & Informatika (APTIKA)">Aplikasi & Informatika (APTIKA)</option>
                                <option value="Informasi & Komunikasi Publik (IKP)">Informasi & Komunikasi Publik (IKP)</option>
                                <option value="Statistik & Persandian">Statistik & Persandian</option>
                            </select>
                        </div>
                        <div>
                            <label class="text-[11px] font-bold text-slate-500 uppercase mb-2 block tracking-wider">Jumlah Anggota Kelompok</label>
                            <input type="number" id="input_jumlah" name="jumlah_anggota" value="{{ old('jumlah_anggota', 1) }}" required class="form-input" min="1" max="5">
                            <p class="text-[9px] text-blue-500 mt-1">*Maksimal 5 anggota (termasuk ketua)</p>
                        </div>
                    </div>
                </div>

                <div class="space-y-6 mt-8">
                    <div class="flex items-center gap-4">
                        <span class="section-title-badge">Berkas & Data Anggota</span>
                        <div class="h-[1px] bg-slate-100 flex-grow"></div>
                    </div>
                    
                    <div class="grid grid-cols-1 gap-6">
                        <div>
                            <label class="text-[11px] font-bold text-slate-500 uppercase mb-2 block tracking-wider">Surat Pengantar (PDF)</label>
                            <div class="flex gap-2">
                                <input type="file" name="surat" id="input_surat" required class="form-input text-xs flex-grow" accept=".pdf">
                                <button type="button" id="btn_preview_pdf" class="hidden bg-blue-50 text-blue-600 border border-blue-200 px-6 rounded-xl text-[10px] font-black uppercase hover:bg-blue-100 transition">
                                    LIHAT
                                </button>
                            </div>
                            <p class="text-[9px] text-slate-400 mt-1">*Format PDF, Maks 2MB</p>
                        </div>

                        <div>
                            <label class="text-[11px] font-bold text-slate-500 uppercase mb-4 block tracking-wider">Data Diri & Foto Anggota</label>
                            <div id="container_foto" class="foto-grid"></div>
                            <p class="text-[9px] text-slate-400 mt-3">*Format JPG/PNG, Maks 2MB per file</p>
                        </div>
                    </div>
                </div>

                <div class="pt-8">
                    <button type="submit" class="submit-button" id="btnSubmit">
                        <span>KIRIM PENDAFTARAN SEKARANG →</span>
                    </button>
                </div>
            </form> </div>
    </div>
</main>

<div id="modal_pdf" class="fixed inset-0 z-[100] hidden items-center justify-center p-4 bg-black/60 backdrop-blur-sm">
    <div class="bg-white w-full max-w-4xl rounded-2xl overflow-hidden shadow-2xl">
        <div class="flex justify-between items-center px-6 py-4 border-b bg-slate-50">
            <h3 class="text-xs font-black text-slate-800 uppercase tracking-widest">Pratinjau Surat Pengantar</h3>
            <button type="button" id="close_modal" class="text-slate-400 hover:text-red-500 text-2xl font-bold leading-none">&times;</button>
        </div>
        <div class="p-2 bg-slate-100">
            <iframe id="pdf_viewer" class="w-full h-[70vh] rounded-lg shadow-inner" src=""></iframe>
        </div>
        <div class="p-4 flex justify-end bg-white border-t">
            <button type="button" id="btn_hapus_pdf" class="bg-red-50 text-red-600 px-5 py-2 rounded-xl text-[10px] font-bold uppercase hover:bg-red-100 transition">Hapus & Ganti File</button>
        </div>
    </div>
</div>

<script>
    const inputJumlah = document.getElementById('input_jumlah');
    const inputWA = document.getElementById('input_wa');
    const containerFoto = document.getElementById('container_foto');
    const form = document.getElementById('formPendaftaran');
    const btnSubmit = document.getElementById('btnSubmit');
    const namaKetuaInput = document.getElementById('nama_ketua');

    function sinkronNamaKetua() {
        const inputNama1 = document.getElementById('nama_anggota_1');
        if (inputNama1) {
            inputNama1.value = namaKetuaInput.value;
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        @if(session('success'))
            Swal.fire({ icon: 'success', title: 'Berhasil!', text: "{{ session('success') }}", confirmButtonColor: '#1e5a8e' });
        @endif

        @if(session('error'))
            Swal.fire({ icon: 'error', title: 'Gagal!', text: "{{ session('error') }}", confirmButtonColor: '#d33' });
        @endif
    });

    const inputSurat = document.getElementById('input_surat');
    const btnPreview = document.getElementById('btn_preview_pdf');
    const modalPdf = document.getElementById('modal_pdf');
    const pdfViewer = document.getElementById('pdf_viewer');
    const closeModal = document.getElementById('close_modal');
    const btnHapusPdf = document.getElementById('btn_hapus_pdf');

    inputSurat.addEventListener('change', function() {
        const file = this.files[0];
        if (file && file.type === "application/pdf") {
            const fileURL = URL.createObjectURL(file);
            pdfViewer.src = fileURL;
            btnPreview.classList.remove('hidden');
        } else if (file) {
            Swal.fire({ icon: 'error', title: 'Format Salah', text: 'Pilih file berformat PDF' });
            this.value = '';
            btnPreview.classList.add('hidden');
        }
    });

    btnPreview.addEventListener('click', () => {
        modalPdf.classList.remove('hidden');
        modalPdf.classList.add('flex');
    });

    const tutupModal = () => {
        modalPdf.classList.add('hidden');
        modalPdf.classList.remove('flex');
    };

    closeModal.addEventListener('click', tutupModal);

    btnHapusPdf.addEventListener('click', () => {
        inputSurat.value = '';
        pdfViewer.src = '';
        btnPreview.classList.add('hidden');
        tutupModal();
    });

    inputJumlah.addEventListener('input', function() {
        let val = parseInt(this.value);
        if (val > 5) this.value = 5;
        if (val < 1) this.value = 1;
        updateFotoInputs();
    });

    inputWA.addEventListener('input', function() {
        this.value = this.value.replace(/[^0-9]/g, '');
    });

    function updateFotoInputs() {
        const jumlah = parseInt(inputJumlah.value) || 1;
        containerFoto.innerHTML = '';
        for (let i = 1; i <= jumlah; i++) {
            const div = document.createElement('div');
            div.className = 'flex flex-col gap-3 p-4 bg-white border border-slate-200 rounded-2xl hover:border-blue-300 transition-all shadow-sm';
            
            const labelText = (i === 1) ? 'Ketua Kelompok' : `Anggota ${i}`;
            const readonlyAttr = (i === 1) ? 'readonly' : '';
            const namaValue = (i === 1) ? namaKetuaInput.value : '';

            div.innerHTML = `
                <div class="flex justify-between items-center mb-1">
                    <span class="text-[10px] font-black text-blue-600 uppercase tracking-widest">${labelText}</span>
                    <button type="button" id="hapus_foto_${i}" onclick="resetSatuFoto(${i})" class="hidden text-red-500 text-[9px] font-bold uppercase hover:underline">Ganti Foto</button>
                </div>
                
                <div class="space-y-2">
                    <label class="text-[9px] font-bold text-slate-400 uppercase tracking-wider">Nama Lengkap</label>
                    <input type="text" name="nama_anggota[]" id="nama_anggota_${i}" value="${namaValue}" ${readonlyAttr} required 
                           class="form-input !py-2 !text-xs bg-slate-50" placeholder="Nama Lengkap ${labelText}">
                </div>

                <div class="space-y-2">
                    <label class="text-[9px] font-bold text-slate-400 uppercase tracking-wider">Pas Foto</label>
                    <div id="preview_wrapper_${i}" class="hidden w-full h-40 rounded-lg border border-slate-200 overflow-hidden bg-slate-100 mb-1 shadow-inner">
                        <img id="img_preview_${id = i}" class="w-full h-full object-cover">
                    </div>
                    <input type="file" name="foto[]" id="file_input_${i}" required 
                           onchange="prosesPreview(this, ${i})"
                           class="text-[10px] file:mr-2 file:py-1.5 file:px-3 file:rounded-xl file:border-0 file:bg-blue-600 file:text-white file:font-bold cursor-pointer block w-full" 
                           accept="image/*">
                </div>
            `;
            containerFoto.appendChild(div);
        }
    }

    window.prosesPreview = function(input, id) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById(`img_preview_${id}`).src = e.target.result;
                document.getElementById(`preview_wrapper_${id}`).classList.remove('hidden');
                document.getElementById(`hapus_foto_${id}`).classList.remove('hidden');
                input.classList.add('hidden');
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    window.resetSatuFoto = function(id) {
        const input = document.getElementById(`file_input_${id}`);
        input.value = '';
        input.classList.remove('hidden');
        document.getElementById(`preview_wrapper_${id}`).classList.add('hidden');
        document.getElementById(`hapus_foto_${id}`).classList.add('hidden');
    }

    updateFotoInputs();

    form.addEventListener('submit', function() {
        btnSubmit.disabled = true;
        btnSubmit.innerHTML = `
            <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            <span>MEMPROSES DATA...</span>
        `;
    });
</script>
</body>
</html>