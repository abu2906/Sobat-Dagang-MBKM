@extends('layouts.admin')
@section('title', 'Dashboard Kepala Dinas')
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
                    <p class="text-base font-medium text-white">Menunggu Persetujuan</p>
                    <p class="text-2xl font-bold text-white">{{ $totalSuratMenunggu }}</p>
                </div>
            </a>
        </div>
    </div>

    <!-- Tabel Riwayat -->
    <div class="overflow-x-auto rounded-lg shadow-sm mt-8">
        <table class="min-w-full text-sm text-left text-gray-700 bg-white border border-gray-200">
            <thead class="bg-[#0c3252] text-white">
                <tr>
                    <th scope="col" class="text-center px-5 py-3 font-medium border-b border-blue-100">No</th>
                    <th scope="col" class="text-center px-5 py-3 font-medium border-b border-blue-100">No Surat</th>
                    <th scope="col" class="text-center px-5 py-3 font-medium border-b border-blue-100">Tanggal Surat</th>
                    <th scope="col" class="text-center px-5 py-3 font-medium border-b border-blue-100">ID User</th>
                    <th scope="col" class="text-center px-5 py-3 font-medium border-b border-blue-100">Nama Pemohon</th>
                    <th scope="col" class="text-center px-5 py-3 font-medium border-b border-blue-100">Jenis Permohonan</th>
                    <th scope="col" class="text-center px-5 py-3 font-medium border-b border-blue-100">Status</th>
                    <th scope="col" class="text-center px-5 py-3 font-medium border-b border-blue-100">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($suratList as $index => $surat)
                <tr class="hover:bg-blue-50 transition">
                    <td class="px-5 text-center py-3 border-b">{{ $index + 1 }}</td>
                    <td class="px-5 text-center py-3 border-b">{{ $surat->id_surat }}</td>
                    <td class="text-center px-5 py-3 border-b">
                        {{ \Carbon\Carbon::parse($surat->created_at)->format('d-m-Y') }}
                    </td>
                    <td class="px-5 text-center py-3 border-b">{{ $surat->user->id_user ?? '-' }}</td>
                    <td class="px-5 text-center py-3 border-b">{{ $surat->user->nama ?? '-' }}</td>
                    <td class="px-5 text-center py-3 border-b">
                        {{ $surat->jenis_surat ? ucwords(str_replace('_', ' ', $surat->jenis_surat)) : '-' }}
                    </td>
                    <td class="px-5 text-center py-3 border-b">
                        <span class="text-xs font-medium px-2 py-1 rounded-full 
                            {{ $surat->status_kadis == 'Menunggu' ? 'text-yellow-700 bg-yellow-100' : '' }}
                            {{ $surat->status_kadis == 'Disetujui' ? 'text-green-700 bg-green-100' : '' }}
                            {{ $surat->status_kadis == 'Ditolak' ? 'text-red-700 bg-red-100' : '' }}">
                            {{ $surat->status_kadis }}
                        </span>
                    </td>
                    <td class="px-5 text-center py-3 border-b">
                        <div class="flex justify-center gap-2 flex-wrap">
                            @if($surat->status_kadis === 'Menunggu')
                                <form action="{{ route('setujuiKadis', str_replace(['/'], '_', $surat->id_surat)) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="bg-green-500 hover:bg-green-600 text-white text-sm px-4 py-1 rounded">Setujui</button>
                                </form>
                                <button onclick="openTolakModal('{{ $surat->id_surat }}')" class="bg-red-500 hover:bg-red-600 text-white text-sm px-4 py-1 rounded">Tolak</button>
                            @endif
                            @if($surat->dokumen)
                                <button onclick="toggleModal(true, '{{ asset('storage/' . $surat->dokumen) }}', '{{ $surat->status_kadis }}')"
                                    class="text-blue-700 hover:scale-105 transition duration-200 inline-flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0zm7.5 0a10.5 10.5 0 01-21 0 10.5 10.5 0 0121 0z" />
                                    </svg>
                                </button>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center text-gray-500 py-4">
                        Tidak ada data surat yang tersedia.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Tolak -->
<div id="tolakModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex justify-center items-center">
    <div class="bg-white rounded-xl p-6 w-full max-w-md shadow-lg">
        <h2 class="text-xl font-semibold mb-4">Masukkan Alasan Penolakan</h2>
        <form id="formTolak" method="POST">
            @csrf
            @method('PUT')
            <input type="hidden" name="id_surat" id="tolak_id_surat">
            <textarea name="keterangan" id="tolak_keterangan" rows="4" required
                class="w-full border border-gray-300 rounded-lg p-2 mb-4"></textarea>
            <div class="flex justify-end gap-2">
                <button type="button" onclick="closeTolakModal()" class="px-4 py-2 bg-gray-300 rounded">Batal</button>
                <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded">Tolak</button>
            </div>
        </form>
    </div>
</div>

<script>
    function openTolakModal(id) {
        const modal = document.getElementById('tolakModal');
        modal.classList.remove('hidden');
        modal.style.display = 'flex';
        document.getElementById('tolak_id_surat').value = id;
        document.getElementById('formTolak').action = `/kadis/surat/${id}/tolak`;
    }

    function closeTolakModal() {
        const modal = document.getElementById('tolakModal');
        modal.classList.add('hidden');
        modal.style.display = 'none';
    }
</script>
@endsection 