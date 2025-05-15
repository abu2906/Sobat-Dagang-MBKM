<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ForumDiskusi;
use App\Events\ChatSent;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ForumDiskusiController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'chat' => 'required|string|max:1000',
        ]);

        $user = Auth::user();

        // Simpan chat
        $chat = ForumDiskusi::create([
            'chat' => $request->chat,
            'id_user' => $user->id_user,
            'waktu' => now(),
        ]);

        // Data untuk broadcast
        $time = Carbon::parse($chat->waktu)->timezone('Asia/Makassar')->format('H:i');
        broadcast(new ChatSent($chat->chat, $user->nama, $user->id_user, $time))->toOthers();

        // Response json
        return response()->json([
            'status' => 'success',
            'chat' => [
                'chat' => $chat->chat,
                'user' => $user->nama,
                'user_id' => $user->id_user,
                'waktu' => $chat->waktu,
            ]
        ]);
    }
}
