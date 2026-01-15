<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pendaftar;
use Illuminate\Support\Facades\File;

class AdminController extends Controller
{
    /**
     * DASHBOARD UTAMA
     * Menampilkan statistik box dan data grafik bulanan
     */
    public function adminDashboard()
    {
        // Mengambil angka statistik untuk kotak di dashboard
        $stats = [
            'total' => Pendaftar::count(),
            'pending' => Pendaftar::where('status', 'Pending')->count(),
            'diterima' => Pendaftar::where('status', 'Diterima')->count(),
            'ditolak' => Pendaftar::where('status', 'Ditolak')->count(),
        ];

        // Menyiapkan data untuk grafik batang/garis
        $dataGrafik = ['diterima' => [], 'ditolak' => [], 'pending' => []];
        for ($m = 1; $m <= 12; $m++) {
            $dataGrafik['diterima'][] = Pendaftar::whereMonth('created_at', $m)->whereYear('created_at', date('Y'))->where('status', 'Diterima')->count();
            $dataGrafik['ditolak'][] = Pendaftar::whereMonth('created_at', $m)->whereYear('created_at', date('Y'))->where('status', 'Ditolak')->count();
            $dataGrafik['pending'][] = Pendaftar::whereMonth('created_at', $m)->whereYear('created_at', date('Y'))->where('status', 'Pending')->count();
        }

        return view('dashboard', compact('stats', 'dataGrafik'));
    }

    /**
     * TABEL MANAJEMEN PENDAFTAR
     * Menampilkan daftar semua orang yang mendaftar magang
     */
    public function dataPendaftar(Request $request)
    {
        $query = Pendaftar::query();
        
        // Fungsi pencarian nama jika dibutuhkan
        if ($request->search) {
            $query->where('nama', 'like', '%' . $request->search . '%');
        }
        
        $pendaftars = $query->latest()->get();

        return view('admin.data_pendaftar', compact('pendaftars'));
    }

    /**
     * UPDATE STATUS (TERIMA/TOLAK)
     * Fungsi yang dijalankan saat tombol Terima atau Tolak diklik
     */
    public function updateStatus($id, $status)
    {
        $pendaftar = Pendaftar::findOrFail($id);
        $pendaftar->update(['status' => $status]);

        return redirect()->back()->with('success', "Status pendaftar {$pendaftar->nama} berhasil diperbarui menjadi {$status}!");
    }

    /**
     * HAPUS DATA
     * Menghapus pendaftar sekaligus file foto dan PDF-nya dari folder uploads
     */
    public function destroy($id)
    {
        $p = Pendaftar::findOrFail($id);
        
        // Hapus file fisik agar storage tidak penuh
        if ($p->foto && File::exists(public_path('uploads/foto/'.$p->foto))) {
            File::delete(public_path('uploads/foto/'.$p->foto));
        }
        if ($p->surat && File::exists(public_path('uploads/surat/'.$p->surat))) {
            File::delete(public_path('uploads/surat/'.$p->surat));
        }
        
        $p->delete();
        return redirect()->back()->with('success', 'Data pendaftar berhasil dihapus!');
    }
}