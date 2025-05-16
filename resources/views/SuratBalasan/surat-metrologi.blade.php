<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Surat keterangan - Sobat Dagang</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12pt;
            padding: 30px;
            color: #333;
        }


        .bold-underline {
            font-weight: bold;
            text-decoration: underline;
        }

        .italic-underline {
            font-style: italic;
            text-decoration: underline;
        }

        .kop {
            display: flex;
            align-items: center;
            border-bottom: 3px solid #000;
            padding-bottom: 10px;
        }

        .kop .logo {
            margin-top: -40px;
        }

        .kop .logo img {
            margin-bottom: -100px;
            height: 80px;
        }

        .kop .text {
            margin-top: -40px;
            flex: 1;
            text-align: center;
            font-size: 10pt;
            line-height: 1.3;
        }

        .kop h1,
        .kop h2 {
            margin: 0;
            text-transform: uppercase;
        }

        .kop h1 {
            font-size: 14pt;
        }

        .kop h2 {
            font-size: 16pt;
            font-weight: bold;
        }


        .kop p {
            font-size: 8pt;
            margin: 4px 0;
        }

        .isi p {
            margin-bottom: 10px;
        }

        .bold {
            font-weight: bold;
        }

        .ttd {
            margin-top: 50px;
            float: right;
        }

        .ttd p {
            font-size: 10pt;
            text-align: right;
            margin-top: -10px;
        }

        .ttd .nama_kadis {
            font-weight: 300;
            text-decoration: underline;
        }

        .ttd .ttd_QR {
            display: flex;
            margin-top: 20px;
        }

        .ttd .ttd_QR img {
            height: 100px;
        }

        .judul {
            display: grid;
            text-align: right;
            margin: 0;
            padding: 0;
        }

        .judul h1 {
            font-size: 16px;
        }

        .judul p {
            margin-top: -10px;
        }
    </style>
</head>

<body>

    <div class="kop">
        <div class="logo">
            <img src="{{ asset('assets/img/logoparepare.png') }}" alt="Logo">
        </div>
        <div class="text">
            <h1>Pemerintah Kota Parepare</h1>
            <h2>Dinas Perdagangan</h2>
            <p>Jalan Jend. Sudirman No.6 Parepare, Telp (0421)21426, Faks. (0421)28132</p>
            <p>Kode Pos 91122 Email: perindag@pareparekota.go.id & dinas.perdagangan.pare@gmail.com</p>
        </div>
    </div>
    <div class="judul">
        <h1>{{ $tanggal_pembuatan_surat }}</h1>
    </div>
    <table style="width: 100%; border-collapse: collapse; margin-left: 30px; ">
        <tr>
            <td style="padding: 4px;">Nomor</td>
            <td style="padding: 4px;">: {{ $nomor_surat }}</td>
        </tr>
        <tr>
            <td style="padding: 4px;">Sifat</td>
            <td style="padding: 4px;">: {{ $sifat_surat }}</td>
        </tr>
        <tr>
            <td style="padding: 4px;">Lampiran</td>
            <td style="padding: 4px;">: {{ $lampiran }}</td>
        </tr>
        <tr>
            <td style="padding: 4px;">Hal</td>
            <td style="padding: 4px;">: {{ $hal }}</td>
        </tr>
    </table>
    <table style="width: 80%; border-collapse: collapse; margin-left: 30px; ">
        <tr>
            <td style="padding: 4px;">Kepada</td>
        </tr>
        <tr>
            <td style="padding: 4px;">YTH, {{ $nama_yang_dituju }}</td>
        </tr>
        <tr>
            <td style="padding: 4px;">di</td>
        </tr>
        <tr>
            <td style="padding: 4px;">Tempat</td>
        </tr>
    </table>
    <p>
        {!! $isi !!}
    </p>
    <div class="ttd">
        <p>Dikeluarkan di : Pareparae</p>
        <p>Pada Tanggal : {{ \Carbon\Carbon::parse($tanggal_surat)->translatedFormat('d - F - Y') }}</p>
        <div></div>
        <p>KEPADA DINAS PERDAGANGAN</p>
        <p>KOTA PAREPARE</p>
        <div></div>
        <div class="ttd_QR">
            <img src="{{ asset('assets/ttd/contohstempel.png') }}" alt="">
            <img src="{{ asset('assets/ttd/qr.png') }}" alt="">
        </div>
        <div></div>
        <p class="nama_kadis">HJ A WISNAH T SE MSI</p>
        <p>NIP. 19711026 199203 2 010</p>
    </div>

</body>

</html>