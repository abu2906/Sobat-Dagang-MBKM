<div x-data="sidebar()" x-init="checkScreen()" @resize.window="checkScreen" class="flex h-screen relative z-[100]">

    <div :class="open ? 'w-64' : 'w-20'"
        class="bg-[#0c3252] text-white flex flex-col justify-between rounded-r-xl transition-all duration-300 relative shadow-md z-10">

        <button @click="open = !open"
            class="absolute -right-3 top-10 w-7 h-7 bg-white text-[#0c3252] font-bold rounded-full flex items-center justify-center shadow-md hover:scale-105 transition">
            <svg x-show="open" xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            <svg x-show="!open" xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
        </button>

        <div class="p-4 space-y-6">
            <div class="flex justify-between" x-show="open">
                <img src="{{ asset('assets/img/icon/logo.png') }}" class="h-10" alt="Logo">
            </div>
            <div class="flex justify-center" x-show="!open">
                <img src="{{ asset('assets/img/icon/logoIcon.png') }}" class="h-6" alt="Logo">
            </div>

            <ul class="space-y-2 text-sm">
                @php
                $menuItems = [
                ['href' => route('dashboard.master'), 'icon' => 'dashboard.png', 'label' => 'Dashboard'],
                ['href' => route('forum.admin'), 'icon' => 'forum.png', 'label' => 'Pengaduan'],
                ['href' => route('review.pengajuan'), 'icon' => 'data.png', 'label' => 'Pelaporan Distributor'],
                ['href' => '#', 'icon' => 'persuratan.png', 'label' => 'Surat Permohonan'],
                ['href' => route('manajemen.pengguna'), 'icon' => 'person.png', 'label' => 'Manajemen Pengguna'],
                ['href' => route('manajemen.admin'), 'icon' => 'person.png', 'label' => 'Manajemen Admin'],
                ['href' => route('kelola.berita'), 'icon' => 'newspaper.png', 'label' => 'Kelola Berita'],
                ['href' => route('faq-controller'), 'icon' => 'faq.png', 'label' => 'FAQ'],
                ];
                @endphp

                @foreach ($menuItems as $item)
                <li>
                    <a href="{{ $item['href'] }}"
                        class="flex items-center px-3 py-2 transition duration-200 rounded-full hover:bg-blue-500/20 hover:border hover:border-blue-500/40 hover:font-bold">
                        <img src="{{ asset('assets/img/icon/' . $item['icon']) }}" class="w-5 h-5 text-white" alt="{{ $item['label'] }}">
                        <span x-show="open" class="ml-3">{{ $item['label'] }}</span>
                    </a>
                </li>
                @endforeach
            </ul>
        </div>
        <div class="p-4 space-y-4">
            <div class="flex items-center">
                <img src="{{ asset('assets/img/icon/person.png') }}" class="w-8 h-8 rounded-full" alt="Profile">
                <div class="ml-3" x-show="open">
                    <p class="text-sm font-semibold">Dinas Perdagangan</p>
                    <p class="text-xs">Master Admin</p>
                </div>
            </div>

            <div class="flex flex-col space-y-2">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="flex items-center px-3 py-1 text-black bg-white rounded-full hover:bg-gray-200">
                        <span x-show="open" class="mr-2">Keluar</span>
                        <img src="{{ asset('assets/img/icon/logout.png') }}" class="w-6 h-6" alt="Logout">
                    </button>
                </form>
            </div>
        </div>
    </div>
<script>
    function sidebar() {
        return {
            open: window.innerWidth >= 768, // default: true jika layar lebar
            checkScreen() {
                this.open = window.innerWidth >= 768;
            }
        }
    }
</script>