<?php

namespace App\Models;

class Category extends DefaultModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'name',
        'background',
    ];
    
    public function topics()
    {
        return $this->hasMany('App\Models\Topic');
    }
    
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
