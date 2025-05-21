@extends('layouts.admin')
@section('title', 'Distribusi Pupuk Bersubsidi')

@section('content')
<div class="p-6 bg-white">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        {{-- KIRI: Info dan Tabel --}}
        <div class="space-y-6">

            {{-- Total Toko dan Harga Pupuk --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Jumlah Toko --}}
                <div class="bg-white p-4 rounded-xl shadow h-32 flex flex-col justify-between">
                    <p class="text-black font-semibold text-base">Jumlah Toko</p>
                    <h1 class="text-3xl font-extrabold text-black">182</h1>
                    <p class="text-sm text-gray-500">Total toko</p>
                </div>

                {{-- Harga Pupuk --}}
                <div class="bg-white p-4 rounded-xl shadow h-32 flex flex-col justify-between">
                    <h2 class="text-black font-semibold text-base">Toko Penyaluran Terbanyakn</h2>
                    <div class="space-y-1 text-sm">
                        <div class="flex justify-between">
                            <span >Kaka Uceng</span>
                        </div>
                        <div class="flex justify-between">
                            <span >Udang Gacor</span>
                        </div>
                        <div class="flex justify-between">
                            <span >Kepiting Gacor</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Tabel Distribusi --}}
            <div class="bg-white p-4 rounded-xl shadow overflow-x-auto">
                <h2 class="text-lg font-medium mb-4">Distribusi Pupuk</h2>
                <table class="table-auto border-collapse border border-gray-300 w-full rounded-t-lg overflow-hidden shadow-md">
                    <thead class="bg-[#083458] text-base">
                        <tr>
                            <th class="text-white p-3 text-center border-r border-gray-300" rowspan="2">Nama Usaha</th>
                            <th class="text-white p-3 text-center border-r border-gray-300" rowspan="2">No. Register</th>
                            <th colspan="3" class="text-white p-3 text-center border-r border-gray-300">Jumlah Distribusi</th>
                        </tr>
                        <tr>
                            <th class="text-white p-3 text-center border-r border-gray-300">UREA</th>
                            <th class="text-white p-3 text-center border-r border-gray-300">NPK</th>
                            <th class="text-white p-3 text-center">NPK-FK</th>
                        </tr>
                    </thead>
                    <tbody>
                        @for ($i = 1; $i <= 10; $i++)
                        <tr class="border-t hover:bg-gray-100">
                            <td class="p-2">{{ 'UD Sumber Makmur ' . $i }}</td>
                            <td class="p-2">{{ '12010001' . $i }}</td>
                            <td class="p-2 text-center">100</td>
                            <td class="p-2 text-center">100</td>
                            <td class="p-2 text-center">100</td>
                        </tr>
                        @endfor
                    </tbody>
                </table>
            </div>

        </div>

        {{-- KANAN: Analisa dan Grafik --}}
        <div class="space-y-6">

            {{-- Analisa Pupuk --}}
            <div class="p-4 rounded-xl space-y-4">

                <div class="bg-[#083458] text-white px-4 py-2 rounded-md flex justify-between items-center">
                    <span class="font-semibold">Analisa Pupuk</span>
                    {{-- <span class="text-sm cursor-pointer">&#9660;</span> --}}
                </div>

                <div class="bg-white p-4 rounded-xl shadow-md space-y-3 relative">
                    <div class="flex items-center gap-1 font-semibold text-gray-800">
                        <span class="material-symbols-outlined text-base">tune</span>
                        <span>Filter</span>
                    </div>

                    <div class="flex gap-3">
                        <div class="relative w-full">
                            <div onclick="toggleDropdown()" class="flex items-center justify-between bg-[#CDE4F7] text-black px-4 py-2 rounded-lg w-full cursor-pointer hover:bg-[#b9daf2] transition-all duration-200">
                                <span id="selected-kecamatan">Soreang</span>
                                <span class="material-symbols-outlined text-sm text-gray-700">tune</span>
                            </div>
                            <div id="dropdown-kecamatan" class="hidden absolute top-full mt-2 left-0 w-full bg-white rounded-xl shadow-lg z-20 overflow-hidden border border-gray-200">
                                <div class="hover:bg-blue-100 px-4 py-2 cursor-pointer text-gray-700" onclick="selectKecamatan('Soreang')">Soreang</div>
                                <div class="hover:bg-blue-100 px-4 py-2 cursor-pointer text-gray-700" onclick="selectKecamatan('Bacukiki')">Bacukiki</div>
                                <div class="hover:bg-blue-100 px-4 py-2 cursor-pointer text-gray-700" onclick="selectKecamatan('Bacukiki Barat')">Bacukiki Barat</div>
                                <div class="hover:bg-blue-100 px-4 py-2 cursor-pointer text-gray-700" onclick="selectKecamatan('Ujung')">Ujung</div>
                            </div>
                        </div>

                        <div class="flex items-center justify-between bg-[#CDE4F7] text-gray-400 px-4 py-2 rounded-lg w-full cursor-pointer hover:bg-[#b9daf2] transition-all duration-200">
                            <span>filter lainnya</span>
                            <span class="material-symbols-outlined text-sm">tune</span>
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

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    {{-- Jumlah Pupuk Terdistribusi --}}
                    <div class="bg-white rounded-xl shadow h-46 p-4 flex flex-col justify-start">
                        <p class="text-lg text-black font-medium mb-1 text-center">Jumlah Pupuk Terdistribusi</p>
                        <h2 class="text-4xl font-bold text-[#083458] text-center mt-6">11.000</h2>
                        <p class="text-2xl font-bold text-[#083458] text-center mt-2">/Sak</p>
                    </div>

                    {{-- Informasi Tambahan --}}
                    <div class="bg-white p-4 rounded-xl shadow space-y-2">
                        <h2 class="text-lg text-black font-medium mb-1">Informasi Tambahan</h2>
                        <canvas id="pieChart" height="180"></canvas>
                    </div>
                </div>
            </div>

            <div class="bg-white p-4 rounded-xl shadow">
                <p class="text-lg font-semibold mb-2">Grafik Perkembangan Pupuk</p>
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

    new Chart(document.getElementById('pieChart'), {
        type: 'doughnut',
        data: {
            labels: ['NPK', 'UREA', 'NPK-FK'],
            datasets: [{
                data: [5666, 2666, 2666],
                backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56'],
                borderWidth: 2,
                hoverOffset: 8,
            }]
        },
        options: {
            plugins: {
                datalabels: {
                    color: '#fff',
                    font: { weight: 'bold', size: 14 },
                    formatter: (value, context) => {
                        const total = context.chart.data.datasets[0].data.reduce((a, b) => a + b, 0);
                        const percentage = (value / total * 100).toFixed(1) + '%';
                        return percentage;
                    }
                },
                legend: {
                    position: 'bottom',
                    labels: {
                        color: '#333',
                        font: { size: 12 }
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
        }
    });

    new Chart(document.getElementById('lineChart'), {
        type: 'line',
        data: {
            labels: ['2021', '2022', '2023', '2024', '2025'],
            datasets: [
                { label: 'NPK', data: [400, 800, 1200, 1000, 900], borderColor: 'red', tension: 0.3, fill: false },
                { label: 'UREA', data: [300, 500, 700, 800, 900], borderColor: 'blue', tension: 0.3, fill: false },
                { label: 'NPK-FK', data: [600, 400, 300, 500, 700], borderColor: 'orange', tension: 0.3, fill: false }
            ]
        }
    });
</script>

@endsection