<?php

namespace App\Models;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Topic extends DefaultModel
{
    use HasSlug;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'name',
        'slug',
        'background',
    ];
    
    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    public function joinedUsers()
    {
        return $this->hasMany('App\Models\UserJoinedTopic');
    }
    
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
