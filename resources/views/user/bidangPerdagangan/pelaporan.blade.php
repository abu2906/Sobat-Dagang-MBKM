@extends('layouts.home')
@section('title', 'Pelaporan')
@section('content')

<head>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" />
</head>
<div class="relative w-full h-64">
    <img src="{{ asset('assets\img\background\perdagangan.jpg') }}" alt="Port Background" class="object-cover w-full h-full">
    <a href="{{ url()->previous() }}"
        class="absolute flex items-center justify-center w-12 h-12 text-black transition-all duration-300 transform -translate-y-1/2 rounded-full shadow-lg left-14 top-1/2 bg-white/80 hover:bg-black hover:text-white hover:scale-110">
        <span class="text-2xl material-symbols-outlined">arrow_back</span>
    </a>
    <div class="absolute bottom-0 transform -translate-x-1/2 translate-y-1/2 left-1/2">
        <p class="px-6 py-3 font-bold text-[#083358] bg-white shadow-md text-md font-istok rounded-3xl shadow-black/40">
            PELAPORAN PENYALURAN PUPUK BERSUBSIDI
        </p>
    </div>
</div>

<!-- Tabel -->
<div class="container p-6 mx-auto mt-8">
    <div class="judul-tabel">
        <p class="px-6 py-3 text-xl font-bold font-istok rounded-3xl text-[#083458]">TOKO</p>
    </div>
    <div class="overflow-x-auto hide-scrollbar rounded-2xl border-[#889EAF] shadow-md shadow-black/40">
        <table class="min-w-full border-collapse table-auto">
            <thead>
                <tr>
                    <th class="px-6 py-3 text-center text-sm font-medium text-white bg-[#083458] border-2 border-[#889EAF]">Nama</th>
                    <th class="px-6 py-3 text-center text-sm font-medium text-white bg-[#083458] border-2 border-[#889EAF]">Kecamatan</th>
                    <th class="px-6 py-3 text-center text-sm font-medium text-white bg-[#083458] border-2 border-[#889EAF]">No Register</th>
                    <th class="px-4 py-3 text-center text-sm font-medium text-white bg-[#083458] border-2 border-[#889EAF]">Rencana Kebutuhan</th>
                    <th class="px-6 py-3 text-center text-sm font-medium text-white bg-[#083458] border-2 border-[#889EAF]">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tokoList as $toko)
                    <tr class="border-b-2 border-[#889EAF] hover:bg-gray-50">
                        <td class="px-6 py-4 text-sm font-medium text-gray-900 border-r-2 border-[#889EAF]">{{ $toko->nama_toko }}</td>
                        <td class="px-6 py-4 text-sm text-gray-700 border-r-2 border-[#889EAF]">{{ $toko->kecamatan }}</td>
                        <td class="px-6 py-4 text-sm text-gray-700 border-r-2 border-[#889EAF]">{{ $toko->no_register }}</td>
                        <td class="px-6 py-4 text-sm text-gray-700 border-r-2 border-[#889EAF]">{{ $toko->rencana->jumlah ?? 'N/A' }} sak</td>
                        <!-- kolom lain -->
                        <td class="flex items-center justify-center px-6 py-4 text-sm text-gray-700">
                            <a href="{{ route('pelaporan.showDataDistribusi', ['id_toko' => $toko->id_toko]) }}">
                                <button>
                                    <p class="px-4 py-2 text-sm font-bold font-istok rounded-xl text-white bg-[#083458] w-fit ">
                                        Tambahkan Data Distribusi
                                    </p>
                                </button>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="py-6 tambahkan-data">
        <a href="{{ route('pelaporan.showInputForm') }}">
            <p class="px-6 py-3 text-sm font-bold font-istok rounded-xl text-white bg-[#083458] w-fit">
                Tambahkan Data untuk Toko
            </p>
        </a>
    </div>
</div>

<div class="container p-6 mx-auto mt-8">
    <form method="GET" id="filterForm">
        <div class="flex justify-end mb-2 pilihanbulandantahun">
            <!-- Dropdown Toko -->
            <div class="flex flex-wrap gap-6">
                <select name="toko"class="block w-40 px-4 py-2 text-white text-sm border border-[#889EAF] rounded-lg focus:ring-[#083458] focus:border-[#889EAF] bg-[#083458]" onchange="document.getElementById('filterForm').submit()" ...>
                    <option value="">Pilih Toko</option>
                    @foreach ($tokos as $toko)
                        <option value="{{ $toko->id_toko }}" {{ request('toko') == $toko->id_toko ? 'selected' : '' }}>
                            {{ $toko->nama_toko }}
                        </option>
                    @endforeach
                </select>
            </div>
            <!-- Dropdown Bulan -->
            <div>
                <select name="bulan" class="block w-40 px-4 py-2 text-white text-sm border border-[#889EAF] rounded-lg focus:ring-[#083458] focus:border-[#889EAF] bg-[#083458]" onchange="document.getElementById('filterForm').submit()" ...>
                    <option value="">Pilih Bulan</option>
                    @for ($b = 1; $b <= 12; $b++)
                        <option value="{{ $b }}" {{ request('bulan') == $b ? 'selected' : '' }}>
                            {{ DateTime::createFromFormat('!m', $b)->format('F') }}
                        </option>
                    @endfor
                </select>
            </div>
            <!-- Dropdown Tahun -->
            <div>
                <select name="tahun" class="block w-40 px-4 py-2 text-white text-sm border border-[#889EAF] rounded-lg focus:ring-[#083458] focus:border-[#889EAF] bg-[#083458]" onchange="document.getElementById('filterForm').submit()" ...>
                    <option value="">Pilih Tahun</option>
                    @for ($i = date('Y'); $i >= 2020; $i--)
                        <option value="{{ $i }}" {{ request('tahun') == $i ? 'selected' : '' }}>{{ $i }}</option>
                    @endfor
                </select>
            </div>
        </div>
    </form>
    <div class="judul-tabel">
        <p class="px-6 py-2 text-xl font-bold font-istok rounded-3xl text-[#083458]">DISTRIBUSI</p>
    </div>
    <div class="overflow-x-auto hide-scrollbar rounded-2xl border-[#889EAF] shadow-md shadow-black/40">
        <table class="min-w-full border-collapse table-auto">
            <thead>
                <tr>
                    <th rowspan="2" class="px-6 py-3 text-center align-middle text-sm font-medium text-white bg-[#083458] border-2 border-[#889EAF]">Nama Barang</th>
                    @for ($i = 1; $i <= 4; $i++)
                        <th class="px-6 py-3 text-center text-sm font-medium text-white bg-[#083458] border-2 border-[#889EAF]" colspan="3">Minggu {{ $i }}</th>
                    @endfor
                </tr>
                <tr>
                    @for ($i = 1; $i <= 4; $i++)
                        <th class="px-6 py-3 text-center text-sm font-medium text-white bg-[#083458] border-2 border-[#889EAF]">Stok Awal (sak)</th>
                        <th class="px-6 py-3 text-center text-sm font-medium text-white bg-[#083458] border-2 border-[#889EAF]">Penyaluran (sak)</th>
                        <th class="px-6 py-3 text-center text-sm font-medium text-white bg-[#083458] border-2 border-[#889EAF]">Stok Akhir (sak)</th>
                    @endfor
                </tr>
            </thead>
            <tbody>
                @foreach ($dataByMinggu as $nama_barang => $mingguData)
                <tr class="border-b-2 border-[#889EAF] hover:bg-gray-50">
                    <td class="px-6 py-4 text-sm font-medium text-gray-900 border-r-2 border-[#889EAF]">{{ $nama_barang }}</td>
                    @for ($i = 1; $i <= 4; $i++)
                        <td class="text-center px-6 py-4 text-sm text-gray-700 border-r-2 border-[#889EAF]">{{ $mingguData["minggu_$i"]['stok_awal'] }}</td>
                        <td class="text-center px-6 py-4 text-sm text-gray-700 border-r-2 border-[#889EAF]">{{ $mingguData["minggu_$i"]['penyaluran'] }}</td>
                        <td class="text-center px-6 py-4 text-sm text-gray-700 border-r-2 border-[#889EAF]" >{{ $mingguData["minggu_$i"]['stok_akhir'] }}</td>
                    @endfor
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<style>
    .hide-scrollbar {
        scrollbar-width: none;
        /* Firefox */
        -ms-overflow-style: none;
        /* IE 10+ */
    }

    .hide-scrollbar::-webkit-scrollbar {
        display: none;
        /* Chrome, Safari, Opera */
    }
</style>


@endsection