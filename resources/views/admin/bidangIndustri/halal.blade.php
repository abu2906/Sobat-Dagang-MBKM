@extends('layouts.adminIndustri')
@section('title', 'Data IKM')

@section('content')

  <section class="relative">
    <img src="{{ asset('/assets/img/background/user_industri.png') }}" alt="Banner" class="object-cover w-full h-48">

    <div class="absolute top-32 left-1/2 transform -translate-x-1/2 w-11/12 md:w-3/4">
      <div class="flex items-center justify-between space-x-4">
        <input
          type="text"
          placeholder="Cari"
          class="flex-1 px-6 py-2 bg-white rounded-full shadow-md focus:outline-none">

        <button class="bg-[#083458] text-white font-semibold py-2 px-4 rounded-2xl shadow-md hover:shadow-lg transition duration-200">
          Tambah Data
        </button>
      </div>
    </div>
  </section>

  <section class="flex-1 px-6 pb-10 mt-16 overflow-x-auto scrollbar-thin scrollbar-thumb-gray-400 scrollbar-track-transparent">
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
@endsection
