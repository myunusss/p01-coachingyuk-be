<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;


/**
 * @OA\Schema(
 *   schema="Answer",
 *   @OA\Property(
 *     property="id",
 *     type="int"
 *   ),
 *   @OA\Property(
 *     property="user_id",
 *     type="int"
 *   ),
 *   @OA\Property(
 *     property="question_id",
 *     type="int"
 *   ),
 *   @OA\Property(
 *     property="slug",
 *     type="string"
 *   ),
 *   @OA\Property(
 *     property="content",
 *     type="string"
 *   )
 * )
 */
class Answer extends Model
{
    use SoftDeletes;
    use HasSlug;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'question_id',
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

    public function helpedUsers()
    {
        return $this->hasMany('App\Models\UserHelpfulAnswer');
    }
    
    public function question()
    {
        return $this->belongsTo('App\Models\Question');
    }
    
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
