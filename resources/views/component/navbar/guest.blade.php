<nav class="navbar">
    <div class="navbar-left">
        <a href="/">
            <img src="{{ asset('img/logo.png') }}" alt="Logo" class="logo">
        </a>
    </div>    
    
    <div class="navbar-center">
        <ul class="nav-menu">
            <li><a href="{{ route('regulasi') }}"><strong>REGULASI</strong></a></li>
            <li><a href="{{ route('about') }}"><strong>ABOUT US</strong></a></li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle"><strong>PELAYANAN</strong> <span class="dropdown-icon">▼</span></a>
                <ul class="dropdown-menu">
                    <li class="dropdown-submenu">
                        <a href="#"><strong>PERDAGANGAN</strong></a>
                        <ul class="submenu">
                            <li><a href="{{ route('permohonan-perizinan') }}"><strong>Permohonan Perizinan/Perizinan</strong></a></li>
                            <li><a href="{{ route('pendampingan') }}"><strong>Pendampingan</strong></a></li>
                        </ul>
                    </li>
                    <li class="dropdown-submenu">
                        <a href="#"><strong>INDUSTRI</strong></a>
                        <ul class="submenu">
                            <li><a href="{{ route('directory-book') }}"><strong>Directory Book</strong></a></li>
                            <li><a href="{{ route('data-ikm') }}"><strong>Data IKM</strong></a></li>
                            <li><a href="{{ route('sertifikasi-ikm') }}"><strong>Sertifikasi IKM</strong></a></li>
                        </ul>
                    </li>
                    <li class="dropdown-submenu">
                        <a href="#"><strong>METROLOGI</strong> </a>
                        <ul class="submenu">
                            <li><a href="{{ route('directory-book-metrologi') }}"><strong>Directory Book</strong></a></li>
                            <li><a href="{{ route('surat-permohonan') }}"><strong>Surat Permohonan</strong></a></li>
                            <li><a href="{{ route('regulasi-metrologi') }}"><strong>Regulasi</strong></a></li>
                        </ul>
                    </li>
                    <li><a href="{{ route('persuratan') }}"><strong>PERSURATAN</strong></a></li>
                </ul>
            </li>
            <li><a href="{{ route('pelaporan') }}"><strong>PELAPORAN</strong></a></li>
        </ul>
    </div>
    
    <div class="navbar-right">
        <a href="{{ route('login') }}" class="btn btn-login"><strong>Login</strong></a>
    </div>
</nav>
