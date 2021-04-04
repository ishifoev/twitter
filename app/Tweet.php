<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Tweet;
use App\Like;
use App\TweetMedia;
use App\Entity;
use Illuminate\Database\Eloquent\Builder;
use App\Tweets\Entities\EntityExtractor;
use App\Tweets\Entities\EntityType;

class Tweet extends Model
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];
    
    /**
     * Boot all tweet data
     * @return void
     */
    public static function boot() 
    {
       parent::boot();
       static::created(function(Tweet $tweet){
          $tweet->entities()->createMany(
              (new EntityExtractor($tweet))->getAllEntities()
          );
       });
    }

    /**
     * Parent scope
     * @return void
     */
    public function scopeParent(Builder $builder)
    {
        return $builder->whereNull('parent_id'); 
    }

    /**
     * Parent
     * @return void
     */
    public function parents()
    {
        $base = $this;
        $parents = [];

        while($base->parentTweet) {
           $parents [] = $base->parentTweet;
           $base = $base->parentTweet;
        }
        return collect($parents);
    }

    /**
     * Parent tweet
     */
    public function parentTweet()
    {
        return $this->belongsTo(Tweet::class, 'parent_id');
    }

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
     /**
     * Replies
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function replies()
    {
        return $this->hasMany(Tweet::class, 'parent_id');
    }
    /**
     * Entities
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function entities()
    {
        return $this->hasMany(Entity::class);
    }
     /**
     * Mentions
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function mentions()
    {
        return $this->hasMany(Entity::class)->whereType(EntityType::MENTION);
    }
}
