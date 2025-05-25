@extends('layouts.metrologi.kadis')

@section('title', 'Data Pasar dan Distribusi')

@section('content')
<div class="relative w-full h-32">
    <img src="{{ asset('assets/img/background/dagang.jpg') }}" alt="Background" class="object-cover w-full h-full" />
    <div class="absolute bottom-0 w-full -left-4 h-60 -z-10">
        <img src="{{ asset('assets/img/background/dagang.jpg') }}" alt="Background" class="object-cover w-full h-full -ml-16">
    </div>
    <a href="{{ route('dashboard-kadis') }}"
        class="absolute flex items-center justify-center w-12 h-12 text-black transition-all duration-300 transform -translate-y-1/2 rounded-full shadow-lg left-14 top-1/2 bg-white/80 hover:bg-black hover:text-white hover:scale-110">
        <span class="text-2xl material-symbols-outlined">
            arrow_back
        </span>
    </a>
</div>

<div class="px-4 xl:px-8 py-6">
    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">
        <!-- Kiri: Perkembangan Harga Pupuk dan Perbandingan Harga -->
        <div class="space-y-6 xl:col-span-2">
            <!-- Grafik Bar -->
            <div class="p-4 bg-white rounded-xl shadow">
                <div class="flex items-center justify-between">
                    <h2 class="font-semibold text-gray-700">Perbandingan Harga Kemarin dan Hari Ini</h2>
                    <!-- Tambahkan id lokasiSelect agar JS bisa akses -->
                    <select id="lokasiSelect" class="border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200">
                        <option value="Pasar Sumpang" {{ $selectedLokasi == 'Pasar Sumpang' ? 'selected' : '' }}>Pasar Sumpang</option>
                        <option value="Pasar Lakessi" {{ $selectedLokasi == 'Pasar Lakessi' ? 'selected' : '' }}>Pasar Lakessi</option>
                    </select>
                </div>
                <div class="w-full overflow-x-auto mt-2">
                    <div class="min-w-[1000px] h-[300px]">
                        <canvas id="barChart"></canvas>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow p-4">
                <h2 class="text-lg font-semibold text-gray-700 mb-2">Perkembangan Harga Pupuk</h2>
                <div class="w-full h-[300px]">
                    <canvas id="lineChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Kanan: 2 Pie Chart dan 1 Donut Chart -->
        <div class="space-y-6">
            <div id="pieChartsContainer">
                <!-- Pie Chart Naik -->
                <div class="p-4 bg-white shadow rounded-xl mb-6">
                    <h3 class="text-center font-semibold text-black mb-3">Tren Harga Naik</h3>
                    <div class="flex flex-col sm:flex-row items-start space-y-4 sm:space-y-0 sm:space-x-4">
                        <div class="w-full sm:w-1/2">
                            <canvas id="topHargaNaikChart"></canvas>
                        </div>
                        <!-- Container list tren harga naik, harus ada id supaya JS bisa update -->
                        <div id="topHargaNaikList" class="w-full sm:w-1/2 space-y-2 overflow-y-auto max-h-48 hide-scrollbar">
                            <!-- Data akan diisi oleh JS -->
                        </div>
                    </div>
                </div>

                <!-- Pie Chart Turun -->
                <div class="p-4 bg-white shadow rounded-xl mb-6">
                    <h3 class="text-center font-semibold text-black mb-3">Tren Harga Turun</h3>
                    <div class="flex flex-col sm:flex-row items-start space-y-4 sm:space-y-0 sm:space-x-4">
                        <div class="w-full sm:w-1/2">
                            <canvas id="topHargaTurunChart"></canvas>
                        </div>
                        <!-- Container list tren harga turun -->
                        <div id="topHargaTurunList" class="w-full sm:w-1/2 space-y-2 overflow-y-auto max-h-48 hide-scrollbar">
                            <!-- Data akan diisi oleh JS -->
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow p-4">
                <h2 class="text-lg font-semibold text-gray-700 mb-2">Distribusi Pupuk</h2>
                <div class="w-full h-[220px]">
                    <canvas id="donutChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', () => {
  // Chart.js instances
  let barChart, lineChart, pieNaikChart, pieTurunChart;

  // Fungsi buat chart Bar
  function createBarChart(ctx, labels, todayData, yesterdayData) {
    if (barChart) barChart.destroy();
    barChart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: labels,
        datasets: [
          {
            label: 'Harga Hari Ini',
            data: todayData,
            backgroundColor: '#3b82f6'
          },
          {
            label: 'Harga Kemarin',
            data: yesterdayData,
            backgroundColor: '#f87171'
          }
        ]
      },
      options: {
        responsive: true,
        scales: {
          y: {
            beginAtZero: false,
            title: { display: true, text: 'Harga (Rp)' }
          }
        },
        plugins: {
          legend: { position: 'top' }
        }
      }
    });
  }

  // Fungsi buat chart Line (penyaluran pupuk per tahun)
  function createLineChart(ctx, labels, datasets) {
    if (lineChart) lineChart.destroy();
    lineChart = new Chart(ctx, {
      type: 'line',
      data: {
        labels: labels,
        datasets: datasets
      },
      options: {
        responsive: true,
        interaction: { mode: 'nearest', axis: 'x', intersect: false },
        scales: {
          y: {
            beginAtZero: true,
            title: { display: true, text: 'Total Penyaluran' }
          },
          x: {
            title: { display: true, text: 'Tahun' }
          }
        },
        plugins: {
          legend: { position: 'bottom' }
        }
      }
    });
  }

  // Fungsi buat pie chart untuk harga naik dan turun
  function createPieChart(ctx, labels, data, colors) {
    return new Chart(ctx, {
      type: 'pie',
      data: {
        labels: labels,
        datasets: [{
          data: data,
          backgroundColor: colors,
          borderColor: '#fff',
          borderWidth: 2
        }]
      },
      options: {
        responsive: true,
        plugins: {
          legend: { display: false }
        }
      }
    });
  }

  // Update daftar tren harga naik/turun di sidebar
  function updateTrendList(containerId, items) {
    const container = document.getElementById(containerId);
    container.innerHTML = '';
    items.forEach(item => {
      if (item.label) {
        const el = document.createElement('div');
        el.className = 'flex items-center text-sm mb-1';
        el.innerHTML = `
          <span class="w-3 h-3 rounded-full mr-2" style="background-color:${item.color}"></span>
          <span class="truncate">${item.label} (${item.price_change})</span>
        `;
        container.appendChild(el);
      }
    });
  }

  // Fetch data dari backend sesuai lokasi dan kecamatan yang dipilih
  async function fetchData(lokasi, kecamatan) {
    try {
      const params = new URLSearchParams({ lokasi, kecamatan });
      const response = await fetch(`/api/data-perdagangan?${params.toString()}`);
      if (!response.ok) throw new Error('Gagal mengambil data.');
      return await response.json();
    } catch (error) {
      alert(error.message);
      return null;
    }
  }

  // Render semua grafik dan data
  async function renderAll() {
    const lokasi = document.getElementById('lokasiSelect').value;
    const kecamatan = document.getElementById('kecamatanSelect') ? document.getElementById('kecamatanSelect').value : '';

    const data = await fetchData(lokasi, kecamatan);
    if (!data) return;

    // Bar Chart
    createBarChart(
      document.getElementById('barChart').getContext('2d'),
      data.barChartData.labels,
      data.barChartData.today,
      data.barChartData.yesterday
    );

    // Line Chart
    createLineChart(
      document.getElementById('lineChart').getContext('2d'),
      data.lineLabels,
      data.lineDatasets
    );

    // Pie Chart Harga Naik
    if (pieNaikChart) pieNaikChart.destroy();
    pieNaikChart = createPieChart(
      document.getElementById('topHargaNaikChart').getContext('2d'),
      data.topHargaNaik.map(i => i.label),
      data.topHargaNaik.map(i => i.price_change),
      data.topHargaNaik.map(i => i.color)
    );

    // Pie Chart Harga Turun
    if (pieTurunChart) pieTurunChart.destroy();
    pieTurunChart = createPieChart(
      document.getElementById('topHargaTurunChart').getContext('2d'),
      data.topHargaTurun.map(i => i.label),
      data.topHargaTurun.map(i => i.price_change),
      data.topHargaTurun.map(i => i.color)
    );

    // Update list tren
    updateTrendList('topHargaNaikList', data.topHargaNaik);
    updateTrendList('topHargaTurunList', data.topHargaTurun);

    // Update data distribusi pupuk jika ada elemen tabel/daftar, contoh sederhana
    if (data.dataDistribusiHtml) {
      document.getElementById('dataDistribusiContainer').innerHTML = data.dataDistribusiHtml;
    }
  }

  // Event listener ketika lokasi atau kecamatan berubah
  document.getElementById('lokasiSelect').addEventListener('change', renderAll);
  if (document.getElementById('kecamatanSelect')) {
    document.getElementById('kecamatanSelect').addEventListener('change', renderAll);
  }

  // Initial render saat halaman dimuat
  renderAll();
});
</script>

{{-- <script>
    Chart.register(ChartDataLabels);

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
            radius: '60%', // default biasanya '100%' atau penuh
            plugins: {
                datalabels: {
                    color: '#000',
                    font: {
                        weight: 'bold',
                        size: 16
                    },
                    formatter: (value) => value  // Hanya tampilkan nilai saja, tanpa %
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
                            return `${context.label}: ${context.raw}`;
                        }
                    }
                }
            }
        },
        plugins: [ChartDataLabels]
    });


    // Line Chart
    const lineLabels = @json($lineLabels);
    const lineDatasets = @json($lineDatasets);

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
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Total Penyaluran'
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Tahun'
                    }
                }
            }
        }
    });
</script> --}}
@endsection
