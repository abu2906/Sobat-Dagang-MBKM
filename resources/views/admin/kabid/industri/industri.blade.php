@extends('layouts.admin')
@section('title', 'Dashboard Industri')

@section('content')
<div class="bg-white p-6 overflow-y-auto min-h-screen">
  <div class="mx-auto grid grid-cols-1 sm:grid-cols-2 gap-6">
    <!-- Left Column: Dashboard Content -->
    <div>
      <div class="flex flex-col sm:flex-row sm:space-x-6 space-y-6 sm:space-y-0 ">
        <!-- Jumlah Surat Balasan Card (Larger) -->
        <div class="sm:w-[370px] p-4 bg-white rounded-xl shadow-[0_0_15px_3px_rgba(0,54,94,0.25)]">
          <p class="font-semibold text-lg mb-1">Jumlah Surat Terverifikasi</p>
          <p class="font-extrabold text-3xl mb-1">{{ $totalSuratTerverifikasi }}</p>
          <p class="text-base">Surat Permohonan Telah Diverifikasi </p>
        </div>
        <!-- Akumulasi Perkembangan Card (Smaller) -->
        <div class="sm:w-[370px] p-4 bg-white rounded-xl shadow-[0_0_15px_3px_rgba(0,54,94,0.25)]">
          <p class="font-semibold text-lg mb-1 flex items-center gap-2">
            <i class="fas fa-file-alt"></i>
            Akumulasi Perkembangan
          </p>
          <p class="font-extrabold text-3xl mb-1">210</p>
          <p class="text-base">Hingga Bulan Ini</p>
        </div>
      </div>



      <div class="bg-white rounded-xl p-4 sm:p-6 shadow-[0_0_15px_3px_rgba(0,54,94,0.25)] overflow-x-auto mt-6">
        <table class="min-w-full border-collapse border-spacing-0 table-fixed text-[11px] rounded-t-xl">
            <thead class="bg-[#00365e] text-white text-[10px] sm:text-xs leading-4 sm:leading-5 rounded-t-xl">
            <tr>
              <th class="text-left font-semibold px-2 py-2 w-[25%] rounded-tl-xl">NAMA USAHA</th>
              <th class="text-left font-semibold px-2 py-2 w-[25%]">NAMA PEMILIK</th>
              <th class="text-left font-semibold px-2 py-2 w-[35%]">NAMA PRODUK</th>
              <th class="text-center font-semibold px-2 py-2 w-[15%] rounded-tr-xl">
                <div>T.K. (ORG)</div>
                <div class="flex justify-center space-x-4 mt-1 text-[8px] font-normal">
                  <span>L</span>
                  <span>P</span>
                </div>
              </th>
            </tr>
          </thead>
          <tbody class="text-black text-[10px] sm:text-xs leading-4 sm:leading-5 rounded-b-xl">
            <tr class="bg-[#dbe5f0] font-normal">
              <td class="px-2 py-1">US.Reski</td>
              <td class="px-2 py-1">Rahkmad Qadri</td>
              <td class="px-2 py-1">PENGGILING DAGING</td>
              <td class="px-2 py-1 text-center">2<span class="inline-block w-6"></span>0</td>
            </tr>
            <tr class="bg-[#e7edf5] font-normal">
              <td class="px-2 py-1">US. Sumber Makmur</td>
              <td class="px-2 py-1">Supriadi</td>
              <td class="px-2 py-1">PENGGILING DAGING</td>
              <td class="px-2 py-1 text-center">6<span class="inline-block w-6"></span>0</td>
            </tr>
            <tr class="bg-[#dbe5f0] font-normal">
              <td class="px-2 py-1">US. Winarto</td>
              <td class="px-2 py-1">Winarto</td>
              <td class="px-2 py-1">PENGGILING DAGING</td>
              <td class="px-2 py-1 text-center">3<span class="inline-block w-6"></span>0</td>
            </tr>
            <tr class="bg-[#e7edf5] font-normal">
              <td class="px-2 py-1">US. Ahmad</td>
              <td class="px-2 py-1">Ahmad Rizaldy</td>
              <td class="px-2 py-1">PENGGILING IKAN</td>
              <td class="px-2 py-1 text-center">3<span class="inline-block w-6"></span>3</td>
            </tr>
            <tr class="bg-[#dbe5f0] font-normal rounded-b-xl">
              <td class="px-2 py-1">US. Amiruddin</td>
              <td class="px-2 py-1">Amiruddin</td>
              <td class="px-2 py-1">PENGGILING IKAN</td>
              <td class="px-2 py-1 text-center">7<span class="inline-block w-6"></span>7</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

    <!-- Right Column: Data IKM Content -->
    <div>
      <!-- Dropdown for selecting Data IKM -->
      <select id="dataSelector" class="w-full bg-[#073763] text-white text-lg rounded-lg py-3 px-5 appearance-none relative" style="background-image: url('data:image/svg+xml;utf8,&lt;svg fill=\'white\' height=\'24\' viewBox=\'0 0 24 24\' width=\'24\' xmlns=\'http://www.w3.org/2000/svg\'&gt;&lt;path d=\'M7 10l5 5 5-5z\'/&gt;&lt;/svg&gt;'); background-repeat: no-repeat; background-position: right 1rem center; background-size: 1.25rem;">
        <option value="ikm">Data IKM</option>
        <option value="halal">Sertifikat Halal</option>
      </select>

      <!-- Filter container -->
      <section class="bg-white rounded-xl p-5 shadow-[0_0_15px_3px_rgba(0,54,94,0.25)] space-y-2 mt-6">
        <h2 class="font-bold text-lg flex items-center gap-2 text-[#073763]">
          <i class="fas fa-sliders-h"></i>
          Filter
        </h2>
        <form class="flex flex-col sm:flex-row gap-4">
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
          <div class="relative w-full">
            <div onclick="toggleDropdowns()" class="flex items-center justify-between bg-[#CDE4F7] text-black px-4 py-2 rounded-lg w-full cursor-pointer hover:bg-[#b9daf2] transition-all duration-200">
              <span id="selected-level">Invenstasi</span>
              <span class="material-symbols-outlined text-sm text-gray-700">tune</span>
            </div>
            <div id="dropdown-level" class="hidden absolute top-full mt-2 left-0 w-full bg-white rounded-xl shadow-lg z-20 overflow-hidden border border-gray-200">
              <div class="hover:bg-blue-100 px-4 py-2 cursor-pointer text-gray-700" onclick="selectLevel('Kecil')">Kecil</div>
              <div class="hover:bg-blue-100 px-4 py-2 cursor-pointer text-gray-700" onclick="selectLevel('Menengah')">Menengah</div>
            </div>
        </div>
        </form>
      </section>

      <!-- Cards for stats: Industri Terdaftar and Informasi Tambahan -->
      <section class="grid grid-cols-1 md:grid-cols-2 gap-5 mt-6">
        <!-- Industri Terdaftar & Tenaga Kerja card -->
        <article class="bg-white rounded-xl p-4 shadow-[0_0_15px_3px_rgba(0,54,94,0.25)] h-[300px]  flex flex-col">
          <h3 class="font-bold text-lg flex items-center gap-2 mb-3 text-[#000]">
            <span>⚖</span>
            Industri Terdaftar
          </h3>
          <p class="text-[#073763] font-extrabold text-2xl mb-1">14 Usaha</p>
          <p class="mb-1"><span class="font-bold">3</span> Penggiling Daging</p>
          <p class="mb-4"><span class="font-bold">11</span> Penggiling Ikan</p>
          <h4 class="font-extrabold text-xl text-[#073763] mb-2">Tenaga Kerja</h4>
          <p class="flex items-center gap-2 text-[#073763] font-semibold">
            <span class="inline-block w-4 h-4 bg-[#5bc0f8] rounded-sm"></span> 63 <span class="text-sm">Laki-Laki</span>
            <span class="inline-block w-4 h-4 bg-[#f26c6c] rounded-sm"></span> 57 <span class="text-sm">Perempuan</span>
          </p>
        </article>
      
        <!-- Informasi Tambahan card -->
        <article class="bg-white rounded-xl p-4 shadow-[0_0_15px_3px_rgba(0,54,94,0.25)] h-[300px] flex flex-col">
          <h3 class="font-bold text-lg mb-2">Distribusi Industri</h3>
          <div class="flex flex-col items-center">
            <canvas id="distribusiPie" class="mb-2 w-32 h-32"></canvas>
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
              <li class="flex items-center gap-2">
                <span class="inline-block w-2 h-2 bg-[#f3f3f3] rounded-sm"></span> Logam & Elektronika
              </li>
              <li class="flex items-center gap-2">
                <span class="inline-block w-2 h-2 bg-[#1a1a1a] rounded-sm"></span> Kimia & Bahan Bangunan
              </li>
            </ul>
          </div>
        </article>
      </section>
      <article class="bg-white rounded-xl p-4 shadow-[0_0_15px_3px_rgba(0,54,94,0.25)] mt-6 h-[400px] flex flex-col">
        <h3 class="font-bold text-lg mb-4">Informasi Tambahan</h3>
        <div class="flex flex-col items-center">
          <canvas id="perkembanganChart" class="mb-2 w-300 h-full"></canvas>
        </div>
      </article>
    </div>
    
    </div>
    
  </div>
</div>

<script>

  function toggleDropdown() {
    const dropdown = document.getElementById('dropdown-kecamatan');
    dropdown.classList.toggle('hidden');
  }

  
  function toggleDropdowns() {
    const dropdowns = document.getElementById('dropdown-level');
    dropdowns.classList.toggle('hidden');
  }

  function selectKecamatan(kecamatan) {
    document.getElementById('selected-kecamatan').textContent = kecamatan;
    toggleDropdown();
  }

  function selectLevel(level) {
    document.getElementById('selected-level').textContent = level;
    toggleDropdowns();
  }

  document.addEventListener('click', function (e) {
    const dropdown = document.getElementById('dropdown-kecamatan');
    const trigger = document.querySelector('[onclick="toggleDropdown()"]');
    if (!dropdown.contains(e.target) && !trigger.contains(e.target)) {
        dropdown.classList.add('hidden');
    }
  });

  document.addEventListener('click', function (e) {
    const dropdowns = document.getElementById('dropdown-level');
    const trigger = document.querySelector('[onclick="toggleDropdowns()"]');
    if (!dropdowns.contains(e.target) && !trigger.contains(e.target)) {
        dropdowns.classList.add('hidden');
    }
  });


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
      labels: ['2021', '2021', '2022', '2023', '2024', '2025'],
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

document.getElementById('dataSelector').addEventListener('change', function () {
  const selected = this.value;
  
  // Ubah data Pie Chart sesuai pilihan
  distribusiPie.data.datasets[0].data = chartData[selected];
  distribusiPie.update();
});

</script>
@endsection