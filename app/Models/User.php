<?php

namespace App\Models;

use App\Helpers\DateTime;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Passport\HasApiTokens;

/**
 * @OA\Schema(
 *   schema="User",
 *   @OA\Property(
 *     property="id",
 *     type="int"
 *   ),
 *   @OA\Property(
 *     property="first_name",
 *     type="string"
 *   ),
 *   @OA\Property(
 *     property="last_name",
 *     type="string"
 *   ),
 *   @OA\Property(
 *     property="username",
 *     type="string"
 *   ),
 *   @OA\Property(
 *     property="email",
 *     type="string"
 *   ),
 *   @OA\Property(
 *     property="bio",
 *     type="string"
 *   )
 * )
 */
class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'username',
        'email',
        'password',
        'bio',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'deleted_at',
    ];

    public function followedQuestions()
    {
        return $this->hasMany('App\Models\UserFollowedQuestion');
    }

    public function helpfulAnswers()
    {
        return $this->hasMany('App\Models\UserHelpfulAnswer');
    }

    public function joinedTopics()
    {
        return $this->hasMany('App\Models\UserJoinedTopic');
    }

    public function role()
    {
        return $this->belongsTo('App\Models\Role');
    }
}
