@extends('layouts.adminIndustri')
@section('title', 'Form Data IKM')

@section('content')
<main class="flex-1 flex flex-col bg-gray-100 min-h-screen">
  <header class="relative z-10">
    <img src="{{ asset('/assets/img/background/user_industri.png') }}" class="w-full h-[210px] object-cover" alt="Header">

    <section class="bg-[#f0f4f9] flex justify-center items-start pt-6">
  <div class="w-full max-w-[1200px] m-4 px-6 bg-white rounded-2xl shadow-md">
@php
  $tabs = [
    ['id' => 'btn-data-ikm', 'label' => 'DATA IKM'],
    ['id' => 'btn-persentase-pemilik', 'label' => 'PERSENTASE PEMILIK'],
    ['id' => 'btn-karyawan', 'label' => 'KARYAWAN'],
    ['id' => 'btn-pemakaian-bahan', 'label' => 'PEMAKAIAN BAHAN'],
    ['id' => 'btn-penggunaan-air', 'label' => 'PENGGUNAAN AIR'],
    ['id' => 'btn-pengeluaran', 'label' => 'PENGELUARAN'],
    ['id' => 'btn-penggunaan-bahan-bakar', 'label' => 'BAHAN BAKAR'],
    ['id' => 'btn-listrik', 'label' => 'LISTRIK'],
    ['id' => 'btn-mesin-produksi', 'label' => 'MESIN PRODUKSI'],
    ['id' => 'btn-produksi', 'label' => 'PRODUKSI'],
    ['id' => 'btn-persediaan', 'label' => 'PERSEDIAAN'],
    ['id' => 'btn-pendapatan', 'label' => 'PENDAPATAN'],
    ['id' => 'btn-bentuk-pengelolaan', 'label' => 'BENTUK PENGELOLAAN'],
  ];
  $activeTab = 'btn-data-ikm'; // default tab aktif
@endphp

<div class="flex flex-wrap justify-center gap-2 border-b border-blue-300 bg-[#f9fbfe] px-4 pt-4">
  @foreach ($tabs as $tab)
    <button
      id="{{ $tab['id'] }}"
      class="tab-button relative px-4 py-2 text-sm font-medium rounded-t-xl
        {{ $tab['id'] === $activeTab ? 'bg-blue-100 text-white font-bold after:content-[""] after:absolute after:bottom-0 after:left-0 after:right-0 after:h-1 after:bg-blue-600 after:rounded-t' : 'bg-[#083458] text-white hover:bg-blue-900' }}">
      {{ $tab['label'] }}
    </button>
  @endforeach
</div>






      <div class="p-10">
        <section id="tab-content" class="bg-[#d0e6ff] rounded-2xl p-10 min-h-[200px] text-center text-blue-900 text-xl font-semibold shadow-inner">
          <form id="form-data-ikm" class="relative z-0 grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
            <div>
              <label class="block mb-1 font-medium">Nama Usaha</label>
              <input type="text" required class="border border-black outline-black p-2 rounded-2xl w-full focus:outline-2">
            </div>
            <div>
              <label class="block mb-1 font-medium">Luas Usaha</label>
              <input type="text" required class="border border-black outline-black  p-2 rounded-2xl w-full focus:outline-2">
            </div>
            <div>
              <label class="block mb-1 font-medium">Nama Pemilik</label>
              <input type="text" required class="border border-black outline-black  p-2 rounded-2xl w-full focus:outline-2">
            </div>
            <div>
              <label class="block mb-1 font-medium">Jenis Industri</label>
              <select required class="border border-black outline-black  p-2 rounded-2xl w-full focus:outline-2">
                <option disabled selected value="">Pilih Jenis Industri</option>
                <option value="Pemerintah Pusat">industri 1</option>
                <option value="Pemerintah Daerah">industri 2</option>
                <option value="Swasta Nasional">industri 3</option>
              </select>
            </div>
            <div>
              <label class="block mb-1 font-medium">Kecamatan</label>
              <select required class="border border-black outline-black  p-2 rounded-2xl w-full focus:outline-2">
                <option disabled selected value="">Pilih Kecamatan</option>
                <option value="Kecamatan 1">Kecamatan 1</option>
                <option value="Kecamatan 2">Kecamatan 2</option>
                <option value="Kecamatan 3">Kecamatan 3</option>
              </select>
            </div>
            <div>
              <label class="block mb-1 font-medium">Komoditi</label>
              <select required class="border border-black outline-black  p-2 rounded-2xl w-full focus:outline-2">
                <option disabled selected value="">Pilih Komoditi</option>
                <option value="Komoditi 1">Komoditi 1</option>
                <option value="Komoditi 2">Komoditi 2</option>
                <option value="Komoditi 3">Komoditi 3</option>
              </select>
            </div>
            <div>
              <label class="block mb-1 font-medium">Kelurahan</label>
              <select required class="border border-black outline-black  p-2 rounded-2xl w-full focus:outline-2">
                <option disabled selected value="">Pilih Kelurahan</option>
                <option value="Kelurahan 1">Kelurahan 1</option>
                <option value="Kelurahan 2">Kelurahan 2</option>
                <option value="Kelurahan 3">Kelurahan 3</option>
              </select>
            </div>
            <div>
              <label class="block mb-1 font-medium">NIB (Nomor Induk Berusaha)</label>
              <input type="text" required class="border border-black outline-black  p-2 rounded-2xl w-full focus:outline-2">
            </div>
            <div>
              <label class="block mb-1 font-medium">Alamat</label>
              <input type="text" required class="border border-black outline-black  p-2 rounded-2xl w-full focus:outline-2">
            </div>
            <div>
              <label class="block mb-1 font-medium">Tenaga Kerja (Orang)</label>
              <div class="flex space-x-2">
                <input type="number" min="0" placeholder="Perempuan" required class="border border-black outline-black  p-2 rounded-2xl w-1/2 focus:outline-2">
                <input type="number" min="0" placeholder="Laki-laki" required class="border border-black outline-black  p-2 rounded-2xl w-1/2 focus:outline-2">
              </div>
            </div>
            <div>
              <label class="block mb-1 font-medium">Nomor HP/Telepon</label>
              <input type="tel" required class="border border-black outline-black  p-2 rounded-2xl w-full focus:outline-2">
            </div>
            <div>
              <label class="block mb-1 font-medium">Nilai Investasi</label>
              <input type="text" required class="border border-black outline-black  p-2 rounded-2xl w-full focus:outline-2">
            </div>
            <div class="col-span-1 md:col-span-2 flex justify-center gap-4 mt-6">
              <button type="button" class="bg-[#083458] text-white px-6 py-2 rounded-3xl hover:opacity-90">Draft</button>
              <button type="submit" class="bg-[#083458] text-white px-6 py-2 rounded-3xl hover:opacity-90">Selanjutnya</button>
            </div>
          </form>

          <form id="form-persentase-pemilik" class="hidden relative z-0 grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
            <div>
              <label class="block mb-1 font-medium">Pemerintah Pusat (%)</label>
              <input type="number" min="0" max="100" step="1" placeholder="0" required 
                    class="border border-black outline-black p-2 rounded-2xl w-full focus:outline-2">
            </div>
            <div>
              <label class="block mb-1 font-medium">Pemerintah Daerah (%)</label>
              <input type="number" min="0" max="100" step="1" placeholder="0" required 
                    class="border border-black outline-black p-2 rounded-2xl w-full focus:outline-2">
            </div>
            <div>
              <label class="block mb-1 font-medium">Swasta Nasional (%)</label>
              <input type="number" min="0" max="100" step="1" placeholder="0" required 
                    class="border border-black outline-black p-2 rounded-2xl w-full focus:outline-2">
            </div>
            <div>
              <label class="block mb-1 font-medium">Asing (%)</label>
              <input type="number" min="0" max="100" step="1" placeholder="0" required 
                    class="border border-black outline-black p-2 rounded-2xl w-full focus:outline-2">
            </div>
            <div class="col-span-1 md:col-span-2 flex justify-center gap-4 mt-6">
              <button type="button" class="bg-[#083458] text-white px-6 py-2 rounded-3xl hover:opacity-90">Draft</button>
              <button type="submit" class="bg-[#083458] text-white px-6 py-2 rounded-3xl hover:opacity-90">Selanjutnya</button>
            </div>
          </form>
          
          <form id="form-karyawan" class="hidden relative z-0 grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
            <div class="flex flex-col">
              <label for="nama_karyawan" class="mb-2 font-medium text-gray-700">Nama</label>
              <input
                type="text"
                id="nama_karyawan"
                name="nama_karyawan"
                required
                class="border border-black outline-black p-2 rounded-2xl w-full focus:outline-2"
                placeholder="Masukkan Nama Karyawan"
              >
            </div>

            <div class="flex flex-col">
              <label for="jenis_kelamin" class="mb-2 font-medium text-gray-700">Jenis Kelamin</label>
              <select
                id="jenis_kelamin"
                name="jenis_kelamin"
                class="border border-black outline-black p-2 rounded-2xl w-full focus:outline-2"
                required
              >
                <option value="" disabled selected>-- Pilih Jenis Kelamin --</option>
                <option value="Laki-laki">Laki-laki</option>
                <option value="Perempuan">Perempuan</option>
              </select>
            </div>

            <div class="flex flex-col">
              <label for="tingkat_pendidikan" class="mb-2 font-medium text-gray-700">Tingkat Pendidikan</label>
              <select
                id="tingkat_pendidikan"
                name="tingkat_pendidikan"
                class="border border-black outline-black p-2 rounded-2xl w-full focus:outline-2"
                required
              >
                <option value="" disabled selected>-- Pilih Tingkat Pendidikan --</option>
                <option value="SD">SD</option>
                <option value="SMP">SMP</option>
                <option value="SMA/SMK">SMA/SMK</option>
                <option value="D3">D3</option>
                <option value="S1">S1</option>
                <option value="S2">S2</option>
                <option value="S3">S3</option>
              </select>
            </div>

            <div class="flex flex-col">
              <label for="status" class="mb-2 font-medium text-gray-700">Status</label>
              <select
                id="status"
                name="status"
                class="border border-black outline-black p-2 rounded-2xl w-full focus:outline-2"
                required
              >
                <option value="" disabled selected>-- Pilih Status --</option>
                <option value="Tetap">Tetap</option>
                <option value="Kontrak">Kontrak</option>
                <option value="Magang">Magang</option>
              </select>
            </div>

            <div class="col-span-1 md:col-span-2 flex justify-center gap-4 mt-6">
              <button
                type="button"
                class="bg-[#083458] text-white px-6 py-2 rounded-3xl hover:opacity-90"
              >Draft</button>
              <button
                type="submit"
                class="bg-[#083458] text-white px-6 py-2 rounded-3xl hover:opacity-90"
              >Selanjutnya</button>
            </div>
          </form>

          <form id="form-pemakaian-bahan" class="hidden relative z-0 grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
            <div>
              <label class="block mb-1 font-medium">Nama Bahan Baku</label>
              <input type="text" name="nama_bahan" required class="border border-black outline-black p-2 rounded-2xl w-full focus:outline-2">
            </div>

            <div>
              <label class="block mb-1 font-medium">Jenis Bahan Baku</label>
              <input type="text" name="jenis_bahan" required class="border border-black outline-black p-2 rounded-2xl w-full focus:outline-2">
            </div>

            <div>
              <label class="block mb-1 font-medium">Spesifikasi</label>
              <input type="text" name="spesifikasi" required class="border border-black outline-black p-2 rounded-2xl w-full focus:outline-2">
            </div>

            <div>
              <label class="block mb-1 font-medium">Kode HS</label>
              <input type="text" name="kode_hs" required class="border border-black outline-black p-2 rounded-2xl w-full focus:outline-2">
            </div>

            <div>
              <label class="block mb-1 font-medium">Satuan Standar</label>
              <input type="text" name="satuan" required class="border border-black outline-black p-2 rounded-2xl w-full focus:outline-2">
            </div>

            <div>
              <label class="block mb-1 font-medium">Dalam Negeri (Jumlah)</label>
              <input type="number" name="dalam_negeri" min="0" required class="border border-black outline-black p-2 rounded-2xl w-full focus:outline-2">
            </div>

            <div>
              <label class="block mb-1 font-medium">Impor (Jumlah)</label>
              <input type="number" name="import" min="0" required class="border border-black outline-black p-2 rounded-2xl w-full focus:outline-2">
            </div>

            <div class="col-span-1 md:col-span-2 flex justify-center gap-4 mt-6">
              <button type="button" class="bg-[#083458] text-white px-6 py-2 rounded-3xl hover:opacity-90">Draft</button>
              <button type="submit" class="bg-[#083458] text-white px-6 py-2 rounded-3xl hover:opacity-90">Selanjutnya</button>
            </div>
          </form>

          <div id="form-penggunaan-air" class="hidden mt-4">
          <form action="#" method="POST" class="space-y-4">
              @csrf
              <div>
                  <label class="block mb-1 font-medium">Sumber Air</label>
                  <input type="text" id="jenis_pengeluaran" name="jenis_pengeluaran"
                      required class="border border-black outline-black p-2 rounded-2xl w-full focus:outline-2">
              </div>

              <div>
                <label class="block mb-1 font-medium">Banyaknya Penggunaan (m³)</label>
                <input type="number" name="banyaknya_penggunaan" min="0" required class="border border-black outline-black p-2 rounded-2xl w-full focus:outline-2">
              </div>

              <div>
                <label class="block mb-1 font-medium">Biaya (Rp)</label>
                <input type="number" name="biaya" min="0" required class="border border-black outline-black p-2 rounded-2xl w-full focus:outline-2">
              </div>

              <div class="col-span-1 md:col-span-2 flex justify-center gap-4 mt-6">
            <button type="button" class="bg-[#083458] text-white px-6 py-2 rounded-3xl hover:opacity-90">Draft</button>
            <button type="submit" class="bg-[#083458] text-white px-6 py-2 rounded-3xl hover:opacity-90">Selanjutnya</button>
          </div>
          </form>
      </div>

      <div id="form-pengeluaran" class="hidden mt-4">
        <form action="#" method="POST" class="space-y-4">
            @csrf
            <div>
                <label for="jenis_pengeluaran" class="block text-sm font-medium text-gray-700">Jenis Pengeluaran</label>
                <input type="text" id="jenis_pengeluaran" name="jenis_pengeluaran"
                  required class="border border-black outline-black p-2 rounded-2xl w-full focus:outline-2">
            </div>

            <div>
                <label for="nominal" class="block text-sm font-medium text-gray-700">Nominal (Rp)</label>
                <input type="number" id="nominal" name="nominal"
                  required class="border border-black outline-black p-2 rounded-2xl w-full focus:outline-2">
            </div>

            <div class="col-span-1 md:col-span-2 flex justify-center gap-4 mt-6">
          <button type="button" class="bg-[#083458] text-white px-6 py-2 rounded-3xl hover:opacity-90">Draft</button>
          <button type="submit" class="bg-[#083458] text-white px-6 py-2 rounded-3xl hover:opacity-90">Selanjutnya</button>
        </div>
        </form>
    </div>

    <div id="form-penggunaan-bahan-bakar" class="hidden mt-4">
      <form action="#" method="POST" class="space-y-4">
        @csrf
        <div>
          <label class="block mb-1 font-medium">Jenis Bahan Bakar</label>
          <input type="text" id="jenis_bahan_bakar" name="jenis_bahan_bakar"
                required class="border border-black outline-black p-2 rounded-2xl w-full focus:outline-2">
        </div>
        <div>
          <label class="block mb-1 font-medium">Satuan Standar</label>
          <input type="text" id="satuan_standar" name="satuan_standar"
                required class="border border-black outline-black p-2 rounded-2xl w-full focus:outline-2">
        </div>
        <div>
          <label class="block mb-1 font-medium">Proses Produksi</label>
          <input type="text" id="proses_produksi" name="proses_produksi"
                required class="border border-black outline-black p-2 rounded-2xl w-full focus:outline-2">
        </div>
        <div>
          <label class="block mb-1 font-medium">Pembangkit Listrik</label>
          <input type="text" id="pembangkit_listrik" name="pembangkit_listrik"
                required class="border border-black outline-black p-2 rounded-2xl w-full focus:outline-2">
        </div>
        <div class="col-span-1 md:col-span-2 flex justify-center gap-4 mt-6">
          <button type="button" class="bg-[#083458] text-white px-6 py-2 rounded-3xl hover:opacity-90">Draft</button>
          <button type="submit" class="bg-[#083458] text-white px-6 py-2 rounded-3xl hover:opacity-90">Selanjutnya</button>
        </div>
      </form>
    </div>

    <div id="form-listrik" class="hidden mt-4">
      <form action="#" method="POST" class="space-y-4">
        @csrf
        <div>
          <label class="block mb-1 font-medium">Sumber Listrik</label>
          <input type="text" id="sumber_listrik" name="sumber_listrik"
                required class="border border-black outline-black p-2 rounded-2xl w-full focus:outline-2">
        </div>
        <div>
          <label class="block mb-1 font-medium">Banyaknya Penggunaan (kWh)</label>
          <input type="number" name="banyaknya_penggunaan_listrik" min="0" required class="border border-black outline-black p-2 rounded-2xl w-full focus:outline-2">
        </div>
        <div>
          <label class="block mb-1 font-medium">Nilai Penggunaan (Rp)</label>
          <input type="number" name="nilai_penggunaan_listrik" min="0" required class="border border-black outline-black p-2 rounded-2xl w-full focus:outline-2">
        </div>
        <div>
          <label class="block mb-1 font-medium">Peruntukkan Listrik</label>
          <input type="text" id="peruntukkan_listrik" name="peruntukkan_listrik"
                required class="border border-black outline-black p-2 rounded-2xl w-full focus:outline-2">
        </div>
        <div class="col-span-1 md:col-span-2 flex justify-center gap-4 mt-6">
          <button type="button" class="bg-[#083458] text-white px-6 py-2 rounded-3xl hover:opacity-90">Draft</button>
          <button type="submit" class="bg-[#083458] text-white px-6 py-2 rounded-3xl hover:opacity-90">Selanjutnya</button>
        </div>
        </form>
        </div>

        <form id="form-mesin-produksi" class="hidden relative z-0 grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
          <div>
            <label class="block mb-1 font-medium">Jenis Mesin/Peralatan</label>
            <input
              type="text"
              id="jenis_mesin"
              name="jenis_mesin"
              required
              class="border border-black outline-black p-2 rounded-2xl w-full focus:outline-2"
              placeholder="Masukkan Jenis Mesin/Peralatan"
            >
          </div>

          <div>
            <label class="block mb-1 font-medium">Nama Mesin/Peralatan</label>
            <input
              type="text"
              id="nama_mesin"
              name="nama_mesin"
              required
              class="border border-black outline-black p-2 rounded-2xl w-full focus:outline-2"
              placeholder="Masukkan Nama Mesin/Peralatan"
            >
          </div>

          <div>
            <label class="block mb-1 font-medium">Merk/Type</label>
            <input
              type="text"
              id="merk_type"
              name="merk_type"
              required
              class="border border-black outline-black p-2 rounded-2xl w-full focus:outline-2"
              placeholder="Masukkan Merk/Type Mesin"
            >
          </div>

          <div>
            <label class="block mb-1 font-medium">Teknologi</label>
            <input
              type="text"
              id="teknologi"
              name="teknologi"
              required
              class="border border-black outline-black p-2 rounded-2xl w-full focus:outline-2"
              placeholder="Masukkan Teknologi"
            >
          </div>

          <div>
            <label class="block mb-1 font-medium">Negara Pembuat</label>
            <input
              type="text"
              id="negara_pembuat"
              name="negara_pembuat"
              required
              class="border border-black outline-black p-2 rounded-2xl w-full focus:outline-2"
              placeholder="Masukkan Negara Pembuat"
            >
          </div>

          <div>
            <label class="block mb-1 font-medium">Tahun Perolehan</label>
            <input
              type="number"
              id="tahun_perolehan"
              name="tahun_perolehan"
              required
              class="border border-black outline-black p-2 rounded-2xl w-full focus:outline-2"
              placeholder="Masukkan Tahun Perolehan"
            >
          </div>

          <div>
            <label class="block mb-1 font-medium">Tahun Pembuatan</label>
            <input
              type="number"
              id="tahun_pembuatan"
              name="tahun_pembuatan"
              required
              class="border border-black outline-black p-2 rounded-2xl w-full focus:outline-2"
              placeholder="Masukkan Tahun Pembuatan"
            >
          </div>

          <div>
            <label class="block mb-1 font-medium">Banyaknya</label>
            <input
              type="number"
              id="banyaknya"
              name="banyaknya"
              min="0"
              required
              class="border border-black outline-black p-2 rounded-2xl w-full focus:outline-2"
              placeholder="Masukkan Banyaknya"
            >
          </div>

          <div class="col-span-1 md:col-span-2 flex justify-center gap-4 mt-6">
            <button
              type="button"
              class="bg-[#083458] text-white px-6 py-2 rounded-3xl hover:opacity-90"
            >Draft</button>
            <button
              type="submit"
              class="bg-[#083458] text-white px-6 py-2 rounded-3xl hover:opacity-90"
            >Selanjutnya</button>
          </div>
        </form>
<form id="form-produksi" class="hidden relative z-0 grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
  <div>
    <label class="block mb-1 font-medium">Jenis Produksi</label>
    <input
      type="text"
      id="jenis_produksi"
      name="jenis_produksi"
      required
      class="border border-black outline-black p-2 rounded-2xl w-full focus:outline-2"
      placeholder="Masukkan Jenis Produksi"
    >
  </div>

  <div>
    <label class="block mb-1 font-medium">KBLI (Kode Bisnis dan Layanan Indonesia)</label>
    <input
      type="text"
      id="kbli"
      name="kbli"
      required
      class="border border-black outline-black p-2 rounded-2xl w-full focus:outline-2"
      placeholder="Masukkan KBLI"
    >
  </div>

  <div>
    <label class="block mb-1 font-medium">Kode HS (Harmonized System)</label>
    <input
      type="text"
      id="kode_hs"
      name="kode_hs"
      required
      class="border border-black outline-black p-2 rounded-2xl w-full focus:outline-2"
      placeholder="Masukkan Kode HS"
    >
  </div>

  <div>
    <label class="block mb-1 font-medium">Spesifikasi</label>
    <input
      type="text"
      id="spesifikasi"
      name="spesifikasi"
      required
      class="border border-black outline-black p-2 rounded-2xl w-full focus:outline-2"
      placeholder="Masukkan Spesifikasi Produksi"
    >
  </div>

  <div>
    <label class="block mb-1 font-medium">Banyaknya</label>
    <input
      type="number"
      id="banyaknya_produksi"
      name="banyaknya_produksi"
      min="0"
      required
      class="border border-black outline-black p-2 rounded-2xl w-full focus:outline-2"
      placeholder="Masukkan Banyaknya Produksi"
    >
  </div>

  <div>
    <label class="block mb-1 font-medium">Nilai</label>
    <input
      type="text"
      id="nilai_produksi"
      name="nilai_produksi"
      required
      class="border border-black outline-black p-2 rounded-2xl w-full focus:outline-2"
      placeholder="Masukkan Nilai Produksi"
    >
  </div>

  <div>
    <label class="block mb-1 font-medium">Satuan</label>
    <input
      type="text"
      id="satuan"
      name="satuan"
      required
      class="border border-black outline-black p-2 rounded-2xl w-full focus:outline-2"
      placeholder="Masukkan Satuan"
    >
  </div>

  <div>
    <label class="block mb-1 font-medium">Persentase Produk yang Diekspor</label>
    <input
      type="number"
      id="persentase_ekspor"
      name="persentase_ekspor"
      min="0"
      max="100"
      required
      class="border border-black outline-black p-2 rounded-2xl w-full focus:outline-2"
      placeholder="Masukkan Persentase Produk yang Diekspor"
    >
  </div>

  <div>
    <label class="block mb-1 font-medium">Negara Tujuan Ekspor</label>
    <input
      type="text"
      id="negara_ekspor"
      name="negara_ekspor"
      required
      class="border border-black outline-black p-2 rounded-2xl w-full focus:outline-2"
      placeholder="Masukkan Negara Tujuan Ekspor"
    >
  </div>

  <div>
    <label class="block mb-1 font-medium">Kapasitas Terpasang per Tahun</label>
    <input
      type="number"
      id="kapasitas_tahun"
      name="kapasitas_tahun"
      min="0"
      required
      class="border border-black outline-black p-2 rounded-2xl w-full focus:outline-2"
      placeholder="Masukkan Kapasitas Terpasang per Tahun"
    >
  </div>

  <div class="col-span-1 md:col-span-2 flex justify-center gap-4 mt-6">
    <button
      type="button"
      class="bg-[#083458] text-white px-6 py-2 rounded-3xl hover:opacity-90"
    >Draft</button>
    <button
      type="submit"
      class="bg-[#083458] text-white px-6 py-2 rounded-3xl hover:opacity-90"
    >Selanjutnya</button>
  </div>
</form>

<div id="form-persediaan" class="hidden mt-4">
  <form action="#" method="POST" class="space-y-4">
      @csrf
      <div>
          <label class="block mb-1 font-medium">Jenis Persediaan</label>
          <input type="text" id="jenis_persediaan" name="jenis_persediaan"
              required class="border border-black outline-black p-2 rounded-2xl w-full focus:outline-2">
      </div>

      <div>
          <label class="block mb-1 font-medium">Awal (Rp)</label>
          <input type="number" name="awal_rp" min="0" required class="border border-black outline-black p-2 rounded-2xl w-full focus:outline-2">
      </div>

      <div>
          <label class="block mb-1 font-medium">Akhir (Rp)</label>
          <input type="number" name="akhir_rp" min="0" required class="border border-black outline-black p-2 rounded-2xl w-full focus:outline-2">
      </div>

      <div class="col-span-1 md:col-span-2 flex justify-center gap-4 mt-6">
          <button type="button" class="bg-[#083458] text-white px-6 py-2 rounded-3xl hover:opacity-90">Draft</button>
          <button type="submit" class="bg-[#083458] text-white px-6 py-2 rounded-3xl hover:opacity-90">Selanjutnya</button>
      </div>
  </form>
</div>

<div id="form-pendapatan" class="hidden mt-4">
  <form action="#" method="POST" class="space-y-4">
      @csrf
      <div>
          <label class="block mb-1 font-medium">Nilai (Rp)</label>
          <input type="number" name="nilai" min="0" required class="border border-black outline-black p-2 rounded-2xl w-full focus:outline-2">
      </div>

      <div>
          <label class="block mb-1 font-medium">Sumber</label>
          <input type="text" name="sumber" required class="border border-black outline-black p-2 rounded-2xl w-full focus:outline-2">
      </div>

      <div class="col-span-1 md:col-span-2 flex justify-center gap-4 mt-6">
          <button type="button" class="bg-[#083458] text-white px-6 py-2 rounded-3xl hover:opacity-90">Draft</button>
          <button type="submit" class="bg-[#083458] text-white px-6 py-2 rounded-3xl hover:opacity-90">Selanjutnya</button>
      </div>
  </form>
</div>

<div id="form-bentuk-pengelolaan" class="hidden mt-4">
  <form action="#" method="POST" class="space-y-4">
      @csrf
      <div>
          <label class="block mb-1 font-medium">Dikumpulkan di TPS</label>
          <input type="text" name="dikumpulkan_di_tps" required class="border border-black outline-black p-2 rounded-2xl w-full focus:outline-2" placeholder="Masukkan lokasi TPS">
      </div>

      <div>
          <label class="block mb-1 font-medium">Dikerjasamakan dengan Pihak Lain yang Telah Berizin</label>
          <input type="text" name="dikerjasamakan_dengan_pihak_lain" required class="border border-black outline-black p-2 rounded-2xl w-full focus:outline-2" placeholder="Masukkan pihak yang diajak kerjasama">
      </div>

      <div>
          <label class="block mb-1 font-medium">Dimanfaatkan untuk Internal Industri</label>
          <input type="text" name="dimanfaatkan_untuk_internal_industri" required class="border border-black outline-black p-2 rounded-2xl w-full focus:outline-2" placeholder="Masukkan tujuan pemanfaatan untuk industri">
      </div>

      <div class="col-span-1 md:col-span-2 flex justify-center gap-4 mt-6">
          <button type="button" class="bg-[#083458] text-white px-6 py-2 rounded-3xl hover:opacity-90">Draft</button>
          <button type="submit" class="bg-[#083458] text-white px-6 py-2 rounded-3xl hover:opacity-90">Selanjutnya</button>
      </div>
  </form>
</div>


        </section>
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const tabs = document.querySelectorAll('.tab-button');
    const contents = {
      'btn-data-ikm': document.getElementById('form-data-ikm'),
      'btn-persentase-pemilik': document.getElementById('form-persentase-pemilik'),
      'btn-karyawan': document.getElementById('form-karyawan'),
      'btn-pemakaian-bahan': document.getElementById('form-pemakaian-bahan'),
      'btn-penggunaan-air': document.getElementById('form-penggunaan-air'),
      'btn-pengeluaran': document.getElementById('form-pengeluaran'),
      'btn-penggunaan-bahan-bakar': document.getElementById('form-penggunaan-bahan-bakar'),
      'btn-listrik': document.getElementById('form-listrik'),
      'btn-mesin-produksi': document.getElementById('form-mesin-produksi'),
      'btn-produksi': document.getElementById('form-produksi'),
      'btn-persediaan': document.getElementById('form-persediaan'),
      'btn-pendapatan': document.getElementById('form-pendapatan'),
      'btn-bentuk-pengelolaan': document.getElementById('form-bentuk-pengelolaan'),
    };

    tabs.forEach(tab => {
      tab.addEventListener('click', () => {
        tabs.forEach(t => {
          t.classList.remove(
            'bg-blue-100', 'text-white', 'font-bold',
            'after:content-[""]', 'after:absolute', 'after:bottom-0',
            'after:left-0', 'after:right-0', 'after:h-1',
            'after:bg-blue-600', 'after:rounded-t'
          );
          t.classList.add('bg-[#083458]', 'text-white');
        });


        tab.classList.remove('bg-[#083458]');
        tab.classList.add(
          'bg-blue-100', 'text-white', 'font-bold',
          'after:content-[""]', 'after:absolute', 'after:bottom-0',
          'after:left-0', 'after:right-0', 'after:h-1',
          'after:bg-blue-600', 'after:rounded-t'
        );

        Object.values(contents).forEach(content => {
          if (content) content.classList.add('hidden');
        });

        // Tampilkan konten tab yang sesuai
        const targetContent = contents[tab.id];
        if (targetContent) targetContent.classList.remove('hidden');
      });
    });
  });
</script>


      </div>
    </div>
  </section>
</main>
@endsection
