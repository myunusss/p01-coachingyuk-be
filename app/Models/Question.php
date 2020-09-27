<?php

namespace App\Models;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Question extends DefaultModel
{
    use HasSlug;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'topic_id',
        'slug',
        'content',
    ];
    
    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('content')
            ->saveSlugsTo('slug');
    }
    
    public function answers()
    {
        return $this->hasMany('App\Models\Answer');
    }

    public function followingUsers()
    {
        return $this->hasMany('App\Models\UserFollowedQuestion');
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
