@extends('layouts.admin')

@section('title', 'Dashboard Kabid Metrologi')

@php
use App\Helpers\StatusHelper;
@endphp

@section('content')
<div class="p-6 bg-gray-100 min-h-screen">
    <!-- Card Box Section -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        <a href="#" class="bg-[#0c3252] rounded-2xl shadow-md hover:shadow-lg transition p-4 flex items-center space-x-3">
            <img src="{{ asset('assets/img/icon/folder-download.png') }}" alt="Surat Masuk" class="w-10 h-10 sm:w-12 sm:h-12 flex-shrink-0">
            <div class="min-w-0 flex-1">
                <p class="text-sm sm:text-base font-medium text-white truncate">Jumlah Surat Masuk</p>
                <p class="text-xl sm:text-2xl font-bold text-white">{{ $totalSuratMasuk }}</p>
            </div>
        </a>

        <a href="#" class="bg-[#0c3252] rounded-2xl shadow-md hover:shadow-lg transition p-4 flex items-center space-x-3">
            <img src="{{ asset('assets/img/icon/Verif.png') }}" alt="Terverifikasi" class="w-10 h-10 sm:w-12 sm:h-12 flex-shrink-0">
            <div class="min-w-0 flex-1">
                <p class="text-sm sm:text-base font-medium text-white truncate">Jumlah Surat Disetujui</p>
                <p class="text-xl sm:text-2xl font-bold text-white">{{ $totalSuratDiterima }}</p>
            </div>
        </a>

        <a href="#" class="bg-[#0c3252] rounded-2xl shadow-md hover:shadow-lg transition p-4 flex items-center space-x-3">
            <img src="{{ asset('assets/img/icon/surat_ditolak.png') }}" alt="Ditolak" class="w-10 h-10 sm:w-12 sm:h-12 flex-shrink-0">
            <div class="min-w-0 flex-1">
                <p class="text-sm sm:text-base font-medium text-white truncate">Jumlah Surat Ditolak</p>
                <p class="text-xl sm:text-2xl font-bold text-white">{{ $totalSuratDitolak }}</p>
            </div>
        </a>

        <a href="#" class="bg-[#0c3252] rounded-2xl shadow-md hover:shadow-lg transition p-4 flex items-center space-x-3">
            <img src="{{ asset('assets/img/icon/draf.png') }}" alt="Draft" class="w-10 h-10 sm:w-12 sm:h-12 flex-shrink-0">
            <div class="min-w-0 flex-1">
                <p class="text-sm sm:text-base font-medium text-white truncate">Jumlah Surat Menunggu</p>
                <p class="text-xl sm:text-2xl font-bold text-white">{{ $totalSuratMenungguKabid }}</p>
            </div>
        </a>
    </div>

    <!-- Rest of the content -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 bg-white shadow-md rounded-xl p-4 max-h-[650px] overflow-y-auto">
            <div class="flex justify-between items-center mb-4">
                <div class="text-xl font-semibold text-gray-700">Daftar UTTP Terbaru</div>
            </div>

            <table class="w-full text-left">
                <thead class="bg-[#0c3252] text-white">
                    <tr>
                        <th class="px-4 py-2">Jenis Alat</th>
                        <th class="px-4 py-2">Nomor Registrasi</th>
                        <th class="px-4 py-2">Tanggal Tera</th>
                        <th class="px-4 py-2">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($uttps as $uttp)
                    <tr class="border-b">
                        <td class="px-4 py-2">{{ $uttp->uttp->jenis_alat }}</td>
                        <td class="px-4 py-2">{{ $uttp->uttp->no_registrasi }}</td>
                        <td class="px-4 py-2">
                            {{ \Carbon\Carbon::parse($uttp->tanggal_penginputan)->translatedFormat('d F Y') }}
                        </td>
                        <td class="px-4 py-2 {{ $uttp->tanggal_exp >= now() ? 'text-green-600' : 'text-red-600' }}">
                            {{ $uttp->tanggal_exp >= now() ? 'Valid' : StatusHelper::formatStatus('Kadaluarsa') }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="flex flex-col gap-6">
            <div class="grid grid-cols-2 gap-4">
                <div class="bg-white shadow-md rounded-xl p-4 text-center text-sm flex flex-col items-center justify-center h-full">
                    <div class="text-5xl mb-4">⚖️</div>
                    <p class="text-gray-500 text-base">Jumlah Alat Ukur Valid</p>
                    <h2 class="text-4xl font-bold my-2">{{ $jumlahValid }}</h2>
                </div>

                <div class="bg-white shadow-md rounded-xl p-4">
                    <p class="text-sm font-semibold mb-2">Jenis Alat Ukur</p>
                    <canvas id="chartPie" class="h-[150px]"></canvas>
                </div>
            </div>

            <div class="bg-white shadow-md rounded-xl p-4">
                <p class="text-lg font-semibold mb-4">Grafik Perbandingan Jumlah Tera</p>
                <canvas id="chartLine"></canvas>
            </div>
        </div>
    </div>
</div>

<script>
    const chartJenisLabels = {!! json_encode($jumlahPerJenis->pluck('jenis_alat')) !!};
    const chartJenisData = {!! json_encode($jumlahPerJenis->pluck('total')) !!};

    new Chart(document.getElementById('chartPie'), {
        type: 'doughnut',
        data: {
            labels: chartJenisLabels,
            datasets: [{
                label: 'Jumlah Alat',
                data: chartJenisData,
                backgroundColor: ['#60a5fa', '#0c3252', '#f59e0b', '#10b981'],
                hoverOffset: 4
            }]
        },
        options: {
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    enabled: true
                }
            }
        }
    });

    const ctxLine = document.getElementById('chartLine');
    new Chart(ctxLine, {
        type: 'line',
        data: {
            labels: ['JAN', 'FEB', 'MAR', 'APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC'],
            datasets: [
                {
                    label: 'Tahun {{ $currentYear }}',
                    data: {!! $currentYearData !!},
                    borderColor: '#60a5fa',
                    backgroundColor: 'rgba(96, 165, 250, 0.2)',
                    tension: 0.4,
                    fill: true
                },
                {
                    label: 'Tahun {{ $lastYear }}',
                    data: {!! $lastYearData !!},
                    borderColor: '#0c3252',
                    backgroundColor: 'rgba(12, 50, 82, 0.2)',
                    tension: 0.4,
                    fill: true
                }
            ]
        },
        options: {
            plugins: {
                legend: {
                    display: true,
                    position: 'bottom'
                },
                tooltip: {
                    mode: 'index',
                    intersect: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Jumlah Tera'
                    }
                }
            }
        }
    });
</script>
@endsection