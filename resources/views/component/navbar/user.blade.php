@auth
<nav class="bg-primary text-white p-4 flex items-center justify-between">
    <div class="flex items-center space-x-2">
        <img src="{{ asset('assets/img/icon/logo.png') }}" alt="Logo" class="h-12">
    </div>

    <div class="flex items-center space-x-4">
        <!-- Icon Notifikasi -->
        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-white hover:text-gray-600 cursor-pointer"
            fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002
                   6.002 0 00-4-5.659V4a2 2 0 10-4 0v1.341C7.67
                   6.165 6 8.388 6 11v3.159c0 .538-.214
                   1.055-.595 1.436L4 17h5m6 0v1a3 3 0
                   11-6 0v-1m6 0H9" />
        </svg>

        <!-- Profil -->
        <div x-data="{ showProfile: false }" class="relative">
            <button @click="showProfile = true" class="text-white">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                     viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                     class="h-7 w-7 text-white hover:text-gray-600 cursor-pointer">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0
                             a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15
                             9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                </svg>
            </button>

            @include('component.profile')
        </div>
    </div>
</nav>
@else

    <div class="navbar-center">
        <ul id="nav-menu" class="nav-menu">
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
                                {{-- @guest
                                    <a href="{{ route('login') }}">
                                <strong>Permohonan Perizinan/Non Perizinan</strong>
                                </a>
                                @else
                                @if (Auth::user()->role === 'user')
                                <a href="{{ route('form.permohonan') }}">
                                    <strong>Permohonan Perizinan/Non Perizinan</strong>
                                </a>
                                @endif
                                @endguest --}}
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown-submenu">
                        <a href="#"><strong>INDUSTRI</strong></a>
                        <ul class="submenu">
                            <li><a href="#"><strong>Directory Book</strong></a></li>
                            <li><a href="#"><strong>Data IKM</strong></a></li>
                            <li><a href="#"><strong>Sertifikasi IKM</strong></a></li>
                        </ul>
                    </li>
                    <li class="dropdown-submenu">
                        <a href="#"><strong>METROLOGI</strong></a>
                        <ul class="submenu">
                            <li><a href="{{ route('administrasi-metrologi') }}"><strong>Surat Permohonan Tera/Teraulang</strong></a></li>
                            <li><a href="{{ route('directory-metrologi') }}"><strong>Alat Milik Saya</strong></a></li>
                        </ul>
                    </li>
                    <li><a href="#"><strong>PERSURATAN</strong></a></li>
                </ul>
            </li>
            <li><a href=""><strong>PELAPORAN</strong></a></li>
            <li><a href=""><strong>FAQ</strong></a></li>
        </ul>
    </div>
    <div class="flex items-center space-x-4">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-white hover:text-gray-600 cursor-pointer"
            fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002
                    6.002 0 00-4-5.659V4a2 2 0 10-4 0v1.341C7.67
                    6.165 6 8.388 6 11v3.159c0 .538-.214
                    1.055-.595 1.436L4 17h5m6 0v1a3 3 0
                    11-6 0v-1m6 0H9" />
        </svg>
        <button class="text-white px-4 py-1 rounded-md text-sm font-semibold">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-white hover:text-gray-600 cursor-pointer"
                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A8.966 8.966 0 0112 15c2.132 0 4.087.745 5.621
                    1.996M15 10a3 3 0 11-6 0 3 3 0
                    016 0zm6 2a9 9 0 11-18 0 9 9 0
                    0118 0z" />
            </svg>
        </button>
    </div>
</nav>
@endauth
</nav>