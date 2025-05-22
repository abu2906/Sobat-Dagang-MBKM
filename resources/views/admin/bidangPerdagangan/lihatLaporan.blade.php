@extends('layouts.admin')
@section('title', 'Lihat Laporan Distribusi Barang')

@section('content')
<div class="w-full h-36">
    <img src="{{ asset('assets/img/background/dagang.jpg') }}"
        alt="Background" class="object-cover w-full h-full">
</div>
<div class="container px-4 mx-auto">
    <h2 class="mt-6 text-center text-2xl font-bold mb-6 uppercase tracking-wide text-[#083358]">LAPORAN PENYALURAN PUPUK BERSUBSIDI</h2>
    <form id="filterForm" method="GET" action="{{ route('lihat.laporan.distribusi') }}">
        <div class="flex items-center justify-end gap-3 mb-4">

            {{-- Dropdown Bulan --}}
            <div class="relative">
                <select id="bulan" name="bulan" class="appearance-none bg-[#083358] border text-center border text-center-gray-300 text-sm text-white rounded-full py-1 pl-3 pr-8 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-300">
                    <option value="">Pilih Bulan</option>
                    @foreach ([1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
                            5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
                            9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'] as $num => $name)
                        <option value="{{ $num }}" {{ request('bulan') == $num ? 'selected' : '' }}>
                            {{ $name }}
                        </option>
                    @endforeach
                </select>
                <div class="absolute inset-y-0 flex items-center text-white pointer-events-none right-2">▼</div>
            </div>

            {{-- Dropdown Tahun --}}
            <div class="relative">
                <select id="tahun" name="tahun" class="appearance-none bg-[#083358] text-white border text-center border text-center-gray-300 text-sm rounded-full py-1 pl-3 pr-8 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-300">
                    <option value="">Pilih Tahun</option>
                    @for ($year = now()->year; $year >= 2020; $year--)
                        <option value="{{ $year }}" {{ request('tahun') == $year ? 'selected' : '' }}>
                            {{ $year }}
                        </option>
                    @endfor
                </select>
                <div class="absolute inset-y-0 flex items-center text-white pointer-events-none right-2">▼</div>
            </div>
        </div>
    </form>
    <div class="grid gap-6 mb-8 md:grid-cols-2">
        <!-- Kiri: Pie Chart -->
        <div class="flex flex-col items-center p-4 bg-white rounded-lg shadow">
            <h3 class="mb-4 text-lg font-semibold">Penyaluran Pupuk</h3>
            <div class="flex gap-2 mb-4">
                @foreach(array_keys($pieData) as $label)
                    <button class="px-4 py-1 font-semibold text-blue-900 bg-blue-100 rounded-full hover:bg-blue-200">{{ $label }}</button>
                @endforeach
            </div>
            
            <div class="relative w-full h-64"> 
                <canvas id="pieChart" class="absolute top-0 left-0 w-full h-full"></canvas>
            </div>

            <div id="pieLegend" class="flex flex-wrap justify-center gap-6 mt-4 text-sm"></div>
        </div>

        <!-- Kanan: Line Chart -->
        <div class="p-4 bg-white shadow rounded-xl">
            <h3 class="mb-4 text-lg font-semibold text-center">Grafik Penyaluran</h3>
            <canvas id="lineChart" class="w-full h-[250px]"></canvas>
        </div>
    </div>
    {{-- Tabel Laporan --}}
    @if (!empty($data))
    <div class="px-4 py-2 mt-4 mb-6 overflow-x-auto text-center border shadow text-center-gray-200 rounded-2xl">
        <h3 class="mb-4 text-lg font-semibold">Detail Laporan
            
        </h3>
        <table class="min-w-full border table-auto text-center-collapse rounded-2xl">
            <thead>
                <tr>
                    <th rowspan="2" class="px-6 py-3 text-center text-sm font-medium text-white bg-[#083458] border text-center-2 border text-center-[#889EAF]">TOKO</th>
                    <th colspan="3" class="px-6 py-3 text-center text-sm font-medium text-white bg-[#083458] border text-center-2 border text-center-[#889EAF]">STOK AWAL</th>
                    <th colspan="3" class="px-6 py-3 text-center text-sm font-medium text-white bg-[#083458] border text-center-2 border text-center-[#889EAF]">PENYALURAN</th>
                    <th colspan="3" class="px-6 py-3 text-center text-sm font-medium text-white bg-[#083458] border text-center-2 border text-center-[#889EAF]">STOK AKHIR</th>
                </tr>
                <tr>
                    <th class="px-6 py-3 text-center text-sm font-medium text-white bg-[#083458] border text-center-2 border text-center-[#889EAF]">UREA</th>
                    <th class="px-6 py-3 text-center text-sm font-medium text-white bg-[#083458] border text-center-2 border text-center-[#889EAF]">NPK</th>
                    <th class="px-6 py-3 text-center text-sm font-medium text-white bg-[#083458] border text-center-2 border text-center-[#889EAF]">NPK FK</th>
                    <th class="px-6 py-3 text-center text-sm font-medium text-white bg-[#083458] border text-center-2 border text-center-[#889EAF]">UREA</th>
                    <th class="px-6 py-3 text-center text-sm font-medium text-white bg-[#083458] border text-center-2 border text-center-[#889EAF]">NPK</th>
                    <th class="px-6 py-3 text-center text-sm font-medium text-white bg-[#083458] border text-center-2 border text-center-[#889EAF]">NPK FK</th>
                    <th class="px-6 py-3 text-center text-sm font-medium text-white bg-[#083458] border text-center-2 border text-center-[#889EAF]">UREA</th>
                    <th class="px-6 py-3 text-center text-sm font-medium text-white bg-[#083458] border text-center-2 border text-center-[#889EAF]">NPK</th>
                    <th class="px-6 py-3 text-center text-sm font-medium text-white bg-[#083458] border text-center-2 border text-center-[#889EAF]">NPK FK</th>
                </tr>
            </thead>
            <tbody class="text-xs bg-white">
                @foreach ($data as $toko => $barang)
                    <tr>
                        <td class="px-2 py-1 text-center border">{{ $toko }}</td>

                        {{-- Stok Awal --}}
                        <td class="text-center border">{{ $barang['UREA']['stok_awal'] ?? 0 }}</td>
                        <td class="text-center border ">{{ $barang['NPK']['stok_awal'] ?? 0 }}</td>
                        <td class="text-center border">{{ $barang['NPK-FK']['stok_awal'] ?? 0 }}</td>

                        {{-- Distribusi --}}
                        <td class="text-center border">{{ $barang['UREA']['penyaluran'] ?? 0 }}</td>
                        <td class="text-center border">{{ $barang['NPK']['penyaluran'] ?? 0 }}</td>
                        <td class="text-center border">{{ $barang['NPK-FK']['penyaluran'] ?? 0 }}</td>

                        {{-- Stok Akhir --}}
                        <td class="text-center border">{{ $barang['UREA']['stok_akhir'] ?? 0 }}</td>
                        <td class="text-center border">{{ $barang['NPK']['stok_akhir'] ?? 0 }}</td>
                        <td class="text-center border">{{ $barang['NPK-FK']['stok_akhir'] ?? 0 }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
    <div class="px-4 py-2 mt-4 mb-6 overflow-x-auto text-center border shadow text-center-gray-200 rounded-2xl">
        <div class="px-4 py-2 mb-4 text-sm text-center text-white bg-[#083358] rounded-md v">
            Data Belum Tersedia Bulan ini
        </div>
    </div>
    @endif

</div>

<!-- Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const form = document.getElementById('filterForm');
    const bulanSelect = document.getElementById('bulan');
    const tahunSelect = document.getElementById('tahun');

    bulanSelect.addEventListener('change', function() {
        if (this.value !== '') {
            // Reset tahun ke kosong saat bulan dipilih
            tahunSelect.value = '';
        }
        form.submit();
    });

    tahunSelect.addEventListener('change', function() {
        if (this.value !== '') {
            // Reset bulan ke kosong saat tahun dipilih
            bulanSelect.value = '';
        }
        form.submit();
    });
</script>
<script>
    const pieLabels = {!! json_encode(array_keys($pieData)) !!};
    const pieValues = {!! json_encode(array_values($pieData)) !!};
    const pieColors = ['#3B82F6', '#F59E0B', '#10B981', '#EF4444', '#8B5CF6', '#EC4899', '#14B8A6'];

    const pieChart = new Chart(document.getElementById('pieChart'), {
        type: 'pie',
        data: {
            labels: pieLabels,
            datasets: [{
                data: pieValues,
                backgroundColor: pieColors.slice(0, pieLabels.length)
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
        legendItem.innerHTML = `<span class="inline-block w-3 h-3 rounded-full" style="background-color:${pieColors[i]}"></span><span>${label}</span>`;
        legendContainer.appendChild(legendItem);
    });
</script>
@if (!empty($lineChartLabels))
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const lineChartLabels = @json($lineChartLabels);
    const lineChartData = @json($lineChartData);

    const lineChart = new Chart(document.getElementById('lineChart'), {
        type: 'line',
        data: {
            labels: lineChartLabels,
            datasets: [
                {
                    label: 'UREA',
                    data: lineChartData.UREA ?? [],
                    borderColor: '#3B82F6',
                    fill: false,
                    tension: 0.4
                },
                {
                    label: 'NPK',
                    data: lineChartData.NPK ?? [],
                    borderColor: '#F59E0B',
                    fill: false,
                    tension: 0.4
                },
                {
                    label: 'NPK-FK',
                    data: lineChartData["NPK-FK"] ?? [],
                    borderColor: '#10B981',
                    fill: false,
                    tension: 0.4
                }
            ]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { position: 'top' },
                tooltip: { mode: 'index', intersect: false }
            },
            scales: {
                x: { beginAtZero: true },
                y: { beginAtZero: true }
            }
        }
    });
</script>
@endif
@endsection
