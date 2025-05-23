@extends('layouts.metrologi.admin')

@section('content')

@php
use App\Helpers\StatusHelper;
@endphp

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
                        <option value="Kadaluarsa">{{ StatusHelper::formatStatus('Kadaluarsa') }}</option>
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
    <div id="modalTambahAlat" class="fixed inset-0 z-40 hidden bg-black bg-opacity-30 flex items-center justify-center overflow-y-auto">
        <div class="fixed inset-0 bg-black bg-opacity-30"></div>
        <div class="relative bg-white w-[90%] md:w-[70%] lg:w-[50%] rounded-lg shadow-lg p-6 max-h-[90vh] overflow-y-auto">
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
                        <select name="id_user" id="userSelect" class="w-full border rounded px-3 py-2 text-sm" style="height: 38px;">
                            <option value="">Pilih User</option>
                        </select>
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
                    <div>
                        <label class="block text-sm font-medium">Sertifikat (PDF)</label>
                        <input type="file" name="sertifikat" accept=".pdf" class="w-full border rounded px-3 py-2">
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
                    <td class="px-5 text-center py-3 border-b">{{ $alatUkur->firstItem() + $index }}</td>
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
                            {{ $data->status === 'Valid' ? 'Valid' : StatusHelper::formatStatus($data->status) }}
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
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-6 flex justify-center">
        {{ $alatUkur->links('pagination::tailwind') }}
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Add Select2 CSS and JS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

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

            // Handle Kadaluarsa, Kadaluwarsa, and Kedaluwarsa in the filter
            const matchStatus = !selectedStatus || 
                (selectedStatus === 'kadaluarsa' && (status === 'kadaluarsa' || status === 'kadaluwarsa' || status === 'kedaluwarsa')) ||
                (selectedStatus === 'valid' && status === 'valid');
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
        
        fetch('/alat-ukur/detail', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify({ id: id })
        })
        .then(response => {
            if (!response.ok) {
                return response.text().then(text => {
                    throw new Error(text || 'Network response was not ok');
                });
            }
            return response.json();
        })
        .then(data => {
            if (data.error) {
                throw new Error(data.error);
            }
            
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
                <tr><td class="py-2 font-semibold">Tanggal Tera</td><td class="py-2">: ${data.tanggal_penginputan ? new Date(data.tanggal_penginputan).toLocaleDateString('id-ID', {day: 'numeric', month: 'long', year: 'numeric'}) : '-'}</td></tr>
                <tr><td class="py-2 font-semibold">Tanggal Selesai</td><td class="py-2">: ${data.tanggal_selesai ? new Date(data.tanggal_selesai).toLocaleDateString('id-ID', {day: 'numeric', month: 'long', year: 'numeric'}) : '-'}</td></tr>
                <tr><td class="py-2 font-semibold">Keterangan</td><td class="py-2">: ${data.keterangan || '-'}</td></tr>
                <tr><td class="py-2 font-semibold">Sertifikat</td><td class="py-2">: ${data.sertifikat_path ? `<a href="/storage/${data.sertifikat_path}" target="_blank" class="text-blue-600 hover:text-blue-800">Lihat Sertifikat</a>` : '<span class="text-gray-500">Belum di upload oleh admin</span>'}</td></tr>
            `;
            
            togglePopup(true);
        })
        .catch(error => {
            console.error('Error:', error);
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: error.message || 'Terjadi kesalahan saat memuat detail alat',
                confirmButtonText: 'OK'
            });
        });
    }

    function handleSubmit(event) {
        event.preventDefault();
        const form = event.target;
        
        // Validasi ukuran file sertifikat
        const sertifikatInput = form.querySelector('[name="sertifikat"]');
        if (sertifikatInput.files.length > 0) {
            const maxSize = 10 * 1024 * 1024; // 10MB in bytes
            if (sertifikatInput.files[0].size > maxSize) {
                Swal.fire({
                    icon: 'error',
                    title: 'Ukuran File Terlalu Besar',
                    text: 'Ukuran file maksimal adalah 10MB. Silakan pilih file yang lebih kecil.',
                    confirmButtonText: 'OK'
                });
                return;
            }
        }

        // Konfirmasi sebelum submit
        Swal.fire({
            title: 'Konfirmasi',
            text: 'Apakah Anda yakin ingin menyimpan data ini?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Ya, Simpan',
            cancelButtonText: 'Batal',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33'
        }).then((result) => {
            if (result.isConfirmed) {
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
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: 'Data berhasil disimpan',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                            window.location.href = "{{ route('management-uttp-metrologi') }}";
                        });
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
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: data.message || 'Terjadi kesalahan saat menyimpan data',
                                confirmButtonText: 'OK'
                            });
                        }
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Terjadi kesalahan saat menyimpan data',
                        confirmButtonText: 'OK'
                    });
                });
            }
        });
    }

    function openModal(){
        document.getElementById('modalTambahAlat').classList.remove('hidden');

        // Reset Form
        const form = document.getElementById('form-alat');
        form.reset();
        form.action = "{{ route('store-uttp') }}";
        document.getElementById('formMethod').value = "POST";
        
        // Enable user select when opening manually
        $('#userSelect').prop('disabled', false);
    }

    function tutupModal() {
        // Konfirmasi sebelum menutup modal jika ada perubahan
        const form = document.getElementById('form-alat');
        const formData = new FormData(form);
        let hasChanges = false;

        // Cek apakah ada perubahan pada form
        for (let [key, value] of formData.entries()) {
            if (key !== 'sertifikat' && value !== '') {
                hasChanges = true;
                break;
            }
        }

        if (hasChanges) {
            Swal.fire({
                title: 'Konfirmasi',
                text: 'Apakah Anda yakin ingin menutup form? Perubahan yang belum disimpan akan hilang.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Tutup',
                cancelButtonText: 'Batal',
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33'
            }).then((result) => {
                if (result.isConfirmed) {
                    closeModalAndReset();
                }
            });
        } else {
            closeModalAndReset();
        }
    }

    function closeModalAndReset() {
        document.getElementById('modalTambahAlat').classList.add('hidden');
        
        // Reset form
        const form = document.getElementById('form-alat');
        form.reset();
        
        // Hapus semua pesan error
        const errorMessages = form.querySelectorAll('.error-message');
        errorMessages.forEach(el => el.remove());
        
        // Hapus tampilan sertifikat yang ada
        const sertifikatContainer = form.querySelector('[name="sertifikat"]').parentElement;
        const existingFile = sertifikatContainer.querySelector('.mt-2');
        if (existingFile) {
            existingFile.remove();
        }
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

        // Hapus tampilan sertifikat yang ada sebelum menambahkan yang baru
        const sertifikatContainer = form.querySelector('[name="sertifikat"]').parentElement;
        const existingFile = sertifikatContainer.querySelector('.mt-2');
        if (existingFile) {
            existingFile.remove();
        }

        // Assign field manual
        form.elements['tanggal_penginputan'].value = data.tanggal_penginputan || '';
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

        // Handle user selection
        if (data.id_user) {
            // Fetch user data and set it in Select2
            fetch(`/admin/users/search?search=${data.id_user}`)
                .then(response => response.json())
                .then(users => {
                    if (users.length > 0) {
                        const user = users[0];
                        const option = new Option(user.text, user.id, true, true);
                        $('#userSelect').append(option).trigger('change');
                    }
                })
                .catch(error => console.error('Error loading user:', error));
        } else {
            $('#userSelect').val(null).trigger('change');
        }

        // Tampilkan file sertifikat yang sudah ada
        if (data.sertifikat_path) {
            const existingFile = document.createElement('div');
            existingFile.className = 'mt-2 text-sm text-gray-600';
            existingFile.innerHTML = `
                <p>File saat ini: <a href="/storage/${data.sertifikat_path}" target="_blank" class="text-blue-600 hover:text-blue-800">Lihat Sertifikat</a></p>
                <p class="text-xs text-gray-500 mt-1">Upload file baru untuk mengganti sertifikat</p>
            `;
            sertifikatContainer.appendChild(existingFile);
        }
    }

    // Script untuk membuka modal otomatis dan mengisi field
    document.addEventListener('DOMContentLoaded', function() {
        const urlParams = new URLSearchParams(window.location.search);
        const autoOpen = urlParams.get('auto_open');
        const userId = urlParams.get('user_id');
        const jenisPermohonan = urlParams.get('jenis_permohonan');
        const fromPersuratan = urlParams.get('from_persuratan');

        if (autoOpen === 'true') {
            const modal = document.getElementById('modalTambahAlat');
            modal.classList.remove('hidden');
            
            const form = document.getElementById('form-alat');
            form.reset();
            document.getElementById('formMethod').value = "POST";
            
            if (userId) {
                // Jika dari persuratan, set user dan disable select
                if (fromPersuratan === 'true') {
                    fetch(`/admin/users/search?search=${userId}`)
                        .then(response => response.json())
                        .then(users => {
                            if (users.length > 0) {
                                const user = users[0];
                                const option = new Option(user.text, user.id, true, true);
                                $('#userSelect').append(option).trigger('change');
                                $('#userSelect').prop('disabled', true);
                            }
                        })
                        .catch(error => console.error('Error loading user:', error));
                } else {
                    // Jika bukan dari persuratan, set user tapi tetap bisa diubah
                    fetch(`/admin/users/search?search=${userId}`)
                        .then(response => response.json())
                        .then(users => {
                            if (users.length > 0) {
                                const user = users[0];
                                const option = new Option(user.text, user.id, true, true);
                                $('#userSelect').append(option).trigger('change');
                            }
                        })
                        .catch(error => console.error('Error loading user:', error));
                }
            }

            if (jenisPermohonan) {
                // Jika jenis permohonan mengandung kata "tera_ulang", set ke "Tera Ulang"
                if (jenisPermohonan.toLowerCase().includes('tera_ulang')) {
                    form.elements['keterangan'].value = 'Tera Ulang';
                } else {
                    form.elements['keterangan'].value = 'Tera';
                }
            }
        }
    });

    function getDetail(id) {
        fetch(`/admin/metrologi/detail/${id}`)
            .then(response => response.json())
            .then(data => {
                document.getElementById('detailTanggalMulai').textContent = data.tanggal_penginputan || '-';
                document.getElementById('detailNoRegistrasi').textContent = data.no_registrasi || '-';
                document.getElementById('detailNamaUsaha').textContent = data.nama_usaha || '-';
                document.getElementById('detailJenisAlat').textContent = data.jenis_alat || '-';
                document.getElementById('detailNamaAlat').textContent = data.nama_alat || '-';
                document.getElementById('detailMerkType').textContent = data.merk_type || '-';
                document.getElementById('detailNomorSeri').textContent = data.nomor_seri || '-';
                document.getElementById('detailAlatPenguji').textContent = data.alat_penguji || '-';
                document.getElementById('detailCtt').textContent = data.ctt || '-';
                document.getElementById('detailSptKeperluan').textContent = data.spt_keperluan || '-';
                document.getElementById('detailTanggalSelesai').textContent = data.tanggal_selesai || '-';
                document.getElementById('detailTerapan').textContent = data.terapan ? 'Ya' : 'Tidak';
                document.getElementById('detailKeterangan').textContent = data.keterangan || '-';
                
                // Update certificate display
                const sertifikatElement = document.getElementById('detailSertifikat');
                if (data.sertifikat_path) {
                    sertifikatElement.innerHTML = `<a href="/storage/${data.sertifikat_path}" target="_blank" class="text-blue-600 hover:text-blue-800">Lihat Sertifikat</a>`;
                } else {
                    sertifikatElement.innerHTML = '<span class="text-gray-500">Belum di upload oleh admin</span>';
                }

                document.getElementById('modalDetail').classList.remove('hidden');
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat mengambil data');
            });
    }

    $(document).ready(function() {
        $('#userSelect').select2({
            placeholder: 'Cari user...',
            allowClear: true,
            dropdownParent: $('#modalTambahAlat'),
            width: '100%',
            minimumResultsForSearch: 0,
            language: {
                inputTooShort: function() {
                    return 'Ketik ID atau Nama User untuk mencari...';
                },
                searching: function() {
                    return 'Mencari User...';
                },
                noResults: function() {
                    return 'User tidak ditemukan';
                }
            },
            ajax: {
                url: '{{ route("search-users") }}',
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        search: params.term
                    };
                },
                processResults: function(data) {
                    return {
                        results: data
                    };
                },
                cache: true
            },
            minimumInputLength: 1
        }).on('select2:open', function() {
            // Adjust dropdown position
            setTimeout(function() {
                $('.select2-container--open').css('z-index', 9999);
            }, 0);
        });
    });
</script>

<style>
    /* Select2 Styling */
    .select2-container--default .select2-selection--single {
        height: 38px !important;
        border: 1px solid #e2e8f0;
        border-radius: 0.375rem;
    }
    .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 38px !important;
        padding-left: 12px;
    }
    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 36px !important;
    }
    .select2-container--default .select2-selection--single .select2-selection__placeholder {
        color: #6b7280;
    }
</style>

@endsection