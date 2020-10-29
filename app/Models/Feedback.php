<?php

namespace App\Models;

class Feedback extends DefaultModel
{
    protected $table = 'feedbacks';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'type',
        'content',
        'email',
    ];
    
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
