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
        $tweets = $request->user()->tweetsFromTheFollowing()->latest()->with(['user', 'likes'])->paginate(3);

        return new TweetCollection($tweets);
    }
}
