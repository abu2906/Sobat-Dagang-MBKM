@extends('layouts.metrologi.admin')

@section('content')
<div class="p-6 bg-gray-100 min-h-screen">
    <div class="relative h-[150px] w-full bg-cover bg-[center_87%]" style="background-image: url('/assets/img/background/user_metrologi.png');">
        <div class="absolute bottom-[-30px] w-full px-8 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4 mb-2">
            <a href="#" class="bg-[#0c3252] rounded-2xl shadow-md hover:shadow-lg transition p-5 flex items-center space-x-4">
                <img src="{{ asset('assets/img/icon/folder-download.png') }}" alt="Surat Masuk" class="w-12 h-12">
                <div>
                    <p class="text-base font-medium text-white">Total Surat</p>
                    <p class="text-2xl font-bold text-white">{{ $totalSurat }}</p>
                </div>
            </a>

            <a href="#" class="bg-[#0c3252] rounded-2xl shadow-md hover:shadow-lg transition p-5 flex items-center space-x-4">
                <img src="{{ asset('assets/img/icon/Verif.png') }}" alt="Terverifikasi" class="w-12 h-12">
                <div>
                    <p class="text-base font-medium text-white">Surat Disetujui</p>
                    <p class="text-2xl font-bold text-white">{{ $totalSuratDisetujui }}</p>
                </div>
            </a>

            <a href="#" class="bg-[#0c3252] rounded-2xl shadow-md hover:shadow-lg transition p-5 flex items-center space-x-4">
                <img src="{{ asset('assets/img/icon/surat_ditolak.png') }}" alt="Ditolak" class="w-12 h-12">
                <div>
                    <p class="text-base font-medium text-white">Surat Ditolak</p>
                    <p class="text-2xl font-bold text-white">{{ $totalSuratDitolak }}</p>
                </div>
            </a>

            <a href="#" class="bg-[#0c3252] rounded-2xl shadow-md hover:shadow-lg transition p-5 flex items-center space-x-4">
                <img src="{{ asset('assets/img/icon/draf.png') }}" alt="Draft" class="w-12 h-12">
                <div>
                    <p class="text-base font-medium text-white">Surat Menunggu</p>
                    <p class="text-2xl font-bold text-white">{{ $totalSuratMenunggu }}</p>
                </div>
            </a>
        </div>
    </div>
    
    @include('component.popup_surat')

    <!-- Tabel Riwayat -->
    <div class="overflow-x-auto rounded-lg shadow-sm mt-8">
        <table class="min-w-full text-sm text-left text-gray-700 bg-white border border-gray-200">
            <thead class="bg-[#0c3252] text-white">
                <tr>
                    <th scope="col" class="text-center px-5 py-3 font-medium border-b border-blue-100">No</th>
                    <th scope="col" class="text-center px-5 py-3 font-medium border-b border-blue-100">No Surat</th>
                    <th scope="col" class="text-center px-5 py-3 font-medium border-b border-blue-100">Nama Pemohon</th>
                    <th scope="col" class="text-center px-5 py-3 font-medium border-b border-blue-100">Status</th>
                    <th scope="col" class="text-center px-5 py-3 font-medium border-b border-blue-100">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($suratList as $index => $surat)
                <tr class="hover:bg-blue-50 transition">
                    <td class="px-5 text-center py-3 border-b">{{ $index + 1 }}</td>
                    <td class="px-5 text-center py-3 border-b">{{ $surat->id_surat_balasan }}</td>
                    <td class="px-5 text-center py-3 border-b">{{ $surat->suratMetrologi->user->nama ?? '-' }}</td>
                    <td class="px-5 text-center py-3 border-b">
                        <span class="text-xs font-medium px-2 py-1 rounded-full 
                            {{ $surat->status_kadis == 'Menunggu' ? 'text-yellow-700 bg-yellow-100' : '' }}
                            {{ $surat->status_kadis == 'Disetujui' ? 'text-green-700 bg-green-100' : '' }}
                            {{ $surat->status_kadis == 'Ditolak' ? 'text-red-700 bg-red-100' : '' }}">
                            {{ $surat->status_kadis }}
                        </span>
                    </td>
                    <td class="px-5 text-center py-3 border-b space-y-1">
                        @if ($surat->status_kadis === 'Menunggu')
                            <!-- TOMBOL TERIMA -->
                            <form action="{{ route('setujuiKadis', ['encoded_id' => base64_encode($surat->id_surat_balasan)]) }}" method="POST" class="inline-block">
                                @csrf
                                <button type="submit" class="bg-green-500 hover:bg-green-600 text-white text-sm px-4 py-1 rounded">Terima</button>
                            </form>

                            <!-- TOMBOL TOLAK -->
                            <form action="{{ route('tolakKadis', ['encoded_id' => base64_encode($surat->id_surat_balasan)]) }}" method="POST" class="inline-block">
                                @csrf
                                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white text-sm px-4 py-1 rounded">Tolak</button>
                            </form>
                        @endif

                        <!-- TOMBOL PREVIEW -->
                        <button onclick="toggleModal(true, '{{ asset('storage/' . $surat->path_dokumen) }}', '{{ $surat->status_kadis }}')"
                            class="text-black text-lg ml-1 hover:text-blue-700">
                            👁️
                        </button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center text-gray-500 py-4">
                        Tidak ada data surat yang tersedia.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection 