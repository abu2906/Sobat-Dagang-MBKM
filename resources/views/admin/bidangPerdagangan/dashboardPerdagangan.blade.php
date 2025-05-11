@extends('layouts.admin')
@section('title', 'Dashboard Perdagangan')

@section('content')
<div class="p-6 bg-gray-100 min-h-screen">
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4 mb-6">
        <a href="#" class="bg-white rounded-2xl shadow-md hover:shadow-lg transition p-5 flex items-center space-x-4">
            <img src="{{ asset('assets/img/icon/folder-download.png') }}" alt="Surat Masuk" class="w-12 h-12">
            <div>
                <p class="text-base font-medium text-black">Jumlah Surat Masuk</p>
                <p class="text-2xl font-bold text-blue-600">{{ $totalSuratPerdagangan }}</p>
            </div>
        </a>

        <a href="#" class="bg-white rounded-2xl shadow-md hover:shadow-lg transition p-5 flex items-center space-x-4">
            <img src="{{ asset('assets/img/icon/Verif.png') }}" alt="Terverifikasi" class="w-12 h-12">
            <div>
                <p class="text-base font-medium text-black">Jumlah Surat Terverifikasi</p>
                <p class="text-2xl font-bold text-yellow-500">{{ $totalSuratTerverifikasi }}</p>
            </div>
        </a>

        <a href="#" class="bg-white rounded-2xl shadow-md hover:shadow-lg transition p-5 flex items-center space-x-4">
            <img src="{{ asset('assets/img/icon/surat_ditolak.png') }}" alt="Ditolak" class="w-12 h-12">
            <div>
                <p class="text-base font-medium text-black">Jumlah Surat Ditolak</p>
                <p class="text-2xl font-bold text-green-600">{{ $totalSuratDitolak }}</p>
            </div>
        </a>

        <a href="#" class="bg-white rounded-2xl shadow-md hover:shadow-lg transition p-5 flex items-center space-x-4">
            <img src="{{ asset('assets/img/icon/draf.png') }}" alt="Draft" class="w-12 h-12">
            <div>
                <p class="text-base font-medium text-black">Draft Surat Balasan</p>
                <p class="text-2xl font-bold text-orange-500">{{ $totalSuratDraft }}</p>
            </div>
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 p-6">
        <!-- Card Statistik Indeks Harga -->
        <div class="bg-white rounded-2xl shadow p-4">
          <div class="flex justify-between items-center mb-4">
            <h2 class="text-sm font-semibold text-gray-700 flex items-center">
              📈 Statistik Indeks Harga
            </h2>
          </div>
          <!-- Dummy Bar Chart -->
          <div class="h-40 bg-gradient-to-b from-pink-100 to-purple-100 rounded-lg flex items-end justify-around px-2">
            <div class="w-4 bg-blue-500 h-1/4 rounded"></div>
            <div class="w-4 bg-red-500 h-1/3 rounded"></div>
            <div class="w-4 bg-blue-500 h-1/2 rounded"></div>
            <div class="w-4 bg-red-500 h-1/2 rounded"></div>
            <div class="w-4 bg-blue-500 h-3/4 rounded"></div>
            <div class="w-4 bg-red-500 h-2/3 rounded"></div>
          </div>
          <!-- Statistik Bawah -->
          <div class="mt-4 grid grid-cols-4 text-center text-sm">
            <div>
              <p class="font-semibold">Rp 11.423</p>
              <p class="text-gray-500 text-xs">Terendah</p>
            </div>
            <div>
              <p class="font-semibold">Rp 11.423</p>
              <p class="text-gray-500 text-xs">Rata-rata</p>
            </div>
            <div>
              <p class="font-semibold">Rp 11.423</p>
              <p class="text-gray-500 text-xs">Tertinggi</p>
            </div>
            <div>
              <p class="font-semibold">5,1%</p>
              <p class="text-gray-500 text-xs">Variasi</p>
            </div>
          </div>
          <div class="mt-2 grid grid-cols-3 gap-2 text-xs text-center">
            <div>
              <p>Beras Premium</p>
              <p class="text-green-500">+2.5%</p>
            </div>
            <div>
              <p>Rp 12.500</p>
              <p class="text-green-500">+2.5%</p>
            </div>
            <div>
              <p>Beras Premium</p>
              <p class="text-green-500">+2.5%</p>
            </div>
          </div>
        </div>
      
        <!-- Card Jumlah Toko -->
        <div class="bg-white rounded-2xl shadow p-4 flex flex-col items-center justify-center">
          <h2 class="text-lg font-semibold text-gray-700 mb-4">Jumlah Toko : 5</h2>
          <!-- Dummy Donut Chart -->
          <div class="relative w-36 h-36">
            <!-- Base ring -->
            <svg class="absolute top-0 left-0 w-full h-full">
              <circle cx="50%" cy="50%" r="45%" stroke="#f3f4f6" stroke-width="10" fill="none" />
              <circle cx="50%" cy="50%" r="45%" stroke="#3b82f6" stroke-width="10" fill="none" stroke-dasharray="80 100" stroke-dashoffset="25" />
              <circle cx="50%" cy="50%" r="35%" stroke="#f59e0b" stroke-width="10" fill="none" stroke-dasharray="60 100" stroke-dashoffset="10" />
              <circle cx="50%" cy="50%" r="25%" stroke="#10b981" stroke-width="10" fill="none" stroke-dasharray="40 100" stroke-dashoffset="0" />
            </svg>
          </div>
          <!-- Legend -->
          <div class="mt-4 text-sm flex space-x-4">
            <div class="flex items-center space-x-1">
              <div class="w-3 h-3 bg-blue-500 rounded-full"></div>
              <span>Urea</span>
            </div>
            <div class="flex items-center space-x-1">
              <div class="w-3 h-3 bg-yellow-500 rounded-full"></div>
              <span>NPK</span>
            </div>
            <div class="flex items-center space-x-1">
              <div class="w-3 h-3 bg-green-500 rounded-full"></div>
              <span>NPK-Fk</span>
            </div>
          </div>
        </div>
      </div>
      
    <div class="bg-white rounded-2xl shadow-md p-6 mb-6">
        <h2 class="text-lg font-semibold text-black mb-4">Daftar Surat Masuk</h2>
    
        <div class="flex justify-between gap-6">
            <div class="flex-1 overflow-x-auto rounded-xl border border-gray-200">
                <table class="min-w-full text-sm text-left">
                    <thead class="bg-blue-300 text-black">
                        <tr>
                            <th class="py-3 px-4">No</th>
                            <th class="py-3 px-4">Nomor Surat</th>
                            <th class="py-3 px-4">Pengirim</th>
                            <th class="py-3 px-4">Tanggal Masuk</th>
                            <th class="py-3 px-4">Surat</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- @forelse ($suratMasuk as $index => $surat)
                            <tr class="border-b">
                                <td class="py-2 px-4">{{ $index + 1 }}</td>
                                <td class="py-2 px-4">{{ $surat->nomor }}</td>
                                <td class="py-2 px-4">{{ $surat->pengirim }}</td>
                                <td class="py-2 px-4">{{ \Carbon\Carbon::parse($surat->tanggal_masuk)->format('d M Y') }}</td>
                                <td class="py-2 px-4">
                                    <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-1 rounded-full text-xs">BACA</button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-4 text-gray-500">Tidak ada surat masuk</td>
                            </tr>
                        @endforelse --}}
                    </tbody>
                </table>
            </div>
    
            <div class="bg-white rounded-2xl p-6">
                <div class="flex flex-col gap-4 items-center">
                    <a href="{{ route('perdagangan.kelolaSurat') }}"
                       class="flex items-center justify-center gap-2 bg-white text-black text-sm font-semibold px-5 py-2 rounded-lg shadow-[0_4px_12px_rgba(0,0,0,0.1)] border border-gray-200 hover:bg-gray-100 min-w-[150px] transition">
                        <img src="{{ asset('assets/img/icon/eye.png') }}" alt="Kelola Icon" class="w-4 h-4">
                        Kelola Surat
                    </a>
                    <div class="flex items-center gap-3 bg-white p-4 rounded-xl shadow-[0_4px_20px_rgba(0,96,255,0.15)]">
                        <img src="{{ asset('assets/img/icon/quote.png') }}" alt="Quote" class="w-5 h-5">
                        <p class="italic text-sm">Perdagangan yang sehat, <br>ekonomi yang kuat</p>
                    </div>
                </div>
            </div>         

        </div>
    </div>
    
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-white rounded-2xl shadow-md p-6">
            <h2 class="text-lg font-semibold text-black mb-4">Daftar Harga Barang</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm text-left">
                    <thead class="bg-blue-300 text-black">
                        <tr>
                            <th class="py-2 px-4">Nama Barang</th>
                            <th class="py-2 px-4">Harga Satuan</th>
                            <th class="py-2 px-4">Satuan</th>
                            <th class="py-2 px-4">Update Terakhir</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- @foreach ($daftarHarga as $item)
                            <tr class="border-b">
                                <td class="py-2 px-4">{{ $item->nama_barang }}</td>
                                <td class="py-2 px-4">Rp{{ number_format($item->harga_satuan, 0, ',', '.') }}</td>
                                <td class="py-2 px-4">{{ $item->satuan }}</td>
                                <td class="py-2 px-4">{{ \Carbon\Carbon::parse($item->updated_at)->format('d M Y') }}</td>
                            </tr>
                        @endforeach --}}
                    </tbody>
                </table>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-md p-6">
            <div class="mb-4">
                <div>
                    <h2 class="text-lg font-semibold text-black mb-4">Notifikasi Penting</h2>
                    <ul class="list-disc pl-5 space-y-2 text-sm text-gray-700 overflow-y-auto pr-2 flex-1">
                        {{-- <div class="max-h-64 overflow-y-auto pr-2">
                            <ol class="list-decimal ml-5 space-y-1">
                                @foreach ($notifikasi as $item)
                                    <li>
                                        <div class="pl-2">
                                            {{ $item->pesan }}
                                        </div>
                                    </li>
                                @endforeach
                            </ol>
                        </div>                         --}}
                    </ul>
                </div>                
            </div>
        </div>
        
    </div>
</div>
@endsection
