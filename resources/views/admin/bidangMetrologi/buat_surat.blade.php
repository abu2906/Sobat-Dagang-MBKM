@extends('layouts.metrologi.admin')

@section('content')
<div class="p-6 bg-gray-100 min-h-screen">
    <div class="relative h-[150px] w-full bg-cover bg-[center_87%]" style="background-image: url('/assets/img/background/user_metrologi.png');">
        <div class="absolute bottom-[-30px] w-full px-8">
            <div class="flex flex-wrap items-center justify-between p-4 rounded-xl">
                <div class="relative flex-grow mt-2 md:mt-0">
                    <p class="pl-10 text-center justify-center pr-4 py-2 rounded-full bg-white shadow text-sm w-full">FORM SURAT BALASAN</p>
                </div>
            </div>
        </div>
    </div>

    <div class="flex justify-center">
        <form enctype="multipart/form-data" class="mt-6 bg-white p-6 rounded-xl shadow-lg w-full max-w-3xl" action="{{ route('proces-surat-balasan', $id) }}" method="POST">
            @csrf
            <div class="mb-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="">
                        <label for="nomor_surat" class="block font-medium mb-1">Nomor Surat</label>
                        <input type="text" name="id_surat_balasan" class="border px-4 py-2 w-full rounded-lg" required>
                    </div>
                    <div class="form-group row">
                        <label for="sifat_surat" class="block font-medium mb-1">Sifat Surat</label>
                        <input type="text" name="sifat_surat" class="border px-4 py-2 w-full rounded-lg" required>
                    </div>
                    <div class="form-group row">
                        <label for="perihal" class="block font-medium mb-1">Perihal</label>
                        <input type="text" name="perihal" class="border px-4 py-2 w-full rounded-lg" required>
                    </div>
                    <div class="form-group row">
                        <label for="tanggal_pembuatan_surat" class="block font-medium mb-1">Tanggal Pembuatan Surat</label>
                        <input type="date" name="tanggal_pembuatan_surat" class="border px-4 py-2 w-full rounded-lg" required>
                    </div>
                    <div class="form-group row">
                        <label for="tanggal_surat" class="block font-medium mb-1">Tanggal Surat</label>
                        <input type="date" name="tanggal_surat" class="border px-4 py-2 w-full rounded-lg" required>
                    </div>
                    <div class="form-group row">
                        <label for="nama_yang_dituju" class="block font-medium mb-1">Nama Penerima</label>
                        <input type="text" name="nama_yang_dituju" class="border px-4 py-2 w-full rounded-lg" required>
                    </div>
                    <div class="form-group row md:col-span-2">
                        <label for="isi" class="block font-medium mb-1">Isi Surat</label>
                        <textarea name="isi" class="form-control border px-4 py-2 w-full rounded-lg" rows="20" required></textarea>
                    </div>
                </div>
            </div>

            <div class="text-center">
                <input type="hidden" name="redirect_to" value="{{ url()->previous() }}">
                <button type="submit" class="bg-blue-900 text-white px-6 py-2 rounded-lg mt-4 font-semibold block mx-auto">Buat Surat Balasan</button>
            </div>
        </form>
    </div>
        
</div>


@endsection
