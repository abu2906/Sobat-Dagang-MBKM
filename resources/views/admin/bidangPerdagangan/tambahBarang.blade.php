@extends('layouts.admin')
@section('title', 'Tambah Barang untuk Index Harga')

@section('content')
<div class="w-full h-36">
    <img src="{{ asset('assets/img/background/admin_perdagangan.png') }}"
        alt="Background"
        class="object-cover w-full h-full">
</div>

<div class="flex items-center justify-center px-4 -mt-6">
    <div class="flex items-center bg-[#083358] text-white px-6 py-2 rounded-full shadow-md max-w-md">
        <span class="text-sm font-semibold sm:text-base">Tambahkan barang anda sesuai kebutuhan</span>
        <div class="flex items-center justify-center w-6 h-6 ml-3 border border-white rounded-full">
            <span class="text-sm font-bold text-white">i</span>
        </div>
    </div>
</div>

<div class="flex items-center justify-center px-4 py-8 bg-gray-100">
    <div class="w-full max-w-md p-6 bg-white rounded-lg shadow-md">
        <h2 class="mb-6 text-lg font-semibold text-center text-gray-800">
            Tambahkan Barang untuk Index Harga
        </h2>

        <form action="" method="POST" class="space-y-4">
            @csrf

            <div>
                <label for="nama_barang" class="block mb-1 font-medium text-gray-700">Nama Barang</label>
                <input type="text" id="nama_barang" name="nama_barang"
                    class="w-full p-2 border border-gray-300 rounded-full focus:ring focus:ring-blue-200 focus:outline-none"
                    required>
            </div>

            <div>
                <label for="kategori_lama" class="block mb-1 font-medium text-gray-700">Pilih Kategori yang Sudah Ada</label>
                <select id="kategori_lama" name="kategori_lama"
                    class="w-full p-2 border border-gray-300 rounded-full focus:ring focus:ring-blue-200 focus:outline-none">
                    <option value="">-- Pilih Kategori --</option>
                    {{-- @foreach ($kategori as $item)
                            <option value="{{ $item->nama }}">{{ $item->nama }}</option>
                    @endforeach --}}
                </select>
            </div>

            <div>
                <label for="kategori_baru" class="block mb-1 font-medium text-gray-700">Atau Tambahkan Kategori Baru</label>
                <input type="text" id="kategori_baru" name="kategori_baru"
                    class="w-full p-2 border border-gray-300 rounded-full focus:ring focus:ring-blue-200 focus:outline-none">
            </div>

            <div class="flex justify-center">
                <button type="submit"
                    class="bg-[#083358] text-white px-6 py-2 rounded-full font-semibold hover:bg-blue-800 hover:text-white transition duration-200">
                    Tambah
                </button>
            </div>
        </form>
    </div>
</div>
@endsection