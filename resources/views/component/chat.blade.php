<div id="chat-modal" class="hidden fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-[9999]">
    <div class="bg-white rounded-3xl shadow-2xl w-full max-w-md md:max-w-lg h-[85%] flex flex-col relative border border-gray-200">
        <!-- Header -->
        <div class="bg-[#083458] p-4 text-white flex justify-between items-center rounded-t-3xl shadow-md">
            <h2 class="font-bold text-lg">Forum Pengaduan Umum</h2>
            <button id="close-chat" class="text-white text-2xl leading-none hover:scale-110 transition">&times;</button>
        </div>

        <!-- Chat Box -->
        <div id="chat-box" class="flex-1 overflow-y-auto p-4 space-y-4 bg-gray-50">
            @foreach($chats ?? [] as $pesan)
                <div class="flex {{ $pesan->id_user == auth()->id() ? 'justify-end' : 'justify-start' }}">
                    <div class="max-w-[75%] p-3 shadow 
                        {{ $pesan->id_user == auth()->id() 
                            ? 'bg-[#083458] text-white rounded-3xl rounded-br-md' 
                            : 'bg-white text-gray-900 rounded-3xl rounded-bl-md border border-gray-200' 
                        }}">
                        <div class="text-xs font-semibold mb-1 opacity-80">
                            {{ $pesan->user->name ?? $pesan->guest_name ?? 'Guest' }}
                        </div>
                        <div class="text-sm leading-relaxed break-words">{!! nl2br(e($pesan->chat)) !!}</div>
                        <div class="text-[10px] text-gray-300 text-right mt-1" id="time-{{ $pesan->id }}">
                            <!-- Waktu yang akan ditampilkan setelah konversi -->
                            <span>{{ \Carbon\Carbon::parse($pesan->created_at)->timezone('Asia/Makassar')->format('H:i') }}</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Form Input -->
        <div class="p-4 flex gap-2 border-t bg-white rounded-b-3xl">
            <input type="text" id="chat-input" placeholder="Ketik pesan..." class="flex-1 border border-gray-300 rounded-full p-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#083458] focus:border-[#083458] shadow-sm">
            <button class="bg-[#083458] hover:bg-[#062b45] text-white px-6 py-2 rounded-full shadow-md hover:scale-105 transition" id="send-btn">Kirim</button>
        </div>
    </div>
</div>

<script>
    // Fungsi untuk scroll ke bawah di chat box
    function scrollBottom() {
        const chatBox = document.getElementById('chat-box');
        chatBox.scrollTop = chatBox.scrollHeight;
    }

    // Menangani klik untuk membuka modal chat
    document.getElementById('open-chat').addEventListener('click', function() {
        const modal = document.getElementById('chat-modal');
        modal.classList.remove('hidden');
        scrollBottom();
        sessionStorage.setItem('modalOpen', 'true');
    });

    // Menangani klik untuk menutup modal chat
    document.getElementById('close-chat').addEventListener('click', function() {
        const modal = document.getElementById('chat-modal');
        modal.classList.add('hidden');
        sessionStorage.setItem('modalOpen', 'false');
    });

    // Menangani klik tombol kirim
    document.getElementById('send-btn').addEventListener('click', function() {
        const chatInput = document.getElementById('chat-input');
        if (chatInput.value.trim() !== '') {
            fetch('/forum', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ chat: chatInput.value })
            }).then(() => {
                chatInput.value = '';
                location.reload();
            });
        }
    });

    // Menangani pengiriman pesan dengan menekan Enter (tanpa shift)
    document.getElementById('chat-input').addEventListener('keypress', function(e) {
        if (e.which === 13 && !e.shiftKey) {
            e.preventDefault();
            document.getElementById('send-btn').click();
        }
    });

    // Cek jika modal harus dibuka setelah reload
    window.onload = function() {
        if (sessionStorage.getItem('modalOpen') === 'true') {
            const modal = document.getElementById('chat-modal');
            modal.classList.remove('hidden');
            scrollBottom();
        }
    };
</script>
