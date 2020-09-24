<?php

namespace App\Models;

class Reply extends DefaultModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'answer_id',
        'content',
    ];
    
    public function answer()
    {
        return $this->belongsTo('App\Models\Answer');
    }
    
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
