<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class ChatSent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $chat;
    public $user;
    public $user_id;
    public $time;

    /**
     * Create a new event instance.
     */
    public function __construct($chat, $user, $user_id, $time)
    {
        $this->chat = $chat;
        $this->user = $user;
        $this->user_id = $user_id;
        $this->time = $time;
    }

    /**
     * Get the channels the event should broadcast on.
     */
    public function broadcastOn()
    {
        return new Channel('forum-diskusi');
    }

    public function broadcastAs()
    {
        return 'ChatSent';
    }
}
