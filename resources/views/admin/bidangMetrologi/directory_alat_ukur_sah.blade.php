@extends('layouts.metrologi.admin')

@section('content')

<div class="p-6 bg-gray-100 min-h-screen">
    <!-- Header Background -->
    <div class="relative h-[150px] w-full bg-cover bg-[center_87%]" style="background-image: url('/assets/img/background/user_metrologi.png');">
        <!-- Floating Filter + Button -->
        <div class="absolute bottom-[-30px] w-full px-8">
            <div class="flex flex-wrap items-center justify-between p-4 rounded-xl shadow-md">
                <!-- Filter/Search Input -->
                <div class="relative flex-grow mt-2 md:mt-0">
                    <input type="text" placeholder="Cari" class="pl-10 pr-4 py-2 rounded-full shadow text-sm w-full">
                    <span class="absolute left-3 top-2 text-gray-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-4.35-4.35M17 11a6 6 0 11-12 0 6 6 0 0112 0z" />
                        </svg>
                    </span>
                </div>

                <!-- Add Button -->
                <button onclick="openModal()" class="mt-2 md:mt-0 text-white flex items-center gap-2 bg-[#0c3252] transition-colors duration-300 hover:bg-[#F49F1E] hover:text-black rounded-full px-8 py-2 ml-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Tambah Alat Ukur Sah
                </button>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Alat Ukur -->
    <div id="modalTambahAlat" class="absolute inset-0 z-40 hidden bg-black bg-opacity-30 flex items-center justify-center">
            <div class="bg-white w-[90%] md:w-[70%] lg:w-[50%] rounded-lg shadow-lg p-6 max-h-[90vh] overflow-y-auto">
                <div class="flex justify-between items-center border-b pb-3 mb-4">
                    <h2 class="text-lg font-semibold">Tambah Alat Ukur Sah</h2>
                    <button onclick="tutupModal()" class="text-gray-500 hover:text-gray-800">&times;</button>
                </div>

                <form action="{{ route('store-uttp') }}" method="POST">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium">Tanggal</label>
                            <input type="date" name="tanggal_penginputan" class="w-full border rounded px-3 py-2">
                        </div>
                        <div>
                            <label class="block text-sm font-medium">ID User</label>
                            <input type="number" name="id_user" class="w-full border rounded px-3 py-2">
                        </div>
                        <div>
                            <label class="block text-sm font-medium">No Registrasi</label>
                            <input type="text" name="no_registrasi" class="w-full border rounded px-3 py-2">
                        </div>
                        <div>
                            <label class="block text-sm font-medium">Nama Usaha</label>
                            <input type="text" name="nama_usaha" class="w-full border rounded px-3 py-2">
                        </div>
                        <div>
                            <label class="block text-sm font-medium">Jenis Alat</label>
                            <select id="jenis_alat" name="jenis_alat" class="w-full border rounded px-3 py-2">
								<option value="UP-MK">UP-MK</option>
								<option value="VOL-TK">VOLUME - TK</option>
								<option value="VOL-TUTSIT">VOLUME - TUTSIT</option>
								<option value="VOL-TUM">VOLUME - TUM</option>
								<option value="VOL-PUBBM">VOLUME - PUBBM</option>
								<option value="VOL-MA">VOLUME - MA</option>
								<option value="VOL-DLL">VOLUME - Lainnya</option>
								<option value="MAS-DL">MASSA - DL</option>
								<option value="MAS-TP">MASSA - TP</option>
								<option value="MAS-TM">MASSA - TM</option>
								<option value="MAS-TS">MASSA - TS</option>
								<option value="MAS-NE">MASSA - NE</option>
								<option value="MAS-ATB">MASSA - ATB</option>
								<option value="MAS-ATH">MASSA - ATH</option>
								<option value="MAS-TE">MASSA - TE</option>
								<option value="MAS-TJE">MASSA - TJE</option>
								<option value="MAS-DLL">MASSA - Lainnya</option>
							</select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium">Nama Alat</label>
                            <input type="text" name="nama_alat" class="w-full border rounded px-3 py-2">
                        </div>
                        <div>
                            <label class="block text-sm font-medium">Merk / Type</label>
                            <input type="text" name="merk_type" class="w-full border rounded px-3 py-2">
                        </div>
                        <div>
                            <label class="block text-sm font-medium">Nomor Seri</label>
                            <input type="text" name="nomor_seri" class="w-full border rounded px-3 py-2">
                        </div>
                        <div>
                            <label class="block text-sm font-medium">Jumlah Alat</label>
                            <input type="number" name="jumlah_alat" class="w-full border rounded px-3 py-2">
                        </div>
                        <div>
                            <label class="block text-sm font-medium">Alat Penguji</label>
                            <select id="alat_penguji" name="alat_penguji" class="w-full border rounded px-3 py-2">
								<option value="BUS">BUS</option>
								<option value="AT">Anak Timbangan</option>
								<option value="ATB">ATB</option>
							</select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium">Ctt</label>
                            <input type="text" name="ctt" class="w-full border rounded px-3 py-2">
                        </div>
                        <div>
                            <label class="block text-sm font-medium">SPT Keperluan</label>
                            <input type="text" name="spt_keperluan" class="w-full border rounded px-3 py-2">
                        </div>
                        <div>
                            <label class="block text-sm font-medium">Tanggal Selesai</label>
                            <input type="date" name="tanggal_selesai" class="w-full border rounded px-3 py-2">
                        </div>
                        <div>
                            <label class="block text-sm font-medium">Terapan</label>
                            <input type="text" name="terapan" class="w-full border rounded px-3 py-2">
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium">Keterangan</label>
                            <textarea name="keterangan" class="w-full border rounded px-3 py-2"></textarea>
                        </div>
                    </div>

                    <div class="mt-4 flex justify-end gap-2">
                        <button type="button" onclick="tutupModal()" class="bg-gray-200 px-4 py-2 rounded hover:bg-gray-300">Batal</button>
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Simpan</button>
                    </div>
                </form>
            </div>
    </div>
    
    <!-- Tabel Alat Ukur Sah -->
    <div class="overflow-x-auto rounded-lg shadow-sm mt-6">
        <table class="min-w-full text-sm text-left text-gray-700 bg-white border border-gray-200">
            <thead class="bg-[#0c3252] text-white">
                <tr>
                    <th scope="col" class="text-center px-5 py-3 font-medium border-b border-blue-100">No</th>
                    <th scope="col" class="text-center px-5 py-3 font-medium border-b border-blue-100">Jenis Alat</th>
                    <th scope="col" class="text-center px-5 py-3 font-medium border-b border-blue-100">Nomor Registrasi</th>
                    <th scope="col" class="text-center px-5 py-3 font-medium border-b border-blue-100">Tanggal Tera</th>
                    <th scope="col" class="text-center px-5 py-3 font-medium border-b border-blue-100">Tanggal Exp</th>
                    <th scope="col" class="text-center px-5 py-3 font-medium border-b border-blue-100">Status</th>
                    <th scope="col" class="text-center px-5 py-3 font-medium border-b border-blue-100">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($alatUkur as $index => $data)
                <tr class="hover:bg-blue-50 transition">
                    <td class="px-5 text-center py-3 border-b">{{ $index + 1 }}</td>
                    <td class="px-5 text-center py-3 border-b">{{ $data->uttp->jenis_alat }}</td>
                    <td class="px-5 text-center py-3 border-b">{{ $data->uttp->no_registrasi }}</td>
                    <td class="px-5 text-center py-3 border-b">{{ \Carbon\Carbon::parse($data->uttp->tanggal_penginputan)->format('d F Y') }}</td>
                    <td class="px-5 text-center py-3 border-b">
                        {{ optional($data)->tanggal_exp ? \Carbon\Carbon::parse($data->tanggal_exp)->format('d F Y') : '-' }}
                    </td>
                    <td class="px-5 text-center py-3 border-b">
                        <span class="
                            font-semibold
                            {{ $data->status === 'Valid' ? 'text-green-600' : ($data->status === 'Kadaluarsa' ? 'text-red-600' : 'text-gray-500') }}">
                            {{ $data->status ?? '-' }}
                        </span>
                    </td>
                    <td class="px-5 text-center py-3 border-b">
                        <!-- Tombol aksi -->
                        <button onclick="bukaModalEdit({{ $data->uttp->id_user }})" class="p-2 rounded hover:bg-blue-100 transition duration-200">
                            <span class="material-symbols-outlined">edit</span>
                        </button>
                        <button class="p-2 rounded hover:bg-red-100 transition duration-200">
                            <span class="material-symbols-outlined">delete</span>
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
    function openModal(){
        document.getElementById('modalTambahAlat').classList.remove('hidden');
    }

    function tutupModal() {
        document.getElementById('modalTambahAlat').classList.add('hidden');
    }
</script>

@endsection