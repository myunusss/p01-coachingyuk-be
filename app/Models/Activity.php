<?php

namespace App\Models;

class Activity extends DefaultModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'topic_id',
        'content',
        'note',
    ];

    public function activityReplies()
    {
        return $this->hasMany('App\Models\ActivityReply');
    }

    public function likedUsers()
    {
        return $this->belongsToMany(
            'App\Models\User',
            'user_liked_activities'
        )
        ->whereNull('user_liked_activities.deleted_at')
        ->withTimestamps();
    }
    
    public function topic()
    {
        return $this->belongsTo('App\Models\Topic');
    }
    
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
