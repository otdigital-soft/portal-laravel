<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\Conversation;
use App\Models\Ad;
use App\Events\NewMessage;

class MessageController extends Controller
{
    public function store(Request $request, Ad $ad)
    {
        $this->validate($request, [
            'content' => 'required'
        ]);

        // Get the conversation for this ad, or create a new one
        $conversation = Conversation::where('ad_id', $ad->id)->first();
        if (!$conversation) {
            $conversation = Conversation::create([
                'ad_id' => $ad->id,
            ]);
            $conversation->users()->attach($ad->user_id);
            $conversation->users()->attach($request->user()->id);
        }

        // Create the message
        $message = new Message;
        $message->content = $request->content;
        $message->user_id = $request->user()->id;

        // Save the message to the conversation
        $conversation->messages()->save($message);

        // Broadcast a new message event
        broadcast(new NewMessage($message));

        return redirect()->route('ads.conversations')->with('succes', 'Message sent');
    }

    public function index(Request $request, Ad $ad)
    {
        // Get the conversation for this ad, or return an error
        $conversation = Conversation::where('ad_id', $ad->id)->first();
        if (!$conversation) {
            return response()->json([
                'status' => 'error',
                'message' => 'No conversation found for this ad.'
            ], 404);
        }

        // Get all the messages for the conversation
        $messages = $conversation->messages()->with('user')->get();

        return response()->json([
            'status' => 'success',
            'data' => $messages
        ]);
    }
}
