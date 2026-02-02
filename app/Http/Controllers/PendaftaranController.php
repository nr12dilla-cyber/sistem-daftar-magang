<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pendaftar;
use App\Models\User;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class PendaftaranController extends Controller
{
    /**
     * 1. TAMPILKAN FORMULIR & FITUR CEK STATUS
     */
    public function index(Request $request)
    {
        $hasilCek = null;
        $statusCari = false;

        if ($request->has('email_cek') && $request->email_cek != '') {
            $statusCari = true; 
            $hasilCek = Pendaftar::where('email', $request->email_cek)->first();
        }
        
        return view('form_pendaftaran', compact('hasilCek', 'statusCari'));
    }

    /**
     * 2. SIMPAN PENDAFTARAN BARU
     * Sudah termasuk validasi email unik agar tidak bisa daftar 2x
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:pendaftars,email', // Kunci agar email tidak double
            'nomor_wa' => 'required|string|max:20',
            'asal_sekolah' => 'required',
            'posisi' => 'required',
            'jumlah_anggota' => 'required|integer|min:1|max:10',
            'foto' => 'required|array',
            'foto.*' => 'image|mimes:jpeg,png,jpg|max:5120',
            'surat' => 'required|mimes:pdf|max:5120',
        ], [
            // Pesan Error Bahasa Indonesia
            'email.unique' => 'Maaf, email ini sudah terdaftar! Anda hanya diperbolehkan mendaftar satu kali.',
            'email.email' => 'Format email tidak valid.',
            'foto.*.max' => 'Ukuran foto maksimal 5MB.',
            'surat.max' => 'Ukuran file surat maksimal 5MB.',
            'surat.mimes' => 'Surat pengantar harus berformat PDF.',
        ]);

        // Proses Simpan Foto Anggota
        $fotoNames = [];
        if ($request->hasFile('foto')) {
            foreach ($request->file('foto') as $index => $file) {
                $name = time() . '_' . $index . '_' . uniqid() . '.' . $file->extension();
                $file->move(public_path('uploads/foto'), $name);
                $fotoNames[] = $name;
            }
        }

        // Proses Simpan Surat Pengantar
        $suratName = time() . '_surat.' . $request->surat->extension();
        $request->surat->move(public_path('uploads/surat'), $suratName);

        // Masukkan ke Database
        Pendaftar::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'nomor_wa' => $request->nomor_wa,
            'asal_sekolah' => $request->asal_sekolah,
            'posisi' => $request->posisi,
            'jumlah_anggota' => $request->jumlah_anggota,
            'foto' => $fotoNames, 
            'surat' => $suratName,
            'status' => 'Pending',
        ]);

        return redirect()->back()->with('success', 'Pendaftaran berhasil! Data Anda telah kami terima. Silakan cek status secara berkala.');
    }

    /**
     * 3. CETAK PDF (ADMIN)
     */
    public function cetak_pdf()
    {
        $pendaftars = Pendaftar::latest()->get();
        $pdf = Pdf::loadView('admin.pendaftar_pdf', compact('pendaftars'))
                  ->setPaper('a4', 'portrait'); 

        return $pdf->stream('Laporan_Pendaftaran_Magang_' . date('Y-m-d') . '.pdf');
    }

    /**
     * 4. DASHBOARD ADMIN
     */
    public function adminDashboard()
    {
        $stats = [
            'total' => Pendaftar::count(),
            'pending' => Pendaftar::where('status', 'Pending')->count(),
            'diterima' => Pendaftar::where('status', 'Diterima')->count(),
            'ditolak' => Pendaftar::where('status', 'Ditolak')->count(),
            'total_personil' => Pendaftar::sum('jumlah_anggota') ?? 0,
        ];

        $dataGrafik = ['diterima' => [], 'ditolak' => [], 'pending' => []];
        for ($m = 1; $m <= 12; $m++) {
            $dataGrafik['diterima'][] = Pendaftar::whereMonth('created_at', $m)->whereYear('created_at', date('2026'))->where('status', 'Diterima')->count();
            $dataGrafik['ditolak'][] = Pendaftar::whereMonth('created_at', $m)->whereYear('created_at', date('2026'))->where('status', 'Ditolak')->count();
            $dataGrafik['pending'][] = Pendaftar::whereMonth('created_at', $m)->whereYear('created_at', date('2026'))->where('status', 'Pending')->count();
        }

        return view('dashboard', compact('stats', 'dataGrafik'));
    }

    /**
     * 5. TABEL DATA PENDAFTAR (ADMIN)
     */
    public function dataPendaftar()
    {
        $pendaftars = Pendaftar::latest()->paginate(10); 
        return view('admin.data_pendaftar', compact('pendaftars'));
    }

    /**
     * 6. UPDATE STATUS & NOTIFIKASI WA
     */
    public function updateStatus($id, $status)
    {
        $pendaftar = Pendaftar::findOrFail($id);
        $pendaftar->update(['status' => $status]);

        $nomor = preg_replace('/[^0-9]/', '', $pendaftar->nomor_wa);
        if (str_starts_with($nomor, '0')) {
            $nomor = '62' . substr($nomor, 1);
        }

        if ($status == 'Diterima') {
            $pesan = "Halo *" . $pendaftar->nama . "*, kami dari Diskominfo. Selamat! Anda dinyatakan *DITERIMA* untuk magang.";
        } else {
            $pesan = "Halo *" . $pendaftar->nama . "*, kami dari Diskominfo. Mohon maaf, pendaftaran magang Anda *DITOLAK*.";
        }

        return redirect("https://api.whatsapp.com/send?phone=" . $nomor . "&text=" . urlencode($pesan));
    }

    /**
     * 7. HAPUS DATA PENDAFTAR & FILE TERKAIT
     */
    public function destroy($id)
    {
        $p = Pendaftar::findOrFail($id);

        // Hapus Foto
        if ($p->foto) {
            $fotos = is_array($p->foto) ? $p->foto : json_decode($p->foto, true);
            if ($fotos) {
                foreach ($fotos as $f) {
                    if (File::exists(public_path('uploads/foto/' . $f))) {
                        File::delete(public_path('uploads/foto/' . $f));
                    }
                }
            }
        }

        // Hapus Surat
        if ($p->surat && File::exists(public_path('uploads/surat/' . $p->surat))) {
            File::delete(public_path('uploads/surat/' . $p->surat));
        }

        $p->delete();
        return redirect()->back()->with('success', 'Data pendaftar berhasil dihapus!');
    }

    /**
     * 8. MANAJEMEN ADMIN
     */
    public function adminManage() { 
        $admins = User::all(); 
        return view('admin.manage', compact('admins')); 
    }

    public function formTambahAdmin() { 
        return view('admin.tambah_admin'); 
    }

    public function simpanAdmin(Request $request) {
        $request->validate([
            'name' => 'required', 
            'email' => 'required|unique:users', 
            'password' => 'required|confirmed'
        ]);
        User::create([
            'name' => $request->name, 
            'email' => $request->email, 
            'password' => Hash::make($request->password)
        ]);
        return redirect()->route('admin.manage')->with('success', 'Admin berhasil ditambah!');
    }

    public function hapusAdmin($id) {
        $user = User::findOrFail($id);
        if ($user->id === Auth::id()) {
            return redirect()->back()->with('error', 'Tidak bisa hapus diri sendiri!');
        }
        $user->delete();
        return redirect()->back()->with('success', 'Admin berhasil dihapus!');
    }
}