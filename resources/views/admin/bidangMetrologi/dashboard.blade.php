@extends('layouts.admin_metrologi')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
    <div class="bg-white p-4 shadow rounded text-center">
        <img src="{{ asset('assets/img/icon/Verif.png') }}" alt="Terverifikasi" class="w-12 h-12">
        <p class="text-gray-600">Jumlah Surat Masuk</p>
        <h2 class="text-2xl font-bold">1.204</h2>
    </div>
    <div class="bg-white p-4 shadow rounded text-center">
        <p class="text-gray-600">Jumlah Surat Terverifikasi</p>
        <h2 class="text-2xl font-bold">1.204</h2>
    </div>
    <div class="bg-white p-4 shadow rounded text-center">
        <p class="text-gray-600">Jumlah Alat Ukur Valid</p>
        <h2 class="text-2xl font-bold">1.204</h2>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
    <div class="bg-white p-4 shadow rounded">
        <p class="font-semibold mb-2">Tren Permohonan per Bulan</p>
        <div class="h-40 bg-gray-100 rounded flex items-center justify-center text-gray-400">[Grafik Garis]</div>
    </div>
    <div class="bg-white p-4 shadow rounded">
        <p class="font-semibold mb-2">Tren Permohonan per Bulan</p>
        <div class="h-40 bg-gray-100 rounded flex items-center justify-center text-gray-400">[Pie Chart]</div>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-4">
    <div class="bg-white p-4 shadow rounded">
        <p class="font-semibold mb-2">Permohonan Terbaru</p>
        <table class="w-full text-sm">
            <thead>
                <tr>
                    <th>No</th><th>Nama Pemohon</th><th>Status</th>
                </tr>
            </thead>
            <tbody>
                <tr><td>1</td><td>St. Nur Aisyah. S</td><td>Menunggu</td></tr>
                <tr><td>2</td><td>St. Nur Aisyah. S</td><td>Selesai</td></tr>
                <tr><td>3</td><td>St. Nur Aisyah. S</td><td>Diproses</td></tr>
            </tbody>
        </table>
    </div>
    <div class="bg-white p-4 shadow rounded text-center">
        <p class="font-semibold mb-2">Surat Belum Terverifikasi</p>
        <h1 class="text-3xl font-bold">30</h1>
        <button class="mt-2 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Tinjau Sekarang</button>
        <div class="h-28 mt-4 bg-gray-100 rounded flex items-center justify-center text-gray-400">[Bar Chart]</div>
    </div>
    <div class="bg-white p-4 shadow rounded">
        <p class="font-semibold mb-2">Surat Belum Terverifikasi</p>
        <table class="w-full text-sm">
            <thead>
                <tr>
                    <th>No</th><th>Nama Pemohon</th><th>Permohonan</th>
                </tr>
            </thead>
            <tbody>
                <tr><td>1</td><td>St. Nur Aisyah. S</td><td>Tera</td></tr>
                <tr><td>2</td><td>St. Nur Aisyah. S</td><td>Tera Ulang</td></tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
