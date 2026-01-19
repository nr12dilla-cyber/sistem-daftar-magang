<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pendaftar;
use App\Models\User; // Tambahkan ini untuk model User
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash; // Tambahkan ini untuk enkripsi password
use Illuminate\Support\Facades\Auth; // Tambahkan ini untuk cek login

class PendaftaranController extends Controller
{
    /**
     * 1. TAMPILKAN FORMULIR & FITUR CEK EMAIL
     */
    public function index(Request $request)
    {
        $hasilCek = null;
        if ($request->has('email_cek') && $request->email_cek != '') {
            $hasilCek = Pendaftar::where('email', $request->email_cek)->first();
        }
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
     * --- FITUR KELOLA ADMIN ---
     */

    // Menampilkan daftar semua admin
    public function adminManage()
    {
        $admins = User::all(); 
        return view('admin.manage', compact('admins'));
    }

    // Menampilkan form tambah admin baru
    public function formTambahAdmin()
    {
        return view('admin.tambah_admin');
    }

    // Menyimpan data admin baru
    public function simpanAdmin(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('admin.manage')->with('success', 'Admin baru berhasil ditambahkan!');
    }

    // Menghapus data admin (FUNGSI BARU)
    public function hapusAdmin($id)
    {
        // Cari user berdasarkan ID
        $user = User::findOrFail($id);

        // Proteksi: Jangan biarkan admin menghapus dirinya sendiri
        if ($user->id === Auth::id()) {
            return redirect()->back()->with('error', 'Anda tidak dapat menghapus akun Anda sendiri!');
        }

        $user->delete();

        return redirect()->back()->with('success', 'Akun admin berhasil dihapus!');
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
            'status' => 'Pending',
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
     * 6. HAPUS DATA PENDAFTAR
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