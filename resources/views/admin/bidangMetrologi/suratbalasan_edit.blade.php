@extends('layouts.metrologi.admin')

@section('content')
<div class="p-6 bg-gray-100 min-h-screen">
    <div class="relative h-[150px] w-full bg-cover bg-[center_87%]" style="background-image: url('/assets/img/background/user_metrologi.png');">
        <div class="absolute bottom-[-30px] w-full px-8">
            <div class="flex flex-wrap items-center justify-between p-4 rounded-xl">
                <div class="relative flex-grow mt-2 md:mt-0">
                    <p class="pl-10 text-center justify-center pr-4 py-2 rounded-full bg-white shadow text-sm w-full">EDIT SURAT BALASAN</p>
                </div>
            </div>
        </div>
    </div>

    <div class="flex justify-center">
        <form enctype="multipart/form-data" class="mt-6 bg-white p-6 rounded-xl shadow-lg w-full max-w-3xl"
              action="{{ route('update-surat-balasan', str_replace('/', '_', $suratMasuk->id_surat)) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="nomor_surat" class="block font-medium mb-1">Nomor Surat</label>
                        <input type="text" name="id_surat_balasan" class="border px-4 py-2 w-full rounded-lg"
                               value="{{ old('id_surat_balasan', $suratBalasan->id_surat_balasan) }}" required>
                    </div>

                    <input type="hidden" name="tanggal_pembuatan_surat" value="{{ old('tanggal_pembuatan_surat', $suratBalasan->tanggal) }}">

                    <div class="form-group row">
                        <label for="nama_yang_dituju" class="block font-medium mb-1">Nama Penerima</label>
                        <input type="text" name="nama_yang_dituju" class="border px-4 py-2 w-full rounded-lg"
                               value="{{ old('nama_yang_dituju', $suratMasuk->user->nama ?? '') }}" required>
                    </div>

                    <div class="form-group row md:col-span-2">
                        <label for="isi_urat" class="block font-medium mb-1">Isi Surat</label>
                        <textarea name="isi_surat" class="form-control border px-4 py-2 w-full rounded-lg" rows="20" required>{{ old('isi_surat', $suratBalasan->isi_surat ?? '') }}</textarea>
                    </div>
                </div>
            </div>

            <div class="text-center">
                <input type="hidden" name="redirect_to" value="{{ $redirect_to }}">
                <button type="submit" class="bg-yellow-600 text-white px-6 py-2 rounded-lg mt-4 font-semibold block mx-auto">Simpan Revisi</button>
            </div>
        </form>
    </div>
</div>
@endsection
