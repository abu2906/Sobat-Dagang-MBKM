@extends('layouts.metrologi.admin')
@section('title', 'Dashboard Metrologi')

@section('content')
<div class="p-6 bg-gray-100 min-h-screen">
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4 mb-6">
        <a href="#" class="bg-[#0c3252] rounded-2xl shadow-md hover:shadow-lg transition p-5 flex items-center space-x-4">
            <img src="{{ asset('assets/img/icon/folder-download.png') }}" alt="Surat Masuk" class="w-12 h-12">
            <div>
                <p class="text-base font-medium text-white">Jumlah Surat Masuk</p>
                <p class="text-2xl font-bold text-white">{{ $dataSuratAdmin['totalSuratMasuk'] }}</p>
            </div>
        </a>

        <a href="#" class="bg-[#0c3252] rounded-2xl shadow-md hover:shadow-lg transition p-5 flex items-center space-x-4">
            <img src="{{ asset('assets/img/icon/Verif.png') }}" alt="Terverifikasi" class="w-12 h-12">
            <div>
                <p class="text-base font-medium text-white">Jumlah Surat Disetujui</p>
                <p class="text-2xl font-bold text-white">{{ $dataSuratAdmin['totalSuratMasukDisetujui'] }}</p>
            </div>
        </a>

        <a href="#" class="bg-[#0c3252] rounded-2xl shadow-md hover:shadow-lg transition p-5 flex items-center space-x-4">
            <img src="{{ asset('assets/img/icon/surat_ditolak.png') }}" alt="Ditolak" class="w-12 h-12">
            <div>
                <p class="text-base font-medium text-white">Jumlah Surat Ditolak</p>
                <p class="text-2xl font-bold text-white">{{ $dataSuratAdmin['totalSuratDitolak'] }}</p>
            </div>
        </a>

        <a href="#" class="bg-[#0c3252] rounded-2xl shadow-md hover:shadow-lg transition p-5 flex items-center space-x-4">
            <img src="{{ asset('assets/img/icon/draf.png') }}" alt="Draft" class="w-12 h-12">
            <div>
                <p class="text-base font-medium text-white">Jumlah Surat Menunggu</p>
                <p class="text-2xl font-bold text-white">{{ $dataSuratAdmin['totalSuratMenunggu'] }}</p>
            </div>
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
        <div class="bg-white rounded-lg shadow p-6">
            <h5 class="text-lg font-semibold mb-4">Tren Permohonan per Bulan</h5>
            <div class="h-[300px]">
					<canvas id="lineChart" class="w-full h-full"></canvas>
				</div>
			</div>
        <div class="bg-white rounded-lg shadow p-6">
            <h5 class="text-lg font-semibold mb-4">Frekuensi Pengujian Alat Ukur</h5>
            <div class="h-[300px]">
					<canvas id="donutChart" class="w-full h-full"></canvas>
			</div>
		</div>
	</div>
    
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="bg-white rounded-2xl shadow-md p-6">
            <h2 class="text-lg font-semibold text-black mb-4">Daftar Permohonan Terbaru</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm text-left">
                    <thead class="bg-blue-300 text-black">
                        <tr>
                            <th class="text-center py-2 px-4 w-1/5">Nomor Surat</th>
                            <th class="text-center py-2 px-4 w-2/5">Nama Pemohon</th>
                            <th class="text-center py-2 px-4 w-2/5">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($dataSuratAdmin['suratTerbaru'] as $surat)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="text-center py-2 px-4 truncate max-w-[120px]" title="{{ $surat->id_surat }}">{{ $surat->id_surat }}</td>
                                <td class="text-center py-2 px-4 truncate max-w-[200px]" title="{{ $surat->user->nama }}">{{ $surat->user->nama }}</td>
                                <td class="text-center py-2 px-4">
                                    <span class="text-xs font-medium px-2 py-1 rounded-full whitespace-nowrap inline-block max-w-[200px] truncate" title="{{ $surat->status_admin }}"
                                        {{ $surat->status_admin == 'Menunggu' ? 'text-yellow-700 bg-yellow-100' : '' }}
                                        {{ $surat->status_admin == 'Diproses' ? 'text-blue-700 bg-blue-100' : '' }}
                                        {{ $surat->status_admin == 'Ditolak' ? 'text-red-700 bg-red-100' : '' }}
                                        {{ $surat->status_admin == 'Menunggu Persetujuan' ? 'text-indigo-700 bg-indigo-100' : '' }}
                                        {{ $surat->status_admin == 'Diterima' ? 'text-cyan-700 bg-cyan-100' : '' }}
                                        {{ $surat->status_admin == 'Selesai' ? 'text-green-700 bg-green-100' : '' }}
                                        {{ $surat->status_admin == 'Butuh Revisi' ? 'text-orange-700 bg-orange-100' : '' }}>
                                        {{ $surat->status_admin }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-md p-6">
            <div class="flex flex-col gap-4">
                <div class="flex flex-col items-center justify-center gap-2 bg-[#0c3252] text-white px-5 py-4 rounded-lg">
					<p class="text-lg font-semibold">Surat Belum Terverifikasi</p>
					<p class="text-3xl font-semibold">{{ $dataSuratAdmin['totalSuratMenunggu'] }}</p>
                    <a href="{{ route('persuratan-metrologi') }}" class="bg-white text-[#0c3252] flex p-2 gap-2 items-center justify-center text-sm rounded-lg shadow w-1/2">
						Tinjau Sekarang
					</a>
				</div>
                <div class="flex flex-col items-center gap-3">
                    <h1 class="text-center font-bold text-lg mb-2">Jumlah Permohonan per Status</h1>
                    <div class="h-[200px] w-full">
					<canvas id="statusChart"></canvas>
                    </div>
                    <div class="legend text-sm grid grid-cols-3 gap-2 mt-2">
                        <div class="flex items-center gap-1">
                            <span style="color: #f59e0b;">&#11044;</span> Menunggu
                        </div>
                        <div class="flex items-center gap-1">
                            <span style="color: #22c55e;">&#11044;</span> Disetujui
                        </div>
                        <div class="flex items-center gap-1">
                            <span style="color: #ef4444;">&#11044;</span> Ditolak
                        </div>
                    </div>
				</div>
			</div>
        </div>

		<div class="bg-white rounded-2xl shadow-md p-6">
            <h5 class="text-lg font-semibold mb-4">Jumlah Alat Berdasarkan Jenis per Bulan</h5>
            <div class="h-[300px]">
                <canvas id="barChart"></canvas>
            </div>
		</div>
    </div>
</div>

<script>
    const dataTera = {!! $dataTera !!};
    const dataTeraUlang = {!! $dataTeraUlang !!};
    const labels = {!! $labels !!};
    const dataTahunLaluUP = {!! $dataTahunLaluUP !!};
    const dataTahunIniUP = {!! $dataTahunIniUP !!};
    const dataTahunLaluVOL = {!! $dataTahunLaluVOL !!};
    const dataTahunIniVOL = {!! $dataTahunIniVOL !!};
    const dataTahunLaluMAS = {!! $dataTahunLaluMAS !!};
    const dataTahunIniMAS = {!! $dataTahunIniMAS !!};
    const tahunLalu = {{ $tahunLalu }};
    const tahunSekarang = {{ $tahunSekarang }};

    new Chart(document.getElementById('lineChart'), {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
            datasets: [
                {
                    label: 'Permohonan Tera',
                    data: dataTera,
                    borderColor: 'blue',
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    tension: 0.4
                },
                {
                    label: 'Permohonan Tera Ulang',
                    data: dataTeraUlang,
                    borderColor: 'green',
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    tension: 0.4
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
				legend: {
                    position: 'bottom'
                }
				}
        },
    });

    // Donut Chart
    new Chart(document.getElementById('donutChart'), {
    type: 'doughnut',
    data: {
        labels: {!! $donutLabels !!},
        datasets: [{
            data: {!! $donutData !!},
            backgroundColor: ['#a3a3a3', '#1e3a8a', '#06b6d4'],
            borderWidth: 2,
            borderColor: '#ffffff'
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                    position: 'bottom',
                labels: {
                    color: '#111827',
                    font: {
                        size: 14,
                        weight: 'bold'
                    },
                    padding: 15
                }
                }
            }
    }
});

    // Pie Chart for Status
    new Chart(document.getElementById('statusChart'), {
        type: 'pie',
        data: {
            labels: ['Menunggu', 'Disetujui', 'Ditolak'],
            datasets: [{
                data: [
                    {{ $dataSuratAdmin['pieChartData']['menunggu'] }},
                    {{ $dataSuratAdmin['pieChartData']['disetujui'] }},
                    {{ $dataSuratAdmin['pieChartData']['ditolak'] }}
                ],
                backgroundColor: [
                    '#f59e0b', // Menunggu - yellow
                    '#22c55e', // Disetujui - green
                    '#ef4444'  // Ditolak - red
                ],
                borderColor: '#ffffff',
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });

    new Chart(document.getElementById('barChart'), {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [
                {
                    label: 'UP - ' + tahunLalu,
                    data: dataTahunLaluUP,
                    backgroundColor: 'rgba(255, 165, 0, 0.7)'
                },
                {
                    label: 'UP - ' + tahunSekarang,
                    data: dataTahunIniUP,
                    backgroundColor: 'rgba(255, 165, 0, 0.3)'
                },
                {
                    label: 'VOL - ' + tahunLalu,
                    data: dataTahunLaluVOL,
                    backgroundColor: 'rgba(100, 149, 237, 0.7)'
                },
                {
                    label: 'VOL - ' + tahunSekarang,
                    data: dataTahunIniVOL,
                    backgroundColor: 'rgba(100, 149, 237, 0.3)'
                },
                {
                    label: 'MAS - ' + tahunLalu,
                    data: dataTahunLaluMAS,
                    backgroundColor: 'rgba(60, 179, 113, 0.7)'
                },
                {
                    label: 'MAS - ' + tahunSekarang,
                    data: dataTahunIniMAS,
                    backgroundColor: 'rgba(60, 179, 113, 0.3)'
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom'
                }
            },
            scales: {
                x: {
                    stacked: false
                },
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
@endsection
