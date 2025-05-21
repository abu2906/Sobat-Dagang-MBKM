<div id="chat-modal" class="hidden fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-[9999]">
  <div class="bg-white rounded-3xl shadow-lg w-full max-w-md h-[85%] flex flex-col relative">

    <div class="bg-[#083458] p-4 text-white flex justify-between items-center rounded-t-3xl">
      <h2 class="text-lg font-bold">Forum Pengaduan</h2>
      <button id="close-chat" class="text-2xl leading-none text-white">&times;</button>
    </div>

    <div id="chat-messages" class="flex flex-col flex-1 p-4 space-y-2 overflow-y-auto bg-gray-50" style="scrollbar-width:none; -ms-overflow-style:none;">
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
                    <div class="mb-1 text-xs font-semibold">{{ $senderName }}</div>
                    <div>{!! nl2br(e($chat->chat)) !!}</div>
                    <div class="text-[10px] text-gray-400 text-right mt-1">
                        {{ \Carbon\Carbon::parse($chat->waktu)->setTimezone('Asia/Makassar')->format('H:i') }}
                    </div>
                </div>

                @if ($isMe)
                    <div class="flex items-center justify-center w-8 h-8 ml-2 text-sm font-bold text-white bg-gray-400 rounded-full select-none">
                        {{ strtoupper(substr(auth()->user()->nama ?? 'U', 0, 1)) }}
                    </div>
                @endif
            </div>
        @endforeach
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

    <div class="p-4 bg-white border-t rounded-b-3xl">
      <form id="chat-form" class="flex gap-2" autocomplete="off">
        <input type="text" id="chat-input" placeholder="Ketik pesan..." class="flex-1 border rounded-full px-4 py-2 text-sm focus:ring-2 focus:ring-[#083458]" />
        <button type="submit" class="bg-[#083458] text-white px-5 py-2 rounded-full hover:bg-[#065078] transition">Kirim</button>
      </form>
    </div>

  </div>
</div>
