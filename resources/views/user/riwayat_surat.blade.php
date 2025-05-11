@extends('layouts.home')

@section('title', 'Riwayat Surat Permohonan')

@section('content')

<head>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" />
</head>
<div class="relative w-full h-64">

    <img src="{{ asset('assets\img\background\user_industri.png') }}" alt="Background" class="object-cover w-full h-full" />

    <a href="{{ url()->previous() }}"
        class="absolute flex items-center justify-center w-12 h-12 text-black transition-all duration-300 transform -translate-y-1/2 rounded-full shadow-lg left-14 top-1/2 bg-white/80 hover:bg-black hover:text-white hover:scale-110">
        <span class="text-2xl material-symbols-outlined">arrow_back</span>
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
    <div class="flex justify-center mb-6">


        <div class="flex gap-1 p-1 bg-blue-100 rounded-full">
            <button onclick="window.location.href='{{ route('form.permohonan') }}'"
                class="px-6 py-2 font-semibold text-black transition-all rounded-full hover:bg-gray-100">
                AJUKAN SURAT PERMOHONAN
            </button>
            <button onclick="window.location.href='{{ route('riwayat.surat') }}'"
                class="bg-[#083358] text-white font-semibold py-2 px-6 rounded-full shadow transition-all">

                RIWAYAT SURAT
            </button>
        </div>
    </div>
    <div class="container px-4 pb-12 mx-auto">
        <table class="min-w-full overflow-hidden bg-white border border-gray-300 shadow-md rounded-xl">
            <thead>
                <tr class="bg-[#083358] text-white font-semibold">
                    <th class="px-4 py-3 border-b rounded-tl-xl">No</th>
                    <th class="px-4 py-3 border-b">Tanggal Dikirim</th>
                    <th class="px-4 py-3 border-b">Jenis Surat</th>
                    <th class="px-4 py-3 border-b">Status</th>
                    <th class="px-4 py-3 border-b rounded-tr-xl">Balasan</th>
                </tr>
            </thead>
            <tbody>
                <!-- Row 1 -->
                <tr class="text-gray-700 hover:bg-gray-50">
                    <td class="px-4 py-3 border-b">1</td>
                    <td class="px-4 py-3 border-b">2025-04-20</td>
                    <td class="px-4 py-3 border-b">Surat Rekomendasi</td>
                    <td class="px-4 py-3 border-b">
                        <span class="px-3 py-1 text-sm font-medium text-green-700 bg-green-100 rounded-full">Disetujui</span>
                    </td>
                    <td class="px-4 py-3 border-b">
                        <button onclick="openModal('https://drive.google.com/your-pdf-url')" class="text-blue-600 hover:underline">
                            Lihat
                        </button>
                    </td>
                </tr>

                <!-- Row 2 -->
                <tr class="text-gray-700 hover:bg-gray-50">
                    <td class="px-4 py-3 border-b">2</td>
                    <td class="px-4 py-3 border-b">2025-04-22</td>
                    <td class="px-4 py-3 border-b">Surat Keterangan</td>
                    <td class="px-4 py-3 border-b">
                        <span class="px-3 py-1 text-sm font-medium text-yellow-700 bg-yellow-100 rounded-full">Menunggu</span>
                    </td>
                    <td class="px-4 py-3 border-b">
                        <button onclick="openModal('https://drive.google.com/your-pdf-url')" class="text-blue-600 hover:underline">
                            Lihat
                        </button>
                    </td>
                </tr>

                <!-- Row 3 -->
                <tr class="text-gray-700 hover:bg-gray-50">
                    <td class="px-4 py-3 border-b rounded-bl-xl">3</td>
                    <td class="px-4 py-3 border-b">2025-04-23</td>
                    <td class="px-4 py-3 border-b">Dan Lainnya</td>
                    <td class="px-4 py-3 border-b">
                        <span class="px-3 py-1 text-sm font-medium text-red-700 bg-red-100 rounded-full">Ditolak</span>
                    </td>
                    <td class="px-4 py-3 border-b">
                        <button onclick="openModal('')" class="text-blue-600 hover:underline">
                            Lihat
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal -->
<div id="modal" class="fixed inset-0 flex items-center justify-center hidden bg-gray-800 bg-opacity-50">
    <div class="p-6 bg-white rounded-lg w-96">
        <h3 class="mb-4 text-lg font-semibold">Lihat Balasan Surat</h3>
        <iframe id="modalContent" class="w-full h-64" src="" frameborder="0"></iframe>
        <a id="downloadBtn" href="" download class="inline-block mt-4 text-blue-600 hover:underline">Unduh PDF</a>
        <button id="closeModal" class="px-4 py-2 mt-4 text-white bg-red-500 rounded">Tutup</button>
    </div>
</div>

@endsection