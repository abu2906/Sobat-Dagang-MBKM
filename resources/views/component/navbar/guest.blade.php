<nav class="navbar">
    <div class="navbar-left">
        <a href="/">
            <img src="{{ asset('assets/img/icon/logo.png') }}" alt="Logo" class="logo">
        </a>
    </div>

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
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown-submenu">
                        <a href="#"><strong>INDUSTRI</strong></a>
                        <ul class="submenu">
                            <li><a href="#"><strong>Permohonan IKM Binaan</strong></a></li>
                            <li><a href="#"><strong>Sertifikasi Halal</strong></a></li>
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
            <li><a href=""><strong>PELAPORAN</strong></a></li>
            <li><a href="#" id="open-chat"><strong>FAQ</strong></a></li>
        </ul>
    </div>

    <div class=" navbar-right">
        <a href="{{ route('login') }}" class="btn-login"><strong>Login</strong></a>
    </div>
</nav>