<?php

namespace App\Models;

class UserFollowCoach extends DefaultModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'coach_id'
    ];
    
    public function coach()
    {
        return $this->belongsTo('App\Models\User', 'coach_id');
    }
    
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
