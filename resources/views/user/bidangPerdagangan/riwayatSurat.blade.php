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
        <div class="relative w-1/2 shadow-xl rounded-full bg-white shadow-gray-400/40">
            <span class="material-symbols-outlined absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500">search</span>
            <input type="text" placeholder="Cari"
                   class="w-full p-3 pl-10 rounded-full border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 bg-transparent" />

        </div>
    </div>
    <div class="flex justify-center mb-6">

        
        <div class="bg-blue-100 p-1 rounded-full flex gap-1">
            <button onclick="window.location.href='{{ route('bidangPerdagangan.formPermohonan') }}'"
                    class="text-black font-semibold py-2 px-6 rounded-full transition-all hover:bg-gray-100">
                AJUKAN SURAT PERMOHONAN
            </button>
            <button onclick="window.location.href='{{ route('bidangPerdagangan.riwayatSurat') }}'"
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
                @foreach ($riwayatSurat as $index => $item)
                    <tr class="border-b">
                        <td class="px-4 py-3 text-center">{{ $index + 1 }}</td>
                        <td class="px-4 py-3 text-center">{{ \Carbon\Carbon::parse($item->tanggal_pengajuan)->locale('id')->isoFormat('dddd, D MMMM YYYY') }}</td>
                        <td class="px-4 py-3 text-center">
                            @if($item->jenis_surat == 'surat_rekomendasi')
                                Surat Rekomendasi
                            @elseif($item->jenis_surat == 'surat_keterangan')
                                Surat Keterangan
                            @elseif($item->jenis_surat == 'dan_lainnya')
                                Lainnya
                            @else
                                {{ $item->jenis_surat }}
                            @endif
                        </td>
                        <td class="px-4 py-3 text-center">
                            @if ($item->status == 'disetujui')
                                <span class="text-green-600 font-medium">Disetujui</span>
                            @elseif ($item->status == 'ditolak')
                                <span class="text-red-600 font-medium">Ditolak</span>
                            @else
                                <span class="text-yellow-400 font-medium">Menunggu</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-center">
                            <button onclick="openBalasanModal('{{ $item->balasan ? asset('storage/' . $item->balasan) : '' }}')"
                                class="px-4 py-2 bg-[#8CC5F3] text-black font-bold rounded-full hover:bg-[#7bb6e0] transition-all">
                                Lihat
                            </button>
                        </td>                        
                    </tr>
                @endforeach
            </tbody>
                      
        </table>
    </div>
</div>

<!-- Modal Balasan -->
<div id="modal-balasan" class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black bg-opacity-50">
    <div class="w-11/12 max-w-md p-6 bg-white rounded-2xl shadow-xl text-center">
        <div id="balasanContent">
            <!-- Konten balasan akan diisi oleh JavaScript -->
        </div>
        <div class="mt-6">
            <button onclick="closeBalasanModal()" class="px-4 py-2 bg-gray-300 rounded-full hover:bg-gray-400">
                Tutup
            </button>
        </div>
    </div>
</div>

@endsection

<script>
    function openBalasanModal(fileUrl) {
        const modal = document.getElementById("modal-balasan");
        const content = document.getElementById("balasanContent");

        if (fileUrl) {
            content.innerHTML = `
                <div class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
                    <div class="relative bg-white rounded-xl shadow-xl p-6 w-full max-w-sm text-center">
                        <button class="absolute top-2 right-2 text-gray-500 hover:text-gray-700" onclick="closeBalasanModal()">
                            &times;
                        </button>

                        <div class="flex justify-center mb-4">
                            <div class="bg-yellow-400 rounded-full w-24 h-24 flex items-center justify-center">
                                <img src="/assets/img/icon/pdf.png" alt="PDF" class="w-auto h-16">
                            </div>
                        </div>

                        <h2 class="text-lg font-semibold mb-4">Balasan Surat Anda</h2>

                        <div class="flex justify-center space-x-4">
                            <a href="${fileUrl}" target="_blank"
                               class="bg-[#083358] hover:bg-[#8CC5F3] text-white font-medium py-2 px-6 rounded-full">
                               Lihat
                            </a>
                            <a href="${fileUrl}" download
                               class="bg-[#083358] hover:bg-[#8CC5F3] text-white font-medium py-2 px-6 rounded-full">
                               Unduh
                            </a>
                        </div>
                    </div>
                </div>
            `;
        } else {
            content.innerHTML = `
                <div class="text-center">
                <span class="material-symbols-outlined text-red-600" style="font-size: 6rem;">cancel</span>
                <h2 class="text-lg font-semibold mb-4 text-red-600">Belum ada balasan untuk surat ini.</h2>
            </div>
            `;
        }

        modal.classList.remove("hidden");
    }

    function closeBalasanModal() {
        const modal = document.getElementById("modal-balasan");
        modal.classList.add("hidden");
    }
</script>
