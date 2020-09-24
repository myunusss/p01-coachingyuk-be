<?php

namespace App\Models;

class UserJoinedTopic extends DefaultModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'topic_id',
    ];
    
    public function topic()
    {
        return $this->belongsTo('App\Models\Topic');
    }
    
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
