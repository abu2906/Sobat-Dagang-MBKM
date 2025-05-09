@extends('layouts.admin')
@section('title', 'Review Pengajuan')
@section('fullwidth')
@endsection

@section('content')

<div class="relative w-full h-60">
    <img src="{{ asset('assets/img/background/admin_perdagangan.png') }}" alt="Port Background" class="object-cover w-full h-full">
    <div class="absolute bottom-0 -left-4 w-full h-60 -z-10">
        <img src="{{ asset('assets/img/background/admin_perdagangan.png') }}"
             alt="Background"
             class="object-cover w-full h-full -ml-16">
</div>

<div class="flex justify-center my-12">
    <div class="bg-blue-100 p-1 rounded-full flex gap-1">
        <button onclick="window.location.href='{{ route('review.pengajuan') }}'" class="bg-[#083358] text-white font-semibold py-2 px-6 rounded-full shadow transition-all">
            PENGAJUAN DISTRIBUTOR 
        </button>
        <button onclick="window.location.href='{{ route('lihat.laporan') }}'" class="bg-blue-100 text-black font-semibold py-2 px-6 rounded-full transition-all hover:bg-gray-100">
            LAPORAN DISTRIBUSI
        </button>
        <button onclick="window.location.href='{{ route('tambah.barang-distribusi') }}'" class="bg-blue-100 text-black font-semibold py-2 px-6 rounded-full transition-all hover:bg-gray-100">
            TAMBAHKAN BARANG
        </button>
    </div>
</div>

<div class="max-w-6xl mx-auto px-4 mb-10">
<h2 class="text-2xl font-bold text-[#083358] mb-4 text-center">Daftar Pengajuan Distributor</h2>

<div class="overflow-x-auto bg-white rounded-lg shadow">
    <table class="min-w-full text-sm text-left text-gray-700">
        <thead class="bg-[#083358] text-white">
            <tr>
                <th class="px-6 py-3">Nama Distributor</th>
                <th class="px-6 py-3">Dokumen NIB</th>
                <th class="px-6 py-3">Status</th>
            </tr>
        </thead>
        <tbody>
            <tr class="border-b hover:bg-gray-50">
                <td class="px-6 py-4">PT Subur Makmur</td>
                <td class="px-6 py-4">
                    <a href="#" class="text-blue-600 hover:underline" target="_blank">Lihat Dokumen</a>
                </td>
                <td class="px-6 py-4">
                    <div class="flex gap-2">
                        <button class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded text-xs font-semibold">
                            Terima
                        </button>
                        <button class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-xs font-semibold">
                            Tunda
                        </button>
                        <button class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-xs font-semibold">
                            Tolak
                        </button>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</div>
</div>
@endsection
