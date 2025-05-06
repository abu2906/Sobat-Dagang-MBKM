@extends('layouts.admin')

@section('title', 'Kelola Berita')

@section('content')

<div class="relative w-full h-64">
    <img src="{{ asset('assets\img\background\kepalaDinas_SuperAdmin.jpg') }}" alt="Port Background" class="object-cover w-full h-full">
    <div class="absolute z-10 text-center transform -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2">
        <h1 class="text-5xl font-bold text-[#FAA31E]">Kelola Berita</h1>
    </div>
</div>

<div class="container relative px-4 mx-auto -mt-8">
    <div class="flex justify-center mb-6 space-x-4">
        <div class="relative w-1/2 bg-white rounded-full shadow-xl shadow-gray-400/40">
            <span class="absolute text-gray-500 transform -translate-y-1/2 material-symbols-outlined left-3 top-1/2">
                search
            </span>
            <input type="text" placeholder="Cari"
                class="w-full p-3 pl-10 bg-transparent border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500" />
        </div>
        <div class="bg-white rounded-full shadow-xl shadow-gray-400/40">
            <button onclick="openModal('tambah')" class="btn btn-primary rounded-full py-3 px-6 text-[#083358] font-semibold bg-white
                    hover:text-white hover:bg-[#083358]">
                + Tambah Berita
            </button>
        </div>
    </div>
</div>

<div class="container px-4 pb-12 mx-auto">
    @if(session('success'))
    <div class="mb-4 text-green-600">
        {{ session('success') }}
    </div>
    @endif

    <table class="min-w-full overflow-hidden bg-white border border-gray-300 shadow-md rounded-xl">
        <thead>
            <tr class="bg-[#083358] text-white font-semibold">
                <th class="px-4 py-3 border-b rounded-tl-xl">No</th>
                <th class="px-4 py-3 border-b">Tanggal</th>
                <th class="px-4 py-3 border-b">Judul Berita</th>
                <th class="px-4 py-3 border-b rounded-tr-xl">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($daftarBerita as $index => $item)
            <tr>
                <td class="px-4 py-2 text-center border">{{ $index + 1 }}</td>
                <td class="px-4 py-2 text-center border">
                    {{ $item->tanggal ? \Carbon\Carbon::parse($item->tanggal)->locale('id')->translatedFormat('l, d F Y') : '-' }}
                </td>
                <td class="px-4 py-2 border ">{{ $item->judul }}</td>
                <td class="flex items-center justify-center px-4 py-2 space-x-2 border">
                    <button
                        onclick="openModal('edit', this)"
                        data-id="{{ $item->id_berita }}"
                        data-judul="{{ $item->judul }}"
                        data-tanggal="{{ $item->tanggal }}"
                        data-isi="{{ htmlentities($item->isi) }}"
                        class="text-[#083358] hover:text-black">
                        <span class="material-symbols-outlined">edit</span>
                    </button>
                    <button
                        onclick="openModal('delete', this)"
                        data-id="{{ $item->id_berita }}"
                        class="text-[#083358] hover:text-black">
                        <span class="material-symbols-outlined">delete</span>
                    </button>


                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>

<div id="modalEdit" class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black bg-opacity-50">
    <div class="relative max-w-xl w-full max-h-[90vh] overflow-y-auto p-8 bg-white rounded-lg shadow-xl">
        <h3 class="mb-6 text-2xl font-semibold text-center">Edit Berita</h3>
        <form method="POST" id="editForm" action="" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="judul_edit" class="block text-sm font-medium text-gray-700">Judul Berita</label>
                <input type="text" id="judul_edit" name="judul" class="w-full p-3 border rounded-md focus:ring-2 focus:ring-blue-500" required>
            </div>

            <div class="mb-4">
                <label for="tanggal_edit" class="block text-sm font-medium text-gray-700">Tanggal Berita</label>
                <input type="date" id="tanggal_edit" name="tanggal" class="w-full p-3 border rounded-md focus:ring-2 focus:ring-blue-500" required>
            </div>

            <div class="mb-4">
                <label for="summernote_edit" class="block text-sm font-medium text-gray-700">Isi Berita</label>
                <textarea id="summernote_edit" name="isi" class="w-full p-3 border rounded-md resize-none focus:ring-2 focus:ring-blue-500"></textarea>
            </div>

            <div class="mb-4">
                <label for="gambar_edit" class="block text-sm font-medium text-gray-700">Lampiran (Gambar)</label>
                <div class="flex items-center space-x-3">
                    <label for="gambar_edit" class="px-4 py-2 bg-blue-100 text-black rounded-full cursor-pointer hover:bg-[#083358] hover:text-white transition">Pilih File</label>
                    <span id="file-name-edit" class="text-gray-500">Tidak ada file yang dipilih</span>
                    <input type="file" id="gambar_edit" name="lampiran" class="hidden" onchange="document.getElementById('file-name-edit').innerText = this.files[0]?.name ?? 'Tidak ada file yang dipilih'">
                </div>
            </div>

            <div class="flex justify-end mt-6 space-x-3">
                <button type="button" onclick="closeModal('edit')" class="px-4 py-2 text-black bg-gray-300 rounded-full hover:bg-gray-400">Batal</button>
                <button type="submit" class="px-6 py-2 bg-[#083358] text-white rounded-full hover:bg-[#061f3c] transition">Simpan</button>
            </div>
            @if ($errors->any())
            <div class="p-4 mb-4 text-red-700 bg-red-100 border border-red-400 rounded">
                <ul class="pl-5 list-disc">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
        </form>
    </div>
</div>

<div id="modalTambah" class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black bg-opacity-50">
    <div class="relative max-w-xl w-full max-h-[90vh] overflow-y-auto p-8 bg-white rounded-lg shadow-xl">
        <h3 class="mb-6 text-2xl font-semibold text-center">Tambah Berita</h3>
        <form action="{{ route('tambah.berita') }}" method="POST" id="tambahForm" enctype="multipart/form-data">
            @csrf

            <div class="mb-4">
                <label for="judul_tambah" class="block text-sm font-medium text-gray-700">Judul Berita</label>
                <input type="text" name="judul" class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Masukkan Judul Berita" required>
            </div>

            <div class="mb-4">
                <label for="tanggal_tambah" class="block text-sm font-medium text-gray-700">Tanggal Berita</label>
                <input type="date" name="tanggal" class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <div class="mb-4">
                <label for="konten_tambah" class="block text-sm font-medium text-gray-700">Isi Berita</label>
                <textarea name="isi" id="summernote" class="resize-none w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Masukkan Isi Berita" required></textarea>
            </div>

            <div class="mb-4">
                <label for="gambar_tambah" class="block text-sm font-medium text-gray-700">Lampiran (Gambar)</label>
                <div class="flex items-center space-x-3">
                    <label for="gambar_tambah" class="px-4 py-2 bg-blue-100 text-black rounded-full cursor-pointer transition-all duration-300 hover:bg-[#083358] hover:text-white">Pilih File</label>
                    <span id="file-name-tambah" class="text-gray-500">Tidak ada file yang dipilih</span>
                    <input type="file" id="gambar_tambah" name="lampiran" class="hidden" accept="image/*"
                        onchange="document.getElementById('file-name-tambah').innerText = this.files[0]?.name ?? 'Tidak ada file yang dipilih'">
                </div>
            </div>

            <div class="flex justify-end mt-6 space-x-3 ">
                <button type="button" onclick="closeModal('tambah')"
                    class="px-4 py-2 text-black transition-all bg-gray-300 rounded-full hover:bg-gray-300">
                    Batal
                </button>
                <button type="submit"
                    class="px-6 py-2 bg-[#083358] text-white rounded-full hover:bg-[#061f3c] transition-all">
                    Simpan
                </button>
            </div>

            @if ($errors->any())
            <div class="mt-4 text-sm text-red-600">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

        </form>
    </div>
</div>

<div id="modalDelete" class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black bg-opacity-50">
    <div class="w-11/12 max-w-md p-6 bg-white shadow-xl rounded-2xl">
        <h2 class="mb-4 text-lg font-semibold">Hapus Berita</h2>
        <p class="mb-6 text-sm text-black-600">Apakah Anda yakin ingin menghapus berita ini?</p>
        <form id="formDelete" method="POST">
            @csrf
            @method('DELETE')
            <div class="flex justify-end gap-3">
                <button type="button" onclick="closeModal('delete')" class="px-4 py-2 text-black bg-gray-300 rounded-full hover:bg-gray-400">
                    Batal
                </button>
                <button type="submit" class="px-6 py-2 text-white transition bg-red-600 rounded-full hover:bg-red-700">
                    Hapus
                </button>
            </div>
        </form>
    </div>
</div>
<<<<<<< HEAD
=======



>>>>>>> origin/Robert-Database
@endsection


<script>
    // Fungsi untuk membuka modal
    function openModal(type, button) {
        if (type === 'edit') {
            // Ambil data dari atribut data-xxx
            const beritaId = button.getAttribute('data-id');
            const judul = button.getAttribute('data-judul');
            const isi = button.getAttribute('data-isi');

            // Menghapus tag HTML dengan menggunakan elemen dummy
            const dummy = document.createElement("div");
            dummy.innerHTML = isi; // Memasukkan konten HTML
            const plainText = dummy.innerText; // Mengambil teks polos tanpa tag HTML

            // Isi field judul dan isi berita di form
            document.getElementById('judul_edit').value = judul;
            document.getElementById('tanggal_edit').value = ''; // Kosongkan atau isi dengan tanggal yang sesuai
            $('#summernote_edit').summernote('code', plainText); // Isi Summernote dengan teks polos

            // Set action form untuk edit data
            document.getElementById('editForm').action = `/admin/${beritaId}`;

            $(document).ready(function() {
                $("#summernote_edit").summernote({
                    tabsize: 2,
                    height: 150,
                    toolbar: [
                        ["style", ["bold", "italic", "underline", "clear"]],
                        ["fontsize", ["fontsize"]],
                        ["color", ["color"]],
                        ["para", ["ul", "ol", "paragraph"]],
                    ],
                });
            });
            document.getElementById('modalEdit').classList.remove('hidden');
        } else if (type === 'delete') {
            const beritaId = button.getAttribute('data-id');
            const form = document.getElementById('formDelete');
            form.action = `/admin/${beritaId}`;
            document.getElementById('modalDelete').classList.remove('hidden');
        } else if (type === 'tambah') {
            // Tampilkan modal Tambah dan sembunyikan yang lain
            document.getElementById('modalTambah').classList.remove('hidden');
            $(document).ready(function() {
                $("#summernote").summernote({
                    tabsize: 2,
                    height: 150,
                    toolbar: [
                        ["style", ["bold", "italic", "underline", "clear"]],
                        ["fontsize", ["fontsize"]],
                        ["color", ["color"]],
                        ["para", ["ul", "ol", "paragraph"]],
                    ],
                });
            });
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
</script>