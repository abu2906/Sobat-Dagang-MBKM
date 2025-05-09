<div x-show="showProfile" x-transition @click.outside="showProfile = false"
    class="fixed top-[70px] right-0 w-[350px] h-[500px] bg-white shadow-2xl z-50 rounded-l-2xl overflow-hidden flex flex-col">

    <!-- Header -->
    <div class="bg-blue-100 flex justify-end rounded-tl-2xl">
        <!-- Tombol Tutup di kanan -->
        <button @click="showProfile = false"
            class="w-10 h-10 flex items-center justify-center text-gray-600 hover:bg-blue-200">
            &times;
        </button>
    </div>

    <!-- Konten -->
    <div class="flex-1 p-6 overflow-y-auto text-center">

        <h2 class="text-base text-lg p-2 font-semibold text-black">Profile Anda</h2>
        <!-- Avatar -->
        <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=0D8ABC&color=fff"
             class="w-24 h-24 rounded-full mx-auto" alt="Foto Profil">

        <!-- Nama & Email -->
        <h3 class="mt-4 font-bold text-lg text-black">{{ Auth::user()->nama ?? '-' }}</h3>
        <p class="text-sm text-gray-600">{{ Auth::user()->email ?? '-' }}</p>

        <!-- Menu -->
        <div class="mt-6 space-y-4 text-left">
            <a href="{{ route('profile') }}"
               class="flex items-center justify-between hover:bg-gray-100 p-2 rounded-lg">
                <div class="flex items-center gap-2">
                    <span class="text-black text-sm">●</span>
                    <span class="text-black text-sm">Data Pribadi</span>
                </div>
                <span>›</span>
            </a>
            <a href="{{ route('change.password') }}"
               class="flex items-center justify-between hover:bg-gray-100 p-2 rounded-lg">
                <div class="flex items-center gap-2">
                    <span>🔑</span>
                    <span class="text-black text-sm">Ubah Kata Sandi</span>
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
                class="border border-black rounded-full px-4 py-1 font-medium hover:bg-gray-100 transition">
                Keluar →
            </button>
        </form>
    </div>
</div>

