<!-- Header -->
<div class="flex justify-end bg-blue-100 rounded-tl-2xl">
    <!-- Tombol Tutup di kanan -->
    <button @click="showProfile = false"
        class="flex items-center justify-center w-10 h-10 text-gray-600 hover:bg-blue-200">
        &times;
    </button>
</div>

<!-- Konten -->
<div class="flex-1 p-6 overflow-y-auto text-center">

    <h2 class="p-2 text-base text-lg font-semibold text-black">Profile Anda</h2>

    <!-- Avatar -->
    <img src="https://ui-avatars.com/api/?nama={{ urlencode($user->nama) }}&background=0D8ABC&color=fff"
         class="w-24 h-24 mx-auto rounded-full" alt="Foto Profil">

    <!-- Nama & Email -->
    <h3 class="mt-4 text-lg font-bold text-black">{{ $user->name ?? '-' }}</h3>
    <p class="text-sm text-gray-600">{{ $user->email ?? '-' }}</p>

    <!-- Menu -->
    <div class="mt-6 space-y-4 text-left">
        <a href="{{ route('profile') }}"
           class="flex items-center justify-between p-2 rounded-lg hover:bg-gray-100">
            <div class="flex items-center gap-2">
                <span class="text-sm text-black">●</span>
                <span class="text-sm text-black">Data Pribadi</span>
            </div>
            <span>›</span>
        </a>
        <a href="{{ route('change.password') }}"
           class="flex items-center justify-between p-2 rounded-lg hover:bg-gray-100">
            <div class="flex items-center gap-2">
                <span>🔑</span>
                <span class="text-sm text-black">Ubah Kata Sandi</span>
            </div>
            <span>›</span>
        </a>
    </div>
</div>

<!-- Logout -->
<div class="p-4 text-center border-t">
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit"
            class="px-4 py-1 font-medium text-black transition border border-black rounded-full hover:bg-gray-100">
            Keluar →
        </button>
    </form>
</div>
