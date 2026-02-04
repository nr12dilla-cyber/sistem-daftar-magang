<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LaporanHarian;
use Auth;

class LaporanController extends Controller
{
    // Menampilkan halaman laporan
    public function index()
    {
        // Mengambil laporan milik user yang sedang login saja
        $laporans = LaporanHarian::where('user_id', Auth::id())->get();
        return view('laporan.index', compact('laporans'));
    }

    // Menyimpan laporan ke database
    public function store(Request $request)
    {
        $request->validate([
            'kegiatan' => 'required|min:10',
        ]);

        LaporanHarian::create([
            'user_id' => Auth::id(),
            'tanggal' => now(),
            'kegiatan' => $request->kegiatan,
            'status_laporan' => 'pending'
        ]);

        return redirect()->back()->with('success', 'Laporan berhasil terkirim!');
    }
}