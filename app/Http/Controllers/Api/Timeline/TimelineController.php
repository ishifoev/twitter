<?php

namespace App\Http\Controllers\Api\Timeline;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\TweetCollection;

class TimelineController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:sanctum']);
    }
    public function index(Request $request)
    {
        $tweets = $request->user()
                           ->tweetsFromTheFollowing()  
                           ->parent()   
                           ->latest()
                           ->with([
                            'media.baseMedia',
                            'retweets',
                            'replies',
                            'user', 
                            'likes',
                            'originalTweet.retweets',
                            'originalTweet.user',
                            'originalTweet.likes',
                            'originalTweet.media.baseMedia'
                            ])
                            ->paginate(3);

        return new TweetCollection($tweets);
    }
}
