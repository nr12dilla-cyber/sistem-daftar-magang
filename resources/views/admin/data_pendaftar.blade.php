<x-app-layout>
    <div style="padding: 30px; background-color: #f0f9ff; min-height: 100vh;">
        <div style="margin-bottom: 25px;">
            <h2 style="font-size: 26px; font-weight: 800; color: #1e293b; letter-spacing: -0.5px;">
                Manajemen Pendaftar Pemagang <span style="color: #64748b; font-weight: 400; font-size: 20px;">— DISKOMINFO KOTA BINJAI</span>
            </h2>
        </div>

        <div style="background: white; border-radius: 16px; box-shadow: 0 10px 25px rgba(0,102,204,0.08); overflow: hidden; border: 1px solid rgba(226, 232, 240, 0.8);">
            <table style="width: 100%; border-collapse: collapse;">
                <thead style="background: #f8fafc;">
                    <tr>
                        <th style="padding: 18px 20px; text-align: center; font-size: 13px; text-transform: uppercase; letter-spacing: 1px; color: #64748b; border-bottom: 2px solid #f1f5f9; width: 50px;">No</th>
                        <th style="padding: 18px 20px; text-align: left; font-size: 13px; text-transform: uppercase; letter-spacing: 1px; color: #64748b; border-bottom: 2px solid #f1f5f9;">Profil</th>
                        <th style="padding: 18px 20px; text-align: left; font-size: 13px; text-transform: uppercase; letter-spacing: 1px; color: #64748b; border-bottom: 2px solid #f1f5f9;">Nama & Instansi</th>
                        <th style="padding: 18px 20px; text-align: center; font-size: 13px; text-transform: uppercase; letter-spacing: 1px; color: #64748b; border-bottom: 2px solid #f1f5f9;">Status</th>
                        <th style="padding: 18px 20px; text-align: right; font-size: 13px; text-transform: uppercase; letter-spacing: 1px; color: #64748b; border-bottom: 2px solid #f1f5f9;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pendaftars as $index => $p)
                    <tr style="border-bottom: 1px solid #f1f5f9; transition: background 0.2s;" onmouseover="this.style.backgroundColor='#fdfdfd'" onmouseout="this.style.backgroundColor='transparent'">
                        <td style="padding: 15px 20px; text-align: center; color: #64748b; font-weight: 600; font-size: 14px;">
                            {{ $index + 1 }}
                        </td>
                        
                        <td style="padding: 15px 20px;">
                            <img src="{{ asset('uploads/foto/' . $p->foto) }}" style="width: 50px; height: 50px; border-radius: 12px; object-fit: cover; border: 2px solid #fff; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
                        </td>
                        
                        <td style="padding: 15px 20px;">
                            <div style="font-weight: 700; color: #1e293b; font-size: 15px;">{{ $p->nama }}</div>
                            <div style="font-size: 12px; color: #0066cc; font-weight: 500; text-transform: uppercase;">{{ $p->asal_sekolah }}</div>
                        </td>
                        
                        <td style="padding: 15px 20px; text-align: center;">
                            <span style="padding: 6px 14px; border-radius: 8px; font-size: 11px; font-weight: 800; text-transform: uppercase;
                                {{ $p->status == 'Diterima' ? 'background: #dcfce7; color: #15803d;' : '' }}
                                {{ $p->status == 'Ditolak' ? 'background: #fee2e2; color: #b91c1c;' : '' }}
                                {{ $p->status == 'Pending' ? 'background: #fef3c7; color: #b45309;' : '' }}">
                                {{ $p->status }}
                            </span>
                        </td>
                        
                        <td style="padding: 15px 20px; text-align: right;">
                            <div style="display: flex; gap: 10px; justify-content: flex-end; align-items: center;">
                                <form action="{{ route('pendaftaran.updateStatus', [$p->id, 'Diterima']) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" style="background: #10b981; color: white; border: none; padding: 8px 16px; border-radius: 8px; cursor: pointer; font-size: 12px; font-weight: 700;">Terima</button>
                                </form>

                                <form action="{{ route('pendaftaran.updateStatus', [$p->id, 'Ditolak']) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" style="background: #ef4444; color: white; border: none; padding: 8px 16px; border-radius: 8px; cursor: pointer; font-size: 12px; font-weight: 700;">Tolak</button>
                                </form>
                                
                                <form action="{{ route('pendaftaran.destroy', $p->id) }}" method="POST" onsubmit="return confirm('Hapus data ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" style="background: none; border: 1px solid #e2e8f0; color: #94a3b8; padding: 7px; border-radius: 8px; cursor: pointer;">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                            <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                        </svg>
                                    </button>
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