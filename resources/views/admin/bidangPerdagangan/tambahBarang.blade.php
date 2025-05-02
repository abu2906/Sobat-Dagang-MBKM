@extends('layouts.menuAdminPerdagangan')
@section('title', 'Tambah Barang untuk Index Harga')

@section('content')
<div class="flex items-center justify-between bg-[#083358] text-white px-6 py-2 rounded-full shadow-md w-fit mx-auto mt-4">
    <span class="font-semibold">Tambahkan barang anda sesuai kebutuhan</span>
    <div class="ml-3 w-6 h-6 flex items-center justify-center border border-white rounded-full">
        <span class="text-white text-sm font-bold">i</span>
    </div>
</div>

<div class="flex justify-center items-center bg-gray-100 my-6">
    <div class="bg-white p-6 rounded-lg shadow-md w-full max-w-md">
        <h2 class="text-center font-semibold text-lg mb-4">TAMBAHKAN BARANG UNTUK INDEX HARGA</h2>

        <form action="" method="POST">
            @csrf
            <label for="nama_barang" class="block mb-1 font-medium">Nama Barang</label>
            <input type="text" id="nama_barang" name="nama_barang"
                class="w-full p-2 mb-4 border rounded-full" required>

            <label for="kategori_lama" class="block mb-1 font-medium">Pilih kategori yang sudah ada</label>
            <select id="kategori_lama" name="kategori_lama"
                class="w-full p-2 mb-4 border rounded-full">
                <option value="">-- Pilih Kategori --</option>
                <option value="Pangan">Pangan</option>
                <option value="Elektronik">Elektronik</option>
            </select>

            <label for="kategori_baru" class="block mb-1 font-medium">Atau Tambahkan Kategori baru</label>
            <input type="text" id="kategori_baru" name="kategori_baru"
                class="w-full p-2 mb-4 border rounded-full">

            <div class="flex justify-center">
                <button type="submit" class="bg-[#083358] text-white px-4 py-2 rounded-full hover:bg-blue-800 hover:text-black">
                    Tambah
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
