<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ForumDiskusi;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ForumDiskusiController extends Controller
{
    public function send(Request $request)
    {
        $request->validate([
            'chat' => 'required|string',
        ]);

        $user = Auth::guard('user')->user();
        $disdag = Auth::guard('disdag')->user();

        if ($user) {
            $id_user = $user->id_user;
            $id_disdag = null; // fixed ke admin disdag id=1
        } elseif ($disdag) {
            $id_disdag = $disdag->id_disdag;
            $id_user = $request->input('id_user'); // saat balasan
        } else {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $chat = ForumDiskusi::create([
            'id_user' => $id_user,
            'id_disdag' => $id_disdag,
            'chat' => $request->chat,
            'waktu' => Carbon::now(),
            'status' => 'terkirim'
        ]);

// load relasi supaya nama user/disdag bisa diakses di frontend
$chat->load('user', 'disdag');

return response()->json([
    'success' => true,
    'message' => 'Pesan terkirim',
    'chat' => $chat
], 200);


    }

public function getMessages()
{
    $user = Auth::guard('user')->user();
    $disdag = Auth::guard('disdag')->user();

    if ($user) {
        $messages = ForumDiskusi::with('user', 'disdag')
            ->where('id_user', $user->id_user)
            ->orderBy('waktu', 'asc')
            ->get();
    } elseif ($disdag) {
        $messages = ForumDiskusi::with('user', 'disdag')
            ->where('id_disdag', $disdag->id_disdag)
            ->orderBy('waktu', 'asc')
            ->get();
    } else {
        return response()->json(['message' => 'Unauthorized'], 401);
    }

    return response()->json(['data' => $messages]);
}

}
