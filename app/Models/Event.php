<?php

namespace App\Models;

class Event extends DefaultModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'coach_id',
        'name',
        'date',
        'location',
        'is_online',
        'is_free',
        'price',
    ];
    
    public function coach()
    {
        return $this->belongsTo('App\Models\User', 'coach_id');
    }
}
