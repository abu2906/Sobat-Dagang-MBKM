@extends('layouts.home')
@section('title', 'Pelaporan')
@section('content')

<head>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" />
</head>
<div class="relative w-full h-64">
    <img src="{{ asset('assets\img\background\admin_perdagangan.png') }}" alt="Port Background" class="object-cover w-full h-full">
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
                <tr class="border-b-2 border-[#889EAF] hover:bg-gray-50">
                    <td class="px-6 py-4 text-sm font-medium text-gray-900 border-r-2 border-[#889EAF]">John Doe</td>
                    <td class="px-6 py-4 text-sm text-gray-700 border-r-2 border-[#889EAF]">Kecamatan A</td>
                    <td class="px-6 py-4 text-sm text-gray-700 border-r-2 border-[#889EAF]">12345</td>
                    <td class="px-6 py-4 text-sm text-gray-700 border-r-2 border-[#889EAF]">100 Ton</td>
                    <td class="flex items-center justify-center px-6 py-4 text-sm text-gray-700">
                        <button onclick="" class="text-[#083358] hover:text-black">
                            <span class="material-symbols-outlined">edit</span>
                        </button>
                    </td>
                </tr>
                <tr class="border-b-2 border-[#889EAF] hover:bg-gray-50">
                    <td class="px-6 py-4 text-sm font-medium text-gray-900 border-r-2 border-[#889EAF]">John Doe</td>
                    <td class="px-6 py-4 text-sm text-gray-700 border-r-2 border-[#889EAF]">Kecamatan A</td>
                    <td class="px-6 py-4 text-sm text-gray-700 border-r-2 border-[#889EAF]">12345</td>
                    <td class="px-6 py-4 text-sm text-gray-700 border-r-2 border-[#889EAF]">100 Ton</td>
                    <td class="flex items-center justify-center px-6 py-4 text-sm text-gray-700">
                        <button onclick="" class="text-[#083358] hover:text-black">
                            <span class="material-symbols-outlined">edit</span>
                        </button>
                    </td>
                </tr>
                <tr class="border-b-2 border-[#889EAF] hover:bg-gray-50">
                    <td class="px-6 py-4 text-sm font-medium text-gray-900 border-r-2 border-[#889EAF]">John Doe</td>
                    <td class="px-6 py-4 text-sm text-gray-700 border-r-2 border-[#889EAF]">Kecamatan A</td>
                    <td class="px-6 py-4 text-sm text-gray-700 border-r-2 border-[#889EAF]">12345</td>
                    <td class="px-6 py-4 text-sm text-gray-700 border-r-2 border-[#889EAF]">100 Ton</td>
                    <td class="flex items-center justify-center px-6 py-4 text-sm text-gray-700">
                        <button onclick="" class="text-[#083358] hover:text-black">
                            <span class="material-symbols-outlined">edit</span>
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="py-6 tambahkan-data">
        <a href="">
            <p class="px-6 py-3 text-sm font-bold font-istok rounded-xl text-white bg-[#083458] w-fit">
                Tambahkan Data untuk Toko
            </p>
        </a>
    </div>
</div>

<div class="container p-6 mx-auto mt-8">
    <div class="flex justify-end mb-2 pilihanbulandantahun">
        <div class="flex flex-wrap gap-4">
            <!-- Dropdown Bulan -->
            <div>
                <select id="bulan" name="bulan" class="block px-4 py-2 text-white text-sm border border-[#889EAF] rounded-lg focus:ring-[#083458] focus:border-[#889EAF] bg-[#083458]">
                    <option value="" class="bg-[#264C6C]">Pilih Bulan</option>
                    <option value="1" class="bg-[#264C6C]"> Januari</option>
                    <option value="2" class="bg-[#264C6C]">Februari</option>
                    <option value="3" class="bg-[#264C6C]">Maret</option>
                    <option value="4" class="bg-[#264C6C]">April</option>
                    <option value="5" class="bg-[#264C6C]">Mei</option>
                    <option value="6" class="bg-[#264C6C]">Juni</option>
                    <option value="7" class="bg-[#264C6C]">Juli</option>
                    <option value="8" class="bg-[#264C6C]">Agustus</option>
                    <option value="9" class="bg-[#264C6C]">September</option>
                    <option value="10" class="bg-[#264C6C]">Oktober</option>
                    <option value="11" class="bg-[#264C6C]">November</option>
                    <option value="12" class="bg-[#264C6C]">Desember</option>
                </select>
            </div>

            <!-- Dropdown Tahun -->
            <div>
                <select id="tahun" name="tahun" class="block w-30 px-4 py-2 text-white text-sm border border-[#889EAF] rounded-lg focus:ring-[#083458] focus:border-[#889EAF] bg-[#083458]">
                    <option value="">Pilih Tahun</option>
                    @for ($i = date('Y'); $i >= 2020; $i--)
                    <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                </select>
            </div>
        </div>
    </div>
    <div class="judul-tabel">
        <p class="px-6 py-2 text-xl font-bold font-istok rounded-3xl text-[#083458]">DISTRIBUSI</p>
    </div>
    <div class="overflow-x-auto hide-scrollbar rounded-2xl border-[#889EAF] shadow-md shadow-black/40">
        <table class="min-w-full border-collapse table-auto">
            <thead>
                <tr>
                    <th class="px-6 py-3 text-center text-sm font-medium text-white bg-[#083458] border-2 border-[#889EAF]">Nama Barang</th>
                    <th class="px-6 py-3 text-center text-sm font-medium text-white bg-[#083458] border-2 border-[#889EAF]">Stok Awal</th>
                    <th class="px-6 py-3 text-center text-sm font-medium text-white bg-[#083458] border-2 border-[#889EAF]">MInggu 1</th>
                    <th class="px-4 py-3 text-center text-sm font-medium text-white bg-[#083458] border-2 border-[#889EAF]">Stok Akhir</th>
                    <th class="px-6 py-3 text-center text-sm font-medium text-white bg-[#083458] border-2 border-[#889EAF]">Stok Awal</th>
                    <th class="px-6 py-3 text-center text-sm font-medium text-white bg-[#083458] border-2 border-[#889EAF]">MInggu 2</th>
                    <th class="px-4 py-3 text-center text-sm font-medium text-white bg-[#083458] border-2 border-[#889EAF]">Stok Akhir</th>
                    <th class="px-6 py-3 text-center text-sm font-medium text-white bg-[#083458] border-2 border-[#889EAF]">Stok Awal</th>
                    <th class="px-6 py-3 text-center text-sm font-medium text-white bg-[#083458] border-2 border-[#889EAF]">MInggu 3</th>
                    <th class="px-4 py-3 text-center text-sm font-medium text-white bg-[#083458] border-2 border-[#889EAF]">Stok Akhir</th>
                    <th class="px-6 py-3 text-center text-sm font-medium text-white bg-[#083458] border-2 border-[#889EAF]">Stok Awal</th>
                    <th class="px-6 py-3 text-center text-sm font-medium text-white bg-[#083458] border-2 border-[#889EAF]">MInggu 4</th>
                    <th class="px-4 py-3 text-center text-sm font-medium text-white bg-[#083458] border-2 border-[#889EAF]">Stok Akhir</th>
                    <th class="px-6 py-3 text-center text-sm font-medium text-white bg-[#083458] border-2 border-[#889EAF]">Stok Awal</th>
                    <th class="px-6 py-3 text-center text-sm font-medium text-white bg-[#083458] border-2 border-[#889EAF]">MInggu 5</th>
                    <th class="px-4 py-3 text-center text-sm font-medium text-white bg-[#083458] border-2 border-[#889EAF]">Stok Akhir</th>
                    <th class="px-4 py-3 text-center text-sm font-medium text-white bg-[#083458] border-2 border-[#889EAF]">Keterangan</th>
                </tr>
            </thead>
            <tbody>
                <tr class="border-b-2 border-[#889EAF] hover:bg-gray-50">
                    <td class="px-6 py-4 text-sm font-medium text-gray-900 border-r-2 border-[#889EAF]">Minyak Goreng</td>
                    <td class="px-6 py-4 text-sm text-gray-700 border-r-2 border-[#889EAF]">500</td>
                    <td class="px-6 py-4 text-sm text-gray-700 border-r-2 border-[#889EAF]">100</td>
                    <td class="px-6 py-4 text-sm text-gray-700 border-r-2 border-[#889EAF]">400</td>
                    <td class="px-6 py-4 text-sm text-gray-700 border-r-2 border-[#889EAF]">400</td>
                    <td class="px-6 py-4 text-sm text-gray-700 border-r-2 border-[#889EAF]">90</td>
                    <td class="px-6 py-4 text-sm text-gray-700 border-r-2 border-[#889EAF]">310</td>
                    <td class="px-6 py-4 text-sm text-gray-700 border-r-2 border-[#889EAF]">310</td>
                    <td class="px-6 py-4 text-sm text-gray-700 border-r-2 border-[#889EAF]">80</td>
                    <td class="px-6 py-4 text-sm text-gray-700 border-r-2 border-[#889EAF]">230</td>
                    <td class="px-6 py-4 text-sm text-gray-700 border-r-2 border-[#889EAF]">230</td>
                    <td class="px-6 py-4 text-sm text-gray-700 border-r-2 border-[#889EAF]">70</td>
                    <td class="px-6 py-4 text-sm text-gray-700 border-r-2 border-[#889EAF]">160</td>
                    <td class="px-6 py-4 text-sm text-gray-700 border-r-2 border-[#889EAF]">160</td>
                    <td class="px-6 py-4 text-sm text-gray-700 border-r-2 border-[#889EAF]">60</td>
                    <td class="px-6 py-4 text-sm text-gray-700 border-r-2 border-[#889EAF]">100</td>
                    <td class="px-6 py-4 text-sm text-gray-700 border-r-2 border-[#889EAF]">Cukup lancar</td>
                </tr>
                <tr class="border-b-2 border-[#889EAF] hover:bg-gray-50">
                    <td class="px-6 py-4 text-sm font-medium text-gray-900 border-r-2 border-[#889EAF]">Minyak Goreng</td>
                    <td class="px-6 py-4 text-sm text-gray-700 border-r-2 border-[#889EAF]">500</td>
                    <td class="px-6 py-4 text-sm text-gray-700 border-r-2 border-[#889EAF]">100</td>
                    <td class="px-6 py-4 text-sm text-gray-700 border-r-2 border-[#889EAF]">400</td>
                    <td class="px-6 py-4 text-sm text-gray-700 border-r-2 border-[#889EAF]">400</td>
                    <td class="px-6 py-4 text-sm text-gray-700 border-r-2 border-[#889EAF]">90</td>
                    <td class="px-6 py-4 text-sm text-gray-700 border-r-2 border-[#889EAF]">310</td>
                    <td class="px-6 py-4 text-sm text-gray-700 border-r-2 border-[#889EAF]">310</td>
                    <td class="px-6 py-4 text-sm text-gray-700 border-r-2 border-[#889EAF]">80</td>
                    <td class="px-6 py-4 text-sm text-gray-700 border-r-2 border-[#889EAF]">230</td>
                    <td class="px-6 py-4 text-sm text-gray-700 border-r-2 border-[#889EAF]">230</td>
                    <td class="px-6 py-4 text-sm text-gray-700 border-r-2 border-[#889EAF]">70</td>
                    <td class="px-6 py-4 text-sm text-gray-700 border-r-2 border-[#889EAF]">160</td>
                    <td class="px-6 py-4 text-sm text-gray-700 border-r-2 border-[#889EAF]">160</td>
                    <td class="px-6 py-4 text-sm text-gray-700 border-r-2 border-[#889EAF]">60</td>
                    <td class="px-6 py-4 text-sm text-gray-700 border-r-2 border-[#889EAF]">100</td>
                    <td class="px-6 py-4 text-sm text-gray-700 border-r-2 border-[#889EAF]">Cukup lancar</td>
                </tr>
                <tr class="border-b-2 border-[#889EAF] hover:bg-gray-50">
                    <td class="px-6 py-4 text-sm font-medium text-gray-900 border-r-2 border-[#889EAF]">Minyak Goreng</td>
                    <td class="px-6 py-4 text-sm text-gray-700 border-r-2 border-[#889EAF]">500</td>
                    <td class="px-6 py-4 text-sm text-gray-700 border-r-2 border-[#889EAF]">100</td>
                    <td class="px-6 py-4 text-sm text-gray-700 border-r-2 border-[#889EAF]">400</td>
                    <td class="px-6 py-4 text-sm text-gray-700 border-r-2 border-[#889EAF]">400</td>
                    <td class="px-6 py-4 text-sm text-gray-700 border-r-2 border-[#889EAF]">90</td>
                    <td class="px-6 py-4 text-sm text-gray-700 border-r-2 border-[#889EAF]">310</td>
                    <td class="px-6 py-4 text-sm text-gray-700 border-r-2 border-[#889EAF]">310</td>
                    <td class="px-6 py-4 text-sm text-gray-700 border-r-2 border-[#889EAF]">80</td>
                    <td class="px-6 py-4 text-sm text-gray-700 border-r-2 border-[#889EAF]">230</td>
                    <td class="px-6 py-4 text-sm text-gray-700 border-r-2 border-[#889EAF]">230</td>
                    <td class="px-6 py-4 text-sm text-gray-700 border-r-2 border-[#889EAF]">70</td>
                    <td class="px-6 py-4 text-sm text-gray-700 border-r-2 border-[#889EAF]">160</td>
                    <td class="px-6 py-4 text-sm text-gray-700 border-r-2 border-[#889EAF]">160</td>
                    <td class="px-6 py-4 text-sm text-gray-700 border-r-2 border-[#889EAF]">60</td>
                    <td class="px-6 py-4 text-sm text-gray-700 border-r-2 border-[#889EAF]">100</td>
                    <td class="px-6 py-4 text-sm text-gray-700 border-r-2 border-[#889EAF]">Cukup lancar</td>
                </tr>
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