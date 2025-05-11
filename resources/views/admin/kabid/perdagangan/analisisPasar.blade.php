@extends('layouts.admin')

@section('title', 'Analisis Pasar Bidang Perdagangan')

@section('content')
<div class="p-4 bg-gray-50 min-h-screen space-y-4">
    <div class="flex flex-col lg:flex-row gap-4">
        <!-- KIRI -->
        <div class="w-full lg:w-[67.5%] flex flex-col space-y-4">
            <!-- Dropdown Pasar -->
            <div x-data="{ open: false, selected: 'Pasar Lakessi', options: ['Pasar Lakessi', 'Pasar Sumpang'] }"
                class="relative w-full">
                <button @click="open = !open"
                    class="bg-[#083458] text-white rounded-xl px-6 py-2 w-full flex justify-between items-center flex-1 mt-2">
                    <span x-text="selected" class="font-bold"></span>
                    <svg class="w-5 h-5 transform transition-transform" :class="{ 'rotate-180': open }" fill="white"
                        viewBox="0 0 20 20">
                        <path
                            d="M5.23 7.21a.75.75 0 011.06.02L10 11.19l3.71-3.96a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" />
                    </svg>
                </button>
                <ul x-show="open" @click.away="open = false"
                    class="absolute z-10 bg-white w-full mt-1 rounded-xl shadow-md text-gray-700 overflow-hidden">
                    <template x-for="option in options" :key="option">
                        <li>
                            <button @click="selected = option; open = false"
                                class="w-full text-left px-6 py-2 hover:bg-blue-100" x-text="option"></button>
                        </li>
                    </template>
                </ul>
            </div>

            <!-- Filter -->
            <div class="bg-white rounded-xl shadow p-4 space-y-2">
                <div class="flex items-center space-x-2 font-semibold text-gray-700">
                    <span class="material-symbols-outlined">discover_tune</span>
                    <span>Filter</span>
                </div>
                <div class="flex flex-col md:flex-row items-center gap-4">
                    <!-- Periode -->
                    <div class="flex items-center bg-blue-100 rounded-xl px-4 py-2 w-full md:w-1/2">
                        <label class="mr-2 font-semibold">Periode</label>
                        <input type="date" class="bg-transparent outline-none w-full text-sm" value="2025-04-01">
                    </div>
                    <!-- Sampai -->
                    <div class="flex items-center bg-blue-100 rounded-xl px-4 py-2 w-full md:w-1/2">
                        <label class="mr-2 font-semibold">Sampai</label>
                        <input type="date" class="bg-transparent outline-none w-full text-sm" value="2025-04-01">
                    </div>
                </div>
            </div>

            <!-- Tabel -->
            <div class="bg-white rounded-xl shadow overflow-x-auto flex-grow">
                <table class="min-w-full text-sm text-center">
                    <thead class="bg-[#0B3A6A] text-white">
                        <tr>
                            <th class="px-2 py-2">TANGGAL</th>
                            <th>BERAS</th>
                            <th>CABAI</th>
                            <th>GULA</th>
                            <th>BAWANG</th>
                            <th>DAGING AYAM</th>
                            <th>IKAN</th>
                            <th>MINYAK</th>
                            <th>TELUR</th>
                            <th>TEPUNG</th>
                            <th>DAGING SAPI</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700">
                        @for($i = 0; $i < 7; $i++)
                        <tr class="border-b">
                            <td class="py-1">20-4-2025</td>
                            <td>23.000</td>
                            <td>23.000</td>
                            <td>23.000</td>
                            <td>23.000</td>
                            <td>23.000</td>
                            <td>23.000</td>
                            <td>23.000</td>
                            <td>23.000</td>
                            <td>23.000</td>
                            <td>23.000</td>
                        </tr>
                        @endfor
                    </tbody>
                </table>
            </div>
        </div>

        <!-- KANAN -->
        <div class="w-full lg:w-[30%] flex flex-col space-y-4">
            <!-- Trend Harga Bapok -->
            <div class="bg-white rounded-xl shadow p-4 mb-4">
                <h3 class="font-semibold text-center text-gray-800">Trend Harga Bapok</h3>
                <div class="flex flex-col lg:flex-row items-center">
                    <div class="w-full lg:w-1/2">
                        <canvas id="trendBapokChart"></canvas>
                    </div>
                    <div class="w-full lg:w-1/2 mt-4 lg:mt-0 flex flex-col items-start justify-center px-4">
                        <ul class="text-sm space-y-1">
                            <li><span class="inline-block w-4 h-4 rounded mr-2" style="background-color:#0b294a"></span> Cabai</li>
                            <li><span class="inline-block w-4 h-4 rounded mr-2" style="background-color:#37587c"></span> Daging sapi</li>
                            <li><span class="inline-block w-4 h-4 rounded mr-2" style="background-color:#4e6e8f"></span> Daging ayam</li>
                            <li><span class="inline-block w-4 h-4 rounded mr-2" style="background-color:#6f8ea9"></span> Minyak</li>
                            <li><span class="inline-block w-4 h-4 rounded mr-2" style="background-color:#92aec0"></span> Beras</li>
                            <li><span class="inline-block w-4 h-4 rounded mr-2" style="background-color:#f16b8a"></span> Ikan</li>
                            <li><span class="inline-block w-4 h-4 rounded mr-2" style="background-color:#f27d9c"></span> Bawang</li>
                            <li><span class="inline-block w-4 h-4 rounded mr-2" style="background-color:#f498ac"></span> Telur</li>
                            <li><span class="inline-block w-4 h-4 rounded mr-2" style="background-color:#f8b6c5"></span> Tepung</li>
                            <li><span class="inline-block w-4 h-4 rounded mr-2" style="background-color:#fbd6df"></span> Tomat</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Top Harga -->
            <div class="bg-white rounded-xl shadow p-4 text-sm flex-grow flex flex-col justify-between">
                <div>
                    <div class="mb-2 font-semibold text-gray-700">Top 5 Harga Naik</div>
                    <ul class="text-blue-600 space-y-1">
                        <li>Cabai <span class="float-right">+Rp 5.000</span></li>
                        <li>Daging Sapi <span class="float-right">+Rp 3.000</span></li>
                        <li>Daging Ayam <span class="float-right">+Rp 2.000</span></li>
                        <li>Minyak <span class="float-right">+Rp 1.000</span></li>
                        <li>Beras <span class="float-right">+Rp 500</span></li>
                    </ul>
                </div>
                <div class="mt-4">
                    <div class="mb-2 font-semibold text-gray-700">Top 5 Harga Turun</div>
                    <ul class="text-red-600 space-y-1">
                        <li>Ikan <span class="float-right">-Rp 3.000</span></li>
                        <li>Ikan <span class="float-right">-Rp 3.000</span></li>
                        <li>Bawang <span class="float-right">-Rp 2.000</span></li>
                        <li>Telur <span class="float-right">-Rp 1.000</span></li>
                        <li>Tepung <span class="float-right">-Rp 500</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Grafik Batang -->
    <div class="bg-white rounded-lg shadow p-4">
        <h2 class="text-gray-700 font-semibold mb-4">Perbandingan Harga Kemarin dan Hari Ini</h2>
        <div class="w-full overflow-x-auto">
            <div class="min-w-[1000px] h-25">
                <canvas id="barChart"></canvas>
            </div>
        </div>
    </div>

</div>
<script>
    const ctx = document.getElementById('barChart').getContext('2d');
    const barChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Beras', 'Cabai', 'Gula', 'Bawang', 'Daging Ayam', 'Ikan', 'Minyak', 'Telur', 'Tepung', 'Daging Sapi'],
            datasets: [{
                label: 'Harga Kemarin',
                data: [23000, 24000, 25000, 23000, 22000, 21000, 25000, 21000, 22000, 26000],
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }, {
                label: 'Harga Hari Ini',
                data: [24000, 26000, 24500, 23500, 22500, 20500, 25500, 21500, 22500, 26500],
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    const trendCtx = document.getElementById('trendBapokChart').getContext('2d');
    const trendBapokChart = new Chart(trendCtx, {
        type: 'doughnut',
        data: {
            labels: [
                'Cabai', 'Daging sapi', 'Daging ayam', 'Minyak', 'Beras',
                'Ikan', 'Bawang', 'Telur', 'Tepung', 'Tomat'
            ],
            datasets: [{
                data: [12, 10, 10, 9, 9, 8, 7, 6, 5, 4],
                backgroundColor: [
                    '#0b294a', '#37587c', '#4e6e8f', '#6f8ea9', '#92aec0',
                    '#f16b8a', '#f27d9c', '#f498ac', '#f8b6c5', '#fbd6df'
                ],
                borderWidth: 1,
                borderColor: '#fff'
            }]
        },
        options: {
            cutout: '60%',
            responsive: true,
            plugins: {
                legend: { display: false },
                tooltip: { callbacks: {
                    label: function(context) {
                        return `${context.label}: ${context.raw}`;
                    }
                }}
            }
        }
    });

</script>
@endsection
