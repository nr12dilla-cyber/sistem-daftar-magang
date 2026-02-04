<x-app-layout>
    <style>
        .pagination-wrapper svg { width: 20px !important; height: 20px !important; display: inline-block; }
        .table-responsive { width: 100%; overflow-x: auto; -webkit-overflow-scrolling: touch; }
        .admin-container { background: #f5f7fa; min-height: 100vh; padding: 30px; font-family: 'Inter', sans-serif; }
        .header-section { background: linear-gradient(135deg, #1e5a8e 0%, #15436b 100%); border-radius: 15px; padding: 24px 28px; margin-bottom: 20px; box-shadow: 0 4px 15px rgba(30, 90, 142, 0.2); }
        .header-section h2 { color: white; font-weight: 800; font-size: 22px; margin: 0; }
        .header-section p { color: rgba(255, 255, 255, 0.8); margin: 5px 0 0 0; font-size: 14px; }
        .table-card { background: white; border-radius: 15px; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05); overflow: hidden; }
        th { background: #f8f9fa; padding: 16px 20px; text-align: left; color: #6c757d; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.5px; font-weight: 600; border-bottom: 1px solid #e9ecef; white-space: nowrap; }
        .table-row { border-bottom: 1px solid #f1f3f5; transition: background 0.2s; }
        .table-row:hover { background: #f8f9fa; }

        .dropdown { position: relative; display: inline-block; }
        .drop-btn { background: linear-gradient(135deg, #1e5a8e 0%, #15436b 100%); color: white; border: none; width: 36px; height: 36px; border-radius: 8px; cursor: pointer; display: flex; align-items: center; justify-content: center; font-size: 18px; }
        .dropdown-menu { display: none; position: absolute; right: 0; top: 100%; margin-top: 8px; background: white; min-width: 180px; border-radius: 12px; box-shadow: 0 8px 20px rgba(0,0,0,0.12); border: 1px solid #e9ecef; z-index: 999; padding: 8px; }
        .dropdown.active .dropdown-menu { display: block; }
        .menu-item { display: block; width: 100%; padding: 10px 14px; border: none; background: none; text-align: left; cursor: pointer; border-radius: 8px; text-decoration: none; font-size: 13px; font-weight: 500; color: #444; }
        .menu-item:hover { background: #f8f9fa; }
        
        .status-diterima { background: #d4edda; color: #155724; padding: 5px 12px; border-radius: 8px; font-size: 11px; font-weight: 700; }
        .status-ditolak { background: #f8d7da; color: #721c24; padding: 5px 12px; border-radius: 8px; font-size: 11px; font-weight: 700; }
        .status-pending { background: #fff3cd; color: #856404; padding: 5px 12px; border-radius: 8px; font-size: 11px; font-weight: 700; }

        .profile-img { width: 48px; height: 48px; border-radius: 10px; object-fit: cover; border: 2px solid #e9ecef; }
        .nomor-urut { font-weight: 700; color: #1e5a8e; font-size: 15px; }

        #galleryModal { 
            display:none; position:fixed; z-index:10000; left:0; top:0; width:100%; height:100%; 
            background: rgba(15, 43, 67, 0.85); backdrop-filter: blur(8px); align-items:center; justify-content:center; 
        }
        .modal-content { background: white; width: 95%; max-width: 900px; border-radius: 20px; padding: 25px; position: relative; }
        #galleryContent { display: flex; gap: 20px; overflow-x: auto; padding-bottom: 15px; scroll-behavior: smooth; -webkit-overflow-scrolling: touch; }
        .foto-wrapper { flex: 0 0 300px; text-align: center; }
        .foto-wrapper img { width: 100%; height: 400px; object-fit: cover; border-radius: 12px; border: 3px solid #f0f0f0; }
        .pagination-container { padding: 20px; border-top: 1px solid #eee; display: flex; justify-content: space-between; align-items: center; }
    </style>

    <div class="admin-container">
        @if(session('success'))
            <div style="background: #d4edda; color: #155724; padding: 15px; border-radius: 10px; margin-bottom: 20px; font-weight: 600;">
                {{ session('success') }}
            </div>
        @endif

        <div class="header-section">
            <h2>Data Pendaftar</h2>
            <p>Kelola data pendaftaran Diskominfo Binjai</p>
        </div>
        
        <div class="table-card">
            <div class="table-responsive">
                <table style="width: 100%; border-collapse: collapse; min-width: 850px;">
                    <thead>
                        <tr>
                            <th style="text-align: center; width: 50px;">No</th>
                            <th>Biodata & Instansi</th>
                            <th style="text-align: center;">Anggota</th>
                            <th>Kontak</th>
                            <th>Status</th>
                            <th style="text-align: right; width: 100px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pendaftars as $p)
                        <tr class="table-row">
                            <td style="text-align: center; padding: 15px 10px;">
                                <span class="nomor-urut">{{ ($pendaftars->currentPage() - 1) * $pendaftars->perPage() + $loop->iteration }}</span>
                            </td>
                            <td style="padding: 15px 20px;">
                                @php
                                    $fotoArray = is_array($p->foto) ? $p->foto : json_decode($p->foto, true);
                                    $fotoUtama = ($fotoArray && count($fotoArray) > 0) ? $fotoArray[0] : 'default.jpg';
                                    $jumlahLainnya = ($fotoArray && count($fotoArray) > 1) ? count($fotoArray) - 1 : 0;
                                @endphp
                                <div style="display: flex; gap: 12px; align-items: flex-start;">
                                    <img src="{{ asset('uploads/foto/' . $fotoUtama) }}" class="profile-img" style="cursor: pointer;" onclick="openGallery('{{ addslashes($p->nama) }}', {{ json_encode($fotoArray) }})" onerror="this.src='{{ asset('uploads/foto/default.jpg') }}'">
                                    <div>
                                        <div style="font-weight: 600; color: #2d3748; font-size: 14px;">{{ $p->nama }}</div>
                                        <div style="font-size: 12px; color: #718096;">{{ $p->asal_sekolah }}</div>
                                        @if($jumlahLainnya > 0)
                                            <a href="javascript:void(0)" onclick="openGallery('{{ addslashes($p->nama) }}', {{ json_encode($fotoArray) }})" style="font-size: 11px; color: #1e5a8e; text-decoration: none; font-weight: 700; display: block; margin-top: 4px;">
                                               +{{ $jumlahLainnya }} Foto Lainnya
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td style="text-align: center;"><span style="background:#1e5a8e; color:white; padding:4px 10px; border-radius:12px; font-size:11px; font-weight:600;">{{ $p->jumlah_anggota ?? 1 }} Org</span></td>
                            <td style="padding: 15px 20px; white-space: nowrap;"><div style="font-weight: 600; font-size: 13px;">{{ $p->nomor_wa }}</div><div style="font-size: 11px; color: #718096;">{{ $p->email }}</div></td>
                            <td><span class="{{ $p->status == 'Diterima' ? 'status-diterima' : ($p->status == 'Ditolak' ? 'status-ditolak' : 'status-pending') }}">{{ $p->status }}</span></td>
                            <td style="padding: 15px 20px; text-align: right;">
                                <div class="dropdown">
                                    <button class="drop-btn" onclick="toggleDropdown(event, this)">⋮</button>
                                    <div class="dropdown-menu">
                                        @if($p->surat)<a href="{{ asset('uploads/surat/' . $p->surat) }}" target="_blank" class="menu-item">📄 Lihat Surat PDF</a>@endif
                                        <hr style="margin: 5px 0; border: 0; border-top: 1px solid #eee;">
                                        
                                        @php
                                            // Membersihkan nomor WA dari karakter aneh, tapi tetap membiarkan format 08...
                                            $nomorWA = preg_replace('/[^0-9]/', '', $p->nomor_wa);
                                        @endphp

                                        <form action="{{ route('pendaftaran.updateStatus', [$p->id, 'Diterima']) }}" method="POST">
                                            @csrf @method('PATCH')
                                            <button type="submit" class="menu-item" style="color: #28a745;" 
                                                onclick="window.open('https://api.whatsapp.com/send?phone={{ $nomorWA }}&text=Halo%20*{{ urlencode($p->nama) }}*,%20pendaftaran%20magang%20Anda%20di%20*Diskominfo%20Binjai*%20telah%20*DITERIMA*.%20Silakan%20menunggu%20informasi%20selanjutnya.', '_blank')">
                                                ✅ Set Diterima & WA
                                            </button>
                                        </form>

                                        <form action="{{ route('pendaftaran.updateStatus', [$p->id, 'Ditolak']) }}" method="POST">
                                            @csrf @method('PATCH')
                                            <button type="submit" class="menu-item" style="color: #dc3545;" 
                                                onclick="window.open('https://api.whatsapp.com/send?phone={{ $nomorWA }}&text=Halo%20*{{ urlencode($p->nama) }}*,%20mohon%20maaf%20pendaftaran%20magang%20Anda%20di%20*Diskominfo%20Binjai*%20belum%20dapat%20kami%20terima%20saat%20ini.', '_blank')">
                                                ❌ Set Ditolak & WA
                                            </button>
                                        </form>

                                        <form action="{{ route('pendaftaran.destroy', $p->id) }}" method="POST" onsubmit="return confirm('Hapus data?')">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="menu-item" style="color: #6c757d;">🗑️ Hapus Data</button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <div class="pagination-container">
                <div style="font-size: 13px; color: #666;">
                    Showing {{ $pendaftars->firstItem() }} to {{ $pendaftars->lastItem() }} of {{ $pendaftars->total() }} entries
                </div>
                <div class="pagination-wrapper">
                    {{ $pendaftars->links() }}
                </div>
            </div>
        </div>
    </div>

    <div id="galleryModal" onclick="if(event.target == this) closeGallery()">
        <div class="modal-content">
            <button onclick="closeGallery()" style="float:right; border:none; background:#f0f2f5; width:30px; height:30px; border-radius:50%; cursor:pointer; font-weight:bold;">✕</button>
            <h3 id="modalTitle" style="margin-bottom:20px; font-weight:700; color:#1a202c;">Berkas Foto</h3>
            <div id="galleryContent"></div>
        </div>
    </div>

    <script>
        function toggleDropdown(event, btn) {
            event.stopPropagation();
            const parent = btn.parentElement;
            document.querySelectorAll('.dropdown').forEach(d => { if (d !== parent) d.classList.remove('active'); });
            parent.classList.toggle('active');
        }

        function openGallery(nama, fotos) {
            const modal = document.getElementById('galleryModal');
            const content = document.getElementById('galleryContent');
            document.getElementById('modalTitle').innerText = "Berkas: " + nama;
            content.innerHTML = ""; 

            if (fotos && Array.isArray(fotos) && fotos.length > 0) {
                fotos.forEach((foto, index) => {
                    const wrapper = document.createElement('div');
                    wrapper.className = "foto-wrapper";
                    wrapper.innerHTML = `
                        <small style="display:block; color:#718096; margin-bottom:8px; font-weight:600;">Foto Ke-${index + 1}</small>
                        <img src="/uploads/foto/${foto}" onerror="this.src='https://via.placeholder.com/400x500?text=Error'">
                    `;
                    content.appendChild(wrapper);
                });
            } else {
                content.innerHTML = "<p style='color:gray; text-align:center; width:100%; padding:20px;'>Tidak ada foto.</p>";
            }
            modal.style.display = "flex";
        }

        function closeGallery() { document.getElementById('galleryModal').style.display = "none"; }

        window.onclick = function(event) {
            if (!event.target.matches('.drop-btn')) {
                document.querySelectorAll('.dropdown').forEach(d => d.classList.remove('active'));
            }
        }
    </script>
</x-app-layout>