<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use App\Models\Conversation;
use Illuminate\Http\Request;

class AdConversationController extends Controller
{
    public function showAdConversations($adId)
    {
        $ad = Ad::findOrFail($adId);

        $conversations = Conversation::where('ad_id', $adId)
            ->whereHas('users', function ($query) {
                $query->where('user_id', auth()->id());
            })
            ->with('users')
            ->get();
        // Return the conversations as a JSON response
        return response()->json($conversations);
    }
}
