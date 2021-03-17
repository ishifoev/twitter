<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Tweet;

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
}
