@extends('layouts.admin')

@section('title', 'Analisis Pasar Bidang Perdagangan')

@section('content')
<div class="p-4 bg-gray-50 min-h-screen space-y-4">
    <div class="flex flex-col lg:flex-row gap-4">
        <!-- KIRI -->
        <div class="w-full lg:w-[67.5%] flex flex-col space-y-4">
            <!-- Dropdown Pasar -->
            <div x-data="{ open: false, selected: '{{ $selectedLokasi }}', options: @js($lokasiOptions) }" class="relative w-full">
                <form method="GET" action="{{ route('analisis.pasar') }}" x-ref="form">
                    <input type="hidden" name="start_date" :value="document.querySelector('[name=start_date]').value">
                    <input type="hidden" name="end_date" :value="document.querySelector('[name=end_date]').value">
                    <input type="hidden" name="lokasi" :value="selected">

                    <button type="button" @click="open = !open" class="bg-[#083458] text-white rounded-xl px-6 py-2 w-full flex justify-between items-center mt-2">
                        <span x-text="selected" class="font-bold"></span>
                        <svg class="w-5 h-5 transform transition-transform" :class="{ 'rotate-180': open }" fill="white" viewBox="0 0 20 20">
                            <path d="M5.23 7.21a.75.75 0 011.06.02L10 11.19l3.71-3.96a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" />
                        </svg>
                    </button>

                    <ul x-show="open" @click.away="open = false" x-transition class="absolute z-10 bg-white w-full mt-1 rounded-xl shadow-md text-gray-700 overflow-hidden">
                        <template x-for="option in options" :key="option">
                            <li>
                                <button type="button" @click="selected = option; $nextTick(() => $refs.form.submit())" class="w-full text-left px-6 py-2 hover:bg-blue-100" x-text="option"></button>
                            </li>
                        </template>
                    </ul>
                </form>
            </div>

            <!-- Filter -->
            <div class="bg-white rounded-xl shadow p-4 space-y-2">
                <div class="flex items-center space-x-2 font-semibold text-gray-700">
                    <span class="material-symbols-outlined">discover_tune</span>
                    <span>Filter</span>
                </div>
                <form method="GET" action="{{ route('analisis.pasar') }}" class="flex flex-col md:flex-row items-center gap-4">
                    <input type="hidden" name="lokasi" value="{{ $selectedLokasi }}">
                    <div class="flex items-center bg-blue-100 rounded-xl px-4 py-2 w-full md:w-1/2">
                        <label class="mr-2 font-semibold">Periode</label>
                        <input type="date" name="start_date" class="bg-transparent outline-none w-full text-sm" value="{{ $startDate }}" onchange="this.form.submit()">
                    </div>
                    <div class="flex items-center bg-blue-100 rounded-xl px-4 py-2 w-full md:w-1/2">
                        <label class="mr-2 font-semibold">Sampai</label>
                        <input type="date" name="end_date" class="bg-transparent outline-none w-full text-sm" value="{{ $endDate }}" onchange="this.form.submit()">
                    </div>
                </form>
            </div>

            <!-- Tabel -->
            @if ($selectedLokasi == 'Pasar Sumpang')
                <div class="bg-white rounded-xl shadow overflow-x-auto flex-grow scrollbar-hide overflow-scroll" style="max-height: 500px; overflow: auto;">
                    <table class="min-w-full text-sm text-center whitespace-nowrap">
                        <thead class="bg-[#083458] text-white">
                            <tr>
                                <th class="px-4 py-2 sticky top-0 left-0 z-20 bg-[#083458]">TANGGAL</th>
                                @foreach ($barangs as $barang)
                                    <th class="px-4 py-2 sticky top-0 z-10 bg-[#083458]">{{ strtoupper($barang->nama_barang) }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody class="text-gray-700">
                            @foreach ($tanggalList as $tanggal)
                                <tr class="border-b">
                                    <td class="py-2 px-4 sticky left-0 z-10 bg-white">
                                        {{ \Carbon\Carbon::parse($tanggal)->format('d-m-Y') }}
                                    </td>
                                    @foreach ($barangs as $barang)
                                        @php
                                            $harga = $dataHarga[$tanggal][$barang->id_barang] ?? '-';
                                        @endphp
                                        <td class="px-4">{{ is_numeric($harga) ? number_format($harga, 0, ',', '.') : $harga }}</td>
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="bg-white rounded-xl shadow overflow-x-auto flex-grow scrollbar-hide overflow-scroll" style="max-height: 500px; overflow: auto;">
                    <table class="min-w-full text-sm text-center whitespace-nowrap">
                        <thead class="bg-[#083458] text-white">
                            <tr>
                                <th class="px-4 py-2 sticky top-0 left-0 z-20 bg-[#083458]">TANGGAL</th>
                                @foreach ($barangs as $barang)
                                    <th class="px-4 py-2 sticky top-0 z-10 bg-[#083458]">{{ strtoupper($barang->nama_barang) }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody class="text-gray-700">
                            @foreach ($tanggalList as $tanggal)
                                <tr class="border-b">
                                    <td class="py-2 px-4 sticky left-0 z-10 bg-white">
                                        {{ \Carbon\Carbon::parse($tanggal)->format('d-m-Y') }}
                                    </td>
                                    @foreach ($barangs as $barang)
                                        @php
                                            $harga = $dataHarga[$tanggal][$barang->id_barang] ?? '-';
                                        @endphp
                                        <td class="px-4">{{ is_numeric($harga) ? number_format($harga, 0, ',', '.') : $harga }}</td>
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
        
        <!-- KANAN -->
        @if ($selectedLokasi == 'Pasar Sumpang')
            <!-- Pasar Sumpang content -->
            <div class="w-full lg:w-[30%] flex flex-col space-y-4">
                <div class="bg-white rounded-xl shadow p-4 mb-4">
                    <h3 class="font-semibold text-center text-black mb-3">Tren Harga Bahan Pokok</h3>
                    <div class="flex space-x-6">
                        <div class="w-1/2">
                            <canvas id="topHargaPieChart"></canvas>
                        </div>
                        <div class="w-1/2 space-y-1 max-h-48 overflow-y-auto hide-scrollbar">
                            @foreach ($top10HargaTertinggi as $item)
                                <div class="flex items-center text-sm">
                                    <span class="inline-block w-3 h-3 rounded-full mr-2" style="background-color: {{ $item['color'] }}"></span>
                                    <span class="text-gray-800 truncate">{{ $item['label'] }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow p-4 text-sm flex-grow flex flex-col justify-between">
                    <div>
                        <div class="mb-2 font-semibold text-gray-700">Top 5 Harga Naik</div>
                        <ul class="text-blue-600 space-y-1">
                            @foreach ($topHargaNaik as $item)
                                <li>{{ $item['label'] }} (Naik: Rp{{ number_format($item['price_change']) }})</li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="mt-4">
                        <div class="mb-2 font-semibold text-gray-700">Top 5 Harga Turun</div>
                        <ul class="text-red-600 space-y-1">
                            @foreach ($topHargaTurun as $item)
                                <li>{{ $item['label'] }} (Turun: Rp{{ number_format($item['price_change']) }})</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @elseif ($selectedLokasi == 'Pasar Lakessi')
        <div class="w-full lg:w-[30%] flex flex-col space-y-4">
            <div class="bg-white rounded-xl shadow p-4 mb-4">
                <h3 class="font-semibold text-center text-black mb-3">Tren Harga Bahan Pokok</h3>
                <div class="flex space-x-6">
                    <div class="w-1/2">
                        <canvas id="topHargaPieChart"></canvas>
                    </div>
                    <div class="w-1/2 space-y-1 max-h-48 overflow-y-auto hide-scrollbar">
                        @foreach ($top10HargaTertinggi as $item)
                            <div class="flex items-center text-sm">
                                <span class="inline-block w-3 h-3 rounded-full mr-2" style="background-color: {{ $item['color'] }}"></span>
                                <span class="text-gray-800 truncate">{{ $item['label'] }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow p-4 text-sm flex-grow flex flex-col justify-between">
                <div>
                    <div class="mb-2 font-semibold text-gray-700">Top 5 Harga Naik</div>
                    <ul class="text-green-600 space-y-1">
                        @foreach ($topHargaNaik as $item)
                            <li>{{ $item['label'] }} (Naik: Rp{{ number_format($item['price_change']) }})</li>
                        @endforeach
                    </ul>
                </div>
                <div class="mt-4">
                    <div class="mb-2 font-semibold text-gray-700">Top 5 Harga Turun</div>
                    <ul class="text-red-600 space-y-1">
                        @foreach ($topHargaTurun as $item)
                            <li>{{ $item['label'] }} (Turun: Rp{{ number_format($item['price_change']) }})</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>        
        @endif

    </div>

    @if ($selectedLokasi == 'Pasar Sumpang' || $selectedLokasi == 'Pasar Lakessi')
        <div class="bg-white rounded-lg shadow p-4">
            <h2 class="text-gray-700 font-semibold mb-4">Perbandingan Harga Kemarin dan Hari Ini</h2>
            <div class="w-full overflow-x-auto">
                <div class="min-w-[1000px] h-25">
                    <canvas id="barChart"></canvas>
                </div>
            </div>
        </div>
    @endif
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const ctx = document.getElementById('topHargaPieChart');
        if (ctx) {
            const dataPie = @json($top10HargaTertinggi);
            new Chart(ctx.getContext('2d'), {
                type: 'pie',
                data: {
                    labels: dataPie.map(i => i.label),
                    datasets: [{
                        data: dataPie.map(i => i.harga),
                        backgroundColor: dataPie.map(i => i.color),
                        borderColor: '#fff',
                        borderWidth: 2
                    }]
                },
                options: {
                    plugins: {
                        legend: { display: false },
                        datalabels: {
                            color: '#fff',
                            formatter: (value, ctx) => {
                                const total = ctx.chart.data.datasets[0].data.reduce((a, b) => Number(a) + Number(b), 0);
                                return (value / total * 100).toFixed(1) + '%';
                            },
                            font: { weight: 'bold', size: 12 }
                        }
                    }
                },
                plugins: [ChartDataLabels]
            });
        }

        const ctxBar = document.getElementById('barChart');
        if (ctxBar) {
            new Chart(ctxBar.getContext('2d'), {
                type: 'bar',
                data: {
                    labels: @json($barChartData['labels']),
                    datasets: [
                        {
                            label: 'Harga Hari Ini',
                            data: @json($barChartData['today']),
                            backgroundColor: '#3b82f6'
                        },
                        {
                            label: 'Harga Kemarin',
                            data: @json($barChartData['yesterday']),
                            backgroundColor: '#f87171'
                        }
                    ]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: { position: 'top' }
                    },
                    scales: {
                        y: {
                            beginAtZero: false,
                            title: { display: true, text: 'Harga (Rp)' }
                        }
                    }
                }
            });
        }
    });
</script>
@endsection
