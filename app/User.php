<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\User;
use App\Tweet;
use App\Follower;
use App\Like;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'username', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Return avatar
     */
    public function avatar()
    {
        return 'https://www.gravatar.com/avatar/' .md5($this->email) . '?d=mp';
    }

    /**
     * Tweets
     * @return Illuminate\Database\Eloquent\Collection
    */
    public function tweets()
    {
        return $this->hasMany(Tweet::class);
    }


    /**
     * Following
     * @return Illuminate\Database\Eloquent\Collection
     */

     public function following()
     {
         return $this->belongsToMany(User::class, 'followers', 'user_id', 'following_id');
     }

    /**
     * Followers
     * @return Illuminate\Database\Eloquent\Collection
     */

     public function followers()
     {
         return $this->belongsToMany(User::class, 'followers', 'following_id', 'user_id');
     }

     /**
     * Tweets from the following people
     * @return Illuminate\Database\Eloquent\Collection
     */

     public function tweetsFromTheFollowing()
     {
         return $this->hasManyThrough(Tweet::class, Follower::class, 'user_id', 'user_id', 'id', 'following_id');
     }

     /**
     * Return likes
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function likes()
    {
        return $this->hasMany(Like::class);
    }
}
