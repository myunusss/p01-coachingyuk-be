<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserFollowedQuestion extends Model
{
    use SoftDeletes;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'question_id',
    ];
    
    public function question()
    {
        return $this->belongsTo('App\Models\Question');
    }
    
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
