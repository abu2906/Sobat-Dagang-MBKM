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
        <div class="space-y-6 xl:col-span-2">
            <div class="p-4 bg-white rounded-xl shadow">
                <div class="flex items-center justify-between">
                    <h2 class="font-semibold text-gray-700">Perbandingan Harga Kemarin dan Hari Ini</h2>
                    <select id="lokasiSelect" class="border-gray-300 bg-['#083858'] rounded-md shadow-sm focus:ring focus:ring-blue-200">
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

        <div class="space-y-6">
            <div id="pieChartsContainer">
                <div class="p-4 bg-white shadow rounded-xl mb-6">
                    <h3 class="text-center font-semibold text-black mb-3">Tren Harga Naik</h3>
                    <div class="flex flex-col sm:flex-row items-start space-y-4 sm:space-y-0 sm:space-x-4">
                        <div class="w-full sm:w-1/2">
                            <canvas id="topHargaNaikChart"></canvas>
                        </div>
                        <div id="topHargaNaikList" class="w-full sm:w-1/2 space-y-2 overflow-y-auto max-h-48 hide-scrollbar">
                        </div>
                    </div>
                </div>

                <div class="p-4 bg-white shadow rounded-xl mb-6">
                    <h3 class="text-center font-semibold text-black mb-3">Tren Harga Turun</h3>
                    <div class="flex flex-col sm:flex-row items-start space-y-4 sm:space-y-0 sm:space-x-4">
                        <div class="w-full sm:w-1/2">
                            <canvas id="topHargaTurunChart"></canvas>
                        </div>
                        <div id="topHargaTurunList" class="w-full sm:w-1/2 space-y-2 overflow-y-auto max-h-48 hide-scrollbar">
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
  document.addEventListener('DOMContentLoaded', function() {
  const naikCtx = document.getElementById('topHargaNaikChart');
  const turunCtx = document.getElementById('topHargaTurunChart');

  if (naikCtx) {
      const dataPieNaik = @json($topHargaNaik);
      new Chart(naikCtx.getContext('2d'), {
          type: 'pie',
          data: {
              labels: dataPieNaik.map(i => i.label),
              datasets: [{
                  data: dataPieNaik.map(i => i.price_change),
                  backgroundColor: dataPieNaik.map(i => i.color),
                  borderColor: '#fff',
                  borderWidth: 2
              }]
          },
          options: {
              plugins: {
                  legend: { position: 'none' },
                  datalabels: {
                      formatter: (value, context) => {
                          const dataset = context.chart.data.datasets[0];
                          const total = dataset.data.reduce((a, b) => a + b, 0);
                          const percentage = (value / total * 100).toFixed(1);
                          return percentage + '%';
                      },
                      color: '#fff',
                      font: { weight: 'bold', size: 12 }
                  }
              }
          },
          plugins: [ChartDataLabels]
      });
  }

  if (turunCtx) {
      const dataPieTurun = @json($topHargaTurun);
      new Chart(turunCtx.getContext('2d'), {
          type: 'pie',
          data: {
              labels: dataPieTurun.map(i => i.label),
              datasets: [{
                  data: dataPieTurun.map(i => i.price_change),
                  backgroundColor: dataPieTurun.map(i => i.color),
                  borderColor: '#fff',
                  borderWidth: 2
              }]
          },
          options: {
              plugins: {
                  legend: { position: 'none' },
                  datalabels: {
                      formatter: (value, context) => {
                          const dataset = context.chart.data.datasets[0];
                          const total = dataset.data.reduce((a, b) => a + b, 0);
                          const percentage = (value / total * 100).toFixed(1);
                          return percentage + '%';
                      },
                      color: '#fff',
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
              datasets: [{
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
                  legend: {
                      position: 'top'
                  }
              },
              scales: {
                  y: {
                      beginAtZero: false,
                      title: {
                          display: true,
                          text: 'Harga (Rp)'
                      }
                  }
              }
          }
      });
  }
  // Data dari controller
  const lineLabels = @json($lineLabels);
  const lineDatasets = @json($lineDatasets);

  const donutLabels = @json($dataPupuk->pluck('nama_barang'));
  const donutData = @json($dataPupuk->pluck('total'));

  // Line Chart - Perkembangan penyaluran per tahun
  const ctxLine = document.getElementById('lineChart').getContext('2d');
  const lineChart = new Chart(ctxLine, {
      type: 'line',
      data: {
          labels: lineLabels,
          datasets: lineDatasets
      },
      options: {
          responsive: true,
          scales: {
              y: {
                  beginAtZero: true,
                  title: {
                      display: true,
                      text: 'Jumlah Penyaluran'
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

  // Donut Chart - Distribusi total penyaluran pupuk per jenis
     const pieLabels = @json($dataPupuk->keys());
    const pieData = @json($dataPupuk->values());

    const pieCtx = document.getElementById('donutChart').getContext('2d');

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


  });
</script>
@endsection
