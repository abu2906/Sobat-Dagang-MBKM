<?php

namespace App\Http\Controllers;

use App\Models\ForumDiskusi;
use Illuminate\Http\Request;

class ForumDiskusiController extends Controller
{
    // Ensure that the user is authenticated before submitting a chat
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Store the chat message in the database
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'chat' => 'required|string|max:255', // You can adjust the max length based on your needs
        ]);

        // Create a new chat entry
        $chat = new ForumDiskusi();
        $chat->id_user = auth()->id(); // Use the authenticated user's ID
        $chat->id_disdag = 1; // Replace with the actual `id_disdag` logic if necessary
        $chat->chat = $request->chat;
        $chat->waktu = now(); // Store current timestamp
        $chat->save(); // Save the message

        // Return a response (JSON or redirect, depending on your need)
        return response()->json([
            'message' => 'Chat message sent successfully',
            'chat' => $chat
        ]);
    }

    // Add a method to load all chat messages if needed
    public function index()
    {
        $chats = ForumDiskusi::with('user')->orderBy('waktu', 'asc')->get();
        return view('component.chat', compact('chats'));
    }
}
