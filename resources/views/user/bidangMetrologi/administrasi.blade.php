@extends('layout.app')

@section('tab')
    <div class="absolute left-1/2 transform -translate-x-1/2 top-[40px] z-10">
        <div class="flex rounded-full overflow-hidden border border-gray-200 bg-white">
            <a href="#" class="px-8 py-3 text-sm font-semibold text-gray-700 rounded-full hover:bg-gray-100 focus:bg-gray-100 transition-all duration-200">
                AJUKAN SURAT PERMOHONAN
            </a>
            <a href="#" class="px-8 py-3 text-sm font-semibold text-white rounded-full bg-blue-600 hover:bg-blue-700 transition-all duration-200">
                RIWAYAT PERMOHONAN
            </a>
        </div>
    </div>
@endsection

@section('content')
  {{-- Filter --}}
  <div class="absolute left-1/2 transform -translate-x-1/2 top-[-20px] z-10 w-full">
    <div class="flex flex-wrap px-8 items-center justify-between ">
        <div class="flex space-x-2">
            <select class="px-4 py-2 rounded-full border shadow text-sm">
                <option>Semua</option>
                <option>Menunggu</option>
                <option>Disetujui</option>
                <option>Ditolak</option>
            </select>
            <input type="date" class="px-4 py-2 rounded-full border shadow text-sm">
        </div>
        <div class="relative flex-grow mt-2 md:mt-0">
            <input type="text" placeholder="Cari" class="pl-10 pr-4 py-2 rounded-full border shadow text-sm w-full">
            <span class="absolute left-3 top-2 text-gray-400">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M17 11a6 6 0 11-12 0 6 6 0 0112 0z" />
                </svg>
            </span>
        </div>
    </div>
</div>

    
  {{-- Tabel Riwayat --}}
  <div class="overflow-x-auto rounded-lg shadow-sm mt-6">
  <table class="min-w-full text-sm text-left text-gray-700 bg-white border border-gray-200">
    <thead class="bg-[#1e3a8a] text-white">
      <tr>
        <th scope="col" class="text-center px-5 py-3 font-medium border-b border-blue-100">No</th>
        <th scope="col" class="text-center px-5 py-3 font-medium border-b border-blue-100">Tanggal Dikirim</th>
        <th scope="col" class="text-center px-5 py-3 font-medium border-b border-blue-100">Status</th>
        <th scope="col" class="text-center px-5 py-3 font-medium border-b border-blue-100">Aksi</th>
      </tr>
    </thead>
    <tbody>
      <tr class="hover:bg-blue-50 transition">
        <td class="px-5 text-center py-3 border-b">1</td>
        <td class="px-5 text-center py-3 border-b">01 Januari 2025</td>
        <td class="px-5 text-center py-3 border-b">
          <span class="text-xs font-medium text-yellow-700 bg-yellow-100 px-2 py-1 rounded-full">Menunggu</span>
        </td>
        <td class="px-5 text-center py-3 border-b">
          <button class="px-4 py-1 text-sm text-[#1e3a8a] border border-[#1e3a8a] rounded-full hover:bg-[#1e3a8a] hover:text-white transition">
            Lihat Surat
          </button>
        </td>
      </tr>
      <tr class="hover:bg-blue-50 transition">
        <td class="px-5 text-center py-3 border-b">2</td>
        <td class="px-5 text-center py-3 border-b">15 Januari 2025</td>
        <td class="px-5 text-center py-3 border-b">
          <span class="text-xs font-medium text-green-700 bg-green-100 px-2 py-1 rounded-full">Disetujui</span>
        </td>
        <td class="px-5 text-center py-3 border-b">
          <button class="px-4 py-1 text-sm text-[#1e3a8a] border border-[#1e3a8a] rounded-full hover:bg-[#1e3a8a] hover:text-white transition">
            Lihat Surat
          </button>
        </td>
      </tr>
      <tr class="hover:bg-blue-50 transition">
        <td class="px-5 text-center py-3">3</td>
        <td class="px-5 text-center py-3">31 Januari 2025</td>
        <td class="px-5 text-center py-3">
          <span class="text-xs font-medium text-red-700 bg-red-100 px-2 py-1 rounded-full">Ditolak</span>
        </td>
        <td class="px-5 text-center py-3">
          <button class="px-4 py-1 text-sm text-[#1e3a8a] border border-[#1e3a8a] rounded-full hover:bg-[#1e3a8a] hover:text-white transition">
            Lihat Surat
          </button>
        </td>
      </tr>
    </tbody>
  </table>
</div>


@endsection
