@extends('layouts.admin')

@section('title', 'Kelola Surat Permohonan')

@section('content')

<div class="relative w-full h-64">
    <img src="{{ asset('assets\img\background\admin_perdagangan.png') }}" alt="Background" class="object-cover w-full h-full" />
    <a href="{{ route('dashboard.perdagangan') }}"
            class="absolute flex items-center justify-center w-12 h-12 text-black transition-all duration-300 transform -translate-y-1/2 rounded-full shadow-lg left-14 top-1/2 bg-white/80 hover:bg-black hover:text-white hover:border-white hover:scale-110">
            <span class="text-2xl material-symbols-outlined">
                arrow_back
            </span>
        </a>
</div>
<div class="container px-4 mx-auto -mt-8">
    <div class="flex justify-center mb-6">
        <div class="relative w-1/2 bg-white rounded-full shadow-xl shadow-gray-400/40">
            <span class="absolute text-gray-500 transform -translate-y-1/2 material-symbols-outlined left-3 top-1/2">search</span>
            <input type="text" placeholder="Cari"
                class="w-full p-3 pl-10 bg-transparent border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500" />
        </div>
    </div>
    <div class="grid grid-cols-1 gap-4 mb-6 sm:grid-cols-2 md:grid-cols-4">
        <a href="#" class="flex items-center p-5 space-x-4 transition bg-white shadow-md rounded-2xl hover:shadow-lg">
            <img src="{{ asset('assets/img/icon/folder-download.png') }}" alt="Surat Masuk" class="w-12 h-12">
            <div>
                <p class="text-base font-medium text-black">Jumlah Surat Masuk</p>
                <p class="text-2xl font-bold text-blue-600">{{ $totalSuratPerdagangan }}</p>
            </div>
        </a>

        <a href="#" class="flex items-center p-5 space-x-4 transition bg-white shadow-md rounded-2xl hover:shadow-lg">
            <img src="{{ asset('assets/img/icon/Verif.png') }}" alt="Terverifikasi" class="w-12 h-12">
            <div>
                <p class="text-base font-medium text-black">Jumlah Surat Terverifikasi</p>
                <p class="text-2xl font-bold text-yellow-500">{{ $totalSuratTerverifikasi }}</p>
            </div>
        </a>

        <a href="#" class="flex items-center p-5 space-x-4 transition bg-white shadow-md rounded-2xl hover:shadow-lg">
            <img src="{{ asset('assets/img/icon/surat_ditolak.png') }}" alt="Ditolak" class="w-12 h-12">
            <div>
                <p class="text-base font-medium text-black">Jumlah Surat Ditolak</p>
                <p class="text-2xl font-bold text-green-600">{{ $totalSuratDitolak }}</p>
            </div>
        </a>

        <a href="#" class="flex items-center p-5 space-x-4 transition bg-white shadow-md rounded-2xl hover:shadow-lg">
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
                    <th class="px-4 py-3 border-b">Nama Pemohon</th>
                    <th class="px-4 py-3 border-b">Jenis Surat</th>
                    <th class="px-4 py-3 border-b">Tanggal Dikirim</th>
                    <th class="px-4 py-3 border-b">Status</th>
                    <th class="px-4 py-3 border-b rounded-tr-xl">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($dataSurat as $index => $item)
                <tr class="text-center border-b">
                    <td class="px-4 py-2">{{ $index + 1 }}</td>
                    <td class="px-4 py-2">{{ $item->user->nama ?? 'Tidak Diketahui' }}</td>
                    @php
                    $jenisSuratMap = [
                    'surat_rekomendasi_perdagangan' => 'Surat Rekomendasi',
                    'surat_keterangan_perdagangan' => 'Surat Keterangan',
                    'dan_lainnya_perdagangan' => 'Surat Lainnya',
                    ];
                    @endphp
                    <td class="px-4 py-2">
                        {{ $jenisSuratMap[$item->jenis_surat] ?? $item->jenis_surat }}
                    </td>
                    <td class="px-4 py-2">{{ \Carbon\Carbon::parse($item->created_at)->format('d-m-Y') }}</td>
                    <td class="px-4 py-3 text-center">
                        @if ($item->status == 'diterima')
                        <span class="font-medium text-green-600">Disetujui</span>
                        @elseif ($item->status == 'ditolak')
                        <span class="font-medium text-red-600">Ditolak</span>
                        @else
                        <span class="font-medium text-yellow-400">Menunggu</span>
                        @endif
                    </td>
                    <td class="px-4 py-2">
                        <a href="{{ route('perdagangan.detailSurat', $item->id_permohonan) }}"
                            class="inline-block px-4 py-1.5 rounded-full bg-[#083358] text-white text-sm font-semibold transition hover:bg-blue-300 hover:text-black">
                            Lihat Permohonan
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection