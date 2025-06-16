@extends('layouts.admin')
@section('title', 'Lihat Laporan Distribusi Barang')

@section('content')
<div class="max-w-3xl p-6 mx-auto bg-white rounded shadow">
    <h2 class="mb-4 text-xl font-semibold">Cari Laporan Pupuk</h2>

    {{-- Info Toko --}}
    <div class="mb-4">
        <label class="block font-medium">Nama Toko:</label>
        <input type="text" value="{{ $toko->nama_toko }}" disabled class="w-full p-2 bg-gray-100 border rounded">
    </div>

    {{-- Form Filter --}}
    <form action="{{ route('admin.editLaporanPupuk') }}" method="GET">
        <input type="hidden" name="id_toko" value="{{ $toko->id_toko }}">
        <input type="hidden" name="id_stok_opname" value="{{ $toko->id_stok_opname }}">
        {{-- Jenis Pupuk --}}
        <div class="mb-4">
            <label class="block font-medium">Jenis Pupuk:</label>
            <select name="nama_barang" class="w-full p-2 border rounded" required>
                <option value="">Pilih Jenis Pupuk</option>
                <option value="NPK" {{ request('nama_barang') == 'NPK' ? 'selected' : '' }}>NPK</option>
                <option value="UREA" {{ request('nama_barang') == 'UREA' ? 'selected' : '' }}>UREA</option>
                <option value="NPK-FK" {{ request('nama_barang') == 'NPK-FK' ? 'selected' : '' }}>NPK-FK</option>
            </select>
        </div>

        {{-- Tahun --}}
        <div class="mb-4">
            <label class="block font-medium">Tahun:</label>
            <select name="tahun" class="w-full p-2 border rounded" required>
                <option value="">Pilih Tahun</option>
                @for ($year = date('Y'); $year >= 2020; $year--)
                    <option value="{{ $year }}" {{ request('tahun') == $year ? 'selected' : '' }}>{{ $year }}</option>
                @endfor
            </select>
        </div>

        {{-- Bulan --}}
        <div class="mb-4">
            <label class="block font-medium">Bulan:</label>
            <select name="bulan" class="w-full p-2 border rounded" required>
                <option value="">Pilih Bulan</option>
                @foreach (range(1, 12) as $month)
                    <option value="{{ $month }}" {{ request('bulan') == $month ? 'selected' : '' }}>
                        {{ DateTime::createFromFormat('!m', $month)->format('F') }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Minggu --}}
        <div class="mb-4">
            <label class="block font-medium">Minggu:</label>
            <select name="minggu" class="w-full p-2 border rounded" required>
                <option value="">Pilih Minggu</option>
                <option value="1" {{ request('minggu') == 1 ? 'selected' : '' }}>Minggu 1 (1–7)</option>
                <option value="2" {{ request('minggu') == 2 ? 'selected' : '' }}>Minggu 2 (8–14)</option>
                <option value="3" {{ request('minggu') == 3 ? 'selected' : '' }}>Minggu 3 (15–21)</option>
                <option value="4" {{ request('minggu') == 4 ? 'selected' : '' }}>Minggu 4 (22–31)</option>
            </select>
        </div>

        <button type="submit" class="px-4 py-2 text-white bg-blue-600 rounded hover:bg-blue-700">
            Cari Data
        </button>
    </form>
    @if(session('success'))
        <div class="px-4 py-3 mt-4 mb-4 text-green-800 bg-green-100 border border-green-300 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="px-4 py-3 mt-4 mb-4 text-red-800 bg-red-100 border border-red-300 rounded-lg">
            {{ session('error') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="px-4 py-3 mt-4 mb-4 text-red-800 bg-red-100 border border-red-300 rounded-lg">
            <ul class="space-y-1 list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Hasil Stok Awal --}}
    @if(isset($stokAwal))
        <div class="mt-8 text-center">
            <h3 class="mb-4 text-lg font-semibold">Data Stok Awal</h3>
            
            @if(count($stokAwal) > 0)
                <div class="flex justify-center">
                    <div class="w-full max-w-3xl overflow-auto">
                        <table class="w-full border border-collapse border-gray-300 rounded-lg shadow table-auto">
                            <thead class="bg-gray-100">
                                <tr class="text-center">
                                    <th class="px-4 py-2 border">Tanggal</th>
                                    <th class="px-4 py-2 border">Jumlah</th>
                                    <th class="px-4 py-2 border">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($stokAwal as $item)
                                    <tr class="text-center">
                                        <td class="px-4 py-2 border">{{ $item->tanggal }}</td>
                                        <td class="px-4 py-2 border">{{ $item->stok_awal }}</td>
                                        <td class="px-4 py-2 border">
                                            <button
                                                data-id="{{ $item->id_stok_opname }}"
                                                data-tanggal="{{ $item->tanggal }}"
                                                data-jumlah="{{ $item->stok_awal }}"
                                                class="px-3 py-1 text-white transition bg-yellow-500 rounded hover:bg-yellow-600 open-modal-stok-awal">
                                                Edit
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @else
                <p class="mt-2 text-sm text-gray-500">Tidak ada data stok awal.</p>
            @endif
        </div>
    @endif


    {{-- Hasil Penyaluran --}}
    @if(isset($penyaluran))
        <div class="mt-8 text-center">
            <h3 class="mb-4 text-lg font-semibold">Data Penyaluran</h3>
            @if($penyaluran)
                <div class="flex justify-center">
                    <div class="w-full max-w-3xl overflow-auto">
                        <table class="w-full border border-collapse border-gray-300 rounded-lg shadow table-auto">
                            <thead class="bg-gray-100">
                                <tr class="text-center">
                                    <th class="px-4 py-2 border">Tanggal</th>
                                    <th class="px-4 py-2 border">Jumlah Penyaluran</th>
                                    <th class="px-4 py-2 border">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="text-center">
                                    <td class="px-4 py-2 border">{{ $penyaluran->tanggal }}</td>
                                    <td class="px-4 py-2 border">{{ $penyaluran->penyaluran }}</td>
                                    <td class="px-4 py-2 border">
                                        <button
                                            data-id="{{ $penyaluran->id_stok_opname }}"
                                            data-tanggal="{{ $penyaluran->tanggal }}"
                                            data-jumlah="{{ $penyaluran->penyaluran }}"
                                            class="px-3 py-1 text-white transition bg-yellow-500 rounded hover:bg-yellow-600 open-modal-penyaluran">
                                            Edit
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            @else
                <p class="mt-2 text-sm text-gray-500">Tidak ada data penyaluran untuk minggu ini.</p>
            @endif
        </div>
    @endif

</div>

<!-- Modal Edit Stok Awal -->
<div id="modalStokAwal" class="fixed top-0 left-0 z-50 hidden w-full h-full bg-black bg-opacity-50">
    <div class="p-6 mx-auto mt-32 bg-white rounded shadow w-96">
        <h2 class="mb-4 text-lg font-semibold">Edit Stok Awal</h2>
        <form id="formEditStokAwal" method="POST" action="{{ route('admin.updateStokAwal') }}">
            @csrf
            @method('PUT')
            <input type="hidden" name="id_stok_opname" id="edit-id">
            <div class="mb-4">
                <label class="block">Tanggal:</label>
                <input type="text" name="tanggal" id="edit-tanggal" class="w-full p-2 bg-gray-100 border rounded" readonly>
            </div>
            <div class="mb-4">
                <label class="block">Jumlah:</label>
                <input type="number" name="stok_awal" id="edit-jumlah" class="w-full p-2 border rounded" required>
            </div>
            <div class="flex justify-end">
                <button type="button" id="closeModalStok" class="px-4 py-2 mr-2 text-white bg-gray-400 rounded">Batal</button>
                <button type="submit" class="px-4 py-2 text-white bg-blue-600 rounded">Simpan</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Edit Penyaluran -->
<div id="modalEditPenyaluran" class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black bg-opacity-50">
    <div class="w-full max-w-md p-6 bg-white rounded shadow">
        <form action="{{ route('admin.updatePenyaluran') }}" method="POST">
            @csrf
            <input type="hidden" name="id_stok_opname" id="penyaluran_id">
            
            <div class="mb-4">
                <label class="block font-medium">Tanggal:</label>
                <input type="text" id="penyaluran_tanggal" class="w-full p-2 bg-gray-100 border rounded" disabled>
            </div>

            <div class="mb-4">
                <label class="block font-medium">Penyaluran:</label>
                <input type="number" name="penyaluran" id="penyaluran_jumlah" class="w-full p-2 border rounded" required>
            </div>

            <div class="flex justify-end">
                <button type="button" class="px-4 py-2 mr-2 text-white bg-gray-400 rounded close-modal">Batal</button>
                <button type="submit" class="px-4 py-2 text-white bg-blue-600 rounded">Simpan</button>
            </div>
        </form>
    </div>
</div>



<script>
    document.querySelectorAll('.open-modal-stok-awal').forEach(button => {
        button.addEventListener('click', () => {
            const id = button.dataset.id;
            const tanggal = button.dataset.tanggal;
            const jumlah = button.dataset.jumlah;

            document.getElementById('edit-id').value = id;
            document.getElementById('edit-tanggal').value = tanggal;
            document.getElementById('edit-jumlah').value = jumlah;

            document.getElementById('modalStokAwal').classList.remove('hidden');
        });
    });

    document.getElementById('closeModalStok').addEventListener('click', () => {
        document.getElementById('modalStokAwal').classList.add('hidden');
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const modal = document.getElementById('modalEditPenyaluran');
        const openButtons = document.querySelectorAll('.open-modal-penyaluran');
        const closeButtons = document.querySelectorAll('.close-modal');

        openButtons.forEach(btn => {
            btn.addEventListener('click', function () {
                document.getElementById('penyaluran_id').value = this.dataset.id;
                document.getElementById('penyaluran_tanggal').value = this.dataset.tanggal;
                document.getElementById('penyaluran_jumlah').value = this.dataset.jumlah;
                modal.classList.remove('hidden');
            });
        });

        closeButtons.forEach(btn => {
            btn.addEventListener('click', () => {
                modal.classList.add('hidden');
            });
        });
    });
</script>



@endsection
