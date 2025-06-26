@extends('layouts.admin')
@section('title', 'Sertifikat Halal')

@section('content')

    {{-- ====================================================================================== --}}
    {{-- BAGIAN 1: SATU DIV UTAMA SEBAGAI PUSAT KONTROL ALPINE.JS                            --}}
    {{-- Semua konten halaman dan modal akan berada di dalam div ini.                       --}}
    {{-- ====================================================================================== --}}
    <div class="w-full max-w-full" x-data="{
        // State untuk mengontrol visibilitas setiap modal
        openAdd: false,
        openEdit: false,
        openDetail: false,
    
        // Objek untuk menampung data
        detailItem: {},
        editItem: {},
        newAddItemTemplate: {
            nama_usaha: '',
            no_sertifikasi_halal: '',
            tanggal_sah: '',
            tanggal_exp: '',
            alamat: '',
            status: 'Mengecek...',
        },
        addItem: {},
    
        // Inisialisasi komponen
        init() {
            this.addItem = { ...this.newAddItemTemplate };
            @if ($errors->any() && session('form_type') === 'add') this.openAdd = true;
            this.addItem = @json(session('_old_input'));
            this.updateStatus('add');
        @elseif ($errors->any() && session('form_type') === 'edit')
            let oldData = @json(session('_old_input'));
            if (oldData.tanggal_sah) oldData.tanggal_sah = oldData.tanggal_sah.substring(0, 10);
            if (oldData.tanggal_exp) oldData.tanggal_exp = oldData.tanggal_exp.substring(0, 10);
            this.editItem = oldData;
            this.openEdit = true; @endif
        },
    
        // Fungsi untuk membuka modal 'Tambah'
        openAddModal() {
            this.addItem = { ...this.newAddItemTemplate };
            this.openAdd = true;
        },
    
        // Fungsi untuk membuka modal 'Edit' dengan format tanggal yang benar
        openEditModal(item) {
            let itemCopy = JSON.parse(JSON.stringify(item));
            if (itemCopy.tanggal_sah) itemCopy.tanggal_sah = itemCopy.tanggal_sah.substring(0, 10);
            if (itemCopy.tanggal_exp) itemCopy.tanggal_exp = itemCopy.tanggal_exp.substring(0, 10);
            this.editItem = itemCopy;
            this.openEdit = true;
        },
    
        // Fungsi untuk membuka modal 'Detail'
        openDetailModal(item) {
            this.detailItem = {
                nama_usaha: item.nama_usaha,
                no_sertifikasi_halal: item.no_sertifikasi_halal,
                tanggal_sah: item.tanggal_sah?.substring(0, 10),
                tanggal_exp: item.tanggal_exp?.substring(0, 10),
                alamat: item.alamat,
                status: item.status,
                umur_sertifikat_teks: item.umur_sertifikat_teks ?? 'Tidak tersedia',
                sisa_berlaku_teks: item.sisa_berlaku_teks ?? 'Tidak tersedia',
                klasifikasi_risiko: item.klasifikasi_risiko ?? 'Tidak tersedia',
                rekomendasi_tindakan: item.rekomendasi_tindakan ?? 'Tidak tersedia',
            };
            this.openDetail = true;
        },
    
        // Fungsi untuk menghitung status secara otomatis
        updateStatus(formType) {
            const item = (formType === 'add') ? this.addItem : this.editItem;
    
            const tglSah = item.tanggal_sah;
            const tglExp = item.tanggal_exp;
    
            if (!tglSah || !tglExp) {
                item.status = 'Menunggu tanggal lengkap';
                return;
            }
    
            const today = new Date();
            today.setHours(0, 0, 0, 0);
    
            const expDate = new Date(tglExp);
            expDate.setHours(0, 0, 0, 0);
    
            const selisihHari = Math.floor((expDate - today) / (1000 * 60 * 60 * 24));
    
            if (selisihHari < 0) {
                item.status = 'Kadaluarsa';
            } else if (selisihHari <= 30) {
                item.status = 'Perlu Pembaruan';
            } else {
                item.status = 'Berlaku';
            }
        },
    
    
        // Fungsi untuk menghitung status secara otomatis
        updateStatus(formType) {
            const item = (formType === 'add') ? this.addItem : this.editItem;
            if (!item.tanggal_exp) {
                item.status = 'Tanggal EXP diperlukan';
                return;
            }
            const expDate = new Date(item.tanggal_exp);
            const today = new Date();
            today.setHours(0, 0, 0, 0);
            if (expDate < today) {
                item.status = 'Perlu Pembaruan';
            } else {
                item.status = 'Berlaku';
            }
        }
    }">
        {{-- ====================================================================================== --}}
        {{-- BAGIAN 2: KONTEN HALAMAN (TIDAK ADA PERUBAHAN STYLE)                                  --}}
        {{-- ====================================================================================== --}}

        <div class="relative w-full h-44">
            <img src="{{ asset('/assets/img/background/user_industri.png') }}" alt="Banner" class="object-cover w-full h-44">
            <a href="{{ route('dashboard.industri') }}"
                class="absolute flex items-center justify-center w-12 h-12 text-black transition-all duration-300 transform -translate-y-1/2 rounded-full shadow-lg left-14 top-1/2 bg-white/80 hover:bg-black hover:text-white hover:border-white hover:scale-110">
                <span class="text-2xl material-symbols-outlined">arrow_back</span>
            </a>
        </div>

        <div class="relative flex items-center w-full gap-4 px-6 py-6 mx-auto">
            <div class="relative flex-1">
                <form method="GET" action="{{ route('admin.industri.halal') }}">
                    <input type="text" name="search" placeholder="Cari"
                        class="w-full p-3 pl-10 bg-white border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500"
                        value="{{ request('search') }}" />
                    <span
                        class="absolute text-gray-500 transform -translate-y-1/2 material-symbols-outlined left-3 top-1/2">search</span>
                </form>
            </div>
            <button @click="openAddModal()"
                class="sticky bg-[#002B4E] text-white font-semibold rounded-full px-6 py-3 shadow-md hover:bg-white hover:text-[#003366] border border-transparent hover:border-[#003366] transition duration-300">
                TAMBAH DATA
            </button>
        </div>

        <!-- Tabel Data -->
        <div class="container px-4 pb-4 mx-auto">
            <section class="overflow-hidden bg-white border border-gray-300 shadow-md rounded-xl">
                <div class="overflow-y-auto max-h-[350px]">
                    <table class="w-full text-sm text-left table-auto">
                        <thead class="bg-[#0d3b66] text-white sticky top-0 z-10">
                            <tr>
                                <th class="px-4 py-3 font-semibold text-left">NO</th>
                                <th class="px-4 py-3 font-semibold text-left">Nama Usaha</th>
                                <th class="px-4 py-3 font-semibold text-left">No Sertifikat</th>
                                <th class="px-4 py-3 font-semibold text-left">Tanggal Diterbitkan</th>
                                <th class="px-4 py-3 font-semibold text-left">Berlaku Sampai</th>
                                <th class="px-4 py-3 font-semibold text-left">Alamat</th>
                                <th class="px-4 py-3 font-semibold text-left min-w-[140px]">Status Sistem</th>
                                <th class="px-4 py-3 font-semibold text-left">Sertifikat</th>
                                <th class="px-4 py-3 font-semibold text-left rounded-tr-xl">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                                <tr id="row-{{ $item->id_halal }}" class="transition-colors hover:bg-gray-50">
                                    <td class="px-4 py-3">{{ $loop->iteration }}</td>
                                    <td class="px-4 py-3">{{ $item->nama_usaha }}</td>
                                    <td class="px-4 py-3">{{ $item->no_sertifikasi_halal }}</td>
                                    <td class="px-4 py-3">{{ \Carbon\Carbon::parse($item->tanggal_sah)->format('d-m-Y') }}
                                    </td>
                                    <td class="px-4 py-3">{{ \Carbon\Carbon::parse($item->tanggal_exp)->format('d-m-Y') }}
                                    </td>
                                    <td class="px-4 py-3">{{ $item->alamat }}</td>
                                    @php
                                        $status = $item->status;
                                        $badgeClass = match ($status) {
                                            'Berlaku' => 'bg-green-200 text-green-800',
                                            'Perlu Pembaruan' => 'bg-yellow-200 text-yellow-800',
                                            'Kadaluarsa', 'Gagal Analisis' => 'bg-red-200 text-red-800',
                                            default => 'bg-gray-200 text-gray-600 italic',
                                        };
                                    @endphp


                                    <td class="px-4 py-3 min-w-[140px]">
                                        <span @click="openDetailModal({{ json_encode($item) }})"
                                            class="px-4 py-[6px] rounded-full text-sm font-semibold whitespace-nowrap cursor-pointer transition hover:scale-105 {{ $badgeClass }}">
                                            {{ $status }}
                                        </span>
                                    </td>



                                    <td class="px-4 py-3">
                                        @if ($item->sertifikat)
                                            <a href="{{ asset('storage/' . $item->sertifikat) }}" target="_blank"
                                                class="text-blue-600 underline transition hover:text-blue-800">Lihat</a>
                                        @else
                                            <span class="text-gray-400">-</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3">
                                        <div class="flex space-x-2">
                                            <button @click="openEditModal({{ json_encode($item) }})"
                                                class="text-green-600 transition hover:text-green-800" title="Edit">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M15.232 5.232l3.536 3.536M9 13l6-6 3 3-6 6H9v-3z" />
                                                </svg>
                                            </button>
                                            <button onclick="deleteData({{ $item->id_halal }})"
                                                class="text-red-600 transition hover:text-red-800" title="Hapus">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7h6m2 0H7m4-3h2a1 1 0 011 1v1H8V5a1 1 0 011-1z" />
                                                </svg>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </section>
        </div>

        {{-- ====================================================================================== --}}
        {{-- BAGIAN 3: SEMUA MODAL DITEMPATKAN DI SINI (DI DALAM DIV x-data UTAMA)              --}}
        {{-- ====================================================================================== --}}

        <!-- MODAL TAMBAH DATA (LOGIKA BARU, STYLE LAMA) -->
        <div x-show="openAdd" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
            class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50" style="display: none;"
            x-cloak>
            <div class="bg-white p-6 rounded shadow w-full max-w-lg max-h-[90vh] ml-24 mr-2 sm:justify-center overflow-y-auto"
                @click.away="openAdd = false">
                <h2 class="mb-4 text-xl font-semibold text-center">Tambah Data Sertifikat Halal</h2>
                <form action="{{ route('admin.industri.halal.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="form_type" value="add">
                    <div class="grid gap-4 md:grid-cols-2">
                        <div>
                            <label class="block mb-1 font-semibold">Nama Usaha</label>
                            <input type="text" name="nama_usaha" placeholder="Nama Usaha" required
                                x-model="addItem.nama_usaha"
                                class="w-full px-4 py-2 text-sm placeholder-gray-400 transition border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block mb-1 font-semibold">Nomor Sertifikat Halal</label>
                            <input type="text" name="no_sertifikasi_halal" placeholder="No Sertifikat Halal"
                                x-model="addItem.no_sertifikasi_halal"
                                class="w-full px-4 py-2 text-sm placeholder-gray-400 transition border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
                        </div>
                        <!-- Input Tanggal Diterbitkan -->
                        <div>
                            <label class="block mb-1 font-semibold">Tanggal Diterbitkan</label>
                            <input type="date" name="tanggal_sah" required x-model="addItem.tanggal_sah"
                                @change="updateStatus('add')"
                                class="w-full px-4 py-2 text-sm placeholder-gray-400 transition border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
                        </div>

                        <!-- Input Tanggal Expired -->
                        <div>
                            <label class="block mb-1 font-semibold">Berlaku Sampai</label>
                            <input type="date" name="tanggal_exp" required x-model="addItem.tanggal_exp"
                                @change="updateStatus('add')"
                                class="w-full px-4 py-2 text-sm placeholder-gray-400 transition border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
                        </div>

                        <!-- Status Otomatis -->
                        <div>
                            <label class="block mb-1 font-semibold">Status</label>
                            <div>
                                <input type="text" name="status" readonly x-model="addItem.status"
                                    class="w-full px-4 py-2 text-sm bg-gray-100 border border-gray-300 rounded-lg shadow-sm text-gray-700">
                            </div>
                        </div>


                        <div x-data="{ fileName: '' }">
                            <p class="block mb-1 font-semibold">Sertifikat Halal</p>
                            <label for="filesertifikat_add"
                                class="px-4 py-2 bg-blue-100 text-black rounded-full cursor-pointer transition-all duration-300 hover:bg-[#083358] hover:text-white w-max">Pilih
                                File</label>
                            <input type="file" id="filesertifikat_add" name="sertifikat" accept="application/pdf"
                                class="hidden" @change="fileName = $event.target.files[0].name" required>
                            <p x-text="fileName" class="mt-2 text-sm text-gray-600"></p>
                            <p class="mt-1 text-sm text-gray-500">Maksimal ukuran file 512KB (PDF).</p>
                        </div>
                    </div>
                    <div class="mt-4">
                        <label class="block mb-1 font-semibold">Alamat</label>
                        <textarea name="alamat" placeholder="Alamat" required x-model="addItem.alamat"
                            class="w-full px-4 py-2 text-sm placeholder-gray-400 transition border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500"></textarea>
                    </div>
                    <div class="flex justify-center mt-6 space-x-2">
                        <button type="button" @click="openAdd = false"
                            class="px-4 py-2 transition bg-gray-300 rounded-full hover:bg-gray-400">Batal</button>
                        <button type="submit"
                            class="bg-[#002B4E] text-white font-semibold rounded-full px-6 py-3 shadow-md hover:brightness-110 transition">Simpan</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- MODAL EDIT (LOGIKA BARU, STYLE LAMA) -->
        <div x-show="openEdit" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50"
            style="display: none;" x-cloak>
            <div class="bg-white p-6 rounded-lg shadow-xl w-full max-w-2xl max-h-[90vh] ml-24 mr-2 overflow-y-auto"
                @click.away="openEdit = false">
                <h3 class="mb-6 text-xl font-bold text-center">Edit Sertifikat Halal</h3>
                @if ($errors->any() && session('form_type') === 'edit')
                    <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 border border-red-200 rounded-lg">
                        <strong>Terjadi kesalahan:</strong>
                        <ul class="mt-1 ml-4 list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form :action="`/admin/industri/sertifikat-halal/${editItem.id_halal}`" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="form_type" value="edit">
                    <input type="hidden" name="id_halal" :value="editItem.id_halal">
                    <div class="grid gap-4 md:grid-cols-2">
                        <div>
                            <label class="block mb-1 font-semibold">Nama Usaha</label>
                            <input type="text" name="nama_usaha" required x-model="editItem.nama_usaha"
                                class="w-full px-4 py-2 text-sm transition border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block mb-1 font-semibold">Nomor Sertifikat Halal</label>
                            <input type="text" name="no_sertifikasi_halal" x-model="editItem.no_sertifikasi_halal"
                                class="w-full px-4 py-2 text-sm transition border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block mb-1 font-semibold">Tanggal Sah</label>
                            <input type="date" name="tanggal_sah" required x-model="editItem.tanggal_sah"
                                class="w-full px-4 py-2 text-sm transition border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block mb-1 font-semibold">Tanggal Exp</label>
                            <input type="date" name="tanggal_exp" required x-model="editItem.tanggal_exp"
                                @change="updateStatus('edit')"
                                class="w-full px-4 py-2 text-sm transition border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block mb-1 font-semibold">Status</label>
                            <div>
                                <input type="text" name="status" readonly x-model="editItem.status"
                                    class="w-full px-4 py-2 text-sm bg-gray-100 border border-gray-300 rounded-lg shadow-sm text-gray-700">
                            </div>
                        </div>
                        <div x-data="{ fileName: '' }">
                            <p class="block mb-1 font-semibold">File Sertifikat - <span class="italic">Kosongkan jika
                                    tidak berubah</span></p>
                            <label for="edit_filesertifikat"
                                class="px-4 py-2 bg-blue-100 text-black rounded-full cursor-pointer transition-all duration-300 hover:bg-[#083358] hover:text-white inline-block">Pilih
                                File</label>
                            <input type="file" id="edit_filesertifikat" name="sertifikat" accept="application/pdf"
                                class="hidden" @change="fileName = $event.target.files[0].name">
                            <p x-text="fileName" class="mt-2 text-sm text-gray-600"></p>
                            <p class="mt-1 text-sm text-gray-500">Maksimal ukuran file 512KB (PDF).</p>
                        </div>
                    </div>
                    <div class="mt-1">
                        <label class="block mb-1 font-semibold">Alamat</label>
                        <textarea name="alamat" placeholder="Alamat" required x-model="editItem.alamat"
                            class="w-full px-4 py-2 text-sm transition border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500"></textarea>
                    </div>
                    <div class="flex justify-center gap-4 mt-6">
                        <button type="button" @click="openEdit = false"
                            class="px-4 py-2 transition bg-gray-300 rounded-full hover:bg-gray-400">Batal</button>
                        <button type="submit"
                            class="bg-[#002B4E] text-white font-semibold rounded-full px-6 py-3 shadow-md hover:brightness-110 transition">Simpan
                            Perubahan</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- MODAL DETAIL ANALISIS (Tambahkan kode ini jika belum ada) -->
        <div x-show="openDetail" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50"
            style="display: none;" x-cloak>
            <div class="bg-white p-6 rounded-lg shadow-xl w-full max-w-lg max-h-[90vh] ml-24 mr-2 sm:justify-center overflow-y-auto"
                @click.away="openDetail = false">
                <div class="flex items-start justify-between">
                    <h2 class="mb-4 text-xl font-semibold text-gray-800">Detail Analisis Risiko</h2>
                    <button @click="openDetail = false"
                        class="text-3xl font-light text-gray-500 hover:text-gray-800">×</button>
                </div>
                <h3 class="mb-4 text-lg font-bold text-[#002B4E]" x-text="detailItem.nama_usaha"></h3>
                <table class="w-full text-sm border border-gray-200 rounded-lg">
                    <tbody>
                        <tr class="border-b">
                            <td class="p-3 font-semibold bg-gray-50" width="40%">Status Sistem</td>
                            <td class="p-3" x-text="detailItem.status"></td>
                        </tr>
                        <tr class="border-b">
                            <td class="p-3 font-semibold bg-gray-50">Umur Sertifikat</td>
                            <td class="p-3" x-text="detailItem.umur_sertifikat_teks"></td>
                        </tr>
                        <tr class="border-b">
                            <td class="p-3 font-semibold bg-gray-50">Sisa Berlaku</td>
                            <td class="p-3" x-text="detailItem.sisa_berlaku_teks"></td>
                        </tr>
                        <tr class="border-b">
                            <td class="p-3 font-semibold bg-gray-50">Klasifikasi Risiko</td>
                            <td class="p-3">
                                <span class="px-3 py-1 text-xs font-medium rounded-full"
                                    :class="{
                                        'bg-green-100 text-green-800': detailItem.klasifikasi_risiko === 'Aman',
                                        'bg-blue-100 text-blue-800': detailItem.klasifikasi_risiko === 'Waspada',
                                        'bg-yellow-100 text-yellow-800': detailItem.klasifikasi_risiko === 'Mendesak',
                                        'bg-red-100 text-red-800': detailItem.klasifikasi_risiko === 'Risiko Tinggi'
                                    }"
                                    x-text="detailItem.klasifikasi_risiko"></span>
                            </td>
                        </tr>
                        <tr>
                            <td class="p-3 font-semibold bg-gray-50">Rekomendasi Tindakan</td>
                            <td class="p-3" x-text="detailItem.rekomendasi_tindakan"></td>
                        </tr>
                    </tbody>
                </table>
                <div class="flex justify-end mt-6">
                    <button type="button" @click="openDetail = false"
                        class="px-6 py-2 text-sm font-semibold text-gray-700 bg-gray-200 rounded-full hover:bg-gray-300">Tutup</button>
                </div>
            </div>
        </div>


        @if ($errors->any() && session('form_type') === 'add')
            <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 border border-red-200 rounded-lg">
                <strong>Terjadi kesalahan:</strong>
                <ul class="mt-1 ml-4 list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div> {{-- AKHIR DARI DIV x-data UTAMA --}}

    <script>
        // Fungsi delete ini masih menggunakan cara lama, bisa dipertahankan jika berfungsi.
        async function deleteData(id) {
            if (!confirm('Yakin ingin menghapus data ini?')) return;
            try {
                const response = await fetch(`/admin/industri/sertifikat-halal/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                });
                if (response.ok) {
                    alert('Data berhasil dihapus');
                    document.getElementById('row-' + id)?.remove();
                } else {
                    const errorData = await response.json();
                    alert('Gagal menghapus data: ' + (errorData.message || 'Unknown error'));
                }
            } catch (err) {
                alert('Terjadi kesalahan koneksi: ' + err.message);
            }
        }
    </script>

    <script>
        function statusEvaluator() {
            return {
                addItem: {
                    tanggal_sah: '',
                    tanggal_exp: '',
                    status: ''
                },
                updateStatus() {
                    const tglSah = this.addItem.tanggal_sah;
                    const tglExp = this.addItem.tanggal_exp;

                    if (!tglSah || !tglExp) {
                        this.addItem.status = '';
                        return;
                    }

                    const today = new Date();
                    const expired = new Date(tglExp);

                    const diffHari = Math.floor((expired - today) / (1000 * 60 * 60 * 24));

                    if (expired < today) {
                        this.addItem.status = 'Kadaluarsa';
                    } else if (diffHari <= 30) {
                        this.addItem.status = 'Perlu Pembaruan';
                    } else {
                        this.addItem.status = 'Berlaku';
                    }
                }
            }
        }
    </script>



@endsection
