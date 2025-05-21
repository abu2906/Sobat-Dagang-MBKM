@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="flex">
    <div class="flex-1 p-6 space-y-6 overflow-y-auto">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white shadow-md rounded-xl p-4 text-center">
                <p class="text-gray-500">Jumlah Surat Masuk</p>
                <h2 class="text-3xl font-bold">{{ $totalSuratMasuk }}</h2>
                <p class="text-sm text-gray-400">Total Keseluruhan</p>
            </div>

            <div class="bg-white shadow-md rounded-xl p-4 text-center">
                <p class="text-gray-500">Jumlah Surat Ditolak</p>
                <h2 class="text-3xl font-bold">{{ $totalSuratDitolak }}</h2>
                <p class="text-sm text-gray-400">Total Keseluruhan</p>
            </div>

            <div class="bg-white shadow-md rounded-xl p-4 text-center">
                <p class="text-gray-500">Jumlah Surat Diterima</p>
                <h2 class="text-3xl font-bold">{{ $totalSuratDiterima }}</h2>
                <p class="text-sm text-gray-400">Total Keseluruhan</p>
            </div>

        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="lg:col-span-2 bg-white shadow-md rounded-xl p-4 max-h-[600px] overflow-y-auto">
                <div class="flex justify-between items-center mb-4">
                    <div class="text-xl font-semibold text-gray-700">Daftar UTTP Terbaru</div>
                    <a href="{{ route('directory-uttp-kabid') }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                        Lihat Semua
                    </a>
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
                                {{ $uttp->tanggal_exp >= now() ? 'VALID' : 'KADALUARSA' }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="flex flex-col gap-6">
                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-white shadow-md rounded-xl p-4 text-center text-sm flex flex-col items-center justify-center h-full">
                        <div class="text-3xl mb-2">⚖️</div>
                        <p class="text-gray-500 text-sm">Jumlah Alat Ukur Valid</p>
                        <h2 class="text-2xl font-bold">{{ $jumlahValid }}</h2>
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
