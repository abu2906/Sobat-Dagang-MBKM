@extends('layouts.admin')
@section('title', 'Dashboard Industri')

@section('content')

<div class="bg-white p-6 overflow-y-auto min-h-screen">
  <div>
      <div class="flex flex-col mt-0 sm:flex-row sm:space-x-6 space-y-6 sm:space-y-0 ">
        <!-- Jumlah Surat Balasan Card (Larger) -->
        <div class="sm:w-[370px] p-4 bg-white rounded-xl shadow-[0_0_15px_3px_rgba(0,54,94,0.25)]">
          <div class="text-5xl text-emerald-600 mb-2">📄</div>
          <p class="font-semibold text-lg mb-1 mt-0">Jumlah Surat Terverifikasi</p>
          <p class="font-extrabold text-3xl mb-1 mt-0">{{ $totalSuratTerverifikasi }}</p>
          <p class="text-base">Surat Permohonan Telah Diverifikasi </p>
        </div>
        <!-- Akumulasi Perkembangan Card (Smaller) -->
        <div class="sm:w-[370px] p-4 bg-white rounded-xl shadow-[0_0_15px_3px_rgba(0,54,94,0.25)]">
          <div class="text-5xl text-emerald-600 mb-2">🏭</div>
          <p class="font-semibold text-lg mb-1 flex items-center gap-2">Akumulasi Perkembangan IKM</p>
          <p class="font-extrabold text-3xl mb-1">210</p>
          <p class="text-base">IKM Bertambah Hingga Bulan Ini</p>
        </div>
        <!-- Jumlah Data IKM -->
        <div class="sm:w-[370px] p-4 bg-white rounded-xl shadow-[0_0_15px_3px_rgba(0,54,94,0.25)]">
          <div class="text-5xl text-emerald-600 mb-2">💰</div>
          <p class="font-semibold text-lg mb-1 mt-0">Total Nilai Investasi</p>
          <p class="font-extrabold text-3xl mb-1 mt-0">{{ $totalSuratTerverifikasi }}</p>
          <p class="text-base">Total Nilai Investasi Seluruh Industri</p>
        </div>
        <!-- Jumlah IKM Bersertifikasi HALAL -->
        <div class="sm:w-[370px] p-4 bg-white rounded-xl shadow-[0_0_15px_3px_rgba(0,54,94,0.25)]">
          <div class="text-5xl text-emerald-600 mb-2">🥩</div>
          <p class="font-semibold text-lg mb-1 mt-0">Jumlah IKM Bersertifikasi HALAL</p>
          <p class="font-extrabold text-3xl mb-1 mt-0">{{ $totalSuratTerverifikasi }}</p>
          <p class="text-base">IKM telah memiliki sertifikasi Halal</p>
        </div>
      </div>
    
    <!-- Left Column: Dashboard Content -->
    <div>
      <div class="mx-auto grid grid-cols-1 sm:grid-cols-2 gap-6">
        <div class="bg-white rounded-xl p-4 sm:p-6 shadow-[0_0_15px_3px_rgba(0,54,94,0.25)] max-h-[400px] mb-2 mt-6">
          <article class="bg-white rounded-xl p-4 h-[370px] flex flex-col">
            <h3 class="font-bold text-xl mb-4">Pertumbuhan IKM</h3>
            <div class="flex flex-col items-center">
              <canvas id="perkembanganChart" class="mb-2 w-300 h-250"></canvas>
            </div>
          </article>
        </div>
        <div class="bg-white rounded-xl p-4 sm:p-6 shadow-[0_0_15px_3px_rgba(0,54,94,0.25)] max-h-[400px] mb-2 mt-6">
            <article class="bg-white rounded-xl p-4 h-[370px] flex flex-col">
              <h3 class="font-bold text-xl mb-4">Pertumbuhan IKM Bersertifikat Halal</h3>
              <div class="flex flex-col items-center">
                <canvas id="halalChart" class="mb-2 w-300 h-250"></canvas>
              </div>
            </article>
          </div>
      </div>
    </div>
    <!-- Right Column: Data IKM Content -->
    <div>
      <section class="grid grid-cols-1 md:grid-cols-2 gap-5 mt-6">
        <!-- Summary IKM -->
        <article class="bg-white rounded-xl p-4 sm:p-6 shadow-[0_0_15px_3px_rgba(0,54,94,0.25)] max-h-[400px] mb-2 mt-2">
          <h3 class="font-bold text-lg mb-2">Sebaran Jenis Industri</h3>
          <div class="flex flex-col items-center">
            <canvas id="distribusiPie" class="mb-3 w-64 h-64"></canvas>
            <ul class="w-full h-full grid grid-cols-3 text-sm text-[#000]">
              <li class="flex items-center gap-2">
                <span class="inline-block w-2 h-2 bg-[#5bc0f8] rounded-sm"></span> Sandang
              </li>
              <li class="flex items-center gap-2">
                <span class="inline-block w-2 h-2 bg-[#d9e9fb] rounded-sm"></span> Pangan
              </li>
              <li class="flex items-center gap-2">
                <span class="inline-block w-2 h-2 bg-[#ffcd56] rounded-sm"></span> Kerajinan
              </li>
            </ul>
            <ul class="w-full h-full grid grid-cols-2 text-sm text-[#000]">  
              <li class="flex items-center gap-3">
                <span class="inline-block w-2 h-2 bg-[#f3f3f3] rounded-sm"></span> Logam & Elektronika
              </li>
              <li class="flex items-center gap-3">
                <span class="inline-block w-2 h-2 bg-[#1a1a1a] rounded-sm"></span> Kimia & Bahan Bangunan
              </li>
            </ul>
          </div>
        </article>
        <div class="bg-white rounded-xl p-4 sm:p-6 shadow-[0_0_15px_3px_rgba(0,54,94,0.25)] max-h-[400px] mb-2 mt-2">
          <article class="bg-white rounded-xl p-4 h-[370px] flex flex-col">
            <h3 class="font-bold text-xl mb-4">Perbandingan IKM Berdasarkan Investasi</h3>
            <div class="flex flex-col items-center">
              <canvas id="perbandinganChart" class="mb-2 w-300 h-250"></canvas>
            </div>
          </article>
        </div>
      </section>
    </div>
  </div>
</div>

<script>
 
  const chartData = {
    ikm: [25, 20, 15, 10, 30],
    halal: [10, 15, 20, 5, 50]
  };
  // Pie Chart Distribusi Industri
  const distribusiCtx = document.getElementById('distribusiPie').getContext('2d');
  const distribusiPie = new Chart(distribusiCtx, {
    type: 'pie',
    data: {
      labels: ['Sandang', 'Pangan', 'Kimia & Bahan Bangunan', 'Logam & Elektronika', 'Kerajinan'],
      datasets: [{
        data: chartData.ikm, // default IKM
        backgroundColor: ['#5bc0f8', '#d9e9fb', '#1a1a1a', '#f3f3f3', '#ffcd56'],
        borderWidth: 1
      }]
    },
    options: {
      responsive: false,
      plugins: {
        legend: {
          display: false // Legend kan sudah kamu buat manual di <ul>
        }
      }
    }
  });

  // Line Chart Perkembangan Industri
  const perkembanganCtx = document.getElementById('perkembanganChart').getContext('2d');
  const perkembanganChart = new Chart(perkembanganCtx, {
    type: 'line',
    data: {
      labels: ['2020', '2021', '2022', '2023', '2024', '2025'],
      datasets: [{
        label: 'Jumlah Industri',
        data: [201, 222, 289, 304, 320, 356], // Contoh data, bisa kamu ganti dari controller
        fill: false,
        borderColor: '#5bc0f8',
        tension: 0.3
      }]
    },
    options: {
      responsive: true,
      plugins: {
        legend: {
          display: true
        }
      },
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });

  // Line Chart Perkembangan IKM HALAL
  const halalCtx = document.getElementById('halalChart').getContext('2d');
  const halalChart = new Chart(halalCtx, {
    type: 'line',
    data: {
      labels: ['2020', '2021', '2022', '2023', '2024', '2025'],
      datasets: [{
        label: 'Jumlah Industri',
        data: [201, 222, 289, 304, 320, 356], // Contoh data, bisa kamu ganti dari controller
        fill: false,
        borderColor: '#5bc0f8',
        tension: 0.3
      }]
    },
    options: {
      responsive: true,
      plugins: {
        legend: {
          display: true
        }
      },
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });

  // Bar Chart Perbandingan IKM
  const perbandinganCtx = document.getElementById('perbandinganChart').getContext('2d');
  const perbandinganChart = new Chart(perbandinganCtx, {
    type: 'bar',
    data: {
      labels: ['Kecil', 'Menengah'],
      datasets: [{
        label: 'Besaran Investasi Data IKM',
        data: [201, 222], 
        backgroundColor: [
          'rgba(255, 206, 86, 0.7)',
          'rgba(255, 99, 132, 0.7)'
        ],
        borderColor: [
          'rgba(255, 206, 86, 1)',
          'rgba(255, 99, 132, 1)'
        ],
        borderWidth: 1,
      }]
    },
    options: {
      responsive: true,
      plugins: {
        legend: {
          display: true
        }
      },
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });

  document.getElementById('dataSelector').addEventListener('change', function () {
    const selected = this.value;
    
    // Ubah data Pie Chart sesuai pilihan
    distribusiPie.data.datasets[0].data = chartData[selected];
    distribusiPie.update();
  });

  document.addEventListener("DOMContentLoaded", function () {
  fetch("/json/data-industri.json")
    .then(response => {
      if (!response.ok) {
        throw new Error("Gagal memuat data");
      }
      return response.json();
    })
    .then(data => {
      const tableBody = document.getElementById("data-industri");
      tableBody.innerHTML = "";

      data.forEach(item => {
        const row = document.createElement("tr");
        row.innerHTML = `
          <td class="px-2 py-2">${item.nama_usaha}</td>
          <td class="px-2 py-2">${item.nama_pemilik}</td>
          <td class="px-2 py-2">${item.produk}</td>
          <td class="px-2 py-2">${item.kecamatan}</td>
        `;
        tableBody.appendChild(row);
      });

      // Simpan data ke variabel global
      window.dataIndustri = data;

      // Tampilkan summary awal (semua kecamatan)
      renderSummary(data);
    })
    .catch(error => console.error("Error:", error));
});

// Fungsi render summary industri
function renderSummary(data) {
  const totalUsaha = data.length;

  const totalLaki = data.reduce((sum, item) => sum + (item.tk_l || 0), 0);
  const totalPerempuan = data.reduce((sum, item) => sum + (item.tk_p || 0), 0);

  // Update isi elemen summary di halaman
  document.querySelector('.text-6xl.mb-1').innerText = `${totalUsaha}`;

  const tenagaKerjaElement = document.getElementById('tenagaKerjaSummary');
  tenagaKerjaElement.innerHTML = `
    <span class="inline-block w-4 h-4 bg-[#5bc0f8] rounded-sm"></span> ${totalLaki} <span class="text-sm">Laki-Laki</span>
    <span class="inline-block w-4 h-4 bg-[#f26c6c] rounded-sm"></span> ${totalPerempuan} <span class="text-sm">Perempuan</span>
  `;
}
</script>
@endsection