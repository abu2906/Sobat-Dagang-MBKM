@extends('layouts.admin')
@section('title', 'Data IKM')

@section('content')
    <main class="flex-1 flex flex-col bg-gray-100 w-full">
        <header class="relative">
            <img src="{{ asset('/assets/img/background/user_industri.png') }}" class="w-full h-[210px] object-cover"
                alt="Header">

            <div
                class="absolute bottom-0 left-1/2 transform -translate-x-1/2 translate-y-1/2 w-11/12 bg-white rounded-xl shadow-lg px-6 py-4 flex flex-wrap justify-between gap-4 items-center z-20">
                <div class="flex items-center bg-[#CAE2F6] rounded-lg px-4 py-2 flex-1 shadow-md">
                    <span class="material-symbols-outlined text-gray-500 mr-2"></span>
                    <input type="text" id="searchInput" placeholder="Cari"
                        class="bg-transparent w-full focus:outline-none">
                </div>

                <div class="relative w-48">
                    <select id="filterKecamatan" onchange="filterTabel()"
                        class="appearance-none bg-[#CAE2F6] rounded-lg px-4 py-2 pr-8 w-full focus:outline-none shadow-md">
                        <option value="">Kecamatan</option>
                        <option value="Soreang">Soreang</option>
                        <option value="Ujung">Ujung</option>
                        <option value="Bacukiki">Bacukiki</option>
                    </select>
                    <i class="fas fa-sliders-h absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none w-4 h-4"></i>
                </div>

                <div class="relative w-48">
                    <select id="filterInvestasi" onchange="filterTabel()"
                        class="appearance-none bg-[#CAE2F6] rounded-lg px-4 py-2 pr-8 w-full focus:outline-none shadow-md">
                        <option value="">Investasi</option>
                        <option value="Kecil">Kecil</option>
                        <option value="Menengah">Menengah</option>
                        <option value="Besar">Besar</option>
                    </select>
                    <i class="fas fa-sliders-h absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none w-4 h-4"></i>
                </div>

                <a href="{{ route('form.dataIKM') }}"
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
                    ['nama' => 'Kimia & Bahan Bangunan', 'ikon' => 'kimia.png'],
                    ['nama' => 'Logam & Elektronika', 'ikon' => 'logam.png'],
                    ['nama' => 'Kerajinan', 'ikon' => 'kerajinan.png'],
                ];

                foreach ($kategoriList as &$kategori) {
                    $kategori['jumlah'] = \App\Models\DataIKM::where('jenis_industri', $kategori['nama'])->count();
                }
                unset($kategori); // hindari reference carryover

            @endphp

            @foreach ($kategoriList as $kategori)
                <div onclick="selectKategori(this)"
                    class="kategori-card cursor-pointer flex flex-col items-center bg-white p-3 rounded-xl shadow-lg w-44 border-2 border-transparent transition transform hover:scale-105 text-center">
                    <img src="{{ asset('assets/img/kategori/' . $kategori['ikon']) }}" alt="{{ $kategori['nama'] }} Icon"
                        class="w-10 h-10 object-contain">
                    <span
                        class="font-semibold mt-1 text-[#083458] leading-tight min-h-[2rem] flex items-center justify-center text-center">
                        {{ $kategori['nama'] }}
                    </span>
                    <span class="text-sm text-gray-500">{{ $kategori['jumlah'] }}</span>
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
                            <th class="p-3">LUAS USAHA</th>
                            <th class="p-3">ALAMAT</th>
                            <th class="p-3">KELURAHAN</th>
                            <th class="p-3">KECAMATAN</th>
                            <th class="p-3">KOMODITI</th>
                            <th class="p-3">JENIS INDUSTRI</th>
                            <th class="p-3">TELEPON</th>
                            <th class="p-3">TENAGA KERJA</th>
                            <th class="p-3 rounded-tr-xl">AKSI</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($dataIkm as $index => $ikm)
                            <tr class="bg-white border-b row-ikm" data-kecamatan="{{ $ikm->kecamatan }}"
                                data-industri="{{ $ikm->jenis_industri }}">
                                <td class="p-2 text-center">{{ $index + 1 }}</td>
                                <td class="p-2">{{ $ikm->nama_ikm }}</td>
                                <td class="p-2">{{ $ikm->nama_pemilik }}</td>
                                <td class="p-2 text-center">{{ $ikm->jenis_kelamin }}</td>
                                <td class="p-2">{{ $ikm->luas }}</td>
                                <td class="p-2">{{ $ikm->alamat }}</td>
                                <td class="p-2">{{ $ikm->kelurahan }}</td>
                                <td class="p-2">{{ $ikm->kecamatan }}</td>
                                <td class="p-2">{{ $ikm->komoditi }}</td>
                                <td class="p-2">{{ $ikm->jenis_industri }}</td>
                                <td class="p-2">{{ $ikm->no_telp }}</td>
                                <td class="p-2 text-center">{{ $ikm->tenaga_kerja }}</td>
                                <td class="p-2 text-center">
                                    <div class="flex justify-center gap-2">
                                        <a href="{{ route('editIKM', $ikm->id_ikm) }}"
                                            class="bg-blue-500 hover:bg-blue-600 text-white text-xs px-3 py-1 rounded-lg">Edit</a>
                                        <form action="{{ route('destroyIKM', $ikm->id_ikm) }}"
                                            method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?');"
                                            class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="bg-red-500 hover:bg-red-600 text-white text-xs px-3 py-1 rounded-lg">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <p id="noResults" class="text-center mt-4 font-medium text-red-500 hidden">Data tidak ditemukan.</p>

            </div>
        </section>
    </main>
@endsection

@section('scripts')
    <script>
        let kategoriDipilih = '';

        function selectKategori(el) {
            const allCards = document.querySelectorAll('.kategori-card');
            allCards.forEach(card => {
                card.classList.remove('bg-[#CAE2F6]', 'border-[#003366]', 'border-2');
            });

            el.classList.add('bg-[#CAE2F6]', 'border-[#003366]', 'border-2');
            kategoriDipilih = el.querySelector('.font-semibold').textContent.trim();
            filterTabel();
        }

        function filterTabel() {
            const selectedKecamatan = document.getElementById('filterKecamatan').value.trim().toLowerCase();
            const searchKeyword = document.getElementById('searchInput').value.trim().toLowerCase();
            const rows = document.querySelectorAll('.row-ikm');

            let anyVisible = false;

            rows.forEach(row => {
                const rowKecamatan = row.getAttribute('data-kecamatan')?.trim().toLowerCase() || '';
                const rowIndustri = row.getAttribute('data-industri')?.trim().toLowerCase() || '';
                const rowText = row.textContent.toLowerCase();

                const cocokKecamatan = !selectedKecamatan || rowKecamatan === selectedKecamatan;
                const cocokIndustri = !kategoriDipilih || rowIndustri === kategoriDipilih.toLowerCase();
                const cocokCari = !searchKeyword || rowText.includes(searchKeyword);

                const show = cocokKecamatan && cocokIndustri && cocokCari;
                row.style.display = show ? '' : 'none';

                if (show) anyVisible = true;
            });

            const noResultsEl = document.getElementById('noResults');
            if (noResultsEl) {
                noResultsEl.style.display = anyVisible ? 'none' : 'block';
            }
        }


        document.addEventListener('DOMContentLoaded', () => {
            filterTabel();
            document.getElementById('filterKecamatan').addEventListener('change', filterTabel);
            document.getElementById('filterInvestasi').addEventListener('change', filterTabel);
            document.getElementById('searchInput').addEventListener('input', filterTabel);

        });
    </script>
@endsection
