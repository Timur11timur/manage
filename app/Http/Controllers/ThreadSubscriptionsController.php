<?php

namespace App\Http\Controllers;

use App\Thread;

class ThreadSubscriptionsController extends Controller
{
    public function store($chanelId, Thread $thread)
    {
        $thread->subscribe();
    }

    public function destroy($chanelId, Thread $thread)
    {
        $thread->unsubscribe();
    }
}
