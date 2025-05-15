// document.addEventListener('DOMContentLoaded', function() {
//     function scrollBottom() {
//         const chatBox = document.getElementById('chat-box');
//         if (chatBox) chatBox.scrollTop = chatBox.scrollHeight;
//     }

//     const openChat = document.getElementById('open-chat');
//     const closeChat = document.getElementById('close-chat');
//     const chatModal = document.getElementById('chat-modal');
//     const sendBtn = document.getElementById('send-btn');
//     const chatInput = document.getElementById('chat-input');

//     if (openChat && closeChat && chatModal) {
//         openChat.addEventListener('click', function() {
//             chatModal.classList.remove('hidden');
//             scrollBottom();
//         });

//         closeChat.addEventListener('click', function() {
//             chatModal.classList.add('hidden');
//         });
//     }

//     if (sendBtn) {
//         sendBtn.addEventListener('click', function() {
//             if (chatInput.value.trim() !== '') {
//                 fetch('/forum-diskusi', {
//                     method: 'POST',
//                     headers: {
//                         'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
//                         'Content-Type': 'application/json',
//                     },
//                     body: JSON.stringify({ chat: chatInput.value })
//                 }).then(() => {
//                     chatInput.value = '';
//                 });
//             }
//         });
//     }

//     if (typeof Echo !== 'undefined') {
//         Echo.channel('forum-diskusi')
//             .listen('ChatSent', (e) => {
//                 const chatBox = document.getElementById('chat-box');
//                 const div = document.createElement('div');
//                 div.className = 'flex justify-start';
//                 div.innerHTML = `
//                     <div class="max-w-[75%] p-3 bg-white text-gray-900 rounded-3xl rounded-bl-md border">
//                         <div class="text-xs font-semibold mb-1">${e.user}</div>
//                         <div class="text-sm break-words">${e.chat}</div>
//                         <div class="text-[10px] text-gray-300 text-right mt-1">${e.time}</div>
//                     </div>
//                 `;
//                 chatBox.appendChild(div);
//                 scrollBottom();
//             });
//     }
// });
document.addEventListener('DOMContentLoaded', function() {
    console.log('JS Loaded!');

    const openChat = document.getElementById('open-chat');
    const closeChat = document.getElementById('close-chat');
    const chatModal = document.getElementById('chat-modal');

    if (openChat) {
        openChat.addEventListener('click', function() {
            console.log('Open Chat Clicked');
            chatModal.classList.remove('hidden');
        });
    }

    if (closeChat) {
        closeChat.addEventListener('click', function() {
            console.log('Close Chat Clicked');
            chatModal.classList.add('hidden');
        });
    }
});
