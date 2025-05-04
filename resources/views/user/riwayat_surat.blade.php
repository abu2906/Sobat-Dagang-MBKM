@extends('layouts.home')

@section('title', 'Riwayat Surat Permohonan')

@section('content')

<head>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<div class="relative w-full h-64">
    <img src="{{ asset('img/bgFormIzin.png') }}" alt="Background" class="w-full h-full object-cover" />

    <a href="{{ url()->previous() }}"
       class="absolute left-14 top-1/2 transform -translate-y-1/2 w-12 h-12 flex items-center justify-center rounded-full bg-white/80 text-black hover:bg-black hover:text-white transition-all duration-300 shadow-lg hover:scale-110">
        <span class="material-symbols-outlined text-2xl">arrow_back</span>
    </a>
</div>
<div class="container mx-auto px-4 -mt-8">
    <div class="flex justify-center mb-6">
        <div class="relative w-1/2 shadow-xl rounded-full bg-white shadow-gray-400/40">
            <span class="material-symbols-outlined absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500">search</span>
            <input type="text" placeholder="Cari"
                   class="w-full p-3 pl-10 rounded-full border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 bg-transparent" />
        </div>
    </div>
    <div class="flex justify-center mb-6">
        <div class="bg-blue-100 p-1 rounded-full flex gap-1">
            <button onclick="window.location.href='{{ route('form_permohonan') }}'"
                    class="text-black font-semibold py-2 px-6 rounded-full transition-all hover:bg-gray-100">
                AJUKAN SURAT PERMOHONAN
            </button>
            <button onclick="window.location.href='{{ route('riwayat_surat') }}'"
                    class="bg-[#083358] text-white font-semibold py-2 px-6 rounded-full shadow transition-all">
                RIWAYAT SURAT
            </button>
        </div>
    </div>
    <div class="container mx-auto px-4 pb-12">
        <table class="min-w-full bg-white border border-gray-300 rounded-xl overflow-hidden shadow-md">
            <thead>
                <tr class="bg-[#083358] text-white font-semibold">
                    <th class="py-3 px-4 border-b rounded-tl-xl">No</th>
                    <th class="py-3 px-4 border-b">Tanggal Dikirim</th>
                    <th class="py-3 px-4 border-b">Jenis Surat</th>
                    <th class="py-3 px-4 border-b">Status</th>
                    <th class="py-3 px-4 border-b rounded-tr-xl">Balasan</th>
                </tr>
            </thead>
            <tbody>
                <!-- Row 1 -->
                <tr class="text-gray-700 hover:bg-gray-50">
                    <td class="py-3 px-4 border-b">1</td>
                    <td class="py-3 px-4 border-b">2025-04-20</td>
                    <td class="py-3 px-4 border-b">Surat Rekomendasi</td>
                    <td class="py-3 px-4 border-b">
                        <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm font-medium">Disetujui</span>
                    </td>
                    <td class="py-3 px-4 border-b">
                        <button onclick="openModal('https://drive.google.com/your-pdf-url')" class="text-blue-600 hover:underline">
                            Lihat
                        </button>
                    </td>
                </tr>

                <!-- Row 2 -->
                <tr class="text-gray-700 hover:bg-gray-50">
                    <td class="py-3 px-4 border-b">2</td>
                    <td class="py-3 px-4 border-b">2025-04-22</td>
                    <td class="py-3 px-4 border-b">Surat Keterangan</td>
                    <td class="py-3 px-4 border-b">
                        <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-sm font-medium">Menunggu</span>
                    </td>
                    <td class="py-3 px-4 border-b">
                        <button onclick="openModal('https://drive.google.com/your-pdf-url')" class="text-blue-600 hover:underline">
                            Lihat
                        </button>
                    </td>
                </tr>

                <!-- Row 3 -->
                <tr class="text-gray-700 hover:bg-gray-50">
                    <td class="py-3 px-4 border-b rounded-bl-xl">3</td>
                    <td class="py-3 px-4 border-b">2025-04-23</td>
                    <td class="py-3 px-4 border-b">Dan Lainnya</td>
                    <td class="py-3 px-4 border-b">
                        <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm font-medium">Ditolak</span>
                    </td>
                    <td class="py-3 px-4 border-b">
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
<div id="modal" class="hidden fixed inset-0 bg-gray-800 bg-opacity-50 flex justify-center items-center">
    <div class="bg-white p-6 rounded-lg w-96">
        <h3 class="text-lg font-semibold mb-4">Lihat Balasan Surat</h3>
        <iframe id="modalContent" class="w-full h-64" src="" frameborder="0"></iframe>
        <a id="downloadBtn" href="" download class="mt-4 inline-block text-blue-600 hover:underline">Unduh PDF</a>
        <button id="closeModal" class="mt-4 text-white bg-red-500 py-2 px-4 rounded">Tutup</button>
    </div>
</div>

@endsection
