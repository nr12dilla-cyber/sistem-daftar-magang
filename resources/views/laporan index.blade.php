<form action="{{ route('laporan.store') }}" method="POST">
    @csrf
    <label>Apa kegiatanmu hari ini?</label>
    <textarea name="kegiatan" rows="4" style="width: 100%"></textarea>
    <button type="submit">Kirim Laporan</button>
</form>

<hr>

<table border="1" width="100%">
    <tr>
        <th>Tanggal</th>
        <th>Kegiatan</th>
        <th>Status</th>
    </tr>
    @foreach($laporans as $l)
    <tr>
        <td>{{ $l->tanggal }}</td>
        <td>{{ $l->kegiatan }}</td>
        <td>{{ $l->status_laporan }}</td>
    </tr>
    @endforeach
</table>