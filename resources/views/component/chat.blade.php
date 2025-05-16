<div id="chat-modal" class="hidden fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-[9999]">
<<<<<<< HEAD
  <div class="bg-white rounded-3xl shadow-lg w-full max-w-md h-[85%] flex flex-col relative">

    <div class="bg-[#083458] p-4 text-white flex justify-between items-center rounded-t-3xl">
      <h2 class="font-bold text-lg">Forum Pengaduan</h2>
      <button id="close-chat" class="text-white text-2xl leading-none">&times;</button>
    </div>

    <div id="chat-messages" class="flex-1 overflow-y-auto p-4 space-y-2 bg-gray-50 flex flex-col" style="scrollbar-width:none; -ms-overflow-style:none;">
        @php $currentUserId = auth()->id(); @endphp

        @foreach($chats->sortByDesc('waktu') as $chat)
            @php
                $isMe = $chat->id_user === $currentUserId;
                $senderName = $chat->user->nama ?? 'Admin Dinas Perdagangan';
                $initial = strtoupper(substr($senderName, 0, 1));
            @endphp

            <div class="flex items-end {{ $isMe ? 'justify-end' : 'justify-start' }}">
                @if (!$isMe)
                    <div class="w-8 h-8 mr-2 rounded-full bg-[#083458] text-white flex items-center justify-center text-sm font-bold select-none">
                        {{ $initial }}
                    </div>
                @endif

                <div class="max-w-[70%] p-3 text-sm leading-snug shadow
                    {{ $isMe ? 'bg-[#083458] text-white rounded-3xl rounded-br-md' : 'bg-white text-gray-900 rounded-3xl rounded-bl-md border' }}">
                    <div class="text-xs font-semibold mb-1">{{ $senderName }}</div>
                    <div>{!! nl2br(e($chat->chat)) !!}</div>
                    <div class="text-[10px] text-gray-400 text-right mt-1">
                        {{ \Carbon\Carbon::parse($chat->waktu)->setTimezone('Asia/Makassar')->format('H:i') }}
=======
    <div class="bg-white rounded-3xl shadow-2xl w-full max-w-md h-[85%] flex flex-col relative">
        <div class="bg-[#083458] p-4 text-white flex justify-between items-center rounded-t-3xl">
            <h2 class="font-bold text-lg">Forum Pengaduan Umum</h2>
            <button id="close-chat" class="text-white text-2xl leading-none">&times;</button>
        </div>

        <!-- Chat Box -->
        <div id="chat-box" class="flex-1 overflow-y-auto p-4 space-y-4 bg-gray-50">
            @foreach($chats as $pesan)
                <div class="flex {{ ($pesan->id_user == auth()->user()->id_user) || ($pesan->id_disdag == auth()->user()->id_disdag) ? 'justify-end' : 'justify-start' }}">
                    <div class="max-w-[75%] p-3 {{ ($pesan->id_user == auth()->user()->id_user) || ($pesan->id_disdag == auth()->user()->id_disdag) ? 'bg-[#083458] text-white rounded-3xl rounded-br-md' : 'bg-white text-gray-900 rounded-3xl rounded-bl-md border' }}">
                        <div class="text-xs font-semibold mb-1">
                            {{ $pesan->user->nama ?? $pesan->disdag->email ?? 'Master Admin' }}
                        </div>
                        <div class="text-sm break-words">{!! nl2br(e($pesan->chat)) !!}</div>
                        <div class="text-[10px] text-right mt-1 text-gray-300">
                            {{ \Carbon\Carbon::parse($pesan->waktu)->timezone('Asia/Makassar')->format('H:i') }}
                        </div>
>>>>>>> origin/Robert-Database
                    </div>
                </div>

<<<<<<< HEAD
                @if ($isMe)
                    <div class="w-8 h-8 ml-2 rounded-full bg-gray-400 text-white flex items-center justify-center text-sm font-bold select-none">
                        {{ strtoupper(substr(auth()->user()->nama ?? 'U', 0, 1)) }}
                    </div>
                @endif
            </div>
        @endforeach
=======
        <!-- Chat Input -->
        <div class="p-4 flex gap-2 border-t bg-white rounded-b-3xl">
            <input type="text" id="chat-input" placeholder="Ketik pesan..." class="flex-1 border rounded-full p-3 focus:ring-2 focus:ring-[#083458]" autocomplete="off">
            <button id="send-btn" class="bg-[#083458] text-white px-6 py-2 rounded-full">Kirim</button>
        </div>
>>>>>>> origin/Robert-Database
    </div>

    <style>
        #chat-messages::-webkit-scrollbar {
            display: none;
        }
        #chat-messages {
            scrollbar-width: none;
            -ms-overflow-style: none;
        }
    </style>

    <script>
      document.addEventListener('DOMContentLoaded', () => {
        const chatMessages = document.getElementById('chat-messages');
        if (chatMessages) {
          chatMessages.scrollTop = chatMessages.scrollHeight;
        }
      });
    </script>

    <div class="p-4 border-t bg-white rounded-b-3xl">
      <form id="chat-form" class="flex gap-2" autocomplete="off">
        <input type="text" id="chat-input" placeholder="Ketik pesan..." class="flex-1 border rounded-full px-4 py-2 text-sm focus:ring-2 focus:ring-[#083458]" />
        <button type="submit" class="bg-[#083458] text-white px-5 py-2 rounded-full hover:bg-[#065078] transition">Kirim</button>
      </form>
    </div>

  </div>
</div>
<<<<<<< HEAD
=======

<script src="https://js.pusher.com/7.2/pusher.min.js"></script>
<script src="https://unpkg.com/laravel-echo/dist/echo.iife.js"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const sendButton = document.getElementById("send-btn");
    const chatInput = document.getElementById("chat-input");
    const chatBox = document.getElementById("chat-box");

    function scrollToBottom() {
        chatBox.scrollTop = chatBox.scrollHeight;
    }

    scrollToBottom();

    sendButton.addEventListener("click", function () {
        const chatText = chatInput.value.trim();
        if (chatText === "") {
            alert("Pesan tidak boleh kosong!");
            return;
        }

        fetch("{{ route('forum.store') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify({ chat: chatText })
        })
        .then(response => {
            if (!response.ok) throw new Error("Gagal mengirim pesan.");
            return response.json();
        })
        .then(data => {
            // Kosongkan input, chat baru akan muncul dari event Echo realtime
            chatInput.value = "";
            scrollToBottom();
        })
        .catch(error => {
            console.error("Error:", error);
            alert("Terjadi kesalahan saat mengirim pesan.");
        });
    });

    document.getElementById("close-chat").addEventListener("click", () => {
        document.getElementById("chat-modal").classList.add("hidden");
    });

    // Inisialisasi Pusher & Laravel Echo untuk realtime update
    window.Pusher = Pusher;

    window.Echo = new Echo({
        broadcaster: 'pusher',
        key: '{{ env("PUSHER_APP_KEY") }}',
        cluster: '{{ env("PUSHER_APP_CLUSTER") }}',
        forceTLS: true
    });

    window.Echo.channel('forum-diskusi')
        .listen('ChatSent', (e) => {
            const isSender = e.user_id === {{ auth()->id() }};

            const newMessage = document.createElement("div");
            newMessage.className = `flex ${isSender ? 'justify-end' : 'justify-start'}`;
            newMessage.innerHTML = `
                <div class="max-w-[75%] p-3 ${isSender ? 'bg-[#083458] text-white rounded-3xl rounded-br-md' : 'bg-white text-gray-900 rounded-3xl rounded-bl-md border'}">
                    <div class="text-xs font-semibold mb-1">${e.user}</div>
                    <div class="text-sm break-words">${e.chat}</div>
                    <div class="text-[10px] text-right mt-1 text-gray-300">${e.time}</div>
                </div>
            `;
            chatBox.appendChild(newMessage);
            scrollToBottom();
        });
});
</script>
>>>>>>> origin/Robert-Database
