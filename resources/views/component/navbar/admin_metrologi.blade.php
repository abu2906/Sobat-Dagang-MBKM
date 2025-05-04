<div class="w-60 bg-[#0c3454] text-white min-h-screen flex flex-col justify-between space-y-2 p-4">
    <div class="text-xl font-bold mb-2">
        <img src="{{ asset('/assets/img/icon/logo.png') }}" alt="Logo Dinas Perdagangan">
    </div>
    {{-- Navigasi --}}
    <div>
        <ul class="space-y-2">
            <li>
                <a href="{{ route('dashboard-admin-metrologi') }}"
                   class="block px-4 py-2 rounded-md 
                   {{ Route::is('dashboard-admin-metrologi') ? 'bg-white text-black font-semibold hover:text-black' : 'hover:bg-white' }}">
                    Dashboard
                </a>
            </li>
            <li>
                <a href="{{ route('alat-ukur-metrologi') }}"
                   class="block px-4 py-2 rounded-md 
                   {{ Route::is('alat-ukur-metrologi') ? 'bg-white text-black font-semibold hover:text-black' : 'hover:bg-white' }}">
                    Alat Ukur Valid
                </a>
            </li>
            <li>
                <a href="{{ route('managemen-uttp-metrologi') }}"
                   class="block px-4 py-2 rounded-md 
                   {{ Route::is('managemen-uttp-metrologi') ? 'bg-white text-black font-semibold hover:text-black' : 'hover:bg-white' }}">
                    Management UTTP
                </a>
            </li>
            <li>
                <a href="{{ route('persuratan-metrologi') }}"
                   class="block px-4 py-2 rounded-md 
                   {{ Route::is('persuratan-metrologi') ? 'bg-white text-black font-semibold hover:text-black' : 'hover:bg-white' }}">
                    Persuratan
                </a>
            </li>
        </ul>
    </div>

    {{-- Profil & Logout --}}
    <div class="space-y-4">
        {{-- Profil Admin --}}
        <div class="flex items-center gap-3">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 12c2.67 0 8 1.34 8 4v2H4v-2c0-2.66 5.33-4 8-4zm0-2a4 4 0 1 1 0-8 4 4 0 0 1 0 8z"/>
            </svg>
            <div>
                <div class="text-sm font-semibold">{{ Auth::user()->name ?? 'Admin' }}</div>
                <div class="text-xs text-gray-300">Administrator</div>
            </div>
        </div>

        {{-- Tombol Logout --}}
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="w-1/2 text-center px-2 py-1 rounded-md hover:bg-gray-200 bg-white font-semibold text-black">
                Keluar
            </button>
        </form>
    </div>
</div>

