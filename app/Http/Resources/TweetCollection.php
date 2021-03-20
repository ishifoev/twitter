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
                'likes' => $this->likes($request)
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
        return $user->likes()->whereIn('tweet_id', $this->collection->pluck('id'))->pluck('tweet_id')->toArray();
    }
}
