<?php

namespace App\Http\Controllers;

use App\Libraries\Trending;
use App\Thread;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function show(Trending $trending)
    {
        if (request()->expectsJson()) {
            return Thread::search(request('q'))->paginate(25);
        }

        return view('thread.search', [
            'trendings' => $trending->get()
        ]);
    }
}
