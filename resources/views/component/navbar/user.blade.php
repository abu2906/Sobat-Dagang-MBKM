@auth('user')
<nav class="navbar w-full px-4 py-2 text-white bg-[#083358]" style="font-family: 'Poppins', sans-serif;">
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
                                <li><a href="{{ route('bidangIndustri.formPermohonan') }}"><strong>Permohonan IKM Binaan</strong></a></li>
                                <li><a href="{{ route('halal.user') }}"><strong>Data Sertifikat Halal</strong></a></li>
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

        <div class="items-center hidden mt-2 space-x-4 md:flex md:mt-0">
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
</nav>

<!-- Panel Profil
<div x-data="{ showProfileMenu: false }"
     x-show="showProfile"
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0 translate-x-full"
     x-transition:enter-end="opacity-100 translate-x-0"
     x-transition:leave="transition ease-in duration-200"
     x-transition:leave-start="opacity-100 translate-x-0"
     x-transition:leave-end="opacity-0 translate-x-full"
     @click.outside="showProfile = false"
     class="fixed top-[70px] right-0 w-[350px] h-[700px] bg-white shadow-2xl z-50 rounded-l-2xl overflow-hidden flex flex-col">

    <div class="flex justify-end bg-blue-100 rounded-tl-2xl">
        <button @click="showProfile = false"
            class="flex items-center justify-center w-10 h-10 text-gray-600 hover:bg-blue-200">
            &times;
        </button>
    </div>

    <div class="flex-1 p-6 overflow-y-auto text-center">
        <h2 class="p-2 text-base text-lg font-semibold text-black">Profile Anda</h2>

        <img src=""
             class="w-24 h-24 mx-auto rounded-full" alt="Foto Profil">

        <h3 class="mt-4 text-lg font-bold text-black">Robert</h3>
        <p class="text-sm text-gray-600">Robert</p>

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

    <div class="p-4 text-center border-t">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                class="px-4 py-1 font-medium text-black transition border border-black rounded-full hover:bg-gray-100">
                Keluar →
            </button>
        </form>
    </div>
</div> -->

<!-- <script>
    document.addEventListener('DOMContentLoaded', function () {
        const burgerBtn = document.getElementById('burger-btn');
        const navMenu = document.getElementById('nav-menu');
        burgerBtn?.addEventListener('click', () => {
            navMenu?.classList.toggle('hidden');
        });
    });
</script> -->
@endauth
