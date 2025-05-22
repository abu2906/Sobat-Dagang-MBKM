@extends('layouts.metrologi.admin')

@section('content')

<div class="p-6 bg-gray-100 min-h-screen">
    <!-- Header Background -->
    <div class="relative h-[150px] w-full bg-cover bg-[center_87%]" style="background-image: url('/assets/img/background/user_metrologi.png');">
        <!-- Floating Filter + Button -->
        <div class="absolute bottom-[-30px] w-full px-8">
            <div class="flex flex-wrap items-center justify-between p-4 rounded-xl shadow-md">
                <!-- Filter/Search Input -->
                <div class="flex space-x-4 mb-2 md:mb-0">
                    <select id="statusFilter" class="px-4 py-2 rounded-full border shadow text-sm">
                        <option value="">Semua</option>
                        <option value="Valid">Valid</option>
                        <option value="Kadaluarsa">Kadaluarsa</option>
                    </select>
                </div>
                <div class="relative flex-grow mt-2 md:mt-0 mx-4">
                    <input type="text" id="searchInput" placeholder="Cari" class="pl-10 pr-4 py-2 rounded-full shadow text-sm w-full">
                    <span class="absolute left-3 top-2 text-gray-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-4.35-4.35M17 11a6 6 0 11-12 0 6 6 0 0112 0z" />
                        </svg>
                    </span>
                </div>
                <!-- Add Button -->
                <div class="flex gap-4 mt-2 md:mt-0">
                    <a href="{{ route('uttp.download') }}" class="text-white flex items-center gap-2 bg-[#0c3252] transition-colors duration-300 hover:bg-[#F49F1E] hover:text-black rounded-full px-6 py-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                        </svg>
                        Download
                    </a>
                    <button onclick="openModal()" class="text-white flex items-center gap-2 bg-[#0c3252] transition-colors duration-300 hover:bg-[#F49F1E] hover:text-black rounded-full px-8 py-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Tambah UTTP
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Popup Review -->
    <div id="popupDetailAlat" class="fixed inset-0 z-50 hidden justify-center items-center bg-opacity-50">
        <div class="bg-white p-6 rounded-xl w-[450px] max-w-full relative shadow-xl">
            <button onclick="togglePopup(false)" class="absolute top-2 right-3 text-gray-500 hover:text-black text-xl font-bold">&times;</button>
            <h2 class="text-center font-bold text-lg mb-4">
                Detail Alat Ukur - 
                <span id="popupNoReg" class="text-gray-600"></span>
            </h2>
            <table class="w-full text-sm">
                <tbody id="popupDetailBody"></tbody>
            </table>
        </div>
    </div>

    <!-- Modal Tambah Alat Ukur -->
    <div id="modalTambahAlat" class="absolute inset-0 z-40 hidden bg-black bg-opacity-30 flex items-center justify-center">
            <div class="bg-white w-[90%] md:w-[70%] lg:w-[50%] rounded-lg shadow-lg p-6 max-h-[90vh] overflow-y-auto">
                <div class="flex justify-between items-center border-b pb-3 mb-4">
                    <h2 class="text-lg font-semibold">Tambah UTTP</h2>
                    <button onclick="tutupModal()" class="text-gray-500 hover:text-gray-800">&times;</button>
                </div>

                <form id="form-alat" method="POST" action="{{ route('store-uttp') }}" onsubmit="handleSubmit(event)">
                @csrf
                <input type="hidden" name="_method" id="formMethod" value="POST">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium">Tanggal Mulai <span class="text-red-500">*</span></label>
                            <input type="date" name="tanggal_penginputan" class="w-full border rounded px-3 py-2" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium">Tanggal Selesai <span class="text-red-500">*</span></label>
                            <input type="date" name="tanggal_selesai" class="w-full border rounded px-3 py-2" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium">ID User</label>
                            <input type="number" name="id_user" class="w-full border rounded px-3 py-2">
                            <p class="text-xs text-gray-500 mt-1">Kosongkan bila pemilik uttp tidak terdaftar pada sistem</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium">No Registrasi <span class="text-red-500">*</span></label>
                            <input type="text" name="no_registrasi" class="w-full border rounded px-3 py-2" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium">Nama Usaha <span class="text-red-500">*</span></label>
                            <input type="text" name="nama_usaha" class="w-full border rounded px-3 py-2" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium">Jenis Alat <span class="text-red-500">*</span></label>
                            <select id="jenis_alat" name="jenis_alat" class="w-full border rounded px-3 py-2" required>
                                <option value="" class="text-gray-400" selected>Pilih Jenis Alat</option>
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
                            <label class="block text-sm font-medium">Merk / Type</label>
                            <input type="text" name="merk_type" class="w-full border rounded px-3 py-2">
                        </div>
                        <div>
                            <label class="block text-sm font-medium">Kapasitas</label>
                            <input type="text" name="nama_alat" class="w-full border rounded px-3 py-2">
                        </div>
                        <div>
                            <label class="block text-sm font-medium">Nomor Seri</label>
                            <input type="text" name="nomor_seri" class="w-full border rounded px-3 py-2">
                        </div>
                        <div>
                            <label class="block text-sm font-medium">Alat Penguji <span class="text-red-500">*</span></label>
                            <select id="alat_penguji" name="alat_penguji" class="w-full border rounded px-3 py-2" required>
                                <option value="" class="text-gray-400" selected>Pilih Alat Penguji</option>
								<option value="BUS">BUS</option>
								<option value="AT">AT</option>
								<option value="ATB">ATB</option>
							</select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium">Cap Tanda Tera <span class="text-red-500">*</span></label>
                            <select id="ctt" name="ctt" class="w-full border rounded px-3 py-2" required>
                                <option value="" class="text-gray-400" selected>Pilih Cap Tanda Tera</option>
								<option value="SL6">SL6</option>
								<option value="SL4">SL4</option>
								<option value="SL2">SL2</option>
                                <option value="SK6">SK6</option>
								<option value="SP6">SP6</option>
								<option value="B4">B4</option>
                                <option value="J8">J8</option>
                                <option value="J5">J5</option>
                                <option value="J4">J4</option>
                                <option value="JP8">JP8</option>
                                <option value="D4">D4</option>
                                <option value="H">H</option>
                                <option value="HP">HP</option>
							</select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium">No Surat Perintah Tugas</label>
                            <input type="text" name="spt_keperluan" class="w-full border rounded px-3 py-2">
                        </div>
                        <div>
                            <label class="block text-sm font-medium">Keterangan <span class="text-red-500">*</span></label>
                            <select id="keterangan" name="keterangan" class="w-full border rounded px-3 py-2" required>
                                <option value="" class="text-gray-400" selected>Pilih Keterangan</option>
								<option value="Tera">Tera</option>
								<option value="Tera Ulang">Tera Ulang</option>
							</select>
                        </div>
                        <div class="flex items-center space-x-2 mt-2">
                            <input type="checkbox" name="terapan" id="terapan" class="rounded border-gray-300">
                            <label for="terapan" class="text-sm font-medium">Cerapan</label>
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
                        <div class="flex justify-center space-x-2">
                            <!-- Tombol Preview -->
                            <button class="flex items-center space-x-1 text-black hover:text-gray-600 transition p-2 rounded hover:bg-blue-100 transition duration-200" onclick="loadDetailAlat('{{ $data->uttp->id_uttp }}')">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-5 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </button>

                            <!-- Tombol Edit -->
                            <button
                                onclick="openEditModal({{ $data->uttp }}, '{{ route('update-uttp', $data->uttp->id_uttp) }}')"
                                class="p-2 rounded hover:bg-blue-100 transition duration-200"
                                title="Edit">
                                <span class="material-symbols-outlined">edit</span>
                            </button>

                            <!-- Tombol hapus -->
                            <!-- <form action="{{ route('delete-uttp', $data->uttp->id_uttp) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 rounded hover:bg-red-100 transition duration-200" title="Hapus">
                                    <span class="material-symbols-outlined">delete</span>
                                </button>
                            </form> -->
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
    const statusFilter = document.getElementById("statusFilter");
    const searchInput = document.getElementById("searchInput");
    const rows = document.querySelectorAll("tbody tr");

    function applyFilters() {
        const selectedStatus = statusFilter.value.toLowerCase();
        const keyword = searchInput.value.toLowerCase();

        rows.forEach(row => {
            if (!row.querySelector('td')) return;

            const statusCell = row.querySelector('td:nth-child(6)');
            const status = statusCell ? statusCell.textContent.trim().toLowerCase() : '';
            const rowText = row.textContent.toLowerCase();

            const matchStatus = !selectedStatus || status === selectedStatus;
            const matchSearch = !keyword || rowText.includes(keyword);

            row.style.display = (matchStatus && matchSearch) ? '' : 'none';
        });
    }

    statusFilter.addEventListener("change", applyFilters);
    searchInput.addEventListener("input", applyFilters);
    applyFilters();

    function togglePopup(show) {
        const modal = document.getElementById('popupDetailAlat');
        if (show) {
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        } else {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }
    }

    function loadDetailAlat(id) {
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        
        fetch(`/alat-ukur/detail`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify({ id: id })
        })
        .then(response => response.json())
        .then(data => {
            document.getElementById('popupNoReg').textContent = data.no_registrasi;
            
            const detailBody = document.getElementById('popupDetailBody');
            detailBody.innerHTML = `
                <tr><td class="py-2 font-semibold">Jenis Alat</td><td class="py-2">: ${data.jenis_alat ?? '-'}</td></tr>
                <tr><td class="py-2 font-semibold">Nama Usaha</td><td class="py-2">: ${data.nama_usaha ?? '-'}</td></tr>
                <tr><td class="py-2 font-semibold">Merk/Type</td><td class="py-2">: ${data.merk_type ?? '-'}</td></tr>
                <tr><td class="py-2 font-semibold">Kapasitas</td><td class="py-2">: ${data.nama_alat ?? '-'}</td></tr>
                <tr><td class="py-2 font-semibold">Nomor Seri</td><td class="py-2">: ${data.nomor_seri ?? '-'}</td></tr>
                <tr><td class="py-2 font-semibold">Alat Penguji</td><td class="py-2">: ${data.alat_penguji ?? '-'}</td></tr>
                <tr><td class="py-2 font-semibold">Cap Tanda Tera</td><td class="py-2">: ${data.ctt ?? '-'}</td></tr>
                <tr><td class="py-2 font-semibold">No Surat Perintah Tugas</td><td class="py-2">: ${data.spt_keperluan ?? '-'}</td></tr>
                <tr><td class="py-2 font-semibold">Tanggal Tera</td><td class="py-2">: ${new Date(data.tanggal_penginputan ?? '-').toLocaleDateString('id-ID', {day: 'numeric', month: 'long', year: 'numeric'})}</td></tr>
                <tr><td class="py-2 font-semibold">Tanggal Selesai</td><td class="py-2">: ${new Date(data.tanggal_selesai ?? '-').toLocaleDateString('id-ID', {day: 'numeric', month: 'long', year: 'numeric'})}</td></tr>
                <tr><td class="py-2 font-semibold">Keterangan</td><td class="py-2">: ${data.keterangan || '-'}</td></tr>
            `;
            
            togglePopup(true);
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan saat memuat detail alat');
        });
    }

    function handleSubmit(event) {
        event.preventDefault();
        const form = event.target;
        
        // Hapus pesan error yang ada
        const errorMessages = form.querySelectorAll('.error-message');
        errorMessages.forEach(el => el.remove());
        
        // Submit form menggunakan fetch
        fetch(form.action, {
            method: form.method,
            body: new FormData(form),
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                window.location.href = "{{ route('management-uttp-metrologi') }}";
            } else {
                // Tampilkan pesan error untuk setiap field
                if (data.errors) {
                    Object.keys(data.errors).forEach(field => {
                        const input = form.querySelector(`[name="${field}"]`);
                        if (input) {
                            const errorDiv = document.createElement('div');
                            errorDiv.className = 'error-message text-red-500 text-sm mt-1';
                            errorDiv.textContent = data.errors[field][0];
                            input.parentNode.appendChild(errorDiv);
                        }
                    });
                } else {
                    alert(data.message || 'Terjadi kesalahan saat menyimpan data');
                }
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan saat menyimpan data');
        });
    }

    function openModal(){
        document.getElementById('modalTambahAlat').classList.remove('hidden');

        // Reset Form
        const form = document.getElementById('form-alat');
        form.reset();
        form.action = "{{ route('store-uttp') }}";
        document.getElementById('formMethod').value = "POST";

        // Ganti Judul
        document.getElementById('modalTitle').innerText = 'Tambah UTTP';
    }

    function tutupModal() {
        document.getElementById('modalTambahAlat').classList.add('hidden');
    }

    function openEditModal(data, updateRoute) {
        document.getElementById('modalTambahAlat').classList.remove('hidden');
        const form = document.getElementById('form-alat');

        // Ganti action dan method
        form.action = updateRoute;
        document.getElementById('formMethod').value = "PATCH";

        // Hapus pesan error yang ada
        const errorMessages = form.querySelectorAll('.error-message');
        errorMessages.forEach(el => el.remove());

        // Assign field manual
        form.elements['tanggal_penginputan'].value = data.tanggal_penginputan || '';
        form.elements['id_user'].value = data.id_user || '';
        form.elements['no_registrasi'].value = data.no_registrasi || '';
        form.elements['nama_usaha'].value = data.nama_usaha || '';
        form.elements['jenis_alat'].value = data.jenis_alat || '';
        form.elements['nama_alat'].value = data.nama_alat || '';
        form.elements['merk_type'].value = data.merk_type || '';
        form.elements['nomor_seri'].value = data.nomor_seri || '';
        form.elements['alat_penguji'].value = data.alat_penguji || '';
        form.elements['ctt'].value = data.ctt || '';
        form.elements['spt_keperluan'].value = data.spt_keperluan || '';
        form.elements['tanggal_selesai'].value = data.tanggal_selesai || '';
        form.elements['terapan'].checked = data.terapan || false;
        form.elements['keterangan'].value = data.keterangan || '';
    }

    // Script untuk membuka modal otomatis dan mengisi field
    document.addEventListener('DOMContentLoaded', function() {
        const urlParams = new URLSearchParams(window.location.search);
        const autoOpen = urlParams.get('auto_open');
        const userId = urlParams.get('user_id');
        const jenisPermohonan = urlParams.get('jenis_permohonan');

        if (autoOpen === 'true') {
            const modal = document.getElementById('modalTambahAlat');
            modal.classList.remove('hidden');
            
            const form = document.getElementById('form-alat');
            form.reset();
            document.getElementById('formMethod').value = "POST";
            
            if (userId) {
                form.elements['id_user'].value = userId;
            }

            if (jenisPermohonan) {
                // Jika jenis permohonan mengandung kata "tera_ulang", set ke "Tera Ulang"
                if (jenisPermohonan.toLowerCase().includes('tera_ulang')) {
                    form.elements['keterangan'].value = 'Tera Ulang'; // Tera Ulang
                } else {
                    form.elements['keterangan'].value = 'Tera'; // Tera
                }
            }
        }
    });
</script>


@endsection