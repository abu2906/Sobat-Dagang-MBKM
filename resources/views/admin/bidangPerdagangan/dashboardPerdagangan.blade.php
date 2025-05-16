@extends('layouts.admin')
@section('title', 'Dashboard Perdagangan')

@section('content')
<div class="min-h-screen p-6 bg-gray-100">
    <div class="grid grid-cols-1 gap-4 mb-6 sm:grid-cols-2 md:grid-cols-4">
        <a href="#" class="flex items-center p-5 space-x-4 transition bg-white shadow-md rounded-2xl hover:shadow-lg">
            <img src="{{ asset('assets/img/icon/folder-download.png') }}" alt="Surat Masuk" class="w-12 h-12">
            <div>
                <p class="text-base font-medium text-black">Jumlah Surat Masuk</p>
                <p class="text-2xl font-bold text-blue-600">{{ $totalSuratPerdagangan }}</p>
            </div>
        </a>

        <a href="#" class="flex items-center p-5 space-x-4 transition bg-white shadow-md rounded-2xl hover:shadow-lg">
            <img src="{{ asset('assets/img/icon/Verif.png') }}" alt="Terverifikasi" class="w-12 h-12">
            <div>
                <p class="text-base font-medium text-black">Jumlah Surat Terverifikasi</p>
                <p class="text-2xl font-bold text-yellow-500">{{ $totalSuratTerverifikasi }}</p>
            </div>
        </a>

        <a href="#" class="flex items-center p-5 space-x-4 transition bg-white shadow-md rounded-2xl hover:shadow-lg">
            <img src="{{ asset('assets/img/icon/surat_ditolak.png') }}" alt="Ditolak" class="w-12 h-12">
            <div>
                <p class="text-base font-medium text-black">Jumlah Surat Ditolak</p>
                <p class="text-2xl font-bold text-green-600">{{ $totalSuratDitolak }}</p>
            </div>
        </a>

        <a href="#" class="flex items-center p-5 space-x-4 transition bg-white shadow-md rounded-2xl hover:shadow-lg">
            <img src="{{ asset('assets/img/icon/draf.png') }}" alt="Draft" class="w-12 h-12">
            <div>
                <p class="text-base font-medium text-black">Draft Surat Balasan</p>
                <p class="text-2xl font-bold text-orange-500">{{ $totalSuratDraft }}</p>
            </div>
        </a>
    </div>

    <div class="grid grid-cols-1 gap-6 p-6 md:grid-cols-2">
        <!-- Card Statistik Indeks Harga -->
        <div class="p-4 bg-white shadow rounded-2xl">
            <div class="flex items-center justify-between mb-4">
                <h2 class="flex items-center text-sm font-semibold text-gray-700">
                    📈 Statistik Indeks Harga
                </h2>
            </div>
            <!-- Dummy Bar Chart -->
            <div class="flex items-end justify-around h-40 px-2 rounded-lg bg-gradient-to-b from-pink-100 to-purple-100">
                <div class="w-4 bg-blue-500 rounded h-1/4"></div>
                <div class="w-4 bg-red-500 rounded h-1/3"></div>
                <div class="w-4 bg-blue-500 rounded h-1/2"></div>
                <div class="w-4 bg-red-500 rounded h-1/2"></div>
                <div class="w-4 bg-blue-500 rounded h-3/4"></div>
                <div class="w-4 bg-red-500 rounded h-2/3"></div>
            </div>
            <!-- Statistik Bawah -->
            <div class="grid grid-cols-4 mt-4 text-sm text-center">
                <div>
                    <p class="font-semibold">Rp 11.423</p>
                    <p class="text-xs text-gray-500">Terendah</p>
                </div>
                <div>
                    <p class="font-semibold">Rp 11.423</p>
                    <p class="text-xs text-gray-500">Rata-rata</p>
                </div>
                <div>
                    <p class="font-semibold">Rp 11.423</p>
                    <p class="text-xs text-gray-500">Tertinggi</p>
                </div>
                <div>
                    <p class="font-semibold">5,1%</p>
                    <p class="text-xs text-gray-500">Variasi</p>
                </div>
            </div>
            <div class="grid grid-cols-3 gap-2 mt-2 text-xs text-center">
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
        <div class="flex flex-col items-center justify-center p-4 bg-white shadow rounded-2xl">
            <h2 class="mb-4 text-lg font-semibold text-gray-700">Jumlah Toko : 5</h2>
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
            <div class="flex mt-4 space-x-4 text-sm">
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

    <div class="p-6 mb-6 bg-white shadow-md rounded-2xl">
        <h2 class="mb-4 text-lg font-semibold text-black">Daftar Surat Masuk</h2>

        <div class="flex justify-between gap-6">
            <div class="flex-1 overflow-hidden border border-gray-200 rounded-xl">
                <div class="overflow-y-auto max-h-[500px] scrollbar-hide">
                    <table class="min-w-full text-sm text-left">
                        <thead class="bg-[#083358] text-white font-semibold sticky top-0 z-10">
                            <tr class="bg-[#083358] text-white font-semibold ">
                                <th class="px-4 py-3 text-center border-b rounded-tl-xl">No</th>
                                <th class="px-4 py-3 text-center border-b">Nama Pemohon</th>
                                <th class="px-4 py-3 text-center border-b">Jenis Surat</th>
                                <th class="px-4 py-3 text-center border-b">Tanggal Dikirim</th>
                                <th class="px-4 py-3 text-center border-b">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dataSurat as $index => $item)
                            <tr class="text-center border-b">
                                <td class="px-4 py-2">{{ $index + 1 }}</td>
                                <td class="px-4 py-2">{{ $item->user->nama ?? 'Tidak Diketahui' }}</td>
                                @php
                                $jenisSuratMap = [
                                'surat_rekomendasi_perdagangan' => 'Surat Rekomendasi',
                                'surat_keterangan_perdagangan' => 'Surat Keterangan',
                                'dan_lainnya_perdagangan' => 'Surat Lainnya',
                                ];
                                @endphp
                                <td class="px-4 py-2">
                                    {{ $jenisSuratMap[$item->jenis_surat] ?? $item->jenis_surat }}
                                </td>
                                <td class="px-4 py-2">{{ \Carbon\Carbon::parse($item->created_at)->format('d-m-Y') }}</td>
                                <td class="px-4 py-3 text-center">
                                    @if ($item->status == 'diterima')
                                    <span class="font-medium text-green-600">Disetujui</span>
                                    @elseif ($item->status == 'ditolak')
                                    <span class="font-medium text-red-600">Ditolak</span>
                                    @else
                                    <span class="font-medium text-yellow-400">Menunggu</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="p-6 bg-white rounded-2xl">
                <div class="flex flex-col items-center gap-4">
                    <a href="{{ route('perdagangan.kelolaSurat') }}"
                        class="flex items-center justify-center gap-2 bg-white text-black text-sm font-semibold px-5 py-2 rounded-lg shadow-[0_4px_12px_rgba(0,0,0,0.1)] border border-gray-200 hover:bg-gray-100 min-w-[150px] transition">
                        <img src="{{ asset('assets/img/icon/eye.png') }}" alt="Kelola Icon" class="w-4 h-4">
                        Kelola Surat
                    </a>
                    <div class="flex items-center gap-3 bg-white p-4 rounded-xl shadow-[0_4px_20px_rgba(0,96,255,0.15)]">
                        <img src="{{ asset('assets/img/icon/quote.png') }}" alt="Quote" class="w-5 h-5">
                        <p class="text-sm italic">Perdagangan yang sehat, <br>ekonomi yang kuat</p>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
        <div class="overflow-x-auto rounded-xl shadow max-h-[500px] overflow-y-auto scrollbar-hide">
            <table class="min-w-full text-sm text-left border-separate border-spacing-0">
                <thead class="sticky top-0 z-10 text-black bg-blue-300">
                    <tr>
                        <th class="px-4 py-2 rounded-tl-xl">Nama Barang</th>
                        <th class="px-4 py-2">Kategori Barang</th>
                        <th class="px-4 py-2">Harga Satuan (kg)</th>
                        <th class="px-4 py-2 rounded-tr-xl">Update Terakhir</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($daftarHarga as $index => $harga)
                    <tr class="border-b odd:bg-white even:bg-gray-100">
                        <td class="px-4 py-2">{{ $harga->nama_barang }}</td>
                        <td class="px-4 py-2">{{ $harga->kategori_barang }}</td>
                        <td class="px-4 py-2">Rp{{ number_format($harga->harga_satuan, 0, ',', '.') }}</td>
                        <td class="px-4 py-2">{{ \Carbon\Carbon::parse($harga->updated_at)->format('d M Y') }}</td>
                    </tr>
                    @endforeach
                    @if ($daftarHarga->isEmpty())
                    <tr>
                        <td colspan="4" class="py-4 text-center text-gray-500">Tidak ada data harga barang</td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
        <div class="p-6 bg-white shadow-md rounded-2xl">
            <div class="mb-4">
                <div>
                    <h2 class="mb-4 text-lg font-semibold text-black">Notifikasi Penting</h2>
                    <ul class="flex-1 pl-5 pr-2 space-y-2 overflow-y-auto text-sm text-gray-700 list-disc">
                        {{-- <div class="pr-2 overflow-y-auto max-h-64">
                            <ol class="ml-5 space-y-1 list-decimal">
                                @foreach ($notifikasi as $item)
                                    <li>
                                        <div class="pl-2">
                                            {{ $item->pesan }}
                </div>
                </li>
                @endforeach
                </ol>
            </div> --}}
            </ul>
        </div>
    </div>
</div>

</div>
</div>
@endsection