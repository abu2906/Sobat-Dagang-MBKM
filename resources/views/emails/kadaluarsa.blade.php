<h3>Pemberitahuan UTTP Kedaluwarsa</h3>

<p>Halo {{ $dataAlatUkur->uttp->user->nama }},</p>

<p>UTTP Anda dengan rincian berikut telah kadaluarsa:</p>

<ul>
    <li>Nama Usaha: <strong>{{ $dataAlatUkur->uttp->nama_usaha }}</strong></li>
    <li>Nama Alat: <strong>{{ $dataAlatUkur->uttp->nama_alat }}</strong></li>
    <li>No Registrasi: <strong>{{ $dataAlatUkur->uttp->no_registrasi }}</strong></li>
    <li>Tanggal Expired: <strong>{{ \Carbon\Carbon::parse($dataAlatUkur->tanggal_exp)->format('d-m-Y') }}</strong></li>
</ul>

<p>Silakan lakukan kalibrasi ulang melalui sistem kami.</p>
