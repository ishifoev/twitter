<?php

namespace App\Http\Controllers\Api\Tweets;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Tweets\TweetStoreRequest;
use App\Events\Tweets\TweetWasCreated;

class TweetController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:sanctum'])->only(['store']);
    }
    public function store(TweetStoreRequest $request)
    {
        $tweet = $request->user()->tweets()->create($request->only('body'));
        broadcast(new TweetWasCreated($tweet));
    }
}
