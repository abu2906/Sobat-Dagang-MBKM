@extends('layouts.admin')
@section('title', 'Update Harga Barang')

@section('content')
<div class="w-full h-32">
    <img src="{{ asset('assets/img/background/admin_perdagangan.png') }}"
         alt="Background"
         class="w-full h-full object-cover">
</div>

<div class="flex justify-center items-start min-h-[calc(100vh-8rem)] bg-white py-4 px-4 md:px-0">
    <div class="bg-white border border-gray-300 shadow-md rounded-xl p-6 w-full max-w-2xl md:max-w-3xl">
        <h2 class="text-center text-lg md:text-xl font-bold mb-4 text-[#083358]">UPDATE HARGA BARANG</h2>

        @if(session('success'))
            <div class="mb-4 p-2 bg-green-100 text-green-800 rounded text-sm">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('updateHarga.store') }}" method="POST">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block mb-1 text-sm font-medium">Kategori Barang</label>
                    <select name="kategori" class="w-full border rounded-full px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400">
                        <option value="Beras">Beras</option>
                        <option value="Cabe">Cabe</option>
                        <option value="Bawang">Bawang</option>
                    </select>
                </div>

                <div>
                    <label class="block mb-1 text-sm font-medium">Harga</label>
                    <input type="number" name="harga" class="w-full border rounded-full px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400" required>
                </div>

                <div>
                    <label class="block mb-1 text-sm font-medium">Nama Barang</label>
                    <select name="nama_barang" class="w-full border rounded-full px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400">
                        <option value="Beras Medium">Beras Medium</option>
                        <option value="Beras Premium">Beras Premium</option>
                        <option value="Beras Merah">Beras Merah</option>
                        <option value="Beras Organik">Beras Organik</option>
                    </select>
                </div>

                <div>
                    <label class="block mb-1 text-sm font-medium">Tanggal</label>
                    <input type="date" name="tanggal" class="w-full border rounded-full px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400" required>
                </div>

                <div>
                    <label class="block mb-1 text-sm font-medium">Lokasi</label>
                    <select name="lokasi" class="w-full border rounded-full px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400">
                        <option value="Pasar Sentral">Pasar Sentral</option>
                        <option value="Pasar Sumpang">Pasar Sumpang</option>
                    </select>
                </div>

                <div>
                    <label class="block mb-1 text-sm font-medium">Deskripsi</label>
                    <textarea name="deskripsi" rows="2" class="w-full border rounded-xl px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400"></textarea>
                </div>
            </div>

            <div class="text-center mt-6">
                <button type="submit" class="bg-[#083358] text-white font-semibold px-6 py-2 rounded-full hover:bg-blue-500 transition text-sm">
                    Tambah
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
