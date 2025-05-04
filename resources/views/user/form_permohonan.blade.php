@extends('layouts.home')

@section('title', 'Ajukan Surat Permohonan')

@section('content')

<head>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<div class="relative w-full h-64">
    <img src="{{ asset('assets\img\background\user_industri.png') }}" alt="Port Background" class="object-cover w-full h-full">
    <a href=""
        class="absolute flex items-center justify-center w-12 h-12 text-black transition-all duration-300 transform -translate-y-1/2 rounded-full shadow-lg left-14 top-1/2 bg-white/80 hover:bg-black hover:text-white hover:border-white hover:scale-110">
        <span class="text-2xl material-symbols-outlined">
            arrow_back
        </span>
    </a>
</div>

<div class="flex justify-center mt-8 mb-6">
    <div class="flex p-1 bg-blue-100 rounded-full">
        <button onclick="window.location.href='{{ route('form.permohonan') }}'"
            class="bg-[#083358] text-white font-semibold py-2 px-6 rounded-full shadow transition-all">
            AJUKAN SURAT PERMOHONAN
        </button>
        <button onclick="window.location.href='{{ route('riwayat.surat') }}'"
            class="px-6 py-2 font-semibold text-black transition-all rounded-full hover:bg-gray-100">
            RIWAYAT SURAT
        </button>
    </div>
</div>
<div class="max-w-4xl p-6 mx-auto mb-16 bg-white shadow-lg rounded-4xl">
    <h2 class="mb-6 text-xl font-semibold text-center">Form Surat Permohonan</h2>
    <form method="POST" action="" enctype="multipart/form-data">
        @csrf
        <div class="grid grid-cols-1 gap-4 md:grid-cols-2 font-roboto">
            <div>
                <label for="jenis_surat">Jenis Surat</label>
                <select id="jenis_surat" name="jenis_surat" class="w-full p-2 border rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="surat_rekomendasi">Surat Rekomendasi</option>
                    <option value="surat_keterangan">Surat Keterangan</option>
                    <option value="dan_lainnya">Dan Lainnya</option>
                </select>
            </div>
            <div class="mb-4">
                <label for="kecamatan">Kecamatan</label>
                <select id="kecamatan" name="kecamatan"
                    class="w-full p-2 bg-white border rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Pilih Kecamatan</option>
                    <option value="bacukiki">Bacukiki</option>
                    <option value="bacukiki_barat">Bacukiki Barat</option>
                    <option value="soreang">Soreang</option>
                    <option value="ujung">Ujung</option>
                </select>
            </div>
            <div>
                <label for="titik_koordinat">Titik Koordinat</label>
                <input id="titik_koordinat" type="text" name="titik_koordinat" class="w-full p-2 border rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Masukkan Titik Koordinat Usaha Anda">
            </div>
            <div class="mb-4">
                <label for="kelurahan">Kelurahan</label>
                <select id="kelurahan" name="kelurahan"
                    class="w-full p-2 bg-white border rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500"
                    disabled>
                    <option value="">Pilih Kelurahan</option>
                </select>
            </div>
            <div>
                <label for="foto_usaha">Foto Usaha</label>
                <div class="flex items-center space-x-2">
                    <label for="foto_usaha" class="px-4 py-2 bg-blue-100 text-black rounded-full cursor-pointer transition-all duration-300 hover:bg-[#083358] hover:text-white">Pilih File</label>
                    <span id="file-foto_usaha" class="text-gray-500">Tidak ada file yang dipilih</span>
                    <input type="file" id="foto_usaha" name="foto_usaha" class="hidden"
                        onchange="document.getElementById('file-foto_usaha').innerText = this.files[0]?.name ?? 'Tidak ada file yang dipilih'">
                </div>
            </div>
            <div>
                <label for="foto_ktp">Foto KTP (Kartu Tanda Penduduk)</label>
                <div class="flex items-center space-x-2">
                    <label for="foto_ktp" class="px-4 py-2 bg-blue-100 text-black rounded-full cursor-pointer transition-all duration-300 hover:bg-[#083358] hover:text-white">Pilih File</label>
                    <span id="file-foto_ktp" class="text-gray-500">Tidak ada file yang dipilih</span>
                    <input type="file" id="foto_ktp" name="foto_ktp" class="hidden"
                        onchange="document.getElementById('file-foto_ktp').innerText = this.files[0]?.name ?? 'Tidak ada file yang dipilih'">
                </div>
            </div>
            <div>
                <label for="dokumen_nib">Dokumen NIB (Nomor Induk Berusaha)</label>
                <div class="flex items-center space-x-2">
                    <label for="dokumen_nib" class="px-4 py-2 bg-blue-100 text-black rounded-full cursor-pointer transition-all duration-300 hover:bg-[#083358] hover:text-white">Pilih File</label>
                    <span id="file-dokumen_nib" class="text-gray-500">Tidak ada file yang dipilih</span>
                    <input type="file" id="dokumen_nib" name="dokumen_nib" class="hidden"
                        onchange="document.getElementById('file-dokumen_nib').innerText = this.files[0]?.name ?? 'Tidak ada file yang dipilih'">
                </div>
            </div>
            <div>
                <label for="npwp">NPWP</label>
                <div class="flex items-center space-x-2">
                    <label for="npwp" class="px-4 py-2 bg-blue-100 text-black rounded-full cursor-pointer transition-all duration-300 hover:bg-[#083358] hover:text-white">Pilih File</label>
                    <span id="npwp" class="text-gray-500">Tidak ada file yang dipilih</span>
                    <input type="file" id="npwp" name="npwp" class="hidden"
                        onchange="document.getElementById('npwp').innerText = this.files[0]?.name ?? 'Tidak ada file yang dipilih'">
                </div>
            </div>
            <div>
                <label for="akta_perusahaan">Akta Perusahaan</label>
                <div class="flex items-center space-x-2">
                    <label for="akta_perusahaan" class="px-4 py-2 bg-blue-100 text-black rounded-full cursor-pointer transition-all duration-300 hover:bg-[#083358] hover:text-white">Pilih File</label>
                    <span id="akta_perusahaan" class="text-gray-500">Tidak ada file yang dipilih</span>
                    <input type="file" id="akta_perusahaan" name="akta_perusahaan" class="hidden"
                        onchange="document.getElementById('akta_perusahaan').innerText = this.files[0]?.name ?? 'Tidak ada file yang dipilih'">
                </div>
            </div>
            <div>
                <label for="jenis_kelamin">Jenis Kelamin</label>
                <select id="jenis_kelamin" name="jenis_kelamin" class="w-full p-2 border rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Pilih Jenis Kelamin</option>
                    <option value="laki-laki">Laki-Laki</option>
                    <option value="perempuan">Perempuan</option>
                </select>
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
</div>
@endsection