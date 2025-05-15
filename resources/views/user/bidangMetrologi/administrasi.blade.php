@extends('layouts.metrologi.pengguna')
@php use Illuminate\Support\Facades\Auth; @endphp

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

        <!-- RIWAYAT PERMOHONAN -->
        <div id="riwayatPermohonan" class="hidden relative">
            <div class="w-full">
                <!-- Filter & Search -->
				<div class="absolute top-[-50px] left-1/2 transform -translate-x-1/2 z-10 w-full">
					<div class="flex flex-wrap items-center justify-between px-4">
						<div class="flex space-x-2 mb-2 md:mb-0">
							<select id="statusFilter" class="px-4 py-2 rounded-full border shadow text-sm">
								<option value="">Semua</option>
								<option value="Menunggu">Menunggu</option>
								<option value="Disetujui">Disetujui</option>
								<option value="Ditolak">Ditolak</option>
							</select>
							<input type="date" id="dateFilter" class="px-4 py-2 rounded-full border shadow text-sm">
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
				</div>


                @include('component.popup_surat')

                <!-- Tabel -->
                <div class="overflow-x-auto rounded-lg shadow-sm">
                    <table class="min-w-full text-sm text-left text-gray-700 bg-white border border-gray-200">
                        <thead class="bg-[#1e3a8a] text-white">
                            <tr>
                                <th class="text-center px-5 py-3 border-b">No</th>
                                <th class="text-center px-5 py-3 border-b">Tanggal Dikirim</th>
                                <th class="text-center px-5 py-3 border-b">Status</th>
                                <th class="text-center px-5 py-3 border-b">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
							@if ($permohonan->isEmpty())
								<tr>
									<td colspan="4" class="text-center px-6 py-10 text-gray-500">
										<div class="flex flex-col items-center space-y-4">
											<svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-blue-400" fill="none"
												viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
												<path stroke-linecap="round" stroke-linejoin="round"
													d="M9 17v-2a2 2 0 012-2h2a2 2 0 012 2v2m4 0a9 9 0 11-18 0 9 9 0 0118 0z" />
											</svg>
											<p class="text-lg font-semibold">Belum ada surat permohonan</p>
											<p class="text-sm text-gray-500">Silakan ajukan surat permohonan terlebih dahulu dengan menekan tombol <span class="font-semibold text-blue-600"><a href="{{ route('administrasi-metrologi') }}">"Ajukan Surat Permohonan" </a></span> di atas.</p>
										</div>
									</td>
								</tr>
							@else
								@foreach ($permohonan as $index => $item)
									<tr class="hover:bg-blue-50 transition">
										<td class="text-center px-5 py-3 border-b">{{ $index + 1 }}</td>
										<td class="text-center px-5 py-3 border-b">
											{{ \Carbon\Carbon::parse($item->created_at)->format('Y-m-d') }}
										</td>
										<td class="text-center px-5 py-3 border-b">
											<span class="text-xs font-medium px-3 py-1 rounded-full
												{{ $item->status == 'Menunggu' ? 'bg-yellow-100 text-yellow-700' :
													($item->status == 'Disetujui' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700') }}">
												{{ $item->status }}
											</span>
										</td>
										<td class="text-center px-5 py-3 border-b">
											<button
												onclick="toggleModal(true, '{{ asset('storage/' . $item->dokumen) }}', '{{ $item->status }}')"
												class="px-4 py-1 text-sm text-[#1e3a8a] border border-[#1e3a8a] rounded-full hover:bg-[#1e3a8a] hover:text-white">
												Lihat Surat
											</button>
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
			<form class="bg-white p-6 rounded-xl shadow-lg w-full max-w-3xl" method="POST" action="{{ route('proses-surat-metrologi') }}" enctype="multipart/form-data">
				@csrf
				<h2 class="text-center font-bold text-xl mb-4">FORM PERMOHONAN</h2>

				<div class="mb-4">
					<h3 class="font-semibold mb-2">Data Pemohon:</h3>
					<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
						<div>
							<label class="block font-medium mb-1">Nama Lengkap</label>
							<input type="text" name="nama_lengkap" class="border px-4 py-2 w-full rounded-lg" value="{{ Auth::user()->nama ?? '-' }}" readonly>
						</div>
						<div>
							<label class="block font-medium mb-1">NIK</label>
							<input type="text" name="nik" class="border px-4 py-2 w-full rounded-lg" value="{{ Auth::user()->nik ?? '-' }}" readonly>
						</div>
						<div>
							<label class="block font-medium mb-1">Email</label>
							<input type="email" name="email" class="border px-4 py-2 w-full rounded-lg" value="{{ Auth::user()->email ?? '-' }}" readonly>
						</div>
						<div>
							<label class="block font-medium mb-1">Alamat</label>
							<textarea name="alamat" class="border px-4 py-2 w-full rounded-lg" readonly>{{ Auth::user()->alamat_lengkap ?? '-' }}</textarea>
						</div>
					</div>
				</div>

				<div class="mb-4">
					<h2>Data Pemohon : </h2>
				</div>

				<div class="mb-4">
					<label class="block font-semibold mb-1">Alamat Alat</label>
					<input type="text" name="alamat_alat" placeholder="Masukkan Alamat Alat Anda" class="border px-4 py-2 w-full rounded-lg">
				</div>

				<div class="mb-4">
					<label class="block font-semibold mb-1">Jenis Surat</label>
					<select name="jenis_surat" class="border px-4 py-2 w-full rounded-lg">
						<option value="tera">Tera</option>
						<option value="tera_ulang">Tera Ulang</option>
					</select>
				</div>

				<div class="mb-4">
					<label class="block font-semibold mb-1">Upload Dokumen</label>
					<input type="file" name="dokumen" class="mt-2">
				</div>

				<button type="submit" class="bg-blue-900 text-white px-6 py-2 rounded-lg mt-4 font-semibold block mx-auto">
					KIRIM PERMOHONAN
				</button>
			</form>
		</div>
    </div>


    <script src="{{ asset('assets/js/switch.js') }}"></script>
@endsection
