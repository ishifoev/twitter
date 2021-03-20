<?php

namespace App\Http\Controllers\Api\Tweets;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Tweet;
use App\Events\Tweets\TweetLikesWereUpdated;

class TweetLikeController extends Controller
{
    public function store(Tweet $tweet, Request $request)
    {
       if($request->user()->hasLiked($tweet)) {
           return response(null, 409);
       }
       $request->user()->likes()->create([
           'tweet_id' => $tweet->id
       ]);

       broadcast(new TweetLikesWereUpdated($request->user(),$tweet));
    }

    public function destroy(Tweet $tweet, Request $request)
    {
        $request->user()->likes->where('tweet_id', $tweet->id)->first()->delete();
    }
}
