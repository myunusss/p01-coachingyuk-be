<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserHelpfulAnswer extends Model
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
