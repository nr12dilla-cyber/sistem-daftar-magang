<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pendaftar;
use App\Models\User;
use App\Models\LaporanHarian;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PendaftaranController extends Controller
{
    /**
     * 1. FORMULIR PENDAFTARAN (PUBLIC)
     */
    public function index(Request $request)
    {
        $hasilCek = null;
        $statusCari = false;
        if ($request->filled('email_cek')) {
            $statusCari = true; 
            $hasilCek = Pendaftar::where('email', $request->email_cek)->first();
        }
        return view('form_pendaftaran', compact('hasilCek', 'statusCari'));
    }

    /**
     * 2. SIMPAN PENDAFTARAN
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'phone' => 'required|string|max:15',
            'password' => 'required|string|min:8|confirmed',
            'asal_sekolah' => 'required|string|max:255',
            'posisi' => 'required|string|in:Aplikasi & Informatika (APTIKA),Informasi & Komunikasi Publik (IKP),Statistik & Persandian',
            'jumlah_anggota' => 'required|integer|min:1|max:10',
            'surat' => 'required|file|mimes:pdf|max:2048',
            'foto' => 'required|array',
            'foto.*' => 'image|mimes:jpg,jpeg,png|max:2048',
        ]);

        DB::beginTransaction();
        try {
            $namaSurat = time() . '_surat_' . Str::slug($request->name) . '.pdf';
            $request->file('surat')->move(public_path('uploads/surat'), $namaSurat);

            $daftarFoto = [];
            foreach ($request->file('foto') as $file) {
                $namaFoto = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/foto'), $namaFoto);
                $daftarFoto[] = $namaFoto;
            }

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'user',
            ]);

            Pendaftar::create([
                'nama' => $request->name,
                'email' => $request->email,
                'nomor_wa' => $request->phone,
                'asal_sekolah' => $request->asal_sekolah,
                'posisi' => $request->posisi,
                'jumlah_anggota' => $request->jumlah_anggota,
                'foto' => json_encode($daftarFoto), 
                'surat' => $namaSurat,
                'status' => 'Pending',
            ]);

            DB::commit();
            Auth::login($user);
            return redirect()->route('dashboard.mahasiswa')->with('success', 'Pendaftaran Berhasil!');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Gagal: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * 3. DATA PENDAFTAR (DIARAHKAN KE FILE data_pendaftar.blade.php)
     */
    public function dataPendaftar()
    {
        // Sesuaikan nama variabel ke $pendaftars agar cocok dengan foreach di blade
        $pendaftars = Pendaftar::orderBy('created_at', 'desc')->paginate(10);
        
        // Memanggil file: admin/data_pendaftar.blade.php
        return view('admin.data_pendaftar', compact('pendaftars')); 
    }

    /**
     * 4. MANAJEMEN ADMIN (DIARAHKAN KE FILE manage.blade.php)
     */
    public function adminManage()
    {
        $admins = User::where('role', 'admin')->get();
        
        // Memanggil file: admin/manage.blade.php
        return view('admin.manage', compact('admins'));
    }

    public function simpanAdmin(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|string|min:8',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'admin',
        ]);

        return redirect()->back()->with('success', 'Admin baru berhasil ditambahkan!');
    }

    /**
     * 5. DASHBOARD UTAMA (DIARAHKAN KE FILE dashboard.blade.php)
     */
    public function adminDashboard()
    {
        $pendaftar = Pendaftar::orderBy('created_at', 'desc')->get();
        $stats = [
            'total' => Pendaftar::count(),
            'pending' => Pendaftar::where('status', 'Pending')->count(),
            'diterima' => Pendaftar::where('status', 'Diterima')->count(),
            'ditolak' => Pendaftar::where('status', 'Ditolak')->count(),
        ];
        $dataGrafik = ['diterima' => [], 'ditolak' => [], 'pending' => []];
        for ($m = 1; $m <= 12; $m++) {
            $dataGrafik['diterima'][] = Pendaftar::where('status', 'Diterima')->whereMonth('created_at', $m)->count();
            $dataGrafik['ditolak'][] = Pendaftar::where('status', 'Ditolak')->whereMonth('created_at', $m)->count();
            $dataGrafik['pending'][] = Pendaftar::where('status', 'Pending')->whereMonth('created_at', $m)->count();
        }
        
        // Memanggil file: admin/dashboard.blade.php
        return view('admin.dashboard', compact('pendaftar', 'stats', 'dataGrafik'));
    }

    public function updateStatus($id, $status)
    {
        $p = Pendaftar::findOrFail($id);
        $p->update(['status' => $status]);
        return redirect()->back()->with('success', 'Status updated!');
    }

    public function destroy($id)
    {
        Pendaftar::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Data dihapus!');
    }

    public function showDashboardMahasiswa()
    {
        $user = Auth::user();
        
        // Mengambil data pendaftar terbaru berdasarkan email user yang login
        $pendaftar = Pendaftar::where('email', $user->email)->first();
        
        // Mengambil riwayat laporan
        $riwayatLaporan = LaporanHarian::where('user_id', $user->id)
                                        ->orderBy('created_at', 'desc')
                                        ->get();

        // Mengirimkan data ke view mahasiswa.dashboard
        return view('mahasiswa.dashboard', compact('user', 'pendaftar', 'riwayatLaporan'));
    }

    public function simpanLaporan(Request $request)
    {
        $request->validate(['tanggal' => 'required|date', 'kegiatan' => 'required|string']);
        LaporanHarian::create(['user_id' => Auth::id(), 'tanggal' => $request->tanggal, 'kegiatan' => $request->kegiatan, 'status_laporan' => 'Pending']);
        return redirect()->back()->with('success', 'Laporan terkirim!');
    }

    public function cetak_pdf() { return "Feature Coming Soon"; }
    public function formTambahAdmin() { return redirect()->route('admin.manage'); }
    public function hapusAdmin($id) { User::findOrFail($id)->delete(); return redirect()->back(); }
}