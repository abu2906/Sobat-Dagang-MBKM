@extends('layouts.adminIndustri')
@section('title', 'Dashboard Perdagangan')

@section('content')
<div class="p-6 space-y-6">
    <!-- Top Section -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Left Side (Jumlah Surat Balasan & Akumulasi Perkembangan) -->
        <div class="bg-white p-6 rounded-lg shadow-lg flex flex-col justify-between">
            <div class="flex justify-between">
                <div>
                    <h3 class="text-lg font-semibold">Jumlah Surat Balasan</h3>
                    <p class="text-4xl font-bold">200</p>
                    <p class="text-sm">Total Seluruh Sektor</p>
                </div>
            </div>
        </div>

        <div>
            <h3 class="text-lg font-semibold">Akumulasi Perkembangan</h3>
            <p class="text-4xl font-bold">210</p>
            <p class="text-sm">Hingga Bulan Ini</p>
        </div>

        <!-- Middle Section (Data IKM Dropdown & Filter) -->
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <div class="mb-4">
                <label for="data-ikm" class="block text-sm font-medium">Data IKM</label>
                <select id="data-ikm" class="block w-full mt-1 rounded-md border-gray-300">
                    <option>Soreang</option>
                    <option>Bandung</option>
                    <!-- Add other options as needed -->
                </select>
            </div>
            <div>
                <button class="text-blue-500">Filter</button>
            </div>
        </div>

        <!-- Right Side (Informasi Tambahan & Grafik Perkembangan) -->
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <div class="text-sm">
                <p class="font-semibold">Industri Terdaftar</p>
                <p class="text-xl">14 Usaha</p>
                <p>3 Penggiling Daging</p>
                <p>11 Penggiling Ikan</p>
            </div>

            <div class="mt-4">
                <p class="font-semibold">Tenaga Kerja</p>
                <p class="text-xl">63 Laki-Laki</p>
                <p>57 Perempuan</p>
            </div>

            <!-- Informasi Tambahan (Pie Chart Placeholder) -->
            <div class="mt-6">
                <p class="font-semibold">Informasi Tambahan</p>
                <div class="flex justify-center mt-2">
                    <div class="w-24 h-24 bg-gray-200 rounded-full flex items-center justify-center text-xl">50%</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Table Section -->
    <div class="overflow-x-auto bg-white p-6 rounded-lg shadow-lg">
        <table class="min-w-full table-auto">
            <thead>
                <tr class="bg-gray-100">
                    <th class="py-2 px-4 text-left">Nama Usaha</th>
                    <th class="py-2 px-4 text-left">Nama Pemilik</th>
                    <th class="py-2 px-4 text-left">Nama Produk</th>
                    <th class="py-2 px-4 text-left">T.K. (Org)</th>
                    <th class="py-2 px-4 text-left">L</th>
                    <th class="py-2 px-4 text-left">P</th>
                </tr>
            </thead>
            <tbody>
                <!-- Repeat rows as needed -->
                <tr class="border-b">
                    <td class="py-2 px-4">US.Reski</td>
                    <td class="py-2 px-4">Rahkmad Qadri</td>
                    <td class="py-2 px-4">PENGGILING DAGING</td>
                    <td class="py-2 px-4">2</td>
                    <td class="py-2 px-4">0</td>
                    <td class="py-2 px-4">0</td>
                </tr>
                <!-- Add more rows similarly -->
            </tbody>
        </table>
    </div>

    <!-- Bottom Section (Grafik Perkembangan) -->
    <div class="bg-white p-6 rounded-lg shadow-lg">
        <p class="font-semibold">Grafik Perkembangan</p>
        <!-- You can replace this with an actual chart component -->
        <div class="mt-4 bg-gray-200 h-48 flex items-center justify-center text-xl">Chart Placeholder</div>
    </div>
</div>
@endsection