@extends('layouts.adminIndustri')
@section('title', 'Form Data IKM')

@section('content')
    <div class="flex h-screen overflow-hidden bg-gray-100">
        <main class="flex-1 flex flex-col overflow-y-auto">
            <header class="relative z-10">
                <img src="{{ asset('/assets/img/background/user_industri.png') }}" class="w-full h-[210px] object-cover"
                    alt="Header">

                <a href="{{ route('admin.industri.dataIKM') }}"
                    class="absolute top-6 right-6 inline-flex items-center gap-1.5 bg-white bg-opacity-90 backdrop-blur-md text-[#083458] font-semibold px-3 py-1.5 rounded-2xl shadow-md hover:bg-[#083458] hover:text-white transition duration-300 text-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 stroke-current" fill="none" viewBox="0 0 24 24"
                        stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                    </svg>
                    Kembali
                </a>
            </header>

            <section class="bg-[#f0f4f9] flex justify-center items-start">
                <div class="w-full max-w-[1200px] m-4 px-6 bg-white rounded-2xl shadow-md">

                    @php
                        $tabs = [
                            ['id' => 'btn-data-ikm', 'label' => 'DATA IKM'],
                            ['id' => 'btn-persentase-pemilik', 'label' => 'PERSENTASE PEMILIK'],
                            ['id' => 'btn-karyawan', 'label' => 'KARYAWAN'],
                            ['id' => 'btn-pemakaian-bahan', 'label' => 'PEMAKAIAN BAHAN'],
                            ['id' => 'btn-penggunaan-air', 'label' => 'PENGGUNAAN AIR'],
                            ['id' => 'btn-pengeluaran', 'label' => 'PENGELUARAN'],
                            ['id' => 'btn-bahan-bakar', 'label' => 'BAHAN BAKAR'],
                            ['id' => 'btn-listrik', 'label' => 'LISTRIK'],
                            ['id' => 'btn-mesin-produksi', 'label' => 'MESIN PRODUKSI'],
                            ['id' => 'btn-produksi', 'label' => 'PRODUKSI'],
                            ['id' => 'btn-persediaan', 'label' => 'PERSEDIAAN'],
                            ['id' => 'btn-pendapatan', 'label' => 'PENDAPATAN'],
                            ['id' => 'btn-modal', 'label' => 'MODAL'],
                            ['id' => 'btn-bentuk-pengelolaan', 'label' => 'BENTUK PENGELOLAAN'],
                        ];
                        $activeTab = 'btn-data-ikm';
                    @endphp

                    <div class="flex flex-wrap justify-center gap-2 border-b border-blue-300 bg-[#f9fbfe] px-4 pt-4">
                        @foreach ($tabs as $tab)
                            <button id="{{ $tab['id'] }}"
                                class="tab-button relative px-4 py-2 text-sm font-medium rounded-t-xl
                                {{ $tab['id'] === $activeTab ? 'bg-blue-100 text-white font-bold after:content-[""] after:absolute after:bottom-0 after:left-0 after:right-0 after:h-1 after:bg-blue-600 after:rounded-t' : 'bg-[#083458] text-white hover:bg-blue-900' }}">
                                {{ $tab['label'] }}
                            </button>
                        @endforeach
                    </div>

                    <div class="p-10 w-3/4 mx-auto flex justify-center">
                        <section id="tab-content"
                            class="inline-block bg-[#d0e6ff] rounded-2xl p-10 min-h-[200px] text-center text-blue-900 text-xl font-normal shadow-inner">
                            <form id="form-ikm" method="POST" action="#">
                                @csrf
                                {{-- DATA IKM --}}
                                <section id="form-data-ikm"
                                    class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm w-full max-w-full overflow-hidden">
                                    <div>
                                        <label class="block mb-1 font-medium">Nama Usaha</label>
                                        <input type="text" required
                                            class="border border-black outline-black p-2 rounded-2xl w-full focus:outline-2"
                                            placeholder="Masukkan Nama Usaha">
                                    </div>
                                    <div>
                                        <label class="block mb-1 font-medium">Luas Usaha</label>
                                        <input type="text" required
                                            class="border border-black outline-black  p-2 rounded-2xl w-full focus:outline-2"
                                            placeholder="Masukkan Luas Usaha">
                                    </div>
                                    <div>
                                        <label class="block mb-1 font-medium">Nama Pemilik</label>
                                        <input type="text" required
                                            class="border border-black outline-black  p-2 rounded-2xl w-full focus:outline-2"
                                            placeholder="Masukkan Nama Pemilik">
                                    </div>
                                    <div>
                                        <label class="block mb-1 font-medium">Jenis Industri</label>
                                        <select required
                                            class="border border-black outline-black  p-2 rounded-2xl w-full focus:outline-2">
                                            <option disabled selected value="">Pilih Jenis Industri</option>
                                            <option value="Sandang">Sandang</option>
                                            <option value="Pangan">Pangan</option>
                                            <option value="Kimia & Bahan Bangunan">Kimia & Bahan Bangunan</option>
                                            <option value="Logam & Elektronika">Logam & Elektronika</option>
                                            <option value="Kerajinan">Kerajinan</option>
                                        </select>
                                    </div>

                                    <div>
                                        <label class="block mb-1 font-medium">Kecamatan</label>
                                        <select id="kecamatan" required
                                            class="border border-black outline-black p-2 rounded-2xl w-full focus:outline-2">
                                            <option value="" disabled selected>Pilih Kecamatan</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label class="block mb-1 font-medium">Kelurahan</label>
                                        <select id="kelurahan" required
                                            class="border border-black outline-black p-2 rounded-2xl w-full focus:outline-2"
                                            disabled>
                                            <option value="" disabled selected>Pilih Kelurahan</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label class="block mb-1 font-medium">Komoditi</label>
                                        <select required
                                            class="border border-black outline-black  p-2 rounded-2xl w-full focus:outline-2">
                                            <option disabled selected value="">Pilih Komoditi</option>
                                            <option value="Komoditi 1">Komoditi 1</option>
                                            <option value="Komoditi 2">Komoditi 2</option>
                                            <option value="Komoditi 3">Komoditi 3</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label class="block mb-1 font-medium">NIB (Nomor Induk Berusaha)</label>
                                        <input type="text" required
                                            class="border border-black outline-black  p-2 rounded-2xl w-full focus:outline-2"
                                            placeholder="Masukkan NIB (Nomor Induk Berusaha)">
                                    </div>
                                    <div>
                                        <label class="block mb-1 font-medium">Alamat</label>
                                        <input type="text" required
                                            class="border border-black outline-black  p-2 rounded-2xl w-full focus:outline-2"
                                            placeholder="Masukkan Alamat">
                                    </div>
                                    <div>
                                        <label class="block mb-1 font-medium">Tenaga Kerja (Orang)</label>
                                        <div class="flex space-x-2">
                                            <input type="number" min="0" placeholder="Laki-laki" required
                                                class="border border-black outline-black  p-2 rounded-2xl w-full md:w-1/2 focus:outline-2">
                                            <input type="number" min="0" placeholder="Perempuan" required
                                                class="border border-black outline-black  p-2 rounded-2xl w-full md:w-1/2 focus:outline-2">
                                        </div>
                                    </div>
                                    <div>
                                        <label class="block mb-1 font-medium">Nomor HP/Telepon</label>
                                        <input type="tel" required
                                            class="border border-black outline-black  p-2 rounded-2xl w-full focus:outline-2"
                                            placeholder="Masukkan Nomor Hp/Telepon">
                                    </div>
                                    <div>
                                        <label class="block mb-1 font-medium">Nilai Investasi</label>
                                        <input type="text" required
                                            class="border border-black outline-black  p-2 rounded-2xl w-full focus:outline-2"
                                            placeholder="Masukkan Nilai Investasi">
                                    </div>
                                    <div class="col-span-1 md:col-span-2 flex justify-center gap-4 mt-6">
                                        <button type="button" id="next-data-ikm"
                                            class="bg-[#083458] text-white px-6 py-2 rounded-3xl hover:opacity-90">Selanjutnya</button>
                                    </div>
                                </section>

                                <script>
                                    const dataWilayah = @json($wilayah['kabupaten'] ?? []);
                                    const parepareKabupaten = dataWilayah.find(kab => kab.name === "Kota Parepare");

                                    const kecamatanSelect = document.getElementById('kecamatan');
                                    const kelurahanSelect = document.getElementById('kelurahan');

                                    if (parepareKabupaten) {
                                        parepareKabupaten.kecamatan.forEach(kec => {
                                            const opt = document.createElement('option');
                                            opt.value = kec.name;
                                            opt.textContent = kec.name;
                                            kecamatanSelect.appendChild(opt);
                                        });
                                    }

                                    kecamatanSelect.addEventListener('change', function() {
                                        const selectedKec = parepareKabupaten.kecamatan.find(kec => kec.name === this.value);

                                        kelurahanSelect.innerHTML = '<option value="" disabled selected>Pilih Kelurahan</option>';

                                        if (selectedKec) {
                                            selectedKec.kelurahan.forEach(kel => {
                                                const opt = document.createElement('option');
                                                opt.value = kel;
                                                opt.textContent = kel;
                                                kelurahanSelect.appendChild(opt);
                                            });
                                            kelurahanSelect.disabled = false;
                                        } else {
                                            kelurahanSelect.disabled = true;
                                        }
                                    });
                                </script>

                                {{-- PERSENTASE PEMILIK --}}
                                <section id="form-persentase-pemilik"
                                    class="hidden relative z-0 grid grid-cols-1 gap-4 text-sm">
                                    <div class="flex flex-col">
                                        <label class="mb-2 font-medium text-gray-700">Pemerintah Pusat (%)</label>
                                        <input type="number" min="0" max="100" step="1"
                                            placeholder="Masukan Angka (contoh: 20)" required
                                            class="border border-black outline-black p-2 rounded-2xl w-full focus:outline-2">
                                    </div>
                                    <div class="flex flex-col">
                                        <label class="mb-2 font-medium text-gray-700">Pemerintah Daerah (%)</label>
                                        <input type="number" min="0" max="100" step="1"
                                            placeholder="Masukan Angka (contoh: 20)" required
                                            class="border border-black outline-black p-2 rounded-2xl w-full focus:outline-2">
                                    </div>
                                    <div class="flex flex-col">
                                        <label class="mb-2 font-medium text-gray-700">Swasta Nasional (%)</label>
                                        <input type="number" min="0" max="100" step="1"
                                            placeholder="Masukan Angka (contoh: 20)" required
                                            class="border border-black outline-black p-2 rounded-2xl w-full focus:outline-2">
                                    </div>
                                    <div class="flex flex-col">
                                        <label class="mb-2 font-medium text-gray-700">Asing (%)</label>
                                        <input type="number" min="0" max="100" step="1"
                                            placeholder="Masukan Angka (contoh: 20)" required
                                            class="border border-black outline-black p-2 rounded-2xl w-full focus:outline-2">
                                    </div>
                                    <div class="flex justify-center gap-4 mt-6">
                                        <button type="button"
                                            class="prev bg-[#083458] text-white px-6 py-2 rounded-3xl hover:opacity-90">Sebelumnya</button>
                                        <button type="button" id="next-persentase-pemilik"
                                            class="bg-[#083458] text-white px-6 py-2 rounded-3xl hover:opacity-90">Selanjutnya</button>
                                    </div>
                                </section>

                                {{-- KARYAWAN --}}
                                <section id="form-karyawan" class="hidden relative z-0 grid grid-cols-1 gap-4 text-sm">
                                    <div class="flex flex-col">
                                        <label class="mb-2 font-medium text-gray-700">Jumlah Karyawan</label>
                                        <input type="number" min="0" max="100" step="1"
                                            placeholder="Masukan Jumlah Karyawan" required
                                            class="border border-black outline-black p-2 rounded-2xl w-full focus:outline-2">
                                    </div>

                                    <div class="flex flex-col">
                                        <label for="tingkat_pendidikan" class="mb-2 font-medium text-gray-700">
                                            <div>
                                                <label class="block mb-1 font-medium">Tingkat Pendidikan (Orang)</label>
                                                <div class="flex flex-wrap gap-2">
                                                    <input type="number" name="pendidikan_sd" min="0"
                                                        placeholder="SD" required
                                                        class="border border-black outline-black p-2 rounded-2xl w-full md:w-[130px] focus:outline-2">
                                                    <input type="number" name="pendidikan_smp" min="0"
                                                        placeholder="SMP" required
                                                        class="border border-black outline-black p-2 rounded-2xl w-full md:w-[130px] focus:outline-2">
                                                    <input type="number" name="pendidikan_sma" min="0"
                                                        placeholder="SMA/SMK" required
                                                        class="border border-black outline-black p-2 rounded-2xl w-full md:w-[130px] focus:outline-2">
                                                    <input type="number" name="pendidikan_d3" min="0"
                                                        placeholder="D1 sd. D3" required
                                                        class="border border-black outline-black p-2 rounded-2xl w-full md:w-[130px] focus:outline-2">
                                                </div>
                                                <div class="flex justify-center flex-wrap gap-2 mt-2">
                                                    <input type="number" name="pendidikan_s1" min="0"
                                                        placeholder="S1/D4" required
                                                        class="border border-black outline-black p-2 rounded-2xl w-[130px] focus:outline-2">
                                                    <input type="number" name="pendidikan_s2" min="0"
                                                        placeholder="S2" required
                                                        class="border border-black outline-black p-2 rounded-2xl w-[130px] focus:outline-2">
                                                    <input type="number" name="pendidikan_s3" min="0"
                                                        placeholder="S3" required
                                                        class="border border-black outline-black p-2 rounded-2xl w-[130px] focus:outline-2">
                                                </div>
                                            </div>
                                            <div class="mt-4">
                                                <label class="block mb-1 font-medium text-gray-700">Status Tenaga Kerja
                                                    (Orang)</label>
                                                <div class="flex gap-2">
                                                    <input type="number" name="status_tetap" min="0"
                                                        placeholder="Tetap" required
                                                        class="border border-black outline-black p-2 rounded-2xl w-full md:w-1/2 focus:outline-2">
                                                    <input type="number" name="status_tidak_tetap" min="0"
                                                        placeholder="Tidak Tetap" required
                                                        class="border border-black outline-black p-2 rounded-2xl w-full md:w-1/2 focus:outline-2">
                                                </div>
                                            </div>

                                            <div class="flex justify-center gap-4 mt-6">
                                                <button type="button"
                                                    class="prev bg-[#083458] text-white px-6 py-2 rounded-3xl hover:opacity-90">Sebelumnya</button>
                                                <button type="button" id="next-karyawan"
                                                    class="bg-[#083458] text-white px-6 py-2 rounded-3xl hover:opacity-90">Selanjutnya</button>
                                            </div>
                                </section>

                                {{-- PEMAKAIAN BAHAN --}}
                                <section id="form-pemakaian-bahan"
                                    class="hidden relative z-0 flex flex-col gap-4 text-sm">
                                    <div class="mb-4 flex justify-end">
                                        <button type="button" onclick="tambahFormBahan()"
                                            class="bg-[#083458] text-white px-4 py-2 rounded-2xl hover:opacity-90 ">
                                            + Tambah Data Bahan
                                        </button>
                                    </div>

                                    <div id="form-bahan-container" class="flex flex-col gap-4"></div>


                                    <div id="bahan-template" class="flex flex-col gap-4">
                                        <div class="bahan-item border p-4 rounded-xl shadow" id="bahan-template">
                                            <div class="flex flex-col">
                                                <div class="font-semibold text-gray-700">Bahan ke-1</div>
                                            </div>

                                            <div class="mb-2">
                                                <label class="block mb-1 font-medium">Nama Bahan</label>
                                                <input type="text" name="nama_bahan[]" required
                                                    class="border border-black outline-black p-2 rounded-2xl w-full"
                                                    placeholder="Masukkan Nama Bahan">
                                            </div>

                                            <div class="mb-2">
                                                <label class="block mb-1 font-medium">Jenis Bahan</label>
                                                <select name="jenis_bahan[]" required
                                                    class="border border-black outline-black p-2 rounded-2xl w-full">
                                                    <option value="" disabled selected>-- Pilih Jenis Bahan --
                                                    </option>
                                                    <option value="Bahan Baku">Bahan Baku</option>
                                                    <option value="Bahan Penolong">Bahan Penolong</option>
                                                </select>
                                            </div>

                                            <div class="mb-2">
                                                <label class="block mb-1 font-medium">Spesifikasi</label>
                                                <input type="text" name="spesifikasi[]" required
                                                    class="border border-black outline-black p-2 rounded-2xl w-full"
                                                    placeholder="Masukkan Spesifikasi Bahan">
                                            </div>

                                            <div class="mb-2">
                                                <label class="block mb-1 font-medium">Kode HS</label>
                                                <input type="text" name="kode_hs[]" required
                                                    class="border border-black outline-black p-2 rounded-2xl w-full"
                                                    placeholder="Masukkan Kode HS Bahan">
                                            </div>

                                            <div class="mb-2">
                                                <label class="block mb-1 font-medium">Satuan Standar</label>
                                                <input type="text" name="satuan[]" required
                                                    class="border border-black outline-black p-2 rounded-2xl w-full"
                                                    placeholder="Masukkan Satuan Standar (liter, ton, dsb)">
                                            </div>

                                            <div class="mb-2">
                                                <label class="block mb-1 font-medium">Bahan Dalam Negeri</label>
                                                <div class="flex flex-col md:flex-row gap-2">
                                                    <input type="number" name="jumlah_dalam_negeri[]" min="0"
                                                        required
                                                        class="border border-black outline-black p-2 rounded-2xl w-full md:w-1/2"
                                                        placeholder="Jumlah (Unit)">
                                                    <input type="number" name="nilai_dalam_negeri[]" min="0"
                                                        required
                                                        class="border border-black outline-black p-2 rounded-2xl w-full md:w-1/2"
                                                        placeholder="Nilai (Rp)">
                                                </div>
                                            </div>

                                            <div class="mb-2">
                                                <label class="block mb-1 font-medium">Bahan Impor</label>
                                                <div class="flex flex-col md:flex-row gap-2">
                                                    <input type="number" name="jumlah_impor[]" min="0" required
                                                        class="border border-black outline-black p-2 rounded-2xl w-full md:w-1/3"
                                                        placeholder="Jumlah (Unit)">
                                                    <input type="number" name="nilai_impor[]" min="0" required
                                                        class="border border-black outline-black p-2 rounded-2xl w-full md:w-1/3"
                                                        placeholder="Nilai (Rp)">
                                                    <input type="text" name="negara_asal[]" required
                                                        class="border border-black outline-black p-2 rounded-2xl w-full md:w-1/3"
                                                        placeholder="Negara Asal">
                                                </div>
                                            </div>
                                            <button type="button"
                                                class="hapus-bahan self-end text-sm text-red-600 hover:underline mt-2">Hapus</button>
                                        </div>
                                    </div>

                                    {{-- Tombol Navigasi --}}
                                    <div class="flex justify-center gap-4 mt-6">
                                        <button type="button"
                                            class="prev bg-[#083458] text-white px-6 py-2 rounded-3xl hover:opacity-90">Sebelumnya</button>
                                        <button type="button" id="next-pemakaian-bahan"
                                            class="bg-[#083458] text-white px-6 py-2 rounded-3xl hover:opacity-90">Selanjutnya</button>
                                    </div>
                                </section>


                                {{-- PENGGUNAAN AIR --}}
                                <section id="form-penggunaan-air"
                                    class="hidden relative z-0 grid grid-cols-1 gap-4 text-sm">
                                    <div class="flex flex-col">
                                        <label for="jenis_pengeluaran" class="mb-2 font-medium text-gray-700">Sumber
                                            Air</label>
                                        <select id="jenis_pengeluaran" name="jenis_pengeluaran" required
                                            class="border border-black outline-black p-2 rounded-2xl w-full focus:outline-2">
                                            <option value="" disabled selected>-- Pilih Sumber Air --</option>
                                            <option value="air_permukaan">Air Permukaan (sungai, danau, mata air, laut)
                                            </option>
                                            <option value="air_tanah">Air Tanah</option>
                                            <option value="perusahaan_penyedia_air">Perusahaan Penyedia Air</option>
                                            <option value="air_daur_ulang">Air Daur Ulang dari Proses di Industri</option>
                                        </select>
                                    </div>
                                    <div class="flex flex-col">
                                        <label for="banyaknya_penggunaan" class="mb-2 font-medium text-gray-700">Banyaknya
                                            Penggunaan (m³)</label>
                                        <input type="number" id="banyaknya_penggunaan" name="banyaknya_penggunaan"
                                            min="0" required
                                            class="border border-black outline-black p-2 rounded-2xl w-full focus:outline-2"
                                            placeholder="Masukkan Jumlah Penggunaan">
                                    </div>
                                    <div class="flex flex-col">
                                        <label for="biaya" class="mb-2 font-medium text-gray-700">Biaya (Rp)</label>
                                        <input type="number" id="biaya" name="biaya" min="0" required
                                            class="border border-black outline-black p-2 rounded-2xl w-full focus:outline-2"
                                            placeholder="Masukkan Biaya (contoh: 200000">
                                    </div>

                                    {{-- Tombol Navigasi --}}
                                    <div class="flex justify-center gap-4 mt-6">
                                        <button type="button"
                                            class="prev bg-[#083458] text-white px-6 py-2 rounded-3xl hover:opacity-90">Sebelumnya</button>
                                        <button type="button" id="next-penggunaan-air"
                                            class="bg-[#083458] text-white px-6 py-2 rounded-3xl hover:opacity-90">Selanjutnya</button>
                                    </div>
                                </section>

                                {{-- PENGELUARAN --}}
                                <section id="form-pengeluaran" class="hidden relative z-0 grid grid-cols-1 gap-4 text-sm">
                                    <div class="flex flex-col">
                                        <label for="upah_gaji" class="mb-2 font-medium text-gray-700">Upah Gaji Pekerja
                                            Produksi (Rp)</label>
                                        <input type="number" id="upah_gaji" name="upah_gaji" min="0" required
                                            class="border border-black outline-black p-2 rounded-2xl w-full focus:outline-2"
                                            placeholder="contoh: 60000">
                                    </div>

                                    <div class="flex flex-col">
                                        <label for="lainnya" class="mb-2 font-medium text-gray-700">Pengeluaran Lainnya
                                            (Rp)</label>
                                        <input type="number" id="lainnya" name="lainnya" required
                                            class="border border-black outline-black p-2 rounded-2xl w-full focus:outline-2"
                                            placeholder="contoh: 60000">
                                    </div>

                                    <div class="flex justify-center gap-4 mt-6">
                                        <button type="button"
                                            class="prev bg-[#083458] text-white px-6 py-2 rounded-3xl hover:opacity-90">Sebelumnya</button>
                                        <button type="button" id="next-pengeluaran"
                                            class="bg-[#083458] text-white px-6 py-2 rounded-3xl hover:opacity-90">Selanjutnya</button>
                                    </div>
                                </section>
                                {{-- BAHAN BAKAR --}}
                                <section id="form-bahan-bakar" class="hidden relative z-0 grid grid-cols-1 gap-4 text-sm">
                                    <div class="mb-4 flex justify-end">
                                        <button type="button" onclick="tambahBahanBakar()"
                                            class="bg-[#083458] text-white px-4 py-2 rounded-2xl hover:opacity-90">
                                            + Tambah Data
                                        </button>
                                    </div>

                                    <div id="bahan-bakar-container" class="flex flex-col gap-4">
                                        <div class="bahan-bakar-item border p-4 rounded-xl shadow"
                                            id="bahan-bakar-template">
                                            <div class="flex flex-col">
                                                <label for="jenis_bahan_bakar"
                                                    class="mb-2 font-medium text-gray-700">Jenis Bahan Bakar</label>
                                                <select name="jenis_bahan_bakar[]" required
                                                    class="border border-black outline-black p-2 rounded-2xl w-full focus:outline-2">
                                                    <option value="" disabled selected>-- Pilih Jenis Bahan Bakar --
                                                    </option>
                                                    <option value="bensin">Bensin</option>
                                                    <option value="solar_hsd_ado">Solar / HSD / ADO</option>
                                                    <option value="batubara">Batubara</option>
                                                    <option value="briket_batubara">Briket Batubara</option>
                                                    <option value="gas_dari_pgn">Gas dari PGN</option>
                                                    <option value="gas_bukan_dari_pgn">Gas bukan dari PGN</option>
                                                    <option value="cng">CNG</option>
                                                    <option value="lpg">LPG</option>
                                                    <option value="pelumas">Pelumas</option>
                                                </select>
                                            </div>

                                            <div class="flex flex-col">
                                                <label class="mb-2 font-medium text-gray-700">Satuan Standar</label>
                                                <select name="satuan_standar[]" required
                                                    class="border border-black outline-black p-2 rounded-2xl w-full focus:outline-2">
                                                    <option value="" disabled selected>-- Pilih Satuan Standar --
                                                    </option>
                                                    <option value="liter">Liter</option>
                                                    <option value="ton">Ton</option>
                                                    <option value="mmbtu">MMBTU</option>
                                                    <option value="kg">Kg</option>
                                                </select>
                                            </div>

                                            <div class="mb-2">
                                                <label class="block mb-1 font-medium">Proses Produksi</label>
                                                <div class="flex flex-col md:flex-row gap-2">
                                                    <input type="number" name="banyaknya_produksi[]" min="0"
                                                        required
                                                        class="border border-black outline-black p-2 rounded-2xl w-full md:w-1/2"
                                                        placeholder="Banyak (Contoh: 30)">
                                                    <input type="number" name="nilai_produksi[]" min="0" required
                                                        class="border border-black outline-black p-2 rounded-2xl w-full md:w-1/2"
                                                        placeholder="Nilai (Contoh: 30000)">
                                                </div>
                                            </div>

                                            <div class="mb-2">
                                                <label class="block mb-1 font-medium">Pembangkit Tenaga Listrik</label>
                                                <div class="flex flex-col md:flex-row gap-2">
                                                    <input type="number" name="banyaknya_ptl[]" min="0" required
                                                        class="border border-black outline-black p-2 rounded-2xl w-full md:w-1/2"
                                                        placeholder="Banyak (Contoh: 30)">
                                                    <input type="number" name="nilai_ptl[]" min="0" required
                                                        class="border border-black outline-black p-2 rounded-2xl w-full md:w-1/2"
                                                        placeholder="Nilai (Contoh: 30000)">
                                                </div>
                                            </div>

                                            <button type="button"
                                                class="hapus-item self-end text-sm text-red-600 hover:underline mt-2">Hapus</button>
                                        </div>
                                    </div>

                                    <div class="flex justify-center gap-4 mt-6">
                                        <button type="button"
                                            class="prev bg-[#083458] text-white px-6 py-2 rounded-3xl hover:opacity-90">Sebelumnya</button>
                                        <button type="button" id="next-bahan-bakar"
                                            class="bg-[#083458] text-white px-6 py-2 rounded-3xl hover:opacity-90">Selanjutnya</button>
                                    </div>
                                </section>

                                {{-- LISTRIK --}}
                                <section id="form-listrik" class="hidden relative z-0 grid grid-cols-1 gap-4 text-sm">
                                    <div>
                                        <label for="sumber_listrik" class="block mb-1 font-medium">Sumber Listrik</label>
                                        <select id="sumber_listrik" name="sumber_listrik" required
                                            class="border border-black outline-black p-2 rounded-2xl w-full focus:outline-2">
                                            <option value="" disabled selected>-- Pilih Sumber Listrik --</option>
                                            <option value="pln">PLN</option>
                                            <option value="non_pln">Non-PLN</option>
                                            <option value="pembangkit_sendiri">Pembangkit Sendiri</option>
                                        </select>
                                    </div>

                                    <div>
                                        <label class="block mb-1 font-medium">Banyaknya Penggunaan (kWh)</label>
                                        <input type="number" name="banyaknya_penggunaan_listrik" min="0" required
                                            placeholder="Masukkan penggunaan listrik (kWh)"
                                            class="border border-black outline-black p-2 rounded-2xl w-full focus:outline-2">
                                    </div>
                                    <div>
                                        <label class="block mb-1 font-medium">Nilai Penggunaan (Rp)</label>
                                        <input type="number" name="nilai_penggunaan_listrik" min="0" required
                                            placeholder="Masukkan Nilai (Contoh: 250000)"
                                            class="border border-black outline-black p-2 rounded-2xl w-full focus:outline-2">
                                    </div>
                                    <div>
                                        <label class="block mb-1 font-medium">Peruntukkan Listrik</label>
                                        <input type="text" id="peruntukkan_listrik" name="peruntukkan_listrik"
                                            required placeholder="Masukkan peruntukkan listrik"
                                            class="border border-black outline-black p-2 rounded-2xl w-full focus:outline-2">
                                    </div>
                                    <div class="flex justify-center gap-4 mt-6">
                                        <button type="button"
                                            class="prev bg-[#083458] text-white px-6 py-2 rounded-3xl hover:opacity-90">Sebelumnya</button>
                                        <button type="button" id="next-listrik"
                                            class="bg-[#083458] text-white px-6 py-2 rounded-3xl hover:opacity-90">Selanjutnya</button>
                                    </div>
                                </section>

                                {{-- MESIN PRODUKSI --}}
                                <section id="form-mesin-produksi"
                                    class="hidden relative z-0 grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                                    <div>
                                        <label class="block mb-1 font-medium">Jenis Mesin/Peralatan</label>
                                        <input type="text" id="jenis_mesin" name="jenis_mesin" required
                                            class="border border-black outline-black p-2 rounded-2xl w-full focus:outline-2"
                                            placeholder="Masukkan Jenis Mesin">
                                    </div>

                                    <div>
                                        <label class="block mb-1 font-medium">Nama Mesin/Peralatan</label>
                                        <input type="text" id="nama_mesin" name="nama_mesin" required
                                            class="border border-black outline-black p-2 rounded-2xl w-full focus:outline-2"
                                            placeholder="Masukkan Nama Mesin">
                                    </div>

                                    <div>
                                        <label class="block mb-1 font-medium">Merk/Type</label>
                                        <input type="text" id="merk_type" name="merk_type" required
                                            class="border border-black outline-black p-2 rounded-2xl w-full focus:outline-2"
                                            placeholder="Masukkan Merk">
                                    </div>

                                    <div>
                                        <label class="block mb-1 font-medium">Teknologi</label>
                                        <input type="text" id="teknologi" name="teknologi" required
                                            class="border border-black outline-black p-2 rounded-2xl w-full focus:outline-2"
                                            placeholder="Masukkan Teknologi">
                                    </div>

                                    <div>
                                        <label class="block mb-1 font-medium">Negara Pembuat</label>
                                        <input type="text" id="negara_pembuat" name="negara_pembuat" required
                                            class="border border-black outline-black p-2 rounded-2xl w-full focus:outline-2"
                                            placeholder="Masukkan Negara ">
                                    </div>

                                    <div>
                                        <label class="block mb-1 font-medium">Tahun Perolehan</label>
                                        <input type="number" id="tahun_perolehan" name="tahun_perolehan" required
                                            class="border border-black outline-black p-2 rounded-2xl w-full focus:outline-2"
                                            placeholder="Masukkan Tahun ">
                                    </div>

                                    <div>
                                        <label class="block mb-1 font-medium">Tahun Pembuatan</label>
                                        <input type="number" id="tahun_pembuatan" name="tahun_pembuatan" required
                                            class="border border-black outline-black p-2 rounded-2xl w-full focus:outline-2"
                                            placeholder="Masukkan Tahun ">
                                    </div>

                                    <div>
                                        <label class="block mb-1 font-medium">Jumlah Unit</label>
                                        <input type="number" id="banyaknya" name="banyaknya" min="0" required
                                            class="border border-black outline-black p-2 rounded-2xl w-full focus:outline-2"
                                            placeholder="Masukkan Banyaknya">
                                    </div>

                                    <div class="col-span-1 md:col-span-2 flex justify-center gap-4 mt-6">
                                        <button type="button"
                                            class="prev bg-[#083458] text-white px-6 py-2 rounded-3xl hover:opacity-90">Sebelumnya</button>
                                        <button type="button" id="next-mesin-produksi"
                                            class="bg-[#083458] text-white px-6 py-2 rounded-3xl hover:opacity-90">Selanjutnya</button>
                                    </div>
                                </section>

                                {{-- PRODUKSI --}}
                                <section id="form-produksi"
                                    class="hidden relative z-0 grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                                    <div>
                                        <label class="block mb-1 font-medium">Jenis Produksi</label>
                                        <input type="text" id="jenis_produksi" name="jenis_produksi" required
                                            class="border border-black outline-black p-2 rounded-2xl w-full focus:outline-2"
                                            placeholder="Masukkan Jenis Produksi">
                                    </div>

                                    <div>
                                        <label class="block mb-1 font-medium">KBLI (Kode Bisnis dan Layanan
                                            Indonesia)</label>
                                        <input type="text" id="kbli" name="kbli" required
                                            class="border border-black outline-black p-2 rounded-2xl w-full focus:outline-2"
                                            placeholder="Masukkan KBLI">
                                    </div>

                                    <div>
                                        <label class="block mb-1 font-medium">Kode HS (Harmonized System)</label>
                                        <input type="text" id="kode_hs" name="kode_hs" required
                                            class="border border-black outline-black p-2 rounded-2xl w-full focus:outline-2"
                                            placeholder="Masukkan Kode HS">
                                    </div>

                                    <div>
                                        <label class="block mb-1 font-medium">Spesifikasi</label>
                                        <input type="text" id="spesifikasi" name="spesifikasi" required
                                            class="border border-black outline-black p-2 rounded-2xl w-full focus:outline-2"
                                            placeholder="Masukkan Spesifikasi Produksi">
                                    </div>

                                    <div>
                                        <label class="block mb-1 font-medium">Jumlah Produksi</label>
                                        <input type="number" id="jumlah_produksi" name="jumlah_produksi" min="0"
                                            required
                                            class="border border-black outline-black p-2 rounded-2xl w-full focus:outline-2"
                                            placeholder="Masukkan Jumlah Produksi">
                                    </div>

                                    <div>
                                        <label class="block mb-1 font-medium">Nilai</label>
                                        <input type="text" id="nilai_produksi" name="nilai_produksi" required
                                            class="border border-black outline-black p-2 rounded-2xl w-full focus:outline-2"
                                            placeholder="Masukkan Nilai Produksi">
                                    </div>

                                    <div>
                                        <label class="block mb-1 font-medium">Satuan</label>
                                        <input type="text" id="satuan" name="satuan" required
                                            class="border border-black outline-black p-2 rounded-2xl w-full focus:outline-2"
                                            placeholder="Masukkan Satuan">
                                    </div>

                                    <div>
                                        <label class="block mb-1 font-medium">Persentase Produk yang Diekspor</label>
                                        <input type="number" id="persentase_ekspor" name="persentase_ekspor"
                                            min="0" max="100" required
                                            class="border border-black outline-black p-2 rounded-2xl w-full focus:outline-2"
                                            placeholder="Masukkan Persentase Produk yang Diekspor">
                                    </div>

                                    <div>
                                        <label class="block mb-1 font-medium">Negara Tujuan Ekspor</label>
                                        <input type="text" id="negara_ekspor" name="negara_ekspor" required
                                            class="border border-black outline-black p-2 rounded-2xl w-full focus:outline-2"
                                            placeholder="Masukkan Negara Tujuan Ekspor">
                                    </div>

                                    <div>
                                        <label class="block mb-1 font-medium">Kapasitas Terpasang per Tahun</label>
                                        <input type="number" id="kapasitas_tahun" name="kapasitas_tahun" min="0"
                                            required
                                            class="border border-black outline-black p-2 rounded-2xl w-full focus:outline-2"
                                            placeholder="Masukkan Kapasitas Terpasang per Tahun">
                                    </div>

                                    <div class="col-span-1 md:col-span-2 flex justify-center gap-4 mt-6">
                                        <button type="button"
                                            class="prev bg-[#083458] text-white px-6 py-2 rounded-3xl hover:opacity-90">Sebelumnya</button>
                                        <button type="button" id="next-produksi"
                                            class=" bg-[#083458] text-white px-6 py-2 rounded-3xl hover:opacity-90">Selanjutnya</button>
                                    </div>
                                </section>

                                {{-- PERSEDIAAN --}}
                                <section id="form-persediaan" class="hidden relative z-0 grid grid-cols-1 gap-4 text-sm">
                                    <div>
                                        <label for="jenis_persediaan" class="block mb-1 font-medium">Jenis
                                            Persediaan</label>
                                        <select id="jenis_persediaan" name="jenis_persediaan" required
                                            class="border border-black outline-black p-2 rounded-2xl w-full focus:outline-2">
                                            <option value="" disabled selected>-- Pilih Jenis Persediaan --</option>
                                            <option value="persediaan_bahan">Nilai Persediaan Bahan Baku, Bahan Penolong,
                                                Bahan Bakar, Bahan Pembungkus</option>
                                            <option value="setengah_jadi">Nilai Persediaan Barang Produksi Setengah Jadi
                                            </option>
                                            <option value="barang_jadi">Nilai Persediaan Barang Jadi yang Dihasilkan
                                            </option>
                                        </select>
                                    </div>

                                    <div>
                                        <label class="block mb-1 font-medium">Awal (Rp)</label>
                                        <input type="number" name="awal_rp" min="0" required
                                            placeholder="Masukkan Nilai Awal (Contoh: 50000)"
                                            class="border border-black outline-black p-2 rounded-2xl w-full focus:outline-2">
                                    </div>

                                    <div>
                                        <label class="block mb-1 font-medium">Akhir (Rp)</label>
                                        <input type="number" name="akhir_rp" min="0" required
                                            placeholder="Masukkan Nilai Akhir (Contoh: 50000)"
                                            class="border border-black outline-black p-2 rounded-2xl w-full focus:outline-2">
                                    </div>

                                    <div class="flex justify-center gap-4 mt-6">
                                        <button type="button"
                                            class="prev bg-[#083458] text-white px-6 py-2 rounded-3xl hover:opacity-90">Sebelumnya</button>
                                        <button type="button" id="next-persediaan"
                                            class="bg-[#083458] text-white px-6 py-2 rounded-3xl hover:opacity-90">Selanjutnya</button>
                                    </div>
                                </section>

                                {{-- PENDAPATAN --}}
                                <section id="form-pendapatan"
                                    class="hidden relative z-0 grid grid-cols-1 gap-4 text-sm w-[300px]">
                                    <div>
                                        <label class="block mb-1 font-medium">Sumber</label>
                                        <input type="text" name="sumber" required
                                            placeholder="Masukkan Sumber Pendapatan"
                                            class="border border-black outline-black p-2 rounded-2xl w-full focus:outline-2">
                                    </div>

                                    <div>
                                        <label class="block mb-1 font-medium">Nilai (Rp)</label>
                                        <input type="number" name="nilai" min="0" required
                                            placeholder="Masukkan Nilai (Contoh:100000)"
                                            class="border border-black outline-black p-2 rounded-2xl w-full focus:outline-2">
                                    </div>

                                    <div class="flex justify-center gap-4 mt-6">
                                        <button type="button"
                                            class="prev bg-[#083458] text-white px-6 py-2 rounded-3xl hover:opacity-90">Sebelumnya</button>
                                        <button type="button" id="next-pendapatan"
                                            class="bg-[#083458] text-white px-6 py-2 rounded-3xl hover:opacity-90">Selanjutnya</button>
                                    </div>
                                </section>

                                {{-- MODAL --}}
                                <section id="form-modal"
                                    class="hidden relative z-0 grid grid-cols-1 gap-4 text-sm w-[300px]">
                                    <div>
                                        <label class="block mb-1 font-medium">Jenis Barang Modal</label>
                                        <input type="text" name="sumber" required
                                            placeholder="Masukkan Sumber Pendapatan"
                                            class="border border-black outline-black p-2 rounded-2xl w-full focus:outline-2">
                                    </div>

                                    <div>
                                        <label class="block mb-1 font-medium">Pembelian/Penambahan dan Pembuatan/Perbaikan
                                            Besar(Rp)</label>
                                        <input type="number" name="nilai" min="0" required
                                            placeholder="Masukkan Nilai (Contoh:100000)"
                                            class="border border-black outline-black p-2 rounded-2xl w-full focus:outline-2">
                                    </div>

                                    <div>
                                        <label class="block mb-1 font-medium">Penjualan/Pengurangan Barang Modal
                                            (Rp)</label>
                                        <input type="number" name="nilai" min="0" required
                                            placeholder="Masukkan Nilai (Contoh:100000)"
                                            class="border border-black outline-black p-2 rounded-2xl w-full focus:outline-2">
                                    </div>

                                    <div>
                                        <label class="block mb-1 font-medium">Penyusutan Barang
                                            (Rp)</label>
                                        <input type="number" name="nilai" min="0" required
                                            placeholder="Masukkan Nilai (Contoh:100000)"
                                            class="border border-black outline-black p-2 rounded-2xl w-full focus:outline-2">
                                    </div>

                                    <div>
                                        <label class="block mb-1 font-medium">Nilai Taksiran seluruh barang modal tetap
                                            menurut harga berlaku
                                            (Rp)</label>
                                        <input type="number" name="nilai" min="0" required
                                            placeholder="Masukkan Nilai (Contoh:100000)"
                                            class="border border-black outline-black p-2 rounded-2xl w-full focus:outline-2">
                                    </div>

                                    <div class="flex justify-center gap-4 mt-6">
                                        <button type="button"
                                            class="prev bg-[#083458] text-white px-6 py-2 rounded-3xl hover:opacity-90">Sebelumnya</button>
                                        <button type="button" id="next-pendapatan"
                                            class="bg-[#083458] text-white px-6 py-2 rounded-3xl hover:opacity-90">Selanjutnya</button>
                                    </div>
                                </section>

                                {{-- BENTUK PENGELOLAAN --}}
                                <section id="form-bentuk-pengelolaan"
                                    class="hidden relative z-0 grid grid-cols-1 gap-4 text-sm">
                                    <div class="border-t pt-4">
                                        <label class="block mb-2 font-semibold text-gray-700">Data Limbah</label>

                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                            <div>
                                                <label class="block mb-1 font-medium">Jenis Limbah</label>
                                                <select name="jenis_limbah" required
                                                    class="border border-black outline-black p-2 rounded-2xl w-full focus:outline-2">
                                                    <option value="" disabled selected>-- Pilih Jenis Limbah --
                                                    </option>
                                                    <option value="limbah_padat">Limbah Padat</option>
                                                    <option value="limbah_b3">Limbah B3</option>
                                                    <option value="limbah_cair">Limbah Cair</option>
                                                </select>
                                            </div>

                                            <div>
                                                <label class="block mb-1 font-medium">Jumlah (Ton)</label>
                                                <input type="number" name="jumlah_limbah" min="0" step="0.01"
                                                    placeholder="Masukkan jumlah (ton)"
                                                    class="border border-black outline-black p-2 rounded-2xl w-full focus:outline-2">
                                            </div>

                                            <div>
                                                <label class="block mb-1 font-medium">Bentuk Pengelolaan</label>
                                                <input type="text" name="bentuk_pengelolaan"
                                                    placeholder="Masukkan bentuk pengelolaan"
                                                    class="border border-black outline-black p-2 rounded-2xl w-full focus:outline-2">
                                            </div>

                                            <div>
                                                <label class="block mb-1 font-medium">Parameter</label>
                                                <select name="parameter_limbah" required
                                                    class="border border-black outline-black p-2 rounded-2xl w-full focus:outline-2">
                                                    <option value="" disabled selected>-- Pilih Parameter --</option>
                                                    <option value="debit_inlet">Debit Limbah Cair di Inlet</option>
                                                    <option value="debit_outlet">Debit Limbah Cair di Outlet</option>
                                                    <option value="cod_inlet">COD pada Saluran Inlet</option>
                                                    <option value="cod_outlet">COD pada Saluran Outlet</option>
                                                    <option value="sludge_removed">Sludge Removed</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <label class="block mb-1 font-medium">Dikumpulkan di TPS</label>
                                        <input type="text" name="dikumpulkan_di_tps" required
                                            placeholder="Masukkan lokasi TPS"
                                            class="border border-black outline-black p-2 rounded-2xl w-full focus:outline-2">
                                    </div>

                                    <div>
                                        <label class="block mb-1 font-medium">Dikerjasamakan dengan Pihak Lain yang Telah
                                            Berizin</label>
                                        <input type="text" name="dikerjasamakan_dengan_pihak_lain" required
                                            placeholder="Masukkan pihak yang diajak kerjasama"
                                            class="border border-black outline-black p-2 rounded-2xl w-full focus:outline-2">
                                    </div>

                                    <div>
                                        <label class="block mb-1 font-medium">Dimanfaatkan untuk Internal Industri</label>
                                        <input type="text" name="dimanfaatkan_untuk_internal_industri" required
                                            placeholder="Masukkan tujuan pemanfaatan untuk industri"
                                            class="border border-black outline-black p-2 rounded-2xl w-full focus:outline-2">
                                    </div>

                                    <div class="flex justify-center gap-4 mt-6">
                                        <button type="button"
                                            class="prev bg-[#083458] text-white px-6 py-2 rounded-3xl hover:opacity-90">Sebelumnya</button>
                                        <button type="submit" id="next-pengeluaran"
                                            class="bg-[#F49F1E] text-white px-6 py-2 rounded-3xl hover:opacity-90">Simpan</button>
                                    </div>
                                </section>

                            </form>
                        </section>
                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                const tabs = document.querySelectorAll('.tab-button');
                                const contents = {
                                    'btn-data-ikm': document.getElementById('form-data-ikm'),
                                    'btn-persentase-pemilik': document.getElementById('form-persentase-pemilik'),
                                    'btn-karyawan': document.getElementById('form-karyawan'),
                                    'btn-pemakaian-bahan': document.getElementById('form-pemakaian-bahan'),
                                    'btn-penggunaan-air': document.getElementById('form-penggunaan-air'),
                                    'btn-pengeluaran': document.getElementById('form-pengeluaran'),
                                    'btn-bahan-bakar': document.getElementById('form-bahan-bakar'),
                                    'btn-listrik': document.getElementById('form-listrik'),
                                    'btn-mesin-produksi': document.getElementById('form-mesin-produksi'),
                                    'btn-produksi': document.getElementById('form-produksi'),
                                    'btn-persediaan': document.getElementById('form-persediaan'),
                                    'btn-pendapatan': document.getElementById('form-pendapatan'),
                                    'btn-modal': document.getElementById('form-modal'),
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

                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                const formIds = [
                                    'form-data-ikm',
                                    'form-persentase-pemilik',
                                    'form-karyawan',
                                    'form-pemakaian-bahan',
                                    'form-penggunaan-air',
                                    'form-pengeluaran',
                                    'form-bahan-bakar',
                                    'form-listrik',
                                    'form-mesin-produksi',
                                    'form-produksi',
                                    'form-persediaan',
                                    'form-pendapatan',
                                    'form-modal',
                                    'form-bentuk-pengelolaan'
                                ];

                                function showForm(idToShow) {
                                    formIds.forEach(id => {
                                        const el = document.getElementById(id);
                                        const tabBtn = document.getElementById('btn-' + id.replace('form-', ''));
                                        if (!el || !tabBtn) return;

                                        if (id === idToShow) {
                                            el.classList.remove('hidden');
                                            el.classList.add('grid');

                                            tabBtn.classList.add(
                                                'bg-blue-100', 'text-black', 'font-bold',
                                                'after:content-[""]', 'after:absolute', 'after:bottom-0',
                                                'after:left-0', 'after:right-0', 'after:h-1',
                                                'after:bg-blue-600', 'after:rounded-t'
                                            );
                                            tabBtn.classList.remove('bg-[#083458]');
                                        } else {
                                            el.classList.add('hidden');
                                            el.classList.remove('grid');

                                            tabBtn.classList.remove(
                                                'bg-blue-100', 'text-black', 'font-bold',
                                                'after:content-[""]', 'after:absolute', 'after:bottom-0',
                                                'after:left-0', 'after:right-0', 'after:h-1',
                                                'after:bg-blue-600', 'after:rounded-t'
                                            );
                                            tabBtn.classList.add('bg-[#083458]');
                                        }
                                    });
                                }

                                function goToForm(currentId, direction) {
                                    const currentIndex = formIds.indexOf(currentId);
                                    if (currentIndex === -1) return;
                                    const newIndex = currentIndex + direction;
                                    if (newIndex < 0 || newIndex >= formIds.length) return;
                                    showForm(formIds[newIndex]);
                                }

                                // Tombol Selanjutnya
                                document.querySelectorAll('button[id^="next-"]').forEach(button => {
                                    button.addEventListener('click', e => {
                                        e.preventDefault();
                                        const currentFormId = button.id.replace('next-', 'form-');
                                        goToForm(currentFormId, 1);
                                    });
                                });

                                // Tombol Sebelumnya 
                                formIds.forEach(id => {
                                    const section = document.getElementById(id);
                                    const prevBtn = section?.querySelector('button.prev');
                                    if (prevBtn) {
                                        prevBtn.addEventListener('click', e => {
                                            e.preventDefault();
                                            goToForm(id, -1);
                                        });
                                    }
                                });

                                // Tab navbar
                                document.querySelectorAll('.tab-button').forEach(tabBtn => {
                                    tabBtn.addEventListener('click', () => {
                                        const tabId = tabBtn.id.replace('btn-', 'form-');
                                        showForm(tabId);
                                    });
                                });

                                showForm(formIds[0]);
                            });
                        </script>

                        <script>
                            let indexBahan = 2;

                            function tambahFormBahan() {
                                const container = document.getElementById('form-bahan-container');
                                const template = document.getElementById('bahan-template');

                                const clone = template.cloneNode(true);
                                clone.removeAttribute('id');
                                clone.classList.remove('hidden'); // pastikan template disembunyikan via CSS, bukan style inline

                                // Reset input value
                                clone.querySelectorAll('input, select').forEach(el => el.value = '');

                                // Tambahkan event hapus
                                const btnHapus = clone.querySelector('.hapus-bahan');
                                if (btnHapus) {
                                    btnHapus.addEventListener('click', () => {
                                        clone.remove();
                                        updateBahanIndex();
                                    });
                                }

                                container.appendChild(clone);
                                updateBahanIndex();
                            }

                            function updateBahanIndex() {
                                const items = document.querySelectorAll('#form-bahan-container .bahan-item');
                                indexBahan = items.length;
                                items.forEach((item, idx) => {
                                    const title = item.querySelector('.font-semibold');
                                    if (title) title.textContent = `Bahan ke-${idx + 1}`;

                                    // Bind ulang tombol hapus (untuk jaga-jaga jika template asli tidak punya event)
                                    const btnHapus = item.querySelector('.hapus-bahan');
                                    if (btnHapus) {
                                        btnHapus.onclick = () => {
                                            item.remove();
                                            updateBahanIndex();
                                        };
                                    }
                                });
                            }

                            function tambahBahanBakar() {
                                const container = document.getElementById('bahan-bakar-container');
                                const template = document.getElementById('bahan-bakar-template');

                                const clone = template.cloneNode(true);
                                clone.removeAttribute('id');
                                clone.querySelectorAll('input, select').forEach(el => {
                                    el.value = '';
                                });

                                const btnHapus = clone.querySelector('.hapus-item');
                                if (btnHapus) {
                                    btnHapus.addEventListener('click', () => {
                                        clone.remove();
                                    });
                                }

                                container.appendChild(clone);
                            }

                            document.addEventListener('DOMContentLoaded', () => {

                                // Inisialisasi tombol hapus bahan bakar pertama
                                const firstBtnBakar = document.querySelector('#bahan-bakar-template .hapus-item');
                                if (firstBtnBakar) {
                                    firstBtnBakar.addEventListener('click', (e) => {
                                        e.target.closest('.bahan-bakar-item').remove();
                                    });
                                }
                            });
                        </script>
                    </div>
                </div>
            </section>
        </main>
    @endsection
