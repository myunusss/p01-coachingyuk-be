<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reply extends Model
{
    use SoftDeletes;
    
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
