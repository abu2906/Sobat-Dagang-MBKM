@extends('layouts.admin')
@section('title', 'Dashboard Perdagangan')

@section('content')
<div class="p-6 bg-gray-100 min-h-screen">
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4 mb-6">
        <a href="#" class="bg-white rounded-2xl shadow-md hover:shadow-lg transition p-5 flex items-center space-x-4">
            <img src="{{ asset('assets/img/icon/folder-download.png') }}" alt="Surat Masuk" class="w-12 h-12">
            <div>
                <p class="text-base font-medium text-black">Jumlah Surat Masuk</p>
                <p class="text-2xl font-bold text-blue-600">n</p>
            </div>
        </a>

        <a href="#" class="bg-white rounded-2xl shadow-md hover:shadow-lg transition p-5 flex items-center space-x-4">
            <img src="{{ asset('assets/img/icon/Verif.png') }}" alt="Terverifikasi" class="w-12 h-12">
            <div>
                <p class="text-base font-medium text-black">Jumlah Surat Terverifikasi</p>
                <p class="text-2xl font-bold text-yellow-500">n</p>
            </div>
        </a>

        <a href="#" class="bg-white rounded-2xl shadow-md hover:shadow-lg transition p-5 flex items-center space-x-4">
            <img src="{{ asset('assets/img/icon/surat_ditolak.png') }}" alt="Ditolak" class="w-12 h-12">
            <div>
                <p class="text-base font-medium text-black">Jumlah Surat Ditolak</p>
                <p class="text-2xl font-bold text-green-600">n</p>
            </div>
        </a>

        <a href="#" class="bg-white rounded-2xl shadow-md hover:shadow-lg transition p-5 flex items-center space-x-4">
            <img src="{{ asset('assets/img/icon/draf.png') }}" alt="Draft" class="w-12 h-12">
            <div>
                <p class="text-base font-medium text-black">Draft Surat Balasan</p>
                <p class="text-2xl font-bold text-orange-500">n</p>
            </div>
        </a>
    </div>
    <div class="bg-white rounded-2xl shadow-md p-6 mb-6">
        <h2 class="text-lg font-semibold text-black mb-4">Daftar Surat Masuk</h2>
    
        <div class="flex justify-between gap-6">
            <div class="flex-1 overflow-x-auto rounded-xl border border-gray-200">
                <table class="min-w-full text-sm text-left">
                    <thead class="bg-blue-300 text-black">
                        <tr>
                            <th class="py-3 px-4">No</th>
                            <th class="py-3 px-4">Nomor Surat</th>
                            <th class="py-3 px-4">Pengirim</th>
                            <th class="py-3 px-4">Tanggal Masuk</th>
                            <th class="py-3 px-4">Surat</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- @forelse ($suratMasuk as $index => $surat)
                            <tr class="border-b">
                                <td class="py-2 px-4">{{ $index + 1 }}</td>
                                <td class="py-2 px-4">{{ $surat->nomor }}</td>
                                <td class="py-2 px-4">{{ $surat->pengirim }}</td>
                                <td class="py-2 px-4">{{ \Carbon\Carbon::parse($surat->tanggal_masuk)->format('d M Y') }}</td>
                                <td class="py-2 px-4">
                                    <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-1 rounded-full text-xs">BACA</button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-4 text-gray-500">Tidak ada surat masuk</td>
                            </tr>
                        @endforelse --}}
                    </tbody>
                </table>
            </div>
    
            <div class="bg-white rounded-2xl shadow-md p-6 font-bold">
                <div class="flex flex-col gap-3 items-end">
                    <a href="" class="flex items-center justify-center gap-2 bg-white text-gray-800 text-sm px-5 py-2 rounded-lg shadow-sm border border-gray-300 hover:bg-gray-100 min-w-[150px]">
                        <img src="{{ asset('assets/img/icon/eye.png') }}" alt="Kelola Icon" class="w-4 h-4">
                        Kelola Surat
                    </a>
                    <a href="" class="flex items-center justify-center gap-2 bg-[#083358] text-white text-sm px-5 py-2 rounded-lg shadow-sm hover:bg-[#0a3e6b] min-w-[150px]">
                        <img src="{{ asset('assets/img/icon/persuratan.png') }}" alt="Tambah Icon" class="w-4 h-4">
                        Tambah Surat
                    </a>
                </div>
            </div>

        </div>
    </div>
    
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-white rounded-2xl shadow-md p-6">
            <h2 class="text-lg font-semibold text-black mb-4">Daftar Harga Barang</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm text-left">
                    <thead class="bg-blue-300 text-black">
                        <tr>
                            <th class="py-2 px-4">Nama Barang</th>
                            <th class="py-2 px-4">Harga Satuan</th>
                            <th class="py-2 px-4">Satuan</th>
                            <th class="py-2 px-4">Update Terakhir</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- @foreach ($daftarHarga as $item)
                            <tr class="border-b">
                                <td class="py-2 px-4">{{ $item->nama_barang }}</td>
                                <td class="py-2 px-4">Rp{{ number_format($item->harga_satuan, 0, ',', '.') }}</td>
                                <td class="py-2 px-4">{{ $item->satuan }}</td>
                                <td class="py-2 px-4">{{ \Carbon\Carbon::parse($item->updated_at)->format('d M Y') }}</td>
                            </tr>
                        @endforeach --}}
                    </tbody>
                </table>
            </div>
        </div>

        <div>
            <div class="mb-4">
                <div class="bg-white rounded-2xl shadow-md p-6 flex flex-col justify-between mb-4 h-64">
                    <h2 class="text-lg font-semibold text-black mb-4">Notifikasi Penting</h2>
                    <ul class="list-disc pl-5 space-y-2 text-sm text-gray-700 overflow-y-auto pr-2 flex-1">
                        {{-- <div class="max-h-64 overflow-y-auto pr-2">
                            <ol class="list-decimal ml-5 space-y-1">
                                @foreach ($notifikasi as $item)
                                    <li>
                                        <div class="pl-2">
                                            {{ $item->pesan }}
                                        </div>
                                    </li>
                                @endforeach
                            </ol>
                        </div>                         --}}
                    </ul>
                </div>                
            </div>
        
            <div>
                <div class="bg-white rounded-2xl shadow-md p-6 flex flex-col justify-between">
                    <div class="flex items-center gap-2 text-sm text-black italic font-semibold">
                        <img src="{{ asset('assets/img/icon/quote.png') }}" class="w-auto h-5" alt="Quote">
                        <span>Perdagangan yang sehat, ekonomi yang kuat</span>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</div>
@endsection
