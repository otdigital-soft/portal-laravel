<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\NewMessage;
use Illuminate\Support\Facades\Broadcast;

class SendNewMessageNotification
{
    use InteractsWithQueue;

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
    public function handle(NewMessage $event)
    {
        $message = $event->message;
        $user = $message->receiver;

        // Broadcast the event to a Pusher channel
        Broadcast::channel('private-messages.' . $user->id, function ($user) use ($message) {
            return [
                'id' => $message->id,
                'sender_id' => $message->sender->id,
                'sender_name' => $message->sender->name,
                'message' => $message->message,
                'created_at' => $message->created_at->toDateTimeString(),
            ];
        });
    }
}
