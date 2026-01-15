<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Form Pendaftaran Magang</title>

<script src="https://cdn.tailwindcss.com"></script>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
body { font-family: 'Inter', sans-serif; }
</style>
</head>

<body class="min-h-screen bg-gradient-to-br from-[#0B1220] via-[#102A33] to-[#0B1220] text-slate-200">

<!-- HEADER -->
<header class="border-b border-white/10">
    <div class="max-w-6xl mx-auto px-6 py-6">
        <h1 class="text-2xl font-semibold text-white">
            Formulir Pendaftaran Magang
        </h1>
        <p class="text-sm text-slate-400 mt-1">
            Sistem Informasi Data Center Diskominfo Kota Binjai
        </p>
    </div>
</header>

<!-- MAIN -->
<main class="max-w-3xl mx-auto px-6 py-12">

<div class="bg-[#1E3A43]/80 backdrop-blur-xl border border-white/10 rounded-2xl shadow-xl p-8">

<form action="{{ route('pendaftaran.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
@csrf

<section>
<h2 class="text-lg font-semibold text-white mb-4">Informasi Pribadi</h2>

<div class="space-y-4">
<input type="text" name="nama" placeholder="Nama Lengkap" required
class="w-full bg-[#0B1220]/70 border border-white/10 rounded-lg px-4 py-2 text-white focus:ring-2 focus:ring-blue-600">

<input type="email" name="email" placeholder="Email Aktif" required
class="w-full bg-[#0B1220]/70 border border-white/10 rounded-lg px-4 py-2 text-white focus:ring-2 focus:ring-blue-600">

<input type="text" name="asal_sekolah" placeholder="Asal Instansi / Sekolah / Universitas" required
class="w-full bg-[#0B1220]/70 border border-white/10 rounded-lg px-4 py-2 text-white focus:ring-2 focus:ring-blue-600">
</div>
</section>

<section>
<h2 class="text-lg font-semibold text-white mb-4">Bidang Magang</h2>

<select name="posisi" required
class="w-full bg-[#0B1220]/70 border border-white/10 rounded-lg px-4 py-2 text-white focus:ring-2 focus:ring-blue-600">
<option value="">-- Pilih Bidang --</option>
<option>Bidang Informasi dan Komunikasi Publik (IKP)</option>
<option>Bidang Aplikasi dan Informatika (APTIKA)</option>
<option>Bidang Statistik dan Persandian</option>
</select>
</section>

<section>
<h2 class="text-lg font-semibold text-white mb-4">Dokumen</h2>

<input type="file" name="foto" required
class="w-full text-slate-300 bg-[#0B1220]/70 border border-white/10 rounded-lg px-3 py-2">

<input type="file" name="surat" required
class="w-full text-slate-300 bg-[#0B1220]/70 border border-white/10 rounded-lg px-3 py-2 mt-3">
</section>

<button type="submit"
class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-xl transition">
Kirim Pendaftaran
</button>

</form>
</div>
</main>

<footer class="text-center text-sm text-slate-500 pb-8">
© 2026 Diskominfo Kota Binjai
</footer>

</body>
</html>
