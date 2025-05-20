@extends('layouts.adminIndustri')
@section('title', 'Sertifikasi Halal')

@section('content')

<!-- Bungkus seluruh konten dengan Alpine.js -->
<section x-data="{ openModal: false }" class="relative">

<!-- Banner -->
<img src="{{ asset('/assets/img/background/user_industri.png') }}" alt="Banner" class="object-cover w-full h-48">

<!-- Search & Tombol -->
<div class="flex items-center gap-4 px-6 py-6 max-w-7xl mx-auto z-10 relative">
  <!-- Input dengan icon -->
  <div class="relative flex-1">
    <input
      type="text"
      placeholder="Cari"
      class="w-full rounded-xl bg-blue-200/80 py-3 pl-12 pr-4 text-gray-600 placeholder-gray-600 shadow-md focus:outline-none focus:ring-2 focus:ring-blue-400"
    />
    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-500">
      <i class="fas fa-search"></i>
    </span>
  </div>

  <!-- Tombol Tambah Data -->
  <button
    @click="openModal = true"
    type="button"
    class="bg-[#002B4E] text-white font-semibold rounded-xl px-6 py-3 shadow-md hover:brightness-110 transition"
  >
    TAMBAH DATA
  </button>
</div>

  <!-- Tabel -->
  <section class="flex-1 px-6 pb-10 mt-1 overflow-x-auto scrollbar-thin scrollbar-thumb-gray-400 scrollbar-track-transparent z-10 relative">
    <div class="overflow-hidden rounded-b-xl">
      <table class="w-full text-sm table-auto">
        <thead class="bg-[#0d3b66] text-white">
          <tr>
            <th class="px-4 py-3 font-semibold text-left">NOMOR</th>
            <th class="px-4 py-3 font-semibold text-left">NAMA USAHA</th>
            <th class="px-4 py-3 font-semibold text-left">TANGGAL</th>
            <th class="px-4 py-3 font-semibold text-left">ALAMAT</th>
            <th class="px-4 py-3 font-semibold text-left">NO. SERTIFIKASI HALAL</th>
            <th class="px-4 py-3 font-semibold text-left">HYPERLINK</th>
            <th class="px-4 py-3 font-semibold text-left">AKSI</th>
          </tr>
        </thead>
        <tbody>
          @for($i = 1; $i <= 14; $i++)
            <tr class="{{ $i % 2 == 0 ? 'bg-gray-100' : 'bg-white' }}">
              <td class="px-4 py-3">{{ $i }}</td>
              <td class="px-4 py-3">Kios Humairah</td>
              <td class="px-4 py-3">20 April 2025</td>
              <td class="px-4 py-3">Kompleks Pasar Wekke'e</td>
              <td class="px-4 py-3">120100001209{{ 10 + $i }}</td>
              <td class="px-4 py-3">
                <a href="#" class="text-blue-500 hover:underline">Sertifikat Halal</a>
              </td>
              <td class="px-4 py-3">
                <div class="flex space-x-2">
                  <button class="text-green-600 hover:text-green-800" title="Edit">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15.232 5.232l3.536 3.536M9 13l6-6 3 3-6 6H9v-3z" />
                    </svg>
                  </button>
                  <button class="text-red-600 hover:text-red-800" title="Hapus">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7h6m2 0H7m4-3h2a1 1 0 011 1v1H8V5a1 1 0 011-1z" />
                    </svg>
                  </button>
                </div>
              </td>
            </tr>
          @endfor
        </tbody>
      </table>
    </div>
  </section>

  <!-- Overlay -->
  <div
    x-show="openModal"
    x-transition.opacity
    class="fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm z-40"
    style="display: none;"
  ></div>

  <!-- Modal -->
  <div
    x-show="openModal"
    x-transition
    class="fixed inset-0 flex items-start justify-center z-50 p-4"
    style="display: none;"
  >
    <div
      @click.away="openModal = false"
      @keydown.escape.window="openModal = false"
      tabindex="0"
      class="relative w-full max-w-3xl bg-white rounded-lg shadow-lg p-8 mt-24 overflow-auto max-h-[80vh]"
    >
      <button
        @click="openModal = false"
        type="button"
        aria-label="Close modal"
        class="absolute top-4 right-4 text-2xl font-bold leading-none hover:text-gray-700 focus:outline-none"
      >
        &times;
      </button>

      <h2 class="mb-6 text-center text-lg font-bold md:text-xl select-none">TAMBAH DATA SERTIFIKASI HALAL</h2>

      <form action="#" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 gap-y-4 md:grid-cols-2 md:gap-x-8">
        @csrf

        <div>
          <label for="nama_usaha" class="block mb-2 font-semibold">Nama Usaha</label>
          <input id="nama_usaha" name="nama_usaha" type="text" required
            class="w-full rounded-lg border border-gray-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#083458]">
        </div>

        <div>
          <label for="no_sertifikasi_halal" class="block mb-2 font-semibold">Nomor Sertifikasi Halal</label>
          <input id="no_sertifikasi_halal" name="no_sertifikasi_halal" type="text"
            class="w-full rounded-lg border border-gray-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#083458]">
        </div>

        <div>
          <label for="tanggal_sah" class="block mb-2 font-semibold">Tanggal Sah</label>
          <input id="tanggal_sah" name="tanggal_sah" type="date" required
            class="w-full rounded-lg border border-gray-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#083458]">
        </div>

        <div>
          <label for="status" class="block mb-2 font-semibold">Status</label>
          <select id="status" name="status" required
            class="w-full rounded-lg border border-gray-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#083458]">
            <option value="" disabled selected>Pilih Status</option>
            <option value="Perlu Pembaruan">Perlu Pembaruan</option>
            <option value="Berlaku">Berlaku</option>
          </select>
        </div>


        <div>
          <label for="tanggal_exp" class="block mb-2 font-semibold">Tanggal Exp</label>
          <input id="tanggal_exp" name="tanggal_exp" type="date" required
            class="w-full rounded-lg border border-gray-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#083458]">
        </div>

        <div>
          <label for="sertifikat" class="block mb-2 font-semibold">Sertifikat (PDF)</label>
          <input id="sertifikat" name="sertifikat" type="file" accept="application/pdf" required
            class="w-full rounded-lg border border-gray-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#083458]">
        </div>

        <div class="col-span-full flex justify-center mt-6">
          <button type="submit"
            class="rounded-2xl bg-[#083458] px-8 py-3 text-white shadow-md hover:shadow-lg transition duration-200">
            Tambah
          </button>
        </div>
      </form>
    </div>
  </div>
</section>

@endsection
