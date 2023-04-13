<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Message;

class SidebarComposer
{
    public function compose(View $view)
    {
        if (Auth::check()) {
            $unreadCount = Auth::user()->conversations()->whereHas('messages', function ($query) {
                $query->whereNull('read_at')->where('user_id', '!=', Auth::user()->id);
            })->count();
            // dd($unreadCount);
            // return $unreadCount;
            $view->with('unreadCount', $unreadCount);
        }
    }
}
