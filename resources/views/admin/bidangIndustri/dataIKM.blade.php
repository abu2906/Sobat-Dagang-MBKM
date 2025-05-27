    @extends('layouts.admin')
    @section('title', 'Data IKM')

    @section('content')
        <main class="flex-1 flex flex-col bg-gray-100 min-h-screen" x-data="ikmEdit()" x-init="init()">
            <header class="relative z-10">
                <img src="{{ asset('/assets/img/background/user_industri.png') }}" class="w-full h-[210px] object-cover"
                    alt="Header">

                <div
                    class="absolute bottom-0 left-1/2 transform -translate-x-1/2 translate-y-1/2 w-11/12 bg-white rounded-xl shadow-lg px-6 py-4 flex flex-wrap justify-between gap-4 items-center z-20">
                    <div class="flex items-center bg-[#CAE2F6] rounded-lg px-4 py-2 flex-1 shadow-md">
                        <i class="fas fa-search text-gray-500 ml-2"></i>
                        <input type="text" id="searchInput" placeholder="Cari"
                            class="ml-2 bg-transparent w-full focus:outline-none">
                        
                    </div>

                    <div class="relative w-48">
                        <select id="filterKecamatan" onchange="filterTabel()"
                            class="appearance-none bg-[#CAE2F6] rounded-lg px-4 py-2 pr-8 w-full focus:outline-none shadow-md">
                            <option value="">Kecamatan</option>
                            <option value="Soreang">Soreang</option>
                            <option value="Ujung">Ujung</option>
                            <option value="Bacukiki">Bacukiki</option>
                            <option value="BacukikiBarat">Bacukiki Barat</option>
                        </select>
                        <i
                            class="fas fa-sliders-h absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none w-4 h-4"></i>
                    </div>

                    <div class="relative w-48">
                        <select id="filterInvestasi" onchange="filterTabel()"
                            class="appearance-none bg-[#CAE2F6] rounded-lg px-4 py-2 pr-8 w-full focus:outline-none shadow-md">
                            <option value="">Investasi</option>
                            <option value="Kecil">Kecil</option>
                            <option value="Menengah">Menengah</option>
                            <option value="Besar">Besar</option>
                        </select>
                        <i
                            class="fas fa-sliders-h absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none w-4 h-4"></i>
                    </div>

                    <a href="{{ route('formIKM') }}"
                        class="bg-[#003366] text-white font-semibold rounded-lg px-4 py-2 shadow-md hover:bg-white hover:text-[#003366] border border-transparent hover:border-[#003366] transition duration-300">
                        TAMBAH DATA
                    </a>

                    <form method="GET" action="{{ route('exportIKM') }}" id="exportForm">
                        <input type="hidden" name="kecamatan" id="inputKecamatan">
                        <input type="hidden" name="search" id="inputSearch">
                        <div id="inputJenisContainer"></div>
                        <input type="hidden" name="investasi[]" id="inputInvestasi">
                        <button type="submit"
                            class="bg-[#0A4D68] text-white font-semibold rounded-lg px-4 py-2 shadow-md hover:bg-white hover:text-[#0A4D68] border border-transparent hover:border-[#0A4D68] transition duration-300">
                            UNDUH DATA
                        </button>
                    </form>



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
                    unset($kategori);

                @endphp

                @foreach ($kategoriList as $kategori)
                    <div onclick="selectKategori(this)"
                        class="kategori-card cursor-pointer flex flex-col items-center bg-white p-3 rounded-xl shadow-lg w-44 border-2 border-transparent transition transform hover:scale-105 text-center">
                        <img src="{{ asset('assets/img/kategori/' . $kategori['ikon']) }}"
                            alt="{{ $kategori['nama'] }} Icon" class="w-10 h-10 object-contain">
                        <span
                            class="font-semibold mt-1 text-[#083458] leading-tight min-h-[2rem] flex items-center justify-center text-center">
                            {{ $kategori['nama'] }}
                        </span>
                        <span class="text-sm text-gray-500">{{ $kategori['jumlah'] }}</span>
                    </div>
                @endforeach
            </section>

            <div class="container px-4 pb-4 mx-auto">
                <section class="overflow-hidden mt-12 px-6 pb-16">
                    <div class="overflow-x-auto overflow-y-auto max-h-[350px] rounded-lg">
                        <table class="w-full border-collapse table-auto text-sm bg-white shadow-md">
                            <thead class="text-white bg-[#083458] sticky top-0 z-10">
                                <tr>
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
                                    <th class="p-3">INVESTASI</th>
                                    <th class="p-3 rounded-tr-xl">AKSI</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($dataIkm as $index => $ikm)
                                    <tr class="bg-white border-b row-ikm" data-kecamatan="{{ $ikm->kecamatan }}"
                                        data-industri="{{ $ikm->jenis_industri }}" data-investasi-nilai="{{ $ikm->level }}">
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
                                        <td class="p-3">{{ 'Rp ' . number_format($ikm->level, 0, ',', '.') }}</td>
                                        <td class="p-2 text-center">
                                            <div class="flex justify-center gap-2">
                                                <button type="button" @click='openEdit(@json($ikm))'
                                                    class="bg-blue-500 hover:bg-blue-600 text-white text-xs px-3 py-1 rounded-lg">
                                                    Edit
                                                </button>

                                                <form action="{{ route('destroyIKM', $ikm->id_ikm) }}" method="POST"
                                                    onsubmit="return confirm('Yakin ingin menghapus data ini?');"
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
            </div>

            <!-- Overlay -->
            <div x-show="openModal" x-transition.opacity
                class="fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm z-40">
            </div>

            <!-- Modal -->
             <style>
                [x-cloak] { display: none !important; }
                </style>
            <div x-show="openModal" x-cloak class="fixed inset-0 flex items-start justify-center z-50 p-4">
                <div @click.away="openModal = false" @keydown.escape.window="openModal = false" tabindex="0"
                    class="relative w-full max-w-3xl bg-white rounded-lg shadow-lg p-8 mt-24 overflow-auto max-h-[80vh]">
                    <button @click="openModal = false" type="button"
                        class="absolute top-4 right-4 text-2xl font-bold leading-none hover:text-gray-700 focus:outline-none">
                        &times;
                    </button>

                    <h2 class="mb-6 text-center text-lg font-bold md:text-xl">EDIT DATA IKM</h2>

                    <form :action="'{{ url('data-IKM/store') }}'" method="POST" class="space-y-6">
                        @csrf
                        <input type="hidden" name="id" :value="formData.id_ikm">

                        <div class="grid md:grid-cols-2 gap-6">
                            <template x-for="(label, name) in fieldMap" :key="name">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1" x-text="label"></label>
                                    <input type="text" :name="name" x-model="formData[name]" required
                                        class="w-full rounded-lg border border-gray-300 px-4 py-2 text-sm focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 shadow-sm transition">
                                </div>
                            </template>
                        </div>

                        <div class="flex justify-center">
                            <button type="submit"
                                class="rounded-2xl bg-[#083458] px-8 py-3 text-white font-semibold shadow-md hover:shadow-lg transition duration-200">
                                Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </main>
    @endsection

    @push('scripts')
        <script>
            let kategoriDipilih = [];


            function selectKategori(el) {
                const selectedText = el.querySelector('.font-semibold').textContent.trim();

                const index = kategoriDipilih.indexOf(selectedText);
                if (index > -1) {
                    // Sudah dipilih → hapus dari array
                    kategoriDipilih.splice(index, 1);
                    el.classList.remove('bg-blue-100', 'border-blue-900', 'border-2');
                    el.classList.add('bg-white', 'border-transparent');
                } else {
                    // Belum dipilih → tambahkan ke array
                    kategoriDipilih.push(selectedText);
                    el.classList.remove('bg-white', 'border-transparent');
                    el.classList.add('bg-blue-100', 'border-blue-900', 'border-2');
                }

                filterTabel();
            }

            function filterTabel() {
                const selectedKecamatan = document.getElementById('filterKecamatan').value.trim().toLowerCase();
                const searchKeyword = document.getElementById('searchInput').value.trim().toLowerCase();
                const selectedInvestasi = document.getElementById('filterInvestasi').value.trim().toLowerCase();
                const rows = document.querySelectorAll('.row-ikm');

                let anyVisible = false;

                rows.forEach(row => {
                    const rowKecamatan = row.getAttribute('data-kecamatan')?.trim().toLowerCase() || '';
                    const rowIndustri = row.getAttribute('data-industri')?.trim().toLowerCase() || '';

                    const investasiNilaiStr = row.getAttribute('data-investasi-nilai') || '0';

                    // Bersihkan string supaya hanya angka
                    const angkaBersih = investasiNilaiStr.replace(/[^0-9]/g, '');
                    const investasiNilai = parseFloat(angkaBersih) || 0;

                    let kategoriInvestasi = '';
                    if (investasiNilai < 100000000) {
                        kategoriInvestasi = 'kecil';
                    } else if (investasiNilai >= 100000000 && investasiNilai < 1000000000) {
                        kategoriInvestasi = 'menengah';
                    } else {
                        kategoriInvestasi = 'besar';
                    }

                    const rowText = row.textContent.toLowerCase();

                    const cocokKecamatan = !selectedKecamatan || rowKecamatan === selectedKecamatan;
                    const cocokIndustri = kategoriDipilih.length === 0 || kategoriDipilih.map(k => k.toLowerCase())
                        .includes(rowIndustri);
                    const cocokInvestasi = !selectedInvestasi || kategoriInvestasi === selectedInvestasi;
                    const cocokCari = !searchKeyword || rowText.includes(searchKeyword);

                    const show = cocokKecamatan && cocokIndustri && cocokInvestasi && cocokCari;
                    row.style.display = show ? '' : 'none';

                    if (show) anyVisible = true;
                });

                const noResultsEl = document.getElementById('noResults');
                if (noResultsEl) {
                    noResultsEl.style.display = anyVisible ? 'none' : 'block';
                }
            }

            function syncExportFilter() {
                document.getElementById('inputKecamatan').value = document.getElementById('filterKecamatan').value;
                document.getElementById('inputSearch').value = document.getElementById('searchInput').value;

                const container = document.getElementById('inputJenisContainer');
                container.innerHTML = '';

                kategoriDipilih.forEach(jenis => {
                    const input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = 'jenis[]';
                    input.value = jenis;
                    container.appendChild(input);
                });

                const filterInvestasiSelect = document.getElementById('filterInvestasi');
                const investasiDipilih = [];

                if (filterInvestasiSelect && filterInvestasiSelect.value.trim() !== '') {
                    investasiDipilih.push(filterInvestasiSelect.value.trim().toLowerCase());
                }

                const oldInvestasiInputs = document.querySelectorAll('input[name="investasi[]"]');
                oldInvestasiInputs.forEach(el => el.remove());

                investasiDipilih.forEach(inv => {
                    const input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = 'investasi[]';
                    input.value = inv;
                    container.appendChild(input);
                });
            }

            document.addEventListener('DOMContentLoaded', () => {
                filterTabel();

                document.getElementById('filterKecamatan').addEventListener('change', filterTabel);
                document.getElementById('filterInvestasi').addEventListener('change', filterTabel);
                document.getElementById('searchInput').addEventListener('input', filterTabel);

                const exportForm = document.querySelector('form[action$="export"]');
                if (exportForm) {
                    exportForm.addEventListener('submit', syncExportFilter);
                }
            });
        </script>

        <script>
            function ikmEdit() {
                return {
                    openModal: false,
                    formData: {},
                    fieldMap: {
                        nama_ikm: 'Nama Usaha',
                        luas: 'Luas Usaha',
                        nama_pemilik: 'Nama Pemilik',
                        jenis_kelamin: 'Jenis Kelamin',
                        kecamatan: 'Kecamatan',
                        kelurahan: 'Kelurahan',
                        komoditi: 'Komoditi',
                        jenis_industri: 'Jenis Industri',
                        alamat: 'Alamat',
                        nib: 'NIB',
                        no_telp: 'Nomor Telepon',
                        tenaga_kerja: 'Jumlah Tenaga Kerja',
                    },
                    openEdit(data) {
                        this.formData = {
                            ...data
                        };
                        this.openModal = true;
                    },
                    init() {}
                }
            }
        </script>
    @endpush
