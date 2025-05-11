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
        <h2 class="text-center text-lg md:text-xl font-bold mb-4 text-[#083358]">UPDATE/EDIT HARGA BARANG</h2>

        @if(session('success'))
            <div class="mb-4 p-2 bg-green-100 text-green-800 rounded text-sm">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('updateHarga.update') }}" method="POST">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                
                <div>
                    <label class="block mb-1 text-sm font-medium">Kategori Barang</label>
                    <select name="id_index_kategori" id="kategoriSelect"
                            class="w-full border rounded-full px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400"
                            required>
                        <option value="" disabled selected>Pilih Kategori</option>
                        @foreach($kategoris as $kategori)
                            <option value="{{ $kategori->id_index_kategori }}">
                                {{ ucwords($kategori->nama_kategori) }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block mb-1 text-sm font-medium">Harga</label>
                    <input type="number" name="harga"
                           class="w-full border rounded-full px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400"
                           required>
                </div>

                <div>
                    <label class="block mb-1 text-sm font-medium">Nama Barang</label>
                    <select name="id_barang" id="barangSelect"
                            class="w-full border rounded-full px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400"
                            required>
                        <option value="">Pilih kategori terlebih dahulu</option>
                    </select>
                </div>

                <div>
                    <label class="block mb-1 text-sm font-medium">Tanggal</label>
                    <input type="date" name="tanggal"
                           class="w-full border rounded-full px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400"
                           required>
                </div>

                <div>
                    <label class="block mb-1 text-sm font-medium">Lokasi</label>
                    <select name="lokasi"
                            class="w-full border rounded-full px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400"
                            required>
                        <option value="Pasar Lakessi">Pasar Lakessi</option>
                        <option value="Pasar Sumpang">Pasar Sumpang</option>
                    </select>
                </div>
            </div>

            <div class="text-center mt-6">
                <button type="submit"
                        class="bg-[#083358] text-white font-semibold px-6 py-2 rounded-full hover:bg-blue-300 hover:text-black  transition text-sm">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const kategoriSelect = document.getElementById('kategoriSelect');
        const barangSelect = document.getElementById('barangSelect');

        kategoriSelect.addEventListener('change', function () {
            const kategoriId = this.value;
            fetch(`/get-barang-by-kategori/${kategoriId}`)
                .then(response => response.json())
                .then(data => {
                    barangSelect.innerHTML = '';
                    if (data.length > 0) {
                        data.forEach(barang => {
                            let option = document.createElement('option');
                            option.value = barang.id_barang;
                            option.textContent = barang.nama_barang.charAt(0).toUpperCase() + barang.nama_barang.slice(1);
                            barangSelect.appendChild(option);
                        });
                    } else {
                        barangSelect.innerHTML = '<option value="">Tidak ada barang</option>';
                    }
                });
        });
    });
</script>
@endsection
