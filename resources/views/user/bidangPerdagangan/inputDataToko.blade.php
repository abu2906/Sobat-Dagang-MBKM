@extends('layouts.home')
@section('title', 'Input Data Toko')
@section('content')

<div class="relative w-full h-64">
    <img src="{{ asset('assets\img\background\perdagangan.jpg') }}" alt="Port Background" class="object-cover w-full h-full">
    <a href="{{ url()->previous() }}"
        class="absolute flex items-center justify-center w-12 h-12 text-black transition-all duration-300 transform -translate-y-1/2 rounded-full shadow-lg left-14 top-1/2 bg-white/80 hover:bg-black hover:text-white hover:scale-110">
        <span class="text-2xl material-symbols-outlined">arrow_back</span>
    </a>
    <div class="absolute bottom-0 transform -translate-x-1/2 translate-y-1/2 left-1/2">
        <p class="px-6 py-3 font-bold text-[#083358] bg-white shadow-md text-md font-istok rounded-3xl shadow-black/40">
            PELAPORAN PENYALURAN PUPUK BERSUBSIDI
        </p>
    </div>
</div>
<div class="flex justify-center items-center min-h-screen bg-gray-100">
    <div class="bg-white shadow-md rounded-2xl p-8 w-full max-w-md border border-gray-300">
        <h2 class="text-center text-lg text-black font-semibold mb-6">INPUT DATA TOKO</h2>
        <form action="{{ route('pelaporan.inputDataToko') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="nama_toko" class="block text-base font-medium text-black">Nama Toko</label>
                <input type="text" name="nama_toko" id="nama_toko" required
                    class="mt-1 block w-full rounded-full border border-gray-300 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div class="mb-4">
                <label for="kecamatan" class="block text-base font-medium text-black">Kecamatan</label>
                <select name="kecamatan" id="kecamatan" required
                    class="mt-1 block w-full rounded-full border border-gray-300 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="" disabled selected>Pilih Kecamatan</option>
                    <option value="Bacukiki">Bacukiki</option>
                    <option value="Bacukiki Barat">Bacukiki Barat</option>
                    <option value="Soreang">Soreang</option>
                    <option value="Ujung">Ujung</option>
                </select>
            </div>

            <div class="mb-4">
                <label for="no_register" class="block text-base font-medium text-black">No Register</label>
                <input type="text" name="no_register" id="no_register" required
                    class="mt-1 block w-full rounded-full border border-gray-300 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div class="mb-6">
                <label for="rencana_kebutuhan" class="block text-base font-medium text-black">Rencana Kebutuhan</label>
                <input type="text" name="rencana_kebutuhan" id="rencana_kebutuhan" required
                    class="mt-1 block w-full rounded-full border border-gray-300 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div class="flex justify-center">
                <button type="submit"
                    class="bg-[#083358] text-white px-6 py-2 rounded-full hover:bg-blue-300 hover:text-black transition duration-200">
                    Tambah
                </button>
            </div>
        </form>
    </div>
</div>

@endsection