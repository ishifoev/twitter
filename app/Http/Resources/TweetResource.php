<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use  App\Http\Resources\UserResource;
use  App\Http\Resources\TweetResource;
use App\Http\Resources\MediaCollection;
use App\Http\Resources\EntityCollection;

class TweetResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
           'id' => $this->id,
           'body' => $this->body,
           'type' => $this->type,
           'originalTweet' => new TweetResource($this->originalTweet),
           'likes_count' => $this->likes->count(),
           'retweets_count' => $this->retweets->count(),
           'media'=> new MediaCollection($this->media),
           'entities'=> new EntityCollection($this->entities),
           'replies_count' => $this->replies->count(),
           'user' => new UserResource($this->user),
           'created_at' => $this->created_at->timestamp
        ];
    }
}
