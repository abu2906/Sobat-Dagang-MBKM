@extends('layouts.home')

@section('title', 'Kelola Berita')

@section('content')
<head>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" />
</head>

    <div class="relative w-full h-64">
<<<<<<< HEAD
        <img src="{{ asset('img/bgKelolaBerita.png') }}" alt="Port Background" class="w-full h-full object-cover">
=======
        <img src="{{ asset('assets\img\background\kepalaDinas_SuperAdmin.png') }}" alt="Port Background" class="w-full h-full object-cover">
>>>>>>> Andif
        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 text-center z-10">
            <h1 class="text-5xl font-bold text-[#FAA31E]">Kelola Berita</h1>
        </div>
    </div>

    <div class="container mx-auto px-4 relative -mt-8">
        <div class="flex justify-center mb-6 space-x-4">
            <div class="relative w-1/2 shadow-xl shadow-gray-400/40 rounded-full bg-white">
                <span class="material-symbols-outlined absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500">
                    search
                </span>
                <input type="text" placeholder="Cari"
                    class="w-full p-3 pl-10 rounded-full border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 bg-transparent" />
            </div>
            <div class="shadow-xl shadow-gray-400/40 rounded-full bg-white">
                <button onclick="openModal('tambah')" class="btn btn-primary rounded-full py-3 px-6 text-[#083358] font-semibold bg-white
                    hover:text-white hover:bg-[#083358]">
                    + Tambah Berita
                </button>
            </div>                            
        </div>
    </div>

    <div class="container mx-auto px-4 pb-12">
        <table class="min-w-full bg-white border border-gray-300 rounded-xl overflow-hidden shadow-md">
            <thead>
                <tr class="bg-[#083358] text-white font-semibold">
                    <th class="py-3 px-4 border-b rounded-tl-xl">No</th>
                    <th class="py-3 px-4 border-b">Tanggal</th>
                    <th class="py-3 px-4 border-b">Judul Berita</th>
                    <th class="py-3 px-4 border-b rounded-tr-xl">Aksi</th>
                </tr>
            </thead>
            <tbody>
<<<<<<< HEAD
                @foreach ($beritas as $item)
=======
                @foreach ($daftarBerita as $item)
>>>>>>> Andif
                    <tr>
                        <td class="border px-4 py-2">{{ $item->id }}</td>
                        <td class="border px-4 py-2">{{ \Carbon\Carbon::parse($item->created_at)->format('d M Y') }}</td>
                        <td class="border px-4 py-2">{{ $item->judul }}</td>
                        <td class="border px-4 py-2 flex justify-center items-center space-x-2">
                            <button onclick="openModal('edit', {{ $item->id }})" class="text-[#083358] hover:text-black">
                                <span class="material-symbols-outlined">edit</span>
                            </button>
                            <button onclick="openModal('delete', {{ $item->id }})" class="text-[#083358] hover:text-black">
                                <span class="material-symbols-outlined">delete</span>
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div id="modalEdit" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
        <div class="bg-white rounded-lg shadow-xl p-8 w-96">
            <h3 class="text-2xl font-semibold text-center mb-6">Edit Berita</h3>
            <form action="#" method="POST" id="tambahForm" enctype="multipart/form-data">

                <!-- Judul Berita -->
                <div class="mb-4">
                    <label for="judul_tambah" class="block text-sm font-medium text-gray-700">Judul Berita</label>
                    <input type="text" id="judul_tambah" class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Masukkan Judul Berita" required>
                </div>

                <!-- Tanggal Berita -->
                <div class="mb-4">
                    <label for="tanggal_tambah" class="block text-sm font-medium text-gray-700">Tanggal Berita</label>
                    <input type="date" id="tanggal_tambah" class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>

                <!-- Isi Berita -->
                <div class="mb-4">
                    <label for="konten_tambah" class="block text-sm font-medium text-gray-700">Isi Berita</label>
                    <textarea id="konten_tambah" class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Masukkan Isi Berita" required></textarea>
                </div>

                <!-- Gambar Lampiran -->
                <div class="mb-4">
                    <label for="gambar_tambah" class="block text-sm font-medium text-gray-700">Lampiran (Gambar)</label>
                    <div class="flex items-center space-x-3">
                        <label for="gambar_tambah" class="px-4 py-2 bg-blue-100 text-black rounded-full cursor-pointer transition-all duration-300 hover:bg-[#083358] hover:text-white">Pilih File</label>
                        <span id="file-name-tambah" class="text-gray-500">Tidak ada file yang dipilih</span>
                        <input type="file" id="gambar_tambah" name="gambar_tambah" class="hidden" accept="image/*"
                            onchange="document.getElementById('file-name-tambah').innerText = this.files[0]?.name ?? 'Tidak ada file yang dipilih'">
                    </div>
                </div>

                <div class="flex justify-end mt-6 space-x-3">
                    <button type="button" onclick="closeModal('edit')"
                        class="px-4 py-2 bg-gray-300 text-black rounded-full hover:bg-gray-300 transition-all">
                        Batal
                    </button>
                    <button type="button" onclick=""
                    class="px-6 py-2 bg-[#083358] text-white rounded-full hover:bg-[#061f3c] transition-all">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>


    <div id="modalTambah" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
        <div class="bg-white rounded-lg shadow-xl p-8 w-96">
            <h3 class="text-2xl font-semibold text-center mb-6">Tambah Berita</h3>
            <form action="#" method="POST" id="tambahForm" enctype="multipart/form-data">

                <!-- Judul Berita -->
                <div class="mb-4">
                    <label for="judul_tambah" class="block text-sm font-medium text-gray-700">Judul Berita</label>
                    <input type="text" id="judul_tambah" class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Masukkan Judul Berita" required>
                </div>

                <!-- Tanggal Berita -->
                <div class="mb-4">
                    <label for="tanggal_tambah" class="block text-sm font-medium text-gray-700">Tanggal Berita</label>
                    <input type="date" id="tanggal_tambah" class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>

                <!-- Isi Berita -->
                <div class="mb-4">
                    <label for="konten_tambah" class="block text-sm font-medium text-gray-700">Isi Berita</label>
                    <textarea id="konten_tambah" class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Masukkan Isi Berita" required></textarea>
                </div>

                <!-- Gambar Lampiran -->
                <div class="mb-4">
                    <label for="gambar_tambah" class="block text-sm font-medium text-gray-700">Lampiran (Gambar)</label>
                    <div class="flex items-center space-x-3">
                        <label for="gambar_tambah" class="px-4 py-2 bg-blue-100 text-black rounded-full cursor-pointer transition-all duration-300 hover:bg-[#083358] hover:text-white">Pilih File</label>
                        <span id="file-name-tambah" class="text-gray-500">Tidak ada file yang dipilih</span>
                        <input type="file" id="gambar_tambah" name="gambar_tambah" class="hidden" accept="image/*"
                            onchange="document.getElementById('file-name-tambah').innerText = this.files[0]?.name ?? 'Tidak ada file yang dipilih'">
                    </div>
                </div>

                <div class="flex justify-end mt-6 space-x-3">
                    <button type="button" onclick="closeModal('tambah')"
                        class="px-4 py-2 bg-gray-300 text-black rounded-full hover:bg-gray-300 transition-all">
                        Batal
                    </button>
                    <button type="button" onclick="simpanBerita()"
                    class="px-6 py-2 bg-[#083358] text-white rounded-full hover:bg-[#061f3c] transition-all">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Delete -->
    <div id="modalDelete" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
        <div class="bg-white rounded-2xl shadow-xl p-6 w-11/12 max-w-md">
            <h2 class="text-lg font-semibold mb-4">Hapus Berita</h2>
            <p class="mb-6 text-sm text-black-600">Apakah Anda yakin ingin menghapus berita ini?</p>
            <div class="flex justify-end space-x-3">
                <button type="button" onclick="closeModal('delete')"
                        class="px-4 py-2 bg-gray-300 text-black rounded-full hover:bg-gray-300 transition-all">
                    Batal
                </button>
                <button type="button" onclick="deleteItem()"
                        class="px-4 py-2 bg-[#083358] text-white rounded-full hover:bg-[#061f3c] transition-all">
                    Ya, Hapus
                </button>
            </div>
        </div>
    </div>
@endsection

<script>
    // Fungsi untuk membuka modal
    function openModal(type, id) {
        if (type === 'edit') {
            // Tampilkan modal Edit dan sembunyikan yang lain
            document.getElementById('modalEdit').classList.remove('hidden');
        } else if (type === 'delete') {
            // Tampilkan modal Delete dan sembunyikan yang lain
            document.getElementById('modalDelete').classList.remove('hidden');
        } else if (type === 'tambah') {
            // Tampilkan modal Tambah dan sembunyikan yang lain
            document.getElementById('modalTambah').classList.remove('hidden');
        }
    }

    // Fungsi untuk menutup modal
    function closeModal(type) {
        if (type === 'edit') {
            document.getElementById('modalEdit').classList.add('hidden');
        } else if (type === 'delete') {
            document.getElementById('modalDelete').classList.add('hidden');
        } else if (type === 'tambah') {
            document.getElementById('modalTambah').classList.add('hidden');
        }
    }

    // Fungsi untuk delete item (dummy)
    function deleteItem() {
        // Action untuk hapus item bisa diimplementasikan
        alert("Berita berhasil dihapus!");
        closeModal('delete');
    }

    function openEditModal(berita) {
    document.getElementById('judul_tambah').value = berita.judul;
    document.getElementById('tanggal_tambah').value = berita.tanggal;
    document.getElementById('konten_tambah').value = berita.konten;
    // Untuk gambar, biasanya tidak bisa langsung isi file input. Jadi cukup kasih preview saja kalau mau.

    document.getElementById('modalEdit').classList.remove('hidden');
    }

    function simpanBerita() {
        let judul = document.getElementById('judul_tambah').value;
        let tanggal = document.getElementById('tanggal_tambah').value;
        let konten = document.getElementById('konten_tambah').value;
        let gambar = document.getElementById('gambar_tambah').files[0];

        let formData = new FormData();
        formData.append('judul', judul);
        formData.append('tanggal', tanggal);
        formData.append('konten', konten);
        formData.append('gambar', gambar);

        // Mengirim data menggunakan AJAX
        fetch('/admin/berita/tambah', {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Berita berhasil disimpan');
                closeModal('tambah');
            } else {
                alert('Gagal menyimpan berita');
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }
</script>
