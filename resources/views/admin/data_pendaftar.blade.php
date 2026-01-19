<x-app-layout>
    <style>
        /* Background hanya untuk area konten utama, TIDAK untuk sidebar */
        .admin-container {
            position: relative;
            padding: 30px;
            min-height: 100vh;
            background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 50%, #f0f9ff 100%);
        }

        /* Background Animation Layer - HANYA di area konten */
        .admin-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 0;
            opacity: 0.6;
            background: 
                radial-gradient(circle at 20% 30%, rgba(0, 102, 204, 0.15) 0%, transparent 50%),
                radial-gradient(circle at 80% 70%, rgba(255, 120, 0, 0.12) 0%, transparent 50%),
                radial-gradient(circle at 40% 80%, rgba(0, 102, 204, 0.1) 0%, transparent 50%);
            animation: gradientShift 15s ease-in-out infinite;
            pointer-events: none;
        }

        @keyframes gradientShift {
            0%, 100% { transform: translate(0, 0) scale(1); opacity: 0.6; }
            33% { transform: translate(30px, -30px) scale(1.1); opacity: 0.8; }
            66% { transform: translate(-20px, 20px) scale(0.95); opacity: 0.7; }
        }

        .bg-decoration { position: absolute; border-radius: 50%; z-index: 0; pointer-events: none; filter: blur(80px); }
        .circle-1 { width: 600px; height: 600px; background: radial-gradient(circle, rgba(0, 102, 204, 0.25) 0%, rgba(0, 102, 204, 0.1) 40%, transparent 70%); top: -250px; right: -150px; animation: float1 20s ease-in-out infinite; }
        .circle-2 { width: 500px; height: 500px; background: radial-gradient(circle, rgba(255, 120, 0, 0.2) 0%, rgba(255, 120, 0, 0.08) 40%, transparent 70%); bottom: -200px; left: -150px; animation: float2 25s ease-in-out infinite; }
        .circle-3 { width: 400px; height: 400px; background: radial-gradient(circle, rgba(0, 102, 204, 0.18) 0%, rgba(0, 102, 204, 0.06) 40%, transparent 70%); top: 35%; right: -50px; animation: float3 18s ease-in-out infinite; }
        .circle-4 { width: 350px; height: 350px; background: radial-gradient(circle, rgba(255, 120, 0, 0.15) 0%, rgba(255, 120, 0, 0.05) 40%, transparent 70%); top: 50%; left: -50px; animation: float4 22s ease-in-out infinite; }
        .circle-5 { width: 300px; height: 300px; background: radial-gradient(circle, rgba(0, 102, 204, 0.2) 0%, rgba(0, 102, 204, 0.08) 40%, transparent 70%); bottom: 20%; right: 15%; animation: pulse 12s ease-in-out infinite; }

        @keyframes float1 { 0%, 100% { transform: translate(0, 0) rotate(0deg); } 50% { transform: translate(30px, -30px) rotate(180deg); } }
        @keyframes float2 { 0%, 100% { transform: translate(0, 0) rotate(0deg); } 50% { transform: translate(-60px, 20px) rotate(-180deg); } }
        @keyframes pulse { 0%, 100% { transform: scale(1); opacity: 1; } 50% { transform: scale(1.2); opacity: 0.8; } }

        .pattern-dots { position: absolute; top: 0; left: 0; width: 100%; height: 100%; z-index: 0; opacity: 0.035; background-image: radial-gradient(circle, #0066cc 1.5px, transparent 1.5px); background-size: 35px 35px; pointer-events: none; }
        .content-layer { position: relative; z-index: 10; }
        
        .table-card { background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(20px); border-radius: 16px; box-shadow: 0 20px 50px rgba(0, 102, 204, 0.12); overflow: hidden; border: 1px solid rgba(226, 232, 240, 0.8); }
        .btn-terima { background: linear-gradient(135deg, #10b981, #059669); color: white; border: none; padding: 8px 16px; border-radius: 8px; cursor: pointer; font-size: 12px; font-weight: 700; box-shadow: 0 2px 8px rgba(16, 185, 129, 0.3); }
        .btn-tolak { background: linear-gradient(135deg, #ef4444, #dc2626); color: white; border: none; padding: 8px 16px; border-radius: 8px; cursor: pointer; font-size: 12px; font-weight: 700; box-shadow: 0 2px 8px rgba(239, 68, 68, 0.3); }
        .btn-hapus { background: none; border: 1px solid #e2e8f0; color: #94a3b8; padding: 7px; border-radius: 8px; cursor: pointer; }
        
        .table-row { border-bottom: 1px solid #f1f5f9; transition: all 0.3s ease; }
        .table-row:hover { background: rgba(240, 249, 255, 0.8) !important; }
        
        .status-badge { padding: 6px 14px; border-radius: 8px; font-size: 11px; font-weight: 800; text-transform: uppercase; display: inline-block; }
        .page-header { position: relative; margin-bottom: 25px; padding: 20px; background: rgba(255, 255, 255, 0.7); backdrop-filter: blur(10px); border-radius: 12px; border: 1px solid rgba(0, 102, 204, 0.1); }
        .photo-profile { width: 50px; height: 50px; border-radius: 12px; object-fit: cover; border: 2px solid #fff; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); }
    </style>

    <div class="admin-container">
        <div class="pattern-dots"></div>
        <div class="bg-decoration circle-1"></div>
        <div class="bg-decoration circle-2"></div>
        
        <div class="content-layer">
            <div class="page-header">
                <h2 style="font-size: 26px; font-weight: 800; color: #1e293b; letter-spacing: -0.5px; margin: 0;">
                    Manajemen Pendaftar Pemagang <span style="color: #64748b; font-weight: 400; font-size: 20px;">— DISKOMINFO KOTA BINJAI</span>
                </h2>
            </div>

            <div class="table-card">
                <table style="width: 100%; border-collapse: collapse;">
                    <thead style="background: #f8fafc;">
                        <tr>
                            <th style="padding: 18px 20px; text-align: center; color: #64748b; border-bottom: 2px solid #e2e8f0; width: 50px;">No</th>
                            <th style="padding: 18px 20px; text-align: left; color: #64748b; border-bottom: 2px solid #e2e8f0;">Profil</th>
                            <th style="padding: 18px 20px; text-align: left; color: #64748b; border-bottom: 2px solid #e2e8f0;">Nama & Instansi</th>
                            <th style="padding: 18px 20px; text-align: center; color: #64748b; border-bottom: 2px solid #e2e8f0;">Status</th>
                            <th style="padding: 18px 20px; text-align: right; color: #64748b; border-bottom: 2px solid #e2e8f0;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pendaftars as $index => $p)
                        <tr class="table-row">
                            <td style="padding: 15px 20px; text-align: center; color: #64748b; font-weight: 600;">{{ $index + 1 }}</td>
                            <td style="padding: 15px 20px;">
                                <img src="{{ asset('uploads/foto/' . $p->foto) }}" class="photo-profile">
                            </td>
                            <td style="padding: 15px 20px;">
                                <div style="font-weight: 700; color: #1e293b; font-size: 15px;">{{ $p->nama }}</div>
                                <div style="font-size: 12px; color: #64748b; font-weight: 500;">{{ $p->asal_sekolah }}</div>
                                
                                @if($p->surat)
                                <div style="margin-top: 8px;">
                                    <a href="{{ asset('uploads/surat/' . $p->surat) }}" target="_blank" style="display: inline-flex; align-items: center; gap: 5px; background: #fee2e2; color: #dc2626; padding: 4px 10px; border-radius: 6px; font-size: 11px; font-weight: 700; text-decoration: none; border: 1px solid #fecaca; transition: all 0.2s;">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" viewBox="0 0 16 16">
                                            <path d="M14 4.5V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h5.5L14 4.5zm-3 0A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V4.5h-2z"/>
                                        </svg>
                                        LIHAT SURAT PDF
                                    </a>
                                </div>
                                @endif
                            </td>
                            <td style="padding: 15px 20px; text-align: center;">
                                <span class="status-badge" style="{{ $p->status == 'Diterima' ? 'background: #dcfce7; color: #15803d;' : ($p->status == 'Ditolak' ? 'background: #fee2e2; color: #b91c1c;' : 'background: #fef3c7; color: #b45309;') }}">
                                    {{ $p->status }}
                                </span>
                            </td>
                            <td style="padding: 15px 20px; text-align: right;">
                                <div style="display: flex; gap: 10px; justify-content: flex-end;">
                                    <form action="{{ route('pendaftaran.updateStatus', [$p->id, 'Diterima']) }}" method="POST">@csrf @method('PATCH')<button type="submit" class="btn-terima">✓</button></form>
                                    <form action="{{ route('pendaftaran.updateStatus', [$p->id, 'Ditolak']) }}" method="POST">@csrf @method('PATCH')<button type="submit" class="btn-tolak">✗</button></form>
                                    <form action="{{ route('pendaftaran.destroy', $p->id) }}" method="POST" onsubmit="return confirm('Hapus?')">@csrf @method('DELETE')<button type="submit" class="btn-hapus">🗑</button></form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>