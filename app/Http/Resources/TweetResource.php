<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use  App\Http\Resources\UserResource;
use  App\Http\Resources\TweetResource;

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
           'user' => new UserResource($this->user),
           'created_at' => $this->created_at->timestamp
        ];
    }
}
