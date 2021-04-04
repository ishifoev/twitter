<?php

namespace App\Http\Controllers\Api\Tweets;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Tweets\TweetStoreRequest;
use App\Events\Tweets\TweetWasCreated;
use App\Tweets\TweetType;
use App\TweetMedia;
use App\Tweet;
use App\Http\Resources\TweetCollection;

class TweetController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:sanctum'])->only(['store']);
    }
    public function index(Request $request)
    {
        $tweets = Tweet::with([
            'media.baseMedia',
            'retweets',
            'replies',
            'user', 
            'likes',
            'originalTweet.retweets',
            'originalTweet.user',
            'originalTweet.likes',
            'originalTweet.media.baseMedia'
            ])->find(explode(',', $request->ids));
        return new TweetCollection($tweets);
    }
    public function store(TweetStoreRequest $request)
    {
        $tweet = $request->user()->tweets()->create(array_merge($request->only('body'),[
            'type' => TweetType::TWEET
        ]));

        foreach($request->media as $id) {
           $tweet->media()->save(TweetMedia::find($id));
        }
        dd($tweet->mentions->users());
        broadcast(new TweetWasCreated($tweet));
    }
}
