<?php

namespace App\Listeners;

use App\Event\ThreadReceivedNewReply;
use App\Notifications\YouWereMentioned;
use App\User;

class NotifyMentionedUser
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
     * @param ThreadReceivedNewReply $event
     * @return void
     */
    public function handle(ThreadReceivedNewReply $event)
    {
        User::whereIn('name', $event->reply->mentionedUsers())->get()
            ->each(function ($user) use ($event) {
                $user->notify(new YouWereMentioned($event->reply));
            });

        //or
//        $mentionedUsers = $event->reply->mentionedUsers();
//
//        foreach ($mentionedUsers as $name) {
//            $user = User::whereName($name)->first();
//
//            if ($user) {
//                $user->notify(new YouWereMentioned($event->reply));
//            }
//        }
    }
}
