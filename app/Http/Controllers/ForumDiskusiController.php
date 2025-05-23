<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ForumDiskusi;
use Illuminate\Support\Facades\Auth;

class ForumDiskusiController extends Controller
{
    public function index()
    {
        $chats = ForumDiskusi::with('user')->orderBy('waktu', 'asc')->get();
        return view('user.forum', compact('chats'));
    }

    public function kirimPesan(Request $request)
{
    $request->validate(['chat' => 'required|string']);

    $chat = \App\Models\ForumDiskusi::create([
        'id_user' => Auth::guard('user')->id(),
        'chat' => $request->chat,
        'waktu' => now(),
    ]);

    return response()->json([
        'success' => true,
        'chat' => $chat->load('user'),
    ]);
}
public function ambilPesan()
{
    $chats = \App\Models\ForumDiskusi::with('user', 'disdag')->orderBy('waktu')->get();

    return response()->json($chats);
}

}