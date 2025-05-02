<div class="w-64 bg-[#0c3454] text-white min-h-screen flex flex-col justify-between space-y-4 p-4">
    <div class="text-xl font-bold mb-4">
        <img src="{{ asset('/assets/img/logo/dinasPerdagangan.png') }}" alt="Logo Dinas Perdagangan">
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
            <img src="{{ asset('images/user.png') }}" alt="Profile" class="w-10 h-10 rounded-full border">
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

