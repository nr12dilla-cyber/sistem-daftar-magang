<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pendaftar;
use App\Models\User; // Ditambahkan untuk proses registrasi admin
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash; // Ditambahkan untuk enkripsi password
use Illuminate\Validation\Rules; // Ditambahkan untuk validasi password standar Laravel

class AdminController extends Controller
{
    /**
     * DASHBOARD UTAMA
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
     * FORM TAMBAH ADMIN BARU (INTERNAL)
     */
    public function formTambahAdmin()
    {
        return view('admin.tambah-admin');
    }

    /**
     * SIMPAN ADMIN BARU KE DATABASE
     */
    public function simpanAdmin(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('dashboard')->with('success', 'Admin baru berhasil ditambahkan!');
    }

    /**
     * TABEL MANAJEMEN PENDAFTAR
     */
    public function dataPendaftar(Request $request)
    {
        $query = Pendaftar::query();
        
        if ($request->search) {
            $query->where('nama', 'like', '%' . $request->search . '%');
        }
        
        $pendaftars = $query->latest()->get();

        return view('admin.data_pendaftar', compact('pendaftars'));
    }

    /**
     * UPDATE STATUS (TERIMA/TOLAK)
     */
    public function updateStatus($id, $status)
    {
        $pendaftar = Pendaftar::findOrFail($id);
        $pendaftar->update(['status' => $status]);

        return redirect()->back()->with('success', "Status pendaftar {$pendaftar->nama} berhasil diperbarui menjadi {$status}!");
    }

    /**
     * HAPUS DATA
     */
    public function destroy($id)
    {
        $p = Pendaftar::findOrFail($id);
        
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