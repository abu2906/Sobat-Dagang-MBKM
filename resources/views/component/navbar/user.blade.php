@auth('user')
<nav class="navbar relative w-full px-4 py-2 text-white">
    <div class="flex items-center justify-between w-full">
        <div class="navbar-left">
            <a href="{{ route('user.dashboard') }}">
                <img src="{{ asset('assets/img/icon/logo.png') }}" alt="Logo" class="h-10">
            </a>
        </div>

    <div id="nav-menu" class="navbar-center hidden md:flex flex-col md:flex-row md:items-center md:space-x-6 md:justify-center w-full">
        <ul class="nav-menu flex flex-col md:flex-row">
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
                            <li><a href="{{route('halal')}}"><strong>Data Sertifikat Halal</strong></a></li>
                        </ul>
                    </li>
                    <li class="dropdown-submenu">
                        <a href="#"><strong>METROLOGI</strong></a>
                        <ul class="submenu">
                            <li><a href="{{ route('administrasi-metrologi') }}"><strong>Permohonan Tera/Teraulang</strong></a></li>
                            <li><a href="{{ route('directory-metrologi') }}"><strong>Alat Milik Saya</strong></a></li>
                        </ul>
                    </li>
                </ul>
            </li>

            <li><a href="{{ route('pelaporan') }}"><strong>PELAPORAN</strong></a></li>
            <li><a href="#" id="open-chat"><strong>FAQ</strong></a></li>
        </ul>
    </div>

        <div class="flex items-center space-x-4">
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

            <button aria-label="Profil" class="focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="text-white h-7 w-7 hover:text-gray-300" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0
                            a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15
                            9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                </svg>
            </button>

            <button id="burger-btn" class="md:hidden focus:outline-none">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
        </div>
    </div>
</nav>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const burgerBtn = document.getElementById('burger-btn');
        const navMenu = document.getElementById('nav-menu');

        if (burgerBtn && navMenu) {
            burgerBtn.addEventListener('click', () => {
                navMenu.classList.toggle('hidden');
            });
        }
    });
</script>
@endauth
