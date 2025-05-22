@extends('layouts.admin')
@section('title', 'Distribusi Pupuk Bersubsidi')

@section('content')
<div class="p-6 bg-white">
    <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">

        {{-- KIRI: Info dan Tabel --}}
        <div class="space-y-6">

            {{-- Total Toko dan Harga Pupuk --}}
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                {{-- Jumlah Toko --}}
                <div class="flex flex-col justify-between h-32 p-4 bg-white shadow rounded-xl">
                    <p class="text-base font-semibold text-black">Jumlah Toko</p>
                    <h1 class="text-3xl font-extrabold text-black">{{ $jumlahToko }}</h1>
                    <p class="text-sm text-gray-500">Total toko</p>
                </div>

                {{-- Harga Pupuk --}}
                <div class="flex flex-col justify-between h-32 p-4 bg-white shadow rounded-xl">
                    <h2 class="text-base font-semibold text-black">Harga Pupuk</h2>
                    <div class="space-y-1 text-sm">
                        <div class="flex justify-between">
                            <span class="w-20">UREA</span>
                            <span class="font-semibold">Rp. 300.000</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="w-20">NPK</span>
                            <span class="font-semibold">Rp. 300.000</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="w-20">NPK-FK</span>
                            <span class="font-semibold">Rp. 300.000</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Tabel Distribusi --}}
            <div class="p-4 overflow-x-auto bg-white shadow rounded-xl">
                <h2 class="mb-4 text-lg font-medium">Distribusi Pupuk</h2>
                <table class="w-full overflow-hidden border border-collapse border-gray-300 rounded-t-lg shadow-md table-auto">
                    <thead class="bg-[#083458] text-base">
                        <tr>
                            <th class="p-3 text-center text-white border-r border-gray-300" rowspan="2">Nama Usaha</th>
                            <th class="p-3 text-center text-white border-r border-gray-300" rowspan="2">No. Register</th>
                            <th colspan="3" class="p-3 text-center text-white border-r border-gray-300">Jumlah Distribusi</th>
                        </tr>
                        <tr>
                            <th class="p-3 text-center text-white border-r border-gray-300">UREA</th>
                            <th class="p-3 text-center text-white border-r border-gray-300">NPK</th>
                            <th class="p-3 text-center text-white">NPK-FK</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $namaToko => $barangList)
                            @php
                                $no_register = $barangList->first()->no_register;
                                $urea = $barangList->firstWhere('nama_barang', 'UREA')->total_penyaluran ?? 0;
                                $npk = $barangList->firstWhere('nama_barang', 'NPK')->total_penyaluran ?? 0;
                                $npk_fk = $barangList->firstWhere('nama_barang', 'NPK-FK')->total_penyaluran ?? 0;
                            @endphp
                            <tr class="border-t hover:bg-gray-100">
                                <td class="p-2">{{ $namaToko }}</td>
                                <td class="p-2">{{ $no_register }}</td>
                                <td class="p-2 text-center">{{ $urea }}</td>
                                <td class="p-2 text-center">{{ $npk }}</td>
                                <td class="p-2 text-center">{{ $npk_fk }}</td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>

        </div>

        {{-- KANAN: Analisa dan Grafik --}}
        <div class="space-y-6">

            {{-- Analisa Pupuk --}}
            <div class="p-4 space-y-4 rounded-xl">

                {{-- Header Analisa --}}dis
                <div class="bg-[#083458] text-white px-4 py-2 rounded-md flex justify-between items-center">
                    <span class="font-semibold">Analisa Pupuk</span>
                </div>

                {{-- Filter Section --}}
                <div class="relative p-4 space-y-3 bg-white shadow-md rounded-xl">
                    <div class="flex items-center gap-1 font-semibold text-gray-800">
                        <span class="text-base material-symbols-outlined">tune</span>
                        <span>Filter</span>
                    </div>

                    <div class="flex gap-3">
                        <div class="relative w-full">
                            <div onclick="toggleDropdown()" class="flex items-center justify-between bg-[#CDE4F7] text-black px-4 py-2 rounded-lg w-full cursor-pointer hover:bg-[#b9daf2] transition-all duration-200">
                                <span id="selected-kecamatan">Soreang</span>
                                <span class="text-sm text-gray-700 material-symbols-outlined">tune</span>
                            </div>
                            <div id="dropdown-kecamatan" class="absolute left-0 z-20 hidden w-full mt-2 overflow-hidden bg-white border border-gray-200 shadow-lg top-full rounded-xl">
                                <div class="px-4 py-2 text-gray-700 cursor-pointer hover:bg-blue-100" onclick="selectKecamatan('Soreang')">Soreang</div>
                                <div class="px-4 py-2 text-gray-700 cursor-pointer hover:bg-blue-100" onclick="selectKecamatan('Bacukiki')">Bacukiki</div>
                                <div class="px-4 py-2 text-gray-700 cursor-pointer hover:bg-blue-100" onclick="selectKecamatan('Bacukiki Barat')">Bacukiki Barat</div>
                                <div class="px-4 py-2 text-gray-700 cursor-pointer hover:bg-blue-100" onclick="selectKecamatan('Ujung')">Ujung</div>
                            </div>
                        </div>

                        <div class="flex items-center justify-between bg-[#CDE4F7] text-gray-400 px-4 py-2 rounded-lg w-full cursor-pointer hover:bg-[#b9daf2] transition-all duration-200">
                            <span>filter lainnya</span>
                            <span class="text-sm material-symbols-outlined">tune</span>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        <div class="flex justify-between items-center bg-[#CDE4F7] px-4 py-2 rounded-full text-black font-medium">
                            <span>UREA</span>
                            <span>2.666</span>
                        </div>
                        <div class="flex justify-between items-center bg-[#CDE4F7] px-4 py-2 rounded-full text-black font-medium">
                            <span>NPK-FK</span>
                            <span>2.666</span>
                        </div>
                        <div class="col-span-2 flex justify-between items-center bg-[#CDE4F7] px-4 py-2 rounded-full text-black font-medium">
                            <span>NPK</span>
                            <span>5.666</span>
                        </div>
                    </div>
                </div>
    
                <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                    {{-- Jumlah Pupuk Terdistribusi --}}
                    <div class="flex flex-col justify-start p-4 bg-white shadow rounded-xl h-46">
                        <p class="mb-1 text-lg font-medium text-black">Jumlah Pupuk Terdistribusi</p>
                        <h2 class="text-4xl font-bold text-[#083458] text-center mt-6">{{ number_format($totalDistribusi) }}</h2>
                        <p class="text-2xl font-bold text-[#083458] text-center mt-2">Jumlah pupuk</p>
                    </div>

                    {{-- Informasi Tambahan --}}
                    <div class="p-4 space-y-2 bg-white shadow rounded-xl">
                        <h2 class="mb-1 text-lg font-medium text-black">Informasi Tambahan</h2>
                        <canvas id="pieChart" height="180"></canvas>
                    </div>
                </div>
            </div>

            <div class="p-4 bg-white shadow rounded-xl">
                <p class="mb-2 text-lg font-semibold">Grafik Perkembangan Pupuk</p>
                <canvas id="lineChart" height="150"></canvas>
            </div>

        </div>
    </div>
</div>

<script>
    function toggleDropdown() {
        const dropdown = document.getElementById('dropdown-kecamatan');
        dropdown.classList.toggle('hidden');
    }

    function selectKecamatan(kecamatan) {
        document.getElementById('selected-kecamatan').textContent = kecamatan;
        toggleDropdown();
    }

    document.addEventListener('click', function (e) {
        const dropdown = document.getElementById('dropdown-kecamatan');
        const trigger = document.querySelector('[onclick="toggleDropdown()"]');
        if (!dropdown.contains(e.target) && !trigger.contains(e.target)) {
            dropdown.classList.add('hidden');
        }
    });

    Chart.register(ChartDataLabels);

    // Data untuk pie chart
    const pieLabels = @json($dataPupuk->keys());
    const pieData = @json($dataPupuk->values());

    const pieCtx = document.getElementById('pieChart').getContext('2d');

    new Chart(pieCtx, {
        type: 'doughnut',
        data: {
            labels: pieLabels,
            datasets: [{
                data: pieData,
                backgroundColor: [
                    '#FF6384', '#36A2EB', '#FFCE56',
                    '#4BC0C0', '#9966FF', '#FF9F40', '#E7E9ED'
                ],
                borderWidth: 4,
                hoverOffset: 10,
            }]
        },
        options: {
            plugins: {
                datalabels: {
                    color: '#000',
                    font: { weight: 'bold', size: 16 },
                    formatter: (value, context) => {
                        const total = context.chart.data.datasets[0].data
                            .map(x => Number(x))
                            .reduce((a, b) => a + b, 0);
                        const val = Number(value);
                        const percentage = ((val / total) * 100).toFixed(1) + '%';
                        return percentage;
                    }
                },
                legend: {
                    position: 'bottom',
                    labels: {
                        color: '#333',
                        font: { size: 16 }
                    }
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            const value = context.raw;
                            const total = context.dataset.data.reduce((a, b) => a + b, 0);
                            const percentage = (value / total * 100).toFixed(1);
                            return `${context.label}: ${value} (${percentage}%)`;
                        }
                    }
                }
            }
        },
        plugins: [ChartDataLabels]
    });

    // Data untuk line chart
    const lineLabels = @json($labels);
    const lineDatasets = @json($datasets);

    const lineCtx = document.getElementById('lineChart').getContext('2d');

    new Chart(lineCtx, {
        type: 'line',
        data: {
            labels: lineLabels,
            datasets: lineDatasets
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom',
                },
                tooltip: {
                    mode: 'index',
                    intersect: false,
                }
            },
            interaction: {
                mode: 'nearest',
                axis: 'x',
                intersect: false
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

</script>

@endsection