<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Message;

class NavigationComposer
{
    public function compose(View $view)
    {
        if (Auth::check()) {
            $pendingReferrals = Auth::user()->children()->where('status', 'pending')->count();
            // dd($unreadCount);
            // return $unreadCount;
            $view->with('pendingReferrals', $pendingReferrals);
        }
    }
}
