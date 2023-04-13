<?php

namespace App\Listeners;

use App\Events\NewUserReferred;
use App\Notifications\ReferralApprovalReminder;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendEmailApprovalReminder
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(NewUserReferred $event)
    {
        $event->referrer->notify(new ReferralApprovalReminder($event->user, $event->referrer));
    }
}
