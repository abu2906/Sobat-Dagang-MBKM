@extends('layouts.metrologi.admin')

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
					<p class="text-base font-medium text-white">Surat Terkirim</p>
					<p class="text-2xl font-bold text-white">{{ $totalSuratTerkirim }}</p>
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
					<th scope="col" class="text-center px-5 py-3 font-medium border-b border-blue-100">ID Surat</th>
					<th scope="col" class="text-center px-5 py-3 font-medium border-b border-blue-100">Nama Pemohon</th>
					<th scope="col" class="text-center px-5 py-3 font-medium border-b border-blue-100">Status</th>
					<th scope="col" class="text-center px-5 py-3 font-medium border-b border-blue-100">Aksi</th>
				</tr>
			</thead>
			<tbody>
				@forelse ($suratList as $index => $surat)
				<tr class="hover:bg-blue-50 transition">
					<td class="px-5 text-center py-3 border-b">{{ $index + 1 }}</td>
					<td class="px-5 text-center py-3 border-b">{{ $surat->id_surat }}</td>
					<td class="px-5 text-center py-3 border-b">{{ $surat->user->nama ?? '-' }}</td>
					<td class="px-5 text-center py-3 border-b">
						<span class="text-xs font-medium px-2 py-1 rounded-full 
							{{ $surat->status_surat_masuk == 'Menunggu' ? 'text-yellow-700 bg-yellow-100' : '' }}
							{{ $surat->status_surat_masuk == 'Disetujui' ? 'text-green-700 bg-green-100' : '' }}
							{{ $surat->status_surat_masuk == 'Ditolak' ? 'text-red-700 bg-red-100' : '' }}">
							{{ $surat->status_surat_masuk }}
						</span>
					</td>
					<td class="px-5 text-center py-3 border-b">
						<div class="flex justify-center gap-2 flex-wrap">
							@if ($surat->status_admin === 'Disetujui')
								@if($surat->suratBalasan && $surat->suratBalasan->path_dokumen)
									<button onclick="toggleModal(true, '{{ asset('storage/' . $surat->suratBalasan->path_dokumen) }}', '{{ $surat->status_surat_masuk }}')"
										class="text-blue-700 hover:scale-105 transition duration-200 inline-flex items-center justify-center">
										<svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
											<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
												d="M15 12a3 3 0 11-6 0 3 3 0 016 0zm7.5 0a10.5 10.5 0 01-21 0 10.5 10.5 0 0121 0z" />
										</svg>
									</button>
								@else
									<a href="{{ route('create-surat-balasan', str_replace(['/'], '_', $surat->id_surat)) }}"
										class="bg-blue-900 hover:bg-blue-800 text-white text-sm px-4 py-1 rounded">
										Buat Surat
									</a>
								@endif
								
							@elseif ($surat->status_admin === 'Ditolak')
								<a href="{{ route('create-keterangan', str_replace(['/'], '_', $surat->id_surat)) }}"
									class="bg-gray-500 hover:bg-gray-600 text-white text-sm px-4 py-1 rounded">
									Kirim Keterangan
								</a>
							@else
								<form action="{{ route('surat.terima', str_replace(['/'], '_', $surat->id_surat)) }}" method="POST">
									@csrf
									@method('PUT')
									<button type="submit" class="bg-green-500 hover:bg-green-600 text-white text-sm px-4 py-1 rounded">Terima</button>
								</form>
								<form action="{{ route('surat.tolak', str_replace(['/'], '_', $surat->id_surat)) }}" method="POST">
									@csrf
									@method('PUT')
									<button type="submit" class="bg-red-500 hover:bg-red-600 text-white text-sm px-4 py-1 rounded">Tolak</button>
								</form>
								<button onclick="toggleModal(true, '{{ asset('storage/' . $surat->dokumen) }}', '{{ $surat->status_surat_masuk }}')"
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
					<td colspan="5" class="text-center text-gray-500 py-4">
						Tidak ada data surat metrologi yang tersedia.
					</td>
				</tr>
				@endforelse
			</tbody>
		</table>
	</div>
</div>
@endsection