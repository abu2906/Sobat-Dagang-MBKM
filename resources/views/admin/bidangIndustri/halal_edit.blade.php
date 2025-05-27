@extends('layouts.app')

@section('content')
<div class="p-6 max-w-3xl mx-auto">
    <h2 class="text-2xl font-bold mb-6 text-center">Edit Sertifikat Halal</h2>

    <form action="{{ route('halal.update', $item->id_halal) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        <div>
            <label for="nama_usaha" class="block mb-1 font-semibold">Nama Usaha</label>
            <input type="text" name="nama_usaha" id="nama_usaha" value="{{ old('nama_usaha', $item->nama_usaha) }}" 
                class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
        </div>

        <div>
            <label for="no_sertifikasi_halal" class="block mb-1 font-semibold">Nomor Sertifikasi Halal</label>
            <input type="text" name="no_sertifikasi_halal" id="no_sertifikasi_halal" value="{{ old('no_sertifikasi_halal', $item->no_sertifikasi_halal) }}" 
                class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div>
            <label for="tanggal_sah" class="block mb-1 font-semibold">Tanggal Sah</label>
            <input type="date" name="tanggal_sah" id="tanggal_sah" value="{{ old('tanggal_sah', $item->tanggal_sah) }}" 
                class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
        </div>

        <div>
            <label for="tanggal_exp" class="block mb-1 font-semibold">Tanggal Exp</label>
            <input type="date" name="tanggal_exp" id="tanggal_exp" value="{{ old('tanggal_exp', $item->tanggal_exp) }}" 
                class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
        </div>

        <div>
            <label for="alamat" class="block mb-1 font-semibold">Alamat Usaha</label>
            <textarea name="alamat" id="alamat" rows="3" 
                class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>{{ old('alamat', $item->alamat) }}</textarea>
        </div>

        <div>
            <label for="status" class="block mb-1 font-semibold">Status</label>
            <select name="status" id="status" class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                <option value="" disabled {{ old('status', $item->status) ? 'selected' : '' }}>-- Pilih Status --</option>
                <option value="Berlaku" {{ old('status', $item->status) == 'Berlaku' ? 'selected' : '' }}>Berlaku</option>
                <option value="Perlu Pembaruan" {{ old('status', $item->status) == 'Perlu Pembaruan' ? 'selected' : '' }}>Perlu Pembaruan</option>
            </select>
        </div>

        <div>
            <label for="sertifikat" class="block mb-1 font-semibold">Unggah Sertifikat (PDF) <small class="text-gray-500">(Kosongkan jika tidak ingin mengganti)</small></label>
            <input type="file" name="sertifikat" id="sertifikat" accept="application/pdf" 
                class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        @if ($item->sertifikat)
            <div>
                <p class="text-sm text-gray-600">File Sertifikat Saat Ini: 
                    <a href="{{ asset('storage/' . $item->sertifikat) }}" target="_blank" class="text-blue-600 hover:underline">
                        Lihat Sertifikat
                    </a>
                </p>
            </div>
        @endif

        <div class="text-center">
            <button type="submit" 
                class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 transition">
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection