@extends('layouts.home')

@section('title', 'Kelola Surat Permohonan')

@section('content')

<div class="relative w-full h-64">
    <img src="{{ asset('assets\img\background\admin_perdagangan.png') }}" alt="Background" class="object-cover w-full h-full" />
    </a>
</div>
<div class="container px-4 mx-auto -mt-8">
    <div class="flex justify-center mb-6">
        <div class="relative w-1/2 shadow-xl rounded-full bg-white shadow-gray-400/40">
            <span class="material-symbols-outlined absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500">search</span>
            <input type="text" placeholder="Cari"
                   class="w-full p-3 pl-10 rounded-full border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 bg-transparent" />
        </div>
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4 mb-6">
        <a href="#" class="bg-white rounded-2xl shadow-md hover:shadow-lg transition p-5 flex items-center space-x-4">
            <img src="{{ asset('assets/img/icon/folder-download.png') }}" alt="Surat Masuk" class="w-12 h-12">
            <div>
                <p class="text-base font-medium text-black">Jumlah Surat Masuk</p>
                <p class="text-2xl font-bold text-blue-600">{{ $totalSuratPerdagangan }}</p>
            </div>
        </a>

        <a href="#" class="bg-white rounded-2xl shadow-md hover:shadow-lg transition p-5 flex items-center space-x-4">
            <img src="{{ asset('assets/img/icon/Verif.png') }}" alt="Terverifikasi" class="w-12 h-12">
            <div>
                <p class="text-base font-medium text-black">Jumlah Surat Terverifikasi</p>
                <p class="text-2xl font-bold text-yellow-500">{{ $totalSuratTerverifikasi }}</p>
            </div>
        </a>

        <a href="#" class="bg-white rounded-2xl shadow-md hover:shadow-lg transition p-5 flex items-center space-x-4">
            <img src="{{ asset('assets/img/icon/surat_ditolak.png') }}" alt="Ditolak" class="w-12 h-12">
            <div>
                <p class="text-base font-medium text-black">Jumlah Surat Ditolak</p>
                <p class="text-2xl font-bold text-green-600">{{ $totalSuratDitolak }}</p>
            </div>
        </a>

        <a href="#" class="bg-white rounded-2xl shadow-md hover:shadow-lg transition p-5 flex items-center space-x-4">
            <img src="{{ asset('assets/img/icon/draf.png') }}" alt="Draft" class="w-12 h-12">
            <div>
                <p class="text-base font-medium text-black">Draft Surat Balasan</p>
                <p class="text-2xl font-bold text-orange-500">{{ $totalSuratDraft }}</p>
            </div>
        </a>
    </div>

    <div class="container px-4 pb-4 mx-auto">
        <table class="min-w-full overflow-hidden bg-white border border-gray-300 shadow-md rounded-xl">
            <thead>
                <tr class="bg-[#083358] text-white font-semibold">
                    <th class="px-4 py-3 border-b rounded-tl-xl">No</th>
                    <th class="px-4 py-3 border-b">ID Surat</th>
                    <th class="px-4 py-3 border-b">Nama Pemohon</th>
                    <th class="px-4 py-3 border-b">Tanggal Dikirim</th>
                    <th class="px-4 py-3 border-b">Status</th>
                    <th class="px-4 py-3 border-b rounded-tr-xl">Aksi</th>
                </tr>
            </thead>
            <tbody>
                {{-- @foreach ($data as $index => $item) --}}
                    <tr class="text-center border-b">
                        <td class="px-4 py-2">tes</td>
                        <td class="px-4 py-2">tes</td>
                        <td class="px-4 py-2">tes</td>
                        <td class="px-4 py-2">tes</td>
                        {{-- <td class="px-4 py-2">{{ $index + 1 }}</td>
                        <td class="px-4 py-2">{{ $item->id_surat }}</td>
                        <td class="px-4 py-2">{{ $item->nama_pemohon }}</td>
                        <td class="px-4 py-2">{{ \Carbon\Carbon::parse($item->created_at)->format('d-m-Y') }}</td> --}}
                        <td class="px-4 py-3 text-center">
                            {{-- @if ($item->status == 'disetujui')
                                <span class="text-green-600 font-medium">Disetujui</span>
                            @elseif ($item->status == 'ditolak')
                                <span class="text-red-600 font-medium">Ditolak</span>
                            @else
                                <span class="text-yellow-400 font-medium">Menunggu</span>
                            @endif --}}
                        </td>
                        <td class="px-4 py-2">
                            <a href="#"
                               class="inline-block px-4 py-1.5 rounded-full bg-[#083358] text-white text-sm font-semibold transition hover:bg-blue-300 hover:text-black">
                                Lihat Permohonan
                            </a>
                        </td>
                        
                    </tr>
                {{-- @endforeach --}}
            </tbody>
                  
        </table>
    </div>  
</div>
@endsection