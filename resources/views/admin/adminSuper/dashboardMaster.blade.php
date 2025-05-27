@extends('layouts.admin')

@section('title', 'Master Admin')

@section('content')
<div class="px-4 py-6 sm:px-6 lg:px-8 max-w-7xl mx-auto">
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
        <div class="bg-white p-6 rounded-2xl shadow-md flex items-center space-x-5">
            <div>
                <div class="font-semibold text-sm text-gray-700">Total Permohonan</div>
                <div class="text-3xl font-bold text-gray-900">{{ $totalPermohonan }}</div>
                <div class="text-sm text-gray-500">Total Keseluruhan</div>
            </div>
        </div>
        <div class="bg-white p-6 rounded-2xl shadow-md flex items-center space-x-5">
            <img src="{{ asset('assets/img/icon/validation-approval.png') }}" alt="Icon" class="w-12 h-12">
            <div>
                <div class="font-semibold text-sm text-gray-700">Total Pengguna</div>
                <div class="text-3xl font-bold text-gray-900">{{ $totalPengguna }}</div>
                <div class="text-sm text-gray-500">Hingga Bulan Ini</div>
            </div>
        </div>
        <div class="bg-white p-6 rounded-2xl shadow-md flex items-center space-x-5">
            <img src="{{ asset('assets/img/icon/validation-approval.png') }}" alt="Icon" class="w-12 h-12">
            <div>
                <div class="font-semibold text-sm text-gray-700">Total Pengaduan</div>
                <div class="text-3xl font-bold text-gray-900">{{ $totalPengaduan }}</div>
                <div class="text-sm text-gray-500">Hingga Bulan Ini</div>
            </div>
        </div>
    </div>
    <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">
        <div class="xl:col-span-2 bg-white p-4 rounded-2xl shadow-md">
            <h3 class="text-xl font-semibold mb-5 text-gray-800">Daftar Permohonan Terbaru</h3>
            <div class="overflow-y-auto max-h-[800px] rounded-xl shadow-inner">
                <table class="w-full text-sm text-left border-collapse">
                    <thead class="bg-[#083458] text-white sticky top-0 z-10">
                        <tr>
                            <th class="px-6 py-3 rounded-tl-xl">Tanggal</th>
                            <th class="px-6 py-3">Nama Pengirim</th>
                            <th class="px-6 py-3">Bidang Terkait</th>
                            <th class="px-6 py-3 rounded-tr-xl">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($permohonan as $p)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-3 whitespace-nowrap">{{ $p->tanggal }}</td>
                            <td class="px-6 py-3">{{ $p->nama_pengirim }}</td>
                            <td class="px-6 py-3">{{ $p->bidang_terkait }}</td>
                            @php
                                $status = $p->status;
                                $color = match($status) {
                                    'Menunggu' => 'bg-yellow-100 text-yellow-800',
                                    'Disetujui' => 'bg-green-100 text-green-800',
                                    'Ditolak' => 'bg-red-100 text-red-800',
                                    'Diproses' => 'bg-blue-100 text-blue-800',
                                    'Menunggu Persetujuan' => 'bg-blue-100 text-blue-800',
                                    'Butuh Revisi' => 'bg-orange-100 text-orange-800',
                                    default => 'bg-gray-100 text-gray-800',
                                };
                            @endphp
                            <td class="px-6 py-3">
                                <span class="px-3 py-1 text-xs rounded-full font-semibold {{ $color }}">
                                    {{ $status }}
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="space-y-8">
            <div class="flex flex-col xl:flex-row gap-6">
                <div class="flex-1 bg-white p-6 rounded-2xl shadow-md flex flex-col items-center">
                    <img src="{{ asset('assets/img/icon/permintaan.png') }}" alt="Icon" class="w-14 h-14 mb-3">
                    <div class="font-semibold text-base text-center text-gray-700">Total Distributor</div>
                    <div class="text-3xl font-bold text-center text-gray-900">{{ $totalDistributor }}</div>
                </div>

                <div class="flex-1 bg-white p-6 rounded-2xl shadow-md flex flex-col items-center">
                    <img src="{{ asset('assets/img/icon/komoditas.png') }}" alt="Icon" class="w-14 h-14 mb-3">
                    <div class="font-semibold text-base text-center text-gray-700">Total IKM Terdaftar</div>
                    <div class="text-3xl font-bold text-center text-gray-900">{{ $totalKomoditas }}</div>
                </div>
            </div>

            <div class="bg-white p-6 rounded-2xl shadow-md">
                <h3 class="text-base font-semibold mb-4 text-gray-800">Statistik Permohonan Perbulan</h3>
                <canvas id="chartPermohonan" height="180"></canvas>
            </div>

            <div class="bg-white p-6 rounded-2xl shadow-md">
                <h3 class="text-base font-semibold mb-4 text-gray-800">Kategori Pengaduan</h3>
                <canvas id="piePengaduan" height="180"></canvas>
            </div>
        </div>
    </div>
</div>

{{-- Chart.js CDN --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctxLine = document.getElementById('chartPermohonan').getContext('2d');
    new Chart(ctxLine, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul'],
            datasets: [{
                label: 'Permohonan',
                data: [30, 45, 35, 50, 40, 60, 55],
                borderColor: '#2563eb',
                backgroundColor: 'rgba(37, 99, 235, 0.2)',
                fill: true,
                tension: 0.4,
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: { beginAtZero: true }
            },
            plugins: {
                legend: {
                    labels: {
                        font: {
                            size: 14
                        }
                    }
                }
            }
        }
    });

    const ctxPie = document.getElementById('piePengaduan').getContext('2d');
    new Chart(ctxPie, {
        type: 'pie',
        data: {
            labels: ['Harga Barang', 'Pelayanan', 'Ketersediaan'],
            datasets: [{
                label: 'Kategori',
                data: [40, 35, 25],
                backgroundColor: ['#3b82f6', '#0ea5e9', '#6366f1'],
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        font: {
                            size: 14
                        }
                    }
                }
            }
        }
    });
</script>

@endsection