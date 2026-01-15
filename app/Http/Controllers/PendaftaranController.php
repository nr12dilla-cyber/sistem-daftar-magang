<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pendaftar;
use Illuminate\Support\Facades\File;

class PendaftaranController extends Controller
{
    /**
     * 1. TAMPILKAN FORMULIR (Mencegah Error index undefined)
     */
    public function index()
    {
        return view('form_pendaftaran');
    }

    /**
     * 2. DASHBOARD (Statistik & Grafik)
     */
    public function adminDashboard()
    {
        $stats = [
            'total' => Pendaftar::count(),
            'pending' => Pendaftar::where('status', 'Pending')->count(),
            'diterima' => Pendaftar::where('status', 'Diterima')->count(),
            'ditolak' => Pendaftar::where('status', 'Ditolak')->count(),
        ];

        $dataGrafik = ['diterima' => [], 'ditolak' => [], 'pending' => []];
        for ($m = 1; $m <= 12; $m++) {
            $dataGrafik['diterima'][] = Pendaftar::whereMonth('created_at', $m)->whereYear('created_at', date('Y'))->where('status', 'Diterima')->count();
            $dataGrafik['ditolak'][] = Pendaftar::whereMonth('created_at', $m)->whereYear('created_at', date('Y'))->where('status', 'Ditolak')->count();
            $dataGrafik['pending'][] = Pendaftar::whereMonth('created_at', $m)->whereYear('created_at', date('Y'))->where('status', 'Pending')->count();
        }

        return view('dashboard', compact('stats', 'dataGrafik'));
    }

    /**
     * 3. TABEL DATA (Manajemen Pendaftar)
     */
    public function dataPendaftar()
    {
        $pendaftars = Pendaftar::latest()->get();
        return view('admin.data_pendaftar', compact('pendaftars'));
    }

    /**
     * 4. SIMPAN DATA (Tombol Kirim)
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email',
            'asal_sekolah' => 'required',
            'posisi' => 'required',
            'foto' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'surat' => 'required|mimes:pdf|max:2048',
        ]);

        $fotoName = time() . '_foto.' . $request->foto->extension();
        $request->foto->move(public_path('uploads/foto'), $fotoName);

        $suratName = time() . '_surat.' . $request->surat->extension();
        $request->surat->move(public_path('uploads/surat'), $suratName);

        Pendaftar::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'asal_sekolah' => $request->asal_sekolah,
            'posisi' => $request->posisi,
            'foto' => $fotoName,
            'surat' => $suratName,
            'status' => 'Pending',
        ]);

        return redirect()->back()->with('success', 'Pendaftaran berhasil dikirim!');
    }

    /**
     * 5. UPDATE STATUS (Tombol Terima & Tolak)
     */
    public function updateStatus($id, $status)
    {
        Pendaftar::findOrFail($id)->update(['status' => $status]);
        return redirect()->back()->with('success', "Status berhasil diubah menjadi $status");
    }

    /**
     * 6. HAPUS DATA (Tombol Hapus & File Fisik)
     */
    public function destroy($id)
    {
        $p = Pendaftar::findOrFail($id);

        if ($p->foto && File::exists(public_path('uploads/foto/' . $p->foto))) {
            File::delete(public_path('uploads/foto/' . $p->foto));
        }
        if ($p->surat && File::exists(public_path('uploads/surat/' . $p->surat))) {
            File::delete(public_path('uploads/surat/' . $p->surat));
        }

        $p->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus selamanya!');
    }
}