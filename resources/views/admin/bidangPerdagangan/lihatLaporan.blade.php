@extends('layouts.admin')
@section('title', 'Lihat Laporan Distribusi Barang')

@section('content')
<div class="relative w-full">
    <img src="{{ asset('assets/img/background/admin_perdagangan.png') }}" alt="Port Background" class="object-cover w-full h-full">
    <div class="absolute bottom-0 -left-4 w-full h-60 -z-10">
        <img src="{{ asset('assets/img/background/admin_perdagangan.png') }}" alt="Background" class="object-cover w-full h-full -ml-16">
    </div>
</div>
<div class="container mx-auto px-4">
    <h2 class="text-center text-2xl font-bold mb-4 uppercase tracking-wide text-[#083358]">LAPORAN PENYALURAN PUPUK BERSUBSIDI</h2>

    <div class="grid md:grid-cols-2 gap-6 mb-8">
        <!-- Kiri: Pie Chart -->
        <div class="bg-white rounded-lg shadow p-4 flex flex-col items-center">
            <h3 class="text-lg font-semibold mb-4">Per/pupuk</h3>
            <div class="flex gap-2 mb-4">
                <button class="bg-blue-100 hover:bg-blue-200 text-blue-900 font-semibold px-4 py-1 rounded-full">UREA</button>
                <button class="bg-blue-100 hover:bg-blue-200 text-blue-900 font-semibold px-4 py-1 rounded-full">NPK</button>
                <button class="bg-blue-100 hover:bg-blue-200 text-blue-900 font-semibold px-4 py-1 rounded-full">NPK FK</button>
            </div>
            
            <div class="relative w-full h-64"> 
                <canvas id="pieChart" class="absolute top-0 left-0 w-full h-full"></canvas>
            </div>

            <div id="pieLegend" class="mt-4 text-sm flex flex-wrap gap-6 justify-center"></div>
        </div>

        <!-- Kanan: Line Chart -->
        <div class="bg-white rounded-xl shadow p-4">
            <h3 class="text-lg font-semibold mb-4 text-center">Grafik Penyaluran</h3>
            <canvas id="lineChart" class="w-full h-[250px]"></canvas>
        </div>
    </div>

    <div class="flex justify-end items-center gap-3 mb-4">
        <div class="relative">
            <select id="bulan" class="appearance-none bg-[#083358] border border-gray-300 text-sm text-white rounded-full py-1 pl-3 pr-8 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-300">
                <option>Januari</option>
                <option>Februari</option>
                <option>Maret</option>
                <option>April</option>
                <option>Mei</option>
                <option>Juni</option>
                <option>Juli</option>
                <option>Agustus</option>
                <option>September</option>
                <option>Oktober</option>
                <option>November</option>
                <option>Desember</option>
            </select>
            <div class="pointer-events-none absolute inset-y-0 right-2 flex items-center text-white">▼</div>
        </div>

        <div class="relative">
            <select id="tahun" class="appearance-none bg-[#083358] text-white border-gray-300 text-sm rounded-full py-1 pl-3 pr-8 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-300">
                @for ($year = now()->year; $year >= 2020; $year--)
                    <option>{{ $year }}</option>
                @endfor
            </select>
            <div class="pointer-events-none absolute inset-y-0 right-2 flex items-center text-white">▼</div>
        </div>
    </div>

    <div class="overflow-x-auto shadow rounded-xl border border-gray-200">
        <table class="min-w-full text-sm text-center">
            <thead class="bg-[#083358] text-xs text-white">
                <tr>
                    <th rowspan="2" class="border px-2 py-1 align-middle">TOKO</th>
                    <th colspan="3" class="border">STOK AWAL</th>
                    <th colspan="3" class="border">DISTRIBUSI</th>
                    <th colspan="3" class="border">STOK AKHIR</th>
                </tr>
                <tr>
                    <th class="border">UREA</th>
                    <th class="border">NPK</th>
                    <th class="border">NPK FK</th>
                    <th class="border">UREA</th>
                    <th class="border">NPK</th>
                    <th class="border">NPK FK</th>
                    <th class="border">UREA</th>
                    <th class="border">NPK</th>
                    <th class="border">NPK FK</th>
                </tr>
            </thead>
            <tbody class="bg-white text-xs">
                <tr>
                    <td class="border px-2 py-1">ADEVA TANI</td>
                    <td class="border">10</td><td class="border">15</td><td class="border">5</td>
                    <td class="border">8</td><td class="border">12</td><td class="border">3</td>
                    <td class="border">2</td><td class="border">3</td><td class="border">2</td>
                </tr>
                <tr>
                    <td class="border px-2 py-1">Ucang Tani</td>
                    <td class="border">20</td><td class="border">25</td><td class="border">10</td>
                    <td class="border">15</td><td class="border">20</td><td class="border">5</td>
                    <td class="border">5</td><td class="border">5</td><td class="border">5</td>
                </tr>
                <tr>
                    <td class="border px-2 py-1">Peti Tani</td>
                    <td class="border">12</td><td class="border">18</td><td class="border">6</td>
                    <td class="border">9</td><td class="border">15</td><td class="border">4</td>
                    <td class="border">3</td><td class="border">3</td><td class="border">2</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<!-- Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const pieColors = ['#3B82F6', '#F59E0B', '#10B981', '#EF4444'];
    const pieLabels = ['1st Qtr', '2nd Qtr', '3rd Qtr', '4th Qtr'];

    // Pie Chart
    const pieChart = new Chart(document.getElementById('pieChart'), {
        type: 'pie',
        data: {
            labels: pieLabels,
            datasets: [{
                data: [25, 35, 20, 20],
                backgroundColor: pieColors
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false, 
            plugins: {
                legend: {
                    display: true,
                    position: 'bottom'
                }
            }
        }
    });

    // Custom legend
    const legendContainer = document.getElementById('pieLegend');
    pieLabels.forEach((label, i) => {
        const legendItem = document.createElement('div');
        legendItem.className = 'flex items-center gap-2';
        legendItem.innerHTML = `<span class="w-3 h-3 rounded-full inline-block" style="background-color:${pieColors[i]}"></span><span>${label}</span>`;
        legendContainer.appendChild(legendItem);
    });

    // Line Chart
    const lineChart = new Chart(document.getElementById('lineChart'), {
        type: 'line',
        data: {
            labels: ['Category 1', 'Category 2', 'Category 3', 'Category 4'],
            datasets: [
                {
                    label: 'Series 1',
                    data: [4, 6, 7, 9],
                    borderColor: '#3B82F6',
                    fill: false,
                    tension: 0.4
                },
                {
                    label: 'Series 2',
                    data: [3, 5, 8, 6],
                    borderColor: '#F59E0B',
                    fill: false,
                    tension: 0.4
                },
                {
                    label: 'Series 3',
                    data: [2, 4, 5, 7],
                    borderColor: '#10B981',
                    fill: false,
                    tension: 0.4
                }
            ]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                tooltip: {
                    mode: 'index',
                    intersect: false,
                }
            },
            scales: {
                x: {
                    beginAtZero: true
                },
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
@endsection
