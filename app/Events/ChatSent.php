<?php

namespace App\Events;

use App\Models\ForumDiskusi;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ChatSent implements ShouldBroadcast
{
    use InteractsWithSockets, SerializesModels;

    public $chat;

    public function __construct(ForumDiskusi $chat)
    {
        $this->chat = $chat;
    }

    public function broadcastOn()
    {
        return new Channel('forum-chat');
    }

    public function broadcastWith()
    {
        return [
            'id' => $this->chat->id,
            'user' => $this->chat->user->name ?? $this->chat->guest_name,
            'chat' => nl2br(e($this->chat->chat)),
            'time' => $this->chat->created_at->timezone('Asia/Makassar')->format('H:i')
        ];
    }
}
