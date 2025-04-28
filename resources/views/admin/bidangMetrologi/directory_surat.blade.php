@extends('layout.user')

@section('tab')

@endsection

@section('content')
<!-- Tabel Riwayat -->
        <div class="overflow-x-auto rounded-lg shadow-sm mt-6">
			<table class="min-w-full text-sm text-left text-gray-700 bg-white border border-gray-200">
				<thead class="bg-[#1e3a8a] text-white">
					<tr>
						<th scope="col" class="text-center px-5 py-3 font-medium border-b border-blue-100">No</th>
						<th scope="col" class="text-center px-5 py-3 font-medium border-b border-blue-100">ID Surat</th>
						<th scope="col" class="text-center px-5 py-3 font-medium border-b border-blue-100">Nama Pemohon</th>
						<th scope="col" class="text-center px-5 py-3 font-medium border-b border-blue-100">Status</th>
						<th scope="col" class="text-center px-5 py-3 font-medium border-b border-blue-100">Aksi</th>
					</tr>
				</thead>
				<tbody>
					<tr class="hover:bg-blue-50 transition">
						<td class="px-5 text-center py-3 border-b">1</td>
						<td class="px-5 text-center py-3 border-b">SPM-00001</td>
						<td class="px-5 text-center py-3 border-b">
							<span
								class="text-xs font-medium text-yellow-700 bg-yellow-100 px-2 py-1 rounded-full">Menunggu</span>
						</td>
						<td class="px-5 text-center py-3 border-b">
							<button onclick="toggleModal(true, 'path/sertifikat-abu.jpg')"
								class="px-4 py-1 text-sm text-[#1e3a8a] border border-[#1e3a8a] rounded-full hover:bg-[#1e3a8a] hover:text-white transition">
								Lihat Surat
							</button>
						</td>
					</tr>
					<tr class="hover:bg-blue-50 transition">
						<td class="px-5 text-center py-3 border-b">2</td>
						<td class="px-5 text-center py-3 border-b">15 Januari 2025</td>
						<td class="px-5 text-center py-3 border-b">
							<span
								class="text-xs font-medium text-green-700 bg-green-100 px-4 py-1 rounded-full">Disetujui</span>
						</td>
						<td class="px-5 text-center py-3 border-b">
							<button
								class="px-4 py-1 text-sm text-[#1e3a8a] border border-[#1e3a8a] rounded-full hover:bg-[#1e3a8a] hover:text-white transition">
								Lihat Surat
							</button>
						</td>
					</tr>
					<tr class="hover:bg-blue-50 transition">
						<td class="px-5 text-center py-3">3</td>
						<td class="px-5 text-center py-3">31 Januari 2025</td>
						<td class="px-5 text-center py-3">
							<span class="text-xs font-medium text-red-700 bg-red-100 px-6 py-1 rounded-full">Ditolak</span>
						</td>
						<td class="px-5 text-center py-3">
							<button 
								class="px-4 py-1 text-sm text-[#1e3a8a] border border-[#1e3a8a] rounded-full hover:bg-[#1e3a8a] hover:text-white transition">
								Lihat Surat
							</button>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
@endsection