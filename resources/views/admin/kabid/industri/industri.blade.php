@extends('layouts.admin')
@section('title', 'Dashboard Industri')

@section('content')
<div class="bg-white p-6 overflow-y-auto min-h-screen">
  <div class="max-w-7xl mx-auto grid grid-cols-1 sm:grid-cols-2 gap-6">
    <!-- Left Column: Dashboard Content -->
    <div>
      <div class="flex flex-col sm:flex-row sm:space-x-6 space-y-6 sm:space-y-0">
        <!-- Jumlah Surat Balasan Card (Larger) -->
        <div class="sm:w-[250px] p-4 bg-white rounded-xl shadow-[0_0_15px_3px_rgba(0,54,94,0.25)]">
          <p class="font-semibold text-lg mb-1">Jumlah Surat Balasan</p>
          <p class="font-extrabold text-3xl mb-1">200</p>
          <p class="text-base">Total Seluruh Sektor</p>
        </div>
        <!-- Akumulasi Perkembangan Card (Smaller) -->
        <div class="sm:w-[300px] p-4 bg-white rounded-xl shadow-[0_0_15px_3px_rgba(0,54,94,0.25)]">
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
      <select aria-label="Data IKM" class="w-full bg-[#073763] text-white text-lg rounded-lg py-3 px-5 appearance-none relative" style="background-image: url('data:image/svg+xml;utf8,&lt;svg fill=\'white\' height=\'24\' viewBox=\'0 0 24 24\' width=\'24\' xmlns=\'http://www.w3.org/2000/svg\'&gt;&lt;path d=\'M7 10l5 5 5-5z\'/&gt;&lt;/svg&gt;'); background-repeat: no-repeat; background-position: right 1rem center; background-size: 1.25rem;">
        <option>Data IKM</option>
      </select>

      <!-- Filter container -->
      <section class="bg-white rounded-xl p-5 shadow-[0_0_15px_3px_rgba(0,54,94,0.25)] space-y-2 mt-6">
        <h2 class="font-bold text-lg flex items-center gap-2 text-[#073763]">
          <i class="fas fa-sliders-h"></i>
          Filter
        </h2>
        <form class="flex flex-col sm:flex-row gap-4">
          <label class="flex justify-between items-center bg-[#c3def5] rounded-xl px-5 py-3 w-full sm:w-1/2 cursor-pointer" for="filter1">
            <span class="text-[#073763] text-base font-normal">Soreang</span>
            <i class="fas fa-sliders-h text-[#073763]"></i>
            <input class="hidden" id="filter1" type="checkbox"/>
          </label>
          <label class="flex justify-between items-center bg-[#c3def5] rounded-xl px-5 py-3 w-full sm:w-1/2 cursor-pointer" for="filter2">
            <span class="text-[#7f7f7f] text-base font-normal">Filter lainnya</span>
            <i class="fas fa-sliders-h text-[#073763]"></i>
            <input class="hidden" id="filter2" type="checkbox"/>
          </label>
        </form>
      </section>

      <!-- Cards for stats: Industri Terdaftar and Informasi Tambahan -->
      <section class="grid grid-cols-1 md:grid-cols-2 gap-5 mt-6">
        <!-- Industri Terdaftar & Tenaga Kerja card -->
        <article class="bg-white rounded-xl p-4 shadow-[0_0_15px_3px_rgba(0,54,94,0.25)] h-[250px]  flex flex-col">
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
        <article class="bg-white rounded-xl p-4 shadow-[0_0_15px_3px_rgba(0,54,94,0.25)] h-[250px]  flex flex-col">
          <h3 class="font-bold text-lg mb-4">Informasi Tambahan</h3>
          <div class="flex flex-col items-center">
          <img alt="Donut chart" class="mb-4 w-24 h-24" src="https://storage.googleapis.com/a1aa/image/24cd5fc5-11c7-47e9-10d9-63935038b526.jpg"/>
            <ul class="w-full h-full grid grid-cols-2 gap-2 text-sm text-[#000]">
              <li class="flex items-center gap-2">
                <span class="inline-block w-4 h-4 bg-[#5bc0f8] rounded-sm"></span> Sandang
              </li>
              <li class="flex items-center gap-2">
                <span class="inline-block w-4 h-4 bg-[#d9e9fb] rounded-sm"></span> Kimia
              </li>
              <li class="flex items-center gap-2">
                <span class="inline-block w-4 h-4 bg-[#1a1a1a] rounded-sm"></span> Pangan
              </li>
              <li class="flex items-center gap-2">
                <span class="inline-block w-4 h-4 bg-[#f3f3f3] rounded-sm"></span> Kerajinan
              </li>
            </ul>
          </div>
        </article>
      </section>


      <!-- Grafik Perkembangan card -->
      <section class="bg-white rounded-xl h-[220px] p-6 shadow-[0_10px_15px_-3px_rgba(7,55,99,0.3)] mt-6">
        <h3 class="font-bold text-lg mb-4">Grafik Perkembangan</h3>
        <img alt="Line chart" class="w-full h-[120px] object-cover" src="https://storage.googleapis.com/a1aa/image/78a049f8-cc3e-47be-f19c-4e69b0c2b4b7.jpg"/>
      </section>
    </div>
  </div>
</div>

@endsection