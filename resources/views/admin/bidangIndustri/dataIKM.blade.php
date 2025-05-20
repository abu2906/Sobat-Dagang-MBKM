@extends('layouts.adminIndustri')
@section('title', 'Data IKM')

@section('content')
<main class="flex-1 flex flex-col bg-gray-100 min-h-screen">
  <header class="relative z-10">
    <img src="{{ asset('/assets/img/background/user_industri.png') }}" class="w-full h-[210px] object-cover" alt="Header">
    
    <div class="absolute bottom-0 left-1/2 transform -translate-x-1/2 translate-y-1/2 w-11/12 bg-white rounded-xl shadow-lg px-6 py-4 flex flex-wrap justify-between gap-4 items-center z-20">
      <div class="flex items-center bg-[#CAE2F6] rounded-lg px-4 py-2 flex-1 shadow-md">
        <span class="material-symbols-outlined text-gray-500 mr-2"></span>
        <input type="text" placeholder="Cari" class="bg-transparent w-full focus:outline-none">
      </div>

      <div class="relative w-48">
        <select id="filterKecamatan" onchange="filterTabel()" class="appearance-none bg-[#CAE2F6] rounded-lg px-4 py-2 pr-8 w-full focus:outline-none shadow-md">
          <option value="">Kecamatan</option>
          <option value="Soreang">Soreang</option>
          <option value="Ujung">Ujung</option>
          <option value="Bacukiki">Bacukiki</option>
        </select>
        <i class="fas fa-sliders-h absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none w-4 h-4"></i>
      </div>

      <div class="relative w-48">
        <select id="filterInvestasi" onchange="filterTabel()" class="appearance-none bg-[#CAE2F6] rounded-lg px-4 py-2 pr-8 w-full focus:outline-none shadow-md">
          <option value="">Investasi</option>
          <option value="Kecil">Kecil</option>
          <option value="Menengah">Menengah</option>
          <option value="Besar">Besar</option>
        </select>
        <i class="fas fa-sliders-h absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none w-4 h-4"></i>
      </div>

        <a href="{{ route('admin.industri.formIKM') }}"
           class="bg-[#003366] text-white font-semibold rounded-lg px-4 py-2 shadow-md hover:bg-white hover:text-[#003366] border border-transparent hover:border-[#003366] transition duration-300">
          TAMBAH DATA
        </a>

    </div>
  </header>

    <section class="mt-20 px-4 flex flex-wrap justify-center gap-4">
      @php
        $kategoriList = [
          ['nama' => 'Sandang', 'ikon' => 'sandang.png'],
          ['nama' => 'Pangan', 'ikon' => 'pangan.png'],
          ['nama' => 'Kimia & Bangunan', 'ikon' => 'kimia.png'],
          ['nama' => 'Logam & Elektronika', 'ikon' => 'logam.png'],
          ['nama' => 'Kerajinan', 'ikon' => 'kerajinan.png']
        ];
      @endphp

      @foreach ($kategoriList as $kategori)
        <div onclick="selectKategori(this)" class="kategori-card cursor-pointer flex flex-col items-center bg-white p-3 rounded-xl shadow-lg w-44 border-2 border-transparent transition transform hover:scale-105 text-center">
          <img src="{{ asset('assets/img/kategori/' . $kategori['ikon']) }}" alt="{{ $kategori['nama'] }} Icon" class="w-10 h-10 object-contain">
          <span class="font-semibold mt-1 text-[#083458] leading-tight min-h-[2rem] flex items-center justify-center text-center">
            {{ $kategori['nama'] }}
          </span>
          <span class="text-sm text-gray-500">200</span>
        </div>
      @endforeach
    </section>




  <section class="mt-12 px-6 pb-16">
    <div class="overflow-x-auto rounded-lg">
      <table class="w-full border-collapse text-sm bg-white shadow-md">
        <thead>
          <tr class="text-white bg-[#083458]">
            <th class="p-3 rounded-tl-xl">NO.</th>
            <th class="p-3">NAMA USAHA</th>
            <th class="p-3">NAMA PEMILIK</th>
            <th class="p-3">JENIS KELAMIN</th>
            <th class="p-3">JALAN</th>
            <th class="p-3">DESA/KELURAHAN</th>
            <th class="p-3">KECAMATAN</th>
            <th class="p-3">KABUPATEN/KOTA</th>
            <th class="p-3">TELEPON/FAX</th>
            <th class="p-3">BENTUK USAHA</th>
            <th class="p-3">TAHUN IZIN</th>
            <th class="p-3 rounded-tr-xl">KBLI</th>
          </tr>
        </thead>
        <tbody>
          <tr class="bg-white border-b">
            <td class="p-2 text-center">1</td>
            <td class="p-2">US. Reski</td>
            <td class="p-2">Rahkmat Qadri</td>
            <td class="p-2 text-center">L</td>
            <td class="p-2">JL. LASINRANG</td>
            <td class="p-2">Lakesi</td>
            <td class="p-2">Soreang</td>
            <td class="p-2">Parepare</td>
            <td class="p-2">-</td>
            <td class="p-2">PO</td>
            <td class="p-2">2016</td>
            <td class="p-2 text-center">10130</td>
          </tr>

          <tr class="bg-white border-b">
            <td class="p-2 text-center">2</td>
            <td class="p-2">US. bojo</td>
            <td class="p-2">Samsul</td>
            <td class="p-2 text-center">L</td>
            <td class="p-2">JL. PEMBANGUNAN</td>
            <td class="p-2">Lakesi</td>
            <td class="p-2">Soreang</td>
            <td class="p-2">Parepare</td>
            <td class="p-2">082335667112</td>
            <td class="p-2">PO</td>
            <td class="p-2">2021</td>
            <td class="p-2 text-center">10120</td>
          </tr>
          <!-- Tambahkan baris lainnya sesuai kebutuhan -->
        </tbody>
      </table>
    </div>
  </section>
</main>
@endsection

@section('scripts')
  <script>
    let kategoriDipilih = '';
    function selectKategori(el) {
      const allCards = document.querySelectorAll('#kategoriContainer div, .kategori-card');
      allCards.forEach(card => {
        card.classList.remove('bg-[#CAE2F6]', 'border-[#003366]', 'border-2');
      });

      el.classList.add('bg-[#CAE2F6]', 'border-[#003366]', 'border-2');
      kategoriDipilih = el.querySelector('.font-semibold').textContent;
      console.log('Kategori dipilih: ', kategoriDipilih);
    }
  </script>
@endsection