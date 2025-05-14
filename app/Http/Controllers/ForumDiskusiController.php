<?php

namespace App\Http\Controllers;

use App\Models\ForumDiskusi;
use Illuminate\Http\Request;
use App\Events\ChatSent;

class ForumDiskusiController extends Controller
{
    public function store(Request $request)
{
    $request->validate([
        'chat' => 'required'
    ]);

    $chat = ForumDiskusi::create([
        // 'id_user' => auth()->check() ? auth()->id() : null,
        // 'guest_name' => !$request->user() ? $request->guest_name : null,
        // 'chat' => $request->chat
        'id_user' => null,
        'guest_name' => $request->input('guest_name') ?? 'Guest User',
        'guest_email' => $request->input('guest_email') ?? 'guest@example.com',
        'chat' => $request->chat
    ]);

    broadcast(new ChatSent($chat->load('user')))->toOthers();

    return response()->json(['success' => true]);
}


  
}
