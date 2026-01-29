<!DOCTYPE html>
<html>
<head>
    <title>Laporan Pendaftar Magang</title>
    <style>
        @page { margin: 1cm 1.5cm; }
        body { font-family: 'Helvetica', sans-serif; font-size: 9px; color: #333; line-height: 1.4; }
        
        /* Gaya KOP SURAT */
        .kop-container {
            border-bottom: 3px solid #000;
            padding-bottom: 10px;
            margin-bottom: 20px;
            position: relative;
            text-align: center;
        }
        .logo {
            position: absolute;
            left: 0;
            top: -5px; /* Logo ditarik sedikit ke atas agar sejajar teks */
            width: 60px;
        }
        .header-text {
            display: inline-block;
            width: 80%; /* Menyeimbangkan posisi teks */
            margin-left: 50px;
        }
        .header-text h3 { margin: 0; font-size: 13pt; font-weight: normal; letter-spacing: 1px; }
        .header-text h2 { margin: 0; font-size: 15pt; font-weight: bold; }
        .header-text p { margin: 1px 0; font-size: 8pt; font-style: italic; }

        /* Gaya Judul Laporan */
        .title { text-align: center; margin-bottom: 20px; }
        .title h4 { margin: 0; text-transform: uppercase; text-decoration: underline; font-size: 11pt; }
        .title p { margin-top: 5px; font-size: 8pt; }

        /* Gaya Tabel */
        table { width: 100%; border-collapse: collapse; table-layout: fixed; border: 1.5px solid #000; }
        th { background: #e9e9e9; border: 1px solid #000; padding: 10px 4px; font-weight: bold; text-align: center; text-transform: uppercase; }
        td { border: 1px solid #000; padding: 8px 5px; vertical-align: middle; word-wrap: break-word; }
        
        /* Zebra Striping */
        tr:nth-child(even) { background-color: #fafafa; }

        .text-center { text-align: center; }
        .text-bold { font-weight: bold; }
        
        /* Tanda Tangan */
        .footer-ttd { margin-top: 30px; float: right; width: 220px; text-align: center; font-size: 10px; }
        .space { height: 50px; }
    </style>
</head>
<body>
    <div class="kop-container">
        @php
            $path = public_path('images/logobinjai.png');
            $type = pathinfo($path, PATHINFO_EXTENSION);
            $data = file_exists($path) ? file_get_contents($path) : '';
            $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
        @endphp
        <img src="{{ $base64 }}" class="logo">
        
        <div class="header-text">
            <h3>PEMERINTAH KOTA BINJAI</h3>
            <h2>DINAS KOMUNIKASI DAN INFORMATIKA</h2>
            <p>Jl. Jenderal Sudirman No. 6, Kartini, Kec. Binjai Kota, Kota Binjai, Sumatera Utara</p>
            <p>diskominfo.binjaikota.go.id | diskominfo@binjaikota.go.id</p>
        </div>
    </div>

    <div class="title">
        <h4>Laporan Data Pendaftaran Magang </h4>
        <p>Dicetak pada: {{ date('d/m/Y H:i') }} WIB</p>
    </div>

    <table>
        <thead>
            <tr>
                <th width="30px">NO</th>
                <th width="140px">NAMA LENGKAP</th>
                <th>ASAL INSTANSI / SEKOLAH</th>
                <th width="55px">JUMLAH</th>
                <th width="100px">NO. WHATSAPP</th>
                <th width="75px">STATUS</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pendaftars as $index => $p)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td class="text-bold">{{ strtoupper($p->nama) }}</td>
                <td>{{ strtoupper($p->asal_sekolah) }}</td>
                <td class="text-center">{{ $p->jumlah_anggota ?? 1 }}</td>
                <td class="text-center">{{ $p->nomor_wa }}</td>
                <td class="text-center text-bold" style="color: {{ strtolower($p->status) == 'diterima' ? '#15803d' : (strtolower($p->status) == 'ditolak' ? '#b91c1c' : '#b45309') }}">
                    {{ strtoupper($p->status) }}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer-ttd">
        <p>Binjai, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
        <p>Administrator,</p>
        <div class="space"></div>
        <p class="text-bold">( ____________________ )</p>
        <p style="font-size: 9px;">NIP. .............................</p>
    </div>
</body>
</html>