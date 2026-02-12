<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pendaftar;
use App\Models\User;
use App\Models\LaporanHarian;
use App\Models\Absensi;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf; 

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
            if (!File::isDirectory(public_path('uploads/surat'))) File::makeDirectory(public_path('uploads/surat'), 0755, true);
            if (!File::isDirectory(public_path('uploads/foto'))) File::makeDirectory(public_path('uploads/foto'), 0755, true);

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
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * 3. DASHBOARD MAHASISWA
     */
    public function showDashboardMahasiswa()
    {
        $user = Auth::user();
        $pendaftar = Pendaftar::where('email', $user->email)->first();
        
        if ($pendaftar) {
            $pendaftar->asal_instansi = $pendaftar->asal_sekolah;
        }

        $absenHariIni = Absensi::where('user_id', $user->id)
                                ->whereDate('tanggal', date('Y-m-d'))
                                ->first();
        
        return view('mahasiswa.dashboard', compact('user', 'pendaftar', 'absenHariIni'));
    }

    /**
     * 4. LAPORAN MAHASISWA
     */
    public function showLaporanMahasiswa()
    {
        $user = Auth::user();
        $pendaftar = Pendaftar::where('email', $user->email)->first();
        
        if (!$pendaftar) {
            return redirect()->route('welcome')->with('error', 'Data pendaftaran tidak ditemukan.');
        }

        $pendaftar->asal_instansi = $pendaftar->asal_sekolah;
        $riwayatLaporan = LaporanHarian::where('user_id', $user->id)
                                        ->orderBy('tanggal', 'desc')
                                        ->get();

        return view('mahasiswa.laporan', compact('user', 'pendaftar', 'riwayatLaporan'));
    }

    public function simpanLaporan(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date', 
            'kegiatan' => 'required|string|min:10'
        ]);

        LaporanHarian::create([
            'user_id' => Auth::id(), 
            'tanggal' => $request->tanggal, 
            'kegiatan' => $request->kegiatan, 
            'status_laporan' => 'Pending'
        ]);

        return redirect()->back()->with('success', 'Laporan harian berhasil dikirim!');
    }

    /**
     * 5. DASHBOARD & DATA ADMIN
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

        $statsAbsensi = [
            'hadir' => Absensi::whereDate('tanggal', date('Y-m-d'))->where('status', 'Hadir')->count(),
            'izin'  => Absensi::whereDate('tanggal', date('Y-m-d'))->whereIn('status', ['Izin', 'Sakit'])->count(),
            'alfa'  => User::where('role', 'user')->count() - Absensi::whereDate('tanggal', date('Y-m-d'))->count(),
        ];

        $dataGrafik = ['diterima' => [], 'ditolak' => [], 'pending' => []];
        for ($m = 1; $m <= 12; $m++) {
            $dataGrafik['diterima'][] = Pendaftar::where('status', 'Diterima')->whereYear('created_at', date('Y'))->whereMonth('created_at', $m)->count();
            $dataGrafik['ditolak'][] = Pendaftar::where('status', 'Ditolak')->whereYear('created_at', date('Y'))->whereMonth('created_at', $m)->count();
            $dataGrafik['pending'][] = Pendaftar::where('status', 'Pending')->whereYear('created_at', date('Y'))->whereMonth('created_at', $m)->count();
        }
        
        return view('admin.dashboard', compact('pendaftar', 'stats', 'dataGrafik', 'statsAbsensi'));
    }

    public function dataPendaftar()
    {
        $pendaftars = Pendaftar::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.data_pendaftar', compact('pendaftars')); 
    }

    public function updateStatus($id, $status)
    {
        $p = Pendaftar::findOrFail($id);
        $p->update(['status' => $status]);
        return redirect()->back()->with('success', "Status pendaftaran berhasil diubah!");
    }

    /**
     * PERBAIKAN: Pagination 10 laporan
     */
    public function adminLaporan()
    {
        $laporans = LaporanHarian::with('user')
                                ->orderBy('tanggal', 'desc')
                                ->paginate(10); // Diubah dari 15 ke 10
        return view('admin.laporan_magang', compact('laporans'));
    }

    public function updateStatusLaporan($id, $status)
    {
        $laporan = LaporanHarian::findOrFail($id);
        $laporan->update(['status_laporan' => $status]);
        return redirect()->back()->with('success', 'Status laporan diperbarui!');
    }

    public function cetak_pdf() 
    { 
        $pendaftars = Pendaftar::all(); 
        $pdf = Pdf::loadView('admin.cetak_pendaftar_pdf', compact('pendaftars'));
        $pdf->setPaper('a4', 'landscape');
        return $pdf->stream('Laporan_Pendaftaran_Magang_' . date('Y-m-d') . '.pdf');
    }

    public function adminManage() {
        $admins = User::where('role', 'admin')->get();
        return view('admin.manage', compact('admins'));
    }

    public function simpanAdmin(Request $request) {
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
        return redirect()->back()->with('success', 'Admin baru ditambahkan!');
    }

    public function hapusAdmin($id) {
        if (Auth::id() == $id) return redirect()->back()->with('error', 'Tidak bisa menghapus diri sendiri!');
        User::findOrFail($id)->delete(); 
        return redirect()->back()->with('success', 'Admin dihapus!'); 
    }

    /**
     * 6. FITUR ABSENSI
     */
    public function showAbsensiMahasiswa()
    {
        $user = Auth::user();
        $pendaftar = Pendaftar::where('email', $user->email)->first();
        $today = date('Y-m-d');
        
        $riwayatAbsen = Absensi::where('user_id', $user->id)
                                ->whereMonth('tanggal', date('m'))
                                ->orderBy('tanggal', 'desc')
                                ->get();
        
        $absenHariIni = Absensi::where('user_id', $user->id)
                                ->where('tanggal', $today)
                                ->first();

        return view('mahasiswa.absensi', compact('user', 'pendaftar', 'riwayatAbsen', 'absenHariIni'));
    }

    public function absenMasuk(Request $request)
    {
        $userId = Auth::id();
        $today = date('Y-m-d');
        $cek = Absensi::where('user_id', $userId)->where('tanggal', $today)->first();

        if (!$cek) {
            Absensi::create([
                'user_id' => $userId,
                'tanggal' => $today,
                'jam_masuk' => date('H:i:s'),
                'status' => 'Hadir'
            ]);
            return redirect()->back()->with('success', 'Berhasil Absen Masuk!');
        }
        return redirect()->back()->with('error', 'Sudah absen masuk.');
    }

    public function absenPulang(Request $request)
    {
        $userId = Auth::id();
        $today = date('Y-m-d');
        $absen = Absensi::where('user_id', $userId)->where('tanggal', $today)->first();

        if ($absen && $absen->jam_pulang == null) {
            $absen->update(['jam_pulang' => date('H:i:s')]);
            return redirect()->back()->with('success', 'Berhasil Absen Pulang!');
        }
        return redirect()->back()->with('error', 'Gagal absen pulang.');
    }

    /**
     * 7. MONITORING ABSENSI (ADMIN)
     */
    public function adminMonitoring()
    {
        $allAbsensi = Absensi::with('user')
            ->orderBy('tanggal', 'desc')
            ->orderBy('jam_masuk', 'desc')
            ->paginate(10); // Menambahkan pagination juga di monitoring

        return view('admin.monitoring_absensi', compact('allAbsensi'));
    }
}