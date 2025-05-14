@extends('layouts.metrologi.admin')
@section('title', 'Dashboard Metrologi')

@section('content')
<div class="p-6 bg-gray-100 min-h-screen">
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4 mb-2">
        <a href="#" class="bg-[#0c3252] rounded-2xl shadow-md hover:shadow-lg transition p-5 flex items-center space-x-4">
            <img src="{{ asset('assets/img/icon/folder-download.png') }}" alt="Surat Masuk" class="w-12 h-12">
            <div>
                <p class="text-base font-medium text-white">Jumlah Surat Masuk</p>
                <p class="text-2xl font-bold text-white">{{ $totalSuratMasuk }}</p>
            </div>
        </a>

        <a href="#" class="bg-[#0c3252] rounded-2xl shadow-md hover:shadow-lg transition p-5 flex items-center space-x-4">
            <img src="{{ asset('assets/img/icon/Verif.png') }}" alt="Terverifikasi" class="w-12 h-12">
            <div>
                <p class="text-base font-medium text-white">Jumlah Surat Terverifikasi</p>
                <p class="text-2xl font-bold text-white">{{ $totalSuratDiterima }}</p>
            </div>
        </a>

        <a href="#" class="bg-[#0c3252] rounded-2xl shadow-md hover:shadow-lg transition p-5 flex items-center space-x-4">
            <img src="{{ asset('assets/img/icon/surat_ditolak.png') }}" alt="Ditolak" class="w-12 h-12">
            <div>
                <p class="text-base font-medium text-white">Jumlah Surat Ditolak</p>
                <p class="text-2xl font-bold text-white">{{ $totalSuratDitolak }}</p>
            </div>
        </a>

        <a href="#" class="bg-[#0c3252] rounded-2xl shadow-md hover:shadow-lg transition p-5 flex items-center space-x-4">
            <img src="{{ asset('assets/img/icon/draf.png') }}" alt="Draft" class="w-12 h-12">
            <div>
                <p class="text-base font-medium text-white">Surat Terkirim</p>
                <p class="text-2xl font-bold text-white">0</p>
            </div>
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 p-2">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 my-4">
			<div class="lg:col-span-12 bg-white rounded-lg shadow p-6 h-60">
				<h5 class="text-lg font-semibold mb-2">Tren Permohonan per Bulan</h5>
				<div class="h-40">
					<canvas id="lineChart" class="w-full h-full"></canvas>
				</div>
			</div>
		</div>
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 my-4">
			<div class="lg:col-span-12 bg-white rounded-lg shadow p-6 h-60">
				<h5 class="text-lg font-semibold mb-2">Frekuensi Pengujian Alat Tera</h5>
				<div class="h-40">
					<canvas id="donutChart" class="w-full h-full"></canvas>
				</div>
			</div>
		</div>
	</div>
    
    <div class="grid grid-cols-3 md:grid-cols-3 gap-6">
        <div class="bg-white rounded-2xl shadow-md p-6">
            <h2 class="text-lg font-semibold text-black mb-4">Daftar Permohonan Terbaru</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm text-left">
                    <thead class="bg-blue-300 text-black">
                        <tr>
                            <th class="text-center py-2 px-4">ID</th>
                            <th class="text-center py-2 px-4">Nama Pemohon</th>
                            <th class="text-center py-2 px-4">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($suratTerbaru as $surat)
                            <tr class="border-b">
                                <td class="text-center py-2 px-4">{{ $surat->id_surat}}</td>
                                <td class="text-center py-2 px-4">{{ $surat->user->nama }}</td>
                                <td class="text-center py-2 px-4">{{ $surat->status }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="rounded-2xl p-1">
			<div class="flex flex-col gap-4 items-center">
				<div class="flex flex-col items-center justify-center gap-2 bg-white text-black px-5 py-2 rounded-lg shadow border border-gray-200 w-full">
					<p class="text-lg font-semibold">Surat Belum Terverifikasi</p>
					<p class="text-3xl font-semibold">{{ $totalSuratMenunggu }}</p>
					<a href="{{ route('persuratan-metrologi') }}" class="bg-[#0c3252] flex p-1 gap-2 items-center justify-center text-white text-sm px-py rounded-lg shadow border border-gray-200 w-1/2	">
						Tinjau Sekarang
					</a>
					
				</div>
				<div class="flex flex-col items-center gap-3 bg-white p-4 rounded-xl shadow-[0_4px_20px_rgba(0,96,255,0.15)]">
					<h1 class="text-center font-bold text-lg mb-4">Jumlah Permohonan per Status</h1>

					<canvas id="statusChart"></canvas>
					
					<div class="legend">
						<span style="color: yellow;">&#11044;</span> Disetujui
						<span style="color: purple;">&#11044;</span> Ditolak
						<span style="color: pink;">&#11044;</span> Menunggu
					</div>
				</div>
			</div>
        </div>
		<div class="bg-white rounded-2xl shadow-md p-6">
			<div><p>kotak 3</p></div>
		</div>
    </div>
</div>

<script>
    // Line Chart
    const dataTera = {!! $dataTera !!};
    const dataTeraUlang = {!! $dataTeraUlang !!};

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
					display: false
				}
			},
        },
    });

    // Donut Chart
    new Chart(document.getElementById('donutChart').getContext('2d'), {
        type: 'doughnut',
        data: {
            labels: ['Balai Ukur Satuan', 'Alat Tera', 'Alat Tera Bantu'],
            datasets: [{
                data: [30, 50, 20],
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
                    position: 'left',
                    labels: {
                        color: '#111827',
                        font: {
                            size: 14,
                            weight: 'bold'
                        },
                        padding: 15
                    }
                },
            },
        }
    });

    // Pie Chart
    new Chart(document.getElementById('statusChart').getContext('2d'), {
		type: 'pie', // Jenis chart pie
		data: {
			labels: ['Disetujui', 'Ditolak', 'Menunggu'],
			datasets: [{
				data: [{{ $totalSuratDiterima }}, {{ $totalSuratDitolak }}, {{ $totalSuratMenunggu }}],
				backgroundColor: ['purple', 'yellow', 'pink'],
			}]
		},
		options: {
			responsive: true,
			plugins: {
				legend: {
					display: false
				}
			}
		}
	});

    // Bar Chart
    new Chart(document.getElementById('barChart'), {
        type: 'bar',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei'],
            datasets: [
                {
                    label: '2024',
                    data: [30, 40, 35, 25, 30],
                    backgroundColor: 'orange'
                },
                {
                    label: '2025',
                    data: [25, 30, 28, 20, 26],
                    backgroundColor: 'cornflowerblue'
                }
            ]
        }
    });
</script>
@endsection
