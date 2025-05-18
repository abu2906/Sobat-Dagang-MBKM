@extends('layouts.admin')
@section('title', 'Dashboard Perdagangan')

@section('content')
<div class="min-h-screen p-6 bg-gray-100">
    <!-- Statistik Surat -->
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

    <!-- Grafik dan Informasi Tambahan -->
    <div class="grid grid-cols-1 gap-4 p-4 md:grid-cols-2">
        <!-- Statistik Indeks Harga -->
        <div class="p-4 bg-white shadow-lg rounded-2xl">
            <div class="flex items-center gap-2 mb-2 font-semibold text-gray-800">
                <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M3 3v18h18" />
                    <path d="M4 14l4-4 5 5 7-7" />
                </svg>
                Statistik Indeks Harga
            </div>
            <canvas id="hargaChart" class="w-full h-48"></canvas>

            <div class="grid grid-cols-2 gap-2 mt-4 text-sm text-center md:grid-cols-4">
                <div>
                    <p class="text-gray-500">Terendah</p>
                    <p id="terendah" class="font-semibold">-</p>
                </div>
                <div>
                    <p class="text-gray-500">Rata-rata</p>
                    <p id="rata_rata" class="font-semibold">-</p>
                </div>
                <div>
                    <p class="text-gray-500">Tertinggi</p>
                    <p id="tertinggi" class="font-semibold">-</p>
                </div>
                <div>
                    <p class="text-gray-500">Volatilitas</p>
                    <p id="volatilitas" class="font-semibold">-</p>
                </div>
            </div>
        </div>

        <!-- Pie Chart Informasi Pupuk -->
        <div class="p-4 bg-white shadow-lg rounded-2xl">
            <div class="mb-2 font-semibold text-center text-gray-800">
                Informasi Tambahan
            </div>
            <canvas id="pupukChart" class="mx-auto w-50 h-50"></canvas>
            <div class="flex justify-center gap-4 mt-2 text-sm">
                <span class="flex items-center gap-1"><span class="w-3 h-3 bg-blue-900 rounded-full"></span> Urea</span>
                <span class="flex items-center gap-1"><span class="w-3 h-3 bg-blue-400 rounded-full"></span> NPK</span>
                <span class="flex items-center gap-1"><span class="w-3 h-3 bg-blue-200 rounded-full"></span> NPK-Fk</span>
            </div>
        </div>
    </div>

    <!-- Daftar Surat Masuk -->
    <div class="p-6 mb-6 bg-white shadow-md rounded-2xl">
        <h2 class="mb-4 text-lg font-semibold text-black">Daftar Surat Masuk</h2>

        <div class="flex justify-between gap-6">
            <div class="flex-1 overflow-hidden border border-gray-200 rounded-xl">
                <div class="overflow-y-auto max-h-[500px] scrollbar-hide">
                    <table class="min-w-full text-sm text-left">
                        <thead class="sticky top-0 z-10 bg-[#083358] text-white font-semibold">
                            <tr>
                                <th class="px-4 py-3 text-center border-b rounded-tl-xl">No</th>
                                <th class="px-4 py-3 text-center border-b">Nama Pemohon</th>
                                <th class="px-4 py-3 text-center border-b">Jenis Surat</th>
                                <th class="px-4 py-3 text-center border-b">Tanggal Dikirim</th>
                                <th class="px-4 py-3 text-center border-b rounded-tr-xl">Status</th>
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
                                        ];
                                    @endphp
                                    <td class="px-4 py-2">{{ $jenisSuratMap[$item->jenis_surat] ?? $item->jenis_surat }}</td>
                                    <td class="px-4 py-2">{{ \Carbon\Carbon::parse($item->created_at)->format('d-m-Y') }}</td>
                                    <td class="px-4 py-3">
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

            <div class="flex flex-col items-center gap-4 p-6 bg-white shadow-md rounded-2xl">
                <a href="{{ route('perdagangan.kelolaSurat') }}" 
                   class="flex items-center justify-center gap-2 px-5 py-2 text-sm font-semibold text-black bg-white border border-gray-200 rounded-lg shadow transition hover:bg-gray-100 min-w-[150px]">
                    <img src="{{ asset('assets/img/icon/eye.png') }}" alt="Kelola Icon" class="w-4 h-4">
                    Kelola Surat
                </a>
                <div class="flex items-center gap-3 p-4 bg-white rounded-xl shadow-[0_4px_20px_rgba(0,96,255,0.15)]">
                    <img src="{{ asset('assets/img/icon/quote.png') }}" alt="Quote" class="w-5 h-5">
                    <p class="text-sm italic">Perdagangan yang sehat, <br>ekonomi yang kuat</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Daftar Harga Barang dan Notifikasi -->
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
                    @forelse ($daftarHarga as $harga)
                        <tr class="border-b odd:bg-white even:bg-gray-100">
                            <td class="px-4 py-2 ">{{ $harga->nama_barang }}</td>
                            <td class="px-4 py-2">{{ $harga->kategori_barang }}</td>
                            <td class="px-4 py-2">Rp{{ number_format($harga->harga_satuan, 0, ',', '.') }}</td>
                            <td class="px-4 py-2">{{ \Carbon\Carbon::parse($harga->updated_at)->format('d M Y') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="py-4 text-center text-gray-500">Tidak ada data harga barang</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="p-6 bg-white shadow-md rounded-2xl">
            <h2 class="mb-4 text-lg font-semibold text-black">Notifikasi Penting</h2>
            <ul class="pl-5 pr-2 space-y-2 overflow-y-auto text-sm text-gray-700 list-disc max-h-64">
                {{-- 
                @foreach ($notifikasi as $item)
                    <li>{{ $item->pesan }}</li>
                @endforeach
                --}}
            </ul>
        </div>
    </div>
</div>

<script>
    // Grafik line harga pasar Sumpang dan Lakessi
    const ctxHarga = document.getElementById('hargaChart').getContext('2d');
    new Chart(ctxHarga, {
        type: 'line',
        data: {
            labels: {!! json_encode($labels) !!},
            datasets: [
                {
                    label: 'Pasar Sumpang',
                    data: {!! json_encode($hargaSumpang) !!},
                    fill: false,
                    borderColor: '#3b82f6',
                    backgroundColor: '#3b82f6',
                    tension: 0.3
                },
                {
                    label: 'Pasar Lakessi',
                    data: {!! json_encode($hargaLakessi) !!},
                    fill: false,
                    borderColor: '#ef4444',
                    backgroundColor: '#ef4444',
                    tension: 0.3
                }
            ]
        },
        options: {
            plugins: { legend: { display: true } },
            scales: { y: { beginAtZero: false } }
        }
    });

    // Update statistik harga
    document.getElementById("terendah").innerText = "Rp {{ $terendah }}";
    document.getElementById("rata_rata").innerText = "Rp {{ $rata_rata }}";
    document.getElementById("tertinggi").innerText = "Rp {{ $tertinggi }}";
    document.getElementById("volatilitas").innerText = "{{ $volatilitas }}";

    const ctxPupuk = document.getElementById('pupukChart').getContext('2d');
    new Chart(ctxPupuk, {
        type: 'pie',
        data: {
            labels: ['Urea', 'NPK', 'NPK-Fk'],
            datasets: [{
                data: [30, 45, 25], // Data statis
                backgroundColor: ['#1e3a8a', '#60a5fa', '#bfdbfe'],
                hoverOffset: 10
            }]
        },
        options: {
            plugins: { 
                legend: { display: false } 
            }
        }
    });
</script>
@endsection