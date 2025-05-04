<div :class="open ? 'w-64' : 'w-20'"
             class="bg-[#0c3252] text-white flex flex-col justify-between rounded-r-xl transition-all duration-300 relative shadow-md z-10">

            <button @click="open = !open"
                    class="absolute -right-3 top-10 w-7 h-7 bg-white text-[#0c3252] font-bold rounded-full flex items-center justify-center shadow-md hover:scale-105 transition">
                <svg x-show="open" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                <svg x-show="!open" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
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
                            ['href' => '#', 'icon' => 'dashboard.png', 'label' => 'Dashboard'],
                            ['href' => '#', 'icon' => 'add_barang.png', 'label' => 'Tambahkan Barang'],
                            ['href' => '#', 'icon' => 'tag.png', 'label' => 'Update harga barang'],
                            ['href' => '#', 'icon' => 'report-filled.png', 'label' => 'Lihat Laporan'],
                        ];
                    @endphp

                    @foreach ($menuItems as $item)
                        <li>
                            <a href="{{ $item['href'] }}"
                               class="flex items-center px-3 py-2 rounded-full transition duration-200
                                      hover:bg-blue-500/20 hover:border hover:border-blue-500/40 hover:font-bold">
                                <img src="{{ asset('assets/img/icon/' . $item['icon']) }}" class="w-5 h-5" alt="{{ $item['label'] }}">
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
                        {{-- <p class="text-sm font-semibold">{{ Auth::user()->name }}</p> --}}
                        <p class="text-sm font-semibold">Andi Magfirah Maqbul</p>
                        <p class="text-xs">Admin</p>
                    </div>
                </div>

                <div class="flex flex-col space-y-2">
                    <a href="#"
                       class="flex items-center px-2 py-2 rounded-full transition duration-200
                              hover:bg-blue-500/20 hover:border hover:border-blue-500/40 hover:font-bold">
                        <img src="{{ asset('assets/img/icon/settings.png') }}" class="w-6 h-6" alt="Pengaturan">
                        <span x-show="open" class="ml-2">Pengaturan</span>
                    </a>

                    <form method="POST" action="#">
                        @csrf
                        <button type="submit"
                                class="flex items-center bg-white text-black px-3 py-1 rounded-full hover:bg-gray-200">
                            <span x-show="open" class="mr-2">Keluar</span>
                            <img src="{{ asset('assets/img/icon/logout.png') }}" class="w-6 h-6" alt="Logout">
                        </button>
                    </form>
                </div>
            </div>
        </div>