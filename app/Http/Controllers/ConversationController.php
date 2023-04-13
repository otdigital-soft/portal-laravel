<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use Illuminate\Http\Request;

class ConversationController extends Controller
{
    public function index(Request $request, Conversation $conversation)
    {
        // Check that the user is a participant in the conversation
        if (!$conversation->users->contains($request->user())) {
            return response()->json([
                'status' => 'error',
                'message' => 'You are not a participant in this conversation.'
            ], 403);
        }

        // Get all the messages for the conversation
        // $messages = $conversation->messages()->with('user')->get(); Slower
        $messages = $conversation->load('messages.user'); //Faster.

        // Mark unread messages as read for the current user
        $conversation->markMessagesAsRead(auth()->user());

        return response()->json([
            'status' => 'success',
            'data' => $messages
        ]);
    }
}
