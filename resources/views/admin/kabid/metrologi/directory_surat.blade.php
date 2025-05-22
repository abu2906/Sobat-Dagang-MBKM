@extends('layouts.admin')

@section('content')
<div class="p-6 bg-gray-100 min-h-screen">
    <div class="relative h-[150px] w-full bg-cover bg-[center_87%]" style="background-image: url('/assets/img/background/user_metrologi.png');">
        <div class="absolute bottom-[-30px] w-full px-8 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4 mb-2">
            <a href="#" class="bg-[#0c3252] rounded-2xl shadow-md hover:shadow-lg transition p-5 flex items-center space-x-4">
                <img src="{{ asset('assets/img/icon/folder-download.png') }}" alt="Surat Masuk" class="w-12 h-12">
                <div>
                    <p class="text-base font-medium text-white">Jumlah Surat Masuk</p>
                    <p class="text-2xl font-bold text-white">{{ $totalSuratMasuk }}</p>
                </div>
            </a>

            <a href="#" class="bg-[#0c3252] rounded-2xl shadow-md hover:shadow-lg transition p-5 flex items-center space-x-4">
                <img src="{{ asset('assets/img/icon/Verif.png') }}" alt="Terverifikasi" class="w-12 h-12">
                <div>
                    <p class="text-base font-medium text-white">Jumlah Surat Terverifikasi</p>
                    <p class="text-2xl font-bold text-white">{{ $totalSuratDiterima }}</p>
                </div>
            </a>

            <a href="#" class="bg-[#0c3252] rounded-2xl shadow-md hover:shadow-lg transition p-5 flex items-center space-x-4">
                <img src="{{ asset('assets/img/icon/surat_ditolak.png') }}" alt="Ditolak" class="w-12 h-12">
                <div>
                    <p class="text-base font-medium text-white">Jumlah Surat Ditolak</p>
                    <p class="text-2xl font-bold text-white">{{ $totalSuratDitolak }}</p>
                </div>
            </a>

            <a href="#" class="bg-[#0c3252] rounded-2xl shadow-md hover:shadow-lg transition p-5 flex items-center space-x-4">
                <img src="{{ asset('assets/img/icon/draf.png') }}" alt="Draft" class="w-12 h-12">
                <div>
                    <p class="text-base font-medium text-white">Surat Menunggu</p>
                    <p class="text-2xl font-bold text-white">{{ $totalSuratMenungguKabid }}</p>
                </div>
            </a>
        </div>
    </div>
    
    @include('component.popup_surat')


    <div class="flex flex-wrap items-center justify-between mt-10 px-4">
        <div class="flex space-x-2 mb-2 md:mb-0">
            <select id="statusFilter" class="px-4 py-2 rounded-full border shadow text-sm">
                <option value="">Semua</option>
                <option value="Menunggu">Menunggu</option>
                <option value="Disetujui">Disetujui</option>
                <option value="Ditolak">Ditolak</option>
            </select>
        </div>
        <div class="relative flex-grow mt-2 md:mt-0">
            <input type="text" id="searchInput" placeholder="Cari" class="pl-10 pr-4 py-2 rounded-full border shadow text-sm w-full">
            <span class="absolute left-3 top-2 text-gray-400">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M17 11a6 6 0 11-12 0 6 6 0 0112 0z" />
                </svg>
            </span>
        </div>
    </div>

    <!-- Tabel Riwayat -->
    <div class="overflow-x-auto rounded-lg shadow-sm mt-5">
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
                @forelse ($suratList->filter(fn($s) => $s->suratBalasan) as $index => $surat)
				<tr class="hover:bg-blue-50 transition data-status='{{ $surat->suratBalasan->status_kepalaBidang }}'">
					<td class="px-5 text-center py-3 border-b">{{ $index + 1 }}</td>
					<td class="px-5 text-center py-3 border-b">{{ $surat->id_surat }}</td>
					<td class="px-5 text-center py-3 border-b">{{ $surat->user->nama ?? '-' }}</td>
					<td class="px-5 text-center py-3 border-b">
						<span class="text-xs font-medium px-2 py-1 rounded-full 
							{{ $surat->suratBalasan->status_kepalaBidang == 'Menunggu' ? 'text-yellow-700 bg-yellow-100' : '' }}
							{{ $surat->suratBalasan->status_kepalaBidang == 'Disetujui' ? 'text-green-700 bg-green-100' : '' }}
							{{ $surat->suratBalasan->status_kepalaBidang == 'Ditolak' ? 'text-red-700 bg-red-100' : '' }}">
							{{ $surat->suratBalasan->status_kepalaBidang }}
						</span>
					</td>
					<td class="px-5 text-center py-3 border-b">
                        <div class="flex justify-center flex-wrap gap-2">
                            @if ($surat->suratBalasan->status_kepalaBidang === 'Menunggu')
                                <!-- TOMBOL TERIMA -->
                                <form action="{{ route('terimaKabid', ['encoded_id' => base64_encode($surat->suratBalasan->id_surat_balasan)]) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="bg-green-500 hover:bg-green-600 text-white text-sm px-4 py-1 rounded">Terima</button>
                                </form>

                                <!-- TOMBOL TOLAK -->
                                <form action="{{ route('tolakKabid', ['encoded_id' => base64_encode($surat->suratBalasan->id_surat_balasan)]) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white text-sm px-4 py-1 rounded">Tolak</button>
                                </form>
                            @endif

                            <!-- TOMBOL PREVIEW -->
                            <button onclick="toggleModal(true, '{{ asset('storage/' . $surat->suratBalasan->path_dokumen) }}', '{{ $surat->status }}')"
                                class="text-blue-600 hover:scale-105 transition duration-200 inline-flex items-center justify-center" title="Lihat Surat Keluar">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 6h14a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2V8a2 2 0 012-2z" />
                                </svg>
                            </button>
                        </div>
                    </td>


				</tr>
				@empty
				<tr>
					<td colspan="5" class="text-center text-gray-500 py-4">
						Tidak ada data surat metrologi yang tersedia.
					</td>
				</tr>
				@endforelse

            </tbody>
        </table>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const statusFilter = document.getElementById("statusFilter");
    const searchInput = document.getElementById("searchInput");
    const rows = document.querySelectorAll("tbody tr");

    function applyFilters() {
        const selectedStatus = statusFilter.value.toLowerCase();
        const keyword = searchInput.value.toLowerCase();

        rows.forEach(row => {
            // Skip header row
            if (!row.querySelector('td')) return;

            const statusCell = row.querySelector('td:nth-child(4)');
            const status = statusCell ? statusCell.textContent.trim().toLowerCase() : '';
            const rowText = row.textContent.toLowerCase();

            const matchStatus = !selectedStatus || status === selectedStatus;
            const matchSearch = !keyword || rowText.includes(keyword);

            row.style.display = (matchStatus && matchSearch) ? '' : 'none';
        });
    }

    // Apply filters when status changes
    statusFilter.addEventListener("change", applyFilters);
    
    // Apply filters when search input changes
    searchInput.addEventListener("input", applyFilters);
    
    // Apply initial filters
    applyFilters();
});
</script>

@endsection
