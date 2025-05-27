@extends('layouts.admin')
@section('title', isset($sertifikat) ? 'Edit Sertifikat Halal' : 'Tambah Sertifikat Halal')

@section('content')

<section class="max-w-3xl mx-auto p-6 bg-white rounded shadow">

    <h1 class="text-xl font-bold mb-6">{{ isset($sertifikat) ? 'Edit' : 'Tambah' }} Data Sertifikat Halal</h1>

    @if ($errors->any())
        <div class="mb-4 bg-red-100 text-red-700 p-3 rounded">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ isset($sertifikat) ? route('halal.update', $sertifikat->id_halal) : route('halal.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if(isset($sertifikat))
            @method('PUT')
        @endif

        <input type="hidden" name="id_user" value="{{ auth()->user()->id }}">
        <input type="hidden" name="id_ikm" value="{{ old('id_ikm', $sertifikat->id_ikm ?? '') }}">

        <div class="mb-4">
            <label class="block font-medium mb-1">Nama Usaha</label>
            <input type="text" name="nama_ikm" value="{{ old('nama_ikm', $sertifikat->nama_ikm ?? '') }}" class="w-full border rounded px-3 py-2" required>
        </div>

        <div class="mb-4">
            <label class="block font-medium mb-1">Nomor Sertifikat</label>
            <input type="text" name="nomor_sertifikat" value="{{ old('nomor_sertifikat', $sertifikat->nomor_sertifikat ?? '') }}" class="w-full border rounded px-3 py-2" required>
        </div>

        <div class="mb-4">
            <label class="block font-medium mb-1">Alamat</label>
            <textarea name="alamat" class="w-full border rounded px-3 py-2" required>{{ old('alamat', $sertifikat->alamat ?? '') }}</textarea>
        </div>

        <div class="mb-4">
            <label class="block font-medium mb-1">Tanggal Sah</label>
            <input type="date" name="tanggal_sah" value="{{ old('tanggal_sah', isset($sertifikat) ? $sertifikat->tanggal_sah->format('Y-m-d') : '') }}" class="w-full border rounded px-3 py-2" required>
        </div>

        <div class="mb-4">
            <label class="block font-medium mb-1">Tanggal Exp</label>
            <input type="date" name="tanggal_exp" value="{{ old('tanggal_exp', isset($sertifikat) ? $sertifikat->tanggal_exp->format('Y-m-d') : '') }}" class="w-full border rounded px-3 py-2" required>
        </div>

        <div class="mb-4">
            <label class="block font-medium mb-1">Dokumen Sertifikat (PDF)</label>
            <input type="file" name="link_dokumen" accept="application/pdf" {{ isset($sertifikat) ? '' : 'required' }}>
            @if(isset($sertifikat) && $sertifikat->link_dokumen)
                <p class="mt-1 text-sm">Dokumen saat ini: <a href="{{ asset('storage/' . $sertifikat->link_dokumen) }}" target="_blank" class="text-blue-600 underline">Lihat</a></p>
            @endif
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            {{ isset($sertifikat) ? 'Update' : 'Simpan' }}
        </button>

        <a href="{{ route('halal') }}" class="ml-4 text-gray-600 hover:underline">Batal</a>
    </form>
</section>

@endsection