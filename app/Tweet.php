<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Tweet;
use App\Like;
use App\TweetMedia;

class Tweet extends Model
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];
    /**
     * Return user
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Return original tweet
     */
    public function originalTweet()
    {
        return $this->hasOne(Tweet::class,'id', 'original_tweet_id');
    }
    /**
     * Return likes
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function likes()
    {
        return $this->hasMany(Like::class);
    }
    /**
     * Retweets
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function retweets()
    {
        return $this->hasMany(Tweet::class, 'original_tweet_id');
    }
    /**
     * Retweetet tweet
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function retweetedTweet()
    {
        return $this->hasOne(Tweet::class, 'original_tweet_id', 'id');
    }
    /**
     * Media
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function media()
    {
        return $this->hasMany(TweetMedia::class);
    }
}
