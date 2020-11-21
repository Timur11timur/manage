<?php

namespace App\Http\Controllers;

use App\Thread;

class LockThreadController extends Controller
{
    public function store(Thread $thread)
    {
        $thread->update(['locked' => true]);
    }

    public function destroy(Thread $thread)
    {
        $thread->update(['locked' => false]);
    }
}
