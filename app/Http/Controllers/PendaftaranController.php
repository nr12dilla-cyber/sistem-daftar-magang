<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pendaftar; // Pastikan Model mengarah ke Pendaftar
use Illuminate\Support\Facades\File;

class PendaftaranController extends Controller
{
    /**
     * 1. TAMPILKAN FORMULIR & FITUR CEK EMAIL (DI ATAS)
     */
    public function index(Request $request)
    {
        $hasilCek = null;

        // Logika untuk menangkap input 'email_cek' dari form status
        if ($request->has('email_cek') && $request->email_cek != '') {
            // Mencari data berdasarkan email pada tabel pendaftars
            $hasilCek = Pendaftar::where('email', $request->email_cek)->first();
        }

        // Mengirimkan variabel $hasilCek ke view form_pendaftaran
        return view('form_pendaftaran', compact('hasilCek'));
    }

    /**
     * 2. DASHBOARD ADMIN (Statistik & Grafik)
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
     * 3. DATA PENDAFTAR (Tabel Admin)
     */
    public function dataPendaftar()
    {
        $pendaftars = Pendaftar::latest()->get();
        return view('admin.data_pendaftar', compact('pendaftars'));
    }

    /**
     * 4. SIMPAN PENDAFTARAN BARU
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
            'status' => 'Pending', // Status default saat mendaftar
        ]);

        return redirect()->back()->with('success', 'Pendaftaran berhasil dikirim!');
    }

    /**
     * 5. UPDATE STATUS (Terima/Tolak)
     */
    public function updateStatus($id, $status)
    {
        Pendaftar::findOrFail($id)->update(['status' => $status]);
        return redirect()->back()->with('success', "Status berhasil diubah menjadi $status");
    }

    /**
     * 6. HAPUS DATA
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
        return redirect()->back()->with('success', 'Data berhasil dihapus!');
    }
}