<?php

namespace App\Http\Controllers\Tweets;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Tweet;

class TweetController extends Controller
{
    /**
     * @param Tweet $tweet
     * @return void
     */
    public function show(Tweet $tweet)
    {
        return view('tweets.show', compact('tweet'));
    }
}
