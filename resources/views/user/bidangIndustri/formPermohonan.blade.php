@extends('layouts.home')

@section('title', 'Ajukan Surat Permohonan')

@section('content')

<head>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" />
</head>
<div class="relative w-full h-64">
    <img src="{{ asset('assets\img\background\user_industri.png') }}" alt="Port Background" class="object-cover w-full h-full">
    <a href="{{ route('user.dashboard') }}"
        class="absolute flex items-center justify-center w-12 h-12 text-black transition-all duration-300 transform -translate-y-1/2 rounded-full shadow-lg left-14 top-1/2 bg-white/80 hover:bg-black hover:text-white hover:border-white hover:scale-110">
        <span class="text-2xl material-symbols-outlined">
            arrow_back
        </span>
    </a>
</div>

<div class="flex justify-center mt-8 mb-6">
    <div class="flex p-1 bg-blue-100 rounded-full">
        <button onclick="window.location.href='{{ route('bidangIndustri.formPermohonan') }}'"
            class="bg-[#083358] text-white font-semibold py-2 px-6 rounded-full shadow transition-all">
            AJUKAN SURAT PERMOHONAN
        </button>
        <button onclick="window.location.href='{{ route('bidangIndustri.riwayatSurat') }}'"
            class="px-6 py-2 font-semibold text-black transition-all rounded-full hover:bg-gray-100">
            RIWAYAT SURAT
        </button>
    </div>
</div>
<div class="max-w-4xl p-6 mx-auto mb-16 bg-white shadow-lg rounded-4xl">
    <h2 class="mb-6 text-xl font-semibold text-center">Formulir Surat Permohonan</h2>

    @if (session('success'))
    <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 border border-green-200 rounded-lg" role="alert">
        {{ session('success') }}
    </div>
    @endif
    @if (session('error'))
    <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 border border-red-200 rounded-lg" role="alert">
        {{ session('error') }}
    </div>
    @endif
    @if ($errors->any())
    <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 border border-red-200 rounded-lg">
        <strong>Terjadi kesalahan:</strong>
        <ul class="mt-1 ml-4 list-disc list-inside">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('ajukanPermohonan') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="grid grid-cols-1 gap-4 md:grid-cols-2 font-roboto">
            <div>
                <label for="jenis_surat">Jenis Surat
                    <span class="text-red-500">*</span>
                </label>
                <select id="jenis_surat" name="jenis_surat" class="w-full p-2 border rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="surat_rekomendasi_industri">Surat Rekomendasi</option>
                    <option value="surat_keterangan_industri">Surat Keterangan</option>
                </select>
            </div>
            <div class="mb-4">
                <label for="kecamatan">Kecamatan
                    <span class="text-red-500">*</span>
                </label>
                <select id="kecamatan" name="kecamatan"
                    class="w-full p-2 bg-white border rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Pilih Kecamatan</option>
                    <option value="bacukiki">Bacukiki</option>
                    <option value="bacukiki_barat">Bacukiki Barat</option>
                    <option value="soreang">Soreang</option>
                    <option value="ujung">Ujung</option>
                </select>
            </div>

            <div x-data="{ showInfo: false }">
                <label for="titik_koordinat" class="block mb-1">
                    Titik Koordinat <span class="text-red-500">*</span>
                    <!-- Icon Info -->
                    <button type="button" @click="showInfo = true" class="ml-1 text-blue-500 hover:text-blue-700 focus:outline-none">
                        <svg class="inline w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10A8 8 0 11 2 10a8 8 0 0116 0zm-8 3a1 1 0 00-1 1v1a1 1 0 102 0v-1a1 1 0 00-1-1zm0-7a1 1 0 100 2 1 1 0 000-2zM9 9h2v5H9V9z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </label>

                <input id="titik_koordinat" type="text" name="titik_koordinat" class="w-full p-2 border rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Masukkan Titik Koordinat Usaha Anda (ex. -4.028889, 119.633521)">

                <!-- Pop-up / Modal Info -->
                <div x-show="showInfo" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-30" @click.away="showInfo = false" x-transition>
                    <div class="bg-white p-6 rounded-lg w-[90%] max-w-md shadow-xl relative">
                        <h2 class="mb-3 text-lg font-semibold text-center">Cara Mengambil Titik Koordinat</h2>
                        <p class="text-sm leading-relaxed text-gray-700">
                            1. Buka <strong>Google Maps</strong> di browser.<br>
                            2. Klik kanan pada lokasi usaha Anda.<br>
                            3. Pilih “<em>What's here?</em>” atau “<em>Apa di sini?</em>”.<br>
                            4. Koordinat (misalnya -4.028889, 119.633521) akan muncul di bawah.<br>
                            5. Salin dan tempelkan ke kolom ini.
                        </p>
                        <div class="flex justify-center mt-6">
                            <button @click="showInfo = false" class="px-5 py-2 text-white transition-all duration-200 bg-blue-600 rounded-full hover:bg-blue-700">Tutup</button>
                        </div>
                    </div>
                </div>

            </div>

            <div class="mb-4">
                <label for="kelurahan">Kelurahan
                    <span class="text-red-500">*</span>
                </label>
                <select id="kelurahan" name="kelurahan"
                    class="w-full p-2 bg-white border rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500"
                    disabled>
                    <option value="">Pilih Kelurahan</option>
                </select>
            </div>
            <div>
                <label for="foto_usaha">
                    Foto Usaha <span class="text-red-500">*</span>
                </label>
                <div class="flex items-center space-x-2">
                    <label for="foto_usaha" class="px-4 py-2 bg-blue-100 text-black rounded-full cursor-pointer transition-all duration-300 hover:bg-[#083358] hover:text-white w-max sm:w-auto md:w-max">
                        Pilih File
                    </label>
                    <span id="file-foto_usaha" class="text-gray-500 truncate max-w-[200px]">Tidak ada file yang dipilih</span>
                    <input type="file" id="foto_usaha" name="foto_usaha" class="hidden"
                        accept="image/*"
                        onchange="document.getElementById('file-foto_usaha').innerText = this.files[0]?.name ?? 'Tidak ada file yang dipilih'">
                </div>
                <p class="mt-1 text-sm text-gray-500">Maksimal ukuran gambar 512KB (JPG, PNG, IMAGE).</p>
            </div>
            <div>
                <label for="foto_ktp">Foto KTP (Kartu Tanda Penduduk)
                    <span class="text-red-500">*</span>
                </label>
                <div class="flex items-center space-x-2">
                    <label for="foto_ktp" class="px-4 py-2 bg-blue-100 text-black rounded-full cursor-pointer transition-all duration-300 hover:bg-[#083358] hover:text-white w-max sm:w-auto md:w-max">Pilih File</label>
                    <span id="file-foto_ktp" class="text-gray-500 truncate max-w-[200px]">Tidak ada file yang dipilih</span>
                    <input type="file" id="foto_ktp" name="foto_ktp" class="hidden"
                        accept="image/*"
                        onchange="document.getElementById('file-foto_ktp').innerText = this.files[0]?.name ?? 'Tidak ada file yang dipilih'">
                </div>
                <p class="mt-1 text-sm text-gray-500">Maksimal ukuran gambar 512KB (JPG, PNG, IMAGE).</p>
            </div>
            <div>
                <label for="dokumen_nib">Dokumen NIB (Nomor Induk Berusaha)
                    <span class="text-red-500">*</span>
                </label>
                <div class="flex items-center space-x-2">
                    <label for="dokumen_nib" class="px-4 py-2 bg-blue-100 text-black rounded-full cursor-pointer transition-all duration-300 hover:bg-[#083358] hover:text-white w-max sm:w-auto md:w-max">Pilih File</label>
                    <span id="file-dokumen_nib" class="text-gray-500 truncate max-w-[200px]">Tidak ada file yang dipilih</span>
                    <input type="file" id="dokumen_nib" name="dokumen_nib" class="hidden"
                        accept=".pdf"
                        onchange="document.getElementById('file-dokumen_nib').innerText = this.files[0]?.name ?? 'Tidak ada file yang dipilih'">
                </div>
                <p class="mt-1 text-sm text-gray-500">Maksimal ukuran file 512KB (PDF).</p>
            </div>
            <div>
                <label for="file-npwp">NPWP
                    <span class="text-red-500">*</span>
                </label>
                <div class="flex items-center space-x-2">
                    <label for="npwp" class="px-4 py-2 bg-blue-100 text-black rounded-full cursor-pointer transition-all duration-300 hover:bg-[#083358] hover:text-white w-max sm:w-auto md:w-max">Pilih File</label>
                    <span id="file-npwp" class="text-gray-500 truncate max-w-[200px]">Tidak ada file yang dipilih</span>
                    <input type="file" id="npwp" name="npwp" class="hidden"
                        accept=".pdf,.jpg,.jpeg,.png"
                        onchange="document.getElementById('file-npwp').innerText = this.files[0]?.name ?? 'Tidak ada file yang dipilih'">
                </div>
                <p class="mt-1 text-sm text-gray-500">Maksimal ukuran file 512KB (PDF).</p>
            </div>
            <div>
                <label for="file-surat">File Surat Permohonan
                    <span class="text-red-500">*</span>
                </label>
                <div class="flex items-center space-x-2">
                    <label for="surat" class="px-4 py-2 bg-blue-100 text-black rounded-full cursor-pointer transition-all duration-300 hover:bg-[#083358] hover:text-white w-max sm:w-auto md:w-max">
                        Pilih File
                    </label>
                    <span id="file-surat" class="text-gray-500 truncate max-w-[200px]">Tidak ada file yang dipilih</span>
                    <input type="file" id="surat" name="surat" class="hidden" required
                        accept=".pdf,.doc,.docx"
                        onchange="document.getElementById('file-surat').innerText = this.files[0]?.name ?? 'Tidak ada file yang dipilih'">
                </div>
                <p class="mt-1 text-sm text-gray-500">Maksimal ukuran file 512KB (PDF, WORD).</p>
            </div>
            <div>
                <label for="file-akta_perusahaan">Akta Perusahaan
                    <span class="text-red-500">*</span>
                </label>
                <div class="flex items-center space-x-2">
                    <label for="akta_perusahaan" class="px-4 py-2 bg-blue-100 text-black rounded-full cursor-pointer transition-all duration-300 hover:bg-[#083358] hover:text-white w-max sm:w-auto md:w-max">Pilih File</label>
                    <span id="file-akta_perusahaan" class="text-gray-500 truncate max-w-[200px]">Tidak ada file yang dipilih</span>
                    <input type="file" id="akta_perusahaan" name="akta_perusahaan" class="hidden"
                        accept=".pdf"
                        onchange="document.getElementById('file-akta_perusahaan').innerText = this.files[0]?.name ?? 'Tidak ada file yang dipilih'">
                </div>
                <p class="mt-1 text-sm text-gray-500">Maksimal ukuran file 512KB (PDF).</p>
            </div>
        </div>
        <div class="flex justify-center mt-6 mb-4 space-x-4">
            <button type="button" class="px-6 py-2 bg-[#083358] text-white rounded-full hover:bg-[#061f3c] transition-all">Draft</button>
            <button type="button" id="btn-ajukan" class="px-6 py-2 bg-[#083358] text-white rounded-full hover:bg-[#061f3c] transition-all">
                Ajukan
            </button>
        </div>
        <div id="modal-verifikasi" class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black bg-opacity-50">
            <div class="w-11/12 max-w-md p-6 bg-white shadow-xl rounded-2xl">
                <h2 class="mb-4 text-lg font-semibold">Konfirmasi Pengajuan</h2>
                <p class="mb-6 text-sm text-black-600">Apakah Anda yakin ingin mengajukan surat permohonan ini?</p>
                <div class="flex justify-end space-x-3">
                    <button type="button" onclick="closeModal()"
                        class="px-4 py-2 text-black transition-all bg-gray-200 rounded-full hover:bg-gray-300">
                        Batal
                    </button>
                    <button type="submit"
                        class="px-4 py-2 bg-[#083358] text-white rounded-full hover:bg-[#061f3c] transition-all">
                        Ya, Ajukan
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection