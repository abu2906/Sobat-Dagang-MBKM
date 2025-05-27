
@extends('layouts.admin')

@section('title', 'Kelola Admin')

@section('content')

<div class="relative w-full h-64">
    <img src="{{ asset('assets\img\background\kepalaDinas_SuperAdmin.jpg') }}" alt="Port Background" class="object-cover w-full h-full">
    <div class="absolute z-10 text-center transform -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2">
        <h1 class="text-5xl font-bold text-[#FAA31E]">Manajemen Data Pengguna</h1>
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
                + Tambah Pengguna Baru
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

</div>

<div id="modalEditData" class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black bg-opacity-50">
    <div class="relative max-w-xl w-full max-h-[90vh] overflow-y-auto p-8 bg-white rounded-lg shadow-xl">
        <h3 class="mb-6 text-2xl font-semibold text-center">Edit Data Pengguna</h3>
        <form method="POST" id="editForm" action="" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="name_edit" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                <input type="text" id="name_edit" name="name" class="w-full p-3 border rounded-md focus:ring-2 focus:ring-blue-500" required>
            </div> 
            <div class="mb-4">
                <label for="email_edit" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" id="email_edit" name="email" class="w-full p-3 border rounded-md focus:ring-2 focus:ring-blue-500" required>
            </div>
            <div class="mb-4">
                <label for="phone_edit" class="block text-sm font-medium text-gray-700">No. Hp</label>
                <input type="text" id="phone_edit" name="phone" class="w-full p-3 border rounded-md focus:ring-2 focus:ring-blue-500" required>
            </div>
            <div class="mb-4">
                <label for="nib_nik_nip_edit" class="block text-sm font-medium text-gray-700">NIB/NIK/NIP</label>
                <input type="text" id="nib_nik_nip_edit" name="nib_nik_nip" class="w-full p-3 border rounded-md focus:ring-2 focus:ring-blue-500" required> 
            </div>
            <div class="mb-4">
                <label for="role_edit" class="block text-sm font-medium text-gray-700">Role</label>
                <select id="role_edit" name="role_edit" class="w-full p-3 border rounded-md focus:ring-2 focus:ring-blue-500">
                    <option value="master_admin">Master Admin</option>
                    <option value="admin_perdagangan">Admin Perdagangan</option>
                    <option value="admin_industri">Admin Industri</option>
                    <option value="admin_metrologi">Admin Metrologi</option>
                    <option value="kabid_perdagangan">Kabid Perdagangan</option>
                    <option value="kabid_industri">Kabid Industri</option>
                    <option value="kabid_metrologi">Kabid Metrologi</option>
                </select>

            </div>
            <div class="flex justify-end mt-6 space-x-3">
                <button type="button" onclick="closeModal('edit')" class="px-4 py-2 text-black bg-gray-300 rounded-full hover:bg-gray-400">Batal</button>
                <button type="submit" class="px-6 py-2 bg-[#083358] text-white rounded-full hover:bg-[#061f3c] transition">Simpan</button>
            </div>

            @if ($errors->any())
            <div class="p-4 mt-4 text-red-700 bg-red-100 border border-red-400 rounded">
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

<div id="modalTambahPengguna" class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black bg-opacity-50">
    <div class="relative max-w-xl w-full max-h-[90vh] overflow-y-auto p-8 bg-white rounded-lg shadow-xl">
        <h3 class="mb-6 text-2xl font-semibold text-center">Tambah Pengguna Baru</h3>
        <form action="{{ route('tambah.pengguna') }}" method="POST" id="tambahForm" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                <input type="text" id="name" name="name" class="w-full p-3 border rounded-md focus:ring-2 focus:ring-blue-500" required>
            </div>
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" id="email" name="email" class="w-full p-3 border rounded-md focus:ring-2 focus:ring-blue-500" required>         
            </div>
            <div class="mb-4">
                <label for="nib_nik_nip" class="block text-sm font-medium text-gray-700">NIB/NIK/NIP</label>
                <input type="text" id="nib_nik_nip" name="nib_nik_nip" class="w-full p-3 border rounded-md focus:ring-2 focus:ring-blue-500" required>         
            </div>
            <div class="mb-4">
                <label for="phone" class="block text-sm font-medium text-gray-700">No. Hp</label>
                <input type="text" id="phone" name="phone" class="w-full p-3 border rounded-md focus:ring-2 focus:ring-blue-500" required>         
            </div>
            <label for="role" class="block text-sm font-medium text-gray-700">Role</label>
                <select id="role" name="role" class="w-full p-3 border rounded-md focus:ring-2 focus:ring-blue-500">
                    <option value="master_admin">Master Admin</option>
                    <option value="admin_perdagangan">Admin Perdagangan</option>
                    <option value="admin_industri">Admin Industri</option>
                    <option value="admin_metrologi">Admin Metrologi</option>
                    <option value="kabid_perdagangan">Kabid Perdagangan</option>
                    <option value="kabid_industri">Kabid Industri</option>
                    <option value="kabid_metrologi">Kabid Metrologi</option>
                </select>
            <div class="flex justify-end mt-6 space-x-3">
                <button type="button" onclick="closeModal('tambah')" class="px-4 py-2 text-black bg-gray-300 rounded-full hover:bg-gray-400">Batal</button>
                <button type="submit" class="px-6 py-2 bg-[#083358] text-white rounded-full hover:bg-[#061f3c] transition">Tambah</button>
            </div>
        </form>
    </div>
</div>

<script>
    function openModal(type, button = null) {
        if (type === 'edit') {
            const name = button.getAttribute('data-name');
            const email = button.getAttribute('data-email');
            const phone = button.getAttribute('data-phone');
            const nib_nik_nip = button.getAttribute('data-nib_nik_nip');
            const role = button.getAttribute('data-role');
            
            document.getElementById('name_edit').value = name;
            document.getElementById('email_edit').value = email;
            document.getElementById('phone_edit').value = phone;
            document.getElementById('nib_nik_nip_edit').value = nib_nik_nip;
            document.getElementById('role_edit').value = role;
 
            document.getElementById('modalEditData').classList.remove('hidden');
        }
        if (type === 'delete') {
            const userId = button;
            document.getElementById('modalDelete').querySelector('form').action = '/admin/' + userId;
            document.getElementById('modalDelete').classList.remove('hidden');
        }
        if (type === 'tambah') {
            document.getElementById('modalTambahPengguna').classList.remove('hidden');
        }
    }
    function closeModal(type) {
        if (type === 'edit') {
            document.getElementById('modalEditData').classList.add('hidden');
        }
        if (type === 'tambah') {
            document.getElementById('modalTambahPengguna').classList.add('hidden');
        }
    }
</script>

@endsection
