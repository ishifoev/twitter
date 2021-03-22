<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\TweetResource;

class TweetCollection extends ResourceCollection
{
    /**
     * Get the tweet resource
     * @var Object
     */

    public $collects = TweetResource::class;

    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data' => $this->collection
        ];
    }

    /**
     * Return likes array
     *  @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function with($request)
    {
        return [
            'meta' => [
                'likes' => $this->likes($request),
                'retweets' => $this->retweets($request)
            ]
        ];
    }
    /**
     *  @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function likes($request)
    {
        if(!$user = $request->user()) {
           return [];
        }
        return $user->likes()->whereIn('tweet_id', $this->collection->pluck('id')->merge($this->collection->pluck('tweet_id')))->pluck('tweet_id')->toArray();
    }
    /**
     *  @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function retweets($request)
    {
        if(!$user = $request->user()) {
           return [];
        }
        //dd($this->collection->pluck('original_tweet_id'));
        return $user->retweets()
                    ->whereIn('original_tweet_id', $this->collection->pluck('id')->merge($this->collection->pluck('original_tweet_id')))
                    ->pluck('original_tweet_id')->toArray();
    }
}
