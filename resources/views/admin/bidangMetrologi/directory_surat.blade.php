@extends('layouts.metrologi.admin')

@section('content')
<div class="p-6 bg-gray-100 min-h-screen">
	<div class="relative h-[150px] w-full bg-cover bg-[center_87%]" style="background-image: url('/assets/img/background/user_metrologi.png');">
		<div class="absolute bottom-[-30px] w-full px-8 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4 mb-2">
			<a href="#" class="bg-[#0c3252] rounded-2xl shadow-md hover:shadow-lg transition p-5 flex items-center space-x-4">
				<img src="{{ asset('assets/img/icon/folder-download.png') }}" alt="Surat Masuk" class="w-12 h-12">
				<div>
					<p class="text-base font-medium text-white">Jumlah Surat Masuk</p>
					<p class="text-2xl font-bold text-white">{{ $dataSuratAdmin['totalSuratMasuk'] }}</p>
				</div>
			</a>

			<a href="#" class="bg-[#0c3252] rounded-2xl shadow-md hover:shadow-lg transition p-5 flex items-center space-x-4">
				<img src="{{ asset('assets/img/icon/Verif.png') }}" alt="Disetujui" class="w-12 h-12">
				<div>
					<p class="text-base font-medium text-white">Jumlah Surat Disetujui</p>
					<p class="text-2xl font-bold text-white">{{ $dataSuratAdmin['totalSuratMasukDisetujui'] }}</p>
				</div>
			</a>

			<a href="#" class="bg-[#0c3252] rounded-2xl shadow-md hover:shadow-lg transition p-5 flex items-center space-x-4">
				<img src="{{ asset('assets/img/icon/surat_ditolak.png') }}" alt="Ditolak" class="w-12 h-12">
				<div>
					<p class="text-base font-medium text-white">Jumlah Surat Ditolak</p>
					<p class="text-2xl font-bold text-white">{{ $dataSuratAdmin['totalSuratDitolak'] }}</p>
				</div>
			</a>

			<a href="#" class="bg-[#0c3252] rounded-2xl shadow-md hover:shadow-lg transition p-5 flex items-center space-x-4">
				<img src="{{ asset('assets/img/icon/draf.png') }}" alt="Draft" class="w-12 h-12">
				<div>
					<p class="text-base font-medium text-white">Jumlah Surat Menunggu</p>
                	<p class="text-2xl font-bold text-white">{{ $dataSuratAdmin['totalSuratMenunggu'] }}</p>
				</div>
			</a>
		</div>
	</div>
	
	@include('component.popup_surat')
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
			modal.style.display = 'flex'; // Supaya flexbox aktif untuk center
			document.getElementById('tolak_id_surat').value = id;
			document.getElementById('formTolak').action = `/admin/surat/${btoa(id)}/tolak`;
		}

		function closeTolakModal() {
			const modal = document.getElementById('tolakModal');
			modal.classList.add('hidden');
			modal.style.display = 'none';
		}
	</script>

	<!-- Modal Lihat Keterangan Penolakan -->
	<div id="modalKeteranganTolak" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex justify-center items-center">
		<div class="bg-white rounded-xl p-6 w-full max-w-md shadow-lg">
			<h2 class="text-xl font-semibold mb-4">Alasan Penolakan</h2>
			<p id="isiKeteranganTolak" class="text-gray-700 mb-6"></p>
			<div class="text-right">
				<button onclick="closeKeteranganTolak()" class="px-4 py-2 bg-gray-300 rounded">Tutup</button>
			</div>
		</div>
	</div>

	<script>
		function openKeteranganTolak(keterangan) {
			document.getElementById('isiKeteranganTolak').innerText = keterangan || 'Tidak ada keterangan tersedia.';
			document.getElementById('modalKeteranganTolak').classList.remove('hidden');
			document.getElementById('modalKeteranganTolak').style.display = 'flex';
		}

		function closeKeteranganTolak() {
			document.getElementById('modalKeteranganTolak').classList.add('hidden');
			document.getElementById('modalKeteranganTolak').style.display = 'none';
		}
	</script>

	<!-- Modal Konfirmasi Selesai -->
	<div id="modalSelesai" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex justify-center items-center">
		<div class="bg-white rounded-xl p-6 w-full max-w-md shadow-lg">
			<h2 class="text-xl font-semibold mb-4">Konfirmasi</h2>
			<p class="text-gray-700 mb-6">Apakah Anda yakin ingin menandai surat ini sebagai selesai?</p>
			<form id="formSelesai" method="POST">
				@csrf
				@method('PUT')
				<div class="flex justify-end gap-2">
					<button type="button" onclick="closeModalSelesai()" class="px-4 py-2 bg-gray-300 rounded">Batal</button>
					<button type="submit" class="px-4 py-2 bg-green-600 text-white rounded">Ya</button>
				</div>
			</form>
		</div>
	</div>

	<script>
		function openModalSelesai(url) {
			document.getElementById('modalSelesai').classList.remove('hidden');
			document.getElementById('modalSelesai').style.display = 'flex';
			document.getElementById('formSelesai').action = url;
		}

		function closeModalSelesai() {
			document.getElementById('modalSelesai').classList.add('hidden');
			document.getElementById('modalSelesai').style.display = 'none';
		}
	</script>

	<div class="flex flex-wrap items-center justify-between mt-10 px-4">
        <div class="flex space-x-2 mb-2 md:mb-0">
            <select id="statusFilter" class="px-4 py-2 rounded-full border shadow text-sm">
                <option value="">Semua</option>
                <option value="Menunggu">Menunggu</option>
                <option value="Diproses">Diproses</option>
                <option value="Diterima">Diterima</option>
                <option value="Menunggu Persetujuan">Menunggu Persetujuan</option>
                <option value="Butuh Revisi">Butuh Revisi</option>
                <option value="Selesai">Selesai</option>
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
	<div class="overflow-x-auto rounded-lg shadow-sm mt-4">
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
							{{ $surat->status_admin == 'Menunggu' ? 'text-yellow-700 bg-yellow-100' : '' }}
							{{ $surat->status_admin == 'Diproses' ? 'text-blue-700 bg-blue-100' : '' }}
							{{ $surat->status_admin == 'Ditolak' ? 'text-red-700 bg-red-100' : '' }}
							{{ $surat->status_admin == 'Menunggu Persetujuan' ? 'text-indigo-700 bg-indigo-100' : '' }}
							{{ $surat->status_admin == 'Diterima' ? 'text-cyan-700 bg-cyan-100' : '' }}
							{{ $surat->status_admin == 'Selesai' ? 'text-green-700 bg-green-100' : '' }}
							{{ $surat->status_admin == 'Butuh Revisi' ? 'text-orange-700 bg-orange-100' : '' }}">
							{{ $surat->status_admin }}
						</span>
					</td>
					<td class="px-5 text-center py-3 border-b">
					<div class="flex justify-center gap-2 flex-wrap">
						@if ($surat->status_admin === 'Diterima')
							<button onclick="openModalSelesai('{{ route('surat.selesai', str_replace(['/'], '_', $surat->id_surat)) }}')"
								class="text-green-600 hover:scale-105 transition duration-200 inline-flex items-center justify-center" title="Tandai Selesai">
								<svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
								</svg>
							</button>
							<button onclick="toggleModal(true, '{{ asset('storage/' . $surat->suratBalasan->path_dokumen) }}', '{{ $surat->status_admin }}')"
								class="text-green-600 hover:scale-105 transition duration-200 inline-flex items-center justify-center" title="Lihat Surat Balasan">
								<svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
									d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 6h14a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2V8a2 2 0 012-2z" />
								</svg>
							</button>
							<button onclick="toggleModal(true, '{{ asset('storage/' . $surat->dokumen) }}', '{{ $surat->status_admin }}')"
								class="text-blue-700 hover:scale-105 transition duration-200 inline-flex items-center justify-center">
								<svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0zm7.5 0a10.5 10.5 0 01-21 0 10.5 10.5 0 0121 0z" />
								</svg>
							</button>
						@elseif ($surat->status_admin === 'Selesai')
							<a href="{{ route('management-uttp-metrologi', ['auto_open' => 'true', 'user_id' => $surat->user_id, 'jenis_permohonan' => $surat->jenis_surat]) }}"
								class="text-blue-600 hover:scale-105 transition duration-200 inline-flex items-center justify-center" title="Tambah UTTP">
								<svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
								</svg>
							</a>
							<button onclick="toggleModal(true, '{{ asset('storage/' . $surat->suratBalasan->path_dokumen) }}', '{{ $surat->status_admin }}')"
								class="text-green-600 hover:scale-105 transition duration-200 inline-flex items-center justify-center" title="Lihat Surat Balasan">
								<svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
									d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 6h14a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2V8a2 2 0 012-2z" />
								</svg>
							</button>
							<button onclick="toggleModal(true, '{{ asset('storage/' . $surat->dokumen) }}', '{{ $surat->status_admin }}')"
								class="text-blue-700 hover:scale-105 transition duration-200 inline-flex items-center justify-center">
								<svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0zm7.5 0a10.5 10.5 0 01-21 0 10.5 10.5 0 0121 0z" />
								</svg>
							</button>
						@elseif ($surat->status_admin === 'Diproses' || $surat->status_admin === 'Menunggu Persetujuan')
							@if($surat->suratBalasan)
								@if($surat->suratBalasan->status_surat_keluar === 'Draft')
									<a href="{{ route('create-surat-balasan', str_replace(['/'], '_', $surat->id_surat)) }}"
										class="bg-yellow-500 hover:bg-yellow-600 text-white text-sm px-4 py-1 rounded">
										Lanjutkan Draft
									</a>
									<button onclick="toggleModal(true, '{{ asset('storage/' . $surat->dokumen) }}', '{{ $surat->status_admin }}')"
										class="text-blue-700 hover:scale-105 transition duration-200 inline-flex items-center justify-center">
										<svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
											<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0zm7.5 0a10.5 10.5 0 01-21 0 10.5 10.5 0 0121 0z" />
										</svg>
									</button>
								@elseif($surat->suratBalasan->path_dokumen)
									<!-- Tombol untuk lihat surat balasan -->
									<button onclick="toggleModal(true, '{{ asset('storage/' . $surat->suratBalasan->path_dokumen) }}', '{{ $surat->status_admin }}')"
										class="text-green-600 hover:scale-105 transition duration-200 inline-flex items-center justify-center" title="Lihat Surat Balasan">
										<svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
											<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
											d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 6h14a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2V8a2 2 0 012-2z" />
										</svg>
									</button>
									<button onclick="toggleModal(true, '{{ asset('storage/' . $surat->dokumen) }}', '{{ $surat->status_admin }}')"
										class="text-blue-700 hover:scale-105 transition duration-200 inline-flex items-center justify-center">
										<svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
											<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0zm7.5 0a10.5 10.5 0 01-21 0 10.5 10.5 0 0121 0z" />
										</svg>
									</button>
								@endif
							@else
								<a href="{{ route('create-surat-balasan', str_replace(['/'], '_', $surat->id_surat)) }}"
									class="bg-blue-900 hover:bg-blue-800 text-white text-sm px-4 py-1 rounded">
									Buat Surat
								</a>
							@endif

						@elseif ($surat->status_admin === 'Butuh Revisi')
							<!-- Tombol Edit revisi surat balasan -->
							<a href="{{ route('edit-surat-balasan', str_replace(['/'], '_', $surat->id_surat)) }}"
								class="text-yellow-600 hover:scale-110 transition duration-200 inline-flex items-center justify-center" title="Revisi Surat Balasan">
								<svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
									d="M12 20h9" />
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
									d="M16.5 3.5a2.121 2.121 0 113 3L7 19l-4 1 1-4 12.5-12.5z" />
								</svg>
							</a>
							@if($surat->suratBalasan && $surat->suratBalasan->path_dokumen)
							<button onclick="toggleModal(true, '{{ asset('storage/' . $surat->suratBalasan->path_dokumen) }}', '{{ $surat->status_admin }}')"
								class="text-green-600 hover:scale-105 transition duration-200 inline-flex items-center justify-center" title="Lihat Surat Balasan">
								<svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
									d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 6h14a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2V8a2 2 0 012-2z" />
								</svg>
							</button>
							@endif

							@if($surat->dokumen)
							<button onclick="toggleModal(true, '{{ asset('storage/' . $surat->dokumen) }}', '{{ $surat->status_admin }}')"
								class="text-blue-700 hover:scale-105 transition duration-200 inline-flex items-center justify-center">
								<svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0zm7.5 0a10.5 10.5 0 01-21 0 10.5 10.5 0 0121 0z" />
								</svg>
							</button>
							@endif
						@elseif ($surat->status_admin === 'Ditolak')
							@if($surat->dokumen)
								<button onclick="toggleModal(true, '{{ asset('storage/' . $surat->dokumen) }}', '{{ $surat->status_admin }}')"
									class="text-blue-700 hover:scale-105 transition duration-200 inline-flex items-center justify-center" title="Lihat Dokumen">
									<svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
										<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0zm7.5 0a10.5 10.5 0 01-21 0 10.5 10.5 0 0121 0z" />
									</svg>
								</button>
							@endif
							@if($surat->keterangan)
								<button onclick="openKeteranganTolak(`{{ $surat->keterangan }}`)"
									class="text-red-600 hover:scale-105 transition duration-200 inline-flex items-center justify-center" title="Lihat Alasan Penolakan">
									<svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
										<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M12 2a10 10 0 100 20 10 10 0 000-20z" />
									</svg>
								</button>
							@endif


						@else
							<form action="{{ route('surat.terima', str_replace(['/'], '_', $surat->id_surat)) }}" method="POST">
								@csrf
								@method('PUT')
								<button type="submit" class="bg-green-500 hover:bg-green-600 text-white text-sm px-4 py-1 rounded">Terima</button>
							</form>
							<form action="{{ route('surat.tolak', str_replace(['/'], '_', $surat->id_surat)) }}" method="POST">
								@csrf
								@method('PUT')
								<button type="button" onclick="openTolakModal('{{ $surat->id_surat }}')" class="bg-red-500 hover:bg-red-600 text-white text-sm px-4 py-1 rounded"> Tolak </button>
							</form>
							@if($surat->dokumen)
							<button onclick="toggleModal(true, '{{ asset('storage/' . $surat->dokumen) }}', '{{ $surat->status_admin }}')"
								class="text-blue-700 hover:scale-105 transition duration-200 inline-flex items-center justify-center">
								<svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0zm7.5 0a10.5 10.5 0 01-21 0 10.5 10.5 0 0121 0z" />
								</svg>
							</button>
							@endif
						@endif
					</div>
				</td>

				</tr>
				@empty
				<tr>
					<td colspan="8" class="text-center text-gray-500 py-4">
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
            if (!row.querySelector('td')) return;

            const statusCell = row.querySelector('td:nth-child(7)');
            const status = statusCell ? statusCell.textContent.trim().toLowerCase() : '';
            const rowText = row.textContent.toLowerCase();

            const matchStatus = !selectedStatus || status === selectedStatus;
            const matchSearch = !keyword || rowText.includes(keyword);

            row.style.display = (matchStatus && matchSearch) ? '' : 'none';
        });
    }

    statusFilter.addEventListener("change", applyFilters);
    searchInput.addEventListener("input", applyFilters);
    applyFilters();
});
</script>
@endsection