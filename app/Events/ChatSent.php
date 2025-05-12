<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\ForumDiskusi;

class ChatSent implements ShouldBroadcast
{
    use Dispatchable, SerializesModels;

    public $chat;

    public function __construct(ForumDiskusi $chat)
    {
        $this->chat = $chat;
    }

    public function broadcastOn()
    {
        return new Channel('forum-diskusi');
    }

    public function broadcastWith()
    {
        return [
            'id' => $this->chat->id,
            'user' => $this->chat->user->name ?? $this->chat->guest_name ?? 'Guest',
            'chat' => $this->chat->chat,
            'time' => $this->chat->created_at->format('H:i')
        ];
    }}