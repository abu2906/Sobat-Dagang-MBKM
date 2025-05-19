@extends('layouts.home')

@section('title', 'Dashboard')

@section('content')

<section class="px-4 py-12 bg-white">
    
    <div class="grid items-center gap-8 mx-auto max-w-7xl md:grid-cols-2">
        <div>
            <h1 class="text-3xl font-bold text-[#2E3C51] mb-4">
                Selamat datang di Sobat Dagang Kota Parepare
            </h1>
            <p class="text-base text-[#6B7280] leading-relaxed max-w-md">
                Kami siap melayani Anda dalam Pengurusan Perizinan, Pelaporan, dan fasilitas perdagangan lainnya secara mudah dan cepat
            </p>
        </div>
        <div class="flex justify-center md:justify-end">
            <img src="{{ asset('assets/img/icon/ilustrasi-checklist.png') }}" alt="Ilustrasi Formulir" class="w-72 md:w-80">
        </div>
    </div>
</section>

<div class="flex justify-center mt-10 space-x-20">
    @php
        $menus = [
            'PERDAGANGAN' => [
                ['label' => 'Permohonan perizinan/non perizinan', 'route' => route('bidangPerdagangan.formPermohonan')],
            ],
            'INDUSTRI' => [
                ['label' => 'Permohonan IKM Binaan', 'route' => '#'],
                ['label' => 'Data Sertifikat Halal', 'route' => '#'],
            ],
            'METROLOGI' => [
                ['label' => 'Permohonan Tera/Teraulang', 'route' => route('administrasi-metrologi')],
                ['label' => 'Alat Milik Saya', 'route' => route('directory-metrologi')],
            ],
        ];
    @endphp

    @foreach($menus as $title => $items)
    <div class="relative group w-[300px]">
        <button class="bg-[#ABBED1] w-full px-8 py-3 rounded shadow font-bold">{{ $title }}</button>
        <div class="absolute left-0 w-full hidden group-hover:block bg-[#CAE2F6] shadow-lg rounded overflow-hidden">
            @foreach($items as $index => $item)
                <a href="{{ $item['route'] }}"
                   class="block px-6 py-2 font-semibold text-[#083458] text-center hover:bg-[#98c4e9] {{ $index === 0 ? 'rounded-t' : '' }} {{ $index === count($items)-1 ? 'rounded-b' : '' }}">
                    {{ $item['label'] }}
                </a>
            @endforeach
        </div>
    </div>
    @endforeach
</div>

<div class="flex justify-center mb-10 space-x-20 mt-7">
    @php
        $cards = [
            [
                'title' => 'IZIN USAHA TOKO',
                'desc' => 'Fitur untuk pelaku usaha melaporkan kegiatan usahanya secara rutin',
                'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />',
            ],
            [
                'title' => 'LAPORAN',
                'desc' => 'Fitur untuk pelaku usaha melaporkan kegiatan usahanya secara rutin',
                'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z" />',
            ],
            [
                'title' => 'IZIN USAHA TOKO',
                'desc' => 'Fitur untuk pelaku usaha melaporkan kegiatan usahanya secara rutin',
                'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M13.5 21v-7.5a.75.75 0 0 1 .75-.75h3a.75.75 0 0 1 .75.75V21m-4.5 0H2.36m11.14 0H18m0 0h3.64m-1.39 0V9.349M3.75 21V9.349m0 0a3.001 3.001 0 0 0 3.75-.615A2.993 2.993 0 0 0 9.75 9.75c.896 0 1.7-.393 2.25-1.016a2.993 2.993 0 0 0 2.25 1.016c.896 0 1.7-.393 2.25-1.015a3.001 3.001 0 0 0 3.75.614m-16.5 0a3.004 3.004 0 0 1-.621-4.72l1.189-1.19A1.5 1.5 0 0 1 5.378 3h13.243a1.5 1.5 0 0 1 1.06.44l1.19 1.189a3 3 0 0 1-.621 4.72M6.75 18h3.75a.75.75 0 0 0 .75-.75V13.5a.75.75 0 0 0-.75-.75H6.75a.75.75 0 0 0-.75.75v3.75c0 .414.336.75.75.75Z" />',
            ],
        ];
    @endphp

    @foreach($cards as $card)
    <div class="w-[300px] bg-white p-8 rounded-lg border border-gray-300 shadow-[0_8px_20px_rgba(8,52,88,0.2)] text-center">
        <div class="flex justify-center mb-4 text-black">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-14 h-14">
                {!! $card['icon'] !!}
            </svg>
        </div>
        <h3 class="mb-2 text-xl font-bold">{{ $card['title'] }}</h3>
        <p class="text-base text-black">{{ $card['desc'] }}</p>
    </div>
    @endforeach
</div>

<button id="open-chat" class="fixed bottom-5 right-5 bg-[#083458] rounded-full p-3 shadow-lg hover:scale-110 transition">
    <img src="{{ asset('assets/img/icon/pengaduan.png') }}" alt="Chat" class="w-8 h-8">
</button>

@include('component.chat', ['chats' => \App\Models\ForumDiskusi::with('user')->orderBy('waktu')->get()])

<script>
document.addEventListener('DOMContentLoaded', () => {
    const chatModal = document.getElementById('chat-modal');
    const openChatBtn = document.getElementById('open-chat');
    const closeChatBtn = document.getElementById('close-chat');
    const chatForm = document.getElementById('chat-form');
    const chatInput = document.getElementById('chat-input');
    const chatMessages = document.getElementById('chat-messages');
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    // Modal open-close (udah aman)
    openChatBtn?.addEventListener('click', () => {
        chatModal.classList.remove('hidden');
    });
    closeChatBtn?.addEventListener('click', () => {
        chatModal.classList.add('hidden');
    });

    // Submit chat
    chatForm?.addEventListener('submit', async (e) => {
        e.preventDefault();

        const message = chatInput.value.trim();
        if (!message) return; // jangan submit pesan kosong

        try {
            const response = await fetch('/forum-chat/send', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                },
                body: JSON.stringify({ chat: message }),
            });

            if (!response.ok) throw new Error('Response not OK');

            const data = await response.json();

            if (data.success) {
                // Buat elemen pesan baru
                const isMe = true; // ini pesan kita sendiri
                const senderName = data.chat.user?.nama ?? data.chat.disdag?.nama ?? 'Admin Dinas Perdagangan';
                const initial = senderName.charAt(0).toUpperCase();
                const waktu = new Date(data.chat.waktu);
                const options = { hour: '2-digit', minute: '2-digit', timeZone: 'Asia/Makassar' };
                const waktuFormatted = new Intl.DateTimeFormat('id-ID', options).format(waktu);

                const wrapper = document.createElement('div');
                wrapper.className = `flex items-end justify-end`;

                wrapper.innerHTML = `
                    <div class="flex items-center justify-center w-8 h-8 ml-2 text-sm font-bold text-white bg-gray-400 rounded-full select-none">
                        ${initial}
                    </div>
                    <div class="max-w-[70%] p-3 text-sm leading-snug shadow bg-[#083458] text-white rounded-3xl rounded-br-md">
                        <div class="mb-1 text-xs font-semibold">${senderName}</div>
                        <div>${data.chat.chat.replace(/\n/g, '<br>')}</div>
                        <div class="text-[10px] text-gray-400 text-right mt-1">
                            ${waktuFormatted}
                        </div>
                    </div>
                `;

                chatMessages.appendChild(wrapper);
                chatMessages.scrollTop = chatMessages.scrollHeight;
                chatInput.value = '';
            } else {
                alert('Gagal mengirim pesan');
            }
        } catch (err) {
            console.error('Error:', err);
            alert(err.message); // ini akan tampilkan pesan dari Laravel
        }

    });
});
</script>

@endsection
