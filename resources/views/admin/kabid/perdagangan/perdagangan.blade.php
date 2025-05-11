@extends('layouts.admin')
@section('title', 'Dashboard Kabid Bidang Perdagangan')
@section('content')

<div class="p-6 bg-white min-h-screen">
    <h1 class="text-2xl font-bold text-black mb-4">Dashboard Bidang Perdagangan</h1>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                <a href="#" class="bg-white rounded-2xl shadow-md hover:shadow-lg transition p-5 flex items-center space-x-4">
            <img src="{{ asset('assets/img/icon/folder-download.png') }}" alt="Surat Masuk" class="w-12 h-12">
            <div>
                <p class="text-base font-medium text-black">Jumlah Surat Masuk</p>
                <p class="text-2xl font-bold text-blue-600">n</p>
            </div>
        </a>

        <a href="#" class="bg-white rounded-2xl shadow-md hover:shadow-lg transition p-5 flex items-center space-x-4">
            <img src="{{ asset('assets/img/icon/Verif.png') }}" alt="Terverifikasi" class="w-12 h-12">
            <div>
                <p class="text-base font-medium text-black">Jumlah Surat Terverifikasi</p>
                <p class="text-2xl font-bold text-yellow-500">n</p>
            </div>
        </a>

        <a href="#" class="bg-white rounded-2xl shadow-md hover:shadow-lg transition p-5 flex items-center space-x-4">
            <img src="{{ asset('assets/img/icon/surat_ditolak.png') }}" alt="Ditolak" class="w-12 h-12">
            <div>
                <p class="text-base font-medium text-black">Jumlah Surat Ditolak</p>
                <p class="text-2xl font-bold text-green-600">n</p>
            </div>
        </a>
    </div>

    <div class="bg-white shadow rounded-xl p-4 mb-6">
        <table class="w-full text-sm text-left text-gray-700">
            <thead class="bg-[#083358] text-white">
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
            <tr class="border-b">
                <td class="px-4 py-2 text-center">1</td>
                <td class="px-4 py-2 text-center">Budi Santoso</td>
                <td class="px-4 py-2 text-center">2025-05-01</td>
                <td class="px-4 py-2 text-center">
                    <span class="px-2 py-1 bg-yellow-300 text-yellow-800 text-xs font-semibold rounded-full">Menunggu</span>
                </td>
                <td class="px-4 py-2 text-center">Surat Izin Usaha</td>
                <td class="px-4 py-2 text-center">
                    <a href="#" class="text-blue-600 underline">Lihat Dokumen</a>
                </td>
                <td class="px-4 py-2 text-center space-x-2">
                    <button class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600">Setujui</button>
                    <button class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">Tolak</button>
                </td>
            </tr>
            <tr class="border-b">
                <td class="px-4 py-2 text-center">2</td>
                <td class="px-4 py-2 text-center">Siti Aminah</td>
                <td class="px-4 py-2 text-center">2025-04-28</td>
                <td class="px-4 py-2 text-center">
                    <span class="px-2 py-1 bg-green-300 text-green-800 text-xs font-semibold rounded-full">Disetujui</span>
                </td>
                <td class="px-4 py-2 text-center">Surat Rekomendasi</td>
                <td class="px-4 py-2 text-center">
                    <a href="#" class="text-blue-600 underline">Lihat Dokumen</a>
                </td>
                <td class="px-4 py-2 text-center space-x-2">
                    <button class="bg-gray-400 text-white px-3 py-1 rounded cursor-not-allowed" disabled>✓</button>
                </td>
            </tr>
        </tbody>

        {{-- <tbody class="bg-white">
            @foreach($suratMasuk as $index => $surat)
            <tr class="border-b">
                <td class="px-4 py-2 text-center rounded-l">{{ $index + 1 }}</td>
                <td class="px-4 py-2 text-center">{{ $surat->nama_pemohon }}</td>
                <td class="px-4 py-2 text-center">{{ $surat->tanggal_dikirim }}</td>
                <td class="px-4 py-2 text-center">
                    @if($surat->status == 'Menunggu')
                        <span class="px-2 py-1 bg-yellow-300 text-yellow-800 text-xs font-semibold rounded-full">Menunggu</span>
                    @elseif($surat->status == 'Disetujui')
                        <span class="px-2 py-1 bg-green-300 text-green-800 text-xs font-semibold rounded-full">Disetujui</span>
                    @else
                        <span class="px-2 py-1 bg-red-300 text-red-800 text-xs font-semibold rounded-full">Ditolak</span>
                    @endif
                </td>
                <td class="px-4 py-2 text-center">{{ $surat->jenis_surat }}</td>
                <td class="px-4 py-2 text-center">
                    <a href="{{ asset('storage/dokumen/' . $surat->dokumen) }}" target="_blank" class="text-blue-600 underline">Lihat Dokumen</a>
                </td>
                <td class="px-4 py-2 text-center rounded-r">
                    @if($surat->status == 'Disetujui' || $surat->status == 'Ditolak')
                        <button class="bg-gray-400 text-white px-3 py-1 rounded cursor-not-allowed" disabled>✓</button>
                    @else
                        <form action="{{ route('surat.setujui', $surat->id) }}" method="POST" class="inline">
                            @csrf
                            <button class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600">Setujui</button>
                        </form>
                        <form action="{{ route('surat.tolak', $surat->id) }}" method="POST" class="inline">
                            @csrf
                            <button class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">Tolak</button>
                        </form>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody> --}}

        </table>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <!-- Pie Chart -->
    <div class="bg-white shadow rounded-xl p-4 flex flex-col">
        <h2 class="text-lg font-semibold mb-2">Jumlah Permohonan per Status</h2>
        <div class="w-full h-64">
            <canvas id="statusPie" class="w-full h-full"></canvas>
        </div>
    </div>

    <!-- Line Chart -->
    <div class="bg-white shadow rounded-xl p-4 flex flex-col">
        <div class="flex items-center justify-between mb-2">
            <h2 class="text-lg font-semibold">Grafik Perkembangan Surat Masuk</h2>
            <select id="tahunSelector" class="border rounded px-2 py-1 text-sm">
                <option value="2025" selected>2025</option>
                <option value="2024">2024</option>
                <option value="2023">2023</option>
            </select>
        </div>
        <div class="w-full h-64">
            <canvas id="suratChart" class="w-full h-full"></canvas>
        </div>
    </div>
</div>

</div>

<script>
    // Data per tahun untuk grafik line
    const dataPerTahun = {
        2025: [2, 3, 5, 3, 4, 6, 4, 3, 2, 5, 4, 6],
        2024: [1, 2, 2, 4, 3, 4, 5, 3, 4, 2, 1, 3],
        2023: [0, 1, 1, 2, 1, 2, 3, 2, 2, 1, 0, 1]
    };

    // Pie Chart
    const ctxPie = document.getElementById('statusPie').getContext('2d');
    const statusPie = new Chart(ctxPie, {
        type: 'doughnut',
        data: {
            labels: ['Disetujui', 'Ditolak', 'Menunggu'],
            datasets: [{
                data: [3, 2, 1], // <- Ini bisa diganti jadi dinamis dari controller
                backgroundColor: ['#10b981', '#ef4444', '#facc15'],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false
        }
    });

    // Line Chart
    const ctxLine = document.getElementById('suratChart').getContext('2d');
    const suratChart = new Chart(ctxLine, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            datasets: [{
                label: 'Surat Masuk',
                data: dataPerTahun[2025],
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

    // Dropdown untuk memilih tahun
    document.getElementById('tahunSelector').addEventListener('change', function () {
        const tahun = this.value;
        suratChart.data.datasets[0].data = dataPerTahun[tahun];
        suratChart.update();
    });
</script>
 
@endsection
