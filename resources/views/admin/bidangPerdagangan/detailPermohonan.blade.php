@extends('layouts.admin')
@section('title', 'Detail Data Pemohon')

@section('content')
<div class="bg-white">
    <div class="relative w-full">
        <img src="{{ asset('assets/img/background/admin_perdagangan.png') }}" alt="Port Background" class="object-cover w-full h-64 md:h-full">
        <div class="absolute bottom-0 w-full -left-4 h-60 -z-10">
            <img src="{{ asset('assets/img/background/admin_perdagangan.png') }}" alt="Background" class="object-cover w-full h-full -ml-16">
        </div>
    </div>
    <div class="mt-6 mb-8">
        <h2 class="text-center text-3xl font-bold text-[#083358]">
            DETAIL DATA PEMOHON
        </h2>
    </div>
</div>

<div class="flex items-center justify-center min-h-screen bg-white">
    <div class="w-full max-w-2xl p-6 bg-white border border-gray-200 shadow-lg rounded-3xl">
        <div class="space-y-4 text-sm">
            <div class="grid grid-cols-2 bg-[#ABBED1] p-4 rounded-md">
                <div class="font-semibold text-black">Nama Lengkap</div>
                {{-- <div>{{ $data->nama }}
            </div> --}}
            <div>Null</div>
        </div>
        <div class="grid grid-cols-2 p-4">
            <div class="font-semibold text-black">Jenis Kelamin</div>
            {{-- <div>{{ $data->jenis_kelamin }}
        </div> --}}
        <div>Null</div>
    </div>
    <div class="grid grid-cols-2 bg-[#ABBED1] p-4 rounded-md">
        <div class="font-semibold text-black">Nomor Telepon</div>
        {{-- <div>{{ $data->no_telp }}
    </div> --}}
    <div>Null</div>
</div>
<div class="grid grid-cols-2 p-4">
    <div class="font-semibold text-black">Email</div>
    {{-- <div>{{ $data->email }}
</div> --}}
<div>Null</div>
</div>

{{-- Tanggal Masuk --}}
<div class="grid grid-cols-2 bg-[#ABBED1] p-4 rounded-md">
    <div class="font-semibold text-black">Tanggal Masuk</div>
    <div>
        {{ $data && $data->created_at ? \Carbon\Carbon::parse($data->created_at)->format('d-m-Y') : 'Tidak tersedia' }}
    </div>
</div>

{{-- Jenis Surat --}}
<div class="grid grid-cols-2 p-4">
    <div class="font-semibold text-black">Jenis Surat</div>
    @php
    $jenisSuratMap = [
    'surat_rekomendasi_perdagangan' => 'Surat Rekomendasi',
    'surat_keterangan_perdagangan' => 'Surat Keterangan',
    'dan_lainnya_perdagangan' => 'Surat Lainnya',
    ];
    @endphp
    <div>{{ $jenisSuratMap[$data->jenis_surat] ?? 'Tidak tersedia' }}</div>
</div>

{{-- Titik Koordinat --}}
<div class="grid grid-cols-2 bg-[#ABBED1] p-4 rounded-md">
    <div class="font-semibold text-black">Titik Koordinat</div>
    <div>{{ $data->titik_koordinat ?? 'Tidak tersedia' }}</div>
</div>

<!-- Dokumen NPWP -->
<div class="grid grid-cols-2 p-4">
    <div class="font-semibold text-black">Dokumen NPWP</div>
    <div>
        @if ($dokumen && $dokumen->npwp)
        <a href="{{ route('dokumen.view', ['id' => $dokumen->id_permohonan, 'type' => 'NPWP']) }}" target="_blank"
            class="inline-block w-full px-3 py-2 text-xs text-center bg-gray-200 rounded-md shadow-md hover:bg-gray-300">
            📄 Lihat NPWP
        </a>
        @else
        <span class="text-red-500">Tidak tersedia</span>
        @endif
    </div>
</div>

<!-- Akta Perusahaan -->
<div class="grid grid-cols-2 bg-[#ABBED1] p-4 rounded-md">
    <div class="font-semibold text-black">Akta Perusahaan</div>
    <div>
        @if ($dokumen && $dokumen->akta_perusahaan)
        <a href="{{ route('dokumen.view', ['id' => $dokumen->id_permohonan, 'type' => 'AKTA']) }}" target="_blank"
            class="inline-block w-full px-3 py-2 text-xs text-center bg-gray-200 rounded-md shadow-md hover:bg-gray-300">
            📄 Lihat Akta
        </a>
        @else
        <span class="text-red-500">Tidak tersedia</span>
        @endif
    </div>
</div>

<!-- Dokumen NIB -->
<div class="grid grid-cols-2 p-4">
    <div class="font-semibold text-black">Dokumen NIB</div>
    <div>
        @if ($dokumen && $dokumen->dokument_nib)
        <a href="{{ route('dokumen.view', ['id' => $dokumen->id_permohonan, 'type' => 'NIB']) }}" target="_blank"
            class="inline-block w-full px-3 py-2 text-xs text-center bg-gray-200 rounded-md shadow-md hover:bg-gray-300">
            📄 Lihat NIB
        </a>
        @else
        <span class="text-red-500">Tidak tersedia</span>
        @endif
    </div>
</div>

<!-- Foto KTP -->
<div class="grid grid-cols-2 bg-[#ABBED1] p-4 rounded-md">
    <div class="font-semibold text-black">Foto KTP</div>
    <div>
        @if ($dokumen && $dokumen->foto_ktp)
        <a href="{{ route('dokumen.view', ['id' => $dokumen->id_permohonan, 'type' => 'KTP']) }}" target="_blank"
            class="inline-block w-full px-3 py-2 text-xs text-center bg-gray-200 rounded-md shadow-md hover:bg-gray-300">
            🖼️ Lihat KTP
        </a>
        @else
        <span class="text-red-500">Tidak tersedia</span>
        @endif
    </div>
</div>

<!-- Foto Usaha -->
<div class="grid grid-cols-2 p-4">
    <div class="font-semibold text-black">Foto Usaha</div>
    <div>
        @if ($dokumen && $dokumen->foto_usaha)
        <a href="{{ route('dokumen.view', ['id' => $dokumen->id_permohonan, 'type' => 'USAHA']) }}" target="_blank"
            class="inline-block w-full px-3 py-2 text-xs text-center bg-gray-200 rounded-md shadow-md hover:bg-gray-300">
            🖼️ Lihat Usaha
        </a>
        @else
        <span class="text-red-500">Tidak tersedia</span>
        @endif
    </div>
</div>
<!-- Foto KTP -->
<div class="grid grid-cols-2 bg-[#ABBED1] p-4 rounded-md">
    <div class="font-semibold text-justify text-black">File Surat</div>
    <div>
        @if ($dokumen && $dokumen->foto_ktp)
        <a href="{{ route('dokumen.view', ['id' => $dokumen->id_permohonan, 'type' => 'SURAT']) }}" target="_blank"
            class="inline-block w-full px-3 py-2 text-xs text-center bg-gray-200 rounded-md shadow-md hover:bg-gray-300">
            🖼️ Lihat File Surat
        </a>
        @else
        <span class="text-red-500">Tidak tersedia</span>
        @endif
    </div>
</div>

<div class="flex justify-center gap-6 mt-8">
    <form action="" method="POST" class="w-full">
        @csrf
        <button onclick="handleSetujuClick()" type="button" class="w-full py-3 text-black transition duration-300 bg-white border border-black rounded-full hover:bg-gray-200">
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

<!-- Modal Surat Rekomendasi -->
<div id="modalRekomendasi" class="fixed inset-0 z-50 flex items-center justify-center hidden px-4 bg-black bg-opacity-50">
    <div class="bg-white w-full max-w-xl max-h-[90vh] overflow-y-auto p-6 rounded-lg relative scrollbar-none" style="scrollbar-width: none;">
        <button class="absolute text-xl text-gray-600 top-2 right-2" onclick="closeModal('modalRekomendasi')">&times;</button>
        <h2 class="mb-4 text-lg font-bold text-center">FORM SURAT REKOMENDASI</h2>
        <div class="grid grid-cols-2 gap-4 text-sm">
            <div>
                <label>Nomor Surat</label>
                <input type="text" class="w-full px-3 py-2 border rounded">
            </div>
            <div>
                <label>Tanggal</label>
                <input type="date" class="w-full px-3 py-2 border rounded">
            </div>
            <div>
                <label>Nama Pengirim</label>
                <input type="text" class="w-full px-3 py-2 border rounded">
            </div>
            <div>
                <label>NIK</label>
                <input type="text" class="w-full px-3 py-2 border rounded">
            </div>
            <div>
                <label>Warga Negara</label>
                <select class="w-full px-3 py-2 border rounded">
                    <option value="">Pilih</option>
                    <option>WNI</option>
                    <option>WNA</option>
                </select>
            </div>
            <div>
                <label>Pekerjaan</label>
                <input type="text" class="w-full px-3 py-2 border rounded">
            </div>
            <div>
                <label>Alamat Rumah</label>
                <input type="text" class="w-full px-3 py-2 border rounded">
            </div>
            <div>
                <label>Nama Usaha</label>
                <input type="text" class="w-full px-3 py-2 border rounded">
            </div>
            <div>
                <label>Bentuk Usaha</label>
                <input type="text" class="w-full px-3 py-2 border rounded">
            </div>
            <div>
                <label>Jenis Perusahaan</label>
                <select class="w-full px-3 py-2 border rounded">
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
                <textarea class="w-full px-3 py-2 border rounded"></textarea>
            </div>
            <div class="col-span-2">
                <label>Luas Ruangan</label>
                <input type="text" class="w-full px-3 py-2 border rounded">
            </div>
        </div>
        <div class="flex justify-center gap-3 mt-4">
            <button class="px-4 py-2 text-white bg-gray-700 rounded">Draft</button>
            <button class="bg-[#083358] text-white hover:bg-blue-300 hover:text-black px-4 py-2 rounded">Simpan</button>
        </div>
    </div>
</div>


<!-- Modal Surat Keterangan -->
<div id="modalKeterangan" class="fixed inset-0 z-50 flex items-center justify-center hidden px-4 bg-black bg-opacity-50">
    <div class="bg-white w-full max-w-xl max-h-[90vh] overflow-y-auto p-6 rounded-lg relative scrollbar-none" style="scrollbar-width: none;">
        <button class="absolute text-xl text-gray-600 top-2 right-2" onclick="closeModal('modalKeterangan')">&times;</button>
        <h2 class="mb-4 text-lg font-bold text-center">FORM SURAT KETERANGAN</h2>
        <div class="grid grid-cols-2 gap-x-6 gap-y-4">
            <div>
                <label class="block mb-1 text-sm font-semibold">Tanggal</label>
                <input type="date" class="w-full px-3 py-2 border rounded">
            </div>
            <div>
                <label class="block mb-1 text-sm font-semibold">Nama Pengirim</label>
                <input type="text" class="w-full px-3 py-2 border rounded">
            </div>
            <div>
                <label class="block mb-1 text-sm font-semibold">Jabatan</label>
                <input type="text" class="w-full px-3 py-2 border rounded">
            </div>
            <div>
                <label class="block mb-1 text-sm font-semibold">Nama Penerima</label>
                <input type="text" class="w-full px-3 py-2 border rounded">
            </div>
            <div>
                <label class="block mb-1 text-sm font-semibold">Tempat Lahir</label>
                <input type="text" class="w-full px-3 py-2 border rounded">
            </div>
            <div>
                <label class="block mb-1 text-sm font-semibold">Tanggal Lahir</label>
                <input type="date" class="w-full px-3 py-2 border rounded">
            </div>
            <div>
                <label class="block mb-1 text-sm font-semibold">Jenis Kelamin</label>
                <select class="w-full px-3 py-2 border rounded">
                    <option value="">Pilih</option>
                    <option>Laki-laki</option>
                    <option>Perempuan</option>
                </select>
            </div>
            <div>
                <label class="block mb-1 text-sm font-semibold">Alamat Lengkap</label>
                <input type="text" class="w-full px-3 py-2 border rounded">
            </div>
            <div>
                <label class="block mb-1 text-sm font-semibold">Agama</label>
                <input type="text" class="w-full px-3 py-2 border rounded">
            </div>
            <div>
                <label class="block mb-1 text-sm font-semibold">Status Pernikahan</label>
                <select class="w-full px-3 py-2 border rounded">
                    <option value="">Pilih</option>
                    <option>Menikah</option>
                    <option>Belum Menikah</option>
                </select>
            </div>
            <div class="col-span-2">
                <label class="block mb-1 text-sm font-semibold">Isi Surat</label>
                <textarea class="w-full px-3 py-2 border rounded" rows="3"></textarea>
            </div>
        </div>
        <div class="flex justify-center gap-4 mt-6">
            <button class="px-5 py-2 text-gray-700 border border-gray-700 rounded hover:bg-gray-100">Draft</button>
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