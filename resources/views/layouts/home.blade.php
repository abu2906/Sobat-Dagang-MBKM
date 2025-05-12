<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sobat Dagang')</title>
    <link rel="stylesheet" href="{{ asset('/assets/css/app.css') }}">
    <link rel="icon" href="{{ asset('assets/img/icon/logoIcon.png') }}" type="image/png">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    @php
    use Illuminate\Support\Facades\Auth;
    @endphp

    @if (!Auth::guard('user')->check())
    @include('component.navbar.guest')
    @elseif (Auth::guard('user')->check() && Auth::guard('user')->user()->role === 'admin')
    @include('component.navbar.admin')
    @elseif (Auth::guard('user')->check() && Auth::guard('user')->user()->role === 'user')
    @include('component.navbar.user')
    @elseif (Auth::guard('user')->check() && Auth::guard('user')->user()->role === 'guest')
    @include('component.navbar.guest')
    @endif

    <main>
        @yield('content')
    </main>

    @include('component.footer')
    <script src="{{ asset('/assets/js/app.js') }}"></script>
</body>
<!-- Chat Modal -->
<div id="chat-modal" class="hidden fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-lg w-full max-w-md flex flex-col h-[80%] relative">
        <!-- Header -->
        <div class="bg-green-600 p-4 text-white flex justify-between items-center">
            <h2 class="font-bold text-lg">Forum Pengaduan Umum</h2>
            <button id="close-chat" class="text-white text-2xl leading-none">&times;</button>
        </div>

        <!-- Chat Box -->
        <div id="chat-box" class="flex-1 overflow-y-auto p-4 space-y-2 bg-gray-100">
            @foreach($chats as $pesan)
                <div class="flex {{ $pesan->id_user == auth()->id() ? 'justify-end' : 'justify-start' }}">
                    <div class="max-w-xs rounded-lg p-3 {{ $pesan->id_user == auth()->id() ? 'bg-green-500 text-white' : 'bg-white text-gray-900' }}">
                        <div class="text-sm font-semibold">
                            {{ $pesan->user->name ?? $pesan->guest_name ?? 'Guest' }}
                        </div>
                        <div>{!! nl2br(e($pesan->chat)) !!}</div>
                        <div class="text-xs text-gray-300 text-right mt-1">{{ $pesan->created_at->format('H:i') }}</div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Input -->
        <div class="p-4 flex gap-2">
            <input type="text" id="chat-input" placeholder="Ketik pesan..." class="flex-1 border rounded-full p-2 focus:outline-none focus:ring-2 focus:ring-green-500">
            <button class="bg-green-500 text-white px-4 rounded-full" id="send-btn">Kirim</button>
        </div>
    </div>
</div>

<script>
    function scrollBottom() {
        const chatBox = document.getElementById('chat-box');
        chatBox.scrollTop = chatBox.scrollHeight;
    }
    scrollBottom();

    Echo.channel('forum')
        .listen('.chat.sent', (e) => {
            $('#chat-box').append(`
                <div class="flex ${e.chat.id_user == '{{ auth()->id() }}' ? 'justify-end' : 'justify-start'}">
                    <div class="max-w-xs rounded-lg p-3 ${e.chat.id_user == '{{ auth()->id() }}' ? 'bg-green-500 text-white' : 'bg-white text-gray-900'}">
                        <div class="text-sm font-semibold">${e.chat.user?.name ?? e.chat.guest_name ?? 'Guest'}</div>
                        <div>${e.chat.chat.replace(/\n/g, '<br>')}</div>
                        <div class="text-xs text-gray-300 text-right mt-1">Baru</div>
                    </div>
                </div>
            `);
            scrollBottom();
        });

    $('#send-btn').on('click', function(){
        $.post('/forum', {
            '_token': '{{ csrf_token() }}',
            'chat': $('#chat-input').val()
        }, function(){
            $('#chat-input').val('');
        });
    });

    $('#chat-input').on('keypress', function(e){
        if(e.which === 13 && !e.shiftKey){
            e.preventDefault();
            $('#send-btn').click();
        }
    });

    // Modal Controls
    $('#open-chat').on('click', function(){
        $('#chat-modal').removeClass('hidden');
        scrollBottom();
    });

    $('#close-chat').on('click', function(){
        $('#chat-modal').addClass('hidden');
    });
</script>
</html>