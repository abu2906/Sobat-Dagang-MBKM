<?php

namespace App\Events;

use App\Models\ForumDiskusi;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ChatSent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $chat;
    public $user;

    public function __construct(ForumDiskusi $chat)
    {
        $this->chat = $chat;
        $this->user = $chat->user->name; // Pastikan ada relasi user pada ForumDiskusi
    }

    public function broadcastOn()
    {
        return new Channel('forum-diskusi');
    }

    public function broadcastWith()
    {
        return [
            'chat' => $this->chat->chat,
            'user' => $this->user,
            'time' => $this->chat->waktu->format('H:i')
        ];
    }
}
