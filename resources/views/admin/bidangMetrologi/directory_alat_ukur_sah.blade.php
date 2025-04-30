@extends('layouts.admin')

@section('tab')

@endsection

@section('content')
    <!-- Filter -->
    <div class="absolute left-1/2 transform -translate-x-1/2 top-[-20px] z-10 w-full">
        <div class="flex flex-wrap px-8 items-center justify-between ">
            <div class="relative flex-grow mt-2 md:mt-0">
                <input type="text" placeholder="Cari" class="pl-10 pr-4 py-2 rounded-full shadow text-sm w-full">
                <span class="absolute left-3 top-2 text-gray-400">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-4.35-4.35M17 11a6 6 0 11-12 0 6 6 0 0112 0z" />
                    </svg>
                </span>
            </div>
            <button class="text-white flex items-center gap-2 bg-blue-700 transition-colors duration-300 hover:bg-[#F49F1E] hover:text-black rounded-full px-8 py-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Tambah Alat Ukur Sah
            </button>  
        </div>
    </div>

    <!-- Tabel Alat Ukur Sah -->
    <div class="overflow-x-auto rounded-lg shadow-sm mt-6">
    <table class="min-w-full text-sm text-left text-gray-700 bg-white border border-gray-200">
            <thead class="bg-[#1e3a8a] text-white">
                <tr>
                    <th scope="col" class="text-center px-5 py-3 font-medium border-b border-blue-100">No</th>
                    <th scope="col" class="text-center px-5 py-3 font-medium border-b border-blue-100">Nama Pemilik</th>
                    <th scope="col" class="text-center px-5 py-3 font-medium border-b border-blue-100">Jenis Alat</th>
                    <th scope="col" class="text-center px-5 py-3 font-medium border-b border-blue-100">Tanggal Tera</th>
                    <th scope="col" class="text-center px-5 py-3 font-medium border-b border-blue-100">Nomor Seri</th>
                    <th scope="col" class="text-center px-5 py-3 font-medium border-b border-blue-100">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr class="hover:bg-blue-50 transition">
                    <td class="px-5 text-center py-3 border-b">1</td>
                    <td class="px-5 text-center py-3 border-b">Abu</td>
                    <td class="px-5 text-center py-3 border-b">Timbangan Digital</td>
                    <td class="px-5 text-center py-3 border-b">12 Januari 2025</td>
                    <td class="px-5 text-center py-3 border-b">TD-1122</td>                 
                    <td class="px-5 text-center py-3 border-b">
                        <button class="p-2 rounded hover:bg-blue-100 transition duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500 hover:text-blue-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5h6M13.5 3.5L18 8l-8.5 8.5H5v-4.5L13.5 3.5z" />
                            </svg>
                        </button>

                        <!-- Tombol Delete -->
                        <button class="p-2 rounded hover:bg-red-100 transition duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-500 hover:text-red-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 7h12M9 7V4h6v3M10 11v6M14 11v6M5 7h14l-1 12a2 2 0 01-2 2H8a2 2 0 01-2-2L5 7z" />
                            </svg>
                        </button>
                    </td>                 
                </tr>
            </tbody>
        </table>
    </div>
@endsection