@extends('layouts.home')
@section('content')
<div class="relative w-full h-64">
    <img src="{{ asset('img/bgFormIzin.png') }}" alt="Port Background" class="w-full h-full object-cover">
    <div class="absolute inset-0 bg-black bg-opacity-30 flex items-center justify-center"></div>
</div>

<div class="container mx-auto px-4 mt-6">
    <div class="flex justify-center mb-6">
        <input type="text" placeholder="Cari" class="w-1/2 p-3 rounded-full border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500">
    </div>

    <div class="flex justify-center mb-6">
        <div class="bg-blue-100 p-1 rounded-full flex">
            <button class="bg-[#083358] text-white font-semibold py-2 px-6 rounded-full shadow transition-all">AJUKAN SURAT PERMOHONAN</button>
            <button class="text-black font-semibold py-2 px-6 rounded-full transition-all">RIWAYAT SURAT</button>
        </div>
    </div>

    <div class="max-w-4xl mx-auto bg-white p-6 rounded-2xl shadow-lg mb-16">
        <h2 class="text-xl font-semibold text-center mb-6">Form Surat Permohonan</h2>
        <form method="POST" action="" enctype="multipart/form-data">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label>Nama Lengkap</label>
                    <input type="text" name="nama_lengkap" class="w-full p-2 border rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Masukkan Nama Lengkap Anda">
                </div>
                <div>
                    <label>Jenis Surat</label>
                    <select name="jenis_surat" class="w-full p-2 border rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Pilih Jenis Surat</option>
                        <option value="surat_rekomendasi">Surat Rekomendasi</option>
                        <option value="surat_keterangan">Surat Keterangan</option>
                        <option value="dan_lainnya">Dan Lainnya</option>
                    </select>
                </div>
                <div>
                    <label for="kecamatan">Kecamatan</label>
                    <select id="kecamatan" name="kecamatan" placeholder="Pilih Kecamatan..." class="w-full p-2 border rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Pilih Kecamatan</option>
                        <option value="bacukiki">Bacukiki</option>
                        <option value="bacukiki_barat">Bacukiki Barat</option>
                        <option value="soreang">Soreang</option>
                        <option value="ujung">Ujung</option>
                    </select>
                </div>
                <div>
                    <label>Titik Koordinat</label>
                    <input type="text" name="titik_koordinat" class="w-full p-2 border rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Masukkan Titik Koordinat Usaha Anda">
                </div>
                <div>
                    <label for="kelurahan">Kelurahan</label>
                    <select id="kelurahan" name="kelurahan" class="w-full p-2 border rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500" disabled>
                        <option value="">Pilih Kelurahan</option>
                    </select>
                </div>
                <div>
                    <label>Foto Usaha</label>
                    <input type="file" name="foto_usaha" class="w-full p-2 border rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label>Alamat Lengkap</label>
                    <input type="text" name="alamat_lengkap" class="w-full p-2 border rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Masukkan Alamat Lengkap Anda">
                </div>
                <div>
                    <label>Foto KTP</label>
                    <input type="file" name="foto_ktp" class="w-full p-2 border rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label>Email Aktif</label>
                    <input type="email" name="email" class="w-full p-2 border rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Masukkan Email Anda">
                </div>
                <div>
                    <label>Dokumen NIB</label>
                    <input type="file" name="dokumen_nib" class="w-full p-2 border rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label>Nomor HP/Telepon</label>
                    <input type="text" name="nomor_hp" class="w-full p-2 border rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Masukkan Nomor HP Aktif Anda">
                </div>
                <div>
                    <label>NPWP</label>
                    <input type="text" name="npwp" class="w-full p-2 border rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Masukkan NPWP Anda">
                </div>
                <div>
                    <label>NIB (Nomor Induk Berusaha)</label>
                    <input type="text" name="nib" class="w-full p-2 border rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Masukkan NIB Anda">
                </div>
                <div>
                    <label>Akta Perusahaan</label>
                    <input type="text" name="akta_perusahaan" class="w-full p-2 border rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Masukkan Akta Usaha Anda">
                </div>
                <div>
                    <label>Jenis Kelamin</label>
                    <select name="jenis_kelamin" class="w-full p-2 border rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Pilih Jenis Kelamin</option>
                        <option value="laki-laki">Laki-Laki</option>
                        <option value="perempuan">Perempuan</option>
                    </select>
                </div>
                <div>
                    <label>NIK (Nomor Induk Kependudukan)</label>
                    <input type="text" name="nik" class="w-full p-2 border rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Masukkan NIK Anda">
                </div>
            </div>
            <div class="flex justify-center mt-6 mb-4 space-x-4">
                <button type="button" class="px-6 py-2 bg-[#083358] text-white rounded-full hover:bg-[#061f3c] transition-all">Draft</button>
                <button type="submit" class="px-6 py-2 bg-[#083358] text-white rounded-full hover:bg-[#061f3c] transition-all">Ajukan</button>
            </div>
        </form>
    </div>
</div>
@endsection
@section('scripts')
@vite('resources/js/form_permohonan.js')
@endsection