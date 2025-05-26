@extends('layouts.metrologi.kadis')

@section('content')
<!-- Tambahkan SweetAlert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Modal untuk preview dokumen -->
<div id="previewModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-lg shadow-xl w-full max-w-4xl">
            <div class="flex justify-between items-center p-4 border-b">
                <h3 class="text-lg font-semibold text-gray-900">Preview Dokumen</h3>
                <button onclick="closeModal()" class="text-gray-400 hover:text-gray-500">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div class="p-4">
                <iframe id="previewFrame" class="w-full h-[70vh]" frameborder="0"></iframe>
            </div>
        </div>
    </div>
</div>

<div class="p-6 bg-gray-100 min-h-screen">
    <div class="relative h-[150px] w-full bg-cover bg-[center_87%]" style="background-image: url('/assets/img/background/user_metrologi.png');">
		<div class="absolute bottom-[-30px] w-full px-8 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4 mb-2">
			<a href="#" class="bg-[#0c3252] rounded-2xl shadow-md hover:shadow-lg transition p-5 flex items-center space-x-4">
				<img src="{{ asset('assets/img/icon/folder-download.png') }}" alt="Surat Masuk" class="w-12 h-12">
				<div>
					<p class="text-base font-medium text-white">Jumlah Surat Masuk</p>
					<p class="text-2xl font-bold text-white">{{ $totalSurat }}</p>
				</div>
			</a>

			<a href="#" class="bg-[#0c3252] rounded-2xl shadow-md hover:shadow-lg transition p-5 flex items-center space-x-4">
				<img src="{{ asset('assets/img/icon/Verif.png') }}" alt="Terverifikasi" class="w-12 h-12">
				<div>
					<p class="text-base font-medium text-white">Jumlah Surat Terverifikasi</p>
					<p class="text-2xl font-bold text-white">{{ $totalSuratDisetujui }}</p>
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
					<p class="text-base font-medium text-white">Jumlah Surat Menunggu</p>
                	<p class="text-2xl font-bold text-white">{{ $totalSuratMenunggu }}</p>
				</div>
			</a>
		</div>
	</div>

    <div class="flex flex-wrap items-center justify-between mt-10 px-4">
        <div class="flex space-x-2 mb-2 md:mb-0">
            <form id="filterForm" method="GET" class="flex items-center space-x-4">
                <select name="status" id="statusFilter" class="px-4 py-2 rounded-full border shadow text-sm" onchange="this.form.submit()">
                    <option value="">Semua</option>
                    <option value="Menunggu" {{ request('status') === 'Menunggu' ? 'selected' : '' }}>Menunggu</option>
                    <option value="Disetujui" {{ request('status') === 'Disetujui' ? 'selected' : '' }}>Disetujui</option>
                    <option value="Ditolak" {{ request('status') === 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
                </select>
            </form>
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
    <div class="p-6">
        <div class="overflow-x-auto rounded-lg shadow-sm">
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
                        <td class="px-5 text-center py-3 border-b">
                            <div class="flex flex-wrap items-center justify-center gap-2">
                                @if ($surat->status_kadis === 'Menunggu')
                                    <button onclick="confirmAction('setujui', '{{ base64_encode($surat->id_surat_balasan) }}')" 
                                        class="bg-green-500 hover:bg-green-600 text-white text-sm px-4 py-1 rounded">
                                        Terima
                                    </button>
                                    <button onclick="confirmAction('tolak', '{{ base64_encode($surat->id_surat_balasan) }}')" 
                                        class="bg-red-500 hover:bg-red-600 text-white text-sm px-4 py-1 rounded">
                                        Tolak
                                    </button>
                                @endif

                                <!-- TOMBOL PREVIEW -->
                                <button onclick="openPreview('{{ asset('storage/' . $surat->path_dokumen) }}')"
                                class="text-blue-700 hover:scale-105 transition duration-200 inline-flex items-center justify-center" 
                                title="Lihat Surat">
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
                            Tidak ada data surat yang tersedia.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-4">
            {{ $suratList->links('pagination::tailwind') }}
        </div>
    </div> 
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const searchInput = document.getElementById("searchInput");
    const rows = document.querySelectorAll("tbody tr");

    function applySearch() {
        const keyword = searchInput.value.toLowerCase();

        rows.forEach(row => {
            if (!row.querySelector('td')) return;
            const rowText = row.textContent.toLowerCase();
            const matchSearch = !keyword || rowText.includes(keyword);
            row.style.display = matchSearch ? '' : 'none';
        });
    }

    searchInput.addEventListener("input", applySearch);
    applySearch();
});

function openPreview(url) {
    const modal = document.getElementById('previewModal');
    const frame = document.getElementById('previewFrame');
    
    frame.src = url;
    modal.classList.remove('hidden');
}

function closeModal() {
    const modal = document.getElementById('previewModal');
    const frame = document.getElementById('previewFrame');
    
    modal.classList.add('hidden');
    frame.src = '';
}

function confirmAction(action, id) {
    let message = '';
    let confirmButtonText = '';
    let confirmButtonClass = '';
    let routeUrl = '';

    switch(action) {
        case 'setujui':
            message = 'Apakah Anda yakin ingin menyetujui surat ini?';
            confirmButtonText = 'Ya, Setujui';
            confirmButtonClass = '#10B981';
            routeUrl = '{{ url("kadis/surat") }}/' + id + '/setujui';
            break;
        case 'tolak':
            message = 'Apakah Anda yakin ingin menolak surat ini?';
            confirmButtonText = 'Ya, Tolak';
            confirmButtonClass = '#EF4444';
            routeUrl = '{{ url("kadis/surat") }}/' + id + '/tolak';
            break;
        default:
            return;
    }

    Swal.fire({
        title: 'Konfirmasi',
        text: message,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: confirmButtonText,
        cancelButtonText: 'Batal',
        confirmButtonColor: confirmButtonClass,
        cancelButtonColor: '#6B7280',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = routeUrl;
            
            const csrfToken = document.createElement('input');
            csrfToken.type = 'hidden';
            csrfToken.name = '_token';
            csrfToken.value = '{{ csrf_token() }}';
            
            form.appendChild(csrfToken);
            document.body.appendChild(form);
            form.submit();
        }
    });
}
</script>

<style>
.preview-modal {
    z-index: 9999 !important;
}
</style>

@endsection 

