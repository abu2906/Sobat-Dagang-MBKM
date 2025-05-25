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

        // Cek siapa yang sedang login
        if (Auth::guard('user')->check()) {
            // User login
            $chat = \App\Models\ForumDiskusi::create([
                'id_user' => Auth::guard('user')->id(),
                'id_disdag' => null,
                'chat' => $request->chat,
                'waktu' => now(),
                'status' => 'user',
            ]);
        } elseif (Auth::guard('disdag')->check()) {
            // Admin Disdag login
            $chat = \App\Models\ForumDiskusi::create([
                'id_user' => null,
                'id_disdag' => Auth::guard('disdag')->id(),
                'chat' => $request->chat,
                'waktu' => now(),
                'status' => 'disdag',
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized',
            ], 401);
        }

        return response()->json([
            'success' => true,
            'chat' => $chat->load('user', 'disdag'),
        ]);
    }

    public function ambilPesan()
    {
        $chats = \App\Models\ForumDiskusi::with('user', 'disdag')->orderBy('waktu')->get();

        return response()->json($chats);
    }

}