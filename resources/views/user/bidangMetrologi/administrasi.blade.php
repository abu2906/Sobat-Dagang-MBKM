@extends('layouts.metrologi.pengguna')
@php use Illuminate\Support\Facades\Auth; @endphp
@php
    $user = Auth::guard('user')->user();
@endphp

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
    <!-- Bungkus dengan div agar layout fleksibel -->
    <div class="space-y-10 pb-32 relative">

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

        <!-- RIWAYAT PERMOHONAN -->
        <div id="riwayatPermohonan" class="hidden relative">
            <div class="w-full">
                <!-- Filter & Search -->
                <div class="mb-6">
                    <div class="flex flex-col sm:flex-row items-center justify-between gap-4 px-4">
                        <div class="w-full sm:w-auto">
                            <select id="statusFilter" class="w-full sm:w-auto px-4 py-2 rounded-full border shadow text-sm">
                                <option value="">Semua</option>
                                <option value="Menunggu">Menunggu</option>
                                <option value="Disetujui">Disetujui</option>
                                <option value="Ditolak">Ditolak</option>
                            </select>
                        </div>
                        <div class="relative w-full sm:w-auto flex-grow">
                            <input type="text" id="searchInput" placeholder="Cari" class="pl-10 pr-4 py-2 rounded-full border shadow text-sm w-full">
                            <span class="absolute left-3 top-2 text-gray-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M17 11a6 6 0 11-12 0 6 6 0 0112 0z" />
                                </svg>
                            </span>
                        </div>
                    </div>
                </div>

                @include('component.popup_surat')

                <!-- Tabel -->
                <div class="overflow-x-auto rounded-lg shadow-sm">
                    <table class="min-w-full text-sm text-left text-gray-700 bg-white border border-gray-200">
                        <thead class="bg-[#1e3a8a] text-white">
                            <tr>
                                <th class="text-center px-2 sm:px-4 py-2 sm:py-3 border-b text-xs sm:text-sm">No</th>
                                <th class="text-center px-2 sm:px-4 py-2 sm:py-3 border-b text-xs sm:text-sm">Nomor Surat</th>
                                <th class="text-center px-2 sm:px-4 py-2 sm:py-3 border-b text-xs sm:text-sm">Tanggal Dikirim</th>
                                <th class="text-center px-2 sm:px-4 py-2 sm:py-3 border-b text-xs sm:text-sm">Status</th>
                                <th class="text-center px-2 sm:px-4 py-2 sm:py-3 border-b text-xs sm:text-sm">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($permohonan->isEmpty())
                                <tr>
                                    <td colspan="5" class="text-center px-4 py-6 text-gray-500">
                                        <div class="flex flex-col items-center space-y-3">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 sm:h-12 w-10 sm:w-12 text-blue-400" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M9 17v-2a2 2 0 012-2h2a2 2 0 012 2v2m4 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <p class="text-sm sm:text-base font-semibold">Belum ada surat permohonan</p>
                                            <p class="text-xs sm:text-sm text-gray-500 text-center">Silakan ajukan surat permohonan terlebih dahulu dengan menekan tombol <span class="font-semibold text-blue-600"><a href="{{ route('administrasi-metrologi') }}">"Ajukan Surat Permohonan" </a></span> di atas.</p>
                                        </div>
                                    </td>
                                </tr>
                            @else
                                @foreach ($permohonan as $index => $item)
                                    <tr class="hover:bg-blue-50 transition">
                                        <td class="text-center px-2 sm:px-4 py-2 sm:py-3 border-b text-xs sm:text-sm">{{ $index + 1 }}</td>
                                        <td class="text-center px-2 sm:px-4 py-2 sm:py-3 border-b text-xs sm:text-sm">{{ $item->id_surat }}</td>
                                        <td class="text-center px-2 sm:px-4 py-2 sm:py-3 border-b text-xs sm:text-sm">
                                            {{ \Carbon\Carbon::parse($item->created_at)->format('d-m-Y') }}
                                        </td>
                                        <td class="text-center px-2 sm:px-4 py-2 sm:py-3 border-b">
                                            <span class="text-xs font-medium px-2 py-1 rounded-full
                                                {{ $item->status_surat_masuk == 'Menunggu' ? 'bg-yellow-100 text-yellow-700' :
                                                    ($item->status_surat_masuk == 'Disetujui' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700') }}">
                                                {{ $item->status_surat_masuk }}
                                            </span>
                                        </td>
                                        <td class="text-center px-2 sm:px-4 py-2 sm:py-3 border-b">
                                            <div class="flex flex-col sm:flex-row items-center justify-center gap-2">
                                                <button
                                                    onclick="handleViewDocument('{{ asset('storage/' . $item->dokumen) }}', 'Surat Permohonan')"
                                                    class="w-full sm:w-auto px-3 py-1 text-xs sm:text-sm text-[#1e3a8a] border border-[#1e3a8a] rounded-full hover:bg-[#1e3a8a] hover:text-white transition-colors">
                                                    Lihat Surat
                                                </button>

                                                @if ($item->status_surat_masuk == 'Disetujui')
                                                    <button
                                                        onclick="handleViewDocument('{{ asset('storage/' . $item->suratBalasan->path_dokumen) }}', 'Surat Balasan')"
                                                        class="w-full sm:w-auto px-3 py-1 text-xs sm:text-sm text-green-700 border border-green-700 rounded-full hover:bg-green-700 hover:text-white transition-colors">
                                                        Lihat Balasan
                                                    </button>
                                                @endif

                                                @if ($item->status_surat_masuk == 'Ditolak')
                                                    <button
                                                        onclick="openKeteranganTolak(`{{ $item->keterangan }}`)"
                                                        class="w-full sm:w-auto text-red-600 hover:scale-105 transition duration-200"
                                                        title="Lihat Alasan Penolakan">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 sm:w-5 sm:h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                d="M13 16h-1v-4h-1m1-4h.01M12 2a10 10 0 100 20 10 10 0 000-20z" />
                                                        </svg>
                                                    </button>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

		@if(session('success'))
			<div class="mx-auto w-full max-w-2xl">
				<div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
					<strong class="font-bold">Berhasil! </strong>
					<span class="block sm:inline">{{ session('success') }}</span>
					<span class="absolute top-0 bottom-0 right-0 px-4 py-3 cursor-pointer" onclick="this.parentElement.remove();">
						<svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg"
							viewBox="0 0 20 20"><title>Close</title><path
								d="M14.348 5.652a1 1 0 00-1.414 0L10 8.586 7.066 5.652a1 1 0 10-1.414 1.414L8.586 10l-2.934 2.934a1 1 0 101.414 1.414L10 11.414l2.934 2.934a1 1 0 001.414-1.414L11.414 10l2.934-2.934a1 1 0 000-1.414z"/>
						</svg>
					</span>
				</div>
			</div>
		@endif

		@if ($errors->any())
			<div class="mx-auto w-full max-w-2xl">
				<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
					<strong class="font-bold">Gagal! </strong>
					<ul class="mt-1 list-disc list-inside text-sm">
						@foreach ($errors->all() as $error)
							<li>{{ $error }}</li>
						@endforeach
					</ul>
					<span class="absolute top-0 bottom-0 right-0 px-4 py-3 cursor-pointer" onclick="this.parentElement.remove();">
						<svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg"
							viewBox="0 0 20 20"><title>Close</title><path
								d="M14.348 5.652a1 1 0 00-1.414 0L10 8.586 7.066 5.652a1 1 0 10-1.414 1.414L8.586 10l-2.934 2.934a1 1 0 101.414 1.414L10 11.414l2.934 2.934a1 1 0 001.414-1.414L11.414 10l2.934-2.934a1 1 0 000-1.414z"/>
						</svg>
					</span>
				</div>
			</div>
		@endif


        <!-- FORM PERMOHONAN -->
		<div id="formPermohonan" class="relative flex justify-center">
			<form class="bg-white p-6 rounded-xl shadow-lg w-full max-w-3xl" method="POST" action="{{ route('proses-surat-metrologi') }}?redirect=riwayat" enctype="multipart/form-data">
				@csrf
				<h2 class="text-center font-bold text-xl mb-4">FORM PERMOHONAN TERA BARU/TERA ULANG</h2>

				<div class="mb-4">
					<h3 class="font-semibold mb-2">Data Pemohon:</h3>
					<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
						<div>
							<label class="block font-medium mb-1">Nama Lengkap</label>
							<input type="text" name="nama_lengkap" class="border px-4 py-2 w-full rounded-lg" value="{{ $user->nama ?? '-' }}" readonly>
						</div>
						<div>
							<label class="block font-medium mb-1">NIK</label>
							<input type="text" name="nik" class="border px-4 py-2 w-full rounded-lg" value="{{ $user->nik ?? '-' }}" readonly>
						</div>
						<div>
							<label class="block font-medium mb-1">Email</label>
							<input type="email" name="email" class="border px-4 py-2 w-full rounded-lg" value="{{ $user->email ?? '-' }}" readonly>
						</div>
						<div>
							<label class="block font-medium mb-1">Alamat</label>
							<textarea name="alamat" class="border px-4 py-2 w-full rounded-lg" readonly>{{ $user->alamat_lengkap ?? '-' }}</textarea>
						</div>
					</div>
				</div>


				<div class="mb-4">
					<div x-data="{ showInfo: false }">
						<label for="alamat_alat" class="block font-semibold mb-1">
							Titik Koordinat <span style="color:red">*</span>
							<button type="button" @click="showInfo = true" class="ml-1 text-blue-500 hover:text-blue-700 focus:outline-none">
								<svg class="inline w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
									<path fill-rule="evenodd" d="M18 10A8 8 0 11 2 10a8 8 0 0116 0zm-8 3a1 1 0 00-1 1v1a1 1 0 102 0v-1a1 1 0 00-1-1zm0-7a1 1 0 100 2 1 1 0 000-2zM9 9h2v5H9V9z" clip-rule="evenodd" />
								</svg>
							</button>
						</label>
						<input type="text" name="alamat_alat" id="alamat_alat" placeholder="Masukkan Titik Koordinat Alat Anda (ex. -4.028889, 119.633521)" class="border px-4 py-2 w-full rounded-lg">

						<!-- Info Modal -->
						<div x-show="showInfo" style="display: none;" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-30" @click.away="showInfo = false" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
							<div class="bg-white p-6 rounded-lg w-[90%] max-w-md shadow-xl relative">
								<h2 class="mb-3 text-lg font-semibold text-center">Cara Mengambil Titik Koordinat</h2>
								<p class="text-sm leading-relaxed text-gray-700">
									1. Buka <strong>Google Maps</strong> di browser.<br>
									2. Klik kanan pada lokasi alat Anda.<br>
									3. Pilih "<em>What's here?</em>" atau "<em>Apa di sini?</em>".<br>
									4. Koordinat (misalnya -4.028889, 119.633521) akan muncul di bawah.<br>
									5. Salin dan tempelkan ke kolom ini.
								</p>
								<div class="flex justify-center mt-6">
									<button type="button" @click="showInfo = false" class="px-5 py-2 text-white transition-all duration-200 bg-blue-600 rounded-full hover:bg-blue-700">Tutup</button>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="mb-4">
					<label class="block font-semibold mb-1">Nomor Surat <span style="color:red">*</span></label>
					<input type="text" name="nomor_surat" placeholder="Masukkan Nomor Surat Anda" class="border px-4 py-2 w-full rounded-lg">
				</div>

				<div class="mb-4">
					<label class="block font-semibold mb-1">Jenis Surat <span style="color:red">*</span></label>
					<select name="jenis_surat" class="border px-4 py-2 w-full rounded-lg">
						<option value="" disabled selected>-- Pilih Jenis Surat --</option>
						<option value="tera">Tera</option>
						<option value="tera_ulang">Tera Ulang</option>
					</select>
				</div>

				<div class="mb-4">
					<label class="block font-semibold mb-1">Upload Surat <span style="color:red">*</span></label>
					<input type="file" name="dokumen" class="mt-2">
				</div>

				<button type="submit" class="bg-blue-900 text-white px-6 py-2 rounded-lg mt-4 font-semibold block mx-auto">
					KIRIM PERMOHONAN
				</button>
			</form>
		</div>
    </div>


    <script src="{{ asset('assets/js/switch.js') }}"></script>

    <script>
        function validateNomorSurat(input) {
            const nomorSurat = input.value;
            
            // Kirim request ke server untuk cek nomor surat
            fetch('/check-nomor-surat', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ nomor_surat: nomorSurat })
            })
            .then(response => response.json())
            .then(data => {
                const errorElement = document.getElementById('nomor-surat-error');
                if (data.exists) {
                    errorElement.textContent = 'Nomor surat ini sudah digunakan. Silakan gunakan nomor surat yang berbeda.';
                    errorElement.classList.remove('hidden');
                    input.setCustomValidity('Nomor surat ini sudah digunakan');
                } else {
                    errorElement.textContent = '';
                    errorElement.classList.add('hidden');
                    input.setCustomValidity('');
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }

        function showForm(event) {
            event.preventDefault();
            document.getElementById('formPermohonan').classList.remove('hidden');
            document.getElementById('riwayatPermohonan').classList.add('hidden');
            document.getElementById('btnForm').classList.add('bg-blue-600', 'text-white');
            document.getElementById('btnForm').classList.remove('text-black', 'hover:bg-gray-100');
            document.getElementById('btnRiwayat').classList.remove('bg-blue-600', 'text-white');
            document.getElementById('btnRiwayat').classList.add('text-black', 'hover:bg-gray-100');
        }

        function showRiwayat(event) {
            event.preventDefault();
            document.getElementById('formPermohonan').classList.add('hidden');
            document.getElementById('riwayatPermohonan').classList.remove('hidden');
            document.getElementById('btnRiwayat').classList.add('bg-blue-600', 'text-white');
            document.getElementById('btnRiwayat').classList.remove('text-black', 'hover:bg-gray-100');
            document.getElementById('btnForm').classList.remove('bg-blue-600', 'text-white');
            document.getElementById('btnForm').classList.add('text-black', 'hover:bg-gray-100');
        }

        // Check if we should show riwayat on page load
        document.addEventListener('DOMContentLoaded', function() {
            @if(session('show_riwayat'))
                showRiwayat(new Event('click'));
            @endif
        });

        // Implementasi filter status dan pencarian
        document.addEventListener('DOMContentLoaded', function() {
            const statusFilter = document.getElementById('statusFilter');
            const searchInput = document.getElementById('searchInput');
            const tableRows = document.querySelectorAll('tbody tr');

            function applyFilters() {
                const selectedStatus = statusFilter.value.toLowerCase();
                const searchTerm = searchInput.value.toLowerCase();

                tableRows.forEach(row => {
                    const statusCell = row.querySelector('td:nth-child(4)');
                    const status = statusCell ? statusCell.textContent.trim().toLowerCase() : '';
                    const rowText = row.textContent.toLowerCase();
                    
                    const statusMatch = !selectedStatus || status === selectedStatus;
                    const searchMatch = !searchTerm || rowText.includes(searchTerm);

                    row.style.display = statusMatch && searchMatch ? '' : 'none';
                });
            }

            statusFilter.addEventListener('change', applyFilters);
            searchInput.addEventListener('input', applyFilters);
        });

        function handleViewDocument(url, title) {
            // Check if screen width is mobile (less than 640px)
            if (window.innerWidth < 640) {
                // For mobile, open in new page
                window.open(url, '_blank');
            } else {
                // For desktop, show in modal
                toggleModal(true, url, title);
            }
        }
    </script>
@endsection