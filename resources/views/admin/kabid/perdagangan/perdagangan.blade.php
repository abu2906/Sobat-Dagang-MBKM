@extends('layouts.admin')
@section('title', 'Dashboard Kabid Bidang Perdagangan')
@section('content')

<div class="min-h-screen p-6 bg-white">
    <h1 class="mb-4 text-2xl font-bold text-black">Dashboard Bidang Perdagangan</h1>

    <div class="grid grid-cols-1 gap-4 mb-6 md:grid-cols-3">
        <a href="#" class="flex items-center p-5 space-x-4 transition bg-white shadow-md rounded-2xl hover:shadow-lg">
            <img src="{{ asset('assets/img/icon/folder-download.png') }}" alt="Surat Masuk" class="w-12 h-12">
            <div>
                <p class="text-base font-medium text-black">Jumlah Surat Masuk</p>
                <p class="text-2xl font-bold text-blue-600">{{ $totalSuratPerdagangan }}</p>
            </div>
        </a>

        <a href="#" class="flex items-center p-5 space-x-4 transition bg-white shadow-md rounded-2xl hover:shadow-lg">
            <img src="{{ asset('assets/img/icon/Verif.png') }}" alt="Terverifikasi" class="w-12 h-12">
            <div>
                <p class="text-base font-medium text-black">Jumlah Surat Terverifikasi</p>
                <p class="text-2xl font-bold text-yellow-500">{{ $totalSuratTerverifikasi }}</p>
            </div>
        </a>

        <a href="#" class="flex items-center p-5 space-x-4 transition bg-white shadow-md rounded-2xl hover:shadow-lg">
            <img src="{{ asset('assets/img/icon/surat_ditolak.png') }}" alt="Ditolak" class="w-12 h-12">
            <div>
                <p class="text-base font-medium text-black">Jumlah Surat Ditolak</p>
                <p class="text-2xl font-bold text-green-600">{{ $totalSuratDitolak }}</p>
            </div>
        </a>
    </div>

    <div class="p-4 mb-6 bg-white shadow rounded-xl">
        @if ($errors->any())
        <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 border border-red-200 rounded-lg">
            <strong>Terjadi kesalahan:</strong>
            <ul class="mt-1 ml-4 list-disc list-inside">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <div class="relative overflow-y-auto scrollbar-hide max-h-[600px]">
            <table class="w-full text-sm text-left text-gray-700">
                <thead class="bg-[#083358] text-white font-semibold sticky top-0 z-10">
                    <tr>
                        <th class="px-4 py-2 text-center rounded-l">No</th>
                        <th class="px-4 py-2 text-center">Nama Pemohon</th>
                        <th class="px-4 py-2 text-center">Tanggal Dikirim</th>
                        <th class="px-4 py-2 text-center">Status</th>
                        <th class="px-4 py-2 text-center">Jenis Surat</th>
                        <th class="px-4 py-2 text-center">Dokumen Surat</th>
                        <th class="px-4 py-2 text-center rounded-r">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    @foreach($suratMasuk as $index => $surat)
                    @if($surat->file_balasan)
                    <tr class="border-b">
                        <td class="px-4 py-2 text-center rounded-l">{{ $index + 1 }}</td>
                        <td class="px-4 py-2 text-center">{{ $surat->user->nama ?? 'Tidak Diketahui' }}</td>
                        <td class="px-4 py-2 text-center">{{ $surat->tgl_pengajuan }}</td>
                        <td class="px-4 py-2 text-center">
                            @if($surat->status == 'menunggu')
                            <span class="px-2 py-1 text-xs font-semibold text-yellow-800 bg-yellow-300 rounded-full">Menunggu</span>
                            @elseif($surat->status == 'diterima')
                            <span class="px-2 py-1 text-xs font-semibold text-green-800 bg-green-300 rounded-full">Diterima</span>
                            @elseif($surat->status == 'ditolak')
                            <span class="px-2 py-1 text-xs font-semibold text-red-800 bg-red-300 rounded-full">Ditolak</span>
                            @endif
                        </td>
                        @php
                        $jenisSuratMap = [
                        'surat_rekomendasi_perdagangan' => 'Surat Rekomendasi',
                        'surat_keterangan_perdagangan' => 'Surat Keterangan',
                        'dan_lainnya_perdagangan' => 'Surat Lainnya',
                        ];
                        @endphp
                        <td class="px-4 py-2 text-center">{{ $jenisSuratMap[$surat->jenis_surat] ?? 'Tidak tersedia' }}</td>
                        <td class="px-4 py-2 text-center">
                            <a href="{{ asset('storage/' . $surat->file_balasan) }}" target="_blank" class="text-blue-600 underline">Lihat Balasan</a>
                        </td>
                        <td class="px-4 py-2 text-center">
                            @if ($surat->status !== 'menunggu')
                            <button class="px-3 py-1 text-white bg-gray-400 rounded cursor-not-allowed" disabled>✓</button>
                            @else
                            <form action="{{ route('suratPerdagangan.setujui', $surat->id_permohonan) }}" method="POST" class="inline">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="px-3 py-1 text-white bg-green-500 rounded hover:bg-green-600">Setujui</button>
                            </form>
                            @endif
                        </td>
                </tr>
                    @endif
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>

    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
        <!-- Pie Chart -->
        <div class="flex flex-col p-4 bg-white shadow rounded-xl">
            <h2 class="mb-2 text-lg font-semibold">Jumlah Permohonan per Status</h2>
            <div class="w-full h-64">
                <canvas id="statusPie" class="w-full h-full"></canvas>
            </div>
        </div>

        <!-- Line Chart -->
        <div class="flex flex-col p-4 bg-white shadow rounded-xl">
            <div class="flex items-center justify-between mb-2">
                <h2 class="text-lg font-semibold">Grafik Perkembangan Surat Masuk</h2>
                <select id="filterTahun" class="px-2 py-1 border rounded">
                    @for ($year = now()->year; $year >= 2020; $year--)
                    <option value="{{ $year }}">{{ $year }}</option>
                    @endfor
                </select>
            </div>
            <div class="w-full h-64">
                <canvas id="suratChart" class="w-full h-full"></canvas>
            </div>
        </div>
    </div>

</div>

<script>
    const statusPieCtx = document.getElementById('statusPie').getContext('2d');
    const suratChartCtx = document.getElementById('suratChart').getContext('2d');

    let statusPie, suratChart;

    function renderCharts(statusCounts, dataBulanan) {
        if (statusPie) statusPie.destroy();
        if (suratChart) suratChart.destroy();

        statusPie = new Chart(statusPieCtx, {
            type: 'doughnut',
            data: {
                labels: ['Disetujui', 'Ditolak', 'Menunggu'],
                datasets: [{
                    data: [statusCounts.diterima, statusCounts.ditolak, statusCounts.menunggu],
                    backgroundColor: ['#10b981', '#ef4444', '#facc15'],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });

        suratChart = new Chart(suratChartCtx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                datasets: [{
                    label: 'Surat Masuk',
                    data: dataBulanan,
                    backgroundColor: 'rgba(59, 130, 246, 0.2)',
                    borderColor: '#3b82f6',
                    borderWidth: 2,
                    tension: 0.4,
                    fill: true,
                    pointRadius: 4,
                    pointHoverRadius: 6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });
    }

    // Render awal dari Blade
    renderCharts(@json($statusCounts), @json($dataBulanan));

    // Handler ketika tahun diubah
    document.getElementById('filterTahun').addEventListener('change', function() {
        const selectedYear = this.value;

        fetch(`{{ route('kabid.perdagangan') }}?tahun=${selectedYear}`, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                renderCharts(data.statusCounts, data.dataBulanan);
            })
            .catch(error => console.error('Error:', error));
    });
</script>

@endsection