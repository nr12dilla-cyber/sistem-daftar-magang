<x-app-layout>
    <div style="padding: 20px;">
        <h2 style="font-size: 24px; font-weight: bold; margin-bottom: 20px;">Manajemen Pendaftar - DISKOMINFO KOTA BINJAI</h2>

        <div style="background: white; border-radius: 12px; shadow: 0 4px 6px rgba(0,0,0,0.1); overflow: hidden;">
            <table style="width: 100%; border-collapse: collapse;">
                <thead style="background: #f8fafc; border-bottom: 2px solid #e2e8f0;">
                    <tr>
                        <th style="padding: 15px; text-align: left;">Profil</th>
                        <th style="padding: 15px; text-align: left;">Nama & Instansi</th>
                        <th style="padding: 15px; text-align: center;">Status</th>
                        <th style="padding: 15px; text-align: right;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pendaftars as $p)
                    <tr style="border-bottom: 1px solid #f1f5f9;">
                        <td style="padding: 15px;">
                            <img src="{{ asset('uploads/foto/' . $p->foto) }}" style="width: 45px; height: 45px; border-radius: 50%; object-fit: cover; border: 2px solid #e2e8f0;">
                        </td>
                        <td style="padding: 15px;">
                            <div style="font-weight: bold;">{{ $p->nama }}</div>
                            <div style="font-size: 12px; color: #64748b;">{{ $p->asal_sekolah }}</div>
                        </td>
                        <td style="padding: 15px; text-align: center;">
                            <span style="padding: 4px 12px; border-radius: 20px; font-size: 11px; font-weight: bold;
                                {{ $p->status == 'Diterima' ? 'background: #dcfce7; color: #166534;' : '' }}
                                {{ $p->status == 'Ditolak' ? 'background: #fee2e2; color: #991b1b;' : '' }}
                                {{ $p->status == 'Pending' ? 'background: #fef3c7; color: #92400e;' : '' }}">
                                {{ $p->status }}
                            </span>
                        </td>
                        <td style="padding: 15px; text-align: right;">
                            <div style="display: flex; gap: 8px; justify-content: flex-end;">
                                <form action="{{ route('pendaftaran.updateStatus', [$p->id, 'Diterima']) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" style="background: #10b981; color: white; border: none; padding: 6px 12px; border-radius: 6px; cursor: pointer; font-size: 12px; font-weight: 600;">Terima</button>
                                </form>

                                <form action="{{ route('pendaftaran.updateStatus', [$p->id, 'Ditolak']) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" style="background: #ef4444; color: white; border: none; padding: 6px 12px; border-radius: 6px; cursor: pointer; font-size: 12px; font-weight: 600;">Tolak</button>
                                </form>
                                
                                <form action="{{ route('pendaftaran.destroy', $p->id) }}" method="POST" onsubmit="return confirm('Yakin hapus?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" style="background: white; border: 1px solid #e2e8f0; color: #94a3b8; padding: 6px 12px; border-radius: 6px; cursor: pointer; font-size: 12px;">Hapus</button>
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