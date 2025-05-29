@auth('user')

<nav class="navbar w-full px-4 py-2 text-white bg-[#083358]" style="font-family: 'Poppins', sans-serif;" x-data="{ showProfile: false, menuOpen: false }">
    <div class="flex flex-col w-full md:flex-row md:items-center md:justify-between">
        <div class="flex items-center justify-between w-full md:w-auto">
            <a href="{{ route('user.dashboard') }}">
                <img src="{{ asset('assets/img/icon/logo.png') }}" alt="Logo" class="h-10">
            </a>
            
            <button id="burger-btn" class="md:hidden focus:outline-none">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>

            <!-- Notifikasi & Profil (mobile only) -->
            <div class="flex items-center space-x-4 md:hidden">
                <!-- Notifikasi -->
                <button aria-label="Notifikasi" class="focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="text-white h-7 w-7 hover:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002
                            6.002 0 00-4-5.659V4a2 2 0 10-4 0v1.341C7.67
                            6.165 6 8.388 6 11v3.159c0 .538-.214
                            1.055-.595 1.436L4 17h5m6 0v1a3 3 0
                            11-6 0v-1m6 0H9" />
                    </svg>
                </button>

                <!-- Profil -->
                <button aria-label="Profil" class="focus:outline-none" @click="showProfile = true">
                    <svg xmlns="http://www.w3.org/2000/svg" class="text-white h-7 w-7 hover:text-gray-300" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0
                            a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15
                            9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                    </svg>
                </button>
            </div>
        </div>

        <div id="nav-menu" class="flex-col hidden navbar-center md:flex md:flex-row md:items-center md:space-x-6">
            <ul class="flex flex-col nav-menu md:flex-row">
                    <li><a href="https://peraturan.bpk.go.id/"><strong>REGULASI</strong></a></li>
                    <li><a href="{{ route('about') }}"><strong>ABOUT US</strong></a></li>

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle"><strong>PELAYANAN</strong> <span class="dropdown-icon">▼</span></a>
                    <ul class="dropdown-menu">
                        <li class="dropdown-submenu">
                            <a href="#"><strong>PERDAGANGAN</strong></a>
                            <ul class="submenu">
                                <li>
                                    <a href="{{ route('bidangPerdagangan.formPermohonan') }}">
                                        <strong>Permohonan Perizinan/Non Perizinan</strong>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="dropdown-submenu">
                            <a href="#"><strong>INDUSTRI</strong></a>
                            <ul class="submenu">
                                <li><a href="{{route('bidangIndustri.formPermohonan')}}"><strong>Permohonan IKM Binaan</strong></a></li>
                                <li><a href="{{route('halal.user')}}"><strong>Data Sertifikat Halal</strong></a></li>
                            </ul>
                        </li>
                        <li class="dropdown-submenu">
                            <a href="#"><strong>METROLOGI</strong></a>
                            <ul class="submenu">
                                <li><a href="{{ route('administrasi-metrologi') }}"><strong>Permohonan Tera baru/Tera ulang</strong></a></li>
                                <li><a href="{{ route('directory-metrologi') }}"><strong>Alat Ukur Valid</strong></a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                    <li><a href="{{ route('pelaporan') }}"><strong>PELAPORAN</strong></a></li>
                    <li><a href="{{ route('faq') }}" id="open-chat"><strong>FAQ</strong></a></li>    
                </ul>
            </div>

            <!-- Notifikasi & Profil (desktop) -->
        <div class="items-center hidden space-x-4 md:flex">
            <button aria-label="Notifikasi" class="focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="text-white h-7 w-7 hover:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002
                        6.002 0 00-4-5.659V4a2 2 0 10-4 0v1.341C7.67
                        6.165 6 8.388 6 11v3.159c0 .538-.214
                        1.055-.595 1.436L4 17h5m6 0v1a3 3 0
                        11-6 0v-1m6 0H9" />
                </svg>
            </button>
            <button @click="showProfile = true" class="focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="text-white h-7 w-7 hover:text-gray-300" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0
                        a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15
                        9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                </svg>
            </button>
        </div>
        </div>
    </div>
    <!-- Modal Profil -->
            <div
                x-show="showProfile"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 scale-90"
                x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-90"
                @click.outside="showProfile = false"
                class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-60"
                style="display: none;">
                <div class="bg-white rounded-xl shadow-xl w-full max-w-md max-h-[90vh] overflow-y-auto p-6 relative mx-4">
                    <button @click="showProfile = false"
                        class="absolute text-2xl font-bold text-gray-600 top-3 right-3 hover:text-gray-900 focus:outline-none">
                        &times;
                    </button>

                    <h2 class="mb-4 text-lg font-semibold text-center text-black">Profile Anda</h2>

                    <img src="https://ui-avatars.com/api/?name={{ urlencode($user->nama) }}&background=0D8ABC&color=fff" alt="Foto Profil"
                        class="object-cover w-24 h-24 mx-auto mb-4 rounded-full">

                    <!-- Nama & Detail Profil -->
                    <div class="max-w-md px-6 py-4 mx-auto mt-4 text-left bg-white rounded-lg shadow-md">
                        <h3 class="mb-4 text-3xl font-bold text-gray-900">{{ $user->nama ?? '-' }}</h3>
                        <div class="space-y-2 text-gray-700">
                            <p><span class="font-semibold text-gray-800">NIK:</span> {{ $user->nik ?? '-' }}</p>
                            <p><span class="font-semibold text-gray-800">Alamat Lengkap:</span> {{ $user->alamat_lengkap ?? '-' }}</p>
                            <p><span class="font-semibold text-gray-800">Jenis Kelamin:</span> {{ $user->jenis_kelamin ?? '-' }}</p>
                            <p><span class="font-semibold text-gray-800">Email:</span> {{ $user->email ?? '-' }}</p>
                            <p><span class="font-semibold text-gray-800">Telepon:</span> {{ $user->telp ?? '-' }}</p>
                        </div>
                    </div>


                    <!-- Link Ubah Password -->
                    <div class="px-4 mt-6 space-y-4 text-left">
                        <a href="{{ route('change.password') }}"
                        class="flex items-center justify-between p-3 border border-gray-200 rounded-lg hover:bg-gray-100">
                            <div class="flex items-center gap-2">
                                <span class="text-lg">🔑</span>
                                <span class="text-sm font-medium text-black">Ubah Kata Sandi</span>
                            </div>
                            <span class="text-xl text-black">›</span>
                        </a>
                    </div>

                    <div class="pt-4 mt-6 text-center border-t">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full py-2 text-white bg-red-600 rounded hover:bg-red-700">
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
</nav>

<script>
    // Toggle menu burger
    document.getElementById('burger-btn').addEventListener('click', function() {
        const navMenu = document.getElementById('nav-menu');
        navMenu.classList.toggle('hidden');
    });
</script>
@endauth    