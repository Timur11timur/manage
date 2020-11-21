<?php

namespace App\Libraries;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;

class Trending
{
    public function get()
    {
        //return array_map('json_decode', Redis::zrevrange($this->cacheKey(), 0, 4));
        return Cache::get($this->cacheKey(), collect())
            ->sortByDesc('score')
            ->slice(0, 5)
            ->values();
    }

    public function push($thread, $increment = 1)
    {
//        Redis::zincrby($this->cacheKey(), 1, json_encode([
//            'title' => $thread->title,
//            'path' => $thread->path()
//        ]));
        $trending = Cache::get($this->cacheKey(), collect());

        $trending[$thread->id] = (object) [
            'score' => $this->score($thread) + $increment,
            'title' => $thread->title,
            'path' => $thread->path(),
        ];

        Cache::forever($this->cacheKey(), $trending);
    }

    public function score($thread)
    {
        $trending = Cache::get($this->cacheKey(), collect());

        if (! isset($trending[$thread->id])) {
            return 0;
        }

        return $trending[$thread->id]->score;
    }

    public function reset()
    {
        //Redis::del($this->cacheKey());
        return Cache::forget($this->cacheKey());
    }

    private function cacheKey()
    {
        //return app()->environment('testing') ? 'testing_trending_threads' : 'trending_threads';
        return 'trending_threads';
    }
}
