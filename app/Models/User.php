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
 *     property="timezone",
 *     type="string"
 *   ),
 *   @OA\Property(
 *     property="bio",
 *     type="string"
 *   )
 * )
 */
class User extends Authenticatable implements MustVerifyEmail
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
        'timezone',
        'bio',
        'provider',
        'provider_id',
        'avatar',
        'header_image'
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

    public function followers()
    {
        return $this->belongsToMany(
            'App\Models\User',
            'user_follow_coachs',
            'coach_id',
            'user_id'
        )
        ->whereNull('user_follow_coachs.deleted_at')
        ->withTimestamps();
    }

    public function following()
    {
        return $this->belongsToMany(
            'App\Models\User',
            'user_follow_coachs',
            'user_id',
            'coach_id'
        )
        ->whereNull('user_follow_coachs.deleted_at')
        ->withTimestamps();
    }

    public function helpfulAnswers()
    {
        return $this->hasMany('App\Models\UserHelpfulAnswer');
    }

    public function joinedTopics()
    {
        return $this->hasMany('App\Models\UserJoinedTopic');
    }

    public function checkInTopics()
    {
        return $this->hasMany('App\Models\UserCheckInTopic');
    }

    public function role()
    {
        return $this->belongsTo('App\Models\Role');
    }
}
