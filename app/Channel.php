<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    protected $guarded = [];

    protected $casts = [
        'archived' => 'boolean'
    ];

    //Overwrite route model binding
    //Object of this class will be created from slug (not id)
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function threads()
    {
        return $this->hasMany(Thread::class);
    }

    public function archive()
    {
        $this->update(['archived' => true]);

        return $this;
    }
}
