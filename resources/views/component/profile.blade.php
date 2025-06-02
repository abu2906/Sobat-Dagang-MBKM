@extends('layouts.home')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-50 via-white to-pink-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="w-full max-w-3xl p-8 bg-white/40 backdrop-blur-md shadow-2xl rounded-3xl border border-white/30 transition-all">

        <div class="mb-6">
            <a href="{{ route('user.dashboard') }}" 
               class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-[#083358] hover:bg-blue-300 hover:text-black rounded-lg shadow transition-all duration-300">
                ← Kembali
            </a>
        </div>

        <h2 class="text-4xl font-bold text-center text-gray-800 mb-8">Edit Profil</h2>

        <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="flex flex-col items-center">
                @php
                    $avatarPath = $user->avatar && file_exists(public_path('storage/foto_profil/' . $user->avatar))
                                ? asset('storage/foto_profil/' . $user->avatar)
                                : "https://ui-avatars.com/api/?name=" . urlencode($user->nama) . "&background=0D8ABC&color=fff";
                @endphp

                <div class="relative group w-28 h-28">
                    <img id="preview" src="{{ $avatarPath }}" alt="Foto Profil"
                         class="rounded-full object-cover w-28 h-28 border-4 border-white shadow-lg transition-transform duration-300 group-hover:scale-110">
                </div>

                <input type="file" name="avatar" id="avatar" accept="image/*"
                       class="mt-4 block w-full text-sm text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-[#083358] hover:file:bg-blue-100"
                       onchange="previewImage(event)">
                <p class="mt-1 text-xs text-gray-500">Ukuran maksimal 500KB</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="nama" class="block text-sm font-medium text-gray-700 mb-1">Nama</label>
                    <div class="relative">
                        <input type="text" id="nama" name="nama" value="{{ old('nama', $user->nama) }}" required
                               class="capitalize w-full pl-10 pr-4 py-2 rounded-lg bg-white/60 border border-gray-300 text-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-400 shadow-sm">
                        <span class="absolute left-3 top-2.5 text-gray-400">
                            <i class="fas fa-user"></i>
                        </span>
                    </div>
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <div class="relative">
                        <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required
                               oninput="validateEmail(this)"
                               class="w-full pl-10 pr-4 py-2 rounded-lg bg-white/60 border border-gray-300 text-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-400 shadow-sm">
                        <span class="absolute left-3 top-2.5 text-gray-400">
                            <i class="fas fa-envelope"></i>
                        </span>
                        <p id="emailError" class="mt-1 text-sm text-red-500 hidden">Email harus mengandung simbol @</p>
                    </div>
                </div>

                <div>
                    <label for="telp" class="block text-sm font-medium text-gray-700 mb-1">Telepon</label>
                    <div class="relative">
                        <input type="text" id="telp" name="telp" value="{{ old('telp', $user->telp) }}"
                               class="w-full pl-10 pr-4 py-2 rounded-lg bg-white/60 border border-gray-300 text-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-400 shadow-sm">
                        <span class="absolute left-3 top-2.5 text-gray-400">
                            <i class="fas fa-phone-alt"></i>
                        </span>
                    </div>
                </div>

                <div>
                    <label for="jenis_kelamin" class="block text-sm font-medium text-gray-700 mb-1">Jenis Kelamin</label>
                    <select id="jenis_kelamin" name="jenis_kelamin"
                            class="w-full px-4 py-2 rounded-lg bg-white/60 border border-gray-300 text-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-400 shadow-sm">
                        <option value="Laki-laki" {{ old('jenis_kelamin', $user->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="Perempuan" {{ old('jenis_kelamin', $user->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                </div>
            </div>

            <div>
                <label for="alamat_lengkap" class="block text-sm font-medium text-gray-700 mb-1">Alamat Lengkap</label>
                <textarea id="alamat_lengkap" name="alamat_lengkap" rows="3"
                          class="capitalize w-full px-4 py-2 rounded-lg bg-white/60 border border-gray-300 text-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-400 shadow-sm">{{ old('alamat_lengkap', $user->alamat_lengkap) }}</textarea>
            </div>

            <div class="text-center pt-4">
                <button type="submit"
                        class="px-6 py-3 text-white font-bold rounded bg-[#083358] hover:bg-blue-300 hover:text-black transition-all duration-300 shadow-lg">
                    💾 Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function previewImage(event) {
        const file = event.target.files[0];
        const maxSize = 500 * 1024;

        if (file && file.size > maxSize) {
            alert("Ukuran file maksimal 500KB.");
            event.target.value = "";
            return;
        }

        const reader = new FileReader();
        reader.onload = function () {
            document.getElementById('preview').src = reader.result;
        }
        reader.readAsDataURL(file);
    }

    function validateEmail(input) {
        const error = document.getElementById('emailError');
        if (!input.value.includes('@')) {
            error.classList.remove('hidden');
        } else {
            error.classList.add('hidden');
        }
    }
</script>
@endsection
