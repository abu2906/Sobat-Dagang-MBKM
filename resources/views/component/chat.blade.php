<!-- Chat Modal -->
<div id="chat-modal" class="hidden fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-[9999]">
    <div class="bg-white rounded-3xl shadow-2xl w-full max-w-md h-[85%] flex flex-col relative">
        <div class="bg-[#083458] p-4 text-white flex justify-between items-center rounded-t-3xl">
            <h2 class="font-bold text-lg">Forum Pengaduan Umum</h2>
            <button id="close-chat" class="text-white text-2xl leading-none">&times;</button>
        </div>

        <!-- Chat Box -->
        <div id="chat-box" class="flex-1 overflow-y-auto p-4 space-y-4 bg-gray-50">
            @foreach($chats as $pesan)
                <div class="flex {{ $pesan->id_user == auth()->id() || $pesan->id_disdag == auth()->id() ? 'justify-end' : 'justify-start' }}">
                    <div class="max-w-[75%] p-3 {{ $pesan->id_user == auth()->id() || $pesan->id_disdag == auth()->id() ? 'bg-[#083458] text-white rounded-3xl rounded-br-md' : 'bg-white text-gray-900 rounded-3xl rounded-bl-md border' }}">
                        <div class="text-xs font-semibold mb-1">
                            {{ $pesan->user->name ?? 'Master Admin' }}
                        </div>
                        <div class="text-sm break-words">{!! nl2br(e($pesan->chat)) !!}</div>
                        <div class="text-[10px] text-right mt-1 text-gray-300">
                            {{ \Carbon\Carbon::parse($pesan->waktu)->timezone('Asia/Makassar')->format('H:i') }}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Chat Input -->
        <div class="p-4 flex gap-2 border-t bg-white rounded-b-3xl">
            <input type="text" id="chat-input" placeholder="Ketik pesan..." class="flex-1 border rounded-full p-3 focus:ring-2 focus:ring-[#083458]">
            <button id="send-btn" class="bg-[#083458] text-white px-6 py-2 rounded-full">Kirim</button>
        </div>
    </div>
</div>

<!-- Include JS -->
<script src="https://js.pusher.com/7.2/pusher.min.js"></script>
<script>
    function scrollBottom() {
        const chatBox = document.getElementById('chat-box');
        chatBox.scrollTop = chatBox.scrollHeight;
    }

    // Open and close the chat modal
    document.getElementById('open-chat').addEventListener('click', function () {
        document.getElementById('chat-modal').classList.remove('hidden');
        scrollBottom();
    });

    document.getElementById('close-chat').addEventListener('click', function () {
        document.getElementById('chat-modal').classList.add('hidden');
    });

    // Send the chat message
    document.getElementById('send-btn').addEventListener('click', function () {
        const chatInput = document.getElementById('chat-input');
        if (chatInput.value.trim() !== '') {
            fetch('{{ route('forum.store') }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ chat: chatInput.value })
            })
            .then(response => response.json())
            .then(data => {
                console.log(data); // Log response for debugging
                chatInput.value = ''; // Clear the input
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }
    });

    // Listen for new messages via Pusher (or any real-time service you use)
    Echo.channel('forum-diskusi')
        .listen('ChatSent', (e) => {
            const chatBox = document.getElementById('chat-box');
            const div = document.createElement('div');
            div.className = 'flex justify-start';
            div.innerHTML = `
                <div class="max-w-[75%] p-3 bg-white text-gray-900 rounded-3xl rounded-bl-md border">
                    <div class="text-xs font-semibold mb-1">${e.user}</div>
                    <div class="text-sm break-words">${e.chat}</div>
                    <div class="text-[10px] text-gray-300 text-right mt-1">${e.time}</div>
                </div>
            `;
            chatBox.appendChild(div);
            scrollBottom();
        });
</script>
