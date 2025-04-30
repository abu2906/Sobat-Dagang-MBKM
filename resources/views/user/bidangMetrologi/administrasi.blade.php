@extends('layouts.user')

@section('tab')
    <div class="absolute left-1/2 transform -translate-x-1/2 top-[40px] z-10">
        <div class="flex rounded-full overflow-hidden bg-white">
            <button onclick="showForm(event)" id="btnForm"
                class="px-8 py-3 text-sm font-semibold text-white bg-blue-600 rounded-full hover:bg-blue-700 transition-all duration-200">
                AJUKAN SURAT PERMOHONAN
            </button>
            <button onclick="showRiwayat(event)" id="btnRiwayat"
                class="px-8 py-3 text-sm font-semibold text-black hover:bg-gray-100 rounded-full transition-all duration-200">
                RIWAYAT PERMOHONAN
            </button>
        </div>
    </div>
@endsection

@section('content')
	<!-- Riwayat Permohonan -->
	<div id="riwayatPermohonan" class="hidden">
		<!-- Filter -->
		<div class="absolute left-1/2 transform -translate-x-1/2 top-[-20px] z-10 w-full">
			<div class="flex flex-wrap px-8 items-center justify-between ">
				<div class="flex space-x-2">
					<select class="px-4 py-2 rounded-full border shadow text-sm">
						<option>Semua</option>
						<option>Menunggu</option>
						<option>Disetujui</option>
						<option>Ditolak</option>
					</select>
					<input type="date" class="px-4 py-2 rounded-full border shadow text-sm">
				</div>
				<div class="relative flex-grow mt-2 md:mt-0">
					<input type="text" placeholder="Cari" class="pl-10 pr-4 py-2 rounded-full border shadow text-sm w-full">
					<span class="absolute left-3 top-2 text-gray-400">
						<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" stroke="currentColor"
							viewBox="0 0 24 24">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
								d="M21 21l-4.35-4.35M17 11a6 6 0 11-12 0 6 6 0 0112 0z" />
						</svg>
					</span>
				</div>
			</div>
		</div>

		<!-- Modal popup -->
		 @include('component.popup_surat')

		<!-- Tabel Riwayat -->
		<div class="overflow-x-auto rounded-lg shadow-sm mt-6">
			<table class="min-w-full text-sm text-left text-gray-700 bg-white border border-gray-200">
				<thead class="bg-[#1e3a8a] text-white">
					<tr>
						<th scope="col" class="text-center px-5 py-3 font-medium border-b border-blue-100">No</th>
						<th scope="col" class="text-center px-5 py-3 font-medium border-b border-blue-100">Tanggal Dikirim</th>
						<th scope="col" class="text-center px-5 py-3 font-medium border-b border-blue-100">Status</th>
						<th scope="col" class="text-center px-5 py-3 font-medium border-b border-blue-100">Aksi</th>
					</tr>
				</thead>
				<tbody>
					<tr class="hover:bg-blue-50 transition">
						<td class="px-5 text-center py-3 border-b">1</td>
						<td class="px-5 text-center py-3 border-b">01 Januari 2025</td>
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
	</div>

	<!-- Pengajuan Permohonan -->
	<div id="formPermohonan" class="flex justify-center">
        <div class="bg-white p-6 absolute left-1/2 transform -translate-x-1/2 top-[-20px] z-10 rounded-xl shadow-lg w-full max-w-3xl">
            <h2 class="text-center font-bold text-xl mb-4">FORM PERMOHONAN</h2>

            <div class="mb-4">
				<h3 class="font-semibold mb-2">Data Pemohon:</h3>
				<table class="w-full text-sm border border-gray-200">
					<tbody>
					<tr class="border-b">
						<td class="font-medium px-4 py-2 w-1/4">Nama Lengkap</td>
						<td class="font-medium">:</td>
						<td class="px-4 py-2">St. Nur Aisyah. S <span class="text-gray-500">(tidak dapat diedit)</span></td>
					</tr>
					<tr class="border-b">
						<td class="font-medium px-4 py-2">NIB / NIK</td>
						<td class="font-medium">:</td>
						<td class="px-4 py-2">12345678910 <span class="text-gray-500">(tidak dapat diedit)</span></td>
					</tr>
					<tr class="border-b">
						<td class="font-medium px-4 py-2">Email</td>
						<td class="font-medium">:</td>
						<td class="px-4 py-2">metrologijaya@gmail.com <span class="text-gray-500">(tidak dapat diedit)</span></td>
					</tr>
					<tr>
						<td class="font-medium px-4 py-2">Alamat</td>
						<td class="font-medium">:</td>
						<td class="px-4 py-2">Jl. Jendral Sudirman <span class="text-gray-500">(tidak dapat diedit)</span></td>
					</tr>
					</tbody>
				</table>
				</div>


            <div class="mb-4">
                <label class="block font-semibold">Data Permohonan:</label>
                <input type="text" placeholder="Nama Usaha" class="border px-4 py-2 w-full rounded-lg mt-2">
            </div>

            <div class="mb-4">
                <label class="block font-semibold">Upload Dokumen</label>
                <input type="file" class="mt-2">
            </div>

            <button class="bg-blue-900 text-white px-6 py-2 rounded-lg mt-4 font-semibold block mx-auto">
                KIRIM PERMOHONAN
            </button>
        </div>
	</div>

	<script src="{{ asset('assets/js/switch.js') }}"></script>
@endsection



