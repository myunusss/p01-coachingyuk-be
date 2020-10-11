<?php

namespace App\Models;

class UserLikedActivity extends DefaultModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'activity_id',
    ];
    
    public function activity()
    {
        return $this->belongsTo('App\Models\Activity');
    }
    
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
