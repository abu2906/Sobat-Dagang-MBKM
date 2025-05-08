@extends('layouts.admin')
@section('title', 'Detail Data Pemohon')

@section('content')
<div class="bg-white">
    <div class="relative w-full">
        <img src="{{ asset('assets/img/background/admin_perdagangan.png') }}" alt="Port Background" class="object-cover w-full h-64 md:h-full">
        <div class="absolute bottom-0 -left-4 w-full h-60 -z-10">
            <img src="{{ asset('assets/img/background/admin_perdagangan.png') }}" alt="Background" class="object-cover w-full h-full -ml-16">
        </div>
    </div>
    <div class="mb-8 mt-6">
        <h2 class="text-center text-3xl font-bold text-[#083358]">
            DETAIL DATA PEMOHON
        </h2>
    </div>

    <div class="flex justify-center items-center min-h-screen bg-white">
        <div class="bg-white rounded-3xl shadow-lg p-6 w-full max-w-2xl border border-gray-200">
            <div class="space-y-4 text-sm">
                <div class="grid grid-cols-2 bg-[#ABBED1] p-4 rounded-md">
                    <div class="font-semibold text-black">Nama Lengkap</div>
                    {{-- <div>{{ $data->nama }}</div> --}}
                </div>
                <div class="grid grid-cols-2 p-4">
                    <div class="font-semibold text-black">Jenis Kelamin</div>
                    {{-- <div>{{ $data->jenis_kelamin }}</div> --}}
                </div>
                <div class="grid grid-cols-2 bg-[#ABBED1] p-4 rounded-md">
                    <div class="font-semibold text-black">Nomor Telepon</div>
                    {{-- <div>{{ $data->no_telp }}</div> --}}
                </div>
                <div class="grid grid-cols-2 p-4">
                    <div class="font-semibold text-black">Email</div>
                    {{-- <div>{{ $data->email }}</div> --}}
                </div>
                <div class="grid grid-cols-2 bg-[#ABBED1] p-4 rounded-md">
                    <div class="font-semibold text-black">Tanggal Masuk</div>
                    {{-- <div>{{ \Carbon\Carbon::parse($data->created_at)->format('d-m-Y') }}</div> --}}
                </div>
                <div class="grid grid-cols-2 p-4">
                    <div class="font-semibold text-black">Jenis Surat</div>
                    {{-- <div>{{ $data->jenis_surat }}</div> --}}
                </div>
                <div class="grid grid-cols-2 bg-[#ABBED1] p-4 rounded-md">
                    <div class="font-semibold text-black">Titik Koordinat</div>
                    {{-- <div>{{ $data->titik_koordinat }}</div> --}}
                </div>

                <!-- Dokumen bagian dengan penataan yang serupa -->
                <div class="grid grid-cols-2 p-4">
                    <div class="font-semibold text-black">Dokumen NPWP</div>
                    <div>
                        <a href="" target="_blank" class="px-3 py-2 text-xs bg-gray-200 rounded-md shadow-md hover:bg-gray-300 w-full text-center inline-block">📄 NPWP</a>
                    </div>
                </div>
                <div class="grid grid-cols-2 bg-[#ABBED1] p-4 rounded-md">
                    <div class="font-semibold text-black">Akta Perusahaan</div>
                    <div>
                        <a href="" target="_blank" class="px-3 py-2 text-xs bg-gray-200 rounded-md shadow-md hover:bg-gray-300 w-full text-center inline-block">📄 Akta</a>
                    </div>
                </div>
                <div class="grid grid-cols-2 p-4">
                    <div class="font-semibold text-black">Dokumen NIB</div>
                    <div>
                        <a href="" target="_blank" class="px-3 py-2 text-xs bg-gray-200 rounded-md shadow-md hover:bg-gray-300 w-full text-center inline-block">📄 NIB</a>
                    </div>
                </div>
                <div class="grid grid-cols-2 bg-[#ABBED1] p-4 rounded-md">
                    <div class="font-semibold text-black">Foto KTP</div>
                    <div>
                        <a href="" target="_blank" class="px-3 py-2 text-xs bg-gray-200 rounded-md shadow-md hover:bg-gray-300 w-full text-center inline-block">🖼️ KTP</a>
                    </div>
                </div>
                <div class="grid grid-cols-2 p-4">
                    <div class="font-semibold text-black">File Surat Permohonan</div>
                    <div>
                        <a href="" target="_blank" class="px-3 py-2 text-xs bg-gray-200 rounded-md shadow-md hover:bg-gray-300 w-full text-center inline-block">📄 Surat</a>
                    </div>
                </div>
            </div>

            <div class="flex justify-center gap-6 mt-8">
                <form action="" method="POST" class="w-full">
                    @csrf
                    <button onclick="handleSetujuClick()" type="button" class="w-full py-3 rounded-full border border-black text-black bg-white hover:bg-gray-200 transition duration-300">
                        Setuju
                    </button>
                </form>

                <form action="" method="POST" class="w-full">
                    @csrf
                    <button type="submit" class="w-full py-3 rounded-full bg-[#083358] text-white hover:text-black hover:bg-blue-300 transition duration-300">
                        Tolak
                    </button>
                </form>
            </div>
        </div>
    </div>
        
    <!-- Modal Surat Rekomendasi -->
    <div id="modalRekomendasi" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden px-4">
        <div class="bg-white w-full max-w-xl max-h-[90vh] overflow-y-auto p-6 rounded-lg relative scrollbar-none" style="scrollbar-width: none;">
        <button class="absolute top-2 right-2 text-gray-600 text-xl" onclick="closeModal('modalRekomendasi')">&times;</button>
        <h2 class="text-center font-bold text-lg mb-4">FORM SURAT REKOMENDASI</h2>
        <div class="grid grid-cols-2 gap-4 text-sm">
            <div>
            <label>Nomor Surat</label>
            <input type="text" class="border rounded px-3 py-2 w-full">
            </div>
            <div>
            <label>Tanggal</label>
            <input type="date" class="border rounded px-3 py-2 w-full">
            </div>
            <div>
            <label>Nama Pengirim</label>
            <input type="text" class="border rounded px-3 py-2 w-full">
            </div>
            <div>
            <label>NIK</label>
            <input type="text" class="border rounded px-3 py-2 w-full">
            </div>
            <div>
            <label>Warga Negara</label>
            <select class="border rounded px-3 py-2 w-full">
                <option value="">Pilih</option>
                <option>WNI</option>
                <option>WNA</option>
            </select>
            </div>
            <div>
            <label>Pekerjaan</label>
            <input type="text" class="border rounded px-3 py-2 w-full">
            </div>
            <div>
            <label>Alamat Rumah</label>
            <input type="text" class="border rounded px-3 py-2 w-full">
            </div>
            <div>
            <label>Nama Usaha</label>
            <input type="text" class="border rounded px-3 py-2 w-full">
            </div>
            <div>
            <label>Bentuk Usaha</label>
            <input type="text" class="border rounded px-3 py-2 w-full">
            </div>
            <div>
            <label>Jenis Perusahaan</label>
            <select class="border rounded px-3 py-2 w-full">
                <option value="">Pilih</option>
                <option>Perusahaan Perseorangan</option>
                <option>Persekutuan Firma</option>
                <option>CV</option>
                <option>PT</option>
                <option>Koperasi</option>
                <option>BUMN</option>
                <option>BUMD</option>
                <option>Asing</option>
            </select>
            </div>
            <div class="col-span-2">
            <label>Isi Surat</label>
            <textarea class="border rounded px-3 py-2 w-full"></textarea>
            </div>
            <div class="col-span-2">
            <label>Luas Ruangan</label>
            <input type="text" class="border rounded px-3 py-2 w-full">
            </div>
        </div>
        <div class="flex justify-center mt-4 gap-3">
            <button class="bg-gray-700 text-white px-4 py-2 rounded">Draft</button>
            <button class="bg-[#083358] text-white hover:bg-blue-300 hover:text-black px-4 py-2 rounded">Simpan</button>
        </div>
        </div>
    </div>
    
    
    <!-- Modal Surat Keterangan -->
    <div id="modalKeterangan" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden px-4">
        <div class="bg-white w-full max-w-xl max-h-[90vh] overflow-y-auto p-6 rounded-lg relative scrollbar-none" style="scrollbar-width: none;">
        <button class="absolute top-2 right-2 text-gray-600 text-xl" onclick="closeModal('modalKeterangan')">&times;</button>
        <h2 class="text-center font-bold text-lg mb-4">FORM SURAT KETERANGAN</h2>
        <div class="grid grid-cols-2 gap-x-6 gap-y-4">
            <div>
            <label class="block text-sm font-semibold mb-1">Tanggal</label>
            <input type="date" class="w-full border rounded px-3 py-2">
            </div>
            <div>
            <label class="block text-sm font-semibold mb-1">Nama Pengirim</label>
            <input type="text" class="w-full border rounded px-3 py-2">
            </div>
            <div>
            <label class="block text-sm font-semibold mb-1">Jabatan</label>
            <input type="text" class="w-full border rounded px-3 py-2">
            </div>
            <div>
            <label class="block text-sm font-semibold mb-1">Nama Penerima</label>
            <input type="text" class="w-full border rounded px-3 py-2">
            </div>
            <div>
            <label class="block text-sm font-semibold mb-1">Tempat Lahir</label>
            <input type="text" class="w-full border rounded px-3 py-2">
            </div>
            <div>
            <label class="block text-sm font-semibold mb-1">Tanggal Lahir</label>
            <input type="date" class="w-full border rounded px-3 py-2">
            </div>
            <div>
            <label class="block text-sm font-semibold mb-1">Jenis Kelamin</label>
            <select class="w-full border rounded px-3 py-2">
                <option value="">Pilih</option>
                <option>Laki-laki</option>
                <option>Perempuan</option>
            </select>
            </div>
            <div>
            <label class="block text-sm font-semibold mb-1">Alamat Lengkap</label>
            <input type="text" class="w-full border rounded px-3 py-2">
            </div>
            <div>
            <label class="block text-sm font-semibold mb-1">Agama</label>
            <input type="text" class="w-full border rounded px-3 py-2">
            </div>
            <div>
            <label class="block text-sm font-semibold mb-1">Status Pernikahan</label>
            <select class="w-full border rounded px-3 py-2">
                <option value="">Pilih</option>
                <option>Menikah</option>
                <option>Belum Menikah</option>
            </select>
            </div>
            <div class="col-span-2">
            <label class="block text-sm font-semibold mb-1">Isi Surat</label>
            <textarea class="w-full border rounded px-3 py-2" rows="3"></textarea>
            </div>
        </div>
        <div class="flex justify-center mt-6 gap-4">
            <button class="border border-gray-700 text-gray-700 px-5 py-2 rounded hover:bg-gray-100">Draft</button>
            <button class="bg-[#083358] text-white hover:bg-blue-300 hover:text-black px-4 py-2 rounded">Simpan</button>
        </div>
        </div>
    </div>
</div>
<script>
    function openModal(id) {
        document.getElementById(id).classList.remove('hidden');
    }
    
    function closeModal(id) {
        document.getElementById(id).classList.add('hidden');
    }
    </script>
@endsection