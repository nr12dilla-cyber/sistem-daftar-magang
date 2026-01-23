<x-app-layout>
    <style>
        /* Container & Card Style */
        .admin-container { background-color: #f0f7ff; min-height: 100vh; padding: 30px; font-family: 'Inter', sans-serif; }
        .table-card { background: white; border-radius: 20px; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.03); overflow: hidden; border: 1px solid rgba(0, 102, 204, 0.08); }
        
        /* Typography */
        th { background: #f8fafc; padding: 18px 20px; text-align: left; color: #64748b; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.5px; border-bottom: 1px solid #f1f5f9; }
        .table-row { border-bottom: 1px solid #f8fafc; transition: background 0.2s; }
        .table-row:hover { background: #f0f9ff; }

        /* PDF Button Style */
        .pdf-button {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            background: #fee2e2;
            color: #dc2626;
            padding: 4px 10px;
            border-radius: 6px;
            font-size: 10px;
            font-weight: 800;
            text-decoration: none;
            margin-top: 8px;
        }

        /* WA Link Style */
        .wa-link {
            color: #16a34a;
            text-decoration: none;
            font-weight: 700;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        /* Tombol Pesan Cepat WA */
        .btn-wa-msg {
            display: inline-flex;
            padding: 2px 8px;
            border-radius: 4px;
            font-size: 9px;
            font-weight: 700;
            text-decoration: none;
            text-transform: uppercase;
            margin-top: 5px;
        }
        .msg-terima { background: #dcfce7; color: #15803d; border: 1px solid #bbf7d0; }
        .msg-tolak { background: #fef2f2; color: #991b1b; border: 1px solid #fecaca; }
        
        .btn-action { width: 34px; height: 34px; display: flex; align-items: center; justify-content: center; border-radius: 8px; border: none; cursor: pointer; color: white; }
        .btn-terima { background: #10b981; }
        .btn-tolak { background: #ef4444; }
        .btn-hapus { background: white; color: #94a3b8; border: 1px solid #e2e8f0; }
    </style>

    <div class="admin-container">
        <div class="table-card">
            <table style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr>
                        <th style="text-align: center; width: 50px;">No</th>
                        <th>Biodata & Instansi</th>
                        <th>Kontak (WhatsApp/Email)</th>
                        <th>Status</th>
                        <th style="text-align: right;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pendaftars as $index => $p)
                    <tr class="table-row">
                        <td style="text-align: center; font-weight: 600; color: #94a3b8;">{{ $index + 1 }}</td>
                        
                        <td style="padding: 15px 20px;">
                            <div style="display: flex; gap: 12px; align-items: center;">
                                <img src="{{ asset('uploads/foto/' . $p->foto) }}" style="width: 45px; height: 45px; border-radius: 10px; object-fit: cover;">
                                <div>
                                    <div style="font-weight: 700; color: #1e293b;">{{ $p->nama }}</div>
                                    <div style="font-size: 12px; color: #64748b;">{{ $p->asal_sekolah }}</div>
                                    
                                    @if($p->surat)
                                        <a href="{{ asset('uploads/surat/' . $p->surat) }}" target="_blank" class="pdf-button">
                                            📄 LIHAT SURAT PDF
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </td>

                        <td style="padding: 15px 20px;">
                            @php
                                // Format nomor WA
                                $cleanNo = preg_replace('/[^0-9]/', '', $p->nomor_wa);
                                if (str_starts_with($cleanNo, '0')) {
                                    $waSystem = '62' . substr($cleanNo, 1);
                                } else {
                                    $waSystem = $cleanNo;
                                }

                                // Pesan Otomatis
                                $textTerima = urlencode("Halo *" . $p->nama . "*, kami dari Diskominfo Binjai. Selamat, Anda dinyatakan *DITERIMA* magang.");
                                $textTolak = urlencode("Halo *" . $p->nama . "*, kami dari Diskominfo Binjai. Mohon maaf, pendaftaran magang Anda *DITOLAK* / belum dapat kami terima saat ini.");
                            @endphp

                            <a href="https://api.whatsapp.com/send?phone={{ $waSystem }}" target="_blank" class="wa-link">
                                📱 {{ $p->nomor_wa }}
                            </a>
                            
                            <div style="display: flex; gap: 5px;">
                                <a href="https://api.whatsapp.com/send?phone={{ $waSystem }}&text={{ $textTerima }}" target="_blank" class="btn-wa-msg msg-terima">
                                    Kirim Lulus
                                </a>
                                <a href="https://api.whatsapp.com/send?phone={{ $waSystem }}&text={{ $textTolak }}" target="_blank" class="btn-wa-msg msg-tolak">
                                    Kirim Tolak
                                </a>
                            </div>

                            <div style="font-size: 12px; color: #64748b; margin-top: 4px; display: flex; align-items: center; gap: 8px;">
                                ✉️ {{ $p->email }}
                            </div>
                        </td>

                        <td>
                            <span style="padding: 5px 12px; border-radius: 8px; font-size: 11px; font-weight: 700; {{ $p->status == 'Diterima' ? 'background: #dcfce7; color: #15803d;' : ($p->status == 'Ditolak' ? 'background: #fee2e2; color: #b91c1c;' : 'background: #fef3c7; color: #b45309;') }}">
                                {{ $p->status }}
                            </span>
                        </td>

                        <td style="padding: 15px 20px; text-align: right;">
                            <div style="display: flex; gap: 8px; justify-content: flex-end;">
                                <form action="{{ route('pendaftaran.updateStatus', [$p->id, 'Diterima']) }}" method="POST">@csrf @method('PATCH')
                                    <button type="submit" class="btn-action btn-terima">✓</button>
                                </form>
                                <form action="{{ route('pendaftaran.updateStatus', [$p->id, 'Ditolak']) }}" method="POST">@csrf @method('PATCH')
                                    <button type="submit" class="btn-action btn-tolak">✗</button>
                                </form>
                                <form action="{{ route('pendaftaran.destroy', $p->id) }}" method="POST" onsubmit="return confirm('Hapus data?')">@csrf @method('DELETE')
                                    <button type="submit" class="btn-action btn-hapus">🗑</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>