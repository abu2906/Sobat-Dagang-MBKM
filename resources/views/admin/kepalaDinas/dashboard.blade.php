@extends('layouts.metrologi.kadis')
@section('title', 'Dashboard Kepala Bidang')
@section('content')

<div class="min-h-screen bg-gray-100 p-4">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
        <div class="bg-white rounded-xl shadow-md p-4 flex items-center space-x-4">
            <img src="{{ asset('assets/img/icon/folder-download.png') }}" class="w-10 h-10">
            <div>
                <p class="text-sm text-gray-500">Jumlah Surat Masuk</p>
                <p class="text-xl font-bold text-blue-600">4</p>
                {{-- <p class="text-xl font-bold text-blue-600">{{ $totalSuratSmuaBidang['totalSuratKeseluruhan'] }}</p> --}}
            </div>
        </div>
        <div class="bg-white rounded-xl shadow-md p-4 flex items-center space-x-4">
            <img src="{{ asset('assets/img/icon/Verif.png') }}" class="w-10 h-10">
            <div>
                <p class="text-sm text-gray-500">Jumlah Surat Terverifikasi</p>
                {{-- <p class="text-xl font-bold text-yellow-500">{{ $totalSuratSmuaBidang['totalSuratTerverifikasiKeseluruhan'] }}</p> --}}
            </div>
        </div>
        <div class="bg-white rounded-xl shadow-md p-4 flex items-center space-x-4">
            <img src="{{ asset('assets/img/icon/surat_ditolak.png') }}" class="w-10 h-10">
            <div>
                <p class="text-sm text-gray-500">Jumlah Surat Ditolak</p>
                {{-- <p class="text-xl font-bold text-green-600">{{ $totalSuratSmuaBidang['totalSuratDitolakKeseluruhan'] }}</p> --}}
            </div>
        </div>
    </div>

    <!-- Grafik Metrologi -->
    <div class="bg-white rounded-xl shadow-md p-4 mb-6">
        <h3 class="text-sm font-semibold text-gray-700 mb-2">Bidang Metrologi</h3>
        <canvas id="chartMetrologi" class="max-w-full max-h-[200px]"></canvas>
        <div class="mt-4 text-right">
            <a href="#" class="mt-auto block w-full bg-[#083458] text-white px-4 py-2 rounded-md text-center text-sm hover:bg-blue-300 hover:text-black">Lihat Detail</a>
        </div>
    </div>

    <!-- Perdagangan dan Industri -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <!-- Bidang Perdagangan -->
        <div class="bg-white rounded-xl shadow-md p-4 flex flex-col h-full">
            <h3 class="text-sm font-semibold text-gray-700 mb-2">Bidang Perdagangan</h3>
                <select id="lokasiSelect" class="border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200">
                        {{-- <option value="Pasar Sumpang" {{ $selectedLokasi == 'Pasar Sumpang' ? 'selected' : '' }}>Pasar Sumpang</option>
                        <option value="Pasar Lakessi" {{ $selectedLokasi == 'Pasar Lakessi' ? 'selected' : '' }}>Pasar Lakessi</option> --}}
                </select>
            <div class="flex flex-col md:flex-row md:space-x-4 space-y-4 md:space-y-0 flex-grow">
                <div class="flex-1 max-w-full max-h-[220px] overflow-hidden">
                    <p class="text-center font-medium text-gray-600 mb-1">Naik</p>
                    <canvas id="chartPerdaganganNaik" class="w-full max-w-full max-h-[200px]"></canvas>
                </div>
                <div class="flex-1 max-w-full max-h-[220px] overflow-hidden">
                    <p class="text-center font-medium text-gray-600 mb-1">Turun</p>
                    <canvas id="chartPerdaganganTurun" class="w-full max-w-full max-h-[200px]"></canvas>
                </div>
            </div>
            <a href="{{route('kepalaDinas.perdagangan')}}" class="mt-auto block w-full bg-[#083458] text-white px-4 py-2 rounded-md text-center text-sm hover:bg-blue-300 hover:text-black">
                Lihat Detail
            </a>
        </div>

        <!-- Bidang Industri -->
        <div class="bg-white rounded-xl shadow-md p-4 flex flex-col h-full">
            <h3 class="text-sm font-semibold text-gray-700 mb-2">Bidang Industri</h3>
            <div class="max-w-full max-h-[220px] overflow-hidden flex-grow">
                <canvas id="chartIndustri" class="w-full max-w-full max-h-[200px]"></canvas>
            </div>
            <a href="#" class="mt-auto block w-full bg-[#083458] text-white px-4 py-2 rounded-md text-center text-sm hover:bg-blue-300 hover:text-black">
                Lihat Detail
            </a>
        </div>
    </div>

</div>

<script>
    // Bidang Perdagangan Naik
    // const naikCtx = document.getElementById('chartPerdaganganNaik');
    // const turunCtx = document.getElementById('chartPerdaganganTurun');

    // if (naikCtx) {
    //     const dataPieNaik = @json($topHargaNaik);
    //     new Chart(naikCtx.getContext('2d'), {
    //         type: 'pie',
    //         data: {
    //             labels: dataPieNaik.map(i => i.label),
    //             datasets: [{
    //                 data: dataPieNaik.map(i => i.price_change),
    //                 backgroundColor: dataPieNaik.map(i => i.color),
    //                 borderColor: '#fff',
    //                 borderWidth: 2
    //             }]
    //         },
    //         options: {
    //             plugins: {
    //                 legend: { position: 'none' },
    //                 datalabels: {
    //                     formatter: (value, context) => {
    //                         const dataset = context.chart.data.datasets[0];
    //                         const total = dataset.data.reduce((a, b) => a + b, 0);
    //                         const percentage = (value / total * 100).toFixed(1);
    //                         return percentage + '%';
    //                     },
    //                     color: '#fff',
    //                     font: { weight: 'bold', size: 12 }
    //                 }
    //             }
    //         },
    //         plugins: [ChartDataLabels]
    //     });
    // }

    // if (turunCtx) {
    //     const dataPieTurun = @json($topHargaTurun);
    //     new Chart(turunCtx.getContext('2d'), {
    //         type: 'pie',
    //         data: {
    //             labels: dataPieTurun.map(i => i.label),
    //             datasets: [{
    //                 data: dataPieTurun.map(i => i.price_change),
    //                 backgroundColor: dataPieTurun.map(i => i.color),
    //                 borderColor: '#fff',
    //                 borderWidth: 2
    //             }]
    //         },
    //         options: {
    //             plugins: {
    //                 legend: { position: 'none' },
    //                 datalabels: {
    //                     formatter: (value, context) => {
    //                         const dataset = context.chart.data.datasets[0];
    //                         const total = dataset.data.reduce((a, b) => a + b, 0);
    //                         const percentage = (value / total * 100).toFixed(1);
    //                         return percentage + '%';
    //                     },
    //                     color: '#fff',
    //                     font: { weight: 'bold', size: 12 }
    //                 }
    //             }
    //         },
    //         plugins: [ChartDataLabels]
    //     });
    // }



    // Bidang Industri (Bar)
    new Chart(document.getElementById('chartIndustri'), {
        type: 'bar',
        data: {
            labels: ['2024', '2025'],
            datasets: [
                {
                    label: 'Masuk',
                    backgroundColor: '#FBBF24',
                    data: [15, 10]
                },
                {
                    label: 'Keluar',
                    backgroundColor: '#3B82F6',
                    data: [10, 14]
                }
            ]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { position: 'top' }
            },
            scales: {
                y: { beginAtZero: true }
            }
        }
    });

    // Bidang Metrologi (Line)
    new Chart(document.getElementById('chartMetrologi'), {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            datasets: [{
                label: 'Metrologi',
                data: [5, 6, 7, 4, 6, 8, 6, 9, 10, 5, 4, 7],
                borderColor: '#3B82F6',
                backgroundColor: 'rgba(59,130,246,0.1)',
                tension: 0.4,
                fill: true
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { position: 'top' }
            },
            scales: {
                y: { beginAtZero: true }
            }
        }
    });
</script>
@endsection
